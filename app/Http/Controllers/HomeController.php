<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\UploadedFile;
use App\Database\DbContext;
use Mail;

class HomeController extends Controller
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

    /* /GET home page */
    public function home(Request $request){
        $request->session()->flush();
        $request->session()->regenerate();
        
        return view("home/index", [ 'margin' => true ]);
    }
    
    /* /GET services reservation form page */
    public function services(Request $request){
        $session = $request->session();

        $request->session()->regenerate();

        $session->put('reservation_type', 1);
        
        $countries = $this->entityManager->getRepository("App\Models\Test\CountryModel")->findBy([], ['Name' => 'ASC']);

        return view("country.list", [ "model" => $countries, 'margin' => true ]);
    }

    /* /GET certificate reservation form page */
    public function certificates(Request $request){
        $session = $request->session();

        $request->session()->regenerate();

        $session->put('reservation_type', 2);

        $countries = $this->entityManager->getRepository("App\Models\Test\CountryModel")->findBy([], ['Name' => 'ASC']);

        return view("country.list", [ "model" => $countries, 'margin' => true ]);
    }

    /* /GET wedding reservation form page */
    public function weddings(Request $request){
        $session = $request->session();

        $request->session()->regenerate();

        $session->put('reservation_type', 3);

        $countries = $this->entityManager->getRepository("App\Models\Test\CountryModel")->findBy([], ['Name' => 'ASC']);

        return view("country.list", [ "model" => $countries, 'margin' => true ]);
    }

    /* /GET about us page */
    public function about(){
    	return view("home/about", [ 'margin' => true ]);
    }

    /* /GET etiquette page */
    public function etiquette(){
        return view('home/etiquette', ['margin' => true]);
    }

    /* /GET faq page */
    public function faq(){  
        return view('home/faq');
    }

    public function privacyPolicy(){
        return view("home.privacyPolicy");
    }

    /* /GET contact page */
    public function contact(){
        return view('home/contact');
    }

    /* /POST */
    public function sendContactForm(){
        
        try {
            /* mail object */
            $mail = app()['mailer'];

            if(empty($_POST['name']) || empty($_POST['email']) || empty($_POST['hotel']) || empty($_POST['message']))
                return redirect()->route('home.contact')->with('failure', 'Please fill al textboxs.');

            if(!isset($_POST['terms']))
                return redirect()->route('home.contact')->with('failure', 'You must accept the terms to send the message.');

            $data = $_POST;
            /* send contact form */
            $mail->send([],[], function($message) use ($data) {
                $message->setBody("
                    <p><strong>Name: </strong> ".$data['name']." </p>
                    <p><strong>Email: </strong> ".$data['email']." </p>
                    <p><strong>Hotel: </strong> ".$data['hotel']." </p>
                    <p><strong>Message: </strong></p>
                    <p>".$data['message']." </p>
                    ", 'text/html');
                $message->from('info@turnviral.net', 'Renovaspa');
                $message->sender('info@renovaspa.com', 'Renovaspa');
                $message->to('contact@turnviral.com', 'Renovaspa Contact Form');
                $message->replyTo('info@renovaspa.com', 'Renovaspa');

                $message->subject("Renovaspa - Contact form");
            });

            return redirect()->route('home.contact')->with('success', 'Message sent successfully.');
            
        }
        catch (\Exception $e){
            return redirect()->route('home.contact')->with('failure', 'Error sending message. Please try again.');
        }
    }

    /* /POST */
    public function sendJoinToOurTeamForm(Request $request){
        
        try {
            /* mail object */
            $mail = app()['mailer'];

            /* validate inputs */
            if(empty($_POST['position']) || empty($_POST['country']) || empty($_POST['name']) || empty($_POST['email']))
                return redirect()->route('home.contact')->with('failure', 'Please fill al textboxs.');

            /* check if the file exists in the request */
            if (!$request->hasFile('resume'))
                return redirect()->route('home.contact')->with('failure', 'You must to upload your resume.');

            /* get file by input file name */
            $f = $request->resume;

            if($f->extension() != 'txt' && $f->extension() != 'doc')
                return redirect()->route('home.contact')->with('failure', 'You must upload a valid file.');

            /* file identifier */
            $uniqid = uniqid();
            $file_name = $uniqid . '-'.str_replace(' ', '-', $_POST['name']).'-'.$_POST['position'].'-'.$_POST['email'].'-resume.'.$f->extension();
            $file_path =  storage_path() .'/app/public/resumes/'. $file_name;

            /* store file in public storage */
            $f->storeAs('public/resumes', $file_name);

            $data = $_POST;
            $data['file_path'] = $file_path;

            /* send contact form */
            $mail->send([],[], function($message) use ($data) {
                $message->setBody("
                    <p><strong>Position applying: </strong> ".$data['position']." </p>
                    <p><strong>City/Country: </strong> ".$data['country']." </p>
                    <p><strong>Name: </strong> ".$data['name']." </p>
                    <p><strong>Email: </strong> ".$data['email']." </p>
                    ", 'text/html');
                $message->from('info@turnviral.net', 'Renovaspa');
                $message->sender('info@renovaspa.com', 'Renovaspa');
                $message->to('employer@turnviral.net', 'Renovaspa Employer');
                $message->replyTo('info@renovaspa.com', 'Renovaspa');
                $message->attach($data['file_path']);

                $message->subject("Renovaspa - Join us form");
            });

            return redirect()->route('home.contact')->with('success', 'Message sent successfully.');
            
        }
        catch (\Exception $e){
            return redirect()->route('home.contact')->with('failure', 'Error sending message. Please try again.');
        }
    }

}
