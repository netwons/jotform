<?php

namespace App\Http\Controllers\Api\v1;

use App\AdminlastviewModel;
use App\FormModel;
use App\SubmissionsModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Lang;

class SubmissionController extends Controller
{
    public function submission(Request $request,$id)
    {
        $valiDate=$this->validate($request,[
           'fav'=>'required',
            'final_answer'=>'required'
        ]);
        auth()->user()->submissions()->create([
            'fav'=>$id,
           'final_answer'=>$valiDate['final_answer'],
           'form_id'=>$id,
            'loginid'=>$this->q(),
            'ip'=>$this->gggg()

        ]);
        return response([
            'data'=>'it is registered',
            'status'=>'success'
        ]);
    }

    public function gggg(){
        if (!empty($_SERVER['HTTP_CLIENT_IP']))  //check ip from share internet
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) //to check ip is pass from proxy
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else
            $ip = $_SERVER['REMOTE_ADDR'];
        return $ip;
    }

    public function q()
    {
        $rr= AdminlastviewModel::orderby('id','desc')->take(1)->pluck('id');
        $r= implode(', ',array($rr));
        $t=str_replace('[',' ',$r);
        $e= str_replace(']',' ',$t);
        return $e;
    }

    public function submission1(Request $request,$id,$fa)
    {
        Lang::setLocale($fa);
        $valiDate=$this->validate($request,[
            'fav'=>'required',
            'final_answer'=>'required'
        ]);
        auth()->user()->submissions()->create([
            'fav'=>$id,
            'final_answer'=>$valiDate['final_answer'],
            'form_id'=>$id,
            'loginid'=>$this->q(),

        ]);
        return response([
            'داده'=>'ثبت شد',
            'وضعیت'=>'با موفقیت'
        ]);
    }

    public function g($id)
    {
        $gg=FormModel::where('admin_id',auth()->user()->id)->take(50)->pluck('id');
        $r= implode(', ',array($gg));
        $t=str_replace('[',' ',$r);
        $e= str_replace(']',' ',$t);
        return $e;

    }

    public function show()
    {
        return SubmissionsModel::where('admin_id',auth()->user()->id)->orderby('id','desc')->paginate(4);
    }

    public function det($id)
    {
        $t=SubmissionsModel::where([['id',$id],['admin_id',auth()->user()->id]])->delete();
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
        Lang::setLocale($fa);
        $t=SubmissionsModel::where([['id',$id],['admin_id',auth()->user()->id]])->delete();
        if($t) {
            return response([

                'داده' => 'کاربر پاک شد'
            ]);
        }else{
            return "این id وجود ندارد";
        }
    }

//    public function a()
//    {
//       $url='http://bitpay.ir/payment-test/gateway-send';
//       $api='adxcv-zzadq-polkjsad-opp13opoz-1sdf455aadzmck1244567';
//       $amount=2000;
//       $redirect='';
//       $name='masoud';
//       $email='netwons@gmail.com';
//       $description='netwons';
//       $factorId=1;
//       $result=$this->send($url,$api,$amount,$redirect,$factorId,$name,$email,$description);
//       var_dump($result);
//       if($result>0 && is_numeric($result)){
//           $go='http://bitpay.ir/payment-test/gateway-'.$result;
//           return $redirect($go);
//       }
//
//    }
//    public function send($url,$api,$amount,$redirect,$factorId,$name,$email,$description)
//    {
//        $ch=curl_init();
//        curl_setopt($ch,CURLOPT_URL,$url);
//        curl_setopt($ch,CURLOPT_POSTFIELDS,"api=$api&amount=$amount&redirect=$redirect&factorId=$factorId&name=$name&email=$email&description=$description");
//        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,False);
//        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
//        $res=curl_exec($ch);
//        curl_close($ch);
//        return $res;
//    }


//darghah other
    function send($api, $amount, $redirect, $factorNumber = null, $mobile = null, $description = null) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://pay.ir/payment/send');
        curl_setopt($ch, CURLOPT_POSTFIELDS,"api=$api&amount=$amount&redirect=$redirect&factorNumber=$factorNumber&mobile=$mobile&description=$description");
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $res = curl_exec($ch);
        curl_close($ch);

        return $res;
    }

    public function peyment()
    {

        $amount = '2000';
        $api = 'test';
        $redirect = 'http://localhost:8000/course/payment/checker';
        $description = 'تست تست';

        $result = $this->send($api, $amount, $redirect, $description);
        $result = json_decode($result);
        if ($result->status) {
            return redirect("https://pay.ir/payment/gateway/$result->transId");
        } else {
            echo $result->errorMessage;
        }
    }

    public function submission2()
    {

    }
    

}
