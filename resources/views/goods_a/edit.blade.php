<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>商品库存管理系统</title>
</head>
<body>
<form action="{{url('goods_a/update')}}" method="post" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="goods_id" value="{{$data->goods_id}}">
    <p><b>商品名称:</b><input type="text" name="goods_name" value="{{$data->goods_name}}"></p>
    <p><b>商品图片:</b><input type="file" name="goods_img" value="{{$data->goods_img}}"></p>
    <p><b>库存:</b><input type="text" name="goods_number" value="{{$data->goods_number}}"></p>
    <button>提交</button>
</form>
</body>
</html>