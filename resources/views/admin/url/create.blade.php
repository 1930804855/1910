
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8"> 
  <title>Bootstrap 2020年中国最大电商城--分类管理</title>
  <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
  <script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
  <script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
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
<center><h2>友情链接添加<a style="float:right;" href="{{url('/url')}}" class="btn btn-success">列表</a></hr></h2><hr/></center>

<form action="{{url('/url/store')}}" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
@csrf
<!-- {{csrf_field()}}
<input type="hidden" name="_token" value="{{csrf_token()}}"> -->
<div class="form-group">
    <label for="firstname" class="col-sm-2 control-label">网站名称：</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="u_name" id="firstname" 
           placeholder="请输入网站名称">
           <b style="color: red">{{$errors->first('u_name')}}</b>
    </div>
  </div>
  <div class="form-group">
    <label for="firstname" class="col-sm-2 control-label">网站网址：</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="u_url" id="firstname" 
           placeholder="请输入网站网址">
           <b style="color: red">{{$errors->first('u_url')}}</b>
    </div>
  </div>
  <div class="form-group">
    <label for="firstname" class="col-sm-2 control-label">链接类型：</label>
    <div class="col-sm-10">
      <input type="radio" name="u_type" value="1" id="firstname">LOGO链接
      <input type="radio" name="u_type" value="2" id="firstname">文字链接
    </div>
  </div>
  <div class="form-group">
    <label for="firstname" class="col-sm-2 control-label">图片LOGO：</label>
    <div class="col-sm-10">
      <input type="file" class="form-control" name="u_img" id="firstname">
    </div>
  </div>
  <div class="form-group">
    <label for="firstname" class="col-sm-2 control-label">网站联系人：</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="u_man" id="firstname" 
           placeholder="请输入网站联系人">
    </div>
  </div>
  <div class="form-group">
    <label for="firstname" class="col-sm-2 control-label">网站介绍：</label>
    <div class="col-sm-10">
      <textarea class="form-control" name="u_desc"></textarea>
    </div>
  </div>
  <div class="form-group">
    <label for="firstname" class="col-sm-2 control-label">是否显示：</label>
    <div class="col-sm-10">
      <input type="radio" name="is_show" value="1" id="firstname">是
      <input type="radio" name="is_show" value="2" id="firstname">否
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
