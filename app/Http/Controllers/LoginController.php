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
        $r_pwd=md5('r_pwd');
//        dd($r_pwd);
        $res=DB::table('register')->insert($data);
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
        $data=request()->all();
//        dd($data);
        $res=DB::table("register")->where('r_name',$data['r_name'])->get()->toArray();
//        dd($res);
        if($res){
           if($data['r_name']==$res[0]->r_name || $data['r_pwd']==$res[0]->r_pwd){
               return redirect('login/list');
           }
        }else{
            return redirect('login/login');
        }


    }
    public function list()
    {
        echo 111;die;
    }

}
