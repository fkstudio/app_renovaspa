<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Database\DbContext;
use Doctrine\ORM\Query\ResultSetMapping;


class CategoryController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Category Controller
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

    /* return current user cart instance */
    private function getCart($session_id){

        $cart = null;
        $cartExists = $this->entityManager->getRepository("App\Models\Test\ShoppingCartModel")->findOneBy(['Session' => $session_id]);

        if($cartExists == null){
            $cart = new \App\Models\Test\ShoppingCartModel();
            $cart->Session = $session_id;
            $cart->Created = new \DateTime();
            $cart->IsDeleted = false;
        }
        else
            $cart = $cartExists;

        return $cart;
    }

    /* get all categories */
    public function categories(Request $request, $region_id){
        $regionServices = $this->entityManager->getRepository("App\Models\Test\CategoryCountryModel")->findBy(["Region" => $region_id]);

        return view("category.list", [ "model" => $regionServices ]);
    }

    /* get all categories async to return json boject */
    public function getAll(Request $request, $country_id){
        $categoryCountries = $this->entityManager->getRepository("App\Models\Test\CategoryCountryModel")->findBy(["Country" => $country_id]);

        $model = [];

        foreach($categoryCountries as $categoryCountry){
            array_push($model, [ "id" => $categoryCountry->Category->Id, "name" => $categoryCountry->Category->Name ]);
        }

        return json_encode($model);
    }

    /* get a list of available categories in current hotel */
    public function categoriesByHotel(Request $request, $hotel_id, $next = 0){
        $session = $request->session();
        $session->put("hotel_id", $hotel_id);
        $reservationType = $session->get('reservation_type');

        $cart = $this->getCart($session->getId());

        if($reservationType == null){
            return redirect()->route('home.home');
        }

        try {
            if($next != 0){
                if($reservationType == 2 && $next != $session->get('current_certificate') && $next <= $session->get('certificate_quantity')){
                    $session->put('current_certificate', ( $session->pull('current_certificate') + 1 ));
                }
            }

            $hotel = $this->entityManager->getRepository("App\Models\Test\HotelModel")->findOneBy(["Id" => $hotel_id]);
            $hotelRegion = $this->entityManager->getRepository("App\Models\Test\HotelRegionModel")
                                               ->findOneBy(["Hotel" => $hotel_id]);

            $weddings = $this->entityManager->createQuery("SELECT w FROM App\Models\Test\WeddingPackageCategoryHotelModel w WHERE w.Hotel = :hotel")
                ->setParameter('hotel', $session->get('hotel_id'))
                ->getResult(); 

            $categoryCountries = $this->entityManager->createQuery('SELECT cc FROM App\Models\Test\CategoryCountryModel cc WHERE cc.Country = :country AND cc.IsDeleted = :deleted AND cc.IsActive = :active
                AND
                ( SELECT count(sch) FROM App\Models\Test\ServiceCategoryHotelModel sch where sch.Category = cc.Category AND sch.Hotel = :hotel AND sch.IsActive = true AND sch.IsDeleted = false) > 0  ORDER BY cc.Order ASC')
                             ->setParameter('deleted', false)
                             ->setParameter('active', true)
                             ->setParameter('country', $hotelRegion->Region->Country->Id)
                             ->setParameter('hotel', $hotelRegion->Hotel->Id)
                             ->getResult();

            $breadcrumps = [
                $hotelRegion->Region->Country->Name => '/country/'. $hotelRegion->Region->Country->Id . '/regions',
                $hotelRegion->Region->Name => '/region/'. $hotelRegion->Region->Id . '/hotels',
                $hotelRegion->Hotel->Name => '/hotel/' . $hotelRegion->Hotel->Id . '/categories',
                'TREATMENTS' => '#fakelink'
            ];


            $viewData = [ 
                "model" => $categoryCountries, 
                "hotel" => $hotel, 
                "region" => $hotelRegion->Region, 
                'breadcrumps' => $breadcrumps,
                'weddings' => $weddings,
                'mycart' => $cart
            ];

            if($session->get('reservation_type') == 2){
                $session->flash('success', 'Select a treatment for the certificate No. '. $session->get('current_certificate') .' - '. $session->get('certificate_quantity'));
                return view("category.list", $viewData);
            }


            return view("category.list", $viewData);
        }
        catch (\Exception $e){
            return redirect()->route('home.home')->with('failure', 'Your session has expired.');
        }
    }

}
