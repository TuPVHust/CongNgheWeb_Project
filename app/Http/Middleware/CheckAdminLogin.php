<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAdminLogin
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
        // return $next($request);
        if (Auth::check()){
            $user=Auth::user();
            if (($user->role==0) && ($user->status==1)){
                return $next($request);
            } else{
                Auth::logout();
                return redirect()->route('admin.getlogin')->with('danger','Tài khoản không có quyền truy cập hệ thống quản trị, vui lòng đăng nhập bằng tài khoản khác');
            }
        } 
        else {
            return redirect()->route('admin.getlogin');
        }
        
        
    }
}