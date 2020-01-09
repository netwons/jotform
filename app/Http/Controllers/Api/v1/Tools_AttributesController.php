<?php

namespace App\Http\Controllers\Api\v1;

use App\AttributesModel;
use App\LangsModel;
use App\Tools_AttributesModel;
use App\ToolsModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Lang;

class Tools_AttributesController extends Controller
{
    public function tools_attributes(Request $request,$default_value_en,$default_value_fa,$attribute_id)
    {
        $valiDate=$this->validate($request,[
//           'default_value_en'=>'required',
//            'default_value_fa'=>'required',
        ]);
        auth()->user()->tools_attribute()->create([
            'default_value_en'=>$default_value_en,
            'default_value_fa'=>$default_value_fa,
            'tool_id'=>$this->w(auth()->user()->id),
            'attribute_id'=>$attribute_id,
        ]);
        return response([
            'data'=>[
                'message'=>'form is registered',
            ] ,
            'status'=>'success',
        ]);
    }

    public function tools_attributes1(Request $request,$default_value_en,$default_value_fa,$attribute_id,$fa)
    {
        $q=LangsModel::where('name',$fa)->take(1)->pluck('title');
        $valiDate=$this->validate($request,[
            //'default_value_en'=>'required',
           // 'default_value_fa'=>'required',
        ]);
        auth()->user()->tools_attribute()->create([
            'default_value_en'=>$default_value_en,
            'default_value_fa'=>$default_value_fa,
            'tool_id'=>$this->w(auth()->user()->id),
            'attribute_id'=>$attribute_id,
        ]);
        return response([
            'data'=>[
                'message'=>'فرم ثبت شد',
                'زبان'=>$q
            ] ,
            'status'=>'با موفقیت',
        ]);
    }

    public function delete($id)
    {
        $t=Tools_AttributesModel::find($id)->delete();
        return response([
            'data'=>$t,
            'status'=>'delete user successfull'
        ]);
    }

    public function delete1($id,$fa)
    {
        $q=LangsModel::where('name',$fa)->take(1)->pluck('title');
        $t= Tools_AttributesModel::find($id)->delete();
        return response([
            'data'=>$t,
            'status'=>'یوزر پاک شد',
            'زبان'=>$q
        ]);
    }

    public function update($id,$default_value_en,$default_value_fa)
    {
       $t=Tools_AttributesModel::find($id);
       $t->default_value_en=$default_value_en;
       $t->default_value_fa=$default_value_fa;
       if($t->save()){
           return response([

               'status'=>'update attribute successfull'
           ]);
       }else{
           return "error";
       }
    }

    public function update1($id,$default_value_en,$default_value_fa,$fa)
    {
        $q=LangsModel::where('name',$fa)->take(1)->pluck('title');
        $t=Tools_AttributesModel::find($id);
        $t->default_value_en=$default_value_en;
        $t->default_value_fa=$default_value_fa;
        if($t->save()){
            return response([

                'status'=>'آپدیت با موفقیت انجام شد',
                'زبان'=>$q
            ]);
        }else{
            return "ارور";
        }
    }

    public function tool_id($id)
    {
        $rr=Tools_AttributesModel::find($id);

        return $rr->replicate();

    }

    public function w($id)
    {
        $ww=ToolsModel::where('admin_id',$id)->take(50)->pluck('id');
        $r= implode(', ',array($ww));
        $t=str_replace('[',' ',$r);
        $e= str_replace(']',' ',$t);
        return $e;
    }

    public function q($id)
    {
        $qq=AttributesModel::where('admin_id',$id)->take(50)->pluck('id');
        $r= implode(', ',array($qq));
        $t=str_replace('[',' ',$r);
        $e= str_replace(']',' ',$t);
        return $e;
    }
}
