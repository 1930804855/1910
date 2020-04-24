
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
        <li><a href="{{url('/goods')}}">商品管理</a></li>
		<li><a href="{{url('/admin')}}">管理员管理</a></li>
		<li class="active"><a href="{{url('/url')}}">友情链接管理</a></li>
      </ul>
    </div>
  </div>
</nav>
<center><h2>友情链接管理 <a style="float:right;" href="{{url('/url/create')}}" class="btn btn-success">添加</a></hr></h2></center>
<form>
	网站名称：<input type="text" name="u_name" value="{{$u_name}}" placeholder="请输入网站名称进行搜索">
	<input type="submit" value="搜索">
</form>
<table class="table table-striped">
	<caption></caption>
	<thead>
		<tr>
			<th>网站id</th>
			<th>网站名称</th>
			<th>网站网址</th>
			<th>链接类型</th>
			<th>图片LOGO</th>
			<th>网站联系人</th>
			<th>网站介绍</th>
			<th>是否显示</th>
			<td>操作</td>
		</tr>
	</thead>
	<tbody>
		@foreach($adminInfo as $v)
		<tr>
			<td>{{$v->u_id}}</td>
			<td>{{$v->u_name}}</td>
			<td>{{$v->u_url}}</td>
			<td>{{$v->u_type==1 ? 'LOGO链接' : '文字链接'}}</td>
			<td><img src="{{env('UPLOADS_URL')}}{{$v->u_img}}" width="50px"></td>
			<td>{{$v->u_man}}</td>
			<td>{{$v->u_desc}}</td>
			<td>{{$v->is_show==1 ? '是' : '否'}}</td>
			<td><a href="{{url('/url/edit/'.$v->u_id)}}" class="btn btn-success">
			编辑</a> | <a  href="{{url('/url/destroy/'.$v->u_id)}}" class="btn btn-danger">
			删除</a></td>
		</tr>
		@endforeach
		<tr>
			<td colspan="9" align="center">
				{{$adminInfo->appends(['u_name'=>$u_name])->links()}}

			</td>
		</tr>
	</tbody>
	
</table>

</body>
</html>
<script type="text/javascript">
	//删除点击事件
	$(document).on('click','.btn-danger',function(){
		//获取路径
		var url=$(this).prop('href')
		$.get(url,function(res){
			$('tbody').html(res)
		})
		return false
	})
</script>
