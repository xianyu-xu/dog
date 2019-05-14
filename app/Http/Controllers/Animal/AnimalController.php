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
        $res = Animals::add($data);
        return json_encode($res);
    }

    public function animal_getinfo(Request $request){
        $data = $request->post('uid');
        $res = Animals::getinfo($data);

        return json_encode($res);
    }
}
