<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Database\DbContext;
use App\Models\CountryModel;
use App\Classes\gwapi;
use Mail;

/* paypal namespaces */
use PayPal\Api\Payer;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Details;
use PayPal\Api\Amount;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;



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
    private $siteUrl;

    /* ============================= PUBLIC METHODS ============================= */
    
    /* public class construct */
    public function __construct(){
        $this->siteUrl = \App::make('url')->to('/');
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

                // add payment method to reservation
                $reservation->PaymentMethod = $paymentMethod;

                if($reservationType == 2){
                    if(empty($_POST['customer_first_name']) or
                       empty($_POST['customer_last_name']) or
                       empty($_POST['customer_email']) or
                       empty($_POST["customer_email_confirmation"]) )
                        return redirect()->route("reservation.checkout")->with("failure", trans("messages.invalid_data"));

                    else if ($_POST["customer_email"] != $_POST["customer_email_confirmation"])
                        return redirect()->route("reservation.checkout")->with("failure", trans("messages.email_doesn_match"));

                    // comlete reservation data
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

                // check valid data
                if(!isset($_POST["payment_method"]) || empty($_POST['first_name']) || empty($_POST['last_name']) || empty($_POST['email']) || empty($_POST["country"])){
                    return redirect()->route("reservation.checkout")->with("failure", "Invalid data. Please fill the fields correctly.");
                }

                if($paymentMethod->Name == 'Paypal'){
                    // redirect
                    return redirect()->route('payment.paypal');
                }
                else if($paymentMethod->Name == 'Credit card'){
                    // redirect
                    if($reservation->Region->Country->Currency->Name == "EUR")
                        return redirect()->route('payment.redsysPayment');
                    else
                        return redirect()->route('payment.gateway');
                }
            }
            else{
                // redirect to reservation error
                return redirect()->route('home.home')->with('failure', trans('messages.session_expired'));
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

                // add the last four card numbers to reservation
                $reservation->LastFourCardNumbers = substr($cardNumber, -4);
                $this->entityManager->persist($reservation);
                $this->entityManager->flush();

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


    /* POST Redys (Caxia) payment method */
    public function redsysPayment(Request $request){
        $session = $request->session();
        $sessionId = $session->getId();
        $reservation_id = $session->get('current_reservation_id');

        /* ApiRedsys Object*/
        $redsys = new \App\Classes\ApiRedsys();

        // Redsys payment url
        //$redsysUrl = "https://sis-t.redsys.es:25443/sis/realizarPago"; // UCOOMENT TO TEST
        $redsysUrl = "https://sis.sermepa.es/sis/realizarPago";

        /* get current reservation */
        $reservation = $this->entityManager->getRepository('App\Models\Test\ReservationModel')->findOneBy(['Id' => $reservation_id]);

        /* if reservation is null return an error */
        if($reservation == null){
            return redirect()->route('/')->with('failure', trans('messages.session_expired'));
        }

        // Redsys configuration
        $version = "HMAC_SHA256_V1";
        $sha256Key = "Wpe3AaiANFa7KEZpXJHTge+/Ugs6HJG4";
        $comercialKey = "RP5854MUO552O293";

        $referenceNumber = $reservation->ConfirmationNumber;

        // Input values
        $comercialCodeFunc = "266971159";
        $terminal = "1";
        $currencyCode = "978";
        $transactionType = "0";

        /* redirects url */
        $merchantUrlOk = $this->siteUrl.'/payment/voucher';
        $merchantUrlKo = $this->siteUrl."/reservation/canceled";

        /* set reservation data */
        $redsys->setParameter("DS_MERCHANT_AMOUNT",$reservation->Total);
        $redsys->setParameter("DS_MERCHANT_ORDER", $reservation->ConfirmationNumber);
        $redsys->setParameter("DS_MERCHANT_MERCHANTCODE",$comercialCodeFunc);
        $redsys->setParameter("DS_MERCHANT_CURRENCY",$currencyCode);
        $redsys->setParameter("DS_MERCHANT_TRANSACTIONTYPE",$transactionType);
        $redsys->setParameter("DS_MERCHANT_TERMINAL",$terminal);
        $redsys->setParameter("DS_MERCHANT_MERCHANTURL", $redsysUrl);
        $redsys->setParameter("DS_MERCHANT_URLOK",$merchantUrlOk);
        $redsys->setParameter("DS_MERCHANT_URLKO",$merchantUrlKo);

        $params = $redsys->createMerchantParameters();
        $signature = $redsys->createMerchantSignature($sha256Key);

        /* redirect to temp view  */
        return view("payment.redsys", [ 'url' => $redsysUrl, 'version' => $version, 'params' => $params, 'signature' => $signature ]);
    }

    /* POST payment method */
    public function paypalPayment(Request $request){
        $session = $request->session();
        $sessionId = $session->getId();
        $reservation_id = $session->get('current_reservation_id');
        $subtotal = 0.00;
        $total = 0.00;
       
        try {
            /* if reservation id is null return an error */
            if(!isset($reservation_id) || empty($reservation_id)){
                return redirect()->route('/')->with('failure', trans('messages.session_expired'));
            }

            $reservation = $this->entityManager->getRepository('App\Models\Test\ReservationModel')->findOneBy(['Id' => $reservation_id]);

            /* if reservation is null return an error */
            if($reservation == null){
                return redirect()->route('/')->with('failure', 'There is not voucher to show.');
            }

            // store currency object to reuse it
            $currency = $reservation->Region->Country->Currency;
            // store hotel object to reuse it
            $hotel = $reservation->Hotel;

            // create a paypal object
            $paypal = new ApiContext(
                new OAuthTokenCredential(
                    'Aar8WECVhZvVFwq9ZjdA5q7hJeXPgmj-6koCAuget_3bTflEzM3spiw68XgJtvkD1lSCyQU89N1wh-1H', 
                    'EAsfhOeskbDnBGBnznoyRwO0zRCWoYE3vz7TldjWsxRdxMdAgBkIkHalY2RwSedNTvkI-97w2zlh-w2s')
            );

            // create paypal payer
            $payer = new Payer();
            $payer->setPaymentMethod('paypal');

            // array items
            $items = [];

            // create paypal item list to add array item
            $itemList = new ItemList();

            switch($reservation->Type){
                case 1:
                    // iterate over services details
                    foreach($reservation->ServicesDetails as $detail):
                        // store servies in var to reuse it
                        $currentService = $detail->Service;

                        $currentServicePlanePrice = $currentService->getPlanePrice($hotel->Id);
                        $currentServicePrice = $currentService->getPrice($hotel->Id);
                        
                        // create paypal item object by iteration item
                        $item = new Item();
                        $item->setName($detail->Service->Name)
                             ->setCurrency($currency->Name)
                             ->setQuantity(1)
                             ->setSku(substr($currentService->Id, 0, 8))
                             ->setPrice($currentServicePrice);

                        // add item to array items
                        $items[] = $item;

                        $subtotal += $currentServicePlanePrice;
                        $total += $currentServicePrice;


                    endforeach;
                    break;
                case 2:
                    /* iterate over certificate details */
                    foreach($reservation->CertificateDetails as $key => $certificate):
                        // create paypal item object by iteration item
                        $item = new Item();
                        $item->setName("Certificate #" . ( $key + 1 ) )
                             ->setCurrency($currency->Name)
                             ->setQuantity(1)
                             ->setSku(substr($certificate->Id, 0, 8))
                             ->setPrice($certificate->Value);

                        // add item to array items
                        $items[] = $item;

                        $subtotal += $certificate->Value;
                        $total += $certificate->Value;
                    endforeach;
                    break;
            }

            // add array items to paypal item list
            $itemList->setItems($items);

            // create paypal detials item
            $details = new Details();
            $details->setShipping(0.00)
                    ->setTax(0.0)
                    ->setSubtotal($total);

            // create paypal amount object
            $amount = new Amount();
            $amount->setCurrency($currency->Name)
                   ->setTotal($total)
                   ->setDetails($details);

            // create paypal transaction object
            $transaction = new Transaction();
            $transaction->setAmount($amount)
                        ->setItemList($itemList)
                        ->setInvoiceNumber($reservation->ConfirmationNumber);

            if($reservation->Type == 1)
                $transaction->setDescription("Individual services reservation");
            else if ($reservation->Type == 2)
                $transaction->setDescription("Gift certificate reservation");

            // create paypal redirect object
            $redirectUrls = new RedirectUrls();
            $redirectUrls->setReturnUrl($this->siteUrl."/payment/voucher") // FIXME
                         ->setCancelUrl($this->siteUrl."/reservation/canceled"); // FIXME


            // create paypal payment object
            $payment = new Payment();
            $payment->setIntent("sale")
                    ->setRedirectUrls($redirectUrls)
                    ->setPayer($payer)
                    ->setTransactions([$transaction]);

            // create payment
            $payment->create($paypal);
            
            $approvalUrl = $payment->getApprovalLink();

            return \Redirect::to($approvalUrl);
        }
        catch (\PayPal\Exception\PayPalConnectionException $e) {
            return redirect()->route('home.home')->with('failure', trans('messages.session_expired'));
        }

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

            /* change reservation status to complete and it will appear in admin reservation section */
            $reservation->Status = $this->entityManager->getRepository('App\Models\Test\StatusModel')->findOneBy(['Name' => 'Completed']);

            // save reservation with new status
            $this->entityManager->persist($reservation);
            $this->entityManager->flush();


            $paymentInfo = $reservation->PaymentInformation;
            /* set voucher data */
            $model = [
                'customer_name' => $reservation->PaymentInformation->FirstName,
                'customer_email' => $reservation->PaymentInformation->CustomerEmail,
                'current_date' => new \DateTime("now"),
                'confirmation_number' => $reservation->ConfirmationNumber,
                'author_code' => uniqid(),
                'card_type' => ( $reservation->PaymentMethod->Name == 'Paypal' ? $reservation->PaymentMethod->Name : $reservation->PaymentMethod->Name . ' - *****'.$reservation->LastFourCardNumbers ),
                'billing_details' => $paymentInfo->CountryName.', '.', '.$paymentInfo->TownCity.', '.$paymentInfo->StreetAddress.', '.$paymentInfo->ApartmentUnit.', '.$paymentInfo->PostCode,
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
                //$message->bcc('hiobairo1993@gmail.com', 'David Salcedo');
                $message->to($reservation->PaymentInformation->CustomerEmail, $reservation->PaymentInformation->FirstName . ' ' . $reservation->PaymentInformation->LastName);
                $message->replyTo('info@renovaspa.com', 'Renovaspa');

                if($reservation->Type == 1)
                    $message->subject("Renova Spa voucher confirmation #" . $reservation->ConfirmationNumber);
                else
                    $message->subject("Renova Spa Gift Certificate voucher confirmation #" . $reservation->ConfirmationNumber);
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
