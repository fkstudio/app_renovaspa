<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Database\DbContext;


class ServiceController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Service Controller
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

    public function deleteReservationItem(Request $request, $id){
        $session = $request->session();
        $sessionId = $session->getId();

        /* get reservation item to delete */
        $certificateItem = $this->entityManager->getRepository('App\Models\Test\ReservationItemModel')->findOneBy(['Id' => $id]);

        /* redirect to home if the reservation item doesnt exists */
        if($certificateItem == null)
            return redirect()->route('home.home');

        /* remove certificate item */
        $this->entityManager->remove($certificateItem);

        /* save changes */
        $this->entityManager->flush();
        return redirect()->route('reservation.checkout');
        
    }

    /* get all services in category by hotel */
    public function servicesByCategoryAndHotel(Request $request, $category_id){

        $hotel_id = $request->session()->get('hotel_id');
        $region_id = $request->session()->get('region_id');
        $request->session()->put('category_id', $category_id);


        $cart = $this->getCart($request->session()->getId());

        try {
                
            $hotel = $this->entityManager->getRepository("App\Models\Test\HotelModel")->findOneBy(["Id" => $hotel_id]);
            $category = $this->entityManager->getRepository("App\Models\Test\CategoryModel")->findOneBy(["Id" => $category_id]);
            $region = $this->entityManager->getRepository("App\Models\Test\RegionModel")->findOneBy(["Id" => $region_id]);

            $filters = [
                            "Category" => $category->Id, 'Hotel' => $hotel->Id,
                            "IsActive" => true,
                            "IsDeleted" => false
                        ];

            if($request->session()->get('reservation_type') != 3)
                $filters["OnlyForWedding"] = false;

            $serviceCategories = $this->entityManager->getRepository("App\Models\Test\ServiceCategoryHotelModel")
                ->findBy(
                        $filters, 
                        ['Order' => 'ASC']);


            $breadcrumps = [
                $region->Country->Name => '/country/'. $region->Country->Id . '/regions',
                $region->Name => '/region/'. $region->Id . '/hotels',
                $hotel->Name => '/hotel/' . $hotel->Id . '/categories',
                $category->Name => '/category/'. $category->Id . '/services',
                'SERVICES' => '#fakelink'
            ];

            $viewData = [ 
                    "model" => $serviceCategories, 
                    "hotel" => $hotel, 
                    "category" => $category, 
                    "region" => $region,
                    "breadcrumps" => $breadcrumps,
                    'mycart' => $cart
            ];

            return view("service.list", $viewData);
        }
        catch (\Exception $e){
            print_r($e);
            return redirect()->route('home.home')->with('failure', 'Your session has expired.');
        }
    }

}
