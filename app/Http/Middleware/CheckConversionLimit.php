<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class CheckConversionLimit
{
    public function handle($request, Closure $next)
    {
        if (auth()->guest()) {
            $conversionCount = Session::get('conversion_count', 0);

            if ($conversionCount >= 5) {
                return redirect()->route('login')->with('error', 'A alcanzo del limite de conversiones sin cuenta. Porfavor inicia sesion para continuar.');
            }

            Session::put('conversion_count', $conversionCount + 1);
        }

        return $next($request);
    }
}
