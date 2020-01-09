<?php

namespace App\Http\Controllers\Api\v1;

use App\LangsModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Lang;

class LangsController extends Controller
{


    public function lang()
    {
//        $r = auth()->user()->name == "مدیر سیستم";
//        if ($r) {
            $c = LangsModel::orderby('id', 'desc')->pluck('id', 'name');
            return $c;
//        }else{
//            return response([
//                'data' => 'شما به این صفحه دسترسی ندارید'
//            ]);
//        }
    }
    public function show($name)
    {
        return LangsModel::where('name',$name)->take(1)->pluck('id','tilte');
    }


}
