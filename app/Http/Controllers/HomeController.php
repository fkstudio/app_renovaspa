<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Database\DbContext;


class HomeController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Home Controller
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

    public function home(){
        return view("home/index");
    }

    public function about(){
    	return view("home/about");
    }

}
