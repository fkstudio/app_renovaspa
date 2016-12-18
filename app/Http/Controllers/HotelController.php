<?php

namespace App\Http\Controllers;

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

    public function details($id = null){
        
        if($id == null)
            return redirect("/");

        $hotel = $this->entityManager->getRepository("App\Models\HotelModel")->findOneBy([ 'Id' => $id]);

        return view("hotel.details", ['model' => $hotel]);

    }

}
