<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Base
{
    //
    protected $table = 'users';
     //指定删除的字段标识
    // protected $dates = ['users'];
    public $timestamps = true;

    // 获取器        get+字段名+Attribute($value)
    public function getCreatedAtAttribute($value) {
        return date('Y年m月d日 H时i分s秒', strtotime($value));
    }
}
