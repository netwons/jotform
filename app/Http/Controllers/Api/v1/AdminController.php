<?php

namespace App\Http\Controllers\Api\v1;

use App\AdminlastviewModel;
use App\HistoryModel;
use App\LangsModel;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\AdminModel;
use App\Http\Resources\v1\Admin as AdminResource;
use App\Http\Resources\v1\AdminCollection;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\FormModel;
use App\FolderModel;
use Auth;
use Morilog\Jalali\Jalalian;

class AdminController extends Controller
{

    public function api_token()
    {
        $t=auth()->user()->api_token;
        if($t){
            return response([
                'data'=>[
                  'message'=>$t
                ]
            ]);
        }else{
            return response([
                'data'=>[
                    'message'=>"پیدا نکرد"
                ]
            ]);
        }
    }

    public function id()
    {
        $t=auth()->user()->id;
        if($t){
            return response([
                'data'=>[
                    'message'=>$t
                ]
            ]);
        }else{
            return response([
                'data'=>[
                    'message'=>"پیدا نکرد"
                ]
            ]);
        }
    }

    public function index()
    {
        $r = auth()->user()->name == "مدیر سیستم";
        if ($r) {
            $admin = AdminModel::orderby('id', 'desc')->paginate(5);
            return new AdminCollection($admin);
        } else {
            return response([
                'data' => [
                    'message' => 'شما به این صفحه دسترسی ندارید',
                ],
                'status' => 'success',
            ]);
        }
    }

    public function single(AdminModel $admin)
    {
        $r = auth()->user()->name == "مدیر سیستم";
        if ($r) {
            return new AdminResource($admin);
        } else {
            return response([
                'data' => [
                    'message' => 'شما به این صفحه دسترسی ندارید',
                ],
                'status' => 'success',
            ]);
        }
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
//        $user = Auth::user();
//        $user->api_token = Str::random(100);
//        $user->save();
        return response([
            'data' => [
                'message' => 'Logout successful!',
            ],
            'status' => 'success',
            'status_code' => 200,
        ]);
    }

    public function store(Request $request)
    {
        $r = auth()->user()->name == "مدیر سیستم";
        if ($r) {
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:120',
                'email' => 'required|unique:admins',
                'username' => 'required|max:35',
                'mobile' => 'required|numeric',
                'password' => 'required|min:6',
                'phone' => '',
                'disabled' => '',
                'created_at' => '',
                'sidebar' => '',
                'form_capacity' => '',
                'last_login' => '',
                'formcount' => '',
                "skin" => '',
                'per_admins' => '',
                'per_emails' => '',
                'per_sms' => '',
                'per_templates' => ''
            ]);
            if ($validator->fails()) {
                return response([
                    "data" => [
                        $validator->errors()
                    ],
                    'status' => 'error'
                ], 422);
            }

            return response([
                'data' => [],
                'status' => 'success'
            ]);
        } else {
            return response([
                'data' => ['message'=>'you do not have accessto this page'],
                'status'=>'Fails'
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        $r = auth()->user()->name == "مدیر سیستم";
        if ($r) {
            $valiDate = $this->validate($request, [
                'name' => 'required',
                'email' => 'required'
            ]);
            $user = User::find($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->username = $request->username;
            $user->password = bcrypt($request->password);

            if ($user->save()) {
                return response([
                    'data' =>[ 'message'=>'is update wit successfull'],
                    'status'=>'success'
                ]);
            }
        } else {

            return response([
                'data' => ['message'=>'you do not have accessto this page'],
                'status'=>'Fails'            ]);
        }
    }

    public function update1(Request $request, $id,$fa)
    {
        $r = auth()->user()->name == "مدیر سیستم";
        if ($r) {
            $q=LangsModel::where('name',$fa)->take(1)->pluck('title');
            $valiDate = $this->validate($request, [
                'name' => 'required',
                'email' => 'required'
            ]);
            $user = User::find($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->username = $request->username;
            $user->password = bcrypt($request->password);
            if ($user->save()) {
                return response([
                    'data' => ['message'=>'با موفقیت آپدیت شد'],
                    'status'=>'success',
                    'زبان'=>$q
                ]);
            }
        } else {
            return response([
                'data' =>['message'=> 'شما به این صفحه دسترسی ندارید'],
                'status'=>'Fails'
            ]);
        }
    }

    public function delete($id)
    {
        $r = auth()->user()->name == "مدیر سیستم";
        if ($r) {
            $user = User::find($id)->delete();
            HistoryModel::create([
                'name'=>"delete user ",
                'admin_id'=>auth()->user()->id,
                'form_id' =>$id ,
                'history'=>\Morilog\Jalali\Jalalian::now(),
            ]);
            return response([
                'data' =>['message'=> $user],
                'status' => 'delete user successfull',
                'date'=>$date = Jalalian::forge('today')->format('%Y-%m-%d')
            ]);
        } else {
            return response([
                'data' =>['message'=> 'you do not have accessto this page'],
                'status'=>'Fails'
            ]);
        }
    }

    public function delete1($id,$fa)
    {
        $r = auth()->user()->name == "مدیر سیستم";
        if ($r) {
            $q=LangsModel::where('name',$fa)->take(1)->pluck('title');
            $user = User::find($id)->delete();
            HistoryModel::create([
                'name'=>"delete user ",
                'admin_id'=>auth()->user()->id,
                'form_id' =>$id ,
                'history'=>\Morilog\Jalali\Jalalian::now(),
            ]);
            return response([
                'data' =>['message'=> $user],
                'status' => 'کاربر با موفقیت پاک شد',
                'زبان'=>$q,
                'date'=>$date = Jalalian::forge('today')->format('%Y-%m-%d')
            ]);
        } else {
            return response([
                'data' =>['message'=>'شما به این صفحه دسترسی ندارید'],
                'status'=>'Fails'
            ]);
        }
    }

    public function login(Request $request, User $admin)
    {
        $valiDate = $this->validate($request, [
            'email' => 'required|email|exists:admins|max:40',
            'password' => 'required|min:5|string',
            //'lang'=>'required'
        ]);

        if (!auth()->attempt($valiDate)) {
            return response([
                'data' => ['message'=>'صحیح نیست'],
                'status' => 'error'
            ], 403);
        }
        auth()->user()->tokens()->delete();//توکن های قبلی رو حذف میکنه
        $token= auth()->user()->createToken('Api Token on Android')->accessToken;
//        auth()->user()->update([
//            'api_token'=>Str::random(100),

//        ]);

        auth()->user()->admin_last_view()->create([
            'form_id' => $this->c(auth()->user()->id),
            'created_at' => Carbon::now()->toDateTimeString()
        ]);
        return new AdminResource(auth()->user(),$token);
    }
    public function c($id)
    {
        $cc = FormModel::where('admin_id', auth()->user()->id)->take(50)->pluck('id');
        $r = implode(', ', array($cc));
        $t = str_replace('[', ' ', $r);
        $e = str_replace(']', ' ', $t);
        if(!empty($e)){
            return $e;
        }else{
            return "پیدا نکرد";
        }
    }

    public function register(Request $request)
    {
        $valiDate = $this->validate($request, [
            'name' => 'required|string|max:30',
            'email' => 'required|email|unique:admins|max:40',
            'mobile' => '',
            'username' => 'required|max:40',
            'password' => 'required|min:5|string'
        ]);
        $user = User::create([
            'name' => $valiDate['name'],
            'email' => $valiDate['email'],
            'mobile' => $valiDate['mobile'],
            'username' => $valiDate['username'],
            'password' => bcrypt($valiDate['password']),
            'api_token' => Str::random(100),
            'remember_token' => Str::random(100),
            'last_login' => time(),
        ]);
        HistoryModel::create([
            'name'=>"register user ".$valiDate['email'],
            'admin_id'=>auth()->user()->id,
            'form_id' =>1 ,
            'history'=>\Morilog\Jalali\Jalalian::now(),
        ]);
        Config::set('mail.from.name', 'Coms.ir');
        $use = \App\User::find($user->id);
        $use->notify(new \App\Notifications\help());
        return response([
            'data'=>[
            'user' => new AdminResource($user),
            'message' => 'ایمیل ارسال شد'],
            'status' => 'success',
            'date'=>$date = Jalalian::forge('today')->format('%Y-%m-%d')
        ]);
    }

    public function resetpassword1(Request $request)
    {
        $valiDate = $this->validate($request, [
            'email' => 'required|email|exists:admins|max:40',
        ]);
        if (!$valiDate) {
            return response([
                'data' =>['message'=> 'صحیح نیست'],
                'status' => 'Fails'
            ], 403);
        } else {
            $rrr=$request->email;
            $rr=User::where('email',$request->email)->value('api_token');
            $id=User::where('email',$request->email)->value('id');
            $user=AdminModel::findOrFail($id);
//            return  $rr;
            Mail::send('netwons', ['user' => $user], function ($m) use ($user,$rrr,$rr) {
                $m->from("{$rrr}", "Reset password");
                $m->to($user->email, $user->name)->subject('Your Reminder!');
            });
            HistoryModel::create([
                'name'=>"register user ".$rrr,
                'admin_id'=>auth()->user()->id,
                'form_id' =>1 ,
                'history'=>\Morilog\Jalali\Jalalian::now(),
            ]);
            return response([
                'data' =>['message'=> 'ایمیل حاوی apiارسال شد'],
                'status' => 'success',
                'date'=>$date = Jalalian::forge('today')->format('%Y-%m-%d')
            ]);
        }
    }
    public function resetpassword2(Request $request)
    {
        $valiDate = $this->validate($request, [
            'email' => 'required|email|exists:admins|max:40',
            'api_token' => 'required|exists:admins|max:120',
            'password' => 'required|max:40',
        ]);
        if (!$valiDate) {
            return response([
                'data' =>['message'=> 'صحیح نیست'],
                'status' => 'Fails'
            ], 403);
        } else {
            $user1 = AdminModel::where('email',$request->email)->value('id');
            $user=AdminModel::find($user1);
            $user->email = $request->email;
            $user->api_token = Str::random(100);
            $user->password = bcrypt($request->password);

            if ($user->save()) {
                HistoryModel::create([
                    'name'=>"register user ".$request->email,
                    'admin_id'=>auth()->user()->id,
                    'form_id' =>1 ,
                    'history'=>\Morilog\Jalali\Jalalian::now(),
                ]);
                return response([
                    'data' =>[ 'message'=>'پسورد با موفقیت تغییر کرد'],
                    'status'=>'success',
                    'date'=>$date = Jalalian::forge('today')->format('%Y-%m-%d')
                ]);
            }
        }
    }
//    public function resetpassword(Request $request)
//    {
//        $valiDate = $this->validate($request, [
//            'email' => 'required|email|exists:admins|max:40',
//        ]);
//        if (!$valiDate) {
//            return response([
//                'data' =>['message'=> 'صحیح نیست'],
//                'status' => 'Fails'
//            ], 403);
//        } else {
//
//            $rr=User::where('email',$request->email)->value('id');
//            //return $r;
//            $w = User::find($rr);
//            $w->password = ' ';
//            $e = $w->password = Str::random(5);
//            echo $e.'  id='.$w->id  ;
//            $w->update();
//        }
//    }

    public function newpass($id, $pass)
    {
        $user = User::find($id);
        $user->password = bcrypt($pass);
        $user->api_token = bcrypt(Str::random(100));
        if ($user->update()) {
            return response([
                'data' => ['message'=>'پسورد تغییر کرد'],
                'status'=>'success'
            ]);
        } else {
            return response([
                'data' =>['message'=> 'پسورد تغییر نکرد'],
                'status'=>'success'
            ]);
        }
    }


}
