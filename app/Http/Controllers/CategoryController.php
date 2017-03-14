<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Database\DbContext;


class CategoryController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Category Controller
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

    /* get all categories */
    public function categories(Request $request, $region_id){
        $regionServices = $this->entityManager->getRepository("App\Models\Test\CategoryCountryModel")->findBy(["Region" => $region_id]);

        return view("category.list", [ "model" => $regionServices ]);
    }

    /* get a list of available categories in current hotel */
    public function categoriesByHotel(Request $request, $hotel_id, $next = 0){
        $session = $request->session();
        $session->put("hotel_id", $hotel_id);
        $reservationType = $session->get('reservation_type');

        if($reservationType == null)
            return redirect()->route('home.home');

        try {
            if($next != 0){
                if($reservationType == 2 && $next != $session->get('current_certificate') && $next <= $session->get('certificate_quantity')){
                    $session->put('current_certificate', ( $session->pull('current_certificate') + 1 ));
                }
            }

            $hotel = $this->entityManager->getRepository("App\Models\Test\HotelModel")->findOneBy(["Id" => $hotel_id]);
            $hotelRegion = $this->entityManager->getRepository("App\Models\Test\HotelRegionModel")
                                               ->findOneBy(["Hotel" => $hotel_id]);

            $regionServices = $this->entityManager->getRepository("App\Models\Test\CategoryCountryModel")
                                                  ->findBy(
                                                        [
                                                            "Country" => $hotelRegion->Region->Country->Id,
                                                            "IsActive" => true,
                                                            "IsDeleted" => false
                                                        ], 
                                                        [
                                                            "Order" => "ASC"
                                                        ]);

            $breadcrumps = [
                $hotelRegion->Region->Country->Name => '/country/'. $hotelRegion->Region->Country->Id . '/regions',
                $hotelRegion->Region->Name => '/region/'. $hotelRegion->Region->Id . '/hotels',
                $hotelRegion->Hotel->Name => '/hotel/' . $hotelRegion->Hotel->Id . '/categories',
                'TREATMENTS' => '#fakelink'
            ];


            $viewData = [ 
                "model" => $regionServices, 
                "hotel" => $hotel, 
                "region" => $hotelRegion->Region, 
                'breadcrumps' => $breadcrumps
            ];

            if($session->get('reservation_type') == 2){
                $session->flash('success', 'Select a treatment for the certificate #'. $session->get('current_certificate') .' - '. $session->get('certificate_quantity'));
                return view("category.list", $viewData);
            }


            return view("category.list", $viewData);
        }
        catch (\Exception $e){
            return redirect()->route('home.home')->with('failure', 'Your session has expired.');
        }
    }

}
