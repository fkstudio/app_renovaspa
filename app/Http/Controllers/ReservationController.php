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
    /* generate a confirmation number for current reservation */
    private function getConfirmationNumber($length){
        $string = '';
        $characters = '123456789abcdefgABCDAFG';
        $max = strlen($characters) - 1;
        for ($i = 0; $i < $length; $i++) {
            $string .= $characters[mt_rand(0, $max)];
        }

        return $string;
    }

    /* */
    public function bookhere(){
        $countries = $this->entityManager->getRepository("App\Models\Test\CountryModel")->findAll();
        return view("reservation.bookhere", [ 'countries' => $countries ]);
    }

    /* return a view to complete reservation data */
    public function checkout(Request $request){
        $session = $request->session();
        $sessionId = $session->getId();
        $reservationType = $session->get('reservation_type');


        try {
            $reservation = null;
            $reservation_id = $session->get('current_reservation_id');

            if($reservation_id != null && $reservation_id != ""){
                $reservation = $this->entityManager->getRepository('App\Models\Test\ReservationModel')->findOneBy(['Id' => $reservation_id]);
            }
            else {
                /* get hotel data */
                $hotel = $this->entityManager->getRepository('App\Models\Test\HotelModel')->findOneBy(['Id' => $session->get('hotel_id')]);
                /* fill reservation data */
                $reservation = new \App\Models\Test\ReservationModel();
                $reservation->Type = $reservationType;
                $reservation->Region = $this->entityManager->getRepository('App\Models\Test\RegionModel')->findOneBy(['Id' => $session->get('region_id')]);
                $reservation->Hotel = $hotel;
                $reservation->ConfirmationNumber = $this->getConfirmationNumber(8);
                $reservation->Arrival = new \DateTime(); // FIXME
                $reservation->Departure = new \DateTime(); // FIXME
                $reservation->Subtotal = 0;
                $reservation->Total = 0;
                $reservation->Status = $this->entityManager->getRepository('App\Models\Test\StatusModel')->findOneBy(['Name' => 'Pending']);
                $reservation->Created = new \DateTime();
                $reservation->Modified = new \DateTime();
                $reservation->IsDeleted = false;

                /* save reservation */
                $this->entityManager->persist($reservation);

                /* get shopping cart */
                $cart = $this->entityManager->getRepository('App\Models\Test\ShoppingCartModel')->findOneBy(['Session' => $session->getId()]);

                if($reservationType == 1){
                    
                    foreach($_POST['id'] as $key => $item){
                        /* get cart item */
                        $cartItem = $this->entityManager->getRepository('App\Models\Test\ShoppingCartItemModel')->findOneBy(['Id' => $item]);
                        $cartItem->CustomerName = $_POST['customer_name'][$key];
                        $cartItem->PreferedDate = new \DateTime($_POST['prefered_date'][$key]);
                        $cartItem->PreferedTime = new \DateTime($_POST['prefered_time'][$key]);
                        $cartItem->Cabin = $this->entityManager->getRepository('App\Models\Test\CabinModel')->findOneBy(['Id' => $_POST["cabin_type"][$key]]);

                        $this->entityManager->persist($cartItem);

                        $reservationItem = null;
                        $reservationItemExists = $this->entityManager->getRepository('App\Models\Test\ReservationItemModel')->findOneBy(['CartItem' => $item]);

                        if($reservationItemExists != null)
                            $reservationItem = $reservationItemExists;
                        else
                            $reservationItem = new \App\Models\Test\ReservationItemModel();

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
                                throw new \Exception("Invalid certificate data", 1);
                                
                            $totalValue = $cartItem->Value;
                        }
                        else
                            throw new \Exception("Error Processing Request", 1);
                            
                        
                        $certificateItem->Value = $totalValue;
                        $certificateItem->FromCustomerName = $_POST['from_customer'][$key];
                        $certificateItem->ToCustomerName = $_POST['to_customer'][$key];
                        $certificateItem->Message = $_POST['message'][$key];
                        $certificateItem->SendType = $_POST['sendType'][$key];
                        $certificateItem->Arrival = new \DateTime();
                        $certificateItem->Departure = new \DateTime();
                        $certificateItem->OtherFields = "";
                        $certificateItem->Created = new \DateTime();
                        $certificateItem->Modified = new \DateTime();
                        $certificateItem->Enabled = true;
                        $certificateItem->IsDeleted = false;

                        $reservation->Subtotal += $certificateItem->Value;
                        $reservation->Total += $certificateItem->Value;

                        $reservation->CertificateDetails[] = $certificateItem;  
                    } 
                }

                $this->entityManager->flush();

                $session->put('current_reservation_id', $reservation->Id);
            }

            $breadcrumps = [
                'SHOPPING CART' => '#fakelink',
                'RESERVATION' => '#fakelink',
                'INFORMATION' => '#fakelink'
            ];

            $paymentMethods = $this->entityManager->getRepository('App\Models\Test\PaymentMethodModel')->findAll();
            return view("reservation.checkout", [ 'model' => $reservation, 'breadcrumps' => $breadcrumps,  'paymentMethods' => $paymentMethods ]);
        }
        catch (\Exception $e){
            return redirect()->route('home.home')->with('failure', 'Your session has expired.');
        }
    }

}
