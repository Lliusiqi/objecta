<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{asset('css/page.css')}}" rel="stylesheet">
    <script src="/js/jquery-3.3.1.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>商品库存管理系统</title>
</head>
<body>
<form action="">
    <input type="text" name="goods_name" value="" placeholder="请根据商品名称进行搜索">
    <button>搜索</button>
</form>
<table border="1">
    <tr>
        <td>商品id</td>
        <td>商品名称</td>
        <td>商品图片</td>
        <td>商品库存</td>
        <td>添加时间</td>
        <td>操作</td>
    </tr>
    @if($data)
    @foreach($data as $v)
    <tr>
        <td>{{$v->goods_id}}</td>
        <td>{{$v->goods_name}}</td>
        <td><img  style="width:50px; height:50px" src="http://upload.objecta.com/{{$v->goods_img}}"></td>
        <td>{{$v->goods_number}}</td>
        <td>{{date('Y-m-d H:i:s',$v->create_at)}}</td>
        <td>
            <a class="del" id="{{$v->goods_id}}">删除</a>
            <a href="/goods_a/edit/?id={{$v->goods_id}}">修改</a>
        </td>
    </tr>
    @endforeach
    @endif
</table>
{{$data->appends($query)->links()}}
</body>
</html>
<script>
    $(function(){
        // alert(123);
        $('.del').click(function(){
            var goods_id=$(this).attr('id');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url:'/goods_a/delete',
                data:{goods_id:goods_id},
                type:'post',
                dataType:'json',
                success:function(msg){
                    // console.log(msg);
                    alert(msg.font);
                    location.href='/goods_a/list';
                    // _this.parent().parent().remove();
                }
            })

        })
    });
</script>