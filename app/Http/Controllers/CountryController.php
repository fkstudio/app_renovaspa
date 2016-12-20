<?php

namespace App\Http\Controllers;

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

    public function __construct(){
        $this->dbcontext = new DbContext();
        $this->entityManager = $this->dbcontext->getEntityManager();
    }

    public function countries(){
        $countries = $this->entityManager->getRepository("App\Models\Test\CountryModel")->findAll();
        
        return view("country.list", [ "model" => $countries ]);
    }

    public function getAll(){
        $countries = $this->entityManager->getRepository("App\Models\CountryModel")->findAll();
        $model = [];

        foreach($countries as $country){
            array_push($model, [ "id" => $country->Id, "name" => $country->Name ]);
        }

        return json_encode($model);

    }

}
