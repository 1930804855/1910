
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
        <li class="active"><a href="{{url('/goods')}}">商品管理</a></li>
    <li><a href="{{url('/admin')}}">管理员管理</a></li>
      </ul>
    </div>
  </div>
</nav>
<center><h2>商品修改<a style="float:right;" href="{{url('/goods')}}" class="btn btn-success">列表</a></hr></h2><hr/></center>

<form action="{{url('/goods/update/'.$goods->goods_id)}}" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
@csrf
<!-- {{csrf_field()}}
<input type="hidden" name="_token" value="{{csrf_token()}}"> -->
<div class="form-group">
    <label for="firstname" class="col-sm-2 control-label">商品名称</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" value="{{$goods->goods_name}}" name="goods_name" id="firstname" 
           placeholder="请输入商品名称">
           <b style="color: red">{{$errors->first('goods_name')}}</b>
    </div>
  </div>
  <div class="form-group">
    <label for="firstname" class="col-sm-2 control-label">商品货号</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" value="{{$goods->goods_no}}" name="goods_no" id="firstname" 
           placeholder="请输入商品货号">
    </div>
  </div>
  

  <div class="form-group">
    <label for="lastname" class="col-sm-2 control-label">商品分类</label>
      <div class="col-sm-10">
        <select class="form-control" name="cate_id">
          <option value="">请选择分类</option>
          @foreach($category as $v)
          <option value="{{$v->cate_id}}" {{$goods->cate_id==$v->cate_id ? 'selected' : ''}}>{{str_repeat('---',$v->level)}}{{$v->cate_name}}</option>
          @endforeach
        </select>
        <b style="color: red">{{$errors->first('cate_id')}}</b>
    </div>
  </div>

  <div class="form-group">
    <label for="lastname" class="col-sm-2 control-label">商品品牌</label>
      <div class="col-sm-10">
        <select class="form-control" name="brand_id">
          <option value="">请选择...</option>
          @foreach($res as $v)
          <option value="{{$v->brand_id}}" {{$goods->brand_id==$v->brand_id ? 'selected' : ''}}>{{$v->brand_name}}</option>
          @endforeach
        </select>
        <b style="color: red">{{$errors->first('brand_id')}}</b>
    </div>
  </div>
  <div class="form-group">
    <label for="firstname" class="col-sm-2 control-label">商品单价</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" value="{{$goods->goods_price}}" name="goods_price" id="firstname" 
           placeholder="请输入商品单价">
           <b style="color: red">{{$errors->first('goods_price')}}</b>
    </div>
  </div>
  <div class="form-group">
    <label for="firstname" class="col-sm-2 control-label">商品库存</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" value="{{$goods->goods_nums}}" name="goods_nums" id="firstname" 
           placeholder="请输入商品库存">
           <b style="color: red">{{$errors->first('goods_nums')}}</b>
    </div>
  </div>
    
    
    <div class="form-group">
      <label for="lastname" class="col-sm-2 control-label">是否显示</label>
      <div class="col-sm-10">
        <input type="radio" name="is_show" value="1" {{$goods->is_show==1 ? 'checked' : ''}}>是
        <input type="radio" name="is_show" value="2" {{$goods->is_show==2 ? 'checked' : ''}}>否
      </div>  
    </div>
    <div class="form-group">
      <label for="lastname" class="col-sm-2 control-label">是否新品</label>
      <div class="col-sm-10">
        <input type="radio" name="is_new" value="1" {{$goods->is_new==1 ? 'checked' : ''}}>是
        <input type="radio" name="is_new" value="2" {{$goods->is_new==2 ? 'checked' : ''}}>否
      </div>  
    </div>
    <div class="form-group">
      <label for="lastname" class="col-sm-2 control-label">是否精品</label>
      <div class="col-sm-10">
        <input type="radio" name="is_best" value="1" {{$goods->is_best==1 ? 'checked' : ''}}>是
        <input type="radio" name="is_best" value="2" {{$goods->is_best==2 ? 'checked' : ''}}>否
      </div>  
    </div>
    <div class="form-group">
    <label for="firstname" class="col-sm-2 control-label">商品图片</label>
    <div class="col-sm-10">
      <input type="file" class="form-control" name="goods_img" id="firstname">
      @if($goods->goods_img)<img src="{{env('UPLOADS_URL')}}{{$goods->goods_img}}" width="100">@endif
    </div>
    <div class="form-group">
    <label for="firstname" class="col-sm-2 control-label">商品相册</label>
    <div class="col-sm-10">
      <input type="file" class="form-control" name="goods_imgs[]" id="firstname" multiple="multiple">
    </div>
  </div>
  </div>
    <div class="form-group">
      <label for="lastname" class="col-sm-2 control-label">商品描述</label>
      <div class="col-sm-10">
        <textarea type="text" class="form-control" name="goods_desc" id="lastname" 
           placeholder="请输入商品描述">{{$goods->goods_desc}}</textarea>
      </div>
      
    </div>
  
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default">保存</button>
    </div>
  </div>
</form>

</body>
</html>
