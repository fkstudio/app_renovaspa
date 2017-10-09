<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Database\DbContext;


class CertificateController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Home Controller
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

    public function options(Request $request, $hotel_id){
        $session = $request->session();
        $session->put('reservation_type', 2);
        $session->put('hotel_id', $hotel_id);

        $region = $this->entityManager->getRepository('App\Models\Test\RegionModel')->findOneBy(['Id' => $session->get('region_id')]);
        $hotel = $this->entityManager->getRepository('App\Models\Test\HotelModel')->findOneBy(['Id' => $hotel_id ]);

        $breadcrumps = [
            $region->Country->Name => '#fakelink',
            $region->Name => '#fakelink',
            $hotel->Name => '#fakelink',
            'CERTIFICATES' => '#fakelink',
            'CERTIFICATE OPTIONS' => '#fakelink'
        ];

        return view("certificate.options", [ 'breadcrumps' => $breadcrumps ]);
    }

    public function checkOption(Request $request){
        $session = $request->session();
        $session->regenerate();
        
        $certificateType = $_POST['type'];
        $session->put('certificate_type', $certificateType);
        $session->put('certificate_quantity', $_POST['quantity']);
        $session->put('current_certificate', 1);
        $session->put('can_go_to_cart', 0);

        try {
            if($certificateType == 1){
                return redirect()->route('category.categoriesByHotel', [ 'hotel_id' => $session->get('hotel_id') ]);
            }
            else {

                // create cart
                $cart = new \App\Models\Test\ShoppingCartModel();
                $cart->Session = $session->getId();
                $cart->Created = new \DateTime();
                $cart->IsDeleted = false;

                $this->entityManager->persist($cart);

                $quantity = $_POST['quantity'];
                
                for($i = 0; $i < $quantity; $i++){
                    $certificateItem = new \App\Models\Test\ShoppingCartItemModel();
                    $certificateItem->CertificateNumber = $i + 1;
                    $certificateItem->Value = $_POST['value'][$i];
                    $certificateItem->Cart = $cart;
                    $certificateItem->Quantity = 1;
                    $certificateItem->Type = 2;
                    $certificateItem->Created = new \DateTime('now');
                    $certificateItem->IsDeleted = false;

                    $this->entityManager->persist($certificateItem);
                }

                $this->entityManager->flush();

                return redirect()->route('certificate.registration');

            }
        }
        catch (\Exception $e){
            return redirect()->route('home.home')->with('failure', trans('messages.session_expired'));
        }
    }

    public function registration(Request $request){
        $session = $request->session();
        $sessionId = $session->getId();

        try {
            $cart = $this->entityManager->getRepository('App\Models\Test\ShoppingCartModel')->findOneBy(['Session' => $session->getId()]);

            $breadcrumps = [
                'REGISTRATION' => '#fakelink'
            ];
        
            if($session->get('certificate_type') == 1 ){
                $services = [];

                $items = $this->entityManager->createQuery('SELECT u FROM App\Models\Test\ShoppingCartItemModel u WHERE u.Cart = :cart  GROUP BY u.CertificateNumber, u.Service')
                                 ->setParameter('cart', $cart->Id)
                                 ->getResult();

                foreach($items as $item){
                    if(!isset($services[$item->CertificateNumber])){
                        $services[$item->CertificateNumber] = [];
                    }

                    $quantity = $this->entityManager
                                                ->createQuery('SELECT count(u.Quantity) as Total FROM App\Models\Test\ShoppingCartItemModel u WHERE u.Cart = :cart AND u.Service = :service AND u.CertificateNumber = :certificate')
                                                ->setParameters([ 'cart' => $cart->Id, 'service' => $item->Service->Id, 'certificate' => $item->CertificateNumber ])
                                                ->getSingleResult()['Total'];
                
                    $services[$item->CertificateNumber][] = [ 'id' => $item->Service->Id, 'name' => $item->Service->Name, 'quantity' => $quantity, 'price' => $item->Service->getPrice($session->get('hotel_id')) ];
                }
                                                                                  
                return view('certificate.serviceBasedRegistration', ['model' => $services, 'breadcrumps' => $breadcrumps]);
            }
            else {
                return view('certificate.valueBasedRegistration', ['model' => $cart->Items, 'breadcrumps' => $breadcrumps]);
            }
        }   
        catch(\Exception $e){
            return redirect()->route('home.home')->with('failure', trans('messages.session_expired'));
        }

    }

    /* delete a certificate item from a reserve and go to referer url */
    public function deleteCertificate(Request $request, $id, $referer){
        /* get certificate item to delete */
        $certificateItem = $this->entityManager->getRepository('App\Models\Test\CertificateDetailModel')->findOneBy(['Id' => $id]);

        /* redirect to home if the certificate item doesnt exists */
        if($certificateItem == null)
            return redirect()->route('home.home');

        /* get shopping cart related items */
        $cartItems = $this->entityManager->getRepository('App\Models\Test\ShoppingCartItemModel')->findBy(['CertificateNumber' => $certificateItem->CertificateNumber]);

        /* delete shopping cart items */
        foreach ($cartItems as $item) {
            $this->entityManager->remove($item);
        }

        /* remove certificate item */
        $this->entityManager->remove($certificateItem);

        /* save changes */
        $this->entityManager->flush();

        switch ($referer) {
            case 'checkout':
                return redirect()->route('reservation.checkout');
                break;
            
            case 'registration':
                return redirect()->route('certificate.registration');
                break;
            default:
                return redirect()->route('home.home');
                break;
        }
    }

}
