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

        try {
                
            $hotel = $this->entityManager->getRepository("App\Models\Test\HotelModel")->findOneBy(["Id" => $hotel_id]);
            $category = $this->entityManager->getRepository("App\Models\Test\CategoryModel")->findOneBy(["Id" => $category_id]);
            $region = $this->entityManager->getRepository("App\Models\Test\RegionModel")->findOneBy(["Id" => $region_id]);

            $serviceCategories = $this->entityManager->getRepository("App\Models\Test\ServiceCategoryHotelModel")->findBy(["Category" => $category->Id, 'Hotel' => $hotel->Id]);

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
                    "breadcrumps" => $breadcrumps 
            ];

            return view("service.list", $viewData);
        }
        catch (\Exception $e){
            return redirect()->route('home.home')->with('failure', 'Your session has expired.');
        }
    }

}
