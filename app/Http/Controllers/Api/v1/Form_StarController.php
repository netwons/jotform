<?php

namespace App\Http\Controllers\Api\v1;

use App\Form_StarModel;
use App\LangsModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\FormModel;
use Illuminate\Support\Facades\Lang;

class Form_StarController extends Controller
{
    public function form_star(Request $request,$id)
    {
        $y=FormModel::find($id);
        auth()->user()->form_star()->create([
            'form_id'=>$id,
        ]);
        return response([
            'data'=>[
                'message'=>'is registered '
            ],
            'status'=>'success'
        ]);
    }

    public function form_star1(Request $request,$id,$fa)
    {
        $q=LangsModel::where('name',$fa)->take(1)->pluck('title');
        $y=FormModel::find($id);
        auth()->user()->form_star()->create([
            'form_id'=>$id
        ]);
        return response([
            'داده'=>[
                'پیام'=>'ثبت شد ',
                'زبان'=>$q
            ],
            'وضعیت'=>'با موفقیت'
        ]);
    }

    public function favorite1(Request $request,$id)
    {
        $valiDate=$this->validate($request,[
           'form_id'=>'unique:form_star'
        ]);

        $q=new Form_StarModel;


        $a=FormModel::where([['id','=',$id],['admin_id','=',auth()->user()->id]])->take(1)->pluck('id');
        $r= implode(', ',array($a));
        $t=str_replace('[',' ',$r);
        $e= str_replace(']',' ',$t);
        //return $e;
            $q->form_id=$e;
            $q->admin_id=auth()->user()->id;
            $q->save();


        return response([
            'data'=>[
                'message'=>'is registered '
            ],
            'status'=>'success'
        ]);
    }

    public function favorite11(Request $request,$id,$fa)
    {
        $qq=LangsModel::where('name',$fa)->take(1)->pluck('title');
        $q=new Form_StarModel;
        $q->admin_id=auth()->user()->id;
        $q->form_id=$id;
        $q->save();
        return response([
            'data'=>[
                'message'=>'ثبت شد ',
                'زبان'=>$qq
            ],
            'status'=>'با موفقیت'
        ]);
    }

    public function g($id)
    {
        $cc = FormModel::where('admin_id', $id)->take(50)->pluck('id');
        $r= implode(', ',array($cc));
        $t=str_replace('[',' ',$r);
        $e= str_replace(']',' ',$t);
        return $e;
    }

    public function show()
    {
        return Form_StarModel::where('admin_id',auth()->user()->id)->orderBy('id','desc')->paginate(4);
    }

    public function det($id)
    {
        $t=Form_StarModel::where([['id',$id],['admin_id',auth()->user()->id]])->delete();
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
        $t=Form_StarModel::where([['id',$id],['admin_id',auth()->user()->id]])->delete();
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
