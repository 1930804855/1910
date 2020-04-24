<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin;
use Illuminate\Support\Facades\Cookie;
class LoginController extends Controller
{
    //登录方法
    public function loginDo(Request $request){
    	//接值
    	$admin=$request->except('_token');
    	$adminInfo=Admin::where('admin_name',$admin['admin_name'])->first();
    	if($admin['admin_pwd']!=decrypt($adminInfo->admin_pwd)){
    		return redirect('/login')->with('msg','用户名或密码不对！');
    	}
        //七天免登陆
        if($admin['remember']){
            //存入cookie
            Cookie::queue('adminuser',serialize($adminInfo),24*60*7);
        }
    	session(['adminuser'=>$adminInfo]);
    	return redirect('/goods');
    }
}
