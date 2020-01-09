<?php

namespace App\Http\Controllers\Api\v1;

use App\ColorsModel;
use App\CssModel;
use App\FontModel;
use App\HistoryModel;
use App\Select_themsModel;
use App\StyleModel;
use App\ThemsModel;
use Carbon\Carbon;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Morilog\Jalali\Jalalian;

class ColorsController extends Controller
{
    public function colors(Request $request,Filesystem $filesystem)
    {
        //return $request->file('page_image');
        $valiDate = $this->validate($request, [
            'admin_id'=>'',
            'form_id' => 'min:0|max:7',
            'color_scheme' => 'min:0|max:7',
            'page_color' => '',
            'page_image' => 'mimes:jpeg,jpg,bmp,png|max:300',//330کیلو بایت  هست
            'form_color' => 'min:0|max:7',
            'form_image'=>  'mimes:jpeg,jpg,bmp,png|max:300',//330کیلو بایت  هست
            'font_color' => 'min:0|max:7',
            'input_background' => 'min:0|max:1000',
        ]);
        $file=$request->file('page_image');
        $file1=$request->file('form_image');
        $imagepath="/upload/images";
        $filename=$file->getClientOriginalName();//نام فایل رو با این دستور میگیریم
        $filename1=$file1->getClientOriginalName();//نام فایل رو با این دستور میگیریم
        if($filesystem->exists(public_path("{$imagepath}/{$filename}")))
        {
            $filename=Carbon::now()->timestamp . "-{$filename}";
        }
        if($filesystem->exists(public_path("{$imagepath}/{$filename1}")))
        {
            $filename1=Carbon::now()->timestamp . "-{$filename1}";
        }
        //این شرطبالا رو قرار دادیم تا زمانی که از یک فایل تکراری بود قبلش بیاد یک زمان حال رو بهش بده تا خطا از بابت این که تکراری هست نده
        $file->move(public_path($imagepath),$filename);
        $file1->move(public_path($imagepath),$filename1);
        HistoryModel::create([
            'name'=>"upload image =>"."{$imagepath}/{$filename}",
            'admin_id'=>auth()->user()->id,
            'form_id' =>$valiDate['form_id'],
            'history'=>\Morilog\Jalali\Jalalian::now(),
        ]);
        $y = ColorsModel::create([
            'admin_id'=>auth()->user()->id,
            'form_id' => $valiDate['form_id'],
            'color_scheme' => $valiDate['color_scheme'],
            'page_color' => $valiDate['page_color'],
            'page_image' => "{$imagepath}/{$filename}",
            'form_color' => $valiDate['form_color'],
            'form_image' => "{$imagepath}/{$filename1}",
            'font_color' => $valiDate['font_color'],
            'input_background' => $valiDate['input_background'],
        ]);
        return response([
            'data' => [
                'message' => 'color is registered',
                'image_url'=>"{$imagepath}/{$filename}",
                'form_image'=>"{$imagepath}/{$filename1}",
                'date'=>$date = Jalalian::forge('today')->format('%Y-%m-%d')
            ],

            'status' => 'success',
            'ID' => $y->id
        ]);
    }

    public function colors_show($id)
    {
        $ee= ColorsModel::where([['id',$id],['admin_id',auth()->user()->id]])->get(['id','color_scheme','page_color','page_image','form_color','font_color','input_background']);
        $r= implode(',',array($ee));
        $t=str_replace('[{',' ',$r);
        $e= str_replace('}]',' ',$t);
        $q= str_replace('\n',' ',$e);
        return $q;
    }

    public function colors_edit(Request $request,$id,Filesystem $filesystem)
    {
        $valiDate = $this->validate($request, [
            'admin_id'=>'',
            'form_id' => 'min:0|max:7',
            'color_scheme' => 'min:0|max:7',
            'page_color' => '',
            'page_image' => 'mimes:jpeg,jpg,bmp,png|max:300',//330کیلو بایت  هست
            'form_color' => 'min:0|max:7',
            'form_image' => 'mimes:jpeg,jpg,bmp,png|max:300',//330کیلو بایت  هست
            'font_color' => 'min:0|max:7',
            'input_background' => 'min:0|max:1000',
        ]);

        $file=$request->file('page_image');
        $file1=$request->file('form_image');
//        $year=Carbon::now()->year;
//        $month=Carbon::now()->month;
//        $day=Carbon::now()->day;
        $imagepath="/upload/images/";
        $filename=$file->getClientOriginalName();//نام فایل رو با این دستور میگیریم
        $filename1=$file1->getClientOriginalName();//نام فایل رو با این دستور میگیریم
        //return public_path("{$imagepath}/{$filename}");
        if($filesystem->exists(public_path("{$imagepath}/{$filename}")))
        {
            $filename=Carbon::now()->timestamp . "-{$filename}";

        }
        if($filesystem->exists(public_path("{$imagepath}/{$filename1}")))
        {
            $filename1=Carbon::now()->timestamp . "-{$filename1}";

        }
        //این شرطبالا رو قرار دادیم تا زمانی که از یک فایل تکراری بود قبلش بیاد یک زمان حال رو بهش بده تا خطا از بابت این که تکراری هست نده
        $file->move(public_path($imagepath) , $filename);
        $file1->move(public_path($imagepath) , $filename1);
        HistoryModel::create([
            'name'=>"edit upload image =>"."{$imagepath}/{$filename}",
            'admin_id'=>auth()->user()->id,
            'form_id' =>$valiDate['form_id'],
            'history'=>\Morilog\Jalali\Jalalian::now(),
        ]);
        $input = array_filter($request->all(), 'strlen');
        $user= ColorsModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->admin_id=auth()->user()->id;
            $updateUser = $user->update($input);
//            $user->form_id = $valiDate['form_id'];
//            $user->color_scheme = $valiDate['color_scheme'];
//            $user->page_color = $valiDate['page_color'];
//            $user->page_image = url("{$imagepath}/{$filename}");
//            $user->form_color = $valiDate['form_color'];
//            $user->font_color = $valiDate['font_color'];
//            $user->input_background = $valiDate['input_background'];
            if ($updateUser) {
                return response([
                    'data' => [
                        'message' => ' color is register',
                        'image_url'=>"{$imagepath}/{$filename}",
                        'form_image'=>"{$imagepath}/{$filename1}",
                        'date'=>$date = Jalalian::forge('today')->format('%Y-%m-%d')

                    ],
                    'status' => 'success',
                    'info' => $user,

                ]);
            }
        } else {
            return "Id not found";
        }
    }
    public function image(Request $request ,$id)
    {
        $valiDate=$this->validate($request,[
           'admin_id'=>'',
           'form_id'=>'min:0|max:7',
        ]);
    }
    public function colors_edit1(Request $request,$form_id,Filesystem $filesystem)
    {

        $valiDate = $this->validate($request, [
            'admin_id'=>'',
            'form_id' => 'min:0|max:7',
            'color_scheme' => 'min:0|max:7',
            'page_color' => '',
            'page_image' => 'mimes:jpeg,jpg,bmp,png|max:300',//330کیلو بایت  هست
            'form_color' => 'min:0|max:7',
            'form_image' => 'mimes:jpeg,jpg,bmp,png|max:300',//330کیلو بایت  هست
            'font_color' => 'min:0|max:7',
            'input_background' => 'min:0|max:1000',
        ]);
        $input = array_filter($request->all(), 'strlen');
        $file=$request->file('page_image');
        $file1=$request->file('form_image');
//        $year=Carbon::now()->year;
//        $month=Carbon::now()->month;
//        $day=Carbon::now()->day;
        $imagepath="/upload/images/";
        $filename=$file->getClientOriginalName();//نام فایل رو با این دستور میگیریم
        $filename1=$file1->getClientOriginalName();//نام فایل رو با این دستور میگیریم
        //return public_path("{$imagepath}/{$filename}");
        if($filesystem->exists(public_path("{$imagepath}/{$filename}")))
        {
            $filename=Carbon::now()->timestamp . "-{$filename}";

        }
        if($filesystem->exists(public_path("{$imagepath}/{$filename1}")))
        {
            $filename1=Carbon::now()->timestamp . "-{$filename1}";

        }
        //این شرطبالا رو قرار دادیم تا زمانی که از یک فایل تکراری بود قبلش بیاد یک زمان حال رو بهش بده تا خطا از بابت این که تکراری هست نده
        $file->move(public_path($imagepath) , $filename);
        $file1->move(public_path($imagepath) , $filename1);
        HistoryModel::create([
            'name'=>"edit upload image =>"."{$imagepath}/{$filename}",
            'admin_id'=>auth()->user()->id,
            'form_id' =>$valiDate['form_id'],
            'history'=>\Morilog\Jalali\Jalalian::now(),
        ]);
        $user1= ColorsModel::where('form_id','=',$form_id)->pluck('id');
        //echo $user1;
        $user2=str_replace("[",'',$user1);
        $user3=str_replace("]",'',$user2);
       // echo $user3;
        $user= ColorsModel::find($user3);
        //echo $user;

        if ($user->admin_id == auth()->user()->id) {
            $user->admin_id=auth()->user()->id;
            $updateUser = $user->update($input);

//            $user->form_id = $valiDate['form_id'];
//            $user->color_scheme = $valiDate['color_scheme'];
//            $user->page_color = $valiDate['page_color'];
//            $user->page_image = url("{$imagepath}/{$filename}");
//            $user->form_color = $valiDate['form_color'];
//            $user->font_color = $valiDate['font_color'];
//            $user->input_background = $valiDate['input_background'];
            if ($updateUser) {
                return response([
                    'data' => [
                        'message' => ' آپدیت انجام شد',
                        'image_url'=>"{$imagepath}/{$filename}",
                        'form_image'=>"{$imagepath}/{$filename}",
                        'date'=>$date = Jalalian::forge('today')->format('%Y-%m-%d')
                    ],
                    'status' => 'success',
                    'info' => $user
                ]);
            }
        } else {
            return "Id not found";
        }
    }
    public function colors_delete($id)
    {
        $p=ColorsModel::where('id',$id)->value('form_id');
        HistoryModel::create([
            'name'=>"edit upload image" .$id,
            'admin_id'=>auth()->user()->id,
            'form_id' =>$p,
            'history'=>\Morilog\Jalali\Jalalian::now(),
        ]);
        $t = ColorsModel::where([['id', $id], ['admin_id', auth()->user()->id]])->delete();
        if ($t) {
            return response([
                'data' => 'delete with successfull',
                'date'=>$date = Jalalian::forge('today')->format('%Y-%m-%d')
            ]);
        } else {
            return "id not found";
        }
    }
    public function colors_form_id($form_id)
    {
        $t=ColorsModel::where([['form_id', $form_id],['admin_id',auth()->user()->id]])->get();
        if ($t) {
            return response([

                'data' => $t
            ]);
        } else {
            return "id not found";
        }
    }

//////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////style/////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function style(Request $request)
    {
        $valiDate = $this->validate($request, [
            'admin_id'=>'',
            'form_id' => 'min:0|max:7',
            'form_width' => 'min:0|max:7',
            'label_alignment' => '',
            'question_spacing' => 'min:0|max:7',
            'label_width' => 'min:0|max:7',
            'font_id' => 'min:0|max:17',
            'font_size' => 'min:0|max:7',
            'button_style'=>'min:0|max:300'

        ]);

        $y = StyleModel::create([
            'admin_id'=>auth()->user()->id,
            'form_id' => $valiDate['form_id'],
            'form_width' => $valiDate['form_width'],
            'label_alignment' => $valiDate['label_alignment'],
            'question_spacing' => $valiDate['question_spacing'],
            'label_width' => $valiDate['label_width'],
            'font_id' => $valiDate['font_id'],
            'font_size' => $valiDate['font_size'],
            'button_style' => $valiDate['button_style'],
        ]);
        HistoryModel::create([
            'name'=>"edit upload image" .$y->id,
            'admin_id'=>auth()->user()->id,
            'form_id' =>$valiDate['form_id'],
            'history'=>\Morilog\Jalali\Jalalian::now(),
        ]);
        return response([
            'data' => [
                'message' => 'style is registered',
                'date'=>$date = Jalalian::forge('today')->format('%Y-%m-%d')

            ],
            'status' => 'success',
            'ID' => $y->id
        ]);

    }

    public function style_show($form_id)
    {
        $ee= StyleModel::where([['form_id',$form_id],['admin_id',auth()->user()->id]])->get(['id','form_width','label_alignment','question_spacing','label_width','font_id','font_size','button_style']);
        $r= implode(',',array($ee));
        $t=str_replace('[{',' ',$r);
        $e= str_replace('}]',' ',$t);
        $q= str_replace('\n',' ',$e);
//        return $q;
        if(!empty($q)) {
            return response([
                'data' => [
                    'message' => $q,
                ],
                'status' => 'success',

            ]);
        }else{
            return response([
                'data' => [
                    'message' => "ناموفق",
                ],
                'status' => 'Fails',

            ]);
        }
    }

    public function font()//نمایش تمام فونتها
    {
        $r=FontModel::all();
        return response([
            'data' => [
                'message' => $r,
            ],
        ]);
    }
    public function style_edit(Request $request,$id)
    {
        $valiDate = $this->validate($request, [
            'admin_id'=>'',
            'form_id' => 'min:0|max:7',
            'form_width' => 'min:0|max:7',
            'label_alignment' => '',
            'question_spacing' => 'min:0|max:7',
            'label_width' => 'min:0|max:7',
            'font_id' => 'min:0|max:7',
            'label_width' => 'min:0|max:7',
            'button_style'=>'min:0|max:300'
        ]);

        $input = array_filter($request->all(), 'strlen');
        $user= StyleModel::find($id);

        if ($user->admin_id == auth()->user()->id) {
//            $user->admin_id=auth()->user()->id;
//            $user->form_id = $valiDate['form_id'];
//            $user->form_width = $valiDate['form_width'];
//            $user->label_alignment = $valiDate['label_alignment'];
//            $user->question_spacing = $valiDate['question_spacing'];
//            $user->label_width = $valiDate['label_width'];
//            $user->font = $valiDate['font_id'];
//            $user->label_width = $valiDate['label_width'];
            HistoryModel::create([
                'name'=>"edit upload image" .$user->id,
                'admin_id'=>auth()->user()->id,
                'form_id' =>$user->form_id,
                'history'=>\Morilog\Jalali\Jalalian::now(),
            ]);
            $updateUser = $user->update($input);
            if ($updateUser) {
                return response([
                    'data' => [
                        'message' => ' style is update',
                        'date'=>$date = Jalalian::forge('today')->format('%Y-%m-%d')
                    ],
                    'status' => 'success',
                    'info' => $updateUser
                ]);
            }
        } else {
            return "Id not found";
        }
    }
    public function style_edit1(Request $request,$form_id)
    {
        $valiDate = $this->validate($request, [
            'admin_id'=>'',
            'form_id' => 'min:0|max:7',
            'form_width' => 'min:0|max:7',
            'label_alignment' => '',
            'question_spacing' => 'min:0|max:7',
            'label_width' => 'min:0|max:7',
            'font_id' => 'min:0|max:7',
            'label_width' => 'min:0|max:7',
            'button_style'=>'min:0|max:300'

        ]);
        $user1= StyleModel::where('form_id','=',$form_id)->pluck('id');
        //echo $user1;
        $user2=str_replace("[",'',$user1);
        $user3=str_replace("]",'',$user2);
        //echo $user3;
        $input = array_filter($request->all(), 'strlen');
        $user= StyleModel::find($user3);
        //echo $user;
        if ($user->admin_id == auth()->user()->id) {
            HistoryModel::create([
                'name'=>"edit upload image" .$user->id,
                'admin_id'=>auth()->user()->id,
                'form_id' =>$user->form_id,
                'history'=>\Morilog\Jalali\Jalalian::now(),
            ]);
//            $user->admin_id=auth()->user()->id;
//            $user->form_id = $valiDate['form_id'];
//            $user->form_width = $valiDate['form_width'];
//            $user->label_alignment = $valiDate['label_alignment'];
//            $user->question_spacing = $valiDate['question_spacing'];
//            $user->label_width = $valiDate['label_width'];
//            $user->font = $valiDate['font_id'];
//            $user->label_width = $valiDate['label_width'];
            $updateUser = $user->update($input);
            if ($updateUser) {
                return response([
                    'data' => [
                        'message' => ' color is update',
                        'date'=>$date = Jalalian::forge('today')->format('%Y-%m-%d')

                    ],
                    'status' => 'success',
                    'info' => $user
                ]);
            }
        } else {
            return "Id not found";
        }
    }

    public function style_delete($id)
    {
        $p=StyleModel::where('id',$id)->value('form_id');

        HistoryModel::create([
            'name'=>"edit upload image" .$id,
            'admin_id'=>auth()->user()->id,
            'form_id' =>$p,
            'history'=>\Morilog\Jalali\Jalalian::now(),
        ]);
        $t = StyleModel::where([['id', $id], ['admin_id', auth()->user()->id]])->delete();
        if ($t) {
            return response([

                'data' => 'delete with successfull',
                'date'=>$date = Jalalian::forge('today')->format('%Y-%m-%d')

            ]);
        } else {
            return "id not found";
        }
    }

//    public function style_form_id($id)
//    {
//       return StyleModel::where([['form_id', $id],['admin_id',auth()->user()->id]])->get();
//        //return response()->json($data);
//    }

    public function css(Request $request)
    {
        $valiDate = $this->validate($request, [
            'admin_id'=>'',
            'form_id' => 'min:0|max:7',
            'inject_custom_css' => 'min:0|max:300',

        ]);

        $y = CssModel::create([
            'admin_id'=>auth()->user()->id,
            'form_id' => $valiDate['form_id'],
            'inject_custom_css' => $valiDate['inject_custom_css'],

        ]);
        HistoryModel::create([
            'name'=>"edit upload image" .$y->id,
            'admin_id'=>auth()->user()->id,
            'form_id' => $valiDate['form_id'],
            'history'=>\Morilog\Jalali\Jalalian::now(),
        ]);
        return response([
            'data' => [
                'message' => 'css is registered',
                'date'=>$date = Jalalian::forge('today')->format('%Y-%m-%d')

            ],
            'status' => 'success',
            'ID' => $y->id
        ]);
    }

    public function css_edit(Request $request,$id)
    {
        $valiDate = $this->validate($request, [
            'admin_id'=>'',
            'form_id' => 'min:0|max:7',
            'inject_custom_css' => 'min:0|max:7',

        ]);
        $input = array_filter($request->all(), 'strlen');
        $user= CssModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->admin_id=auth()->user()->id;
//            $user->form_id = $valiDate['form_id'];
//            $user->inject_custom_css = $valiDate['inject_custom_css'];
            HistoryModel::create([
                'name'=>"edit upload image" .$user->id,
                'admin_id'=>auth()->user()->id,
                'form_id' => $user->form_id,
                'history'=>\Morilog\Jalali\Jalalian::now(),
            ]);
            $updateUser = $user->update($input);

            if ($updateUser) {
                return response([
                    'data' => [
                        'message' => ' css is register',
                        'date'=>$date = Jalalian::forge('today')->format('%Y-%m-%d')

                    ],
                    'status' => 'success',
                    'info' => $user
                ]);
            }
        } else {
            return "Id not found";
        }
    }
    public function css_edit1(Request $request,$form_id)
    {
        $valiDate = $this->validate($request, [
            'admin_id'=>'',
            'form_id' => 'min:0|max:7',
            'inject_custom_css' => 'min:0|max:7',
        ]);
        $input = array_filter($request->all(), 'strlen');
        $user1= CssModel::where('form_id','=',$form_id)->pluck('id');
        //echo $user1;
        $user2=str_replace("[",'',$user1);
        $user3=str_replace("]",'',$user2);
        // echo $user3;
        $user= CssModel::find($user3);
        //echo $user;

        if ($user->admin_id == auth()->user()->id) {
            $user->admin_id=auth()->user()->id;
            HistoryModel::create([
                'name'=>"edit upload image" .$user->id,
                'admin_id'=>auth()->user()->id,
                'form_id' => $user->form_id,
                'history'=>\Morilog\Jalali\Jalalian::now(),
            ]);
            $updateUser = $user->update($input);
            //$user->form_id = $valiDate['form_id'];
            //$user->inject_custom_css = $valiDate['inject_custom_css'];
            if ($updateUser) {
                return response([
                    'data' => [
                        'message' => ' color is register',
                        'date'=>$date = Jalalian::forge('today')->format('%Y-%m-%d')

                    ],
                    'status' => 'success',
                    'info' => $user
                ]);
            }
        } else {
            return "Id not found";
        }
    }
    public function css_delete($id)
    {
        $p=CssModel::where('id',$id)->value('form_id');
        HistoryModel::create([
            'name'=>"edit upload image" .$id,
            'admin_id'=>auth()->user()->id,
            'form_id' => $p,
            'history'=>\Morilog\Jalali\Jalalian::now(),
        ]);
        $t = CssModel::where([['id', $id], ['admin_id', auth()->user()->id]])->delete();
        if ($t) {
            return response([

                'data' => 'delete with successfull',
                'date'=>$date = Jalalian::forge('today')->format('%Y-%m-%d')

            ]);
        } else {
            return "id not found";
        }
    }

    public function css_show($id)
    {
        $ee= CssModel::where([['id',$id],['admin_id',auth()->user()->id]])->get();
        $r= implode(',',array($ee));
        $t=str_replace('[{',' ',$r);
        $e= str_replace('}]',' ',$t);
        $q= str_replace('\n',' ',$e);
        if (!empty($q)) {
            return response([

                'data' => [
                    'message' => $q,
                ],
                'status' => 'success',
            ]);
        } else {
            return "id not found";
        }
    }
    public function css_show1($form_id)
    {
        $ee= CssModel::where([['form_id',$form_id],['admin_id',auth()->user()->id]])->get();
        $r= implode(',',array($ee));
        $t=str_replace('[{',' ',$r);
        $e= str_replace('}]',' ',$t);
        $q= str_replace('\n',' ',$e);
        if (!empty($q)) {
            return response([

                'data' => [
                    'message' => $q,
                ],
                'status' => 'success',
            ]);
        } else {
            return "id not found";
        }
    }
//    public function css_form_id($id)
//    {
//        return CssModel::where([['form_id', $id],['admin_id',auth()->user()->id]])->get();
//        //return response()->json($data);
//    }
    public function thems(Request $request,Filesystem $filesystem)
    {

        $valiDate = $this->validate($request, [
            'admin_id'=>'',
            'form_id' => '',
            'thems' => '',
            'url_image'=>'mimes:jpeg,jpg,bmp,png|max:300'

        ]);
        $file=$request->file('url_image');

        $imagepath="/images";
        $filename=$file->getClientOriginalName();//نام فایل رو با این دستور میگیریم
        //return public_path("{$imagepath}/{$filename}");
        if($filesystem->exists(public_path("{$imagepath}/{$filename}")))
        {
            $filename="{$filename}";
        }
        //این شرطبالا رو قرار دادیم تا زمانی که از یک فایل تکراری بود قبلش بیاد یک زمان حال رو بهش بده تا خطا از بابت این که تکراری هست نده
        $file->move(public_path($imagepath) , $filename);

        $y = ThemsModel::create([
            'admin_id'=>'1',
            'form_id' =>'2',
            'thems' => $valiDate['thems'],
            'url_image'=>"{$imagepath}/{$filename}"

        ]);
        HistoryModel::create([
            'name'=>"edit upload image" .$y->id,
            'admin_id'=>auth()->user()->id,
            'form_id' => $y->form_id,
            'history'=>\Morilog\Jalali\Jalalian::now(),
        ]);
        return response([
            'data' => [
                'message' => 'thems is registered',
                'url_image'=>"{$imagepath}/{$filename}",
                'date'=>$date = Jalalian::forge('today')->format('%Y-%m-%d')

            ],
            'status' => 'success',
            'ID' => $y->id
        ]);
    }

    public function thems_edit(Request $request,$id)
    {
        $valiDate = $this->validate($request, [
            'admin_id'=>'',
            'form_id' => '',
            'thems' => '',
            'url_image'=>''


        ]);
        $input = array_filter($request->all(), 'strlen');
        $user= ThemsModel::find($id);

        if ($user->admin_id == auth()->user()->id) {
            $user->admin_id=auth()->user()->id;
//            $user->form_id = $valiDate['form_id'];
//            $user->thems = $valiDate['thems'];
            HistoryModel::create([
                'name'=>"edit thems" .$user->id,
                'admin_id'=>auth()->user()->id,
                'form_id' => $user->form_id,
                'history'=>\Morilog\Jalali\Jalalian::now(),
            ]);
            $updateUser = $user->update($input);

            if ($updateUser) {
                return response([
                    'data' => [
                        'message' => ' thems is register',
                        'date'=>$date = Jalalian::forge('today')->format('%Y-%m-%d')


                    ],
                    'status' => 'success',
                    'info' => $user
                ]);
            }
        } else {
            return "Id not found";
        }
    }
    public function thems_edit1(Request $request,$form_id)
    {
        $valiDate = $this->validate($request, [
            'admin_id'=>'',
            'form_id' => 'min:0|max:7',
            'thems' => '',
            'url_image'=>''
        ]);
        $input = array_filter($request->all(), 'strlen');

        $user1= ThemsModel::where('form_id','=',$form_id)->pluck('id');
        //echo $user1;
        $user2=str_replace("[",'',$user1);
        $user3=str_replace("]",'',$user2);
        // echo $user3;
        $user= ThemsModel::find($user3);
        //echo $user;

        if ($user->admin_id == auth()->user()->id) {
            $user->admin_id=auth()->user()->id;
            HistoryModel::create([
                'name'=>"edit thems" .$user->id,
                'admin_id'=>auth()->user()->id,
                'form_id' => $user->form_id,
                'history'=>\Morilog\Jalali\Jalalian::now(),
            ]);
            $updateUser = $user->update($input);
//
//            $user->form_id = $valiDate['form_id'];
//            $user->thems = $valiDate['thems'];
            if ($updateUser) {
                return response([
                    'data' => [
                        'message' => ' them is register',
                        'date'=>$date = Jalalian::forge('today')->format('%Y-%m-%d')

                    ],
                    'status' => 'success',
                    'info' => $user
                ]);
            }
        } else {
            return "Id not found";
        }
    }
    public function thems_delete($id)
    {
        $p=ThemsModel::where('id',$id)->value('form_id');
        HistoryModel::create([
            'name'=>"edit thems" .$id,
            'admin_id'=>auth()->user()->id,
            'form_id' => $p,
            'history'=>\Morilog\Jalali\Jalalian::now(),
        ]);
        $t = ThemsModel::where([['id', $id], ['admin_id', auth()->user()->id]])->delete();
        if ($t) {
            return response([

                'data' => 'delete with successfull',
                'date'=>$date = Jalalian::forge('today')->format('%Y-%m-%d')

            ]);
        } else {
            return "id not found";
        }
    }

    public function thems_show()
    {
        $ee= ThemsModel::get(['id','form_id','thems','url_image']);
        $r= implode(',',array($ee));
        $t=str_replace('[{',' ',$r);
        $e= str_replace('}]',' ',$t);
        $q= str_replace('\n',' ',$e);
//        return $q;
        if ($q) {
            return response([

                'data' =>[
                    'message'=>$q
                ]
            ]);
        } else {
            return "id not found";
        }
    }
    public function thems_show1($thems)
    {
        $ee= ThemsModel::where('thems',$thems)->get(['id','url_image']);
        $r= implode(',',array($ee));
        $t=str_replace('[{',' ',$r);
        $e= str_replace('}]',' ',$t);
        $q= str_replace('\n',' ',$e);
//        return $q;
        if ($q) {
            return response([

                'data' =>[
                    'message'=>$q
                ]
            ]);
        } else {
            return "id not found";
        }
    }
//    public function thems_form_id($id)
//    {
//        return ThemsModel::where([['form_id', $id],['admin_id',auth()->user()->id]])->get();
//        //return response()->json($data);
//    }
    public function select2()
    {
       $t=ThemsModel::groupby('thems')->pluck('thems');
        if ($t) {
            return response([

                'data' =>[
                    'message'=>$t,
                    'date'=>$date = Jalalian::forge('today')->format('%Y-%m-%d')

                ]
            ]);
        } else {
            return "id not found";
        }
    }
    public function select_thems($form_id,$id)
    {
        Select_themsModel::create([
            'admin_id'=>auth()->user()->id,
            'form_id' =>$form_id,
            'id_thems' =>$id,

        ]);
        return response([
            'data' => [
                'message' => 'تم انتخاب شد',
                'date'=>$date = Jalalian::forge('today')->format('%Y-%m-%d')

            ],
            'status' => 'success',

        ]);
    }
    public function select_thems_edit(Request $request,$form_id)
    {
        $valiDate = $this->validate($request, [
            'admin_id'=>"",
            'form_id' =>"",
            'id_thems' =>"required",
            ]);
        $id=Select_themsModel::where('form_id',$form_id)->value('id');
        $user=Select_themsModel::find($id);
        $user->admin_id=auth()->user()->id;
        $user->form_id=$form_id;
        $user->id_thems=$valiDate['id_thems'];
        HistoryModel::create([
            'name'=>"edit thems" .$user->id,
            'admin_id'=>auth()->user()->id,
            'form_id' => $user->form_id,
            'history'=>\Morilog\Jalali\Jalalian::now(),
        ]);
        if ($user->update()) {
            return response([
                'data' => [
                    'message' => ' تم آپدیت شد',
                    'date'=>$date = Jalalian::forge('today')->format('%Y-%m-%d')

                ],
                'status' => 'success',
                'info' => $user
            ]);

        } else {
            return "Id not found";
        }
    }

    public function select_thems_delete($id)//پاک کردن با id
    {
        $p=Select_themsModel::where('id',$id)->value('form_id');
        HistoryModel::create([
            'name'=>"edit thems" .$id,
            'admin_id'=>auth()->user()->id,
            'form_id' => $p,
            'history'=>\Morilog\Jalali\Jalalian::now(),
        ]);
        $t=Select_themsModel::where('id',$id)->delete();
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
    public function select_thems_delete1($form_id)// کردن با form_id
    {
        $p=Select_themsModel::where('form_id',$form_id)->value('id');
        HistoryModel::create([
            'name'=>"edit thems" .$p,
            'admin_id'=>auth()->user()->id,
            'form_id' => $form_id,
            'history'=>\Morilog\Jalali\Jalalian::now(),
        ]);
        $t=Select_themsModel::where('form_id',$form_id)->delete();
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
    public function show_select_thems($form_id)
    {
        $t=Select_themsModel::where('form_id',$form_id)->value('id_thems');
        if(!empty($t)){
            $q=ThemsModel::where('id',$t)->value('url_image');
            return response([
                'data' => [
                    'message' => $q,
                    'date'=>$date = Jalalian::forge('today')->format('%Y-%m-%d')
                ],
                'status' => 'success',
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
