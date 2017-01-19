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
        else
            $cart = $cartExists;

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

            $breadcrumps = [
                'SHOPPING CART' => '#fakelink',
                'MY CART' => '#fakelink',
                'CHECKOUT' => '#fakelink'
            ];

            return view('cart.checkout', [ 'model' => $cart, 'breadcrumps' => $breadcrumps, 'category_id' => $session->get('category_id'), 'cabins' => $cabins ]); 
        }
        catch (\Exception $e){
            return redirect()->route('home.home')->with('failure', 'Your session has expired.');
        }
    }

    /* return current user cart */
    public function myCart(Request $request){
        $session = $request->session();
        $sessionId = $session->getId();
        $reservationType = $session->get('reservation_type');

        try {
            if($reservationType == 1)
                $action = '/shopping/cart/checkout';
            else if($reservationType == 2)
                $action = '/certificate/registration';

            $cart = $this->getCart($sessionId);
            $country = $this->entityManager->getRepository('\App\Models\Test\CountryModel')->findOneBy(['Id' => $session->get('country_id')]);

            $breadcrumps = [
                'SHOPPING CART' => '#fakelink',
                'MY CART' => '#fakelink'
            ];

            return view('cart.myCart', [ 'model' => $cart, 'breadcrumps' => $breadcrumps, 'country' => $country, 'category_id' => $session->get('category_id'), 'action' => $action, 'reservationType' => $reservationType ]);
        }
        catch (\Exception $e){
            return redirect()->route('home.home')->with('failure', 'Your session has expired.');
        }
    }

    /* add items to current user cart */
    public function addToCart(Request $request){
        
        $session = $request->session();
        $sessionId = $session->getId();
        $statusMessage = '';
        $reservationType = $session->get('reservation_type');

        try {
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

            if($procced == false)
                return redirect()->route("service.listByCategory", $data)->with('failure', "Please select at least one service");

            foreach($_POST['id'] as $key => $id){
                $serviceId = $id;
                $serviceQuantity = $_POST['quantity'][$key];

                if(!empty($serviceQuantity) && $serviceQuantity > 0){
                    $service = $this->entityManager->getRepository("App\Models\Test\ServiceModel")->findOneBy(['Id' => $serviceId]);

                    $cartItem = null;
                    $cartItemExists = $this->entityManager->getRepository('\App\Models\Test\ShoppingCartItemModel')->findOneBy(['Cart' => $cart->Id, 'Service' => $serviceId]);

                    
                    if($cartItemExists == null){
                        $cartItem = new \App\Models\Test\ShoppingCartItemModel();
                        $cartItem->Cart = $cart;
                        $cartItem->Service = $service;
                        $cartItem->Quantity = intval($serviceQuantity);
                        $cartItem->Price = $service->getPrice($session->get('hotel_id'));
                        $cartItem->PreferedDate = null;
                        $cartItem->PreferedTime = null;
                        $cartItem->Type = $reservationType;
                        $cartItem->Created = new \DateTime();
                        $cartItem->IsDeleted = false; 
                    }
                    else {
                        if($reservationType == 1){
                            $cartItem = $cartItemExists;
                            $cartItem->Quantity = $cartItem->Quantity + $serviceQuantity;
                        }
                        else if ($reservationType == 2){
                            $cartItem = clone $cartItemExists;
                            $cartItem->Quantity = $serviceQuantity;
                        }
                    }

                    /* check if the reservation type is equal to certificate */
                    if($reservationType == 2){
                        $cartItem->CertificateNumber = $session->get("current_certificate");
                    }

                    if($session->get('can_go_to_cart') == false && $session->get('current_certificate') >= $session->get('certificate_quantity')){
                        $session->put('can_go_to_cart', true);
                    }

                    $this->entityManager->persist($cartItem);

                    $statusMessage = 'Services has been added to your cart';
                }
            }

            $this->entityManager->persist($cart);
            $this->entityManager->flush();

            return redirect()->route("service.listByCategory", $data)->with('success', $statusMessage);    
        }
        catch (\Exception $e){
            return redirect()->route('home.home')->with('failure', 'Your session has expired.');
        }
    }

    /* remove group same items from current user cart */
    public function removeItem($itemId){

        try {
            $statusMessage = "";

            $cartItemExists = $this->entityManager->getRepository('\App\Models\Test\ShoppingCartItemModel')->findOneBy(['Id' => $itemId]);

            if($cartItemExists != null){
                $message = $cartItemExists->Quantity .' "'. $cartItemExists->Service->Name . '" services removed from your shopping cart.'; 
                $this->entityManager->remove($cartItemExists);

                $this->entityManager->flush();

                return redirect()->route("cart.myCart")->with('success', $message);
            }
            else {
                return redirect()->route("cart.myCart")->with('failure', "Cart item doesn't exists");
            }

            
        }
        catch (\Exception $e){
            return redirect()->route('home.home')->with('failure', 'Your session has expired.');
        }
    }

}
