<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(){
    	return view('index',['name'=>'问问']);
    }

    public function addDo(){
    	$post=request()->all();
    	dd($post);
    }

    public function goods($id,$name='dd'){
    	echo $id;
    	dd($name);
    }
}
