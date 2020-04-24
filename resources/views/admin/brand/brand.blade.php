
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8"> 
  <title>Bootstrap 2020年中国最大电商城--品牌管理</title>
  <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
  <script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
  <script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<center><h2>品牌管理<a style="float:right;" href="{{url('/brand')}}" class="btn btn-success">列表</a></hr></h2><hr/></center>
<!--@if($errors->any())
<div>
  <ul>
    @foreach($errors->all() as $error)
    <li>{{$error}}</li>
    @endforeach
  </ul>
</div>
@endif-->
<form action="{{url('/brand/addDo')}}" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
@csrf
<!-- {{csrf_field()}}
<input type="hidden" name="_token" value="{{csrf_token()}}"> -->
<div class="form-group">
    <label for="firstname" class="col-sm-2 control-label">品牌名称</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="brand_name" id="firstname" 
           placeholder="请输入品牌名称">
           <b style="color:red">{{$errors->first('brand_name')}}</b>
    </div>
  </div>
  <div class="form-group">
    <label for="lastname" class="col-sm-2 control-label">品牌网址</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="brand_url"  id="lastname" 
           placeholder="请输入品牌网址">
           <b style="color:red">{{$errors->first('brand_url')}}</b>
    </div>
  </div>
    <div class="form-group">
    <label for="lastname" class="col-sm-2 control-label">品牌logo</label>
    <div class="col-sm-10">
      <input type="file" class="form-control" name="brand_logo" id="lastname" 
           placeholder="请输入品牌logo">
    </div>
    </div>
    <div class="form-group">
    <label for="lastname" class="col-sm-2 control-label">品牌描述</label>
    <div class="col-sm-10">
      <textarea type="text" class="form-control" name="brand_desc" id="lastname" 
           placeholder="请输入品牌描述"></textarea>
    </div>
    </div>
  
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default">提交</button>
    </div>
  </div>
</form>

</body>
</html>
