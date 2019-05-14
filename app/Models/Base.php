<?php

namespace App\Models;
// use App\Models\traits\Query;
use Illuminate\Database\Eloquent\Model;

class Base extends Model
{
    //
    // use Query;
    protected $guarded = [];

    public $timestamps = true;
}
