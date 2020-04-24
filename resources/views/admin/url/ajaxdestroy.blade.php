@foreach($adminInfo as $v)
		<tr>
			<td>{{$v->u_id}}</td>
			<td>{{$v->u_name}}</td>
			<td>{{$v->u_url}}</td>
			<td>{{$v->u_type}}</td>
			<td><img src="{{env('UPLOADS_URL')}}{{$v->u_img}}" width="50px"></td>
			<td>{{$v->u_man}}</td>
			<td>{{$v->u_desc}}</td>
			<td>{{$v->is_show}}</td>
			<td><a href="{{url('/url/edit/'.$v->u_id)}}" class="btn btn-success">
			编辑</a> | <a  href="{{url('/url/destroy/'.$v->u_id)}}" class="btn btn-danger">
			删除</a></td>
		</tr>
		@endforeach
		<tr>
		<td colspan="9" align="center">
			{{$adminInfo->links()}}

		</td>