<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;
use \App\Classes\ReCaptchaLib;

error_reporting(E_ALL ^ E_NOTICE);

class ReCaptcha
{
    public function handle(Request $request, Closure $next)
    {   
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
}
