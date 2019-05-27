<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\timeThings as MtimeThings;

class TimeThingsController extends Controller
{
    //
    public function add(Request $request)
    {
        // $data  = $request->all();
        $data = $request->post('todothings');
	    $res = MtimeThings::add($data);
        return json_encode($res);

    }

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
}
