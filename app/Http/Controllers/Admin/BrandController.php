<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use DB;
use App\Brand;
use App\Http\Requests\StoreBrandPost;
use Validator;
use Illuminate\Validation\Rule;
class BrandController extends Controller
{
    //添加视图
    public function add(){
        return view('admin.brand.brand');
    } 

    //添加执行
    public function addDo(Request $request){
        //验证
        // request()->validate([
        //     'brand_name'=>'required|unique:brand|max:20',
        //     'brand_url'=>'required',
        // ],[
        //     'brand_name.required'=>'品牌名称必填!',
        //     'brand_name.unique'=>'品牌名称已存在!',
        //     'brand_name.max'=>'品牌名称最大长度为20位!',
        //     'brand_url.required'=>'品牌网址必填!',
        // ]);
        //第三种验证
        $data=request()->except(['_token']);
        $validator=Validator::make($data,[
            'brand_name'=>'required|unique:brand|max:20',
            'brand_url'=>'required',
        ],[
            'brand_name.required'=>'品牌名称必填!',
            'brand_name.unique'=>'品牌名称已存在!',
            'brand_name.max'=>'品牌名称最大长度为20位!',
            'brand_url.required'=>'品牌网址必填!',
        ]);
        if($validator->fails()){
            return redirect('brand/add')->withErrors($validator)->withInput();
        }

    	

    	//如果有文件信息，就调用方法执行文件上传
    	if(request()->hasFile('brand_logo')){
    		$data['brand_logo']=$this->upload('brand_logo');
    	}

    	//$res=DB::table('brand')->insert($data);
    	//orm操作
    	$res=Brand::insert($data);
    	if($res){
    		return redirect('/brand');
    	}
    }

    //文件上传
    public function upload($filename){
    	//判断上传文件过程中是否出错
    	if(request()->file($filename)->isValid()){
    		//正确就接收上传文件
    		$file=request()->$filename;

    		//保存进目录
    		$path=$file->store('uploads');
    		return $path;
    	}
    	exit('文件上传出错！');
    }

    //展示视图
    public function brand(){
        //搜索
        //接收brand_name
        $brand_name=request()->brand_name;
        $where=[];
        if($brand_name){
            $where[]=['brand_name','like',"%$brand_name%"];
        }

        //分页
        $pageSize=config('app.pageSize');

    	//$brand=DB::table('brand')->get();
    	//orm操作
    	$brand=Brand::orderBy('brand_id','desc')->where($where)->paginate($pageSize);
        //判断是否是ajax请求
        if(request()->ajax()){
            return view('admin.brand.ajaxlists',['brand'=>$brand,'brand_name'=>$brand_name]);
        }
    	return view('admin.brand.lists',['brand'=>$brand,'brand_name'=>$brand_name]);
    }
    //删除
    public function delete($id){
    	// $brand_logo=DB::table('brand')->where('brand_id',$id)->value('brand_logo');
    	// if($brand_logo){
    	// 	unlink(storage_path('app/'.$brand_logo));
    	// }
    	//$res=DB::table('brand')->where('brand_id',$id)->delete();
    	//orm操作
    	$res=Brand::destroy($id);
    	if($res){
    		return redirect('/brand');
    	}
    }

    //修改视图
    public function edit($id){

    	//$brand=DB::table('brand')->where('brand_id',$id)->first();
    	//orm操作
    	$brand=Brand::find($id);
    	return view('admin.brand.edit',['brand'=>$brand]);
    }

    //修改执行
    public function update($id){
    	$data=request()->except('_token');
         $validator=Validator::make($data,[
            'brand_name'=>[
                'required',
                Rule::unique('brand')->ignore($id,'brand_id'),
                'max:20'
            ],
            'brand_url'=>'required',
        ],[
            'brand_name.required'=>'品牌名称必填!',
            'brand_name.unique'=>'品牌名称已存在!',
            'brand_name.max'=>'品牌名称最大长度为20位!',
            'brand_url.required'=>'品牌网址必填!',
        ]);
         if($validator->fails()){
            return redirect('brand/edit/'.$id)->withErrors($validator)->withInput();
        }
    	if(!empty($data['brand_logo'])){
    		$brand_logo=DB::table('brand')->where('brand_id',$id)->value('brand_logo');
    		if($data['brand_logo']){
    			unlink(storage_path('app/'.$brand_logo));
    		}
    	}
    	
    	//如果有文件信息，就调用方法执行文件上传
    	if(request()->hasFile('brand_logo')){
    		$data['brand_logo']=$this->upload('brand_logo');
    	}
    	//$res=DB::table('brand')->where('brand_id',$id)->update($data);
    	//orm操作
    	$res=Brand::where('brand_id',$id)->update($data);
    	if($res!==false){
    		return redirect('/brand');
    	}
    }
}

?>