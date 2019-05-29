<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\timeThings as MtimeThings;

class TimeThingsController extends Controller
{
    //添加事件
    public function add(Request $request)
    {
        // $data  = $request->all();
        $data = $request->post('todothings');
	    $res = MtimeThings::add($data);
        return json_encode($res);

    }
    //获取当日全部事件
    public function getThings(Request $request)
    {
        $uid = $request->get('uid');
        $time  = $request->get('time');

        $data = MtimeThings::whereRaw('uid = ? and time = ?',[$uid,$time])->get();
        if($data)
        {
            $res = ['stat'=>803,'message'=>'事件查找成功','data'=>$data];
        }
        return json_encode($res);
    }

    //获取单个事件
    public function getThing(Request $request)
    {
        $id = $request->get('id');

        $data = MtimeThings::find($id);
        if($data)
        {
            $res = ['stat'=>803,'message'=>'事件查找成功','data'=>$data];
        }else{
            $res = ['stat'=>202,'message'=>'数据库请求失败'];
        }
        return json_encode($res);
    }

    //删除事件
    public function delThing(Request $request)
    {
        $id = $request->get('id');
        $result = MtimeThings::destroy($id);
        if($result)
        {
            $res = ['stat'=>804,'message'=>'事件删除成功'];
        }else{
            $res = ['stat'=>805,'message'=>'事件删除失败'];
        }
        return json_encode($res);
    }
}
