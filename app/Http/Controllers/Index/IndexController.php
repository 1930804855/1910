<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Goods;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
class IndexController extends Controller
{
    public function index(){
    	//$slide=Cache::get('slide');
    	$slide=Redis::get('slide');
    	if(!$slide){
    		//首页幻灯片
    		$slide=Goods::select('goods_img','goods_id')->where('is_slide',1)->take(5)->get();
    		//Cache::put('slide',$slide,60);
    		$slide=serialize($slide);
    		Redis::setex('slide',60,$slide);
    	}
    	$slide=unserialize($slide);
    	return view('index/index',['slide'=>$slide]);
    }
}
