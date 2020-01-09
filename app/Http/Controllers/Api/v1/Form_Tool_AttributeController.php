<?php

namespace App\Http\Controllers\Api\v1;

use App\AttributesModel;
use App\Form_Tool_attributeModel;
use App\LangsModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Lang;

class Form_Tool_AttributeController extends Controller
{
    public function form_tool_attribute(Request $request,$id)
    {
        $valiDate=$this->validate($request,[
            'value'=>'required',
            'attribute_id'=>'required'
        ]);

        auth()->user()->form_tool_attribute()->create([
            'value'=>$valiDate['value'],

            'attribute_id'=>$valiDate['attribute_id'],
            'form_tool_id'=>$id,
        ]);
        return response([
            'data'=>[
                'message'=>'form is registered',
            ] ,
            'status'=>'success',
        ]);

    }

    public function form_tool_attribute1(Request $request,$id,$fa)
    {
        $q=LangsModel::where('name',$fa)->take(1)->pluck('title');
        $valiDate=$this->validate($request,[
            'value'=>'required',
            'attribute_id'=>'required'
        ]);

        auth()->user()->form_tool_attribute()->create([
            'value'=>$valiDate['value'],
            'form_tool_id'=>$id,
            'attribute_id'=>$valiDate['attribute_id'],

        ]);
        return response([
            'داده'=>[
                'پیغام'=>'فرم ثبت شد',
                'زبان'=>$q
            ] ,
            'وضعیت'=>'با موفقیت',
        ]);

    }

    public function j($id)
    {
        $jj=AttributesModel::where('admin_id',$id)->take(50)->pluck('id');
        $r= implode(', ',array($jj));
        $t=str_replace('[',' ',$r);
        $e= str_replace(']',' ',$t);
        return $e;
    }

    public function show()
    {
        return Form_Tool_attributeModel::where('admin_id',auth()->user()->id)->orderby('id','desc')->paginate(4);
    }

    public function det($id)
    {
        $t=Form_Tool_attributeModel::where([['id',$id],['admin_id',auth()->user()->id]])->delete();
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
        $t=Form_Tool_attributeModel::where([['id',$id],['admin_id',auth()->user()->id]])->delete();
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
