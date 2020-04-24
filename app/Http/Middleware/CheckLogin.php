<?php

namespace App\Http\Middleware;

use Closure;

class CheckLogin
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
        //判断用户是否登录
        $adminuser=session('adminuser');
        if(!$adminuser){
            //获取cookie中的信息  判断是否选中七天免登陆
            $cookie_adminuser=request()->cookie('adminuser');
            //判断
            if($cookie_adminuser){
                session(['adminuser'=>unserialize($cookie_adminuser)]);
            }else{
                return redirect('/login');
            }
        }
        return $next($request);
    }
}
