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
    | Region Controller
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

    /* /GET */
    /* get all regions by current country */
    public function regionsByCountry(Request $request, $country_id){
        $session = $request->session();
        $session->put("country_id", $country_id);
        
        $country = $this->entityManager->getRepository("App\Models\Test\CountryModel")->findOneBy([ 'Id' => $country_id ]);
        $regions = $this->entityManager->getRepository("App\Models\Test\RegionModel")->findBy([ 'Country' => $country_id ]);

        $session->put('currency', $country->Currency->Name);
        $session->put('currency_symbol', $country->Currency->Symbol);
        
        return view("region.list", [ "model" => $regions, 'country' => $country ]);
    }

    /* /GET */
    /* get all regions by country in json format */
    public function getAll($country_id){
        $regions = $this->entityManager->getRepository("App\Models\Test\RegionModel")->findBy([ 'Country' => $country_id ]);
        $model = [];

        foreach($regions as $region){
            array_push($model, [ "id" => $region->Id, "name" => $region->Name ]);
        }

        return json_encode($model);

    }

}
