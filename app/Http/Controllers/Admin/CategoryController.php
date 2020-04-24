<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Category;

class CategoryController extends Controller{
	//添加视图
	public function add(){
		$category=Category::all();
		$category=createTree($category);
		return view('admin.category.add',['category'=>$category]);
	}


	//添加执行
	public function addDo(){
		

		$data=request()->except('_token');

		$res=Category::insert($data);
		if($res){
			return redirect('/category');
		}
	}

	//展示视图
	public function category(){
		$category=Category::get();
		$category=createTree($category);
		return view('admin.category.category',['category'=>$category]);
	}

	//删除执行
	public function delete($id){
		$res=Category::destroy($id);
		if($res){
			return redirect('/category');
		}
	}
	//修改视图
	public function edit($id){
		$res=Category::find($id);
		$category=Category::get();
		$category=createTree($category);
		return view('admin.category.edit',['res'=>$res,'category'=>$category]);
	} 

	//修改执行
	public function update($id){
		$data=request()->except('_token');
		$res=Category::where('cate_id',$id)->update($data);
		if($res!==false){
			return redirect('/category');
		}
	}
}

?>