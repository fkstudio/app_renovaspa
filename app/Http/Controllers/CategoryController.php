<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Database\DbContext;


class CategoryController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Country Controller
    |--------------------------------------------------------------------------
    */

    private $dbcontext;
    private $entityManager;

    public function __construct(){
        $this->dbcontext = new DbContext();
        $this->entityManager = $this->dbcontext->getEntityManager();
    }

    public function categories(Request $request, $region_id){
        $regionServices = $this->entityManager->getRepository("App\Models\Test\CategoryCountryModel")->findBy(["Region" => $region_id]);

        return view("category.list", [ "model" => $regionServices ]);
    }

    public function categoriesByHotel(Request $request, $hotel_id){
        $request->session()->put("hotel_id", $hotel_id);

        $hotel = $this->entityManager->getRepository("App\Models\Test\HotelModel")->findOneBy(["Id" => $hotel_id]);
        $hotelRegion = $this->entityManager->getRepository("App\Models\Test\HotelRegionModel")
                                           ->findOneBy(["Hotel" => $hotel_id]);

        $regionServices = $this->entityManager->getRepository("App\Models\Test\CategoryCountryModel")
                                              ->findBy(["Country" => $hotelRegion->Region->Country->Id]);


        return view("category.list", [ "model" => $regionServices, "hotel" => $hotel, "region" => $hotelRegion->Region ]);
    }

}
