<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Goods;

class WenzhangController extends Controller
{
    public function show(){
    	$name=request()->name;
    	$where=[];
    	if($name){
    		$where[]=['goods_name','like',"%$name%"];
    	}
    	$size=config('app.pageSize');
    	$info=Goods::where($where)->paginate($size);
    	return view('index/wenzhang',['info'=>$info,'name'=>$name]);
    }
}
