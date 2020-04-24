<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<center>
	<form>
		<input type="text" name="name" value="{{$name}}">
		<input type="submit" value="搜索">
	</form>
	<table border="1">
		<tr>
			<th>文章id</th>
			<th>文章标题</th>
			<th>文章序号</th>
		</tr>
		@foreach($info as $k=>$v)
		<tr>
			<td>{{$v->goods_id}}</td>
			<td>{{$v->goods_name}}</td>
			<td>{{$v->goods_no}}</td>
		</tr>
		@endforeach
	</table>
	{{$info->appends(['name'=>$name])->links()}}
</center>
</body>
</html>