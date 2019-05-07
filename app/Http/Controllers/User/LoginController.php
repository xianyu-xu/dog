<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    //

    public function register(){
        $iphone=$_POST['iphone'];
        $code=rand(1000,9999);
        setcookie('code',$code,time()+600);
        //把URL地址改成你自己就好了，把手机号码和信息模板套进去就行
        
        #$url='http://api.sms.cn/sms/?=send&uid=XXX&pwd=61dfa5a45c06bf691767d35bcb197595&template=384859&mobile='.$iphone.'&content={"code":"'.$code.'"}';
        $url='http://api.sms.cn/sms/?ac=send&uid=lxd13166992115&pwd=40f1f605954cac27c37d7eea7033b09d&template=100006&mobile='.$iphone.'&content={"code":"'.$code.'"}';
        $data=array();
        $data['phone'] = $iphone;
        $method='POST';
        $res=$this->curlPost($url,$data,$method);
        echo $res;
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
