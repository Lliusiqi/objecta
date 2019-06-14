<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GoodsController extends Controller
{
    public function add()
    {
//        echo 111;
        return view('goods/add');
    }
    public function do_add(Request $request)
    {
        $path = $request->file('img')->store('goods');
//        dd($path);
        echo asset('storage/'.$path);

    }
}
