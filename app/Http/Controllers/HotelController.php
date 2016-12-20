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
    | Country Controller
    |--------------------------------------------------------------------------
    */

    private $dbcontext;
    private $entityManager;

    public function __construct(){
        $this->dbcontext = new DbContext();
        $this->entityManager = $this->dbcontext->getEntityManager();
    }

    public function hotelsByRegion(Request $request, $region_id){
        $request->session()->put('region_id', $region_id);

        $region = $this->entityManager->getRepository("App\Models\Test\RegionModel")->findOneBy(['Id' => $region_id]);
        $hotels = $this->entityManager->getRepository("App\Models\Test\HotelRegionModel")->findBy([ 'Region' => $region_id ]);
        
        return view("hotel.list", [ "model" => $hotels, 'region' => $region]);

    }

    public function getAll($region_id){
        $hotels = $this->entityManager->getRepository("App\Models\HotelModel")->findBy([ 'Region' => $region_id ]);
        $model = [];

        foreach($hotels as $hotel){
            array_push($model, [ "id" => $hotel->Id, "name" => $hotel->Name ]);
        }

        return json_encode($model);

    }

    public function details($id = null){
        
        if($id == null)
            return redirect("/");

        $hotel = $this->entityManager->getRepository("App\Models\HotelModel")->findOneBy([ 'Id' => $id]);

        return view("hotel.details", ['model' => $hotel]);

    }

}
