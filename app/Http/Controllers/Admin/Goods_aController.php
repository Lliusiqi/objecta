<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Http\Tools\Tools;
class Goods_aController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $tools;
    public function __construct(Tools $tools)
    {
        $this->Tools = $tools;
    }
    public function index()
    {
        $redis=$this->Tools->getRedis();
//        $redis->incr('xxoo');
        $redis = new \Redis();
        $redis->connect('127.0.0.1','6379');
        $redis->incr('xxoo');
        $data=$redis->get('xxoo');
        echo $data."<br/>";
//        echo 111;
//        $data=DB::table('goods_a')->get();
        $query=request()->all();
        $where=[];
        if($query['goods_name']??''){
            $where[]=['goods_name','like',"%$query[goods_name]%"];
        }
        $pagesize=config('app.pageSize');
        $data=DB::table('goods_a')->where($where)->paginate($pagesize);
        $stu_info=$data->toArray();
        $stu_json=json_encode($stu_info);
//        var_dump($stu_json);
        $redis->set('stu_info',$stu_json,10);
        return view('goods_a.list',compact('data','query'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
//        echo 111;
        $redis = new \Redis();
        $redis->connect('127.0.0.1','6379');
        $redis->incr('xxoo');
        $data=$redis->get('xxoo');
        echo $data."<br/>";
        return view('goods_a.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        echo 111;
//        $data=request()->all();
        $data=request()->except(['_token','id']);
//        dd($data);
        $data['create_at']=time();

        if ($request->hasFile('goods_img')) {
            $res=$this->upload($request,'goods_img');
            if($res['code']){
                $data['goods_img']=$res['imgurl'];
            }
        }

        $res=DB::table('goods_a')->insert($data);
//        dd($res);
        if($res){
            return redirect('goods_a/list');
        }
    }
    public function upload(Request $request,$file)
    {
        if ($request->file($file)->isValid()){
            $photo = $request->file($file);
            $store_result = $photo->store(date('Ymd'));
            return ['code'=>1,'imgurl'=>$store_result];
        }else{
            return ['code'=>0,'message'=>'上传过程出错'];
        }

    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
//        echo 111;
        $goods_id=\request()->id;
        $data=DB::table('goods_a')->where('goods_id',$goods_id)->first();
        return view('goods_a.edit',['data'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $data=request()->except('_token');
        $res=DB::table('goods_a')->where('goods_id',$data)->update($data);
//       dd($res);
        if($res){
            return redirect('goods_a/list');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function del()
    {
        $goods_id=request()->all();
//     dd($goods_id);
        $res=DB::table('goods_a')->where('goods_id',$goods_id)->delete();
//     dd($res);
        if($res){
            echo json_encode(['font'=>'删除成功!','code'=>1]);exit;
        }else{
            echo json_encode(['font'=>'删除失败!','code'=>2]);exit;
        }
    }
}
