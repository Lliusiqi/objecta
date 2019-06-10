<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        echo 111;
//        $data=DB::table('student')->get();
//        return view('list',compact('data'));
        $query=request()->all();
        $where=[];
        if($query['s_name']??''){
            $where[]=['s_name','like',"%$query[s_name]%"];
        }
        if($query['s_age']??''){
            $where['s_age']=$query['s_age'];
        }
        $pageSize=config('app.pageSize');
        $data=DB::table('student')->where($where)->paginate($pageSize);
        return view('list',['data'=>$data,'query'=>$query]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        echo 111;die;
       $data=request()->except('_token','s_id');
       //$data=request()->except('s_id');
        $validator = \Validator::make($request->all(), [
           's_name'=>'required',
            's_sex'=>'required',
            's_age'=>'required',
        ],[
          's_name.required'=>'学生名称必填',
            's_sex.required'=>'学生性别必填',
            's_age.required'=>'学生年龄必填',
        ]);
        if ($validator->fails()) {
            return redirect('student/add')
                ->withErrors($validator)
                ->withInput();
        }

        $res=DB::table('student')->insert($data);
//        dd($res);
        if($res==true){
            return redirect('student/list');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $s_id=\request()->id;
        $data=DB::table('student')->where('s_id',$s_id)->first();
        return view('edit',['data'=>$data]);
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
//        echo 111;die;
        $data=request()->except('_token');
//       dd($data);
        $validator = \Validator::make($request->all(), [
            's_name'=>'required',
            's_sex'=>'required',
            's_age'=>'required',
        ],[
            's_name.required'=>'学生名称必填',
            's_sex.required'=>'学生性别必填',
            's_age.required'=>'学生年龄必填',
        ]);
       $res=DB::table('student')->where('s_id',$data)->update($data);
//       dd($res);
        if($res){
            return redirect('student/list');
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
     $s_id=request()->all();
//     dd($s_id);
     $res=DB::table('student')->where('s_id',$s_id)->delete();
//     dd($res);
        if($res){
            echo json_encode(['font'=>'删除成功!','code'=>1]);exit;
        }else{
            echo json_encode(['font'=>'删除失败!','code'=>2]);exit;
        }
    }
}
