<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>注册</title>
</head>
<body>
<form action="{{url('login/doregister')}}" method="post">
    @csrf
  <p><b>用户名:</b><input type="text" name="r_name"></p>
  <p><b>密码:</b>  <input type="password" name="r_pwd"> </p>
   <button>注册</button>
</form>
</body>
</html>