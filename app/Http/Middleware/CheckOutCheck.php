<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Cart;
class CheckOutCheck
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
        if (Cart::content()->count() >0){
            return $next($request);
        } 
        else {
            return redirect()->route('shop')->with('danger', 'Rỏ hàng đang rỗng, hãy chọn mặt hàng bạn muốn.');
        }
    }
    // protected function redirectTo($request)
    // {
    //     if (! $request->expectsJson()) {
    //         return route('login');
    //     }
    // }
}
