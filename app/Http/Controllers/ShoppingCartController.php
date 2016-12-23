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

        $session->forget('current_reservation_id');

        $cart = $this->getCart($sessionId);

        $cabins = $this->entityManager->getRepository('App\Models\Test\CabinModel')->findAll();

        return view('cart.checkout', [ 'model' => $cart, 'category_id' => $session->get('category_id'), 'cabins' => $cabins ]); 
    }

    /* return current user cart */
    public function myCart(Request $request){
        $session = $request->session();
        $sessionId = $session->getId();

        $cart = $this->getCart($sessionId);

        return view('cart.myCart', [ 'model' => $cart, 'category_id' => $session->get('category_id') ]);
    }

    /* add items to current user cart */
    public function addToCart(Request $request){
        
        $session = $request->session();
        $sessionId = $session->getId();
        $statusMessage = '';

        /* get current user cart */
        $cart = $this->getCart($sessionId);

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
                    $cartItem->Type = 1;
                    $cartItem->Created = new \DateTime();
                    $cartItem->IsDeleted = false; 
                }
                else {
                    $cartItem = $cartItemExists;
                    $cartItem->Quantity = $cartItemExists->Quantity + $serviceQuantity;
                }

                $this->entityManager->persist($cartItem);

                $statusMessage = 'Items added to cart';
            }
        }

        $this->entityManager->persist($cart);
        $this->entityManager->flush();

        return redirect()->route("service.listByCategory", [ 'category_id' => $session->get('category_id') ])->with('status', $statusMessage);
    }

    /* remove group same items from current user cart */
    public function removeItem($itemId){

        $statusMessage = "";

        $cartItemExists = $this->entityManager->getRepository('\App\Models\Test\ShoppingCartItemModel')->findOneBy(['Id' => $itemId]);

        if($cartItemExists != null){
            $this->entityManager->remove($cartItemExists);

            $this->entityManager->flush();

            $statusMessage = "Item deleted success";
        }
        else {
            $statusMessage = "art item doesn't exists";
        }

        return redirect()->route("cart.myCart")->with('status', $statusMessage);
    }

}
