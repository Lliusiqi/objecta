<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>文件上传</title>
</head>
<body>
<h3>添加商品</h3>
<form action="{{url('goods/do_add')}}" method="post" enctype="multipart/form-data">
    @csrf
    <input type="file" name="img">
    <input type="submit" value="提交">
</form>
</body>
</html>
