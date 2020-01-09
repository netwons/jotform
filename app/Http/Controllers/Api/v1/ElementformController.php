<?php

namespace App\Http\Controllers\Api\v1;

use App\ElementModel;
use App\FormModel;
use App\HistoryModel;
use App\LogModel;
use App\LogoModel;
use App\SelectLogoModel;
use App\ToolsModel;
use App\TrashModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Route;
use Jenssegers\Agent\Agent;
use Illuminate\Filesystem\Filesystem;
use Morilog\Jalali\Jalalian;

class ElementformController extends Controller
{

    public function __construct(Request $request,Route $route)
    {
        //تشخیص موبایل بودن یا دسکتاب بودن رو اینجوری چک میکنم
        $t= preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
        if ($t) {
            $r= "mobile";
        } else {
            $r= "desktop";
        }

        /////////////////////
        ///

        $agent= new Agent();//من برای بدست آوردن اطلاعات سیستم از این پکیج استفاده کردم
        if($route->methods()[0]!='GET' | $route->methods()[0]=='GET') {
            $method = $route->getActionMethod();
            $actions = explode('\\', $route->getActionName());
            $controller = substr(end($actions), 0, strpos(end($actions), "@"));
            LogModel::create([
                'ip' => $request->ip(),
                'agent' =>$agent->setUserAgent(),
                'controller' => $controller,
                'method' => $method,
                'user_id' =>'',
                'input' => \GuzzleHttp\json_encode($request->all()),//$request->getContent(),
                'route' => $request->path(),
                'browser'=>$agent->browser(),
                'mobile_or_desktop'=>$r,
                'platform'=>$agent->platform(),
                //'http_method' => $route->methods()[0],

            ]);
        }
    }
    //ایجاد المنت در صفحه و مرتب کردن انها
    public function sort_element($id,$element_id)//ایدی شماره فرم هست   element_idهم ایدی المنت ها هست مثل ایمیل
    {
        $element_name=ToolsModel::where('id',$element_id)->pluck('name_en');

        $strname=str_replace("[\"",'',$element_name);
        $strname1=str_replace("\"]",'',$strname);
        $order=ElementModel::where([['form_id',$id],['admin_id',auth()->user()->id]])->orderby('order','desc')->take(1)->get(['order']);
        $str=str_replace("[{\"",'',$order);
        $str1=str_replace("order\":",'',$str);
        $str2=str_replace("}]",'',$str1);
        //echo $str2;
        if(empty($str2)){
            $y=0;
        }else{
            $y=(int)$str2+1;
        }

        $r= FormModel::where([['id',$id],['admin_id',auth()->user()->id]])->get();
        if(!empty($r)){
           $rr= ToolsModel::where('id',$element_id)->get();
            if(!empty($rr)) {
                ElementModel::create([
                    'admin_id' => auth()->user()->id,
                    'form_id' => $id,
                    'element' => $element_id,
                    'element_name'=>$strname1,
                    'order'=>(int)$y,
                ]);

                    HistoryModel::create([
                        'name'=>"$strname1",
                        'admin_id'=>auth()->user()->id,
                        'form_id' => $id,
                        'history'=>\Morilog\Jalali\Jalalian::now(),
                    ]);

                return response()->json([
                    'data'=>[
                        'message'=>'با موفقیت انجام شد'
                    ],
                    'status'=>'success'
                ]);
            }else{
                return response()->json([
                    'data'=>[
                        'message'=>'انجام نشد'
                    ],
                    'status'=>"Failure"
                ]);
            }
        }else{
            return "no1";
        }
    }

    public function show_sort_element($form_id)//همه اونهایی که با شرط برابر هستند رو نمایش میده
    {
        $t=ElementModel::where([['form_id', $form_id],['admin_id',auth()->user()->id]])->orderby('order','asc')->get();
        return response([
            'data'=>[
                'message'=>$t
            ] ,
            'status'=>'success'
        ]);

    }
    public function show_sort_element_id($form_id)//بر اساس idنمایش میده
    {
        $r= ElementModel::where([['form_id', $form_id],['admin_id',auth()->user()->id]])->orderby('order','asc')->get(['id']);
        $str=str_replace("[",'',$r);
        $str0=str_replace("{",'',$str);
        $str1=str_replace("id",'',$str0);
        $str2=str_replace("}",'',$str1);
        $str3=str_replace("]",'',$str2);
        $str4=str_replace("\"",'',$str3);
        $str5=str_replace(":",'',$str4);

        return response([
           'data'=>[
               'message'=>$str5
           ] ,
            'status'=>'success'
        ]);
    }

    public function show_sort_element_element_id($form_id)
    {
        $str5= ElementModel::where([['form_id', $form_id],['admin_id',auth()->user()->id]])->orderby('order','asc')->pluck('element');
        $str1=str_replace("[",'',$str5);
        $str2=str_replace("]",'',$str1);
        return response([
            'data'=>[
                'message'=>$str2
            ] ,
            'status'=>'success'
        ]);
    }
    public function show_sort_element_element_name($form_id)
    {
        $str5= ElementModel::where([['form_id', $form_id],['admin_id',auth()->user()->id]])->orderby('order','asc')->pluck('element_name');
        $str1=str_replace("[",'',$str5);
        $str2=str_replace("]",'',$str1);
        return response([
            'data'=>[
                'message'=>$str2
            ] ,
            'status'=>'success'
        ]);
    }
    public function edit_element($form_id)
    {
        $t=ElementModel::where([['form_id',$form_id],['admin_id',auth()->user()->id]])->get(['id','order'])->toArray();

        //return $t;
        //echo $t;exit();
        $str1=str_replace("{",'',$t);
        $str2=str_replace("}",'',$str1);
        $str3=str_replace("\"",'',$str2);

        $o=ElementModel::where([['form_id',$form_id],['admin_id',auth()->user()->id]])->value('element_name');
        HistoryModel::create([
            'name'=>$o,
            'admin_id'=>auth()->user()->id,
            'form_id' => $form_id,
            'history'=>\Morilog\Jalali\Jalalian::now(),
        ]);
       // echo $str3;
        return response([
            'data'=>[
                'message'=>$str3
            ] ,
            'status'=>'success'
        ]);

    }

    public function edit_element_order(Request $request,$form_id,$id)       //تغییر دادن orderهای یک فرم به صورت تکی
    {
        $valiDate = $this->validate($request, [
            //'admin_id'=>'',
            //'form_id'=>'',
            'order' => '',
        ]);
        $user = ElementModel::find($id);
        $id_old= ElementModel::where([['id',$id],['form_id',$form_id],['admin_id',auth()->user()->id]])->value('order');

        if ($user->admin_id == auth()->user()->id) {
            //$user->form_id = $valiDate['form_id'];
            $user->order = $valiDate['order'];
            $id1=$user->order;
//            return $id1;
            $id_new= ElementModel::where([['order',$id1],['form_id',$form_id],['admin_id',auth()->user()->id]])->value('id');
            if(!empty($id_new)){
                $user1 = ElementModel::find($id_new);
                $user1->update(['order'=>$id_old]);
            }
            $o=ElementModel::where([['form_id',$form_id],['admin_id',auth()->user()->id]])->value('element_name');
            HistoryModel::create([
                'name'=>$o,
                'admin_id'=>auth()->user()->id,
                'form_id' => $form_id,
                'history'=>\Morilog\Jalali\Jalalian::now(),
            ]);
            if ($user->update()) {
                return response([
                    'data' => [
                        'message' => ' تغییرات اعمال شد',
                    ],
                    'status' => 'success',
                    //'info' => $user
                ]);
            }
        } else {
            return "پیدا نشد";
        }
    }


    public function edit_element1(Request $request,$id)//ایدی در اینجا همین فرم آیدی هست
    {
        //تغییر دادن orderهای یک فرم به صورت کلی
        $valiDate = $this->validate($request, [
            'admin_id'=>'',
            'form_id'=>'',
            'order' => '',
        ]);
        $user2=ElementModel::where([['form_id',$id],['admin_id',auth()->user()->id]])->count();
        $user3=ElementModel::where([['form_id',$id],['admin_id',auth()->user()->id]])->pluck('id');
        //echo   $user2;//تعداد
        $str1=str_replace("[",'',$user3);
        $str1=str_replace("]",'',$str1);
       // echo $str1;exit();
        //echo gettype($user3);exit();
        $user3=explode(',',$str1);
//        return $user3;
        //exit();
        $i=0;
        $y=$valiDate['order'];
        $str6=str_replace("[",'',$y);
        $str7=str_replace("]",'',$str6);
        $str8=str_replace("\"",'',$str7);
        $array=explode(',',$str8);

        for($user3[$i];$i<$user2;$i++) {

             $user = ElementModel::find($user3[$i]);

             //echo $user;exit();
            if ($user->admin_id == auth()->user()->id) {
                $user->order = $array[$i];
                $o=ElementModel::where([['form_id',$id],['admin_id',auth()->user()->id]])->value('element_name');
                HistoryModel::create([
                    'name'=>$o,
                    'admin_id'=>auth()->user()->id,
                    'form_id' => $id,
                    'history'=>\Morilog\Jalali\Jalalian::now(),
                ]);
                if ($user->update()) {
//                    return response([
//                        'data' => [
//                            'message' => ' form is register',
//                        ],
//                        'status' => 'success',
//                        'info' => $user
//                    ]);
                    if($user2==$i+1){
                        return response([
                            'data'=>[
                                'message'=>'تغییرات اعمال شد'
                            ] ,
                            'status'=>'success'
                        ]);

                    }
                }
            }else {
                return response([
                    'data'=>[
                        'message'=>'id not found'
                    ] ,
                    'status'=>'Fail'
                ]);
            }
        }
    }

    public function delete_element($id,$form_id)
    {
        $t= ElementModel::where('id',$id)->where('admin_id',auth()->user()->id)->where('form_id',$form_id)->delete();
        if($t){
            $o=ElementModel::where([['form_id',$form_id],['admin_id',auth()->user()->id]])->value('element_name');
            HistoryModel::create([
                'name'=>$o,
                'admin_id'=>auth()->user()->id,
                'form_id' => $form_id,
                'history'=>\Morilog\Jalali\Jalalian::now(),
            ]);
            return response([
                'data'=>[
                    'message'=>'پاک شد',
                ] ,
                'status'=>'success'
            ]);
        }else{
            return response([
                'data'=>[
                    'message'=>'این ایدی وجود ندارد',
                ] ,
                'status'=>'fails'
            ]);
        }

        //or   return ElementModel::where(['id'=>$id,'form_id'=>$form_id,'admin_id' => auth()->user()->id])->delete();

    }

    public function logo(Request $request,Filesystem $filesystem)
    {
        $valiDate = $this->validate($request, [
            'admin_id'=>'',
            'form_id' => '',
            'upload' => 'mimes:jpeg,jpg,bmp,png|max:300',
            'width' => '',
            'height' => '',
            'alignment' => '',
            'upload_url'=>''

        ]);
        $file=$request->file('upload');

        $imagepath="/upload/images/";
        $filename=$file->getClientOriginalName();//نام فایل رو با این دستور میگیریم
        if($filesystem->exists(public_path("{$imagepath}/{$filename}")))
        {
            $filename=Carbon::now()->timestamp . "-{$filename}";
        }
        $file->move(public_path($imagepath) , $filename);
        HistoryModel::create([
            'name'=>"upload image to color =>"."{$imagepath}/{$filename}",
            'admin_id'=>auth()->user()->id,
            'form_id' =>$valiDate['form_id'],
            'history'=>\Morilog\Jalali\Jalalian::now(),
        ]);
        $y = LogoModel::create([
            'admin_id'=>auth()->user()->id,
            'form_id' => $valiDate['form_id'],
            'upload' => "{$imagepath}/{$filename}",
            'width' => $valiDate['width'],
            'height' => $valiDate['height'],
            'alignment' => $valiDate['alignment'],
            'upload_url'=>$valiDate['upload_url']

        ]);
        return response([
            'data' => [
                'message' => 'color is registered',
                'image_url'=>url("{$imagepath}/{$filename}"),
                'date'=>$date = Jalalian::forge('today')->format('%Y-%m-%d')

            ],
            'status' => 'success',

        ]);
    }
    public function logo_with_url(Request $request)
    {
        $valiDate = $this->validate($request, [
            'admin_id'=>'',
            'form_id' => '',
            'upload' => '',
            'upload_url' => '',
            'width' => '',
            'height' => '',
            'alignment' => '',

        ]);


        $imagepath="/upload/images/";


        $y = LogoModel::create([
            'admin_id'=>auth()->user()->id,
            'form_id' => $valiDate['form_id'],
            'upload' => "",
            'upload_url' => $valiDate['upload_url'],
            'width' => $valiDate['width'],
            'height' => $valiDate['height'],
            'alignment' => $valiDate['alignment'],
        ]);
        HistoryModel::create([
            'name'=>"upload image =>"."{$imagepath}/".$valiDate['upload_url'],
            'admin_id'=>auth()->user()->id,
            'form_id' =>$valiDate['form_id'],
            'history'=>\Morilog\Jalali\Jalalian::now(),
        ]);
        return response([
            'data' => [
                'message' => 'color is registered',
                'image_url'=>url("{$imagepath}/"),
                'date'=>$date = Jalalian::forge('today')->format('%Y-%m-%d')

            ],
            'status' => 'success',

        ]);
    }

    public function show_logo($form_id)
    {
        $t=LogoModel::where([['admin_id',auth()->user()->id],['form_id',$form_id]])->where('upload',">","")->pluck('upload');
        if($t){
            return response([
                'data' => [
                    'image_url'=>$t,
                ],
            ]);
        }else{
            return response([
                'data' => [
                    'message'=>"وجود ندارد",
                ],

            ]);
        }
    }

    public function delete_logo($id)
    {
        HistoryModel::create([
            'name'=>"delete logo ",
            'admin_id'=>auth()->user()->id,
            'form_id' =>$id,
            'history'=>\Morilog\Jalali\Jalalian::now(),
        ]);
        $t=LogoModel::where([['id',$id],['admin_id',auth()->user()->id]])->delete();
        if($t) {
            return response([
                'data' => 'delete with successfull',
                'date'=>$date = Jalalian::forge('today')->format('%Y-%m-%d')

            ]);
        }else{
            return "id not found";
        }
    }

    public function select_logo($id,$form_id)
    {
        SelectLogoModel::create([
            'admin_id'=>auth()->user()->id,
            'form_id' =>$form_id,
            'selectlogo' =>$id,

        ]);
        HistoryModel::create([
        'name'=>"select logo ",
        'admin_id'=>auth()->user()->id,
        'form_id' =>$id,
        'history'=>\Morilog\Jalali\Jalalian::now(),
    ]);
        return response([
            'data' => [
                'message' => 'ثبت شد',
                'date'=>$date = Jalalian::forge('today')->format('%Y-%m-%d')

            ],
            'status' => 'success',

        ]);
    }
    public function select_logo_edit(Request $request,$form_id)
    {
        $valiDate = $this->validate($request, [
            'admin_id'=>"",
            'form_id' =>"",
            'selectlogo' =>"required",
        ]);
        $id=SelectLogoModel::where('form_id',$form_id)->value('id');
        $user=SelectLogoModel::find($id);
        $user->admin_id=auth()->user()->id;
        $user->form_id=$form_id;
        $user->selectlogo=$valiDate['selectlogo'];
        HistoryModel::create([
            'name'=>"edit logo ",
            'admin_id'=>auth()->user()->id,
            'form_id' =>$id,
            'history'=>\Morilog\Jalali\Jalalian::now(),
        ]);
        if ($user->update()) {
            return response([
                'data' => [
                    'message' => ' عکس آپدیت شد',
                ],
                'status' => 'success',
                'info' => $user,
                'date'=>$date = Jalalian::forge('today')->format('%Y-%m-%d')

            ]);

        } else {
            return "Id not found";
        }
    }
    public function select_logo_delete($id)
    {
        HistoryModel::create([
            'name'=>"delete logo ",
            'admin_id'=>auth()->user()->id,
            'form_id' =>$id,
            'history'=>\Morilog\Jalali\Jalalian::now(),
        ]);
        $t=SelectLogoModel::where('id',$id)->delete();
        if(!empty($t)) {
            return response([
                'data' => [
                    'message' => "با موفقیت پاک شد",
                ],
                'status' => 'success',
                'date'=>$date = Jalalian::forge('today')->format('%Y-%m-%d')


            ]);
        }else{
            return response([
                'data' => [
                    'message' => "پیدا نشد",
                ],
                'status' => 'success',
            ]);
        }
    }
    public function select_logo_delete1($form_id)// کردن با form_id
    {
        HistoryModel::create([
            'name'=>"delete logo ",
            'admin_id'=>auth()->user()->id,
            'form_id' =>$form_id,
            'history'=>\Morilog\Jalali\Jalalian::now(),
        ]);
        $t=SelectLogoModel::where('form_id',$form_id)->delete();
        if(!empty($t)) {
            return response([
                'data' => [
                    'message' => "با موفقیت پاک شد",
                    'date'=>$date = Jalalian::forge('today')->format('%Y-%m-%d')

                ],
                'status' => 'success',

            ]);
        }else{
            return response([
                'data' => [
                    'message' => "پیدا نشد",
                ],
                'status' => 'success',
            ]);
        }
    }
    public function show_select_logo($form_id)
    {
        HistoryModel::create([
            'name'=>"delete logo ",
            'admin_id'=>auth()->user()->id,
            'form_id' =>$form_id,
            'history'=>\Morilog\Jalali\Jalalian::now(),
        ]);
        $t=SelectLogoModel::where('form_id',$form_id)->value('selectlogo');
        if(!empty($t)){
            $q=LogoModel::where('id',$t)->value('upload');
            return response([
                'data' => [
                    'message' => $q,
                ],
                'status' => 'success',
                'date'=>$date = Jalalian::forge('today')->format('%Y-%m-%d')


            ]);
        }else{
            return response([
                'data' => [
                    'message' => 'پیدا نشد',
                ],


            ]);
        }

    }

}
