<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Database\DbContext;
use App\Models\CountryModel;


class HotelController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Hotel Controller
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

    /* get all hotels by current region */
    public function hotelsByRegion(Request $request, $region_id){
        
        if(empty($region_id))
            return redirect()->route('region.listByCountry')->with('failure', trans('messages.select_hotel'));

        $session = $request->session();
        $session->put('region_id', $region_id);

        try {
            $region = $this->entityManager->getRepository("App\Models\Test\RegionModel")->findOneBy(['Id' => $region_id]);
            $hotels = $this->entityManager->getRepository("App\Models\Test\HotelRegionModel")->findBy([ 'Region' => $region_id ]);

            $breadcrumps = [
                $region->Country->Name => '/country/'. $region->Country->Id . '/regions',
                $region->Name => '/region/'. $region->Id . '/hotels',
                'HOTELS' => '#fakelink'
            ];
            
            $viewData = [ 
                "model" => $hotels, 
                'region' => $region, 
                'reservationType' => $session->get('reservation_type'),
                'breadcrumps' => $breadcrumps
            ];

            return view("hotel.list", $viewData);
        }
        catch (\Exception $e){
            return redirect()->route('home.home')->with('failure', 'Your session has expired.');
        }
    }

    /* get all hotels in json format */
    public function getAll($region_id){
        
        $hotelRegions = $this->entityManager->getRepository("App\Models\Test\HotelRegionModel")->findBy([ 'Region' => $region_id ]);
        $model = [];

        foreach($hotelRegions as $hotelRegion){
            array_push($model, [ "id" => $hotelRegion->Hotel->Id, "name" => $hotelRegion->Hotel->Name ]);
        }

        return json_encode($model);

    }

    /* get hotel by id */
    public function details($id = null){
        
        if($id == null)
            return redirect("/");

        try {
            $hotel = $this->entityManager->getRepository("App\Models\Test\HotelModel")->findOneBy([ 'Id' => $id]);

            $breadcrumps = [
                'HOTELS' => '#fakelink', 
                strtoupper($hotel->Name) => '#fakelink'
            ];

            return view("hotel.details", ['model' => $hotel, 'breadcrumps' => $breadcrumps]);
        }
        catch (\Exception $e){
            return redirect()->route('home.home')->with('failure', 'Your session has expired.');
        }
    }

}
