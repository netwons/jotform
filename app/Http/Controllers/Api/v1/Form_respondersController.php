<?php

namespace App\Http\Controllers\Api\v1;

use App\Form_RespondersModel;
use App\FormModel;
use App\LangsModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Mail;
use Psy\Util\Str;

class Form_respondersController extends Controller
{
    public function create(Request $request,$id)
    {
        $valiDate=$this->validate($request,[
            'subject'=>'required|string|min:2',
            'message'=>'required|string|max:100',
            //'sms'=>'required|string',
            'teammate_message'=>'',
            'teammate_subject'=>'',
            //'admin_index'=>'required',
            ]);

        auth()->user()->form_responders()->create([
            'subject'=>$valiDate['subject'],
            'message'=>$valiDate['message'],
            //'sms'=>$valiDate['sms'],
            'teammate_message'=>$valiDate['teammate_message'],
            'teammate_subject'=>$valiDate['teammate_subject'],
            'admin_index'=>auth()->user()->id,
            'form_id'=>$id
            ]);

        return response([
            'data'=>[
                'message'=>' is registered',
            ] ,
            'status'=>'success',
        ]);

    }

    public function create1(Request $request,$fa,$id)
    {

        $q=LangsModel::where('name',$fa)->take(1)->pluck('title');
        $valiDate=$this->validate($request,[
            'subject'=>'required|string|min:2',
            'message'=>'required|string|max:100',
            //'sms'=>'required|string',
            'teammate_message'=>'',
            'teammate_subject'=>'',
           // 'admin_index'=>'required',
        ]);

        auth()->user()->form_responders()->create([
            'subject'=>$valiDate['subject'],
            'message'=>$valiDate['message'],
            //'sms'=>$valiDate['sms'],
            'teammate_message'=>$valiDate['teammate_message'],
            'teammate_subject'=>$valiDate['teammate_subject'],
            'admin_index'=>auth()->user()->id,
            'form_id'=>$id
        ]);

        return response([
            'data'=>[
                'message'=>' ثبت شد',
                'زبان'=>$q
            ] ,
            'status'=>'با موفقیت',
        ]);

    }
    public function update(Request $request,$id)
    {
        $valiDate=$this->validate($request,[
            'subject'=>'required|string|min:2',
            'message'=>'required|string|max:100',
            //'sms'=>'required|string',
            'teammate_message'=>'',
            'teammate_subject'=>'',
            //'admin_index'=>'required',
        ]);

        auth()->user()->form_responders()->update([
            'subject'=>$valiDate['subject'],
            'message'=>$valiDate['message'],
            //'sms'=>$valiDate['sms'],
            'teammate_message'=>$valiDate['teammate_message'],
            'teammate_subject'=>$valiDate['teammate_subject'],
            'admin_index'=>auth()->user()->id,
            'form_id'=>$id
        ]);

        return response([
            'data'=>[
                'message'=>' is registered',
            ] ,
            'status'=>'success',
        ]);

    }
    public function update1(Request $request,$fa,$id)
    {

        $q=LangsModel::where('name',$fa)->take(1)->pluck('title');
        $valiDate=$this->validate($request,[
            'subject'=>'required|string|min:2',
            'message'=>'required|string|max:100',
            //'sms'=>'required|string',
            'teammate_message'=>'',
            'teammate_subject'=>'',
            // 'admin_index'=>'required',
        ]);

        auth()->user()->form_responders()->update([
            'subject'=>$valiDate['subject'],
            'message'=>$valiDate['message'],
            //'sms'=>$valiDate['sms'],
            'teammate_message'=>$valiDate['teammate_message'],
            'teammate_subject'=>$valiDate['teammate_subject'],
            'admin_index'=>auth()->user()->id,
            'form_id'=>$id
        ]);

        return response([
            'data'=>[
                'message'=>' ثبت شد',
                'زبان'=>$q
            ] ,
            'status'=>'با موفقیت',
        ]);

    }

    public function aa($id)
    {
        $cc = FormModel::where('admin_id', $id)->orderBy('id','DESC')->take(50)->pluck('id');
        $r= implode(', ',array($cc));
        $t=str_replace('[',' ',$r);
        $e= str_replace(']',' ',$t);
        return $e;
    }

    public function show()
    {
        return Form_RespondersModel::where('admin_id',auth()->user()->id)->orderBy('id','Desc')->paginate(4);


    }

    public function det($id)
    {
        $t=Form_RespondersModel::where([['id',$id],['admin_id',auth()->user()->id]])->delete();
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
        $t=Form_RespondersModel::where([['id',$id],['admin_id',auth()->user()->id]])->delete();
        if($t) {
            return response([

                'data' => 'کاربر پاک شد',
                'زبان'=>$q
            ]);
        }else{
            return "این id وجود ندارد";
        }
    }
}
