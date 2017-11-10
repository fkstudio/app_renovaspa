<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;
use \App\Classes\ReCaptchaLib;


class ReCaptcha
{
    public function handle(Request $request, Closure $next)
    {   
        return $next($request);
        
        try {
            // captcha private key
            $privatekey = \Config::get('recaptcha.private_key');
            $captcha = new ReCaptchaLib();

            $resp = $captcha->recaptcha_check_answer ($privatekey,
                                            $_SERVER["REMOTE_ADDR"],
                                            $_POST["recaptcha_challenge_field"],
                                            $_POST["recaptcha_response_field"]);

            if (!$resp->is_valid) {
                // What happens when the CAPTCHA was entered incorrectly
                return redirect()->route('home.contact')->with('failure', 'Please verify your identity.');
            } else {
                return $next($request);
            }
        }
        catch(\Exception $e){
            return redirect()->route('home.contact')->with('failure', 'Error. Please try again');
        }
        
    }
}
