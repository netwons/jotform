<?php

namespace App\Http\Controllers\Api\v1;

use App\Form_TollsModel;

use App\LangsModel;
use App\ToolsModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Support\Facades\Lang;

class Form_ToolsController extends Controller
{
    public function form_tools(Request $request,$form_id)
    {
        $valiDate=$this->validate($request,[
           // '_index'=>'required'
            'tool_id'=>''
            ]);
        auth()->user()->form_toolss()->create([
           // '_index'=>$valiDate['_index'],
            //'tool_id'=>$this->t(auth()->user()->id),
            'tool_id'=>$valiDate['tool_id'],
            'tool_name'=>ToolsModel::where('id',$valiDate['tool_id'])->value('name_en'),
            'form_id'=>$form_id,
        ]);
        return response([
            'data'=>[
                'message'=>'المان ساخته شد',
            ] ,
            'status'=>'success',
        ]);
    }

    public function form_tools1(Request $request,$form_id,$fa)
    {
        $q=LangsModel::where('name',$fa)->take(1)->pluck('title');
        $valiDate=$this->validate($request,[
            //'_index'=>'required'
            'tool_id'=>''
        ]);
        auth()->user()->form_toolss()->create([
            //'_index'=>$valiDate['_index'],
            'tool_id'=>$valiDate['tool_id'],
            'form_id'=>$form_id,
        ]);
        return response([
            'data'=>[
                'message'=>'المان ثبت شد',
//                'زبان'=>$q
            ] ,
            'status'=>'با موفقیت',
        ]);
    }

    public function showall()
    {
        return Form_TollsModel::where('admin_id',auth()->user()->id)->orderBy('id','desc')->paginate(4);
    }

    public function show(Request $request,$id)
    {
        $d=ToolsModel:: where('cat_id',$id)->orderBy('id','desc')->pluck('name_en');
        $r= implode(', ',array($d));
        $t=str_replace('[',' ',$r);
        $e= str_replace(']',' ',$t);
        return $e;
    }

    public function showformtools($id,$name='name_en')
    {
        $d=Form_TollsModel:: where('form_id','=',$id)->take(50)->pluck('tool_id');
        foreach ($d as $key=>$j) {
            $q = ToolsModel::where('id', '=',$d[$key])->take(50)->pluck($name);
            $r = implode(', ', array($q));
            $t = str_replace('[', ' ', $r);
            $ee = str_replace(']', ' ', $t);
            echo $ee;
       }
    }

    public function t($id)
    {
        $cc = ToolsModel::where('admin_id', $id)->orderBy('id','DESC')->take(50)->pluck('id');
        $r= implode(', ',array($cc));
        $t=str_replace('[',' ',$r);
        $e= str_replace(']',' ',$t);
        return $e;
    }

    public function cat_id1(Request $request,$id,$name='name_en')
    {
        $e=ToolsModel::where('cat_id',$id)->take(100)->pluck($name);
        return $e;
    }

    public function det($id)
    {
        $t=Form_TollsModel::where([['id',$id],['admin_id',auth()->user()->id]])->delete();
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
        $t=Form_TollsModel::where([['id',$id],['admin_id',auth()->user()->id]])->delete();
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
