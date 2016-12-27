<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Database\DbContext;
use App\Models\CountryModel;
use App\Classes\gwapi;


class PaymentController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Payment Controller
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

    /* /POST */
    /* save reservation data and choose about the next step, paypal, redsys or paymentGateway */
    public function payment(Request $request){
        $session = $request->session();
        $sessionId = $session->getId();

        $session->put('reservation_customer_name',  $_POST['first_name'] . ' ' . $_POST['last_name']);
        $session->put('reservation_email', $_POST['email']);
        $session->put('payment_method', $_POST['payment_method']);

        $paymentMethod = $this->entityManager->getRepository('App\Models\Test\PaymentMethodModel')->findOneBy(['Id' => $_POST['payment_method']]);
        $reservation = $this->entityManager->getRepository('App\Models\Test\ReservationModel')->findOneBy(['Id' => $session->get('current_reservation_id')]);

        /* if paymment method is null return error */
        if($paymentMethod == null){
            // redirect payment method error
            echo 'payment method error';
            return;
        }

        /* if reservation is != null proceed with the logic */
        if($reservation != null){
            $reservation->CustomerName = $session->get('reservation_customer_name');
            $reservation->CustomerEmail = $_POST['email'];
            $reservation->PaymentMethod = $paymentMethod;

            $this->entityManager->persist($reservation);
            $this->entityManager->flush();    

            if($paymentMethod->Name == 'Paypal'){
                // redirect
                return redirect()->route('payment.paypal');
            }
            else if($paymentMethod->Name == 'Credit card'){
                // redirect
                return redirect()->route('payment.gateway');
            }
        }
        else{
            // redirect to reservation error
            echo 'reservation error';
            return;
        }
    }

    /* /GET */ 
    /* return a view to fill credit card data */
    public function gatewayPayment(Request $request){
        return view('payment.cardinfo');
    }

    /* /POST */
    /* execute a payment by paymentGateway API */
    public function execGatewayPayment(Request $request){
        /* if each filed is fill proceed with the logic */
        if(!empty($_POST['card_name']) or !empty($_POST['card_number']) or !empty($_POST['year']) or !empty($_POST['month']) or !empty($_POST['cvv'])){
            
            $session = $request->session();
            $sessionId = $session->getId();
            $currency = $session->get('currency');
            $currencySymbol = $session->get('currency_symbol');
    

            $reservation = $this->entityManager->getRepository('App\Models\Test\ReservationModel')->findOneBy(['Id' => $session->get('current_reservation_id')]);

            /* payment gateway configuration */
            $gatewayURL = 'https://secure.networkmerchants.com/api/v2/three-step';
            $APIKey = '2F822Rw39fx762MaV7Yy86jXGTC7sCDy';
            
            $paymentGateway = new \App\Classes\gwapi;
            $paymentGateway->setLogin("demo", "password");
            //$paymentGateway->setLogin("renovaspa", "heath1098");

            /* payment data */
            $total = $reservation->Total;
            $cardYear = substr($_POST['year'], -2);
            $expDate = $_POST['month'].'/'.$cardYear;
            $cvv = $_POST['cvv'];
            $cardNumber = $_POST['card_number'];

            /* set billing information */
            $paymentGateway->setBilling($_POST['card_name'] ,"x","","Bavaro", "", "LA",
                "LA",'21000','DR','809-747-2992',"","sales@renovaspa.com",
                "");

            /* set order */
            $paymentGateway->setOrder('Web '.$reservation->ConfirmationNumber,"renovaspa.com",0,0, $reservation->Id, getenv("REMOTE_ADDR"));

            /* execute order */
            $paymentResult = $paymentGateway->doSale($total,$cardNumber,$expDate,$cvv);

            /* check payment status code */
            if($paymentGateway->responses['response_code'] != 100){
                /* error case */
                return redirect()->route('payment.gateway')->with('status', 'Transaction error. Please contact your card provider for more information or try with another card.');
            }   
            else {
                /* success case */
                $reservation->Status = $this->entityManager->getRepository('App\Models\Test\StatusModel')->findOneBy(['Name' => 'Completed']);

                /* update reservation status to completed */
                $this->entityManager->persist($reservation);
                $this->entityManager->flush();

                return redirect()->route('payment.serviceVoucher');
            } 
        }
        else {
            return redirect()->route('payment.gateway')->with('status', 'Invalid info, please fill all fields.');
        }
    }

    public function redsysPayment(){
        echo 'redsysPayment';
    }

    public function paypalPayment(){
        echo 'paypalPayment';
    }


    /* voucher method */
    /* send a voucher about the current reservation */
    public function sendVoucher(Request $request){
        $session = $request->session();
        $sessionId = $session->getId();

        $reservation_id = $session->get('current_reservation_id');
        
        /* if reservation id is null return an error */
        if(!isset($reservation_id) || empty($reservation_id)){
            return redirect()->route('country.list')->with('status', 'There is not voucher to show.');
        }

        $reservation = $this->entityManager->getRepository('App\Models\Test\ReservationModel')->findOneBy(['Id' => $reservation_id]);

        /* if reservation is null return an error */
        if($reservation == null){
            return redirect()->route('country.list')->with('status', 'There is not voucher to show.');
        }

        /* set voucher data */
        $model = [
            'customer_name' => $reservation->CustomerName,
            'customer_email' => $reservation->CustomerEmail,
            'current_date' => new \DateTime("now"),
            'confirmation_number' => $reservation->ConfirmationNumber,
            'author_code' => uniqid(),
            'card_type' => "Credit Card",
            'billing_details' => $reservation->Region->Country->Name,
            'hotel_name' => "Hotel " . $reservation->Hotel->Name . ", " . $reservation->Region->Name . ", " . $reservation->Region->Country->Name,
            'hotel_email' => $reservation->Hotel->NotifyEmail,
            'customer_service_name' => $reservation->Hotel->CustomerServiceName,
            'check_in' => $session->get("arrival"),
            'check_out' => $session->get("departure"),
            'discount' => number_format($reservation->Discount, 2),
            'subtotal' => $reservation->Subtotal,
            'total' => $reservation->Total,
            'currency_symbol' => $reservation->Region->Country->Currency->Symbol
        ];

        foreach($reservation->ServicesDetails as $detail){
            // add price to total amount

            $model['details'][] = array(
              "name" => $detail->CustomerName,
              "quantity" => 1,
              "service" => $detail->Service->Name,
              "appointment_and_time" => $detail->PreferedDate->format('Y/d/m') . ' ' . $detail->PreferedTime->format('h:m:s'),
              "details" => $detail->Cabin->Name,
              "total" => $reservation->Region->Country->Currency->Symbol.number_format($detail->Price, 2)
            );
        }

        /* clear session data */
        $session->flush();

        /* show voucher */
        return view('payment.voucher', $model);
    }

}
