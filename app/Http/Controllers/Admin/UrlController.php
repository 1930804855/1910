<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Url;
use Validator;

class UrlController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $u_name=request()->u_name;
        $where=[];
        if(!empty($u_name)){
            $where[]=['u_name','like',"%$u_name%"];
        }
        //展示视图
        $config=config('app.pageSize');
        $adminInfo=Url::where($where)->paginate($config);
        return view('admin.url.index',['adminInfo'=>$adminInfo,'u_name'=>$u_name]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //添加视图
        
        return view('admin.url.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //添加执行
        $data=request()->except('_token');
        $validator=Validator::make($data,[
            'u_name'=>'required|unique:url|regex:/^\w{1,}$/u',
            'u_url'=>'required',//|regex:/^(http:\/\/)\w{3,}$/u
        ],[
            "u_name.required"=>"网站名称必填",
            "u_name.unique"=>"网站名称已存在",
            "u_name.regex"=>"由中文、字母、数字、下划线组成",
            "u_url.required"=>"网站网址必填",
            "u_url.regex"=>"格式为http://开头",
        ]);
        if($validator->fails()){
            return redirect('url/create')->withErrors($validator)->withInput();
        }
        if(request()->hasFile('u_img')){
            $data['u_img']=upload('u_img');
        }
        // dd($data);
        $res=Url::insert($data);
        if($res){
            return redirect('/url');
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
        $res=Url::find($id);
        return view('admin.url.edit',['res'=>$res]);
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
        $data=request()->except('_token');
        $validator=Validator::make($data,[
            'u_name'=>'required|regex:/^\w{1,}$/u',
            'u_url'=>'required',//|regex:/^(http:\/\/)\w{3,}$/u
        ],[
            "u_name.required"=>"网站名称必填",
            "u_name.unique"=>"网站名称已存在",
            "u_name.regex"=>"由中文、字母、数字、下划线组成",
            "u_url.required"=>"网站网址必填",
            "u_url.regex"=>"格式为http://开头",
        ]);
        if($validator->fails()){
            return redirect('url/edit/'.$id)->withErrors($validator)->withInput();
        }
        $res=Url::where('u_id',$id)->update($data);
        if($res!==false){
            return redirect('/url');
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
        $res=Url::destroy($id);
        $config=config('app.pageSize');
        $adminInfo=Url::paginate($config);
        if($res){
            return view('admin/url/ajaxdestroy',['adminInfo'=>$adminInfo]);
        }
    }
}
