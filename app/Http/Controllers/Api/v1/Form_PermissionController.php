<?php

namespace App\Http\Controllers\Api\v1;
use App\Form_permissionModel;
use App\FormModel;
use App\LangsModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Lang;
class Form_PermissionController extends Controller
{
    public function form_permission1(Request $request,$id)
    {
        $valiDate=$this->validate($request,[
//            'can_permission'=>'required|numeric|max:1',
//            'can_view'=>'required|numeric|max:1',
//            'can_insert'=>'required|numeric|max:1',
//            'can_edit'=>'required|numeric|max:1',
//            'can_delete'=>'required|numeric|max:1',
//            'can_export'=>'required|numeric|max:1',
//            'can_edit_form'=>'required|numeric|max:1',
//            'can_delete_form'=>'required|numeric|max:1',
//            'can_answer'=>'required|numeric|max:1',
//            'can_form_setting'=>'required|numeric|max:1',
        ]);
        auth()->user()->form_permission()->create([
//            'can_permission'=>$valiDate['can_permission'],
//            'can_view'=>$valiDate['can_view'],
//            'can_insert'=>$valiDate['can_insert'],
//            'can_edit'=>$valiDate['can_edit'],
//            'can_delete'=>$valiDate['can_delete'],
//            'can_export'=>$valiDate['can_export'],
//            'can_edit_form'=>$valiDate['can_edit_form'],
//            'can_delete_form'=>$valiDate['can_delete_form'],
//            'can_answer'=>$valiDate['can_answer'],
//            'can_form_setting'=>$valiDate['can_form_setting'],
            'form_id'=>$id,
        ]);
        return response([
           'data'=>[
               'message'=>'is registered'
           ] ,
            'status'=>'success'
        ]);
    }

    public function form_permission11(Request $request,$id,$fa)
    {
        $q=LangsModel::where('name',$fa)->take(1)->pluck('title');
        $valiDate=$this->validate($request,[
//            'can_permission'=>'required|numeric|max:1',
//            'can_view'=>'required|numeric|max:1',
//            'can_insert'=>'required|numeric|max:1',
//            'can_edit'=>'required|numeric|max:1',
//            'can_delete'=>'required|numeric|max:1',
//            'can_export'=>'required|numeric|max:1',
//            'can_edit_form'=>'required|numeric|max:1',
//            'can_delete_form'=>'required|numeric|max:1',
//            'can_answer'=>'required|numeric|max:1',
//            'can_form_setting'=>'required|numeric|max:1',
        ]);
        auth()->user()->form_permission()->create([
//            'can_permission'=>$valiDate['can_permission'],
//            'can_view'=>$valiDate['can_view'],
//            'can_insert'=>$valiDate['can_insert'],
//            'can_edit'=>$valiDate['can_edit'],
//            'can_delete'=>$valiDate['can_delete'],
//            'can_export'=>$valiDate['can_export'],
//            'can_edit_form'=>$valiDate['can_edit_form'],
//            'can_delete_form'=>$valiDate['can_delete_form'],
//            'can_answer'=>$valiDate['can_answer'],
//            'can_form_setting'=>$valiDate['can_form_setting'],
             'form_id'=>$id,
        ]);
        return response([
            'داده'=>[
                'پیام'=>'ثبت شد',
                'زبان'=>$q
            ]

        ]);
    }

    public function show()
    {
        return Form_permissionModel::where('admin_id',auth()->user()->id)->paginate(4);
    }

    public function update(Request $request,$id)
    {

        $valiDate=$this->validate($request,[
            'can_permission'=>'',
            'can_view'=>'',
            'can_insert'=>'',
            'can_edit'=>'',
            'can_delete'=>'',
            'can_export'=>'',
            'can_edit_form'=>'',
            'can_delete_form'=>'',
            'can_answer'=>'',
            'can_form_setting'=>'',
        ]);
        auth()->user()->form_permission()->update([
            'can_permission'=>$valiDate['can_permission'],
            'can_view'=>$valiDate['can_view'],
            'can_insert'=>$valiDate['can_insert'],
            'can_edit'=>$valiDate['can_edit'],
            'can_delete'=>$valiDate['can_delete'],
            'can_export'=>$valiDate['can_export'],
            'can_edit_form'=>$valiDate['can_edit_form'],
            'can_delete_form'=>$valiDate['can_delete_form'],
            'can_answer'=>$valiDate['can_answer'],
            'can_form_setting'=>$valiDate['can_form_setting'],
            'form_id'=>$id,
        ]);
        return response([
            'data'=>[
                'message'=>'is update',

            ]

        ]);

    }

    public function update1(Request $request,$id,$fa)
    {
        $q=LangsModel::where('name',$fa)->take(1)->pluck('title');
        $valiDate=$this->validate($request,[
            'can_permission'=>'',
            'can_view'=>'',
            'can_insert'=>'',
            'can_edit'=>'',
            'can_delete'=>'',
            'can_export'=>'',
            'can_edit_form'=>'',
            'can_delete_form'=>'',
            'can_answer'=>'',
            'can_form_setting'=>'',
        ]);
        auth()->user()->form_permission()->update([
            'can_permission'=>$valiDate['can_permission'],
            'can_view'=>$valiDate['can_view'],
            'can_insert'=>$valiDate['can_insert'],
            'can_edit'=>$valiDate['can_edit'],
            'can_delete'=>$valiDate['can_delete'],
            'can_export'=>$valiDate['can_export'],
            'can_edit_form'=>$valiDate['can_edit_form'],
            'can_delete_form'=>$valiDate['can_delete_form'],
            'can_answer'=>$valiDate['can_answer'],
            'can_form_setting'=>$valiDate['can_form_setting'],
            'form_id'=>$id,
        ]);
            return response([

                'داده'=>'آپدیت با موفقیت انجام شد',
                'زبان'=>$q

            ]);


    }

    public function det($id)
    {
        $t=Form_permissionModel::where([['id',$id],['admin_id',auth()->user()->id]])->delete();
        if($t) {
            return response([

                'data' => 'delete with successfull'
            ]);
        }else{
            return "id not found";
        }
    }

    public function det1($id,$fa)
    {
        $q=LangsModel::where('name',$fa)->take(1)->pluck('title');
        $t=Form_permissionModel::where([['id',$id],['admin_id',auth()->user()->id]])->delete();
        if($t) {
            return response([

                'داده' => 'کاربر پاک شد',
                'زبان'=>$q
            ]);
        }else{
            return "این id وجود ندارد";
        }
    }





}
