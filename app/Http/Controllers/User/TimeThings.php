<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\timeThings as MtimeThings;

class TimeThings extends Controller
{
    //
    public function add(Request $request)
    {
        $data = $request->post('todotings');
        $res = MtimeThings::add($data);
        return json_encode($res);

    }
}
