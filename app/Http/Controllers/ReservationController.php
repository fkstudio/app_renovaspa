<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Database\DbContext;
use App\Models\CountryModel;


class ReservationController extends Controller
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

    private function getCountries(){
        $countries = $this->entityManager->getRepository("App\Models\Test\CountryModel")->findAll();
        
        return $countries;
    }

    public function bookhere(){
        return view("reservation.bookhere", [ 'countries' => $this->getCountries() ]);
    }

}
