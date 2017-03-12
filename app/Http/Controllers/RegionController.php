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
        
        if(empty($country_id))
            return redirect()->route('country.list')->with('failure', trans('messages.select_country'));

        $session = $request->session();
        $session->put("country_id", $country_id);

        try {
            $country = $this->entityManager->getRepository("App\Models\Test\CountryModel")->findOneBy([ 'Id' => $country_id ]);
            $regions = $this->entityManager->getRepository("App\Models\Test\RegionModel")->findBy([ 'Country' => $country_id ], ['Name' => 'ASC']);

            $session->put('currency', $country->Currency->Name);
            $session->put('currency_symbol', $country->Currency->Symbol);

            $breadcrumps = [
                $country->Name => '/country/'. $country->Id . '/regions',
                'REGIONS' => '#fakelink'
            ];
            
            return view("region.list", [ "model" => $regions, 'country' => $country, 'breadcrumps' => $breadcrumps ]);
        }
        catch (\Exception $e){
            return redirect()->route('home.home')->with('failure', 'Your session has expired.');
        }
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
