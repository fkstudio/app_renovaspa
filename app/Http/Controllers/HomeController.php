<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

    public function home(Request $request){
        $request->session()->flush();
        return view("home/index", [ 'margin' => true ]);
    }

    public function select(Request $request, $selection){
        $session = $request->session();

        $request->session()->flush();
        $request->session()->regenerate();

        switch ($selection) {
            case 'services':
                $session->put('reservation_type', 1);
                break;
            case 'certificates':
                $session->put('reservation_type', 2);
                break;
            case 'weddings':
                $session->put('reservation_type', 3);
                break;
            default:
                $session->put('reservation_type', 1);
                break;
        }

        return redirect()->route('country.list');
    }

    public function about(){
    	return view("home/about");
    }

}
