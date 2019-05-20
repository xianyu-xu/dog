<?php

namespace App\Http\Controllers\Animal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Animals;

class AnimalController extends Controller
{
    //
    public function animal_add(Request $request)
    {
        $data = $request->post('animal_data');
        // $data = $request->all();
        $res = Animals::add($data);
        return json_encode($res);
    }

    //获取宠物信息
    public function animal_getinfo(Request $request){
        $data = $request->post('uid');
        $res = Animals::getinfo($data);

        return json_encode($res);
    }
    //获取宠物详情
    public function animal_content(Request $request){
        $id = $request->get('id');
        $res = Animals::content($id);

        return json_encode($res);
    }

    //删除宠物
    public function animal_del(Request $request)
    {
        $id = $request->get('id');
       
        if(empty($id)){
            $res =  ['stat'=>802,'message'=>'没有宠物id'];
        }else{
            $dres = Animal::destory($id);
            if($dres){
                $res = ['stat'=>202,'message'=>'数据库请求出错,请联系后台人员'];
            }else{
                $res =  ['stat'=>700,'message'=>'删除宠物信息成功'];
            }
        }
        return $res;
    }
}
