<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Database\DbContext;
use App\Models\CountryModel;


class RegionController extends Controller
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

    public function regionsByCountry(Request $request, $country_id){
        $request->session()->put("country_id", $country_id);
        
        $country = $this->entityManager->getRepository("App\Models\Test\CountryModel")->findOneBy([ 'Id' => $country_id ]);
        $regions = $this->entityManager->getRepository("App\Models\Test\RegionModel")->findBy([ 'Country' => $country_id ]);
        
        return view("region.list", [ "model" => $regions, 'country' => $country ]);
    }

    public function getAll($country_id){
        $regions = $this->entityManager->getRepository("App\Models\Test\RegionModel")->findBy([ 'Country' => $country_id ]);
        $model = [];

        foreach($regions as $region){
            array_push($model, [ "id" => $region->Id, "name" => $region->Name ]);
        }

        return json_encode($model);

    }

}
