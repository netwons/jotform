<?php

namespace App\Http\Controllers\Api\v1;

use App\LangsModel;
use App\TemplatesModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Lang;

class TemplatesController extends Controller
{
    public function templates(Request $request,$name)
    {
        $r = auth()->user()->name == "مدیر سیستم";
        if ($r) {
            $valiDate = $this->validate($request, [
                //'name'=>'required',
            ]);
            auth()->user()->templates()->create([
                'name' => $name,
            ]);
            return response([
                'data' => [
                    'message' => 'template is registered',
                ],
                'status' => 'success',
            ]);
        }else{
            return response([
               'message'=>'you do not have accessto this page'
            ]);
        }
    }

    public function templates1(Request $request,$name,$fa)
    {
        $r = auth()->user()->name == "مدیر سیستم";
        if ($r) {
            $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
            $valiDate = $this->validate($request, [
                //  'name'=>'required',
            ]);
            auth()->user()->templates()->create([
                'name' => $name,
            ]);
            return response([
                'data' => [
                    'message' => 'تمپلت ثبت شد',
                    'زبان' => $q
                ],
                'status' => 'با موفقیت',
            ]);
        }else{
            return response([
                'message'=>'شما به این صفحه دسترسی ندارید'
            ]);
        }
    }

    public function delete($id)
    {
        $r = auth()->user()->name == "مدیر سیستم";
        if ($r) {
            $t= TemplatesModel::find($id)->delete();
            return response([
                'data'=>$t,
                'status'=>'delete user successfull'
            ]);
        }else{
            return response([
                'message'=>'you do not have accessto this page'
            ]);
        }
    }

    public function delete1($id,$fa)
    {
        $r = auth()->user()->name == "مدیر سیستم";
        if ($r) {
            $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
            $t = TemplatesModel::find($id)->delete();
            return response([
                'data' => $t,
                'status' => 'یوزر پاک شد',
                'زبان' => $q
            ]);
        }else{
            return response([
                'message'=>'شما به این صفحه دسترسی ندارید'
            ]);
        }
    }


    public function show()
    {
        return TemplatesModel::orderby('id','desc')->paginate(6);


    }
}
