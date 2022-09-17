<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsurePhoneIsVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param  Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->user()->hasVerifiedPhone()) {
            return $next($request);
        }
        session()->flash('info', 'شماره تلفن همراه شما تایید نشده است.');
        // return redirect('/');
        return redirect()->route('phoneverification.verify');
    }
}
