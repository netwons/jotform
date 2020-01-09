<?php

namespace App\Http\Controllers\Api\v1;

use App\Tools_CategoriesModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Lang;

class Tools_CategoriesController extends Controller
{
    public function tools_categories(Request $request,$name_en,$name_fa)
    {
        $valiDate=$this->validate($request,[
          // 'name_en'=>'required',
          // 'name_fa'=>'required'
        ]);
        auth()->user()->tools_categorie()->create([
            'name_en'=>$name_en,
            'name_fa'=>$name_fa,
        ]);
        return response([
            'data'=>[
                'message'=>'form is registered',
            ] ,
            'status'=>'success',
        ]);
   }

    public function tools_categories1(Request $request,$name_en,$name_fa,$fa)
    {
        $q=LangsModel::where('name',$fa)->take(1)->pluck('title');
        $valiDate=$this->validate($request,[
           // 'name_en'=>'required',
           // 'name_fa'=>'required'
        ]);
        auth()->user()->tools_categorie()->create([
            'name_en'=>$name_en,
            'name_fa'=>$name_fa,
        ]);
        return response([
            'data'=>[
                'message'=>'فرم ثبت شد',
                'زبان'=>$q
            ] ,
            'status'=>'با موفقیت',
        ]);
    }

    public function show($id,$name='name_en')
    {
            $q = Tools_CategoriesModel::where('id', '=',$id)->take(50)->pluck($name);
            $r = implode(', ', array($q));
            $t = str_replace('[', ' ', $r);
            $ee = str_replace(']', ' ', $t);
            echo $ee;

    }

    public function delete($id)
    {
        $t= Tools_CategoriesModel::find($id)->delete();
        return response([
            'data'=>$t,
            'status'=>'delete user successfull'
        ]);
    }

    public function delete1($id,$fa)
    {
        $q=LangsModel::where('name',$fa)->take(1)->pluck('title');
        $t= Tools_CategoriesModel::find($id)->delete();
        return response([
            'data'=>$t,
            'status'=>'یوزر پاک شد',
            'زبان'=>$q
        ]);
    }
}
