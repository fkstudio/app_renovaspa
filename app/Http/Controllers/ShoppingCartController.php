<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Database\DbContext;


class ShoppingCartController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Shopping cart Controller
    |--------------------------------------------------------------------------
    */

    private $dbcontext;
    private $entityManager;

    /* ============================= PRIVATE METHODS ============================= */
    /* return current user cart instance */
    private function getCart($session_id){

        $cart = null;
        $cartExists = $this->entityManager->getRepository("App\Models\Test\ShoppingCartModel")->findOneBy(['Session' => $session_id]);

        if($cartExists == null){
            $cart = new \App\Models\Test\ShoppingCartModel();
            $cart->Session = $session_id;
            $cart->Created = new \DateTime();
            $cart->IsDeleted = false;
        }
        else{
            $cart = $cartExists;
        }

        return $cart;
    }

    /* ============================= PUBLIC METHODS ============================= */

    /* public class construct */
    public function __construct(){
        $this->dbcontext = new DbContext();
        $this->entityManager = $this->dbcontext->getEntityManager();
    }

    public function checkout(Request $request){
        $session = $request->session();
        $sessionId = $session->getId();

        try {
            $session->forget('current_reservation_id');

            $cart = $this->getCart($sessionId);

            $cabins = $this->entityManager->getRepository('App\Models\Test\CabinModel')->findAll();
            $category = $this->entityManager->getRepository('App\Models\Test\CategoryModel')->findOneBy(['Id' => $session->get('category_id')]);

            $breadcrumps = [
                'SHOPPING CART' => '/shopping/cart',
                'CHECKOUT' => '#fakelink'
            ];

            return view('cart.checkout', [ 'model' => $cart, 'breadcrumps' => $breadcrumps, 'category' => $category, 'cabins' => $cabins ]); 
        }
        catch (\Exception $e){
            return redirect()->route('home.home')->with('failure', trans("messages.session_expired"));
        }
    }

    public function getItemQuantity(Request $request, $item){
        $session = $request->session();
        $sessionId = $session->getId();
        $reservationType = $session->get('reservation_type');
        $cart = $this->getCart($sessionId);

        $quantity = 0;

        /* if is a wedding service */
        if($item->PackageCategoryRelation != null){
            $quantity = $this->entityManager
                                        ->createQuery('SELECT count(u.Quantity) as Total FROM App\Models\Test\ShoppingCartItemModel u WHERE u.Cart = :cart AND u.PackageCategoryRelation = :relation')
                                        ->setParameters([ 'cart' => $cart->Id, 'relation' => $item->PackageCategoryRelation ])
                                        ->getSingleResult()['Total'];
        }
        else if($item->CertificateNumber != null){
            $quantity = $this->entityManager
                                        ->createQuery('SELECT count(u.Quantity) as Total FROM App\Models\Test\ShoppingCartItemModel u WHERE u.Cart = :cart AND u.Service = :service AND u.CertificateNumber = :certificate')
                                        ->setParameters([ 'cart' => $cart->Id, 'service' => $item->Service->Id, 'certificate' => $item->CertificateNumber ])
                                        ->getSingleResult()['Total'];
        }
        else {
            $quantity = $this->entityManager
                                    ->createQuery('SELECT count(u.Quantity) as Total FROM App\Models\Test\ShoppingCartItemModel u WHERE u.Cart = :cart AND u.Service = :service')
                                    ->setParameters([ 'cart' => $cart->Id, 'service' => $item->Service->Id ])
                                    ->getSingleResult()['Total'];
        }

        return $quantity;
    }

    /* return current user cart */
    public function myCart(Request $request){
        $session = $request->session();
        $sessionId = $session->getId();
        $reservationType = $session->get('reservation_type');

        $cart = $this->getCart($sessionId);

        try {
            switch ($reservationType) {
                // individual services
                case 1:
                    $method = 'post';
                    $action = '/shopping/cart/checkout';
                    break;
                case 2:
                    // certificates
                    $method = 'get';
                    $action = '/certificate/registration';
                    break;
                case 3:
                    // weddings
                    $method = 'get';
                    $action = '/shopping/cart/checkout';
                    break;
                default:
                    echo "no reservation type";
                    exit();
                    return redirect()->route("home.home")->with('failure', 'messages.session_expired');
                    break;
            }

            switch ($reservationType) {
                case 1:
                    /* individual services */
                    $cart->Items = $this->entityManager->createQuery('SELECT u FROM App\Models\Test\ShoppingCartItemModel u WHERE u.Cart = :cart GROUP BY u.Service')
                             ->setParameter('cart', $cart->Id)
                             ->getResult();
                    break;
                
                case 2:
                    /* certificates */
                    $cart->Items = $this->entityManager->createQuery('SELECT u FROM App\Models\Test\ShoppingCartItemModel u WHERE u.Cart = :cart GROUP BY u.CertificateNumber, u.Service')
                             ->setParameter('cart', $cart->Id)
                             ->getResult();
                    break;
                case 3:
                    /* weddings */
                    $cart->Items = $this->entityManager->createQuery('SELECT u FROM App\Models\Test\ShoppingCartItemModel u WHERE u.Cart = :cart GROUP BY u.Service, u.PackageCategoryRelation')
                             ->setParameter('cart', $cart->Id)
                             ->getResult();
                    break;

            }

            foreach($cart->Items as $item){
                /* if is a wedding service */
                $item->Quantity = $this->getItemQuantity($request, $item);
            }
            
            
            $country = $this->entityManager->getRepository('\App\Models\Test\CountryModel')->findOneBy(['Id' => $session->get('country_id')]);

            $category = $this->entityManager->getRepository('\App\Models\Test\CategoryModel')->findOneBy(['Id' => $session->get('category_id')]);

            $breadcrumps = [
                'SHOPPING CART' => '#fakelink'
            ];

            return view('cart.myCart', [ 'model' => $cart, 'category' => $category, 'breadcrumps' => $breadcrumps, 'country' => $country, 'action' => $action, 'method' => $method, 'reservationType' => $reservationType ]);
        }
        catch (\Exception $e){
            return redirect()->route('home.home')->with('failure', trans("messages.session_expired"));
        }
    }

    public function updateCart(Request $request){
        $session = $request->session();
        $sessionId = $session->getId();

        $cart = $this->getCart($sessionId);

        if(!isset($_POST['id']))
            return redirect()->route('cart.myCart')->with('success', "You haven't items at your card.");

        try {
            foreach($_POST['id'] as $key => $itemId){
                $item = $this->entityManager->getRepository('App\Models\Test\ShoppingCartItemModel')
                                                ->findOneBy(['Id' => $itemId]);

                if($item == null)
                    return redirect()->route('cart.myCart')->with('failure', trans('messages.invalid_data'));

                // get item quantity
                $item->Quantity = $this->getItemQuantity($request, $item);

                $toQuantity = $_POST['quantity'][$key];

                if($item->Quantity < $toQuantity){
                    for($i = $item->Quantity; $i < $toQuantity; $i++){
                        $itemClone = clone $item;

                        $this->entityManager->persist($itemClone);
                    }
                }
            }

            $this->entityManager->flush();

            return redirect()->route('cart.myCart')->with('success', trans('messages.cart_updated_success'));
        }
        catch (\Exceptin $e){
            return redirect()->route('cart.myCart')->with('failure', trans('messages.error'));
        }
    }

    /* add riu wedding package to cart */
    public function addRiuPackageToCart(Request $request){
        $session = $request->session();
        $sessionId = $session->getId();

        try {
            /* get current user cart */
            $cart = $this->getCart($sessionId);

            // get package relation
            $packageRelation = $this->entityManager->getRepository("App\Models\Test\WeddingPackageCategoryRelationModel")->findOneBy(['Id' => $session->get('riu_wedding_package_id')]);

            if($packageRelation == null)
                return redirect()->route("home.home")->with('failure', trans('messages.session_expired'));    
            
            // create cart item
            $cartItem = new \App\Models\Test\ShoppingCartItemModel();
            $cartItem->Cart = $cart;
            $cartItem->PackageCategoryRelation = $packageRelation;
            $cartItem->Service = null;
            $cartItem->Quantity = 1;
            $cartItem->Price = $packageRelation->Price;
            $cartItem->PreferedDate = null;
            $cartItem->PreferedTime = null;
            $cartItem->Type = $session->get('reservation_type');
            $cartItem->Created = new \DateTime();
            $cartItem->IsDeleted = false;    

            // save cart item
            $cart->Items[] = $cartItem;

            $this->entityManager->persist($cart);
            $this->entityManager->flush();

            /* redirect to category list */
            return redirect()->route('category.categoriesByHotel', [ 'hotel_id' => $session->get('hotel_id') ]);
        }
        catch (\Exception $e){
            return redirect()->route("home.home")->with('failure', trans('messages.session_expired'));
        }
    }

    /* add items to current user cart */
    public function addToCart(Request $request){
        
        $session = $request->session();
        $sessionId = $session->getId();
        $statusMessage = '';
        $reservationType = $session->get('reservation_type');
        $isWedding = (isset($_POST['weddings'])) ? true : false;

        $connection = $this->entityManager->getConnection();

        // echo "session 2 <br/>";
        // echo "<pre>";
        // print_r($_POST);
        // echo "<pre>";
        // exit();


        try {
            
            $connection->beginTransaction();

            /* get current user cart */
            $cart = $this->getCart($sessionId);

            /* data to view */
            $data = [ 'category_id' => $session->get('category_id') ];

            if(isset($_POST['quantity'])){
                $procced = false;

                foreach($_POST['quantity'] as $quantity){
                    if($quantity > 0 ){
                        $procced = true;
                    }
                }
            }

            if($procced == false){
                if($isWedding)
                    return redirect()->route("wedding.services", $data)->with('failure', trans("messages.select_some_package"));
                else
                    return redirect()->route("service.listByCategory", $data)->with('failure', trans("messages.select_some_service"));
            }

            if($isWedding){

                foreach($_POST['pacakge_relation_id'] as $key => $id){
                    $pacakgeRelation_id = $id; 
                    $serviceQuantity = $_POST['quantity'][$key];

          
                    if(!empty($serviceQuantity) && $serviceQuantity > 0){
                        // get package relation
                        $packageRelation = $this->entityManager->getRepository("App\Models\Test\WeddingPackageCategoryRelationModel")->findOneBy(['Id' => $pacakgeRelation_id]);

                        if($packageRelation == null)
                            return redirect()->route("wedding.services", $data)->with('failure', 'messages.select_some_package');     

                        for($i = 1; $i <= $serviceQuantity; $i++){

                            // create cart item
                            $cartItem = new \App\Models\Test\ShoppingCartItemModel();
                            $cartItem->Cart = $cart;
                            $cartItem->PackageCategoryRelation = $packageRelation;
                            $cartItem->Service = null;
                            $cartItem->Quantity = 1;
                            $cartItem->Price = $packageRelation->Price;
                            $cartItem->PreferedDate = null;
                            $cartItem->PreferedTime = null;
                            $cartItem->Type = $reservationType;
                            $cartItem->Created = new \DateTime();
                            $cartItem->IsDeleted = false;    

                            // save cart item
                            $cart->Items[] = $cartItem;
                        }
                    }  
                }
            }
            else {
                // get current category
                $category = $this->entityManager->getRepository("App\Models\Test\CategoryModel")->findOneBy(['Id' => $session->get("category_id")]);

                foreach($_POST['id'] as $key => $id){
                    $serviceId = $id;
                    $serviceQuantity = $_POST['quantity'][$key];

                    if(!empty($serviceQuantity) && $serviceQuantity > 0){
                        $service = $this->entityManager->getRepository("App\Models\Test\ServiceModel")->findOneBy(['Id' => $serviceId]);
                        $cartItem = null;

                        for($i = 1; $i <= $serviceQuantity; $i++){
                            $cartItem = new \App\Models\Test\ShoppingCartItemModel();
                            $cartItem->Cart = $cart;
                            $cartItem->Service = $service;
                            $cartItem->Category = $category;
                            $cartItem->Quantity = 1;
                            $cartItem->Price = $service->getPrice($session->get('hotel_id'));
                            $cartItem->PreferedDate = null;
                            $cartItem->PreferedTime = null;
                            $cartItem->Type = $reservationType;
                            $cartItem->Created = new \DateTime();
                            $cartItem->IsDeleted = false; 

                            /* check if the reservation type is equal to certificate */
                            if($reservationType == 2){
                                $cartItem->CertificateNumber = intval($session->get('current_certificate'));
                            }

                            $cart->Items[] = $cartItem;
                        }

                        if($reservationType == 2){
                            if($session->get('can_go_to_cart') == 0 && $session->get('current_certificate') >= $session->get('certificate_quantity')){
                                $session->put('can_go_to_cart', 1);
                            }
                        }

                        $statusMessage = trans('messages.items_added');
                    }
                }    
            }

            
            $this->entityManager->persist($cart);
            $this->entityManager->flush();

            $connection->commit();

            if($isWedding){
                return redirect()->route("wedding.services", $data)->with('success', trans('messages.package_added'));                
            }

            return redirect()->route("service.listByCategory", $data)->with('success', $statusMessage);    
        }
        catch (\Exception $e){
            $connection->rollBack();
            return redirect()->route('home.home')->with('failure', trans("messages.session_expired"));
        }
    }

    /* remove group same items from current user cart */
    public function removeItem($itemId){

        try {
            $statusMessage = "";

            $cartItemExists = $this->entityManager->getRepository('\App\Models\Test\ShoppingCartItemModel')->findOneBy(['Id' => $itemId]);

            if($cartItemExists != null){
                if($cartItemExists->PackageCategoryRelation != null){
                    $message = $cartItemExists->PackageCategoryRelation->WeddingPackage->Name .' '. trans("messages.item_removed_from_your_cart");     
                }
                else {
                    $message = $cartItemExists->Quantity .' '. $cartItemExists->Service->Name . trans("messages.item_removed_from_your_cart");
                }
                
                $this->entityManager->remove($cartItemExists);

                $this->entityManager->flush();

                return redirect()->route("cart.myCart")->with('success', $message);
            }
            else {
                return redirect()->route("cart.myCart")->with('failure', trans("messages.cart_item_doesn_exists"));
            }
            
        }
        catch (\Exception $e){
            return redirect()->route('home.home')->with('failure', trans("messages.session_expired"));
        }
    }

}
