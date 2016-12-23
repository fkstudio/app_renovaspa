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

    /* get all services in category by hotel */
    public function servicesByCategoryAndHotel(Request $request, $category_id){

        $hotel_id = $request->session()->get('hotel_id');
        $region_id = $request->session()->get('region_id');
        $request->session()->put('category_id', $category_id);

        $hotel = $this->entityManager->getRepository("App\Models\Test\HotelModel")->findOneBy(["Id" => $hotel_id]);
        $category = $this->entityManager->getRepository("App\Models\Test\CategoryModel")->findOneBy(["Id" => $category_id]);
        $region = $this->entityManager->getRepository("App\Models\Test\RegionModel")->findOneBy(["Id" => $region_id]);

        $serviceCategories = $this->entityManager->getRepository("App\Models\Test\ServiceCategoryModel")->findBy(["Category" => $category->Id]);

        return view("service.list", [ "model" => $serviceCategories, 'hotel' => $hotel, 'category' => $category, "region" => $region ]);
    }

}
