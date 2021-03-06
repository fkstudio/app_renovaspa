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
        $session->flush();
        $session->regenerate();
        $sessionId = $session->getId();

        if(empty($_POST['reservation_type']) || empty($_POST['country_id']) || empty($_POST['region_id']) || empty($_POST['hotel_id'])){
            $session->flash('failure', trans('messages.must_select_all_fields'));
            return \Redirect::to(\URL::previous().'#form-content');
        }

        if($_POST['reservation_type'] == 3 && empty($_POST['wedding_package_id'])){
            $session->flash('failure', trans('messages.must_select_all_fields'));
            return \Redirect::to(\URL::previous().'#form-content');
        }

        $session->put('country_id', $_POST["country_id"]);
        $session->put('region_id', $_POST["region_id"]);
        $session->put('hotel_id', $_POST["hotel_id"]);
        $session->put('reservation_type', $_POST['reservation_type']);

        $dates = explode(' - ', $_POST['arrival_departure']);

        if(count($dates) < 2){
            $session->flash('failure', trans('messages.must_select_all_dates'));
            return \Redirect::to(\URL::previous().'#form-content');
        }

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

        // echo '<pre>';
        // print_r($_POST);
        // echo '</pre>';
        // exit();

        try {

            $reservation = null;

            if($request->isMethod('post')){

                /* get hotel data */
                $hotelRegion = $this->entityManager->getRepository('App\Models\Test\HotelRegionModel')->findOneBy(['Region' => $session->get('region_id'), 'Hotel' => $session->get('hotel_id')]);
                
                $hotel = $hotelRegion->Hotel;

                $region = $hotelRegion->Region;

                $status = $this->entityManager->getRepository('App\Models\Test\StatusModel')->findOneBy(['Name' => 'Incompleted']);

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

                    $packages = [];
                    $usedPackages = [];

                    if(isset($_POST['id'])){
                        foreach($_POST['id'] as $key => $item){
                            if(empty($_POST['id'][$key]) or 
                               count($_POST['customer_name'][$key]) <= 0)
                                return redirect()->route("cart.checkout")->with("failure", trans("messages.invalid_data"));
                                
                            if($reservationType == 1 && empty($_POST["cabin_type"][$key])){
                                return redirect()->route("cart.checkout")->with("failure", trans("messages.invalid_data"));
                            }
                            /* get cart item */
                            $cartItem = $this->entityManager->getRepository('App\Models\Test\ShoppingCartItemModel')->findOneBy(['Id' => $item]);

                            if($cartItem == null)
                                return redirect()->route('home.home')->with('failure', trans('messages.session_expired'));

                            /* complete cart item data */
                            $cartItem->CustomerName = implode(", ", $_POST['customer_name'][$key]);

                            $dateParts = explode('/', $_POST['prefered_date'][$key]);
                            
                         
                            if(empty($_POST['prefered_date'][$key])){
                                $cartItem->PreferedDate = null;
                                $cartItem->PreferedTime = null;
                            }
                            else if(count($dateParts) < 3 || count($dateParts) > 3 || checkdate($dateParts[0], $dateParts[1], $dateParts[2]) == false){
                                return redirect()->route("cart.checkout")->with('failure', trans('messages.invalid_date'));
                            }
                            else {
                                $cartItem->PreferedDate = new \DateTime($_POST['prefered_date'][$key]);
                            }

                            
                            if(isset($_POST['prefered_time'][$key]) && $_POST['prefered_time'][$key] != ""){
                                
                                $timeParts = explode(':', $_POST['prefered_time'][$key]);

                                if(count($timeParts) < 2 || \App\Classes\Utilities::checktime($timeParts[0], $timeParts[1], '00')){
                                    return redirect()->route("cart.checkout")->with('failure', trans('messages.invalid_time'));
                                }
                                else {
                                    $cartItem->PreferedTime = new \DateTime($_POST['prefered_time'][$key]);
                                }
                            }
                            else {
                                $cartItem->PreferedTime = null;
                            }
                            
                            if($reservationType == 1){
                                $cartItem->Cabin = $this->entityManager->getRepository('App\Models\Test\CabinModel')->findOneBy(['Id' => $_POST["cabin_type"][$key]]);
                            }
                            else
                                $cartItem->Cabin = null;


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
                                
                                if(!in_array($packageRelation->WeddingPackage->Id, $usedPackages)){
                                    
                                    $packageItems = [];

                                    foreach($packageRelation->WeddingPackage->WeddingPackageServices as $pkey => $packageService){
                                        
                                        $pre_date = ($_POST['prefered_date'][$pkey] != "" ? new \DateTime($_POST['prefered_date'][$pkey]) : null );
                                        $pre_time = ($_POST['prefered_time'][$pkey] != "" ? new \DateTime($_POST['prefered_time'][$pkey]) : null );

                                        $data["customer_name"] = implode(", ", $_POST['customer_name'][$pkey]);
                                        $data["prefered_date"] = $pre_date;
                                        $data["prefered_time"] = $pre_time;

                                        $packageItems[] = $data;
                                        
                                        //echo implode(", ", $_POST['customer_name'][$pkey]).'<br/>';
                                        /* fill reservation item data */
                                        $reservationItem->CartItem = $cartItem;
                                        $reservationItem->Reservation = $reservation;
                                        $reservationItem->Service = $packageService->Service;
                                        $reservationItem->CustomerName = implode(", ", $_POST['customer_name'][$pkey]); // $cartItem->CustomerName;
                                        $reservationItem->PreferedDate = $pre_date; //$cartItem->PreferedDate;
                                        $reservationItem->PreferedTime =  $pre_time; //$cartItem->PreferedTime;
                                        $reservationItem->Price = $packageService->Service->getPrice($reservation->Hotel->Id);
                                        $reservationItem->Cabin = $cartItem->Cabin;
                                        $reservationItem->Created = new \DateTime();
                                        $reservationItem->Modified = new \DateTime();
                                        $reservationItem->IsDeleted = false;

                                        

                                        $reservation->ServicesDetails[] = $reservationItem;
                                    }

                                    $packages[$packageRelation->WeddingPackage->Id] = $packageItems;

                                    

                                    array_push($usedPackages, $packageRelation->WeddingPackage->Id);
                                }
                                
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
                                
                                $reservation->ServicesDetails[] = $reservationItem;
                            }
                        }    
                    }

                    $session->put('packages', $packages);
                    
                }
                else if ($reservationType == 2){
                    
                    foreach($_POST['certificate_number'] as $key => $value){
                        $certificateItem = new \App\Models\Test\CertificateDetailModel();

                        $certType = $session->get('certificate_type');
                        $totalValue = 0;
                        $subTotalValue = 0;
                        
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
                                $subTotalValue += $item->Service->getPlanePrice($reservation->Hotel->Id) * $item->Quantity;

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
                            
                            if($hotelRegion->ActiveDiscount){
                                $discount = ( $hotelRegion->Discount / 100 ) * $cartItem->Value;
                                $totalValue = $cartItem->Value + $discount;
                            }
                            
                            $subTotalValue = $cartItem->Value;
                        }
                        else
                            return redirect()->route('home.home')->with("failure", "Error Processing Request");
                            
                        
                        $certificateItem->Value = $totalValue;
                        $certificateItem->SubTotal = $subTotalValue;
                        $certificateItem->CertificateNumber = $key + 1;
                        $certificateItem->FromCustomerName = $_POST['from_customer'][$key];
                        $certificateItem->ToCustomerName = $_POST['to_customer'][$key];
                        $certificateItem->RealCustomerFirstName = $_POST['real_customer_first_name'];
                        $certificateItem->RealCustomerLastName = $_POST['real_customer_last_name'];
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
                            //$certificateItem->DeliveryDepartureDate = new \DateTime($_POST['delivery_departure_date'][$key]);
                            $certificateItem->DeliveryOtherInfo = $_POST['delivery_other_info'][$key];
                        }

                        $reservation->CertificateDetails[] = $certificateItem;  
                    } 
                }

                /* set total and sub total  */
                $reservation->Total = $reservation->getTotal();
                $reservation->SubTotal = $reservation->getSubTotal();

                $this->entityManager->persist($reservation);

                /* commit all changes */
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
            print_r($e);
            exit();
            return redirect()->route('home.home')->with("failure", 'Your session has expired.');
        }
    }

    /* GET transaction canceled view */
    public function canceled(Request $request){
        $session = $request->session();

        $reservation_id = $session->get('current_reservation_id');

        $reservation = $this->entityManager->getRepository('App\Models\Test\ReservationModel')->findOneBy(['Id' => $session->get('current_reservation_id')]);

        $status = $this->entityManager->getRepository('App\Models\Test\StatusModel')->findOneBy(['Name' => 'Canceled']);

        if($reservation == null)
            return redirect()->route('home.home')->with('failure', 'Your session has expired.');

        $reservation->Status = $status;

        // change reservation status to canceled
        $this->entityManager->persist($reservation);

        return view('reservation.canceled');
    }

}
