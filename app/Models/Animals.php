<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Animals extends Base
{
    //
    protected $table=['animals'];



    static function  add($data)
    {
        if(empty($data)){
            $res =  ['stat'=>501,'message'=>'宠物信息错误'];
        }else{
            $bool = Animals::where('animal_name',$data['animal_name'])->exists();
            if($bool)
            {
                $res =  ['stat'=>601,'message'=>'宠物名称已存在'];
            }else{
                $id = Animals::insertGetId($data);
                if($id)
                {
                    $res =  ['stat'=>500,'message'=>'宠物信息添加成功'];
                }else{
                    $res =  ['stat'=>202,'message'=>'数据库请求出错,请联系后台人员'];
                }
            }
            
        }
        return $res;
    }

    static function  getinfo($data){
        if(empty($data)){
            
            $res =  ['stat'=>602,'message'=>'没有用户id'];
        }else{
            $data = DB::table('animals')->where('uid',$data)->get();
            if(empty($data)){
                $res = ['stat'=>202,'message'=>'数据库请求出错,请联系后台人员'];
            }else{
                $res =  ['stat'=>600,'message'=>'查询宠物信息成功','data'=>$data];
            }
        
        }
        return $res;
    }
}
