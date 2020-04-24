<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Goods;
use App\Category;
use App\Brand;
use Validator;
use Illuminate\Validation\Rule;
class GoodsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //设置session
        request()->session()->put('name','zhangsan');
        session(['age'=>18]);

        //删除session
        //request()->session()->forget('age');
        //session(['name'=>null]);

        //获取session
        // echo request()->session()->get('name');
        // echo session('age');

        //取所有
        // dump(request()->session()->all());

        $where=[];
        $cate_id=request()->cate_id;
        if($cate_id){
            $where[]=['goods.cate_id',$cate_id];
        }
        $brand_id=request()->brand_id;
        if($brand_id){
            $where[]=['goods.brand_id',$brand_id];
        }
        $goods_name=request()->goods_name;
        if($goods_name){
            $where[]=['goods_name','like',"%$goods_name%"];
        }
        $cate=Category::all();
        $category=createTree($cate);
        $brand=Brand::all();
        //展示视图
        $pageSize=config('app.pageSize');
        $res=Goods::select('goods.*','category.cate_name','brand.brand_name')
        ->leftjoin("brand","goods.brand_id","=","brand.brand_id")
        ->leftjoin("category","goods.cate_id","=","category.cate_id")
        ->where($where)
        ->paginate($pageSize);
        $query=request()->all();
        return view('admin.goods.index',['res'=>$res,'category'=>$category,'brand'=>$brand,'query'=>$query]);
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //添加视图
        $res=Brand::all();
         $category=Category::all();
        $category=createTree($category);
        return view('admin.goods.create',['res'=>$res,'category'=>$category]);
    }

   

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //添加方法
        $data=$request->except(['_token']);
        $validator=Validator::make($data,[
            'goods_name'=>'required|unique:goods|max:50|min:2',
            'cate_id'=>'required',
            'brand_id'=>'required',
            'goods_nums'=>'required',
            'goods_price'=>'required',
        ],[
            'goods_name.required'=>'商品名称必填！',
            'goods_name.unique'=>'商品名称已存在！',
            'goods_name.max'=>'商品名称在2到50位之间',
            'goods_name.min'=>'商品名称在2到50位之间',
            'cate_id.required'=>'商品分类必填！',
            'brand_id.required'=>'商品品牌必填！',
            'goods_nums.required'=>'商品库存必填！',
            'goods_price.required'=>'商品单价必填！',
        ]);
        if($validator->fails()){
            return redirect('goods/create')->withErrors($validator)->withInput();
        }

        //上传商品相册
        if(isset($data['goods_imgs'])){
            $imgs=MoreUpload('goods_imgs');
            $data['goods_imgs']=implode('|',$imgs);
        }

        //如果有文件信息，就调用其方法执行文件上传
        if(request()->hasFile('goods_img')){
            $data['goods_img']=upload('goods_img');
        }
        //实现添加
        $res=Goods::insert($data);
        if($res){
            return redirect('/goods');
        }
    }

   
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //修改视图
         $res=Brand::all();
         $category=Category::all();
        $category=createTree($category);
        $goods=Goods::find($id);
        return view('admin.goods.edit',['goods'=>$goods,'res'=>$res,'category'=>$category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //修改执行
        $data=$request->except(['_token']);
        $validator=Validator::make($data,[
            'goods_name'=>[
                'required',
                Rule::unique('goods')->ignore($id,'goods_id'),
                'max:50|min:2'
            ],
            'cate_id'=>'required',
            'brand_id'=>'required',
            'goods_nums'=>'required',
            'goods_price'=>'required',
        ],[
            'goods_name.required'=>'商品名称必填！',
            'goods_name.unique'=>'商品名称已存在！',
            'goods_name.max'=>'商品名称在2到50位之间',
            'goods_name.min'=>'商品名称在2到50位之间',
            'cate_id.required'=>'商品分类必填！',
            'brand_id.required'=>'商品品牌必填！',
            'goods_nums.required'=>'商品库存必填！',
            'goods_price.required'=>'商品单价必填！',
        ]);
        if($validator->fails()){
            return redirect('goods/edit/'.$id)->withErrors($validator)->withInput();
        }

        if(!empty($data['goods_img'])){
            $goods_img=Goods::where('goods_id',$id)->value('goods_img');
            if($data['goods_img']){
                unlink(storage_path('app/'.$goods_img));
            }
        }
        //上传文件
        if(request()->hasFile('goods_img')){
            $data['goods_img']=upload('goods_img');
        }
        $res=Goods::where('goods_id',$id)->update($data);
        if($res!==false){
            return redirect('/goods');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //删除方法
        $res=Goods::where('goods_id',$id)->delete();
        if($res){
            return redirect('/goods');
        }
    }
}
