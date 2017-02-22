<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;

class LanguageMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {   
        
        $locale = "en";

        if(isset($_GET['lang'])){
            $locale =  $_GET['lang'];
        }
        
        $app = App::getFacadeRoot();

        $app->setLocale($locale);
        
        return $next($request);
    }
}