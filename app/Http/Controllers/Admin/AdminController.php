<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin;
use Validator;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //展示视图
        $adminInfo=Admin::get();
        return view('admin.admin.admin',['adminInfo'=>$adminInfo]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //添加视图
        
        return view('admin.admin.create');
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
            'admin_name'=>'required|unique:admin|regex:/^[\x{4e00}-\x{9fa5}\w]{3,20}$/u',
            'admin_tel'=>'required|max:11',
            'admin_email'=>'required|regex:/^\d{5,}@\w{2,5}.com$/i',
            'admin_pwd'=>'required|regex:/^[A-Za-z0-9]{6,12}$/',
        ],[
            "admin_name.required"=>"管理员名称必填",
            "admin_name.unique"=>"管理员名称已存在",
            "admin_name.regex"=>"由中文、字母、下划线最少三位最多20位",
            "admin_tel.required"=>"手机号必填",
            "admin_tel.max"=>"手机号11位",
            "admin_email.required"=>"邮箱必填",
            "admin_email.regex"=>"邮箱格式错误",
            "admin_pwd.required"=>"密码必填",
            "admin_pwd.regex"=>"密码6-20位",
        ]);
        if($validator->fails()){
            return redirect('admin/create')->withErrors($validator)->withInput();
        }

        $data['admin_time']=time();
        $data['admin_pwd']=encrypt($data['admin_pwd']);
        $res=Admin::insert($data);
        if($res){
            return redirect('/admin');
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
        $res=Admin::find($id);
        return view('admin.admin.edit',['res'=>$res]);
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
            'admin_name'=>'required|regex:/^[\x{4e00}-\x{9fa5}\w]{3,20}$/u',
            'admin_tel'=>'required|max:11',
            'admin_email'=>'required|regex:/^\d{5,}@\w{2,5}.com$/i',
            'admin_pwd'=>'required|regex:/^[A-Za-z0-9]{6,12}$/',
        ],[
            "admin_name.required"=>"管理员名称必填",
            "admin_name.unique"=>"管理员名称已存在",
            "admin_name.regex"=>"由中文、字母、下划线最少三位最多20位",
            "admin_tel.required"=>"手机号必填",
            "admin_tel.max"=>"手机号11位",
            "admin_email.required"=>"邮箱必填",
            "admin_email.regex"=>"邮箱格式错误",
            "admin_pwd.required"=>"密码必填",
            "admin_pwd.regex"=>"密码6-20位",
        ]);
        if($validator->fails()){
            return redirect('admin/create')->withErrors($validator)->withInput();
        }
        $res=Admin::where('admin_id',$id)->update($data);
        if($res!==false){
            return redirect('/admin');
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
        $res=Admin::destroy($id);
        if($res){
            return redirect('/admin');
        }
    }
}
