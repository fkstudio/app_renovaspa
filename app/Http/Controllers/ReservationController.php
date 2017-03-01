<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Database\DbContext;


class ReservationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Reservation Controller
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
    


    /* */
    public function bookhere(){
        $countries = $this->entityManager->getRepository("App\Models\Test\CountryModel")->findAll();
        return view("reservation.bookhere", [ 'countries' => $countries ]);
    }

    /* POST */
    public function selectBook(Request $request){
        $session = $request->session();
        $sessionId = $session->getId();

        if(empty($_POST['reservation_type']) || empty($_POST['country_id']) || empty($_POST['region_id']) || empty($_POST['hotel_id'])){
            $session->flash('failure', trans('messages.must_select_all_fields'));
            return \Redirect::to(\URL::previous());
        }

        if($_POST['reservation_type'] == 3 && empty($_POST['wedding_package_id'])){
            $session->flash('failure', trans('messages.must_select_all_fields'));
            return \Redirect::to(\URL::previous());
        }

        $session->put('country_id', $_POST["country_id"]);
        $session->put('region_id', $_POST["region_id"]);
        $session->put('hotel_id', $_POST["hotel_id"]);

        $dates = explode(' - ', $_POST['arrival_departure']);
        $session->put('arrival', $dates[0]);
        $session->put('departure', $dates[1]);

        switch ($_POST['reservation_type']) {
            case 1:
                return redirect()->route('category.categoriesByHotel', [ 'hotel_id' => $_POST['hotel_id'] ]);
                break;
                
            case 2:
                return redirect()->route('certificate.options', [ 'hotel_id' => $_POST['hotel_id'] ]);
                break;
            case 3:
                if($_POST["wedding_package_id"] != 'nopackage'){
                    $session->flash("riu_wedding_package_id", $_POST["wedding_package_id"]);
                    return redirect()->route('cart.addRiuPackage');
                }
                
                return redirect()->route('category.categoriesByHotel', [ 'hotel_id' => $_POST['hotel_id'] ]);
                break;
        }
        

    }

    /* return a view to complete reservation data */
    public function checkout(Request $request){
        $session = $request->session();
        $sessionId = $session->getId();
        $reservationType = $session->get('reservation_type');
        $reservation_id = $session->get('current_reservation_id');

        try {

            $reservation = null;

            if($request->isMethod('post')){

                /* get hotel data */
                $hotel = $this->entityManager->getRepository('App\Models\Test\HotelModel')->findOneBy(['Id' => $session->get('hotel_id')]);

                $region = $this->entityManager->getRepository('App\Models\Test\RegionModel')->findOneBy(['Id' => $session->get('region_id')]);

                $status = $this->entityManager->getRepository('App\Models\Test\StatusModel')->findOneBy(['Name' => 'Pending']);

                /* check if the region, hotel and status are valid */
                if($hotel == null or $region == null or $status == null){  
                    return redirect()->route("cart.myCart")->with("failure", "An error found. Invalid data.", 1);
                }
                    
                /* fill reservation data */
                $reservation = new \App\Models\Test\ReservationModel();
                $reservation->Type = $reservationType;
                $reservation->Region = $region;
                $reservation->Hotel = $hotel;
                $reservation->ConfirmationNumber = \App\Classes\Utilities::getConfirmationNumber(8);
                $reservation->Arrival = new \DateTime($session->get('arrival'));
                $reservation->Departure = new \DateTime($session->get('departure'));
                $reservation->Subtotal = 0;
                $reservation->Total = 0;
                $reservation->Status = $status;
                $reservation->Created = new \DateTime();
                $reservation->Modified = new \DateTime();
                $reservation->IsDeleted = false;

                /* add payment information */
                $paymentInformation = new \App\Models\Test\PaymentInformationModel();                

                /* save reservation */
                $this->entityManager->persist($reservation);

                /* get shopping cart */
                $cart = $this->entityManager->getRepository('App\Models\Test\ShoppingCartModel')->findOneBy(['Session' => $session->getId()]);

                if($reservationType == 1 || $reservationType == 3){

                    foreach($_POST['id'] as $key => $item){
                        if(empty($_POST['id'][$key]) or 
                           count($_POST['customer_name'][$key]) <= 0 or
                           empty($_POST['prefered_date'][$key]) or
                           empty($_POST['prefered_time'][$key]) or
                           empty($_POST["cabin_type"][$key]))
                            return redirect()->route("cart.checkout")->with("failure", trans("messages.invalid_data"));
                            
                        /* get cart item */
                        $cartItem = $this->entityManager->getRepository('App\Models\Test\ShoppingCartItemModel')->findOneBy(['Id' => $item]);

                        if($cartItem == null)
                            return redirect()->route('home.home')->with('failure', trans('messages.session_expired'));

                        /* complete cart item data */
                        $cartItem->CustomerName = implode(", ", $_POST['customer_name'][$key]);
                        $cartItem->PreferedDate = new \DateTime($_POST['prefered_date'][$key]);
                        $cartItem->PreferedTime = new \DateTime($_POST['prefered_time'][$key]);
                        $cartItem->Cabin = $this->entityManager->getRepository('App\Models\Test\CabinModel')->findOneBy(['Id' => $_POST["cabin_type"][$key]]);


                        /* save cart item with new data */
                        $this->entityManager->persist($cartItem);
                        $this->entityManager->flush();

                        /* create reservation or loocking for it in database */
                        $reservationItem = null;
                        $reservationItemExists = $this->entityManager->getRepository('App\Models\Test\ReservationItemModel')->findOneBy(['CartItem' => $item]);

                        if($reservationItemExists != null)
                            $reservationItem = $reservationItemExists;
                        else
                            $reservationItem = new \App\Models\Test\ReservationItemModel();

                        
                        $packageRelation = $cartItem->PackageCategoryRelation;

                        if($packageRelation != null){
                            foreach($packageRelation->WeddingPackage->WeddingPackageServices as $packageService){
                                /* fill reservation item data */
                                $reservationItem->CartItem = $cartItem;
                                $reservationItem->Reservation = $reservation;
                                $reservationItem->Service = $packageService->Service;
                                $reservationItem->CustomerName = $cartItem->CustomerName;
                                $reservationItem->PreferedDate = $cartItem->PreferedDate;
                                $reservationItem->PreferedTime = $cartItem->PreferedTime;
                                $reservationItem->Price = $packageService->Service->getPrice($reservation->Hotel->Id);
                                $reservationItem->Cabin = $cartItem->Cabin;
                                $reservationItem->Created = new \DateTime();
                                $reservationItem->Modified = new \DateTime();
                                $reservationItem->IsDeleted = false;

                                $reservation->ServicesDetails[] = $reservationItem;
                            }

                            $reservation->Subtotal += $packageRelation->getPlanePrice();
                            $reservation->Total += $packageRelation->getPrice();
                        }
                        else{
                            /* fill reservation item data */
                            $reservationItem->CartItem = $cartItem;
                            $reservationItem->Reservation = $reservation;
                            $reservationItem->Service = $cartItem->Service;
                            $reservationItem->CustomerName = $cartItem->CustomerName;
                            $reservationItem->PreferedDate = $cartItem->PreferedDate;
                            $reservationItem->PreferedTime = $cartItem->PreferedTime;
                            $reservationItem->Price = $cartItem->Service->getPrice($reservation->Hotel->Id);
                            $reservationItem->Cabin = $cartItem->Cabin;
                            $reservationItem->Created = new \DateTime();
                            $reservationItem->Modified = new \DateTime();
                            $reservationItem->IsDeleted = false;

                            $reservation->Subtotal += $reservationItem->Service->getPlanePrice($hotel->Id);
                            $reservation->Total += $reservationItem->Service->getPrice($hotel->Id);
                            
                            $reservation->ServicesDetails[] = $reservationItem;
                        }
                    }
                }
                else if ($reservationType == 2){
                    
                    foreach($_POST['certificate_number'] as $key => $value){
                        $certificateItem = new \App\Models\Test\CertificateDetailModel();

                        $certType = $session->get('certificate_type');
                        $totalValue = 0;
                        
                        $certificateItem->Reservation = $reservation;
                        $certificateItem->Type = $certType;

                        /* if services based */
                        if($certType == 1){
                            /* cart items */
                            $cartItems = $this->entityManager->getRepository('App\Models\Test\ShoppingCartItemModel')
                                                         ->findBy(['Cart' => $cart->Id, 'CertificateNumber' => $value]);

                            /* get total price*/
                            foreach($cartItems as $item){
                                $totalValue += $item->Service->getPrice($reservation->Hotel->Id) * $item->Quantity;

                                /* add services to certificate item */
                                $certificateDetailService = new \App\Models\Test\CertificateDetailServiceModel();
                                $certificateDetailService->CertificateDetail = $certificateItem;
                                $certificateDetailService->Service = $item->Service;

                                $certificateItem->CertificateDetailServices[] = $certificateDetailService;
                            }
                        }
                        /* if value based */
                        else if($certType == 2){
                            $cartItem = $this->entityManager->getRepository('App\Models\Test\ShoppingCartItemModel')
                                                         ->findOneBy(['Cart' => $cart->Id, 'CertificateNumber' => $value + 1]);

                            if($cartItem == null)
                                return redirect()->route('certificate.registration')->with("failure", "Invalid certificate data");
                                
                            $totalValue = $cartItem->Value;
                        }
                        else
                            return redirect()->route('home.home')->with("failure", "Error Processing Request");
                            
                        
                        $certificateItem->Value = $totalValue;
                        $certificateItem->CertificateNumber = $key;
                        $certificateItem->FromCustomerName = $_POST['from_customer'][$key];
                        $certificateItem->ToCustomerName = $_POST['to_customer'][$key];
                        $certificateItem->Message = $_POST['message'][$key];
                        $certificateItem->SendType = $_POST['sendType'][$key];
                        $certificateItem->OtherFields = "";
                        $certificateItem->Created = new \DateTime();
                        $certificateItem->Modified = new \DateTime();
                        $certificateItem->Enabled = true;
                        $certificateItem->IsDeleted = false;

                        if($certificateItem->SendType == 1){
                            /* check if the data is not empty */
                            if(empty($_POST['delivery_email'][$key]) or empty($_POST['delivery_email_confirmation'][$key]))
                                return redirect()->route('certificate.registration')->with('failure', trans('messages.invalid_data'));
                           
                            /* verify if the emails are equals */
                            if($_POST['delivery_email'][$key] != $_POST['delivery_email_confirmation'][$key])
                                return redirect()->route('certificate.registration')->with('failure', trans('messages.email_doesn_match'));

                            /* complete email delivery information */
                            $certificateItem->DeliveryEmail = $_POST['delivery_email'][$key];
                        }
                        else {
                            /* check it the data is not empty */

                            /* complete hotel delivery information */
                            $certificateItem->DeliveryNumberOrAgency = $_POST['delivery_number_or_agency'][$key];
                            $certificateItem->DeliveryCompanyName = $_POST['delivery_company_name'][$key];
                            $certificateItem->DeliveryDepartureDate = new \DateTime($_POST['delivery_departure_date'][$key]);
                            $certificateItem->DeliveryOtherInfo = $_POST['delivery_other_info'][$key];
                        }

                        /* set subtotal and total certificate item */
                        $reservation->Subtotal += $certificateItem->Value;
                        $reservation->Total += $certificateItem->Value;

                        $reservation->CertificateDetails[] = $certificateItem;  
                    } 
                }

                $this->entityManager->flush();

                $session->put('current_reservation_id', $reservation->Id);
            }
            else {
                $reservation = $this->entityManager->getRepository('App\Models\Test\ReservationModel')->findOneBy(['Id' => $reservation_id]);
            }

            $breadcrumps = [
                'SHOPPING CART' => '/shopping/cart',
                'CHECKOUT' => '/shopping/cart/checkout',
                'INFORMATION' => '#fakelink'
            ];

            if($reservationType == 3)
                return redirect()->route("wedding.checkout");  
            else {
                $paymentMethods = $this->entityManager->getRepository('App\Models\Test\PaymentMethodModel')->findAll();

                return view("reservation.checkout", [ 'model' => $reservation, 'breadcrumps' => $breadcrumps,  'paymentMethods' => $paymentMethods ]);    
            }
        }
        catch (\Exception $e){
            return redirect()->route('home.home')->with("failure", 'Your session has expired.');
        }
    }

    /* GET transaction canceled view */
    public function canceled(Request $request){
        $session = $request->session();
        $session->flush();
        return view('reservation.canceled');
    }

}
