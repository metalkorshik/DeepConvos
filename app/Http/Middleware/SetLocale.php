<?php

namespace App\Http\Middleware;
use Illuminate\Http\Request;
use Closure;
use App;
use Illuminate\Support\Facades\Session;

class SetLocale
{
    public function handle(Request $request, Closure $next)
    {
        $locale = Session::get('locale') ?? 'en';
        App::setLocale($locale);

        return $next($request);
    }
}
