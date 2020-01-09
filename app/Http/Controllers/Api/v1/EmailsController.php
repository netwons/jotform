<?php

namespace App\Http\Controllers\Api\v1;
use App\LangsModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Mail;
use App\User;
use App\EmailsModel;
class EmailsController extends Controller
{
    public function email(Request $request,$f)
    {
       $valiDate=$this->validate($request,[
           'name'=>'required',
           'host'=>'required',
           'port'=>'required|numeric',
           'username'=>'required',
           'password'=>'required|min:6|string',
           'protocol'=>'required',
       ]) ;
        if(User::where('admin_id',auth()->user()->id)) {
            $w = new EmailsModel;
            //$q=EmailsModel::table('emails')->
            Config::set('driver.MAIL_DRIVER', $w->name);
            Config::set('host.MAIL_HOST', $w->host);
            Config::set('port.MAIL_PORT', $w->port);
            Config::set('from.address.MAIL_FROM_ADDRESS', $w->username);
            Config::set('username.MAIL_USERNAME', $w->username);
            Config::set('password.MAIL_PASSWORD', $w->password);
            Config::set('from.name.MAIL_FROM_NAME', $w->username);
            Config::set('encryption.MAIL_ENCRYPTION', $w->protocol);
            Config::set('from.name.MAIL_FROM_NAME', $w->username);
            Config::get('from.name.MAIL_FROM_NAME');
            auth()->user()->emails()->create($valiDate);

            Mail::to($f)->send(new \App\Mail\Testing);

            return response([
                'data' => [
                    'message' => 'is registered',
                ],
                'status' => 'success'
            ]);
        }
        return 'no';
    }

    public function email1(Request $request,$f,$fa)
    {
        $q=LangsModel::where('name',$fa)->take(1)->pluck('title');
        $valiDate=$this->validate($request,[
            'name'=>'required',
            'host'=>'required',
            'port'=>'required|numeric',
            'username'=>'required',
            'password'=>'required|min:6|string',
            'protocol'=>'required',
        ]) ;
        if(User::where('admin_id',auth()->user()->id)) {
            $w = new EmailsModel;
            //$q=EmailsModel::table('emails')->
            Config::set('driver.MAIL_DRIVER', $w->name);
            Config::set('host.MAIL_HOST', $w->host);
            Config::set('port.MAIL_PORT', $w->port);
            Config::set('from.address.MAIL_FROM_ADDRESS', $w->username);
            Config::set('username.MAIL_USERNAME', $w->username);
            Config::set('password.MAIL_PASSWORD', $w->password);
            Config::set('from.name.MAIL_FROM_NAME', $w->username);
            Config::set('encryption.MAIL_ENCRYPTION', $w->protocol);
            Config::set('from.name.MAIL_FROM_NAME', $w->username);
            Config::get('from.name.MAIL_FROM_NAME');
            auth()->user()->emails()->create([
                'name' => $valiDate['name'],
                'host' => $valiDate['host'],
                'port' => $valiDate['port'],
                'username' => $valiDate['username'],
                'password' => $valiDate['password'],
                'protocol' => $valiDate['protocol'],
            ]);
            Mail::to($f)->send(new \App\Mail\Testing);
            return response([

                'داده' => 'ثبت شد ,ایمیل ارسال شد',
                'وضعیت' => 'success',
                'زبان'=>$q
            ]);
        }
    }

    public function email11(Request $request,$f)
    {

        if(User::where('admin_id',auth()->user()->id)) {

            $w = new EmailsModel;
            //$q=EmailsModel::table('emails')->
            Config::set('driver.MAIL_DRIVER', $w->name);
            Config::set('host.MAIL_HOST', $w->host);
            Config::set('port.MAIL_PORT', $w->port);
            Config::set('from.address.MAIL_FROM_ADDRESS', $w->username);
            Config::set('username.MAIL_USERNAME', $w->username);
            Config::set('password.MAIL_PASSWORD', $w->password);
            Config::set('from.name.MAIL_FROM_NAME', $w->username);
            Config::set('encryption.MAIL_ENCRYPTION', $w->protocol);
            Config::set('from.name.MAIL_FROM_NAME', $w->username);
            Config::get('from.name.MAIL_FROM_NAME');
            //auth()->user()->emails()->create([
//                'name' => $valiDate['name'],
//                'host' => $valiDate['host'],
//                'port' => $valiDate['port'],
//                'username' => $valiDate['username'],
//                'password' => $valiDate['password'],
//                'protocol' => $valiDate['protocol'],
            //]);
            Mail::to($f)->send(new \App\Mail\Testing);
            return response([
                'داده' => 'ثبت شد ,ایمیل ارسال شد',
                'وضعیت' => 'success'
            ]);
        }
    }

    public function show()
    {
        $t=EmailsModel::where('admin_id',auth()->user()->id)->orderBy('id','desc')->paginate(4);
        return $t;
    }

    public function det($id)
    {
        $t=EmailsModel::where([['id',$id],['admin_id',auth()->user()->id]])->delete();
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
        $t=EmailsModel::where([['id',$id],['admin_id',auth()->user()->id]])->delete();
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
