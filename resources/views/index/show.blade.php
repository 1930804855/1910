@extends('layouts.shop')
@section('title',$info->goods_name)
@section('content')
     <header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <h1>产品详情</h1>
      </div>
     </header>
     <div id="sliderA" class="slider">
      @if(isset($info->goods_imgs))
      @php $imgs=explode('|',$info->goods_imgs); @endphp
      @foreach($imgs as $k=>$v)
      <img src="{{env('UPLOADS_URL')}}{{$v}}" />
      @endforeach
      @endif
     </div><!--sliderA/-->
     <table class="jia-len">
      <tr>
       <th><strong class="orange">{{$info->goods_price}}</strong></th>
       <td>
        <input type="text" id="buy_number" class="spinnerExample" />
       </td>
      </tr>
      <tr>
       <td>
        <strong>{{$info->goods_name}}</strong>
        <p class="hui">富含纤维素，平衡每日膳食<span>浏览量：{{$visit}}</span></p>
       </td>
       <td align="right">
        <a href="javascript:;" class="shoucang"><span class="glyphicon glyphicon-star-empty"></span></a>
       </td>
      </tr>
     </table>
     <div class="height2"></div>
     <h3 class="proTitle">商品规格</h3>
     <ul class="guige">
      <li class="guigeCur"><a href="javascript:;">50ML</a></li>
      <li><a href="javascript:;">100ML</a></li>
      <li><a href="javascript:;">150ML</a></li>
      <li><a href="javascript:;">200ML</a></li>
      <li><a href="javascript:;">300ML</a></li>
      <div class="clearfix"></div>
     </ul><!--guige/-->
     <div class="height2"></div>
     <div class="zhaieq">
      <a href="javascript:;" class="zhaiCur">商品简介</a>
      <a href="javascript:;">商品参数</a>
      <a href="javascript:;" style="background:none;">订购列表</a>
      <div class="clearfix"></div>
     </div><!--zhaieq/-->
     <div class="proinfoList">
      <img src="/static/index/images/image4.jpg" width="636" height="822" />
     </div><!--proinfoList/-->
     <div class="proinfoList">
      暂无信息....
     </div><!--proinfoList/-->
     <div class="proinfoList">
      暂无信息......
     </div><!--proinfoList/-->
     <table class="jrgwc">
      <tr>
       <th>
        <a href="index.html"><span class="glyphicon glyphicon-home"></span></a>
       </th>
       <td><a class="addcar" href="javascript::void(0)">加入购物车</a></td>
      </tr>
     </table>
    </div><!--maincont-->
    <script type="text/javascript">
        $('.addcar').click(function(){
            var goods_id="{{$info->goods_id}}"
            var buy_number=$('#buy_number').val()
            $.get('/addcar',{goods_id:goods_id,buy_number:buy_number},function(res){
                if(res.code=='00002'){
                    alert(res.msg)
                    location.href="/login?refer="+window.location.href
                }
                if(res.code=='00000'){
                    location.href='/cartlist'
                }
            },'json')
        })
    </script>
    @include('index/public/foot');
@endsection