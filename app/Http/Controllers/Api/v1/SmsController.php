<?php

namespace App\Http\Controllers\Api\v1;
use App\SmsModel;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Str;
use Illuminate\Support\Traits\Macroable;
class SmsController extends Controller
{
    public function sms(Request $request,$name,$sender=null)
    {
        $valiDate=$this->validate($request,[
//            'name'=>'required|min:2',
//            'sender'=>'required',
        ]);
        auth()->user()->sms()->create([
            'name'=>$name,
            'sender'=>$sender,
            'apikey'=>Str::random(20)
        ]);
        return response([
            'data'=>[
                'message'=>'sms is registered ',
            ] ,
            'status'=>'success',
        ]);
    }

    public function sms1(Request $request,$name,$sender=null,$fa)
    {
        $q=LangsModel::where('name',$fa)->take(1)->pluck('title');
        //'name'=>'required|min:2',
//            'sender'=>'required',
        $valiDate=$this->validate($request,[
//
        ]);
        auth()->user()->sms()->create([
            'name'=>$name,
            'sender'=>$sender,
            'apikey'=>Str::random(20)
        ]);
        return response([
            'data'=>[
                'message'=>'sms ثبت شد',
                'زبان'=>$q
            ] ,
            'status'=>'با موفقیت',
        ]);

    }

    public function edit(Request $request,$id,$name,$sender=null)
    {
       $user=SmsModel::find($id);
       $user->name=$name;
       $user->sender=$sender;
       if($user->update()){
           return response([
               'data'=>[
                   'message'=>'update is registered',
               ] ,
           ]);
       }else{
           return response([
               'message'=>'Error'
           ]);
       }
    }

    public function delete($id)
    {
        $user=SmsModel::find($id)->delete();
        return response([
            'data'=>$user,
            'status'=>'delete user successfull'
        ]);
    }
    public function delete1($id,$fa)
    {
        $q=LangsModel::where('name',$fa)->take(1)->pluck('title');
        $user=SmsModel::find($id)->delete();
        return response([
            'داده'=>$user,
            'وضعیت'=>'کاربر با موفقیت پاک شد',
            'زبان'=>$q
        ]);
    }

    public function send($id,$message)
    {

        return redirect('https://api.kavenegar.com/v1/6C426963442F4D703953474E5477323844395143673230454D30355438486E48/sms/send.json?receptor='.$id.'&sender=10004346&message='.$message);


    }
}
