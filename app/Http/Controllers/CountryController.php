<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Database\DbContext;
use App\Models\CountryModel;


class CountryController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Country Controller
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

    /* get all countries */
    public function countries(Request $request){
        $countries = $this->entityManager->getRepository("App\Models\Test\CountryModel")->findAll();

        $breadcrumps = [
            'COUNTRIES' => '#fakelink'
        ];
        
        return view("country.list", [ "model" => $countries, 'breadcrumps' => $breadcrumps ]);
    }

    /* get all countries in json format */
    public function getAll(){
        $countries = $this->entityManager->getRepository("App\Models\CountryModel")->findAll();
        $model = [];

        foreach($countries as $country){
            array_push($model, [ "id" => $country->Id, "name" => $country->Name ]);
        }

        return json_encode($model);

    }

}
