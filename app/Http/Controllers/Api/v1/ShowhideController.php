<?php

namespace App\Http\Controllers\Api\v1;

use App\Change1Model;
use App\Changeemail1Model;
use App\ChangeemailModel;
use App\ChangeModel;
use App\Enable1Model;
use App\EnableModel;
use App\General_answerModel;
use App\HistoryModel;
use App\ShowhideAnswerModel;
use App\ShowhideModel;
use App\SkipModel;
use App\ToolsModel;
use App\Update1Model;
use App\UpdateModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Morilog\Jalali\Jalalian;

class ShowhideController extends Controller
{
    //----------------------------------------start setting showhide---------------------------------------------
    public function setting_showhide()
    {
        $d = ShowhideModel::where('id', '1')->orderby('id', 'desc')->take(1)
            ->get(['if_i','state','target','value','do_i','field'])->toArray();
        $r = implode(', ', array_values($d[0]));
        $t = str_replace('[', ' ', $r);
        $e = str_replace(']', ' ', $t);
        $arr = explode(",", $e);
        $j = 0;
        //print_r($arr);
        echo "<br>";
        //print_r($arr[7]);
        foreach ($arr as $key) {
            echo $key . '<br>';
            $j++;
        }
    }
    public function type_name($form_id)
    {
        $ee=General_answerModel::where('form_id',$form_id)->orderby('id', 'desc')->take(500)->pluck('type_name');
        $p=count($ee);

        $i=0;
        while($i<$p) {
            $w = ToolsModel::where('id', $ee[$i])->orderby('id', 'desc')->take(500)->get(['name_en'])->toArray();
            // echo $w;
            $r = implode(',', array_values($w[0]));
            $t = str_replace('[', ' ', $r);
            $e = str_replace(']', ' ', $t);
            $arr = explode(",", $r);
            $j = 0;
            //print_r($arr);
            echo "<br>";
            // print_r($arr[7]);
            foreach ($arr as $key) {
                echo $key;
                $j++;
            }
            $i++;
        }
    }
    public function setting_show_hide_create(Request $request)
    {
        $valiDate = $this->validate($request, [
            'if_i' => 'required',
            'state' => 'required',
            'value' => '',
            'target' => '',
            'do_i' => 'required',
            'field' => 'required',
            'form_id' => 'exists:forms,id',
        ]);
        $y = auth()->user()->showhide()->create([
            'if_i' => $valiDate['if_i'],
            'state' => $valiDate['state'],
            'value' => $valiDate['value'],
            'target' => $valiDate['target'],
            'do_i' => $valiDate['do_i'],
            'field' => ucfirst( $valiDate['field']),
            'form_id' => $valiDate['form_id'],
        ]);
        HistoryModel::create([
            'name'=>"create if".auth()->user()->id,
            'admin_id'=>auth()->user()->id,
            'form_id' =>$valiDate['form_id'] ,
            'history'=>\Morilog\Jalali\Jalalian::now(),
        ]);

        return response([
            'data' => [
                'message' => 'شرط به درستی ثبت شد',
                'date'=> Jalalian::forge('today')->format('%Y-%m-%d')

            ],
            'status' => 'success',
            'ID' => $y->id
        ]);
    }
    public function setting_show_hide_edit(Request $request,$id)
    {
        $valiDate = $this->validate($request, [
            'if_i' => '',
            'state' => '',
            'value' => '',
            'target' => '',
            'do_i' => '',
            'field' => '',
        ]);
        $user = ShowhideAnswerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->if_i = $valiDate['if_i'];
            $user->state = $valiDate['state'];
            $user->value = $valiDate['value'];
            $user->target = $valiDate['target'];
            $user->do_i = $valiDate['do_i'];
            $user->field = ucfirst($valiDate['field']);
            if ($user->update()) {
                HistoryModel::create([
                    'name'=>"edit if".$user->admin_id,
                    'admin_id'=>auth()->user()->id,
                    'form_id' =>$user->form_id ,
                    'history'=>\Morilog\Jalali\Jalalian::now(),
                ]);
                return response([
                    'data' => [
                        'message' => 'شرط به درستی آپدیت شد',
                        'date'=> Jalalian::forge('today')->format('%Y-%m-%d')

                    ],
                    'status' => 'success',
                    'info' => $user,

                ]);
            }
        } else {
            return "معتبر نیست";
        }
    }
    public function setting_show_hide_show($form_id)
    {
        $ee= ShowhideAnswerModel::where([['admin_id',auth()->user()->id],['form_id',$form_id]])->orderby('id','desc')->paginate(5);
        if($ee){
            return response([
               'data'=>[
                   'message'=>$ee,
                   'date'=> Jalalian::forge('today')->format('%Y-%m-%d')
               ]
            ]);
        }else{
            return response([
                'data'=>[
                    'message'=>"وجود ندارد",
                ]
            ]);
        }
    }

    public function setting_show_hide_delete($id)
    {
        $p=ShowhideAnswerModel::where('id',$id)->value('form_id');
        HistoryModel::create([
            'name'=>"create form".$id,
            'admin_id'=>auth()->user()->id,
            'form_id' =>$p ,
            'history'=>\Morilog\Jalali\Jalalian::now(),
        ]);
        $t = ShowhideAnswerModel::where([['id', $id], ['admin_id', auth()->user()->id]])->delete();
        if ($t) {
            return response([

                'data' => 'delete with successfull',
                'date'=> Jalalian::forge('today')->format('%Y-%m-%d')

            ]);
        } else {
            return "id not found";
        }
    }
    //----------------------------------------End setting showhide---------------------------------------------
    //----------------------------------------start setting update---------------------------------------------
    public function setting_update_show()
    {
        $d = Update1Model::where('id', '1')->orderby('id', 'desc')->take(1)
            ->get(['if_i','state','value','target','do_i','from','to'])->toArray();
        $r = implode(', ', array_values($d[0]));
        $t = str_replace('[', ' ', $r);
        $e = str_replace(']', ' ', $t);
        $arr = explode(",", $e);
        $j = 0;
        //print_r($arr);
        echo "<br>";
        //print_r($arr[7]);
        foreach ($arr as $key) {
            echo $key . '<br>';
            $j++;
        }
    }
    public function setting_update_create(Request $request)
    {

        $valiDate = $this->validate($request, [
            'if_i' => 'required',
            'state' => 'required',
            'value' => 'required',
            'target' => 'required',
            'do_i' => 'required',
            'from' => 'required',
            'to'=>'required',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->update1()->create([
            'if_i' => $valiDate['if_i'],
            'state' => $valiDate['state'],
            'value' => $valiDate['value'],
            'target' => $valiDate['target'],
            'do_i' => $valiDate['do_i'],
            'from' => $valiDate['from'],
            'to' => $valiDate['to'],
            'form_id' => $valiDate['form_id']
        ]);
        return response([
            'data' => [
                'message' => 'form is registered',
            ],
            'status' => 'success',
            'ID' => $y->id
        ]);
    }
    public function setting_update_edit(Request $request,$id)
    {
        $valiDate = $this->validate($request, [
            'if_i' => '',
            'state' => '',
            'value' => '',
            'target' => '',
            'do_i' => '',
            'from' => '',
            'to'=>'',
        ]);
        $user = UpdateModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->if_i = $valiDate['if_i'];
            $user->state = $valiDate['state'];
            $user->value = $valiDate['value'];
            $user->target = $valiDate['target'];
            $user->do_i = $valiDate['do_i'];
            $user->from = $valiDate['from'];
            $user->to = $valiDate['to'];

            if ($user->update()) {
                return response([
                    'data' => [
                        'message' => ' form is register',
                    ],
                    'status' => 'success',
                    'info' => $user,

                ]);
            }
        } else {
            return "Id not found";
        }
    }
    public function setting_update1_show($form_id)
    {
        $ee= UpdateModel::where([['admin_id',auth()->user()->id],['form_id',$form_id]])->orderby('id','desc')->paginate(5);
        return $ee;
    }

    public function setting_update_delete($id)
    {
        $t = UpdateModel::where([['id', $id], ['admin_id', auth()->user()->id]])->delete();
        if ($t) {
            return response([

                'data' => 'delete with successfull'
            ]);
        } else {
            return "id not found";
        }
    }

    //----------------------------------------End setting update---------------------------------------------
    //----------------------------------------start setting Enable---------------------------------------------
    public function setting_enable_show()
    {
        $d = Enable1Model::where('id', '1')->orderby('id', 'desc')->take(1)
            ->get(['if_i','state','value','target','do_i','field'])->toArray();
        $r = implode(', ', array_values($d[0]));
        $t = str_replace('[', ' ', $r);
        $e = str_replace(']', ' ', $t);
        $arr = explode(",", $e);
        $j = 0;
        //print_r($arr);
        echo "<br>";
        //print_r($arr[7]);
        foreach ($arr as $key) {
            echo $key . '<br>';
            $j++;
        }
    }
    public function setting_enable_create(Request $request)
    {

        $valiDate = $this->validate($request, [
            'if_i' => 'required',
            'state' => 'required',
            'value' => 'required',
            'target' => 'required',
            'do_i' => 'required',
            'field' => 'required',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->enable1()->create([
            'if_i' => $valiDate['if_i'],
            'state' => $valiDate['state'],
            'value' => $valiDate['value'],
            'target' => $valiDate['target'],
            'do_i' => $valiDate['do_i'],
            'field' => $valiDate['field'],
            'form_id' => $valiDate['form_id']
        ]);
        return response([
            'data' => [
                'message' => 'form is registered',
            ],
            'status' => 'success',
            'ID' => $y->id
        ]);
    }
    public function setting_enable_edit(Request $request,$id)
    {
        $valiDate = $this->validate($request, [
            'if_i' => '',
            'state' => '',
            'value' => '',
            'target' => '',
            'do_i' => '',
            'field' => '',

        ]);
        $user = EnableModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->if_i = $valiDate['if_i'];
            $user->state = $valiDate['state'];
            $user->value = $valiDate['value'];
            $user->target = $valiDate['target'];
            $user->do_i = $valiDate['do_i'];
            $user->field = $valiDate['field'];

            if ($user->update()) {
                return response([
                    'data' => [
                        'message' => ' form is register',
                    ],
                    'status' => 'success',
                    'info' => $user,

                ]);
            }
        } else {
            return "Id not found";
        }
    }
    public function setting_enable1_show($form_id)
    {
        $ee= EnableModel::where([['admin_id',auth()->user()->id],['form_id',$form_id]])->orderby('id','desc')->paginate(5);
        return $ee;
    }

    public function setting_enable_delete($id)
    {
        $t = EnableModel::where([['id', $id], ['admin_id', auth()->user()->id]])->delete();
        if ($t) {
            return response([

                'data' => 'delete with successfull'
            ]);
        } else {
            return "id not found";
        }
    }
    //----------------------------------------End setting Enable---------------------------------------------
    //----------------------------------------start setting skip---------------------------------------------
    public function setting_skip_show()
    {
        $d = Enable1Model::where('id', '1')->orderby('id', 'desc')->take(1)
            ->get(['if_i','state','value','target','do_i','field'])->toArray();
        $r = implode(', ', array_values($d[0]));
        $t = str_replace('[', ' ', $r);
        $e = str_replace(']', ' ', $t);
        $arr = explode(",", $e);
        $j = 0;
        //print_r($arr);
        echo "<br>";
        //print_r($arr[7]);
        foreach ($arr as $key) {
            echo $key . '<br>';
            $j++;
        }
    }
    public function setting_skip_create(Request $request)
    {

        $valiDate = $this->validate($request, [
            'if_i' => 'required',
            'state' => 'required',
            'value' => 'required',
            'target' => 'required',
            'do_i' => 'required',
            'field' => 'required',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->skip1()->create([
            'if_i' => $valiDate['if_i'],
            'state' => $valiDate['state'],
            'value' => $valiDate['value'],
            'target' => $valiDate['target'],
            'do_i' => $valiDate['do_i'],
            'field' => $valiDate['field'],
            'form_id' => $valiDate['form_id']
        ]);
        return response([
            'data' => [
                'message' => 'form is registered',
            ],
            'status' => 'success',
            'ID' => $y->id
        ]);
    }
    public function setting_skip_edit(Request $request,$id)
    {
        $valiDate = $this->validate($request, [
            'if_i' => '',
            'state' => '',
            'value' => '',
            'target' => '',
            'do_i' => '',
            'field' => '',

        ]);
        $user = SkipModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->if_i = $valiDate['if_i'];
            $user->state = $valiDate['state'];
            $user->value = $valiDate['value'];
            $user->target = $valiDate['target'];
            $user->do_i = $valiDate['do_i'];
            $user->field = $valiDate['field'];

            if ($user->update()) {
                return response([
                    'data' => [
                        'message' => ' form is register',
                    ],
                    'status' => 'success',
                    'info' => $user,

                ]);
            }
        } else {
            return "Id not found";
        }
    }
    public function setting_skip1_show($form_id)
    {
        $ee= SkipModel::where([['admin_id',auth()->user()->id],['form_id',$form_id]])->orderby('id','desc')->paginate(5);
        return $ee;
    }

    public function setting_skip_delete($id)
    {
        $t = SkipModel::where([['id', $id], ['admin_id', auth()->user()->id]])->delete();
        if ($t) {
            return response([

                'data' => 'delete with successfull'
            ]);
        } else {
            return "id not found";
        }
    }
    //----------------------------------------End setting Enable---------------------------------------------
    //----------------------------------------start setting change---------------------------------------------
    public function setting_change_show()
    {
        $d = Change1Model::where('id', '1')->orderby('id', 'desc')->take(1)
            ->get(['if_i','state','value','target','do_i','url'])->toArray();
        $r = implode(', ', array_values($d[0]));
        $t = str_replace('[', ' ', $r);
        $e = str_replace(']', ' ', $t);
        $arr = explode(",", $e);
        $j = 0;
        //print_r($arr);
        echo "<br>";
        //print_r($arr[7]);
        foreach ($arr as $key) {
            echo $key . '<br>';
            $j++;
        }
    }
    public function setting_change_create(Request $request)
    {

        $valiDate = $this->validate($request, [
            'if_i' => 'required',
            'state' => 'required',
            'value' => 'required',
            'target' => 'required',
            'do_i' => 'required',
            'url' => 'required',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->change1()->create([
            'if_i' => $valiDate['if_i'],
            'state' => $valiDate['state'],
            'value' => $valiDate['value'],
            'target' => $valiDate['target'],
            'do_i' => $valiDate['do_i'],
            'url' => $valiDate['url'],
            'form_id' => $valiDate['form_id']
        ]);
        return response([
            'data' => [
                'message' => 'form is registered',
            ],
            'status' => 'success',
            'ID' => $y->id
        ]);
    }
    public function setting_change_edit(Request $request,$id)
    {
        $valiDate = $this->validate($request, [
            'if_i' => '',
            'state' => '',
            'value' => '',
            'target' => '',
            'do_i' => '',
            'url' => '',

        ]);
        $user = ChangeModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->if_i = $valiDate['if_i'];
            $user->state = $valiDate['state'];
            $user->value = $valiDate['value'];
            $user->target = $valiDate['target'];
            $user->do_i = $valiDate['do_i'];
            $user->url = $valiDate['url'];

            if ($user->update()) {
                return response([
                    'data' => [
                        'message' => ' form is register',
                    ],
                    'status' => 'success',
                    'info' => $user,

                ]);
            }
        } else {
            return "Id not found";
        }
    }
    public function setting_change1_show($form_id)
    {
        $ee= ChangeModel::where([['admin_id',auth()->user()->id],['form_id',$form_id]])->orderby('id','desc')->paginate(5);
        return $ee;
    }

    public function setting_change_delete($id)
    {
        $t = ChangeModel::where([['id', $id], ['admin_id', auth()->user()->id]])->delete();
        if ($t) {
            return response([

                'data' => 'delete with successfull'
            ]);
        } else {
            return "id not found";
        }
    }
    //----------------------------------------End setting change---------------------------------------------
    //----------------------------------------start setting change---------------------------------------------
    public function setting_changeemail_show()
    {
        $d = Changeemail1Model::where('id', '1')->orderby('id', 'desc')->take(1)
            ->get(['if_i','state','value','target','send','email'])->toArray();
        $r = implode(', ', array_values($d[0]));
        $t = str_replace('[', ' ', $r);
        $e = str_replace(']', ' ', $t);
        $arr = explode(",", $e);
        $j = 0;
        //print_r($arr);
        echo "<br>";
        //print_r($arr[7]);
        foreach ($arr as $key) {
            echo $key . '<br>';
            $j++;
        }
    }
    public function setting_changeemail_create(Request $request)
    {

        $valiDate = $this->validate($request, [
            'if_i' => 'required',
            'state' => 'required',
            'value' => 'required',
            'target' => 'required',
            'send' => 'required',
            'email' => 'required|email',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->changeemail1()->create([
            'if_i' => $valiDate['if_i'],
            'state' => $valiDate['state'],
            'value' => $valiDate['value'],
            'target' => $valiDate['target'],
            'send' => $valiDate['send'],
            'email' => $valiDate['email'],
            'form_id' => $valiDate['form_id']
        ]);
        return response([
            'data' => [
                'message' => 'form is registered',
            ],
            'status' => 'success',
            'ID' => $y->id
        ]);
    }
    public function setting_changeemail_edit(Request $request,$id)
    {
        $valiDate = $this->validate($request, [
            'if_i' => '',
            'state' => '',
            'value' => '',
            'target' => '',
            'send' => '',
            'email' => 'email',

        ]);
        $user = ChangeemailModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->if_i = $valiDate['if_i'];
            $user->state = $valiDate['state'];
            $user->value = $valiDate['value'];
            $user->target = $valiDate['target'];
            $user->send = $valiDate['send'];
            $user->email = $valiDate['email'];

            if ($user->update()) {
                return response([
                    'data' => [
                        'message' => ' form is register',
                    ],
                    'status' => 'success',
                    'info' => $user,

                ]);
            }
        } else {
            return "Id not found";
        }
    }
    public function setting_changeemail1_show($form_id)
    {
        $ee= ChangeemailModel::where([['admin_id',auth()->user()->id],['form_id',$form_id]])->orderby('id','desc')->paginate(5);
        return $ee;
    }

    public function setting_changeemail_delete($id)
    {
        $t = ChangeemailModel::where([['id', $id], ['admin_id', auth()->user()->id]])->delete();
        if ($t) {
            return response([

                'data' => 'delete with successfull'
            ]);
        } else {
            return "id not found";
        }
    }
    //----------------------------------------End setting change email---------------------------------------------

}
