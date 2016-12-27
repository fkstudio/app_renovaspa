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
        if($request->input('locale')){
            \Session::put('locale', $request->input('locale'));
            \Session::save();
        }

        $locale = \Session::get('locale');
        $app = App::getFacadeRoot();

        if($locale != null)
            $app->setLocale($locale);
        else
            $app->setLocale($app->config->get('app.fallback_locale'));

        return $next($request);
    }
}