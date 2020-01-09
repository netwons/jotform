<?php

namespace App\Http\Controllers\Api\v1;
use App\AdminlastviewModel;
use App\ElementModel;
use App\EmailsModel;
use App\Form_TollsModel;
use App\HistoryModel;
use App\LangsModel;
use App\LogModel;
use App\Other_answerModel;
use App\SmsModel;
use App\SubmissionsModel;
use App\TemplatesModel;
use App\TrashModel;
use App\User;
use App\FolderModel;
use App\FormModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Str;
use Illuminate\Routing\Route;
use Morilog\Jalali\Jalalian;

class FormController extends Controller
{

    public function __construct(Request $request,Route $route)
    {

//      echo FormModel::where('admin_id',Auth()->user())->get('id');
        if($route->methods()[0]!='GET') {

            // check if user loged in get user id else set null for it .
            $user_id = 1;
            $method = $route->getActionMethod();
            $actions = explode('\\', $route->getActionName());
            $controller = substr(end($actions), 0, strpos(end($actions), "@"));
            LogModel::create([
                'ip' => $request->ip(),
                'agent' =>'',
                'controller' => $controller,
                'method' => $method,
                'user_id' => $user_id,
                'input' => $request->getContent(),
                'route' => $request->path(),
                'http_method' => $route->methods()[0],
            ]);
            ///////////////////////////////////disable_to_date////تا تاریخ فلان غیر فعال باشد
            $y=$request->path();//ایدی فرم
            //echo $y;
            preg_match_all("/(?<=api\/v1\/form\/disable_date\/)\w*/im",$y,$y1);
            //echo implode($y1[0]);
             $date = Jalalian::forge('today')->format('%Y-%m-%d'); // جمعه، 23 اسفند 97
//            echo $date;exit();
            FormModel::where('created_at','<=',trim($date).' 00:00:00')->update(['disabled'=>0]);
            ///////////////////////////////////end disable_to_date///////////////////////////////


        }
    }

    public function form1(Request $request)
    {
        $valiDate=$this->validate($request,[
           'name'=>'required',
//            'disabled'=>'',
//            'width'=>'',
//            'color'=>'',
//            'ip_validation_type'=>'',
//            'ips'=>'required',
//            'background_type'=>'',
//            'default_background'=>'',
//            'lang'=>'',
//            'date_limit'=>'required',
//            'submission_limit'=>'',
//            'sms_sender'=>'',
//            'sms_apikey'=>'',
//            'email_id'=>'',
//            'sms_id'=>'',
//            'login_id'=>'',
//            'api_key'=>'',
//            'unique_ft_id'=>'',
//            'sms_message'=>'',
//            'email_message'=>'',
//            'email_subject'=>'',
//            'sms_ft_id'=>'',
//            'email_ft_id'=>'',
        ]);
        $t=auth()->user()->forms()->create([
            'name'=>$valiDate['name'],
//            'disabled'=>$valiDate['disabled'],
//            'width'=>$valiDate['width'],
//            'color'=>$valiDate['color'],
//            'ip_validation_type'=>$valiDate['ip_validation_type'],
//            'background_type'=>$valiDate['background_type'],
//            'default_background'=>$valiDate['default_background'],
//            'template_id'=>$valiDate['template_id'],
//            'lang'=>$valiDate['lang'],
//            'date_limit'=>$valiDate['date_limit'],
//            'submission_limit'=>$valiDate['submission_limit'],
//            'sms_sender'=>$valiDate['sms_sender'],
//            'sms_apikey'=>$valiDate['sms_apikey'],
            'folder_id'=>$this->a(auth()->user()->id),
            'template_id'=>$this->b(auth()->user()->id),
            'sms_apikey'=>$this->d(auth()->user()->id),
            'sms_id'=>$this->dd(auth()->user()->id),
            'email_id'=>$this->e(auth()->user()->id),
            'login_id'=>$this->f(auth()->user()->id),
            'unique_ft_id'=>$this->fd(auth()->user()->id),
            'api_key'=>Str::random(30),
            'ips'=>$this->gggg(),
            'created_at'=>$date = Jalalian::forge('today')->format('%Y-%m-%d'),
        ]);
//        $task = FormModel::find($t->id)->toArray();
//        TrashModel::insert($task);

                    //add field formcount in table admins
                    $rr=FormModel::where('admin_id',auth()->user()->id)->count();
                    $r=User::find(auth()->user()->id);

                    $r->formcount=$rr;
                    $r->update();

                    $o= FormModel::where([['admin_id',$r->id],['name', $request->name]])->value('id');
                    HistoryModel::create([
                        'name'=>"create form",
                        'admin_id'=>auth()->user()->id,
                        'form_id' =>$t->id ,
                        'history'=>\Morilog\Jalali\Jalalian::now(),
                    ]);

        return response([
           'data'=>[
               'message'=>'form is registered',
               'date'=>$date = Jalalian::forge('today')->format('%Y-%m-%d')
           ] ,
            'status'=>'success',
        ]);
    }

    public function form11(Request $request,$fa)
    {
        $q=LangsModel::where('name',$fa)->take(1)->pluck('title');
        $valiDate=$this->validate($request,[
            'name'=>'required',
//            'disabled'=>'required',
//            'width'=>'required',
//            'color'=>'required',
           // 'ip_validation_type'=>'required',
          // 'ips'=>'required',
//            'background_type'=>'required',
//            'default_background'=>'required',
//            'lang'=>'',
            //'date_limit'=>'required',
            // 'submission_limit'=>'required',
//            'sms_sender'=>'',
//            'sms_apikey'=>'',
//            'email_id'=>'',
//            'sms_id'=>'',
//            'login_id'=>'',
//            'api_key'=>'',
//            'unique_ft_id'=>'',
//            'sms_message'=>'',
//            'email_message'=>'',
//            'email_subject'=>'',
//            'sms_ft_id'=>'',
//            'email_ft_id'=>'',
        ]);
        $t=auth()->user()->forms()->create([
            'name'=>$valiDate['name'],
//            'disabled'=>$valiDate['disabled'],
//            'width'=>$valiDate['width'],
//            'color'=>$valiDate['color'],
           // 'ip_validation_type'=>$valiDate['ip_validation_type'],
            'ips'=>$this->gggg(),
            //'background_type'=>$valiDate['background_type'],
           // 'default_background'=>$valiDate['default_background'],
            //'template_id'=>$valiDate['template_id'],
//            'lang'=>$valiDate['lang'],
//            'date_limit'=>$valiDate['date_limit'],
//            'submission_limit'=>$valiDate['submission_limit'],
//            'sms_sender'=>$valiDate['sms_sender'],
//            'sms_apikey'=>$valiDate['sms_apikey'],
            'folder_id'=>$this->a(auth()->user()->id),
            'template_id'=>$this->b(auth()->user()->id),
            'sms_apikey'=>$this->d(auth()->user()->id),
            'sms_id'=>$this->dd(auth()->user()->id),
            'email_id'=>$this->e(auth()->user()->id),
            'login_id'=>$this->f(auth()->user()->id),
            'unique_ft_id'=>$this->fd(auth()->user()->id),
            'api_key'=>Str::random(30),
            'created_at'=>$date = Jalalian::forge('today')->format('%Y-%m-%d'),

        ]);
        $o= FormModel::where([['admin_id',auth()->user()->id],['name', $request->name]])->value('id');
        HistoryModel::create([
            'name'=>"create form",
            'admin_id'=>auth()->user()->id,
            'form_id' =>$t->id ,
            'history'=>\Morilog\Jalali\Jalalian::now(),
        ]);
        return response([
            'data'=>[
                'message'=>'فرم ثبت شد',
                'date'=>$date = Jalalian::forge('today')->format('%Y-%m-%d')

            ] ,
            'status'=>'با موفقیت',
            'زبان'=>$q
        ]);
    }

    public function edit(Request $request)
    {

    }

    public function newform1(Request $request,$api,$name)
    {
        $valiDate=$this->validate($request,[
            'name'=>'',
            ]);
        auth()->user()->api_token;
        $t=auth()->user()->forms()->create([
            'name'=>$name,
            'api_token'=>$api,
            'folder_id'=>$this->a(auth()->user()->id),
            'template_id'=>$this->b(auth()->user()->id),
            'sms_apikey'=>$this->d(auth()->user()->id),
            'sms_id'=>$this->dd(auth()->user()->id),
            'email_id'=>$this->e(auth()->user()->id),
            'login_id'=>$this->f(auth()->user()->id),
            'unique_ft_id'=>$this->fd(auth()->user()->id),
            'api_key'=>Str::random(30),
           'ips'=>$this->gggg(),
            'created_at'=>$date = Jalalian::forge('today')->format('%Y-%m-%d'),

        ]);
        $o= FormModel::where([['admin_id',auth()->user()->id],['name', $request->name]])->value('id');
        HistoryModel::create([
            'name'=>"create form".$name,
            'admin_id'=>auth()->user()->id,
            'form_id' =>$t->id ,
            'history'=>\Morilog\Jalali\Jalalian::now(),
        ]);
        return response([
            'data'=>[
                'message'=>'form is registered',
                'date'=>$date = Jalalian::forge('today')->format('%Y-%m-%d')

            ] ,
            'status'=>'success',
        ]);
    }

    public function det($id)
    {
        $t0=FormModel::where([['id',$id],['admin_id',auth()->user()->id]])->value('name');
        HistoryModel::create([
            'name'=>"delete form ".$t0,
            'admin_id'=>auth()->user()->id,
            'form_id' =>$id ,
            'history'=>\Morilog\Jalali\Jalalian::now(),
        ]);

        $t=FormModel::where([['id',$id],['admin_id',auth()->user()->id]])->delete();
        if($t) {
            return response([
                'data' => 'delete with successfull',
                'date'=>$date = Jalalian::forge('today')->format('%Y-%m-%d')
            ]);

        }else{
            return "id not found";
        }
    }

    public function det1($id,$fa)
    {
        $t0=FormModel::where([['id',$id],['admin_id',auth()->user()->id]])->value('name');
        $q=LangsModel::where('name',$fa)->take(1)->pluck('title');
        $t=FormModel::where([['id',$id],['admin_id',auth()->user()->id]])->delete();
        if($t) {
            HistoryModel::create([
                'name'=>"delete form ".$t0,
                'admin_id'=>auth()->user()->id,
                'form_id' =>$id ,
                'history'=>\Morilog\Jalali\Jalalian::now(),
            ]);
            return response([

                'data' => 'کاربر پاک شد',
                'زبان'=>$q,
                'date'=>$date = Jalalian::forge('today')->format('%Y-%m-%d')

            ]);
        }else{
            return "این id وجود ندارد";
        }
    }
    public function showall(Request $request)//نمایش کل
    {
        $idform= FormModel::where('admin_id',auth()->user()->id)->pluck('id');
        $idform1= Other_answerModel::where('admin_id',auth()->user()->id)->pluck('id');
        foreach ($idform1 as $form1){
            $date = Jalalian::forge('today')->format('%Y-%m-%d'); // جمعه، 23 اسفند 97
            $t= Other_answerModel::where([['id',$form1],['expire_date','>','']])->whereNotNull('expire_date')->value('id');
            Other_answerModel::where('id',$t)->where('expire_date','<=',trim($date).' 00:00:00')->update(['form_status'=>'Disabled']);
        }

        $t= FormModel::where('admin_id',auth()->user()->id)->orderBy('id','Desc')->paginate(4);
        if($t){
            return response([
                'data'=>[
                    'message'=>$t,
                    'date'=> Jalalian::forge('today')->format('%Y-%m-%d')

                ]
            ]);
        }else{
            return response([
                'data' => [
                    'message' => 'یافت نشد',

                ],
            ]);
        }
    }
    public function show(Request $request)//نمایش قسمتی از فیلدها
    {
        $t= FormModel::where('admin_id',auth()->user()->id)->orderBy('id','Desc')->select('id','name','folder_id','disabled')->paginate(4);
        if($t){
            return response([
                'data'=>[
                    'message'=>$t,
                    'date'=> Jalalian::forge('today')->format('%Y-%m-%d')
                ]
            ]);
        }else{
            return response([
                'data' => [
                    'message' => 'یافت نشد',

                ],
            ]);
        }
    }

    public function showname()
    {
        $d= FormModel::where('admin_id',auth()->user()->id)->orderBy('id','Desc')->get(['name'])->toArray();
        $r= implode(', ',array_values($d[0]));
        $t=str_replace('[',' ',$r);
        $e= str_replace(']',' ',$t);
        return $e;
    }

    public function a($id)
    {
        $cc = FolderModel::where('admin_id', $id)->take(50)->pluck('id');
        $r= implode(', ',array($cc));
        $t=str_replace('[',' ',$r);
        $e= str_replace(']',' ',$t);
        return $e;
    }

    public function b($id)
    {
        $c=TemplatesModel::where('admin_id',$id)->orderBy('id','DESC')->take(50)->pluck('id');
        $r= implode(', ',array($c));
        $t=str_replace('[',' ',$r);
        $e= str_replace(']',' ',$t);
        return $e;
    }

    public function d($id)
    {
        $dd=SmsModel::where('admin_id',$id)->orderBy('id','DESC')->take(50)->pluck('apikey');
        $r= implode(', ',array($dd));
        $t=str_replace('[',' ',$r);
        $e= str_replace(']',' ',$t);
        return $e;
    }

    public function dd($id)
    {
        $ddd=SmsModel::where('admin_id',$id)->orderBy('id','DESC')->take(50)->pluck('id');
        $r= implode(', ',array($ddd));
        $t=str_replace('[',' ',$r);
        $e= str_replace(']',' ',$t);
        return $e;
    }

    public function e($id)
    {
        $ee=EmailsModel::where('admin_id',$id)->take(1)->pluck('id');
        $r= implode(', ',array($ee));
        $t=str_replace('[',' ',$r);
        $e= str_replace(']',' ',$t);
        return $e;
    }

    public function f($id)
    {
        $ff=AdminlastviewModel::where('admin_id',$id)->orderBy('id','DESC')->take(3)->pluck('id');
        $r= implode(', ',array($ff));
        $t=str_replace('[',' ',$r);
        $e= str_replace(']',' ',$t);
        return $e;
    }

    public function fd($id)
    {
        $fd=Form_TollsModel::where('admin_id',$id)->orderBy('id','DESC')->take(1)->pluck('id');
        $r= implode(', ',array($fd));
        $t=str_replace('[',' ',$r);
        $e= str_replace(']',' ',$t);
        return $e;
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
    ////////////////////////////////////////////////////////////////////////////////
    public function disable($id)//برای غیر فعال کردن یک فرم
    {
        $t= FormModel::find($id);
        $t->disabled=1;
        $t->save();
        $t0=FormModel::where([['id',$id],['admin_id',auth()->user()->id]])->value('name');
        HistoryModel::create([
            'name'=>"disable form ".$t0,
            'admin_id'=>auth()->user()->id,
            'form_id' =>$id ,
            'history'=>\Morilog\Jalali\Jalalian::now(),
        ]);
        return response([
            'data'=>[
                'message'=>'با موفقیت اعمال شد',
                'date'=>$date = Jalalian::forge('today')->format('%Y-%m-%d')

            ]
        ]);
    }
    public function disable_to_date($id,$date)//تا تاریخ فلان غیر فعال باشد
    {   //$date = Jalalian::forge('today')->format('%Y-%m-%d'); // جمعه، 23 اسفند 97
        $t= FormModel::find($id);
        $t->disabled=1;
        $t->created_at=trim($date);
        $t->save();
        $t0=FormModel::where([['id',$id],['admin_id',auth()->user()->id]])->value('name');

        HistoryModel::create([
            'name'=>"disable_to_date form ".$t0,
            'admin_id'=>auth()->user()->id,
            'form_id' =>$id ,
            'history'=>\Morilog\Jalali\Jalalian::now(),
        ]);
        return response([
            'data'=>[
                'message'=>'با موفقیت اعمال شد',
                'date'=>$date = Jalalian::forge('today')->format('%Y-%m-%d')

            ]
        ]);
    }
    public function enable($id)//رای فعال کردن یک فرم
    {
        $t= FormModel::find($id);
        $t->disabled=0;
        $t->save();
        $t0=FormModel::where([['id',$id],['admin_id',auth()->user()->id]])->value('name');
        HistoryModel::create([
            'name'=>"Enable form ".$t0,
            'admin_id'=>auth()->user()->id,
            'form_id' =>$id ,
            'history'=>\Morilog\Jalali\Jalalian::now(),
        ]);
        return response([
            'data'=>[
                'message'=>'با موفقیت اعمال شد',
                'date'=>$date = Jalalian::forge('today')->format('%Y-%m-%d')

            ]
        ]);
    }

    public function submission($id)//submisstion
    {
        $t=FormModel::find($id);
        $u=SubmissionsModel::where('form_id',$id)->get(['created_at','ip']);
        if($t) {
            $t0=FormModel::where([['id',$id],['admin_id',auth()->user()->id]])->value('name');
            HistoryModel::create([
                'name'=>"submission form ".$t0,
                'admin_id'=>auth()->user()->id,
                'form_id' =>$id ,
                'history'=>\Morilog\Jalali\Jalalian::now(),
            ]);
            return response([

                'data' =>[
                    'message'=>$u,
                    'date'=>$date = Jalalian::forge('today')->format('%Y-%m-%d')

                ]
            ]);
        }else{
            return response([

                'data' => 'پیدا نشد'
            ]);
        }
    }
    public function fav_enable($id)//جزو دلخواه ها میشه
    {
        $u=new SubmissionsModel;
        $u=$u->where('form_id',$id)->first();
        $u->fav=1;
        $u->save();
        $t0=FormModel::where([['id',$id],['admin_id',auth()->user()->id]])->value('name');
        HistoryModel::create([
            'name'=>"fav_enable form ".$t0,
            'admin_id'=>auth()->user()->id,
            'form_id' =>$id ,
            'history'=>\Morilog\Jalali\Jalalian::now(),
        ]);
        return response([
            'data'=>[
                'message'=>'با موفقیت اعمال شد',
                'date'=>$date = Jalalian::forge('today')->format('%Y-%m-%d')

            ]
        ]);
    }
    public function fav_disable($id)//از دلخواه ها بیرون میاد
    {
        $u=new SubmissionsModel;
        $u=$u->where('form_id',$id)->first();
        $u->fav=0;
        $u->save();
        $t0=FormModel::where([['id',$id],['admin_id',auth()->user()->id]])->value('name');
        HistoryModel::create([
            'name'=>"fav_disable form ".$t0,
            'admin_id'=>auth()->user()->id,
            'form_id' =>$id ,
            'history'=>\Morilog\Jalali\Jalalian::now(),
        ]);
        return response([
            'data'=>[
                'message'=>'با موفقیت اعمال شد',
                'date'=>$date = Jalalian::forge('today')->format('%Y-%m-%d')

            ]
        ]);

    }
    public function sort()//بر اساس حروف الفبا از آخر به اول مرتب میکند
    {
        return FormModel::where('admin_id',auth()->user()->id)->orderby('name','desc')->get(['name']);
    }
    public function sort1()//بر اساس حروف الفبا از اول به آخر مرتب میکند
    {
        return FormModel::where('admin_id',auth()->user()->id)->orderby('name','asc')->get(['name']);
    }
    public function sort2()//بر اساس تاریخ ایجاد شده sort میکند
    {
        return FormModel::where('admin_id',auth()->user()->id)->orderby('created_at','asc')->get(['name']);
    }
    public function sort3()//بر اساس تاریخ ادیت شده sort میکند
    {
        return FormModel::where('admin_id',auth()->user()->id)->orderby('updated_at','asc')->get(['name']);
    }
    public function search($keyword)//جستجو
    {
        $r= FormModel::where('name', 'LIKE', '%' . $keyword . '%')->get(['name']);
            return $r;

    }
    public function rename(Request $request,$id)
    {
        $valiDate = $this->validate($request, [
            'name' => '',

        ]);
        $user = FormModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->name = $valiDate['name'];
            $t0=FormModel::where([['id',$id],['admin_id',auth()->user()->id]])->value('name');
            HistoryModel::create([
                'name'=>"rename form ".$t0,
                'admin_id'=>auth()->user()->id,
                'form_id' =>$id ,
                'history'=>\Morilog\Jalali\Jalalian::now(),
            ]);
            if ($user->update()) {
                return response([
                    'data' => [
                        'message' => ' name form is update',
                        'date'=>$date = Jalalian::forge('today')->format('%Y-%m-%d')
                    ],
                    'status' => 'success',

                ]);
            }
        } else {
            return "Id not found";
        }
    }//تغییر نام فرم یا  rename به صورت انگلیسی
    public function rename_fa(Request $request,$id,$fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
            'name' => '',

        ]);
        $user = FormModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->name = $valiDate['name'];
            $t0=FormModel::where([['id',$id],['admin_id',auth()->user()->id]])->value('name');
            HistoryModel::create([
                'name'=>"rename form ".$t0,
                'admin_id'=>auth()->user()->id,
                'form_id' =>$id ,
                'history'=>\Morilog\Jalali\Jalalian::now(),
            ]);
            if ($user->update()) {
                return response([
                    'data' => [
                        'message' => ' نام فرم تغییر داده شد',
                        'date'=>$date = Jalalian::forge('today')->format('%Y-%m-%d')

                    ],
                    'status' => 'با موفقیت',
                    'info'=>$q,

                ]);
            }
        } else {
            return "نمی تواند";
        }
    }//تغییر نام فرم یا rename  به صورت فارسی

    public function show_history($form_id)
    {
       $t=HistoryModel::where([['form_id',$form_id],['admin_id',auth()->user()->id]])->pluck('name','history');
       if($t){
           return response([
               'data'=>[
                'message'=>$t,
               ]
           ]);
       }else{
           return response([
               'data'=>[
                   'message'=>"پیدا نشد",
               ]
           ]);
       }
    }
}
