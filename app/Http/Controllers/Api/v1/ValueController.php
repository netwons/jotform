<?php

namespace App\Http\Controllers\Api\v1;

use App\Form_TollsModel;
use App\LangsModel;
use App\SubmissionsModel;
use App\ValueModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Lang;

class ValueController extends Controller
{
    public function value(Request $request,$value)
    {
        $valiDate=$this-> validate($request,[
           // 'value'=>'required'
        ]) ;
       auth()->user()->values()->create([
           'value'=>$value,
           'submission_id'=>$this->j(auth()->user()->id),
           'form_tool_id'=>$this->e(auth()->user()->id),

       ]);
        return response([
            'data'=>[
                'message'=> 'values is registered',
            ] ,
            'status'=>'success',
        ]);
    }

    public function value1(Request $request,$value,$fa)
    {
        $q=LangsModel::where('name',$fa)->take(1)->pluck('title');
        $valiDate=$this-> validate($request,[
            //'value'=>'required'
        ]) ;
        auth()->user()->values()->create([
            'value'=>$value,
            'submission_id'=>$this->j(auth()->user()->id),
            'form_tool_id'=>$this->e(auth()->user()->id),

        ]);
        return response([
            'data'=>[
                'message'=>'مقادیر ثبت شد',
                'زبان'=>$q
            ] ,
            'status'=>'با موفقیت',
        ]);
    }

    public function j($id)
    {
        $jj=SubmissionsModel::where('admin_id',$id)->take(50)->pluck('id');
        $r= implode(', ',array($jj));
        $t=str_replace('[',' ',$r);
        $e= str_replace(']',' ',$t);
        return $e;
    }

    public function e($id)
    {
        $ee=Form_TollsModel::where('admin_id',$id)->take(50)->pluck('id');
        $r= implode(', ',array($ee));
        $t=str_replace('[',' ',$r);
        $e= str_replace(']',' ',$t);
        return $e;
    }

    public function delete($id)
    {
        $t= ValueModel::find($id)->delete();
        return response([
            'data'=>$t,
            'status'=>'delete user successfull'
        ]);
    }

    public function delete1($id,$fa)
    {
        $q=LangsModel::where('name',$fa)->take(1)->pluck('title');
        $t= ValueModel::find($id)->delete();
        return response([
            'data'=>$t,
            'status'=>'یوزر پاک شد',
            'زبان'=>$q
        ]);
    }

    public function edit($id,$value)
    {
        $y= ValueModel::find($id);
        $y->value=$value;
        if($y->update()){
            return response([

                'status'=>'update value successfull'
            ]);
        }else{
            return "error";
        }
    }

    public function edit1($id,$value,$fa)
    {
        $q=LangsModel::where('name',$fa)->take(1)->pluck('title');
        $y= ValueModel::find($id);
        $y->value=$value;

        if($y->update()){
            return response([

                'status'=>'آپدیت با موفقیت انجام شد',
                'زبان'=>$q
            ]);
        }
    }

}
