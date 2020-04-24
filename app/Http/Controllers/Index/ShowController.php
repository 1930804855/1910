<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Goods;
use App\Cart;
use Illuminate\Support\Facades\Redis;

class ShowController extends Controller
{
    public function show($id){
        $visit=Redis::setnx('visit_'.$id,1)?1:Redis::incr('visit_'.$id);
    	$info=Goods::find($id);
    	return view('index/show',['info'=>$info,'visit'=>$visit]);
    }

    public function addcar(){
    	$goods_id=request()->goods_id;
    	$buy_number=request()->buy_number;
    	$user=session('pwd');
    	if(!$user){
    		echo json_encode(['code'=>'00002','msg'=>'请先登录。']);die;
    	}
    	$goods=Goods::select('goods_id','goods_name','goods_img','goods_price','goods_nums')->find($goods_id);
    	if($goods->goods_nums<$buy_number){
    		echo json_encode(['code'=>'00001','msg'=>'库存不足']);die;
    	}
    	$where=[
    		'user_id'=>$user->u_id,
    		'goods_id'=>$goods_id
    	];
    	$cart=Cart::where($where)->first();
    	if($cart){
    		//更新
    		$buy_number=$cart->buy_number+$buy_number;
    		if($goods->goods_nums<$buy_number){
    			$buy_number=$goods->goods_nums;
    		}
    		$res=Cart::where('cart_id',$cart->cart_id)->update(['buy_number'=>$buy_number]);
    	}else{
    		//添加
    		$data=[
    			'user_id'=>$user->u_id,
    			'buy_number'=>$buy_number,
    			'addtime'=>time()
    		];
    		$data=array_merge($data,$goods->toArray());
    		unset($data['goods_nums']);
    		$res=Cart::create($data);
    	}
    	if($res!==false){
    		echo json_encode(['code'=>'00000','msg'=>'添加成功']);
    	}
    }

    public function cartlist(){
    	//获取用户id
    	$user=session('pwd')->u_id;
    	//查询数据
    	$cartInfo=\DB::select("select * ,buy_number*goods_price as price from cart where user_id=?",[$user]);
    	//获取购买数量
    	$buy_number=array_column($cartInfo,'buy_number');
    	//获取购买数量的和
    	$count=array_sum($buy_number);
    	//获取购物车id
    	$cart_id=array_column($cartInfo,'cart_id');
    	$checkednum=array_combine($cart_id,$buy_number);
    	//总价
    	$money=array_sum(array_column($cartInfo,'price'));
    	//return view('index/cartlist',['cartInfo'=>$cartInfo,'count'=>$count,'checkednum'=>$checkednum]);
    	return view('index/cartlist',compact('cartInfo','count','checkednum','money'));
    }
}
