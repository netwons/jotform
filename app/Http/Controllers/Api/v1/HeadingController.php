<?php

namespace App\Http\Controllers\Api\v1;

use App\HeadingimageModel;
use App\HeadingModel;
use App\Http\Requests\headingRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Filesystem\Filesystem;
use Carbon\Carbon;
class HeadingController extends Controller
{
    public function heading_create1(Request $request)//اصلی این هست نه dingپایینی
    {
        $valiDate = $this->validate($request, [
            'admin_id'=>'',
            'form_id' => 'min:0|max:7',
            //'head_image' => 'mimes:jpeg,jpg,bmp,png|max:300',//330کیلو بایت  هست
            'heading_text' => '',
            'sub_heading_text' => 'min:0|max:7',
            'heading_size' => 'min:0|max:7|in:Default,Large,Small',
            'text_alignment' => 'min:0|max:6|in:Left,Center,Right',
            'hide_field' => 'min:0|in:0,1',
        ]);
        $y = HeadingModel::create([
            'admin_id'=>auth()->user()->id,
            'form_id' => $valiDate['form_id'],
            //'head_image' => $valiDate['form_width'],
            'heading_text' => $valiDate['heading_text'],
            'sub_heading_text' => $valiDate['sub_heading_text'],
            'heading_size' => $valiDate['heading_size'],
            'text_alignment' => $valiDate['text_alignment'],
            'hide_field' => $valiDate['hide_field'],
        ]);
        return response([
            'data' => [
                'message' => 'heading is registered',
            ],
            'status' => 'success',
            'ID' => $y->id
        ]);
    }
    public function heading_show1($id)
    {
        $r=HeadingModel::where([['id', $id], ['admin_id', auth()->user()->id]])->get();
        return response()->json([
            'data'=>$r,
            'status'=>'success'
        ]);
    }
    public function heading_show2($form_id)
    {
        $rr=HeadingModel::where([['form_id', $form_id], ['admin_id', auth()->user()->id]])->get();
        return response()->json([
            'data'=>[
                'message'=>$rr,
            ],
            'status'=>'success'
        ]);
    }
    public function heading_edit1(Request $request,$id)
    {
        $valiDate = $this->validate($request, [
            'admin_id'=>'',
            'form_id' => 'min:0|max:7',
            //'head_image' => 'mimes:jpeg,jpg,bmp,png|max:300',//330کیلو بایت  هست
            'heading_text' => '',
            'sub_heading_text' => 'min:0|max:7',
            'heading_size' => 'min:0|max:7|in:Default,Large,Small',
            'text_alignment' => 'min:0|max:6|in:Left,Center,Right',
            'hide_field' => 'min:0|in:0,1',
        ]);
        $input = array_filter($request->all(), 'strlen');
        $user= HeadingModel::findOrFail($id);
        if ($user->admin_id == auth()->user()->id) {
            $updateUser = $user->update($input);
            if ($updateUser) {
                return response([
                    'data' => [
                        'message' => ' Heading is update',
                    ],
                    'status' => 'success',
                    'info' => $updateUser
                ]);
            }
        } else {
            return "Id not found";
        }
    }
    public function heading_delete1($id)
    {
        $t=HeadingModel::where([['id', $id], ['admin_id', auth()->user()->id]])->delete();
        if ($t) {
            return response([
                'data' => [
                    'message'=>'پاک شد'
                ],
                'status'=>'success'
            ]);
        } else {
            return "این id وجود ندارد";
        }
    }
    public function heading_image(Request $request,Filesystem $filesystem)//upload image
    {
        $valiDate = $this->validate($request, [
            'admin_id'=>'',
            'form_id' => 'min:0|max:7',
            'head_image' => 'mimes:jpeg,jpg,bmp,png|max:300',//330کیلو بایت  هست
            'heading_id'=>'required|exists:heading,id|message'
        ]);
        $file=$request->file('head_image');
        $year=Carbon::now()->year;
        $month=Carbon::now()->month;
        $day=Carbon::now()->day;
        $imagepath="/images1/{$year}-{$month}-{$day}";
        $filename=$file->getClientOriginalName();//نام فایل رو با این دستور میگیریم
        //return public_path("{$imagepath}/{$filename}");
        if($filesystem->exists(public_path("{$imagepath}/{$filename}")))
        {
            $filename=Carbon::now()->timestamp . "-{$filename}";
        }
        //این شرطبالا رو قرار دادیم تا زمانی که از یک فایل تکراری بود قبلش بیاد یک زمان حال رو بهش بده تا خطا از بابت این که تکراری هست نده
        $file->move(public_path($imagepath) , $filename);
        $y = HeadingimageModel::create([
            'admin_id'=>auth()->user()->id,
            'form_id' => $valiDate['form_id'],
            'head_image' => public_path("{$imagepath}/{$filename}"),
            'heading_id' =>$valiDate['heading_id'],
        ]);
        return response([
            'data' => [
                'message' => 'heading image is registered',
                'image_url'=>url("{$imagepath}/{$filename}"),
            ],
            'status' => 'success',
            'ID' => $y->id
        ]);
    }
    public function heading_image_edit(Request $request,$id,Filesystem $filesystem)
    {
        $valiDate = $this->validate($request, [
            'admin_id' => '',
            'form_id' => 'min:0|max:7',
            'head_image' => 'mimes:jpeg,jpg,bmp,png|max:300',//330کیلو بایت  هست
            'heading_id' => 'required|exists:heading,id'
        ]);
        $input = array_filter($request->all(), 'strlen');
        $file=$request->file('head_image');
        $year=Carbon::now()->year;
        $month=Carbon::now()->month;
        $day=Carbon::now()->day;
        $imagepath="/upload/images/{$year}-{$month}-{$day}";
        $filename=$file->getClientOriginalName();//نام فایل رو با این دستور میگیریم
        $imagepath11=$imagepath+'/'+$filename;
        //return public_path("{$imagepath}/{$filename}");
        if($filesystem->exists(public_path("{$imagepath}/{$filename}")))
        {
            $filename=Carbon::now()->timestamp . "-{$filename}";
        }
        $file->move(public_path($imagepath) , $filename);
        $user = HeadingimageModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->form_id =  $valiDate['form_id'];
            $user->head_image = $valiDate['head_image'];
            $user->heading_id =  $valiDate['heading_id'];
            if ($user->update($input)) {
                return response([
                    'data' => [
                        'message' => ' heading is update',
                        'info' =>url("{$imagepath}/{$filename}")
                    ],
                    'status' => 'success',

                ]);
            }else{
                return "Id not found";
            }
        }
    }


    public function heading_image_delete($id)
    {
        $t = HeadingimageModel::where([['id', $id], ['admin_id', auth()->user()->id]])->delete();
        if ($t) {
            return response([
                'data' => [
                    'message'=>'پاک شد'
                ],
                'status'=>'success'

            ]);
        } else {
            return response([
                'data'=>"id not found"
            ]);
        }
    }
    public function heading_image_show1($id,Filesystem $filesystem)
    {
        $r=HeadingimageModel::where([['id', $id], ['admin_id', auth()->user()->id]])->get();
        return response()->json([
            'data'=>$r,
            'status'=>'success'
        ]);
    }
    public function heading_image_show2($form_id)
    {
        $rr=HeadingimageModel::where([['form_id', $form_id], ['admin_id', auth()->user()->id]])->get();
        return response()->json([
            'data'=>[
                'message'=>$rr,
            ],
            'status'=>'success'
        ]);
    }

}
