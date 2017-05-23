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
use PayPal\Api\PaymentExecution;
use PayPal\Api\ExecutePayment;



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

    /* create pdf from a certificateDetail object */
    private function createPDF($certificateDetail){
        
        $pdf = new \App\Classes\FPDF("L","cm", array(17 , 21));
        
        $pdf_path = public_path() . '/images/pdf/';
        $cabecera = $pdf_path . "header2.jpg"; 
        $lado = $pdf_path . "validopor.jpg"; 
        $depara = $pdf_path . "depara.jpg"; 

        $reservation_number  = substr($certificateDetail->Reservation->Id, 0, 7);
        $certificate_number = $certificateDetail->CertificateNumber;
        $destination_hotel = $certificateDetail->Reservation->Hotel->Name;
        $de=$certificateDetail->FromCustomerName;
        $customer_to=$certificateDetail->ToCustomerName;
        $check_date=$certificateDetail->Reservation->Arrival->Format('d/m/Y');
        $message=$certificateDetail->Message;
        $paymentMethod = $certificateDetail->Reservation->PaymentMethod->Name;

        $conditons_terms_title="GIFT CERTIFICATES TERMS AND CONDITIONS";
        $cancellation_title="CANCELLATION POLICY";
        $redemption_title="Gift Certificate Redemption:";
        $exchange_rate="Exchange Rate";

        $customer_must_present_title = " Customers must present a copy of the gift certificate at the selected Renova Spa in order to choose and schedule their services.
        -A copy of the gift certificate is always sent to the purchaser after the payment process has been completed.
        -Appointments are subject to availability and must be requested directly at the Spa's reception.
        -If you do not use the full value on your initial visit, the spa partner will issue you a credit towards a future appointment, which needs to be redeemed during the stay.
        -You can purchase spa treatments or products for the receiver and/or any other person.
        -No partial refunds apply for unused amounts and these cannot be used for tips. ";
        
        $certificate_issued_title=" 

        Gift Certificates are issued in US dollars (U$) or Euros (�$), based on the location. When redeeming a Renova SPA gift certificate, the spa will convert the value into the currency of their respective country. It will buy a service or services of equivalent value. " ;
        
        $certificate_valid_title="This certificate is not valid until it is signed by one of the recipient listed on it.Treat this certificate like cash. You must present this certificate to redeem your purchase. Purchaser is responsible for any misuse of this";
        $hr="_______________________________________";
        
        $signature="Signature";
        $no_refund_title="No refunds apply for unused Gift Certificates.";
        $pocision=0;
        $pdf->AddPage();
        $pdf->SetFont("arial","",9);
        $pdf->Image($cabecera,0,0,15);

        $pdf->Image($lado,15,0,5,'jpg');
        $pdf->Image($depara,1,3.5,13,'jpg');

        $pdf->SetFont("arial","",9);

        if($certificateDetail->Type == 1){
            foreach ($certificateDetail->CertificateDetailServices as $key => $ServicesDetail) {
                $total_value = $ServicesDetail->Service->Name;
                
                $pdf->SetFontsize(8);
                $pdf->SetXY(15.2, 3.0 + ( 0.4 * $key ));
                $pdf->multicell(5,.5, $total_value,0,'L');
            }
        }
        else{
            $total_value = $certificateDetail->Reservation->Region->Country->Currency->Symbol.$certificateDetail->Value;
            $pdf->SetXY(16.6,3.5);
            $pdf->multicell(5,.5, $total_value,0,'L');
        }

        

        $pdf->SetXY(15.3,5.6);
        $pdf->cell(5,0, $certificate_number,0);

        $pdf->SetFont("arial","",9);
        $pdf->SetXY(15.3,8.4);
        $pdf->cell(5,0, $check_date,0);

        $pdf->SetXY(4,5.1);
        $pdf->cell(5,0, $de,0);

        $pdf->SetXY(4,4.2);
        $pdf->cell(5,0, $customer_to,0);

        $pdf->SetFontsize(9);
        $pdf->SetXY(4,5.8);
        $pdf->multicell(9,.5, $message,0);

        $pdf->SetFontsize(6);
        $pdf->SetXY(15.3,7);
        $pdf->cell(5,0, $destination_hotel,0);

        $pdf->SetFontsize(11);
        $pdf->SetXY(1,9);
        $pdf->cell(13,.3, $conditons_terms_title,0);

        $pdf->SetFontsize(11);
        $pdf->SetXY(1,9.5);
        $pdf->cell(13,.3, $redemption_title,0);

        $pdf->SetFontsize(6);
        $pdf->SetXY(1,10);
        $pdf->multicell(13,.3, $customer_must_present_title,0);

        $pdf->SetFontsize(11);
        $pdf->SetXY(1,12.5);
        $pdf->cell(13,.3, $exchange_rate,0);

        $pdf->SetFontsize(6);
        $pdf->SetXY(1,13);
        $pdf->multicell(13,.3, $certificate_issued_title,0);

        $pdf->SetXY(1,14.5);
        $pdf->multicell(5,.3, $cancellation_title,0);

        $pdf->SetXY(1,14.68);
        $pdf->multicell(5,.3, $no_refund_title,0);

        $pdf->SetFontsize(9);
        $pdf->SetXY(15,10);
        $pdf->SetFillColor(123,120,128,1);
        $pdf->multicell(5,.6, $paymentMethod,1);

        $pdf->SetFontsize(6);
        $pdf->SetXY(15,11);
        $pdf->multicell(5,.3, $certificate_valid_title,0);



        $pdf->SetXY(15,14);
        $pdf->multicell(5,.3,$hr,0);

        $pdf->SetXY(17,14.5);
        $pdf->cell(5,.3,$signature,0);

        $pdf_path = storage_path() .'/app/public/pdf/cert_'.$reservation_number.'_'.$certificate_number.'.pdf';
        $pdf->Output('F', $pdf_path);

        return $pdf_path;
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
                $reservation->Status = $this->entityManager->getRepository('App\Models\Test\StatusModel')->findOneBy(['Name' => 'Pending']);

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

            if($reservation->Type == 2){
                if(count($reservation->CertificateDetails) && $reservation->CertificateDetails[0]->Type == 1){
                    $total =  $reservation->getTotal();
                }
                else {
                    $total =  $reservation->getSubTotal();
                }
            }
            else {
                $total =  $reservation->getTotal();  
            }
            
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
                $gatewayURL = \Config::get('gateway.url');
                $APIKey = \Config::get('gateway.api_key');
                
                $paymentGateway = new \App\Classes\gwapi;
                $paymentGateway->setLogin(\Config::get('gateway.user'), \Config::get('gateway.password'));

                /* payment data */
                if($reservation->Type == 2){
                    if(count($reservation->CertificateDetails) && $reservation->CertificateDetails[0]->Type == 1){
                        $total =  strval( $reservation->getTotal() );
                    }
                    else {
                        $total =  strval( $reservation->getSubTotal() );
                    }
                }
                else {
                    $total =  strval( $reservation->getTotal() );  
                }
                
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

                $lastNumbers = substr($cardNumber, -4);

                if($lastNumbers == null)
                    return redirect()->route('payment.gateway')->with('failure', trans('messages.invalid_data'));

                // add the last four card numbers to reservation
                $reservation->LastFourCardNumbers = $lastNumbers;
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

        try {
            /* ApiRedsys Object*/
            $redsys = new \App\Classes\ApiRedsys();

            // Redsys payment url
            //$redsysUrl = "https://sis-t.redsys.es:25443/sis/realizarPago"; // UCOOMENT TO TEST
            $redsysUrl = \Config::get('redsys.url');

            /* get current reservation */
            $reservation = $this->entityManager->getRepository('App\Models\Test\ReservationModel')->findOneBy(['Id' => $reservation_id]);

            /* if reservation is null return an error */
            if($reservation == null){
                return redirect()->route('/')->with('failure', trans('messages.session_expired'));
            }

            // Redsys configuration
            $version = \Config::get('redsys.version');
            $sha256Key = \Config::get('redsys.sha_256_key');
            $comercialKey = \Config::get('redsys.comercial_key');

            $referenceNumber = $reservation->ConfirmationNumber;

            // Input values
            $comercialCodeFunc = \Config::get('redsys.comercial_code_func');
            $terminal = \Config::get('redsys.terminal');
            $currencyCode = \Config::get('redsys.currency_code');
            $transactionType = \Config::get('redsys.transaction_type');

            /* redirects url */
            $merchantUrlOk = $this->siteUrl.'/payment/voucher';
            $merchantUrlKo = $this->siteUrl."/reservation/canceled";

            if($reservation->Type == 2){
                if(count($reservation->CertificateDetails) && $reservation->CertificateDetails[0]->Type == 1){
                    $total =  strval( $reservation->getTotal() * 100 );
                }
                else {
                    $total =  strval( $reservation->getSubTotal() * 100 );
                }
            }
            else {
                $total =  strval( $reservation->getTotal() * 100 );  
            }
            

            /* set reservation data */
            $redsys->setParameter("DS_MERCHANT_MERCHANTCODE",$comercialCodeFunc);
            $redsys->setParameter("DS_MERCHANT_TERMINAL",$terminal);
            $redsys->setParameter("DS_MERCHANT_ORDER", $referenceNumber);
            $redsys->setParameter("DS_MERCHANT_AMOUNT", $total);
            $redsys->setParameter("DS_MERCHANT_PRODUCTDESCRIPTION", 'Renova Spa Services, Voucher '.$referenceNumber);
            $redsys->setParameter('DS_MERCHANT_TITULAR', "Renovaspa");
            $redsys->setParameter("DS_MERCHANT_CURRENCY",$currencyCode);
            $redsys->setParameter("DS_MERCHANT_TRANSACTIONTYPE",$transactionType);
            $redsys->setParameter("DS_MERCHANT_MERCHANTURL", $merchantUrlOk);
            $redsys->setParameter("DS_MERCHANT_URLOK",$merchantUrlOk);
            $redsys->setParameter("DS_MERCHANT_URLKO",$merchantUrlKo);
            $redsys->setParameter("DS_Merchant_MERCHANTNAME", "Renovaspa");
            $redsys->setParameter('DS_Merchant_ConsumerLanguage', "2");
            $redsys->setParameter("DS_MERCHANT_MERCHANTDATA", $referenceNumber);


            $params = $redsys->createMerchantParameters();
            $signature = $redsys->createMerchantSignature($sha256Key);

            return view("payment.redsys", [ 'url' => $redsysUrl, 'version' => $version, 'params' => $params, 'signature' => $signature ]);
        }
        catch(\Exception $e){
            return redirect()->route('reservation.checkout')->with('failure', 'Please fill try sending the form again.');
        }
        
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

            $tokenCredential = new OAuthTokenCredential(
                                        \Config::get('paypal.api_key'), 
                                        \Config::get('paypal.secret_key')
                                    );

            // create a paypal object
            $paypal = new ApiContext($tokenCredential);

            $config = [
                'mode' => \Config::get('paypal.mode')
            ];

            $paypal->setConfig($config);

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
                        $item->setName("Certificate No. " . ( $key + 1 ) )
                             ->setCurrency($currency->Name)
                             ->setQuantity(1)
                             ->setSku(substr($certificate->Id, 0, 8));

                        if($certificate->Type == 1){
                            
                            $item->setPrice($certificate->Value);

                            $total += $certificate->Value;
                            $subtotal += $certificate->Value;
                        }
                        else {
                            $item->setPrice($certificate->SubTotal);

                            $total += $certificate->SubTotal;
                            $subtotal += $certificate->SubTotal;
                        }

                        // add item to array items
                        $items[] = $item;

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
            $redirectUrls->setReturnUrl($this->siteUrl."/payment/complete/payment") // FIXME
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
        catch (\Exception $e) {
            return redirect()->route('home.home')->with('failure', trans('messages.session_expired'));
        }

    }

    public function completePaypalPayment(){
        
        $tokenCredential = new OAuthTokenCredential(
                                        \Config::get('paypal.api_key'), 
                                        \Config::get('paypal.secret_key')
                                    );

        // create a paypal object
        $paypal = new ApiContext($tokenCredential);

        $config = [
            'mode' => \Config::get('paypal.mode')
        ];
        
        $paypal->setConfig($config);

        $paymentId = $_GET['paymentId'];
        $payment = Payment::get($paymentId, $paypal);
        $payerId = $_GET['PayerID'];

        // Execute payment with payer id
        $execution = new PaymentExecution();
        $execution->setPayerId($payerId);

        try {
            // Execute payment
            $result = $payment->execute($execution, $paypal);
            
            return redirect()->route('payment.serviceVoucher');

        } catch (PayPal\Exception\PayPalConnectionException $ex) {
            return redirect()->route('reservation.checkout')->with('failure', 'Paypal connection error.');
        } catch (Exception $ex) {
            return redirect()->route('reservation.checkout')->with('failure', 'Has ocurred an error.');
        }
    }

    /** @return array[] */
    public function createVoucherData($reservation){
        /* get payment information object */
        $paymentInfo = $reservation->PaymentInformation;

        /* voucher */
        $voucher = null;
        
        /* set voucher data */
        $model = [
                    'customer_name' => $reservation->PaymentInformation->FirstName . ' ' . $reservation->PaymentInformation->LastName,
                    'type' => $reservation->Type,
                    'customer_email' => $reservation->PaymentInformation->CustomerEmail,
                    'current_date' => new \DateTime("now"),
                    'confirmation_number' => $reservation->ConfirmationNumber,
                    'card_type' => ( $reservation->PaymentMethod->Name == 'Paypal' ? $reservation->PaymentMethod->Name : $reservation->PaymentMethod->Name . ' - *****'.$reservation->LastFourCardNumbers ),
                    'billing_details' => $paymentInfo->CountryName.', '.', '.$paymentInfo->TownCity.', '.$paymentInfo->StreetAddress.', '.$paymentInfo->ApartmentUnit.', '.$paymentInfo->PostCode,
                    'hotel_name' => "Hotel " . $reservation->Hotel->Name . ", " . $reservation->Region->Name . ", " . $reservation->Region->Country->Name,
                    'hotel_email' => $reservation->Hotel->NotifyEmail,
                    'customer_service_name' => $reservation->Hotel->CustomerServiceName,
                    'check_in' => $reservation->Arrival->format('F j, Y'),
                    'check_out' => $reservation->Departure->format('F j, Y'),
                    'discount' => number_format($reservation->getDiscount(), 2),
                    'subtotal' => $reservation->getSubTotal(),
                    'total' => $reservation->getTotal(),
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
                  "appointment_and_time" => ($detail->PreferedDate != null ? $detail->PreferedDate->format('F j, Y') : "Open date") . ' ' . ($detail->PreferedTime != null ? $detail->PreferedTime->format('h:m a') : "Open time"),
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
                    'certificate_type' => $detail->Type,
                    'real_customer_first_name' => $detail->RealCustomerFirstName,
                    'real_customer_last_name' => $detail->RealCustomerLastName,
                    'from_customer' => $detail->FromCustomerName,
                    'to_customer' => $detail->ToCustomerName,
                    'certificate_number' => $detail->CertificateNumber,
                    'sub_total' => number_format($detail->SubTotal, 2),
                    'price' => number_format($detail->Value, 2)
                );

                if($detail->SendType == 1){
                    $model['details'][$key]['delivery_method'] = 'Email';
                }
                else if($detail->SendType == 2){
                    $model['details'][$key]['delivery_method'] = "Print";
                }
                else if ($detail->SendType == 3){
                    $model['details'][$key]['delivery_method'] = "Hotel";
                }
            }

            /* get certificate voucher as html string */
            $voucher = (string) \View::make('payment._certificate_voucher', $model)->render();
        }

        return [ 'data' => $model, 'voucher' => $voucher ];
    }

    /* Send reservation email */
    public function sendReservationEmail($reservation, $mailData){
        /* mail object */
        $mail = app()['mailer'];

        /* store gift paths */
        $gift_paths = [];

        /* send voucher view */
        $mail->send([],[], function($message) use ($mailData) {
            $reservation = $mailData['reservation'];
            $message->setBody($mailData['voucher'], 'text/html');
            
            /* this mail will be send from? */
            $message->from(\Config::get('email.info'), 'Renovaspa');

            /* the sender's data is? */
            $message->sender(\Config::get('email.info'), 'Renovaspa');
            
            /* this mail is in hidden copy fro? */
            $message->bcc($reservation->Hotel->NotifyEmail, 'Renovaspa');

            /* the recipient of this mail is? */  
            $message->to($reservation->PaymentInformation->CustomerEmail, $reservation->PaymentInformation->FirstName . ' ' . $reservation->PaymentInformation->LastName);
            
            /* this mail should be replie to? */
            $message->replyTo(\Config::get('email.info'), 'Renovaspa');

            if($reservation->Type == 1){
                $message->subject("Renova Spa voucher confirmation #" . $reservation->ConfirmationNumber);
            }
            else{
                $subject = "Renova Spa Gift Certificate voucher confirmation #" . $reservation->ConfirmationNumber;
                
                foreach($reservation->CertificateDetails as $key => $detail){
                    /* create pdf gift from reservation detail */
                    $pdf_path = $this->createPDF($detail);

                    /* add gift certificate number to mail subject */
                    $subject .= " - #" . $detail->CertificateNumber;

                    /* attach gift pdf to mail */
                    $message->attach($pdf_path);    
                }

                /* add destination to subject */
                $subject .= ' at '. $reservation->Region->Country->Name . ' - '. $reservation->Region->Name . ' - ' . $reservation->Hotel->Name;

                /* add subject to mail */
                $message->subject($subject);
            }

        });


        if($reservation->Type == 2){
            foreach($reservation->CertificateDetails as $key => $detail){
                if($detail->SendType == 1){

                    /* store detail object */
                    $mailData['detail'] = $detail;
                    $mailData['pdf_path'] = $this->createPDF($detail);
                    
                    /* send voucher view */
                    $mail->send([],[], function($message) use ($mailData) {
                        $reservation = $mailData['reservation'];
                        $detail = $mailData['detail'];


                        $message->setBody("
                            <p>
                            Dear ".$detail->RealCustomerFirstName . " " . $detail->RealCustomerLastName ."
                            <br/>
                            ".$reservation->PaymentInformation->FirstName . ' ' . $reservation->PaymentInformation->LastName." Has sent you a Gift Certificate from Renova Spa.
                            <br/>
                            Attached to this e-mail you will find the Gift Certificate/s.
                            <br/>
                            Please print it/them out and present it/them at the Renova spa in ".$reservation->Hotel->Name.", ".$reservation->Region->Country->Name.", ".$reservation->Region->Name.", in order to choose and schedule your treatments.
                            <br/>
                            We highly recommend you to come to the spa soon upon your arrival to the hotel in order to prevent availability problems.
                            <br/>
                            We will be happy to assist you with any further information.
                            <br/>
                            Please, e-mail us at ".$reservation->Hotel->NotifyEmail."
                            <br/>
                            We hope you enjoy our spa services and look forward to welcome you at Renova SPA!
                            <br/>
                            ".$reservation->Hotel->CustomerServiceName."
                            <br/>
                            Customer Services & Online Sales
                            </p>
                            ", 'text/html');

                        /* this mail will be send from? */
                        $message->from(\Config::get('email.info'), 'Renovaspa');
                        
                        /* the sender's data is? */
                        $message->sender(\Config::get('email.info'), 'Renovaspa');
                        
                        /* this mail should be replie to? */
                        $message->replyTo(\Config::get('email.info'), 'Renovaspa');
                        
                        /* the recipient of this mail is?  */
                        $message->to($detail->DeliveryEmail, $detail->ToCustomerName);
                        
                        $message->attach($mailData['pdf_path']);

                        $message->subject("Renova Spa Gift Certificate voucher confirmation #" . $reservation->ConfirmationNumber . ' - #'. $detail->CertificateNumber .' at '. $reservation->Region->Country->Name . ' - '. $reservation->Region->Name . ' - ' . $reservation->Hotel->Name); 
                    });   
                } 
            }    
        }

        // foreach($reservation->CertificateDetails as $key => $detail){
        //     /* store detail object */
        //     $mailData['detail'] = $detail;
        //     $mailData['pdf_path'] = $this->createPDF($detail);
            
        //     /* send voucher view */
        //     $mail->send([],[], function($message) use ($mailData) {
        //         $reservation = $mailData['reservation'];
        //         $detail = $mailData['detail'];

        //         /* this mail will be send from? */
        //         $message->from(\Config::get('email.info'), 'Renovaspa');
                
        //         /* the sender's data is? */
        //         $message->sender(\Config::get('email.info'), 'Renovaspa');
                
        //         /* this mail is in hidden copy fro? */
        //         $message->bcc($reservation->Hotel->NotifyEmail, 'Renovaspa');
        //         $message->bcc($reservation->PaymentInformation->CustomerEmail, $reservation->PaymentInformation->FirstName . ' ' . $reservation->PaymentInformation->LastName);
                
        //         /* this mail should be replie to? */
        //         $message->replyTo(\Config::get('email.info'), 'Renovaspa');

        //         $message->attach($mailData['pdf_path']);

        //         if($reservation->Type == 1)
        //             $message->subject("Renova Spa voucher confirmation #" . $reservation->ConfirmationNumber);
        //         else
        //             $message->subject("Renova Spa Gift Certificate voucher confirmation #" . $reservation->ConfirmationNumber . ' - '. substr($detail->Id, 0, 7) .' at '. $reservation->Region->Country->Name . ' - '. $reservation->Region->Name . ' - ' . $reservation->Hotel->Name); 
        //     });  
        // } 
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
            $reservation->Arrival = new \DateTime($session->get("arrival"));
            $reservation->Departure = new \DateTime($session->get("departure"));
            $reservation->Total = $reservation->getTotal();
            $reservation->SubTotal = $reservation->getSubTotal();

            // save reservation with new status
            $this->entityManager->persist($reservation);
            $this->entityManager->flush();
 
            $data = $this->createVoucherData($reservation);

            $model = $data['data'];
            $voucher = $data['voucher'];

            $mailData = [
                'voucher' => $voucher,
                'reservation' => $reservation
            ];

            $testMode = \Config::get('app.mode');

            if($testMode == "PRODUCTION"){
                $this->sendReservationEmail($reservation, $mailData);
                
                /* clear session data */
                $session->flush();
            }
        
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

    public function confirmVoucher($confirmationNumber = ''){
        try {
            if(empty($confirmationNumber))
                return "Por favor ingrese el numero de confirmación para reenviar el voucher.";

            $reservation = $this->entityManager->getRepository('App\Models\Test\ReservationModel')->findOneBy(['ConfirmationNumber' => $confirmationNumber]);
        
            $data = $this->createVoucherData($reservation);

            $model = $data['data'];
            $voucher = $data['voucher']; 

            $mailData = [
                'voucher' => $voucher,
                'reservation' => $reservation
            ];  

            $testMode = \Config::get('app.mode');

            if($testMode == "PRODUCTION")
                $this->sendReservationEmail($reservation, $mailData);

            if($reservation->Type == 1){
                /* show voucher */
                return view('payment.voucher_content', $model);
            }
            else if ($reservation->Type == 2){
                return view('payment.certificate_voucher_content', $model);
            }
        }
        catch (\Exception $e) {
            return "Por favor ingrese el numero de confirmación para reenviar el voucher.";    
        }
    }
}
