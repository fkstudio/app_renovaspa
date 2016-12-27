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

        // echo '<pre>';
        // print_r($_POST);
        // echo '</pre>';
        // exit();

        $reservation = null;
        $reservation_id = $session->get('current_reservation_id');

        if($reservation_id != null && $reservation_id != ""){
            $reservation = $this->entityManager->getRepository('App\Models\Test\ReservationModel')->findOneBy(['Id' => $reservation_id]);
        }
        else {
            $reservation = new \App\Models\Test\ReservationModel();

            $reservation->Type = $reservationType;
            $reservation->Region = $this->entityManager->getRepository('App\Models\Test\RegionModel')->findOneBy(['Id' => $session->get('region_id')]);
            $reservation->Hotel = $this->entityManager->getRepository('App\Models\Test\HotelModel')->findOneBy(['Id' => $session->get('hotel_id')]);
            $reservation->ConfirmationNumber = $this->getConfirmationNumber(8);
            $reservation->Arrival = new \DateTime(); // FIXME
            $reservation->Departure = new \DateTime(); // FIXME
            $reservation->Subtotal = 0;
            $reservation->Total = 0;
            $reservation->Status = $this->entityManager->getRepository('App\Models\Test\StatusModel')->findOneBy(['Name' => 'Pending']);
            $reservation->Created = new \DateTime();
            $reservation->Modified = new \DateTime();
            $reservation->IsDeleted = false;

            $this->entityManager->persist($reservation);

            if($reservationType == 1){
                foreach($_POST['id'] as $key => $item){
                    $service = $this->entityManager->getRepository('App\Models\Test\ServiceModel')->findOneBy(['Id' => $item]);
                    
                    $reservationItem = new \App\Models\Test\ReservationItemModel();
                    $reservationItem->Reservation = $reservation;
                    $reservationItem->Service = $service;
                    $reservationItem->CustomerName =  $_POST['customer_name'][$key];
                    $reservationItem->PreferedDate = new \DateTime($_POST['prefered_date'][$key]);
                    $reservationItem->PreferedTime = new \DateTime($_POST['prefered_time'][$key]);
                    $reservationItem->Price = $service->getPrice($reservation->Hotel->Id);

                    $reservationItem->Cabin = $this->entityManager->getRepository('App\Models\Test\CabinModel')->findOneBy(['Id' => $_POST["cabin_type"][$key]]);
                    $reservationItem->Created = new \DateTime();
                    $reservationItem->Modified = new \DateTime();
                    $reservationItem->IsDeleted = false;

                    $reservation->Subtotal += $reservationItem->Price;
                    $reservation->Total += $reservationItem->Price;
                    
                    $this->entityManager->persist($reservationItem);
                }
            }
            else if ($reservationType == 2){
                $cart = $this->entityManager->getRepository('App\Models\Test\ShoppingCartModel')->findOneBy(['Session' => $session->getId()]);
                
                foreach($_POST['certificate_number'] as $key => $value){

                    $cartItems = $this->entityManager->getRepository('App\Models\Test\ShoppingCartItemModel')
                                                     ->findBy(['Cart' => $cart->Id, 'CertificateNumber' => $value]);
                    $totalValue = 0;
                    
                    foreach($cartItems as $item){
                        $totalValue += $item->Service->getPrice($reservation->Hotel->Id) * $item->Quantity;
                    }

                    // echo $value . '<br/>';
                    // echo $totalValue . '<br/>';
                    // // echo $cartItems[$key]->Service->Name .' ';
                    // // echo $cartItems[$key]->Service->getPrice($reservation->Hotel->Id) * count($cartItems);
                    // echo '<br/>';
                    
                    $certificateItem = new \App\Models\Test\CertificateDetailModel();
                    $certificateItem->Reservation = $reservation;
                    $certificateItem->Type = 1;
                    $certificateItem->Service = $cartItems[0]->Service;
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

                    $this->entityManager->persist($certificateItem);    
                } 
            }

            $this->entityManager->flush();

            $session->put('current_reservation_id', $reservation->Id);
        }

        $paymentMethods = $this->entityManager->getRepository('App\Models\Test\PaymentMethodModel')->findAll();
        return view("reservation.checkout", [ 'model' => $reservation, 'paymentMethods' => $paymentMethods ]);
    }

}
