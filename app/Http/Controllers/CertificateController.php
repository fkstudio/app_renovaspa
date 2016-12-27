<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Database\DbContext;


class CertificateController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Home Controller
    |--------------------------------------------------------------------------
    */

    private $dbcontext;
    private $entityManager;

    /* ============================= PUBLIC METHODS ============================= */
    
    /* public class construct */
    public function __construct(){
        $this->dbcontext = new DbContext();
        $this->entityManager = $this->dbcontext->getEntityManager();
    }

    public function options(Request $request, $hotel_id){
        $session = $request->session();
        $session->put('reservation_type', 2);
        $session->put('hotel_id', $hotel_id);

        return view("certificate.options");
    }

    public function checkOption(Request $request){
        $session = $request->session();
        $session->put('certificate_quantity', $_POST['quantity']);
        $session->put('current_certificate', 1);

        if($_POST['type'] == 1){
            return redirect()->route('category.categoriesByHotel', [ 'hotel_id' => $session->get('hotel_id') ]);
        }
        else {

        }
    }

    public function registration(Request $request){
        $session = $request->session();
        $sessionId = $session->getId();

        $cart = $this->entityManager->getRepository('App\Models\Test\ShoppingCartModel')->findOneBy(['Session' => $session->getId()]);
        $services = [];

        $items = $this->entityManager->createQuery('SELECT u FROM App\Models\Test\ShoppingCartItemModel u WHERE u.Cart = :cart  ORDER BY u.CertificateNumber')
                         ->setParameter('cart', $cart->Id)
                         ->getResult();

        foreach($items as $item){
            if(!isset($services[$item->CertificateNumber])){
                $services[$item->CertificateNumber] = [];
            }

            $services[$item->CertificateNumber][] = [ 'id' => $item->Service->Id, 'name' => $item->Service->Name, 'quantity' => $item->Quantity ];
        }
                                                                          
        return view('certificate.registration', ['model' => $services]);

    }

}