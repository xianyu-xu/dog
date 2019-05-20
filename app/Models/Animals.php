<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Animals extends Base
{
    //
    protected $table='animals';

    protected $guarded = []; //黑名单
    
    public $timestamps = true;
    protected $fillable=[];//白名单

    static function  add($data)
    {
        if(empty($data)){
            $res =  ['stat'=>501,'message'=>'宠物信息错误'];
        }else{
            $bool = DB::table('animals')->where('animal_name',$data['animal_name'])->exists();
            if($bool)
            {
                $res =  ['stat'=>601,'message'=>'宠物名称已存在'];
            }else{
                $id = DB::table('animals')->insert($data);
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


    static function  content($data){
        if(empty($data)){
            
            $res =  ['stat'=>702,'message'=>'没有宠物id'];
        }else{
            $data = DB::table('animals')->where('id',$data)->get();
            if(empty($data)){
                $res = ['stat'=>202,'message'=>'数据库请求出错,请联系后台人员'];
            }else{
                $res =  ['stat'=>700,'message'=>'查询宠物信息成功','data'=>$data];
            }
        
        }
        return $res;
    }

    static function del($id)
    {
        if(empty($id)){
            $res =  ['stat'=>802,'message'=>'没有宠物id'];
        }else{
            $dres = Animals::destroy($id);
            if($dres){
                $res =  ['stat'=>700,'message'=>'删除宠物信息成功'];
            }else{
                $res = ['stat'=>202,'message'=>'数据库请求出错,请联系后台人员'];
            }
        }
        return $res;
    }

}
