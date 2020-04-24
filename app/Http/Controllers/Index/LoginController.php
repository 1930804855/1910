<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use AlibabaCloud\Client\AlibabaCloud;
use AlibabaCloud\Client\Exception\ClientException;
use AlibabaCloud\Client\Exception\ServerException;
use App\Mail\SendCode;
use Illuminate\Support\Facades\Mail;
use App\Register;
use App\Goods;

class LoginController extends Controller
{
    public function login(){
    	return view('index/login');
    }

    public function reg(){
    	return view('index/reg');
    }

    public function sendSms(Request $request){
    	$mobile=$request->mobile;
    	$reg='/^1[3|5|6|7|8|9]\d{9}$/';
    	if(!preg_match($reg,$mobile)){
    		echo json_encode(['code'=>'00001','msg'=>'手机号格式不正确。']);exit;
    	}
    	$code=rand(100000,999999);
    	//发送
    	$res=$this->sendByMobile($mobile,$code);
    	if($res['Message']=='OK'){
    		session('code',$code);
    		echo json_encode(['code'=>'00000','msg'=>'发送成功。']);exit;
    	}
    }

    public function sendByMobile($mobile,$code){

		// Download：https://github.com/aliyun/openapi-sdk-php
		// Usage：https://github.com/aliyun/openapi-sdk-php/blob/master/README.md

		AlibabaCloud::accessKeyClient('LTAI4FzoG75MJuoFEEkjT5V3', 'u2rIzHiSnYfaPczHK1jUYzLYf0cIn7')
		                        ->regionId('cn-hangzhou')
		                        ->asDefaultClient();

		try {
		    $result = AlibabaCloud::rpc()
		                          ->product('Dysmsapi')
		                          // ->scheme('https') // https | http
		                          ->version('2017-05-25')
		                          ->action('SendSms')
		                          ->method('POST')
		                          ->host('dysmsapi.aliyuncs.com')
		                          ->options([
		                                        'query' => [
		                                          'RegionId' => "cn-hangzhou",
		                                          'PhoneNumbers' => $mobile,
		                                          'SignName' => "口语app",
		                                          'TemplateCode' => "SMS_185211855",
		                                          'TemplateParam' => "{code:$code}",
		                                        ],
		                                    ])
		                          ->request();
		    return $result->toArray();
		} catch (ClientException $e) {
		    return $e->getErrorMessage() . PHP_EOL;
		} catch (ServerException $e) {
		    return $e->getErrorMessage() . PHP_EOL;
		}
    }

    //邮箱发送
    public function sendEmail(Request $request){
    	$email=$request->email;
    	$reg='/^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/';
    	if(!preg_match($reg,$email)){
    		echo json_encode(['code'=>'00001','msg'=>'邮箱格式不正确。']);exit;
    	}
    	$code=rand(100000,999999);
    	$this->sendByEmail($email,$code);
    	session('code',$code);
    	echo json_encode(['code'=>'00000','msg'=>'发送成功。']);exit;
    }

    public function sendByEmail($email,$code){
    	Mail::to($email)->send(new SendCode($code));
    }

    //注册方法
    public function register(){
    	$register=request()->except('_token','code','repassword');
    	$res=Register::insert($register);
    	if($res){
    		return redirect('/login');
    	}
    }

    public function loginDo(){
    	$login=request()->except('_token');
    	$pwd=Register::where('name',$login['name'])->first();
    	if($pwd['password']!=$login['password']){
    		return redirect('/login')->with('msg','登陆失败。');
    	}
        session(['pwd'=>$pwd]);
        if($login['refer']){
            return redirect($login['refer']);
        }
    	return redirect('/');
    }
}
