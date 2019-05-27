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
}
