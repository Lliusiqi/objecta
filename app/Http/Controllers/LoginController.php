<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class LoginController extends Controller
{
    public function register()
    {
        return view('login.register');
    }

    public function doregister()
    {
//        echo 111;
        $data=request()->except('_token');
//        dd($data);
        if(empty($data['r_name'])){
            echo '用户名不能为空';
        }
        if(empty($data['r_pwd'])){
            echo '密码不能为空';
        }
//        dd($data);
        $res=DB::table('register')->insert(['r_name'=>$data['r_name'],'r_pwd'=>md5($data['r_pwd'])]);
//        dd($res);
        if($res){
            return redirect('login/login');
        }
    }

    public function  login()
    {
        return view('login.login');
    }

    public function dologin()
    {
//      echo 111;
        $data=request()->except('_token');
//        dd($data);
        $res=DB::table("register")->where('r_name','=',$data['r_name'])->where('r_pwd','=',md5($data['r_pwd']))->first();
        if(!empty($res)){
            session(['r_name'=>$data['r_name']]);
//            dd( session('r_name'));
            return redirect('login/list');
        }else{
            return redirect('login/login');
        }
    }
    public function list()
    {
//        echo 111;die;
        return view('login.list');
    }
public function logout(Request $request)
{
//    echo 111;
    $request->session()->forget('r_name');
    return redirect('login/login');
}
}
