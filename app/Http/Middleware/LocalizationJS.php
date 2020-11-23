<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use App;
use View;

class LocalizationJS
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $langPath = resource_path('lang/' . App::getLocale());
        $data = file_get_contents($langPath . ".json");
        View::share('translation', json_encode($data));

        return $next($request);
    }
}
