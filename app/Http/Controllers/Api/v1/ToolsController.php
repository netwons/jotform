<?php

namespace App\Http\Controllers\Api\v1;

use App\AttributesModel;
use App\LangsModel;
use App\SubmissionsModel;
use App\ToolsModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Lang;

class ToolsController extends Controller
{
    public function tools(Request $request)
    {
        $valiDate = $this->validate($request, [
            'name_en' => 'required|string',
            'name_fa'=>'required|string',
            'cat_id'=>'required|numeric',
            'submission'=>'required|numeric'
        ]);

        auth()->user()->tools()-> create([
            'name_en'=>$valiDate['name_en'],
            'name_fa'=>$valiDate['name_fa'],
            'cat_id'=>$valiDate['cat_id'],
            'submission'=>$valiDate['submission'],


        ]);
        return response([
            'data'=>[
                'message'=>'form is registered',
            ] ,
            'status'=>'success',

        ]);
    }

    public function tools1(Request $request,$fa)
    {
        $q=LangsModel::where('name',$fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
            'name_en' => 'required|string',
            'name_fa'=>'required|string',
            'cat_id'=>'required|numeric',
            'submission'=>'required|numeric'
        ]);
        auth()->user()->tools()-> create([
            'name_en'=>$valiDate['name_en'],
            'name_fa'=>$valiDate['name_fa'],
            'cat_id'=>$valiDate['cat_id'],
            'submission'=>$valiDate['submission'],

        ]);
        return response([
            'داده'=>[
                'پیام'=>'فرم ثبت شد',
                'زبان'=>$q
            ] ,
            'وضعیت'=>'با موفقیت',
        ]);
    }

    public function delete($id)
    {
        $t= ToolsModel::find($id)->delete();
        return response([
            'data'=>$t,
            'status'=>'delete user successfull'
        ]);
    }

    public function delete1($id,$fa)
    {
        $q=LangsModel::where('name',$fa)->take(1)->pluck('title');
        $t= ToolsModel::find($id)->delete();
        return response([
            'data'=>$t,
            'status'=>'یوزر پاک شد',
            'زبان'=>$q
        ]);
    }

    public function r($id)
    {
        $rr=SubmissionsModel::where('admin_id',$id)->take(50)->pluck('id');
        return $rr;
    }

    public function h($id)
    {
        $hh=AttributesModel::where('admin_id',$id)->take(50)->pluck('id');
        return $hh;
    }

    public function show()
    {
        return ToolsModel::where('admin_id',auth()->user()->id)->orderby('id','desc')->paginate(4);
    }

    public function show_all()
    {
        return ToolsModel::where('cat_id',1)->orderby('id','asc')->get(['id','name_en','name_fa']);
    }
    public function show_name($name)
    {
        return ToolsModel::where('name_en',$name)->get(['id']);
    }
    public function show_id1($id)
    {
        return ToolsModel::where('id',$id)->get(['name_en']);
    }

    public function show_id($id)
    {
        return ToolsModel::where('cat_id',$id)->orderby('id','desc')->get();
    }


}
