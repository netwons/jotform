<?php

namespace App\Http\Controllers\Api\v1;

use App\AttributesModel;
use App\LangsModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\v1\Admin as AdminResource;
use Illuminate\Support\Facades\Lang;

class AttributesController extends Controller
{
    public function att(Request $request)
    {
        $valiDate = $this->validate($request, [
            'name' => '',
            'name_en' => '',
            'name_fa' => '',
            'cat_en' => '',
            'cat_fa' => '',
            //'type'=>'required',
            'options' => '',
            'desc_fa' => '',
            'desc_en' => '',
            'placeholder_en' => '',
            'placeholder_fa' => '',
        ]);
        $user = AttributesModel::create([
            'name' => $valiDate['name'],
            'name_en' => strtoupper($valiDate['name_en']),
            'name_fa' => $valiDate['name_fa'],
            'cat_en' => $valiDate['cat_en'],
            'cat_fa' => $valiDate['cat_fa'],
            //'type'=>$type,
            'options' => $valiDate['options'],
            'desc_fa' => $valiDate['desc_fa'],
            'desc_en' => $valiDate['desc_en'],
            'placeholder_en' => $valiDate['placeholder_en'],
            'placeholder_fa' => $valiDate['placeholder_fa'],
        ]);
        return response([
            'data' => [
                'message' => 'form is registered',
            ],
            'status' => 'success',
            'info' => $user
        ]);
    }

    public function att1(Request $request, $fa)
    {
       $q=LangsModel::where('name',$fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
            'name' => '',
            'name_en' => '',
            'name_fa' => '',
            'cat_en' => '',
            'cat_fa' => '',
            //'type'=>'required',
            'options' => '',
            'desc_fa' => '',
            'desc_en' => '',
            'placeholder_en' => '',
            'placeholder_fa' => '',
        ]);
        $user = AttributesModel::create([
            'name' => $valiDate['name'],
            'name_en' => strtoupper($valiDate['name_en']),
            'name_fa' => $valiDate['name_fa'],
            'cat_en' => $valiDate['cat_en'],
            'cat_fa' => $valiDate['cat_fa'],
            //'type'=>$type,
            'options' => $valiDate['options'],
            'desc_fa' => $valiDate['desc_fa'],
            'desc_en' => $valiDate['desc_en'],
            'placeholder_en' => $valiDate['placeholder_en'],
            'placeholder_fa' => $valiDate['placeholder_fa'],
        ]);
        return response([
            'data' => [
                'message' => ' فرم ثبت شد',
            ],
            'status' => 'با موفقیت',
            'info' => $user,
            'زبان'=>$q
        ]);
    }

    public function edit(Request $request, $id)
    {
        $valiDate = $this->validate($request, [
            'name' => '',
            'name_en' => '',
            'name_fa' => '',
            'cat_en' => '',
            'cat_fa' => '',
            //'type'=>'required',
            'options' => '',
            'desc_fa' => '',
            'desc_en' => '',
            'placeholder_en' => '',
            'placeholder_fa' => '',
        ]);
        $user = AttributesModel::find($id);
        $user->name = $valiDate['name'];
        $user->name_en = strtoupper($valiDate['name_en']);
        $user->name_fa = $valiDate['name_fa'];
        $user->cat_en = $valiDate['cat_en'];
        $user->cat_fa = $valiDate['cat_fa'];
        //$user->type=$type;
        $user->options = $valiDate['options'];
        $user->desc_fa = $valiDate['desc_fa'];
        $user->desc_en = $valiDate['desc_en'];
        $user->placeholder_en = $valiDate['placeholder_en'];
        $user->placeholder_fa = $valiDate['placeholder_fa'];
        if ($user->update()) {
            return response([
                'data' => [
                    'message' => ' form is register',
                ],
                'status' => 'success',
                'info' => $user
            ]);
        }
    }

    public function edit1(Request $request, $id, $fa)
    {
        $q=LangsModel::where('name',$fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
            'name' => '',
            'name_en' => '',
            'name_fa' => '',
            'cat_en' => '',
            'cat_fa' => '',
            //'type'=>'required',
            'options' => '',
            'desc_fa' => '',
            'desc_en' => '',
            'placeholder_en' => '',
            'placeholder_fa' => '',
        ]);
        $user = AttributesModel::find($id);
        $user->name = $valiDate['name'];
        $user->name_en = strtoupper($valiDate['name_en']);
        $user->name_fa = $valiDate['name_fa'];
        $user->cat_en = $valiDate['cat_en'];
        $user->cat_fa = $valiDate['cat_fa'];
        //$user->type=$type;
        $user->options = $valiDate['options'];
        $user->desc_fa = $valiDate['desc_fa'];
        $user->desc_en = $valiDate['desc_en'];
        $user->placeholder_en = $valiDate['placeholder_en'];
        $user->placeholder_fa = $valiDate['placeholder_fa'];
        if ($user->update()) {
            return response([
                'داده' => [
                    'پیام' => ' فرم ثبت شد',
                ],
                'وضعیت' => 'با موفقیت',
                'اطلاعات' => $user,
                'زبان'=>$q
            ]);
        }
    }

    public function delete($id)
    {
        $t = AttributesModel::find($id)->delete();
        return response([
            'data' => $t,
            'status' => 'delete user successfull'
        ]);
    }

    public function delete1($id, $fa)
    {
        $q=LangsModel::where('name',$fa)->take(1)->pluck('title');

        $t = AttributesModel::find($id)->delete();
        return response([
            'داده' => $t,
            'وضعیت' => 'یوزر پاک شد',
              'زبان'=>$q
        ]);
    }
}
