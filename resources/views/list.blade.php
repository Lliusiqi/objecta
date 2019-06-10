<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="/js/jquery-3.3.1.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
<form action="">
    <input type="text" name="s_name" value="" placeholder="请根据学生姓名进行搜索">
    <input type="text" name="s_age" value="" placeholder="请根据学生年龄进行搜索" >
    <button>搜索</button>
</form>
   <table border="1">
       <tr>
           <td>id</td>
           <td>学生姓名</td>
           <td>学生性别</td>
           <td>学生年龄</td>
           <td>操作</td>
       </tr>
       @foreach($data as $v)
       <tr>
           <td>{{$v->s_id}}</td>
           <td>{{$v->s_name}}</td>
           <td>
               @if($v->s_sex=='1')
                   男
               @else
                  女
               @endif
           </td>
           <td>{{$v->s_age}}</td>
           <td>
               <a class="del" id="{{$v->s_id}}">删除</a>
               <a href="/student/edit/?id={{$v->s_id}}">修改</a>
           </td>
       </tr>
       @endforeach
   </table>
   {{$data->appends($query)->links()}}
</body>
</html>
<script>
    $(function(){
        // alert(123);
        $('.del').click(function(){
            var s_id=$(this).attr('id');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url:'/student/delete',
                data:{s_id:s_id},
                type:'post',
                dataType:'json',
                success:function(msg){
                    // console.log(msg);
                    alert(msg.font);
                    location.href='/student/list';
                    // _this.parent().parent().remove();
                }
            })

        })
    });
</script>