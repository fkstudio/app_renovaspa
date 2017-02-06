<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Database\DbContext;
use App\Models\CountryModel;


class WeddingController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Wedding Controller
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

    public function checkout(Request $request){
        $session = $request->session();
        $session_id = $session->getId();
        $reservation_id = $session->get('current_reservation_id');

        $reservation = $this->entityManager->getRepository("App\Models\Test\ReservationModel")->findOneBy(["Id" => $reservation_id]);

        $cart = $this->entityManager->getRepository("App\Models\Test\ShoppingCartModel")->findOneBy(["Session" => $session_id]);

        $breadcrumps = [];

        $viewData = [
            "breadcrumps" => $breadcrumps,
            "model" => $reservation,
            "cart" => $cart
        ];

        return view("wedding.checkout", $viewData);
    }

    public function weddingServices(Request $request){
        $session = $request->session();
        $hotel_id = $session->get('hotel_id');
        $region_id = $session->get('region_id');

        $hotel = $this->entityManager->getRepository("App\Models\Test\HotelModel")->findOneBy(["Id" => $hotel_id]);
        $region = $this->entityManager->getRepository("App\Models\Test\RegionModel")->findOneBy(["Id" => $region_id]);
        $country = $this->entityManager->getRepository("App\Models\Test\CountryModel")->findOneBy(["Id" => $session->get('country_id')]);

        $breadcrumps = [
                $region->Country->Name => '/country/'. $region->Country->Id . '/regions',
                $region->Name => '/region/'. $region->Id . '/hotels',
                $hotel->Name => '/hotel/' . $hotel->Id . '/categories',
                'WEDDING SERVICES' => '#fakelink'
            ];

        $categories = $this->entityManager->getRepository('App\Models\Test\WeddingPackageCategoryHotelModel')->findBy(['Hotel' => $hotel->Id]);

        return view('wedding.services', [ 'breadcrumps' => $breadcrumps, 'model' => $categories, 'country' => $country ]);
    }


}
