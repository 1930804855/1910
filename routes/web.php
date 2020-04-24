<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::domain('admin.1910phpa.com')->group(function(){
	//品牌
	Route::prefix('/brand')->middleware('auth')->group(function(){

		
		Route::get('add','Admin\BrandController@add');
		Route::post('addDo','Admin\BrandController@addDo');
		Route::get('/','Admin\BrandController@brand');
		Route::get('delete/{id}','Admin\BrandController@delete');
		Route::get('edit/{id}','Admin\BrandController@edit');
		Route::post('update/{id}','Admin\BrandController@update');
	});
	//分类
	Route::prefix('/category')->middleware('auth')->group(function(){
		Route::get('add','Admin\CategoryController@add');
		Route::get('/','Admin\CategoryController@category');
		Route::post('addDo','Admin\CategoryController@addDo');
		Route::get('delete/{id}','Admin\CategoryController@delete');
		Route::get('edit/{id}','Admin\CategoryController@edit');
		Route::post('update/{id}','Admin\CategoryController@update');
	});
	//商品
	Route::prefix('/goods')->middleware('auth')->group(function(){
		Route::get('/','Admin\GoodsController@index');
		Route::get('create','Admin\GoodsController@create');
		Route::post('store','Admin\GoodsController@store');
		Route::get('edit/{id}','Admin\GoodsController@edit');
		Route::post('update/{id}','Admin\GoodsController@update');
		Route::get('destroy/{id}','Admin\GoodsController@destroy');
	});
	//管理员
	// Route::prefix('/admin')->middleware('islogin')->group(function(){
	Route::prefix('/admin')->middleware('auth')->group(function(){
		Route::get('create','Admin\AdminController@create');
		Route::get('/','Admin\AdminController@index');
		Route::post('store','Admin\AdminController@store');
		Route::get('edit/{id}','Admin\AdminController@edit');
		Route::post('update/{id}','Admin\AdminController@update');
		Route::get('destroy/{id}','Admin\AdminController@destroy');
	});

	//友情链接
	Route::prefix('/url')->middleware('auth')->group(function(){
		Route::get('create','Admin\UrlController@create');
		Route::get('/','Admin\UrlController@index');
		Route::post('store','Admin\UrlController@store');
		Route::get('edit/{id}','Admin\UrlController@edit');
		Route::post('update/{id}','Admin\UrlController@update');
		Route::get('destroy/{id}','Admin\UrlController@destroy');
	});

	//登录
	Route::view('/login','admin/login');
	Route::post('/loginDo','Admin\LoginController@loginDo');
	Auth::routes();

	Route::get('/home', 'HomeController@index')->name('home');
});

Route::domain('www.1910phpa.com')->group(function(){
	//前台
	Route::get('/','Index\IndexController@index')->name('shop.index');
	Route::get('/login','Index\LoginController@login');
	Route::get('/reg','Index\LoginController@reg');
	//手机发送验证码
	Route::post('/sendSms','Index\LoginController@sendSms');
	//邮箱发送
	Route::get('/sendEmail','Index\LoginController@sendEmail');
	//注册路由
	Route::post('/register','Index\LoginController@register');
	Route::post('/loginDo','Index\LoginController@loginDo');
	Route::get('/show/{id}','Index\ShowController@show')->name('shop.show');
	Route::get('/addcar','Index\ShowController@addcar');
	Route::get('/cartlist','Index\ShowController@cartlist')->name('shop.cartlist');
	//测试文章缓存
	Route::get('/wenzhang','Index\WenzhangController@show');
});