<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Database\DbContext;
use App\Models\CountryModel;
use Mail;


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

    public function checkout(Request $request){
        $session = $request->session();
        $session_id = $session->getId();
        $reservation_id = $session->get('current_reservation_id');


        try {
            $reservation = $this->entityManager->getRepository("App\Models\Test\ReservationModel")->findOneBy(["Id" => $reservation_id]);

            $cart = $this->entityManager->getRepository("App\Models\Test\ShoppingCartModel")->findOneBy(["Session" => $session_id]);

            $breadcrumps = [
                'CHECKOUT' => '#fakelink'
            ];

            $viewData = [
                "breadcrumps" => $breadcrumps,
                "model" => $reservation,
                "cart" => $cart
            ];

            return view("wedding.checkout", $viewData);
        }
        catch(\Exception $e){
            return redirect()->route('home.home')->with('failure', trans('messages.session_expired'));
        }
    }

    /* POST */
    public function getWeddingPackagesByHotel($hotel_id){
        $model = [];

        $queryBuilder = $this->entityManager->getRepository('App\Models\Test\WeddingPackageCategoryRelationModel')->createQueryBuilder('a');


        $queryBuilder->leftJoin('a.WeddingPackageCategoryHotel', 'weddingPackageCategoryHotel')
                     ->leftJoin('a.WeddingPackage', 'WeddingPackage')
                     ->where('weddingPackageCategoryHotel.Hotel = :hotel_id')
                     ->andwhere('WeddingPackage.Type = :package_type')
                     ->setParameters(['hotel_id' => $hotel_id, 'package_type' => 1]);

        $queryResult = $queryBuilder->getQuery()->getResult();
        
        foreach($queryResult as $weddingPackageCategoryRelation){
            array_push($model, [ "id" => $weddingPackageCategoryRelation->Id, "name" => $weddingPackageCategoryRelation->WeddingPackage->Name ]);   
        }

        return json_encode($model);

    }

    public function weddingServices(Request $request){
        $session = $request->session();
        $hotel_id = $session->get('hotel_id');
        $region_id = $session->get('region_id');

        $cart = $this->getCart($request->session()->getId());

        $hotel = $this->entityManager->getRepository("App\Models\Test\HotelModel")->findOneBy(["Id" => $hotel_id]);
        $region = $this->entityManager->getRepository("App\Models\Test\RegionModel")->findOneBy(["Id" => $region_id]);
        $country = $this->entityManager->getRepository("App\Models\Test\CountryModel")->findOneBy(["Id" => $session->get('country_id')]);

        $breadcrumps = [
                $region->Country->Name => '/country/'. $region->Country->Id . '/regions',
                $region->Name => '/region/'. $region->Id . '/hotels',
                $hotel->Name => '/hotel/' . $hotel->Id . '/categories',
                'WEDDING SERVICES' => '#fakelink'
            ];

        $queryBuilder = $this->entityManager->getRepository('App\Models\Test\WeddingPackageCategoryHotelModel')->createQueryBuilder('c');

        $queryBuilder->leftJoin('c.WeddingPackageCategory', 'weddingPackageCategory')
                     ->leftJoin('c.Hotel', 'Hotel')
                     ->where('Hotel.Id = :hotel_id')
                     ->andwhere('weddingPackageCategory.Name != :category_name')
                     ->orderBy('weddingPackageCategory.Ordinal', 'ASC')
                     ->setParameters(['hotel_id' => $hotel->Id, 'category_name' => 'RIU WEDDING PACKAGES']);

        $categories = $queryBuilder->getQuery()->getResult();

        return view('wedding.services', [ 'breadcrumps' => $breadcrumps, 'model' => $categories, 'country' => $country, 'mycart' => $cart ]);
    }

    public function sendQuotation(Request $request){
        $session = $request->session();
        $session_id = $session->getId();
        $reservation_id = $session->get('current_reservation_id');

        try {

            if($reservation_id == null){
                return redirect()->route('home.home')->with('failure', trans('messages.session_expired'));
            }
            
            /* cart */
            $cart = $this->entityManager->getRepository("App\Models\Test\ShoppingCartModel")->findOneBy(["Session" => $session_id]);
            /* get current reservation */
            $reservation = $this->entityManager->getRepository('App\Models\Test\ReservationModel')
                                           ->findOneBy(['Id' => $reservation_id]);

            if($reservation == null)
                return redirect()->route('home.home')->with('failure', trans('messages.session_expired'));

            /* complete reservation data */
            $reservation->CertificateFirstName = $_POST['first_name'];
            $reservation->CertificateLastName = $_POST['last_name'];
            $reservation->BrideName = $_POST['bride_full_name'];
            $reservation->GroomName = $_POST['groom_full_name'];
            $reservation->Email = $_POST['email'];

            $dateParts = explode('/', $_POST['wedding_date']);
            
            if(empty($_POST['wedding_date'])){
                $reservation->WeddingDate = null;
            }
            else if(count($dateParts) < 3 || count($dateParts) > 3 || checkdate($dateParts[0], $dateParts[1], $dateParts[2]) == false){
                return redirect()->route("cart.checkout")->with('failure', trans('messages.invalid_date'));
            }
            else {
                $reservation->WeddingDate = new \DateTime($_POST['wedding_date']);
            }

            $timeParts = explode(':', $_POST['wedding_time']);

            if(empty($_POST['wedding_time'])){
                $reservation->WeddingTime = null;
            }
            else if(count($timeParts) < 2 || \App\Classes\Utilities::checktime($timeParts[0], $timeParts[1], '00')){
                return redirect()->route("cart.checkout")->with('failure', trans('messages.invalid_time'));
            }
            else {
                $reservation->WeddingTime = new \DateTime($_POST['wedding_time']);
            }

            $reservation->WeddingBillDelivery = $_POST['bill_delivery'];
            $reservation->Remarks = $_POST['remarks'];

            $this->entityManager->persist($reservation);

            $this->entityManager->flush();

            if( empty($_POST['first_name']) || 
                empty($_POST['last_name']) || 
                empty($_POST['bride_full_name']) || 
                empty($_POST['groom_full_name']) || 
                empty($_POST['email']) || 
                empty($_POST['email_confirmation']) || 
                empty($_POST['wedding_date']) || 
                empty($_POST['wedding_time']) || 
                empty($_POST['bill_delivery']))
                return redirect()->route('wedding.checkout')->with('failure', trans('messages.invalid_data'));

            if($_POST['email'] != $_POST['email_confirmation'])
                return redirect()->route('wedding.checkout')->with('failure', trans('messages.email_doesn_match'));


            /* change reservation status to complete */
            $reservation->Status = $this->entityManager->getRepository('App\Models\Test\StatusModel')->findOneBy(['Name' => 'Completed']);

            $this->entityManager->persist($reservation);

            $this->entityManager->flush();

            /* view data */
            $viewData = [
                'model' => $reservation,
                'cart' => $cart
            ];

            /* get wedding quotation as html string */
            $voucher = (string) \View::make('wedding._quotation', $viewData)->render();

            /* mail object */
            $mail = app()['mailer'];

            $mailData = [
                'voucher' => $voucher,
                'reservation' => $reservation
            ];

            /* send voucher view */
            $mail->send([],[], function($message) use ($mailData) {
                $reservation = $mailData['reservation'];
                $message->setBody($mailData['voucher'], 'text/html');
                $message->from(\Config::get('email.info'), 'Renovaspa');
                $message->sender(\Config::get('email.info'), 'Renovaspa');
                $message->to($reservation->Email, $reservation->CertificateFirstName . ' ' . $reservation->CertificateLastName);
                $message->bcc($reservation->Hotel->NotifyEmail, 'Renovaspa');
                $message->replyTo(\Config::get('email.info'), 'Renovaspa');
                $message->subject("Wedding reservation for: " . $reservation->CertificateFirstName . " ".$reservation->CertificateLastName);
            });

            /* clear session data */
            $session->flush();

            return view('wedding.sent', $viewData);
        }
        catch (\Exception $e){
            return redirect()->route('home.home')->with('failure', trans('messages.session_expired'));
        }
    }
}
