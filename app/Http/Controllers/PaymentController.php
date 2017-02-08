<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Database\DbContext;
use App\Models\CountryModel;
use App\Classes\gwapi;
use Mail;


class PaymentController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Payment Controller
    |--------------------------------------------------------------------------
    */

    private $dbcontext;
    private $entityManager;
    private $emailService;

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
        $reservationType = $session->get('reservation_type');
        $reservation_id = $session->get('current_reservation_id');


        try {
            // check valid data
            if(!isset($_POST["payment_method"]) || empty($_POST['first_name']) || empty($_POST['last_name']) || empty($_POST['email']) || empty($_POST["country"])){
                return redirect()->route("reservation.checkout")->with("failure", "Invalid data. Please fill the fields correctly.");
            }

            
            $session->put('reservation_customer_name',  $_POST['first_name'] . ' ' . $_POST['last_name']);
            $session->put('reservation_email', $_POST['email']);
            $session->put('payment_method', $_POST['payment_method']);

            $paymentMethod = $this->entityManager->getRepository('App\Models\Test\PaymentMethodModel')->findOneBy(['Id' => $_POST['payment_method']]);
            $reservation = $this->entityManager->getRepository('App\Models\Test\ReservationModel')->findOneBy(['Id' => $session->get('current_reservation_id')]);

            /* if paymment method is null return error */
            if($paymentMethod == null){
                // redirect payment method error
                return redirect()->route('reservation.checkout')->with('failure', trans('messages.select_payment_method'));
            }

            /* if reservation is != null proceed with the logic */
            if($reservation != null){

                $reservation->PaymentMethod = $paymentMethod;

                if($reservationType == 2){
                    if(empty($_POST['customer_first_name']) or
                       empty($_POST['customer_last_name']) or
                       empty($_POST['customer_email']) or
                       empty($_POST["customer_email_confirmation"]) )
                        return redirect()->route("reservation.checkout")->with("failure", trans("messages.invalid_data"));
                    else if ($_POST["customer_email"] != $_POST["customer_email_confirmation"])
                        return redirect()->route("reservation.checkout")->with("failure", trans("messages.email_doesn_match"));

                    $reservation->CertificateFirstName = $_POST["customer_first_name"];
                    $reservation->CertificateLastName = $_POST["customer_last_name"];
                    $reservation->CertificateEmail = $_POST["customer_email"];
                    $reservation->CertificateMI = $_POST["customer_MI"];
                }

                // complete reservation data
                $reservation->PaymentInformation->FirstName = $_POST['first_name'];
                $reservation->PaymentInformation->LastName = $_POST['last_name'];
                $reservation->PaymentInformation->CustomerEmail = $_POST['email'];
                $reservation->PaymentInformation->PostCode = $_POST["post_code"];
                $reservation->PaymentInformation->PhoneNumber = $_POST["phone_number"];
                $reservation->PaymentInformation->CountryName = $_POST["country"];
                $reservation->PaymentInformation->CompanyName = $_POST["company_name"];
                $reservation->PaymentInformation->StreetAddress = $_POST["street_address"];
                $reservation->PaymentInformation->TownCity = $_POST["city"];
                $reservation->PaymentInformation->ApartmentUnit = $_POST["apartment_unit"];

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
        catch (\Exception $e){
            return redirect()->route('reservation.checkout')->with('failure', trans('messages.session_expired'));
        }
    }

    /* /GET */ 
    /* return a view to fill credit card data */
    public function gatewayPayment(Request $request){
        $session = $request->session();

        try {
            $reservation_id = $session->get('current_reservation_id');
            $reservation = $this->entityManager->getRepository('App\Models\Test\ReservationModel')->findOneBy(['Id' => $reservation_id]);

            $total = $reservation->Total;
            $country = $reservation->Region->Country;

            return view('payment.cardinfo', [ 'country' => $country, 'total' => number_format($total, 2) ]);
        }
        catch (\Exception $e){
            return redirect()->route('home.home');
        }
    }

    /* /POST */
    /* execute a payment by paymentGateway API */
    public function execGatewayPayment(Request $request){
        /* if each filed is fill proceed with the logic */

        try {
            if(!empty($_POST['card_name']) or !empty($_POST['card_number']) or !empty($_POST['month_year']) or !empty($_POST['cvc'])){

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

                $expData = explode(' / ', $_POST['month_year']);
                if(count($expData) <= 0)
                    return redirect()->route('payment.gateway')->with('failure', trans('messages.invalid_card_data'));

                $expDate = $expData[0].'/'.$expData[1];
                $cvc = $_POST['cvc'];
                $cardNumber = $_POST['card_number'];

                /* set billing information */
                $paymentGateway->setBilling($_POST['card_name'] ,"x","","Bavaro", "", "LA",
                    "LA",'21000','DR','809-747-2992',"","sales@renovaspa.com",
                    "");

                /* set order */
                $paymentGateway->setOrder('Web '.$reservation->ConfirmationNumber,"renovaspa.com",0,0, $reservation->Id, getenv("REMOTE_ADDR"));

                /* execute order */
                $paymentResult = $paymentGateway->doSale($total,$cardNumber,$expDate,$cvc);

                /* check payment status code */
                if($paymentGateway->responses['response_code'] != 100){
                    /* error case */
                    $session->flash('failure', trans('messages.transaction_error'));
                    return redirect()->route('payment.gateway');
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
                return redirect()->route('payment.gateway')->with('failure', trans('messages.invalid_data'));
            }
        }
        catch (\Exception $e){
            return redirect()->route('home.home')->with('failure', trans('messages.session_expired'));
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
        $voucher = "";

        try {
            /* if reservation id is null return an error */
            if(!isset($reservation_id) || empty($reservation_id)){
                return redirect()->route('/')->with('failure', 'There is not voucher to show.');
            }

            $reservation = $this->entityManager->getRepository('App\Models\Test\ReservationModel')->findOneBy(['Id' => $reservation_id]);

            /* if reservation is null return an error */
            if($reservation == null){
                return redirect()->route('/')->with('failure', 'There is not voucher to show.');
            }

            /* set voucher data */
            $model = [
                'customer_name' => $reservation->PaymentInformation->FirstName,
                'customer_email' => $reservation->PaymentInformation->CustomerEmail,
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
                'currency_symbol' => $reservation->Region->Country->Currency->Symbol,
                'details' => []
            ];

            /* individual services voucher info */
            if($reservation->Type == 1){
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

                /* get services voucher as html sring */
                $voucher = (string) \View::make('payment._voucher', $model)->render();
            }
            /* certificate voucher info */
            else if ($reservation->Type == 2){
                foreach($reservation->CertificateDetails as $key => $detail){
                    $model['details'][$key] = array(
                        'from_customer' => $detail->FromCustomerName,
                        'to_customer' => $detail->ToCustomerName,
                        'confirmation_number' => $reservation->ConfirmationNumber,
                        'price' => number_format($detail->Value)
                    );

                    if($detail->Type == 1){
                        $model['details'][$key]['type'] = 'Email';
                    }
                    else if($detail->Type == 2){
                        $model['details'][$key]['type'] = "Print";
                    }
                    else if ($detail->Type == 3){
                        $model['details'][$key]['type'] = "Hotel";
                    }
                }

                /* get certificate voucher as html string */
                $voucher = (string) \View::make('payment._certificate_voucher', $model)->render();
            }



            /* clear session data */
            $session->flush();

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
                $message->from('hiobairo1993@gmail.com', 'Renovaspa');
                $message->sender('info@renovaspa.com', 'Renovaspa');
                $message->to($reservation->PaymentInformation->CustomerEmail, $reservation->PaymentInformation->FirstName . ' ' . $reservation->PaymentInformation->LastName);
                $message->replyTo('info@renovaspa.com', 'Renovaspa');
                $message->subject("Renova Spa voucher confirmation # " . $reservation->ConfirmationNumber);
            });

            if($reservation->Type == 1){
                /* show voucher */
                return view('payment.voucher_content', $model);
            }
            else if ($reservation->Type == 2){
                return view('payment.certificate_voucher_content', $model);
            }
        }
        catch (\Exception $e){
            return redirect()->route('home.home')->with('failure', 'Your session has expired.');
        }
    }
}
