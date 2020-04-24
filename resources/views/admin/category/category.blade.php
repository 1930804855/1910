
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
        <li class="active"><a href="{{url('/category')}}">商品分类</a></li>
        <li><a href="{{url('/goods')}}">商品管理</a></li>
		<li><a href="{{url('/admin')}}">管理员管理</a></li>
      </ul>
    </div>
  </div>
</nav>
<center><h2>分类管理 <a style="float:right;" href="{{url('/category/add')}}" class="btn btn-success">添加</a></hr></h2></center>
<table class="table table-striped">
	<caption></caption>
	<thead>
		<tr>
			<th>分类id</th>
			<th>分类名称</th>
			<th>分类描述</th>
			<th>是否在导航显示</th>
			<td>操作</td>
		</tr>
	</thead>
	@foreach($category as $v)
	<tbody>
		<tr>
			<td>{{$v->cate_id}}</td>
			<td>{{str_repeat('---',$v->level)}}{{$v->cate_name}}</td>
			<td>{{$v->cate_desc}}</td>
			<td>{{$v->is_show_nav}}</td>
			<td><a href="{{url('/category/edit/'.$v->cate_id)}}" class="btn btn-success">
			编辑</a> | <a  href="{{url('/category/delete/'.$v->cate_id)}}" class="btn btn-danger">
			删除</a></td>
		</tr>
		@endforeach
			</tbody>
</table>

</body>
</html>
