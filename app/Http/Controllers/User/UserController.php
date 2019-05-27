<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\UserInfo;

class UserController extends Controller
{

    //用户信息写入
    public function UAdd(Request $request)
    {
        $data = $request->post('userdata');
        if ($data['uid']) {
            $Dres = UserInfo::insert($data);
            if($Dres){
                $res =  ['stat'=>800,'message'=>'用户信息添加成功','data'=>$data];
            }else{
                $res = ['stat'=>202,'message'=>'数据库请求出错,请联系后台人员'];
            }
        }else {
            $res = ['stat'=>201,'message'=>'没有用户id，无法添加'];
        }
        return $res;

    }

    //用户信息查询
    public function getUContent(Request $request){
        $uid = $request->get('uid');
        if($uid){
            $data = UserInfo::where('uid',$uid)->get();
            if ($data) {
                $res =  ['stat'=>900,'message'=>'用户信息添加成功','data'=>$data];
            }else{
                $res = ['stat'=>202,'message'=>'数据库请求出错,请联系后台人员'];
            }
        }else {
            $res = ['stat'=>201,'message'=>'没有用户id，无法添加'];
        }
        return $res;
    }

    public function phone(Request $request){
        $iphone=$request->get('iphone');
        $code=rand(1000,9999);
        // setcookie('code',$code,time()+600);
        response('Hello Cookie')->cookie('code', $code,time()+600);
        //把URL地址改成你自己就好了，把手机号码和信息模板套进去就行
        
        //$url='http://api.sms.cn/sms/?=send&uid=XXX&pwd=61dfa5a45c06bf691767d35bcb197595&template=384859&mobile='.$iphone.'&content={"code":"'.$code.'"}';
        $url='http://api.sms.cn/sms/?ac=send&uid=lxd13166992115&pwd=40f1f605954cac27c37d7eea7033b09d&template=100006&mobile='.$iphone.'&content={"code":"'.$code.'"}';
        $data=array();
        $data['phone'] = $iphone;
        $method='GET';
        $res=$this->curlPost($url,$data,$method);

        return $res;
    }


    public function register_phone(Request $request)
    {
        $phone = $request->post('name');
        $code = $request->post('code');
        $password = $request->post('password');
        $Acode = Cookie::get('code');
        if($Acode == $code)
        {
            $bool = DB::table('users')->insert(['phone'=>$phone,'password'=>$password]);
            if($bool)
            {
                $data = ['stat'=>200,'message'=>'注册成功'];
            }else{
                $data = ['stat'=>201,'message'=>'注册成功失败，插入数据失败'];
            }
        }
        else{
            $data = ['stat'=>201,'message'=>'注册成功失败，验证码不正确'];
        }
        return json_encode($data);
    }


    public function register(Request $request)
    {
        $name = $request->post('name');
        $data= [
            'name'=>$request->post('name'),
            'header_img'=>$request->post('header_img'),
        ];
        $res_name =DB::table('users')->where('name',$name)->first('id');
        if(empty($res_name)){
            $id = User::insertGetId($data);
            if($id)
            {
                $res = ['stat'=>200,'message'=>'注册成功','uid'=>$id];
            }else{
                $res = ['stat'=>202,'message'=>'数据库请求出错,请联系后台人员'];
            }
        }else{
            $res = ['stat'=>201,'message'=>'用户已经注册，可直接登录','uid'=>$res_name->id];
        }
        
        return json_encode($res);
    }

    public function getinfo(Request $request)
    {
        $uid = $request->post('uid');
        if(empty($uid))
        {
            $res =  ['stat'=>401,'message'=>'查询用户信息失败 没有传给uid'];
        }else{
            $data = User::where('id',$uid)->first();
            if(empty($data)){
                $res = ['stat'=>202,'message'=>'数据库请求出错,请联系后台人员'];
            }else{
                $res =  ['stat'=>400,'message'=>'查询用户信息成功','data'=>$data];
            }
        }
       
        return json_encode($res);
    }










    /*curlpost传值*/
    public function curlPost($url,$data,$method){
        $ch = curl_init(); //1.初始化
        curl_setopt($ch, CURLOPT_URL, $url); //2.请求地址
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);//3.请求方式
        //4.参数如下
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);//https
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');//模拟浏览器
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER,array('Accept-Encoding: gzip, deflate'));//gzip解压内容
        curl_setopt($ch, CURLOPT_ENCODING, 'gzip,deflate');
        if($method=="POST"){//5.post方式的时候添加数据
             curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        }
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $tmpInfo = curl_exec($ch);//6.执行
        if (curl_errno($ch)) {//7.如果出错
             return curl_error($ch);
        }
        curl_close($ch);//8.关闭
        return $tmpInfo;
    }



    
}
