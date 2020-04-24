
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>Bootstrap 实例 - 一个简单的网页</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
	

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#">微商城</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="{{url('/brand')}}">商品品牌</a></li>
        <li><a href="{{url('/category')}}">商品分类</a></li>
        <li class="active"><a href="{{url('/goods')}}">商品管理</a></li>
		<li><a href="{{url('/admin')}}">管理员管理</a></li>
		<li><a href="{{url('/url')}}">友情链接管理</a></li>
      </ul>
    </div>
  </div>
</nav>
<center>
	<b style="color: red;">
    	<div>
		欢迎【】登录
		</div>
    </b>
</center>
<center><h2>商品管理 <a style="float:right;" href="{{url('/goods/create')}}" class="btn btn-success">添加</a></hr></h2></center>
<form>
	分类<select name="cate_id">
          <option value="">请选择分类</option>
          @foreach($category as $v)
          <option value="{{$v->cate_id}}" @if(isset($query['cate_id']) && $v->cate_id==$query['cate_id']) selected="selected" @endif>{{str_repeat('---',$v->level)}}{{$v->cate_name}}</option>
          @endforeach
        </select>
	品牌<select name="brand_id">
		<option value="0">请选择...</option>
		@foreach($brand as $v)
		<option value="{{$v->brand_id}}" @if(isset($query['brand_id']) && $v->brand_id==$query['brand_id']) selected="selected" @endif>{{$v->brand_name}}</option>
		@endforeach
	</select>
	名称<input type="text" name="goods_name" value="{{$query['goods_name']??''}}">
	<input type="submit" value="搜索">
</form>
<table class="table table-striped">
	<caption></caption>
	<thead>
		<tr>
			<th>商品id</th>
			<th>商品名称</th>
			<th>商品货号</th>
			<th>商品分类</th>
			<th>商品品牌</th>
			<th>商品单价</th>
			<th>商品库存</th>
			<th>是否显示</th>
			<th>是否新品</th>
			<th>是否精品</th>
			<th>商品图片</th>
			<th>商品相册</th>
			<th>商品描述</th>
			<td>操作</td>
		</tr>
	</thead>
	@foreach($res as $v)
	<tbody>
		<tr>
			<td>{{$v->goods_id}}</td>
			<td>{{$v->goods_name}}</td>
			<td>{{$v->goods_h}}</td>
			<td>{{$v->cate_name}}</td>
			<td>{{$v->brand_name}}</td>
			<td>{{$v->goods_price}}</td>
			<td>{{$v->goods_num}}</td>
			<td>{{$v['is_show']==1?"是":"否"}}</td>
			<td>{{$v['is_new']==1?"是":"否"}}</td>
			<td>{{$v['is_best']==1?"是":"否"}}</td>
			<td>@if($v->goods_img)<img src="{{env('UPLOADS_URL')}}{{$v->goods_img}}" width="100">@endif</td>
			<td>
				@if(isset($v->goods_imgs))
				@php $imgs=explode('|',$v->goods_imgs);@endphp
				@foreach($imgs as $img)
				<img width="100" src="{{env('UPLOADS_URL')}}{{$img}}">
				@endforeach
				@endif
			</td>
			<td>{{$v->goods_desc}}</td>
			<td><a href="{{url('/goods/edit/'.$v->goods_id)}}" class="btn btn-success">
			编辑</a> | <a  href="{{url('/goods/destroy/'.$v->goods_id)}}" class="btn btn-danger">
			删除</a></td>
		</tr>
	</tbody>
	@endforeach
	<tr>
		<td colspan="6" align="center">
			{{$res->links()}}
		</td>
	</tr>
</table>

</body>
</html>
