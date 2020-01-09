<?php

namespace App\Http\Controllers\Api\v1;

use App\LangsModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\advancedModel;
use App\advanced_answerModel;
class AdvancedController extends Controller
{
    //-------------------------------------------start advance fullname------------------------------
    public function advance_fullname_show_en()
    {
        $d = advancedModel::where('id', '1')->orderby('id', 'desc')->take(1)
            ->get(['placeholder', 'readonly', 'hidefield'])->toArray();
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
    public function advance_fullname_show_fa($fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $d = advancedModel::where('id', '1')->orderby('id', 'desc')->take(1)
            ->get(['placeholder_fa', 'readonly_fa', 'hidefield_fa'])->toArray();
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
    public function advance_fullname_create(Request $request)
    {
        $valiDate = $this->validate($request, [
            'placeholder' => '',
            'readonly' => '',//1 or 0
            'hidefield' => '',//1 or 0
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->advance()->create([
            'placeholder' => $valiDate['placeholder'],
            'readonly' => $valiDate['readonly'],
            'hidefield' => $valiDate['hidefield'],
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
    public function advance_fullname_create_get(Request $request,$placeholder,$readonly,$hidefield,$form_id)
    {
        $valiDate = $this->validate($request, [
            'placeholder' => '',
            'readonly' => '',
            'hidefield' => '',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->advance()->create([
            'placeholder' => $placeholder,
            'readonly' => $readonly,
            'hidefield' => $hidefield,
            'form_id' => $form_id
        ]);
        return response([
            'data' => [
                'message' => 'form is registered',
            ],
            'status' => 'success',
            'ID' => $y->id
        ]);
    }
    public function advance_fullname_create_fa(Request $request,$fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
            'placeholder' => '',
            'readonly' => '',
            'hidefield' => '',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->advance()->create([
            'placeholder' => $valiDate['placeholder'],
            'readonly' => $valiDate['readonly'],
            'hidefield' => $valiDate['hidefield'],
            'form_id' => $valiDate['form_id']
        ]);
        return response([
            'داده' => [
                'پیام' => 'ثبت شد',
            ],
            'وضعیت' => 'با موفقیت',
            'ID' => $y->id
        ]);
    }
    public function advance_fullname_create_get_fa(Request $request,$placeholder,$readonly,$hidefield,$form_id,$fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
            'placeholder' => '',
            'readonly' => '',
            'hidefield' => '',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->advance()->create([
            'placeholder' => $placeholder,
            'readonly' => $readonly,
            'hidefield' => $hidefield,
            'form_id' => $form_id
        ]);
        return response([
            'داده' => [
                'پیام' => 'ثبت شد',
            ],
            'وضعیت' => 'با موفقیت',
            'ID' => $y->id
        ]);
    }
    public function advance_fullname_show($id)
    {
        $ee= advanced_answerModel::where([['id',$id],['admin_id',auth()->user()->id]])->get(['id','placeholder','readonly','hidefield']);
        $r= implode(', ',array($ee));
        $t=str_replace('[',' ',$r);
        $e= str_replace(']',' ',$t);
        return $e;
    }
    public function advance_fullname_showall($form_id)
    {
        $ee= advanced_answerModel::where([['admin_id',auth()->user()->id],['form_id',$form_id]])->orderby('id','desc')->paginate(5);
        return $ee;
    }
    public function advance_fullname_edit(Request $request,$id)
    {
        $valiDate = $this->validate($request, [
            'placeholder' => '',
            'readonly' => '',
            'hidefield' => '',
        ]);
        $user = advanced_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->placeholder = $valiDate['placeholder'];
            $user->readonly = $valiDate['readonly'];
            $user->hidefield = $valiDate['hidefield'];
            if ($user->update()) {
                return response([
                    'data' => [
                        'message' => ' form is register',
                    ],
                    'status' => 'success',
                    'info' => $user
                ]);
            }
        } else {
            return "Id not found";
        }
    }
    public function advance_fullname_edit_get(Request $request,$id,$placeholder,$readonly,$hidefield)
    {
        $valiDate = $this->validate($request, [
            'placeholder' => '',
            'readonly' => '',
            'hidefield' => '',
        ]);
        $user = advanced_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->placeholder = $placeholder;
            $user->readonly = $readonly;
            $user->hidefield = $hidefield;
            if ($user->update()) {
                return response([
                    'data' => [
                        'message' => ' form is register',
                    ],
                    'status' => 'success',
                    'info' => $user
                ]);
            }
        } else {
            return "Id not found";
        }
    }
    public function advance_fullname_edit_fa(Request $request,$id,$fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
            'placeholder' => '',
            'readonly' => '',
            'hidefield' => '',
        ]);
        $user = advanced_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->placeholder = $valiDate['placeholder'];
            $user->readonly = $valiDate['readonly'];
            $user->hidefield = $valiDate['hidefield'];
            if ($user->update()) {
                return response([
                    'داده' => [
                        'پیام' => ' آپدیت شد',
                    ],
                    'وضعیت' => 'با موفقیت',
                    'اطلاعات' => $user
                ]);
            }
        } else {
            return "پیدا نشد";
        }
    }
    public function advance_fullname_edit_get_fa(Request $request,$id,$placeholder,$readonly,$hidefield,$fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
            'placeholder' => '',
            'readonly' => '',
            'hidefield' => '',
        ]);
        $user = advanced_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->placeholder = $placeholder;
            $user->readonly = $readonly;
            $user->hidefield = $hidefield;
            if ($user->update()) {
                return response([
                    'داده' => [
                        'پیام' => ' آپدیت شد',
                    ],
                    'وضعیت' => 'با موفقیت',
                    'اطلاعات' => $user
                ]);
            }
        } else {
            return "پیدا نشد";
        }
    }
    public function advance_fullname_delete($id)
    {
        $t = advanced_answerModel::where([['id', $id], ['admin_id', auth()->user()->id]])->delete();
        if ($t) {
            return response([

                'data' => 'delete with successfull'
            ]);
        } else {
            return "id not found";
        }
    }
    public function advance_fullname_delete_fa($id, $fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $t = advanced_answerModel::where([['id', $id], ['admin_id', auth()->user()->id]])->delete();
        if ($t) {
            return response([

                'data' => 'کاربر پاک شد',
                'زبان' => $q
            ]);
        } else {
            return "این id وجود ندارد";
        }
    }

    //-------------------------------------------End advance fullname------------------------------

    //-------------------------------------------start advance email------------------------------
    public function advance_email_show_en()
    {
        $d = advancedModel::where('id', '1')->orderby('id', 'desc')->take(1)
            ->get(['placeholder_email', 'default_value', 'read_only','hide_field'])->toArray();
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
    public function advance_email_show_fa($fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $d = advancedModel::where('id', '1')->orderby('id', 'desc')->take(1)
            ->get(['placeholder_email_fa', 'default_value_fa', 'read_only_fa','hide_field_fa'])->toArray();
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
    public function advance_email_create(Request $request)
    {
        $valiDate = $this->validate($request, [
            'placeholder_email' => '',
            'default_value' => '',
            'read_only' => '',
            'hide_field'=>'',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->advance()->create([
            'placeholder_email' => $valiDate['placeholder_email'],
            'default_value' => $valiDate['default_value'],
            'read_only' => $valiDate['read_only'],
            'hide_field' => $valiDate['hide_field'],
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
    public function advance_email_create_get(Request $request,$placeholder_email,$default_value,$read_only,$hide_field,$form_id)
    {
        $valiDate = $this->validate($request, [
            'placeholder_email' => '',
            'default_value' => '',
            'read_only' => '',
            'hide_field'=>'',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->advance()->create([
            'placeholder_email' => $placeholder_email,
            'default_value' => $default_value,
            'read_only' => $read_only,
            'hide_field' => $hide_field,
            'form_id' => $form_id
        ]);
        return response([
            'data' => [
                'message' => 'form is registered',
            ],
            'status' => 'success',
            'ID' => $y->id
        ]);
    }
    public function advance_email_create_get_fa(Request $request,$placeholder_email,$default_value,$read_only,$hide_field,$form_id,$fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
            'placeholder_email' => '',
            'default_value' => '',
            'read_only' => '',
            'hide_field'=>'',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->advance()->create([
            'placeholder_email' => $placeholder_email,
            'default_value' => $default_value,
            'read_only' => $read_only,
            'hide_field' => $hide_field,
            'form_id' => $form_id
        ]);
        return response([
            'داده' => [
                'پیام' => 'ثبت شد',
            ],
            'وضعیت' => 'با موفقیت',
            'ID' => $y->id
        ]);
    }
    public function advance_email_create_fa(Request $request,$fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
            'placeholder_email' => '',
            'default_value' => '',
            'read_only' => '',
            'hide_field'=>'',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->advance()->create([
            'placeholder_email' => $valiDate['placeholder_email'],
            'default_value' => $valiDate['default_value'],
            'read_only' => $valiDate['read_only'],
            'hide_field' => $valiDate['hide_field'],
            'form_id' => $valiDate['form_id']
        ]);
        return response([
            'داده' => [
                'پیام' => 'ثبت شد',
            ],
            'وضعیت' => 'با موفقیت',
            'ID' => $y->id
        ]);
    }
    public function advance_email_show($id)
    {
        $ee= advanced_answerModel::where([['id',$id],['admin_id',auth()->user()->id]])->get(['id','placeholder_email','default_value','read_only','hide_field']);
        $r= implode(', ',array($ee));
        $t=str_replace('[',' ',$r);
        $e= str_replace(']',' ',$t);
        return $e;
    }
    public function advance_email_showall($form_id)
    {
        $ee= advanced_answerModel::where([['admin_id',auth()->user()->id],['form_id',$form_id]])->orderby('id','desc')->paginate(5);
        return $ee;
    }
    public function advance_email_edit(Request $request,$id)
    {
        $valiDate = $this->validate($request, [
            'placeholder_email' => '',
            'default_value' => '',
            'read_only' => '',
            'hide_field'=>'',
        ]);
        $user = advanced_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->placeholder_email = $valiDate['placeholder_email'];
            $user->default_value = $valiDate['default_value'];
            $user->read_only = $valiDate['read_only'];
            $user->hide_field = $valiDate['hide_field'];

            if ($user->update()) {
                return response([
                    'data' => [
                        'message' => ' form is register',
                    ],
                    'status' => 'success',
                    'info' => $user
                ]);
            }
        } else {
            return "Id not found";
        }
    }
    public function advance_email_edit_get(Request $request,$id,$placeholder_email,$default_value,$read_only,$hide_field)
    {
        $valiDate = $this->validate($request, [
            'placeholder_email' => '',
            'default_value' => '',
            'read_only' => '',
            'hide_field'=>'',
        ]);
        $user = advanced_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->placeholder_email = $placeholder_email;
            $user->default_value = $default_value;
            $user->read_only = $read_only;
            $user->hide_field = $hide_field;

            if ($user->update()) {
                return response([
                    'data' => [
                        'message' => ' form is register',
                    ],
                    'status' => 'success',
                    'info' => $user
                ]);
            }
        } else {
            return "Id not found";
        }
    }
    public function advance_email_edit_fa(Request $request,$id,$fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
            'placeholder_email' => '',
            'default_value' => '',
            'read_only' => '',
            'hide_field'=>'',
        ]);
        $user = advanced_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->placeholder_email = $valiDate['placeholder_email'];
            $user->default_value = $valiDate['default_value'];
            $user->read_only = $valiDate['read_only'];
            $user->hide_field = $valiDate['hide_field'];
            if ($user->update()) {
                return response([
                    'داده' => [
                        'پیام' => ' آپدیت شد',
                    ],
                    'وضعیت' => 'با موفقیت',
                    'اطلاعات' => $user
                ]);
            }
        } else {
            return "پیدا نشد";
        }
    }
    public function advance_email_edit_get_fa(Request $request,$id,$placeholder_email,$default_value,$read_only,$hide_field,$fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
            'placeholder_email' => '',
            'default_value' => '',
            'read_only' => '',
            'hide_field'=>'',
        ]);
        $user = advanced_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->placeholder_email = $placeholder_email;
            $user->default_value = $default_value;
            $user->read_only = $read_only;
            $user->hide_field = $hide_field;
            if ($user->update()) {
                return response([
                    'داده' => [
                        'پیام' => ' آپدیت شد',
                    ],
                    'وضعیت' => 'با موفقیت',
                    'اطلاعات' => $user
                ]);
            }
        } else {
            return "پیدا نشد";
        }
    }
    public function advance_email_delete($id)
    {
        $t = advanced_answerModel::where([['id', $id], ['admin_id', auth()->user()->id]])->delete();
        if ($t) {
            return response([

                'data' => 'delete with successfull'
            ]);
        } else {
            return "id not found";
        }
    }
    public function advance_email_delete_fa($id, $fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $t = advanced_answerModel::where([['id', $id], ['admin_id', auth()->user()->id]])->delete();
        if ($t) {
            return response([

                'data' => 'کاربر پاک شد',
                'زبان' => $q
            ]);
        } else {
            return "این id وجود ندارد";
        }
    }
    //-------------------------------------------End advance email------------------------------
    //-------------------------------------------start advance address------------------------------
    public function advance_address_show_en()
    {
        $d = advancedModel::where('id', '1')->orderby('id', 'desc')->take(1)
            ->get(['placeholder_address', 'hide_field_address'])->toArray();
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
    public function advance_address_show_fa($fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $d = advancedModel::where('id', '1')->orderby('id', 'desc')->take(1)
            ->get(['placeholder_address_fa', 'hide_field_address_fa'])->toArray();
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
    public function advance_address_create(Request $request)
    {
        $valiDate = $this->validate($request, [
            'street_address1' => '',
            'street_address2' => '',
            'city' => '',
            'state'=>'',
            'zip_code'=>'',
            'location'=>'',
            'hide_field_address'=>'',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->advance()->create([
            'street_address1' => $valiDate['street_address1'],
            'street_address2' => $valiDate['street_address2'],
            'city' => $valiDate['city'],
            'state' => $valiDate['state'],
            'zip_code' => $valiDate['zip_code'],
            'location' => $valiDate['location'],
            'hide_field_address' => $valiDate['hide_field_address'],
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
    public function advance_address_create_get(Request $request,$street_address1,$street_address2,$city,$state,$zip_code,$location,$hide_field_address,$form_id)
    {
        $valiDate = $this->validate($request, [
            'street_address1' => '',
            'street_address2' => '',
            'city' => '',
            'state'=>'',
            'zip_code'=>'',
            'location'=>'',
            'hide_field_address'=>'',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->advance()->create([
            'street_address1' => $street_address1,
            'street_address2' => $street_address2,
            'city' => $city,
            'state' => $state,
            'zip_code' => $zip_code,
            'location' => $location,
            'hide_field_address' => $hide_field_address,
            'form_id' => $form_id
        ]);
        return response([
            'data' => [
                'message' => 'form is registered',
            ],
            'status' => 'success',
            'ID' => $y->id
        ]);
    }
    public function advance_address_create_fa(Request $request,$fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
            'street_address1' => '',
            'street_address2' => '',
            'city' => '',
            'state'=>'',
            'zip_code'=>'',
            'location'=>'',
            'hide_field_address'=>'',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->advance()->create([
            'street_address1' => $valiDate['street_address1'],
            'street_address2' => $valiDate['street_address2'],
            'city' => $valiDate['city'],
            'state' => $valiDate['state'],
            'zip_code' => $valiDate['zip_code'],
            'location' => $valiDate['location'],
            'hide_field_address' => $valiDate['hide_field_address'],
            'form_id' => $valiDate['form_id']
        ]);
        return response([
            'داده' => [
                'پیام' => 'ثبت شد',
            ],
            'وضعیت' => 'با موفقیت',
            'ID' => $y->id
        ]);
    }
    public function advance_address_create_get_fa(Request $request,$street_address1,$street_address2,$city,$state,$zip_code,$location,$hide_field_address,$form_id,$fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
            'street_address1' => '',
            'street_address2' => '',
            'city' => '',
            'state'=>'',
            'zip_code'=>'',
            'location'=>'',
            'hide_field_address'=>'',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->advance()->create([
            'street_address1' => $street_address1,
            'street_address2' => $street_address2,
            'city' => $city,
            'state' => $state,
            'zip_code' => $zip_code,
            'location' => $location,
            'hide_field_address' => $hide_field_address,
            'form_id' => $form_id
        ]);
        return response([
            'داده' => [
                'پیام' => 'ثبت شد',
            ],
            'وضعیت' => 'با موفقیت',
            'ID' => $y->id
        ]);
    }
    public function advance_address_show($id)
    {
        $ee= advanced_answerModel::where([['id',$id],['admin_id',auth()->user()->id]])->get(['id','street_address1','street_address2','city','state','zip_code','location','hide_field_address']);
        $r= implode(', ',array($ee));
        $t=str_replace('[',' ',$r);
        $e= str_replace(']',' ',$t);
        return $e;
    }
    public function advance_address_showall($form_id)
    {
        $ee= advanced_answerModel::where([['admin_id',auth()->user()->id],['form_id',$form_id]])->orderby('id','desc')->paginate(5);
        return $ee;
    }
    public function advance_address_edit(Request $request,$id)
    {
        $valiDate = $this->validate($request, [
            'street_address1' => '',
            'street_address2' => '',
            'city' => '',
            'state'=>'',
            'zip_code'=>'',
            'location'=>'',
            'hide_field_address'=>'',
        ]);
        $user = advanced_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->street_address1 = $valiDate['street_address1'];
            $user->street_address2 = $valiDate['street_address2'];
            $user->city = $valiDate['city'];
            $user->state = $valiDate['state'];
            $user->zip_code = $valiDate['zip_code'];
            $user->location = $valiDate['location'];
            $user->hide_field_address = $valiDate['hide_field_address'];

            if ($user->update()) {
                return response([
                    'data' => [
                        'message' => ' form is register',
                    ],
                    'status' => 'success',
                    'info' => $user
                ]);
            }
        } else {
            return "Id not found";
        }
    }
    public function advance_address_edit_get(Request $request,$id,$street_address1,$street_address2,$city,$state,$zip_code,$location,$hide_field_address)
    {
        $valiDate = $this->validate($request, [
            'street_address1' => '',
            'street_address2' => '',
            'city' => '',
            'state'=>'',
            'zip_code'=>'',
            'location'=>'',
            'hide_field_address'=>'',
        ]);
        $user = advanced_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->street_address1 = $street_address1;
            $user->street_address2 = $street_address2;
            $user->city = $city;
            $user->state = $state;
            $user->zip_code = $zip_code;
            $user->location = $location;
            $user->hide_field_address = $hide_field_address;


            if ($user->update()) {
                return response([
                    'data' => [
                        'message' => ' form is register',
                    ],
                    'status' => 'success',
                    'info' => $user
                ]);
            }
        } else {
            return "Id not found";
        }
    }
    public function advance_address_edit_fa(Request $request,$id,$fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
            'street_address1' => '',
            'street_address2' => '',
            'city' => '',
            'state'=>'',
            'zip_code'=>'',
            'location'=>'',
            'hide_field_address'=>'',
        ]);
        $user = advanced_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->street_address1 = $valiDate['street_address1'];
            $user->street_address2 = $valiDate['street_address2'];
            $user->city = $valiDate['city'];
            $user->state = $valiDate['state'];
            $user->zip_code = $valiDate['zip_code'];
            $user->location = $valiDate['location'];
            $user->hide_field_address = $valiDate['hide_field_address'];

            if ($user->update()) {
                return response([
                    'داده' => [
                        'پیام' => ' آپدیت شد',
                    ],
                    'وضعیت' => 'با موفقیت',
                    'اطلاعات' => $user
                ]);
            }
        } else {
            return "پیدا نشد";
        }
    }
    public function advance_address_edit_get_fa(Request $request,$id,$street_address1,$street_address2,$city,$state,$zip_code,$location,$hide_field_address,$fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
            'street_address1' => '',
            'street_address2' => '',
            'city' => '',
            'state'=>'',
            'zip_code'=>'',
            'location'=>'',
            'hide_field_address'=>'',
        ]);
        $user = advanced_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->street_address1 = $street_address1;
            $user->street_address2 = $street_address2;
            $user->city = $city;
            $user->state = $state;
            $user->zip_code = $zip_code;
            $user->location = $location;
            $user->hide_field_address = $hide_field_address;


            if ($user->update()) {
                return response([
                    'داده' => [
                        'پیام' => ' آپدیت شد',
                    ],
                    'وضعیت' => 'با موفقیت',
                    'اطلاعات' => $user
                ]);
            }
        } else {
            return "پیدا نشد";
        }
    }
    public function advance_address_delete($id)
    {
        $t = advanced_answerModel::where([['id', $id], ['admin_id', auth()->user()->id]])->delete();
        if ($t) {
            return response([

                'data' => 'delete with successfull'
            ]);
        } else {
            return "id not found";
        }
    }
    public function advance_address_delete_fa($id, $fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $t = advanced_answerModel::where([['id', $id], ['admin_id', auth()->user()->id]])->delete();
        if ($t) {
            return response([

                'data' => 'کاربر پاک شد',
                'زبان' => $q
            ]);
        } else {
            return "این id وجود ندارد";
        }
    }

    //--------------------------------End advance address-------------------------------------------
    //--------------------------------start advance phone number-------------------------------------------
    public function advance_phonenumber_show_en()
    {
        $d = advancedModel::where('id', '1')->orderby('id', 'desc')->take(1)
            ->get(['placeholder_phonenumber', 'read_only_phonenumber','hide_field_phonenumber'])->toArray();
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
    public function advance_phonenumber_show_fa($fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $d = advancedModel::where('id', '1')->orderby('id', 'desc')->take(1)
            ->get(['placeholder_phonenumber_fa', 'read_only_phonenumber_fa','hide_field_phonenumber_fa'])->toArray();
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
    public function advance_phonenumber_create(Request $request)
    {
        $valiDate = $this->validate($request, [
            'area_code' => '',
            'phone' => '',
            'read_only_phonenumber' => '',
            'hide_field_phonenumber' => '',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->advance()->create([
            'area_code' => $valiDate['area_code'],
            'phone' => $valiDate['phone'],
            'read_only_phonenumber' => $valiDate['read_only_phonenumber'],
            'hide_field_phonenumber' => $valiDate['hide_field_phonenumber'],
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
    public function advance_phonenumber_create_get(Request $request,$area_code,$phone,$read_only_phonenumber,$hide_field_phonenumber,$form_id)
    {
        $valiDate = $this->validate($request, [
            'area_code' => '',
            'phone' => '',
            'read_only_phonenumber' => '',
            'hide_field_phonenumber' => '',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->advance()->create([
            'placeholder_phonenumber' => $area_code,
            'phone' => $phone,
            'read_only_phonenumber' => $read_only_phonenumber,
            'hide_field_phonenumber' => $hide_field_phonenumber,
            'form_id' => $form_id
        ]);
        return response([
            'data' => [
                'message' => 'form is registered',
            ],
            'status' => 'success',
            'ID' => $y->id
        ]);
    }
    public function advance_phonenumber_create_fa(Request $request,$fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
            'area_code' => '',
            'phone' => '',
            'read_only_phonenumber' => '',
            'hide_field_phonenumber' => '',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->advance()->create([
            'area_code' => $valiDate['area_code'],
            'phone' => $valiDate['phone'],
            'read_only_phonenumber' => $valiDate['read_only_phonenumber'],
            'hide_field_phonenumber' => $valiDate['hide_field_phonenumber'],
            'form_id' => $valiDate['form_id']
        ]);
        return response([
            'داده' => [
                'پیام' => 'ثبت شد',
            ],
            'وضعیت' => 'با موفقیت',
            'ID' => $y->id
        ]);
    }
    public function advance_phonenumber_create_get_fa(Request $request,$area_code,$phone,$read_only_phonenumber,$hide_field_phonenumber,$form_id,$fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
            'area_code' => '',
            'phone' => '',
            'read_only_phonenumber' => '',
            'hide_field_phonenumber' => '',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->advance()->create([
            'placeholder_phonenumber' => $area_code,
            'phone' => $phone,
            'read_only_phonenumber' => $read_only_phonenumber,
            'hide_field_phonenumber' => $hide_field_phonenumber,
            'form_id' => $form_id
        ]);
        return response([
            'داده' => [
                'پیام' => 'ثبت شد',
            ],
            'وضعیت' => 'با موفقیت',
            'ID' => $y->id
        ]);
    }
    public function advance_phonenumber_show($id)
    {
        $ee= advanced_answerModel::where([['id',$id],['admin_id',auth()->user()->id]])->get(['id','area_code','phone','read_only_phonenumber','hide_field_phonenumber']);
        $r= implode(', ',array($ee));
        $t=str_replace('[',' ',$r);
        $e= str_replace(']',' ',$t);
        return $e;
    }
    public function advance_phonenumber_showall($form_id)
    {
        $ee= advanced_answerModel::where([['admin_id',auth()->user()->id],['form_id',$form_id]])->orderby('id','desc')->paginate(5);
        return $ee;
    }
    public function advance_phonenumber_edit(Request $request,$id)
    {
        $valiDate = $this->validate($request, [
            'area_code' => '',
            'phone' => '',
            'read_only_phonenumber' => '',
            'hide_field_phonenumber' => '',
            //'form_id' => 'exists:forms,id'
        ]);
        $user = advanced_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->area_code = $valiDate['area_code'];
            $user->phone = $valiDate['phone'];
            $user->read_only_phonenumber = $valiDate['read_only_phonenumber'];
            $user->hide_field_phonenumber = $valiDate['hide_field_phonenumber'];
            if ($user->update()) {
                return response([
                    'data' => [
                        'message' => ' form is register',
                    ],
                    'status' => 'success',
                    'info' => $user
                ]);
            }
        } else {
            return "Id not found";
        }
    }
    public function advance_phonenumber_edit_get(Request $request,$id,$area_code,$phone,$read_only_phonenumber,$hide_field_phonenumber)
    {
        $valiDate = $this->validate($request, [
            'area_code' => '',
            'phone' => '',
            'read_only_phonenumber' => '',
            'hide_field_phonenumber' => '',
            //'form_id' => 'exists:forms,id'
        ]);
        $user = advanced_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->area_code = $area_code;
            $user->phone = $phone;
            $user->read_only_phonenumber = $read_only_phonenumber;
            $user->hide_field_phonenumber = $hide_field_phonenumber;


            if ($user->update()) {
                return response([
                    'data' => [
                        'message' => ' form is register',
                    ],
                    'status' => 'success',
                    'info' => $user
                ]);
            }
        } else {
            return "Id not found";
        }
    }
    public function advance_phonenumber_edit_fa(Request $request,$id,$fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
            'area_code' => '',
            'phone' => '',
            'read_only_phonenumber' => '',
            'hide_field_phonenumber' => '',
           // 'form_id' => 'exists:forms,id'
        ]);
        $user = advanced_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->area_code = $valiDate['area_code'];
            $user->phone = $valiDate['phone'];
            $user->read_only_phonenumber = $valiDate['read_only_phonenumber'];
            $user->hide_field_phonenumber = $valiDate['hide_field_phonenumber'];
            if ($user->update()) {
                return response([
                    'داده' => [
                        'پیام' => ' آپدیت شد',
                    ],
                    'وضعیت' => 'با موفقیت',
                    'اطلاعات' => $user
                ]);
            }
        } else {
            return "پیدا نشد";
        }
    }
    public function advance_phonenumber_edit_get_fa(Request $request,$id,$area_code,$phone,$read_only_phonenumber,$hide_field_phonenumber,$fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
            'area_code' => '',
            'phone' => '',
            'read_only_phonenumber' => '',
            'hide_field_phonenumber' => '',
            //'form_id' => 'exists:forms,id'
        ]);
        $user = advanced_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->area_code = $area_code;
            $user->phone = $phone;
            $user->read_only_phonenumber = $read_only_phonenumber;
            $user->hide_field_phonenumber = $hide_field_phonenumber;


            if ($user->update()) {
                return response([
                    'داده' => [
                        'پیام' => ' آپدیت شد',
                    ],
                    'وضعیت' => 'با موفقیت',
                    'اطلاعات' => $user
                ]);
            }
        } else {
            return "پیدا نشد";
        }
    }
    public function advance_phonenumber_delete($id)
    {
        $t = advanced_answerModel::where([['id', $id], ['admin_id', auth()->user()->id]])->delete();
        if ($t) {
            return response([

                'data' => 'delete with successfull'
            ]);
        } else {
            return "id not found";
        }
    }
    public function advance_phonenumber_delete_fa($id, $fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $t = advanced_answerModel::where([['id', $id], ['admin_id', auth()->user()->id]])->delete();
        if ($t) {
            return response([

                'data' => 'کاربر پاک شد',
                'زبان' => $q
            ]);
        } else {
            return "این id وجود ندارد";
        }
    }

    //--------------------------------End advance phone number-------------------------------------------
    //--------------------------------start advance datepicker-------------------------------------------
    public function advance_datepicker_show_en()
    {
        $d = advancedModel::where('id', '1')->orderby('id', 'desc')->take(1)
            ->get(['disable_past_date', 'read_only_datepicker','hide_field_datepicker'])->toArray();
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
    public function advance_datepicker_show_fa($fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $d = advancedModel::where('id', '1')->orderby('id', 'desc')->take(1)
            ->get(['disable_past_date_fa', 'read_only_datepicker_fa','hide_field_datepicker_fa'])->toArray();
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
    public function advance_datepicker_create(Request $request)
    {
        $valiDate = $this->validate($request, [
            'disable_past_date' => '',
            'read_only_datepicker' => '',
            'hide_field_datepicker' => '',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->advance()->create([
            'disable_past_date' => $valiDate['disable_past_date'],
            'read_only_datepicker' => $valiDate['read_only_datepicker'],
            'hide_field_datepicker' => $valiDate['hide_field_datepicker'],
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
    public function advance_datepicker_create_get(Request $request,$disable_past_date,$read_only_datepicker,$hide_field_datepicker,$form_id)
    {
        $valiDate = $this->validate($request, [
            'disable_past_date' => '',
            'read_only_datepicker' => '',
            'hide_field_datepicker' => '',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->advance()->create([
            'disable_past_date' => $disable_past_date,
            'read_only_datepicker' => $read_only_datepicker,
            'hide_field_datepicker' => $hide_field_datepicker,
            'form_id' => $form_id
        ]);
        return response([
            'data' => [
                'message' => 'form is registered',
            ],
            'status' => 'success',
            'ID' => $y->id
        ]);
    }
    public function advance_datepicker_create_fa(Request $request,$fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
            'disable_past_date' => '',
            'read_only_datepicker' => '',
            'hide_field_datepicker' => '',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->advance()->create([
            'disable_past_date' => $valiDate['disable_past_date'],
            'read_only_datepicker' => $valiDate['read_only_datepicker'],
            'hide_field_datepicker' => $valiDate['hide_field_datepicker'],
            'form_id' => $valiDate['form_id']
        ]);
        return response([
            'داده' => [
                'پیام' => 'ثبت شد',
            ],
            'وضعیت' => 'با موفقیت',
            'ID' => $y->id
        ]);
    }
    public function advance_datepicker_create_get_fa(Request $request,$disable_past_date,$read_only_datepicker,$hide_field_datepicker,$form_id,$fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
            'disable_past_date' => '',
            'read_only_datepicker' => '',
            'hide_field_datepicker' => '',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->advance()->create([
            'disable_past_date' => $disable_past_date,
            'read_only_datepicker' => $read_only_datepicker,
            'hide_field_datepicker' => $hide_field_datepicker,
            'form_id' => $form_id
        ]);
        return response([
            'داده' => [
                'پیام' => 'ثبت شد',
            ],
            'وضعیت' => 'با موفقیت',
            'ID' => $y->id
        ]);
    }
    public function advance_datepicker_show($id)
    {
        $ee= advanced_answerModel::where([['id',$id],['admin_id',auth()->user()->id]])->get(['id','disable_past_date','read_only_datepicker','hide_field_datepicker']);
        $r= implode(', ',array($ee));
        $t=str_replace('[',' ',$r);
        $e= str_replace(']',' ',$t);
        return $e;
    }
    public function advance_datepicker_showall($form_id)
    {
        $ee= advanced_answerModel::where([['admin_id',auth()->user()->id],['form_id',$form_id]])->orderby('id','desc')->paginate(5);
        return $ee;
    }
    public function advance_datepicker_edit(Request $request,$id)
    {
        $valiDate = $this->validate($request, [
            'disable_past_date' => '',
            'read_only_datepicker' => '',
            'hide_field_datepicker' => '',
        ]);
        $user = advanced_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->disable_past_date = $valiDate['disable_past_date'];
            $user->read_only_datepicker = $valiDate['read_only_datepicker'];
            $user->hide_field_datepicker = $valiDate['hide_field_datepicker'];
            if ($user->update()) {
                return response([
                    'data' => [
                        'message' => ' form is register',
                    ],
                    'status' => 'success',
                    'info' => $user
                ]);
            }
        } else {
            return "Id not found";
        }
    }
    public function advance_datepicker_edit_get(Request $request,$id,$disable_past_date,$read_only_datepicker,$hide_field_datepicker){
        $valiDate = $this->validate($request, [
            'disable_past_date' => '',
            'read_only_datepicker' => '',
            'hide_field_datepicker' => '',
        ]);
        $user = advanced_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->disable_past_date = $disable_past_date;
            $user->read_only_datepicker = $read_only_datepicker;
            $user->hide_field_datepicker = $hide_field_datepicker;
            if ($user->update()) {
                return response([
                    'data' => [
                        'message' => ' form is register',
                    ],
                    'status' => 'success',
                    'info' => $user
                ]);
            }
        } else {
            return "Id not found";
        }
    }
    public function advance_datepicker_edit_fa(Request $request,$id,$fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
            'disable_past_date' => '',
            'read_only_datepicker' => '',
            'hide_field_datepicker' => '',
        ]);
        $user = advanced_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->disable_past_date = $valiDate['disable_past_date'];
            $user->read_only_datepicker = $valiDate['read_only_datepicker'];
            $user->hide_field_datepicker = $valiDate['hide_field_datepicker'];
            if ($user->update()) {
                return response([
                    'داده' => [
                        'پیام' => ' آپدیت شد',
                    ],
                    'وضعیت' => 'با موفقیت',
                    'اطلاعات' => $user
                ]);
            }
        } else {
            return "پیدا نشد";
        }
    }
    public function advance_datepicker_edit_get_fa(Request $request,$id,$disable_past_date,$read_only_datepicker,$hide_field_datepicker,$fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
            'disable_past_date' => '',
            'read_only_datepicker' => '',
            'hide_field_datepicker' => '',
        ]);
        $user = advanced_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->disable_past_date = $disable_past_date;
            $user->read_only_datepicker = $read_only_datepicker;
            $user->hide_field_datepicker = $hide_field_datepicker;
            if ($user->update()) {
                return response([
                    'داده' => [
                        'پیام' => ' آپدیت شد',
                    ],
                    'وضعیت' => 'با موفقیت',
                    'اطلاعات' => $user
                ]);
            }
        } else {
            return "پیدا نشد";
        }
    }
    public function advance_datepicker_delete($id)
    {
        $t = advanced_answerModel::where([['id', $id], ['admin_id', auth()->user()->id]])->delete();
        if ($t) {
            return response([

                'data' => 'delete with successfull'
            ]);
        } else {
            return "id not found";
        }
    }
    public function advance_datepicker_delete_fa($id, $fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $t = advanced_answerModel::where([['id', $id], ['admin_id', auth()->user()->id]])->delete();
        if ($t) {
            return response([

                'data' => 'کاربر پاک شد',
                'زبان' => $q
            ]);
        } else {
            return "این id وجود ندارد";
        }
    }
    //--------------------------------End advance datepicker-------------------------------------------
    //--------------------------------start advance timer-------------------------------------------
    public function advance_timer_show_en()
    {
        $d = advancedModel::where('id', '1')->orderby('id', 'desc')->take(1)
            ->get(['read_only_timer', 'hide_field_timer'])->toArray();
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
    public function advance_timer_show_fa($fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $d = advancedModel::where('id', '1')->orderby('id', 'desc')->take(1)
            ->get(['read_only_timer_fa', 'hide_field_timer_fa'])->toArray();
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
    public function advance_timer_create(Request $request)
    {
        $valiDate = $this->validate($request, [
            'read_only_timer' => '',
            'hide_field_timer' => '',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->advance()->create([
            'read_only_timer' => $valiDate['read_only_timer'],
            'hide_field_timer' => $valiDate['hide_field_timer'],
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
    public function advance_timer_create_get(Request $request,$read_only_timer,$hide_field_timer,$form_id)
    {
        $valiDate = $this->validate($request, [
            'read_only_timer' => '',
            'hide_field_timer' => '',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->advance()->create([
            'read_only_timer' => $read_only_timer,
            'hide_field_timer' => $hide_field_timer,
            'form_id' => $form_id
        ]);
        return response([
            'data' => [
                'message' => 'form is registered',
            ],
            'status' => 'success',
            'ID' => $y->id
        ]);
    }
    public function advance_timer_create_fa(Request $request,$fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
            'read_only_timer' => '',
            'hide_field_timer' => '',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->advance()->create([
            'read_only_timer' => $valiDate['read_only_timer'],
            'hide_field_timer' => $valiDate['hide_field_timer'],
            'form_id' => $valiDate['form_id']
        ]);
        return response([
            'داده' => [
                'پیام' => 'ثبت شد',
            ],
            'وضعیت' => 'با موفقیت',
            'ID' => $y->id
        ]);
    }
    public function advance_timer_create_get_fa(Request $request,$read_only_timer,$hide_field_timer,$form_id,$fa)
    {

        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
            'read_only_timer' => '',
            'hide_field_timer' => '',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->advance()->create([
            'read_only_timer' => $read_only_timer,
            'hide_field_timer' => $hide_field_timer,
            'form_id' => $form_id
        ]);
        return response([
            'داده' => [
                'پیام' => 'ثبت شد',
            ],
            'وضعیت' => 'با موفقیت',
            'ID' => $y->id
        ]);
    }
    public function advance_timer_show($id)
    {
        $ee= advanced_answerModel::where([['id',$id],['admin_id',auth()->user()->id]])->get(['id','read_only_timer','hide_field_timer']);
        $r= implode(', ',array($ee));
        $t=str_replace('[',' ',$r);
        $e= str_replace(']',' ',$t);
        return $e;
    }
    public function advance_timer_showall($form_id)
    {
        $ee= advanced_answerModel::where([['admin_id',auth()->user()->id],['form_id',$form_id]])->orderby('id','desc')->paginate(5);
        return $ee;
    }
    public function advance_timer_edit(Request $request,$id)
    {
        $valiDate = $this->validate($request, [
            'read_only_timer' => '',
            'hide_field_timer' => '',
        ]);
        $user = advanced_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->read_only_timer = $valiDate['read_only_timer'];
            $user->hide_field_timer = $valiDate['hide_field_timer'];
            if ($user->update()) {
                return response([
                    'data' => [
                        'message' => ' form is register',
                    ],
                    'status' => 'success',
                    'info' => $user
                ]);
            }
        } else {
            return "Id not found";
        }
    }
    public function advance_timer_edit_get(Request $request,$id,$read_only_timer,$hide_field_timer){
        $valiDate = $this->validate($request, [
            'read_only_timer' => '',
            'hide_field_timer' => '',
        ]);
        $user = advanced_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->read_only_timer = $read_only_timer;
            $user->hide_field_timer = $hide_field_timer;
            if ($user->update()) {
                return response([
                    'data' => [
                        'message' => ' form is register',
                    ],
                    'status' => 'success',
                    'info' => $user
                ]);
            }
        } else {
            return "Id not found";
        }
    }
    public function advance_timer_edit_fa(Request $request,$id,$fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
            'read_only_timer' => '',
            'hide_field_timer' => '',
        ]);
        $user = advanced_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->read_only_timer = $valiDate['read_only_timer'];
            $user->hide_field_timer = $valiDate['hide_field_timer'];
            if ($user->update()) {
                return response([
                    'داده' => [
                        'پیام' => ' آپدیت شد',
                    ],
                    'وضعیت' => 'با موفقیت',
                    'اطلاعات' => $user
                ]);
            }
        } else {
            return "پیدا نشد";
        }
    }
    public function advance_timer_edit_get_fa(Request $request,$id,$read_only_timer,$hide_field_timer,$fa){
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
            'read_only_timer' => '',
            'hide_field_timer' => '',
        ]);
        $user = advanced_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->read_only_timer = $read_only_timer;
            $user->hide_field_timer = $hide_field_timer;
            if ($user->update()) {
                return response([
                    'داده' => [
                        'پیام' => ' آپدیت شد',
                    ],
                    'وضعیت' => 'با موفقیت',
                    'اطلاعات' => $user
                ]);
            }
        } else {
            return "پیدا نشد";
        }
    }
    public function advance_timer_delete($id)
    {
        $t = advanced_answerModel::where([['id', $id], ['admin_id', auth()->user()->id]])->delete();
        if ($t) {
            return response([

                'data' => 'delete with successfull'
            ]);
        } else {
            return "id not found";
        }
    }
    public function advance_timer_delete_fa($id, $fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $t = advanced_answerModel::where([['id', $id], ['admin_id', auth()->user()->id]])->delete();
        if ($t) {
            return response([

                'data' => 'کاربر پاک شد',
                'زبان' => $q
            ]);
        } else {
            return "این id وجود ندارد";
        }
    }
    //--------------------------------End advance timer-------------------------------------------
    //--------------------------------start advance short text-------------------------------------------
    public function advance_short_text_show_en()
    {
        $d = advancedModel::where('id', '1')->orderby('id', 'desc')->take(1)
            ->get(['placeholder_short', 'default_value_short','read_only_short','hide_field_short'])->toArray();
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
    public function advance_short_text_show_fa($fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $d = advancedModel::where('id', '1')->orderby('id', 'desc')->take(1)
            ->get(['placeholder_short_fa', 'default_value_short_fa','read_only_short_fa','hide_field_short_fa'])->toArray();
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
    public function advance_short_text_create(Request $request)
    {
        $valiDate = $this->validate($request, [
            'placeholder_short' => '',
            'default_value_short' => '',
            'read_only_short' => '',
            'hide_field_short' => '',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->advance()->create([
            'placeholder_short' => $valiDate['placeholder_short'],
            'default_value_short' => $valiDate['default_value_short'],
            'read_only_short' => $valiDate['read_only_short'],
            'hide_field_short' => $valiDate['hide_field_short'],
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
    public function advance_short_text_create_get(Request $request,$placeholder_short,$default_value_short,$read_only_short,$hide_field_short,$form_id)
    {
        $valiDate = $this->validate($request, [
            'placeholder_short' => '',
            'default_value_short' => '',
            'read_only_short' => '',
            'hide_field_short' => '',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->advance()->create([
            'placeholder_short' => $placeholder_short,
            'default_value_short' => $default_value_short,
            'read_only_short' => $read_only_short,
            'hide_field_short' => $hide_field_short,
            'form_id' => $form_id
        ]);
        return response([
            'data' => [
                'message' => 'form is registered',
            ],
            'status' => 'success',
            'ID' => $y->id
        ]);
    }
    public function advance_short_text_create_fa(Request $request,$fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
            'placeholder_short' => '',
            'default_value_short' => '',
            'read_only_short' => '',
            'hide_field_short' => '',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->advance()->create([
            'placeholder_short' => $valiDate['placeholder_short'],
            'default_value_short' => $valiDate['default_value_short'],
            'read_only_short' => $valiDate['read_only_short'],
            'hide_field_short' => $valiDate['hide_field_short'],
            'form_id' => $valiDate['form_id']
        ]);
        return response([
            'داده' => [
                'پیام' => 'ثبت شد',
            ],
            'وضعیت' => 'با موفقیت',
            'ID' => $y->id
        ]);
    }
    public function advance_short_text_create_get_fa(Request $request,$placeholder_short,$default_value_short,$read_only_short,$hide_field_short,$form_id,$fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
            'placeholder_short' => '',
            'default_value_short' => '',
            'read_only_short' => '',
            'hide_field_short' => '',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->advance()->create([
            'placeholder_short' => $placeholder_short,
            'default_value_short' => $default_value_short,
            'read_only_short' => $read_only_short,
            'hide_field_short' => $hide_field_short,
            'form_id' => $form_id
        ]);
        return response([
            'داده' => [
                'پیام' => 'ثبت شد',
            ],
            'وضعیت' => 'با موفقیت',
            'ID' => $y->id
        ]);
    }
    public function advance_short_text_show($id)
    {
        $ee= advanced_answerModel::where([['id',$id],['admin_id',auth()->user()->id]])->get(['id','placeholder_short','default_value_short','read_only_short','hide_field_short']);
        $r= implode(', ',array($ee));
        $t=str_replace('[',' ',$r);
        $e= str_replace(']',' ',$t);
        return $e;
    }
    public function advance_short_text_showall($form_id)
    {
        $ee= advanced_answerModel::where([['admin_id',auth()->user()->id],['form_id',$form_id]])->orderby('id','desc')->paginate(5);
        return $ee;
    }
    public function advance_short_text_edit(Request $request,$id)
    {
        $valiDate = $this->validate($request, [
            'placeholder_short' => '',
            'default_value_short' => '',
            'read_only_short' => '',
            'hide_field_short' => '',
        ]);
        $user = advanced_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->placeholder_short = $valiDate['placeholder_short'];
            $user->default_value_short = $valiDate['default_value_short'];
            $user->read_only_short = $valiDate['read_only_short'];
            $user->hide_field_short = $valiDate['hide_field_short'];
            if ($user->update()) {
                return response([
                    'data' => [
                        'message' => ' form is register',
                    ],
                    'status' => 'success',
                    'info' => $user
                ]);
            }
        } else {
            return "Id not found";
        }
    }
    public function advance_short_text_edit_get(Request $request,$id,$placeholder_short,$default_value_short,$read_only_short,$hide_field_short){
        $valiDate = $this->validate($request, [
            'placeholder_short' => '',
            'default_value_short' => '',
            'read_only_short' => '',
            'hide_field_short' => '',
        ]);
        $user = advanced_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->placeholder_short = $placeholder_short;
            $user->default_value_short = $default_value_short;
            $user->read_only_short = $read_only_short;
            $user->hide_field_short = $hide_field_short;
            if ($user->update()) {
                return response([
                    'data' => [
                        'message' => ' form is register',
                    ],
                    'status' => 'success',
                    'info' => $user
                ]);
            }
        } else {
            return "Id not found";
        }
    }
    public function advance_short_text_edit_fa(Request $request,$id,$fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
            'placeholder_short' => '',
            'default_value_short' => '',
            'read_only_short' => '',
            'hide_field_short' => '',
        ]);
        $user = advanced_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->placeholder_short = $valiDate['placeholder_short'];
            $user->default_value_short = $valiDate['default_value_short'];
            $user->read_only_short = $valiDate['read_only_short'];
            $user->hide_field_short = $valiDate['hide_field_short'];
            if ($user->update()) {
                return response([
                    'داده' => [
                        'پیام' => ' آپدیت شد',
                    ],
                    'وضعیت' => 'با موفقیت',
                    'اطلاعات' => $user
                ]);
            }
        } else {
            return "پیدا نشد";
        }
    }
    public function advance_short_text_edit_get_fa(Request $request,$id,$placeholder_short,$default_value_short,$read_only_short,$hide_field_short,$fa){
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
            'placeholder_short' => '',
            'default_value_short' => '',
            'read_only_short' => '',
            'hide_field_short' => '',
        ]);
        $user = advanced_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->placeholder_short = $placeholder_short;
            $user->default_value_short = $default_value_short;
            $user->read_only_short = $read_only_short;
            $user->hide_field_short = $hide_field_short;
            if ($user->update()) {
                return response([
                    'داده' => [
                        'پیام' => ' آپدیت شد',
                    ],
                    'وضعیت' => 'با موفقیت',
                    'اطلاعات' => $user
                ]);
            }
        } else {
            return "پیدا نشد";
        }
    }
    public function advance_short_text_delete($id)
    {
        $t = advanced_answerModel::where([['id', $id], ['admin_id', auth()->user()->id]])->delete();
        if ($t) {
            return response([

                'data' => 'delete with successfull'
            ]);
        } else {
            return "id not found";
        }
    }
    public function advance_short_text_delete_fa($id, $fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $t = advanced_answerModel::where([['id', $id], ['admin_id', auth()->user()->id]])->delete();
        if ($t) {
            return response([

                'data' => 'کاربر پاک شد',
                'زبان' => $q
            ]);
        } else {
            return "این id وجود ندارد";
        }
    }
    //--------------------------------End advance short text-------------------------------------------
    //--------------------------------start advance long text-------------------------------------------
    public function advance_long_text_show_en()
    {
        $d = advancedModel::where('id', '1')->orderby('id', 'desc')->take(1)
            ->get(['placeholder_long_text', 'default_value_long_text','ready_only_long_text','hide_field_long_text'])->toArray();
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
    public function advance_long_text_show_fa($fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $d = advancedModel::where('id', '1')->orderby('id', 'desc')->take(1)
            ->get(['placeholder_long_text_fa', 'default_value_long_text_fa','ready_only_long_text_fa','hide_field_long_text_fa'])->toArray();
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
    public function advance_long_text_create(Request $request)
    {
        $valiDate = $this->validate($request, [
            'placeholder_long_text' => '',
            'default_value_long_text' => '',
            'ready_only_long_text' => '',
            'hide_field_long_text' => '',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->advance()->create([
            'placeholder_long_text' => $valiDate['placeholder_long_text'],
            'default_value_long_text' => $valiDate['default_value_long_text'],
            'ready_only_long_text' => $valiDate['ready_only_long_text'],
            'hide_field_long_text' => $valiDate['hide_field_long_text'],
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
    public function advance_long_text_create_get(Request $request,$placeholder_long_text,$default_value_long_text,$ready_only_long_text,$hide_field_long_text,$form_id)
    {
        $valiDate = $this->validate($request, [
            'placeholder_long_text' => '',
            'default_value_long_text' => '',
            'ready_only_long_text' => '',
            'hide_field_long_text' => '',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->advance()->create([
            'placeholder_long_text' => $placeholder_long_text,
            'default_value_long_text' => $default_value_long_text,
            'ready_only_long_text' => $ready_only_long_text,
            'hide_field_long_text' => $hide_field_long_text,
            'form_id' => $form_id
        ]);
        return response([
            'data' => [
                'message' => 'form is registered',
            ],
            'status' => 'success',
            'ID' => $y->id
        ]);
    }
    public function advance_long_text_create_fa(Request $request,$fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
            'placeholder_long_text' => '',
            'default_value_long_text' => '',
            'ready_only_long_text' => '',
            'hide_field_long_text' => '',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->advance()->create([
            'placeholder_long_text' => $valiDate['placeholder_long_text'],
            'default_value_long_text' => $valiDate['default_value_long_text'],
            'ready_only_long_text' => $valiDate['ready_only_long_text'],
            'hide_field_long_text' => $valiDate['hide_field_long_text'],
            'form_id' => $valiDate['form_id']
        ]);
        return response([
            'داده' => [
                'پیام' => 'ثبت شد',
            ],
            'وضعیت' => 'با موفقیت',
            'ID' => $y->id
        ]);
    }
    public function advance_long_text_create_get_fa(Request $request,$placeholder_long_text,$default_value_long_text,$ready_only_long_text,$hide_field_long_text,$form_id,$fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
            'placeholder_long_text' => '',
            'default_value_long_text' => '',
            'ready_only_long_text' => '',
            'hide_field_long_text' => '',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->advance()->create([
            'placeholder_long_text' => $placeholder_long_text,
            'default_value_long_text' => $default_value_long_text,
            'ready_only_long_text' => $ready_only_long_text,
            'hide_field_long_text' => $hide_field_long_text,
            'form_id' => $form_id
        ]);
        return response([
            'داده' => [
                'پیام' => 'ثبت شد',
            ],
            'وضعیت' => 'با موفقیت',
            'ID' => $y->id
        ]);
    }
    public function advance_long_text_show($id)
    {
        $ee= advanced_answerModel::where([['id',$id],['admin_id',auth()->user()->id]])->get(['id','placeholder_long_text','default_value_long_text','ready_only_long_text','hide_field_long_text']);
        $r= implode(', ',array($ee));
        $t=str_replace('[',' ',$r);
        $e= str_replace(']',' ',$t);
        return $e;
    }
    public function advance_long_text_showall($form_id)
    {
        $ee= advanced_answerModel::where([['admin_id',auth()->user()->id],['form_id',$form_id]])->orderby('id','desc')->paginate(5);
        return $ee;
    }
    public function advance_long_text_edit(Request $request,$id)
    {
        $valiDate = $this->validate($request, [
            'placeholder_long_text' => '',
            'default_value_long_text' => '',
            'ready_only_long_text' => '',
            'hide_field_long_text' => '',
        ]);
        $user = advanced_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->placeholder_long_text = $valiDate['placeholder_long_text'];
            $user->default_value_long_text = $valiDate['default_value_long_text'];
            $user->ready_only_long_text = $valiDate['ready_only_long_text'];
            $user->hide_field_long_text = $valiDate['hide_field_long_text'];
            if ($user->update()) {
                return response([
                    'data' => [
                        'message' => ' form is register',
                    ],
                    'status' => 'success',
                    'info' => $user
                ]);
            }
        } else {
            return "Id not found";
        }
    }
    public function advance_long_text_edit_get(Request $request,$id,$placeholder_long_text,$default_value_long_text,$ready_only_long_text,$hide_field_long_text){
        $valiDate = $this->validate($request, [
            'placeholder_long_text' => '',
            'default_value_long_text' => '',
            'ready_only_long_text' => '',
            'hide_field_long_text' => '',
        ]);
        $user = advanced_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->placeholder_long_text = $placeholder_long_text;
            $user->default_value_long_text = $default_value_long_text;
            $user->ready_only_long_text = $ready_only_long_text;
            $user->hide_field_long_text = $hide_field_long_text;
            if ($user->update()) {
                return response([
                    'data' => [
                        'message' => ' form is register',
                    ],
                    'status' => 'success',
                    'info' => $user
                ]);
            }
        } else {
            return "Id not found";
        }
    }
    public function advance_long_text_edit_fa(Request $request,$id,$fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
            'placeholder_long_text' => '',
            'default_value_long_text' => '',
            'ready_only_long_text' => '',
            'hide_field_long_text' => '',
        ]);
        $user = advanced_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->placeholder_long_text = $valiDate['placeholder_long_text'];
            $user->default_value_long_text = $valiDate['default_value_long_text'];
            $user->ready_only_long_text = $valiDate['ready_only_long_text'];
            $user->hide_field_long_text = $valiDate['hide_field_long_text'];
            if ($user->update()) {
                return response([
                    'داده' => [
                        'پیام' => ' آپدیت شد',
                    ],
                    'وضعیت' => 'با موفقیت',
                    'اطلاعات' => $user
                ]);
            }
        } else {
            return "پیدا نشد";
        }
    }
    public function advance_long_text_edit_get_fa(Request $request,$id,$placeholder_long_text,$default_value_long_text,$ready_only_long_text,$hide_field_long_text,$fa){
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
            'placeholder_long_text' => '',
            'default_value_long_text' => '',
            'ready_only_long_text' => '',
            'hide_field_long_text' => '',
        ]);
        $user = advanced_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->placeholder_long_text = $placeholder_long_text;
            $user->default_value_long_text = $default_value_long_text;
            $user->ready_only_long_text = $ready_only_long_text;
            $user->hide_field_long_text = $hide_field_long_text;
            if ($user->update()) {
                return response([
                    'داده' => [
                        'پیام' => ' آپدیت شد',
                    ],
                    'وضعیت' => 'با موفقیت',
                    'اطلاعات' => $user
                ]);
            }
        } else {
            return "پیدا نشد";
        }
    }
    public function advance_long_text_delete($id)
    {
        $t = advanced_answerModel::where([['id', $id], ['admin_id', auth()->user()->id]])->delete();
        if ($t) {
            return response([

                'data' => 'delete with successfull'
            ]);
        } else {
            return "id not found";
        }
    }
    public function advance_long_text_delete_fa($id, $fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $t = advanced_answerModel::where([['id', $id], ['admin_id', auth()->user()->id]])->delete();
        if ($t) {
            return response([

                'data' => 'کاربر پاک شد',
                'زبان' => $q
            ]);
        } else {
            return "این id وجود ندارد";
        }
    }
    //--------------------------------End advance long text-------------------------------------------
    //--------------------------------start advance  text-------------------------------------------
    public function advance_text_show_en()
    {
        $d = advancedModel::where('id', '1')->orderby('id', 'desc')->take(1)
            ->get(['hidefield'])->toArray();
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
    public function advance_text_show_fa($fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $d = advancedModel::where('id', '1')->orderby('id', 'desc')->take(1)
            ->get(['hidefield_fa'])->toArray();
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
    public function advance_text_create(Request $request)
    {
        $valiDate = $this->validate($request, [
            'hide_field_text' => '',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->advance()->create([
            'hide_field_text' => $valiDate['hide_field_text'],
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
    public function advance_text_create_get(Request $request,$hide_field_text,$form_id)
    {
        $valiDate = $this->validate($request, [
            'hide_field_text' => '',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->advance()->create([
            'placeholder_long_text' => $hide_field_text,
            'form_id' => $form_id
        ]);
        return response([
            'data' => [
                'message' => 'form is registered',
            ],
            'status' => 'success',
            'ID' => $y->id
        ]);
    }
    public function advance_text_create_fa(Request $request,$fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
            'hide_field_text' => '',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->advance()->create([
            'hide_field_text' => $valiDate['hide_field_text'],
            'form_id' => $valiDate['form_id']
        ]);
        return response([
            'داده' => [
                'پیام' => 'ثبت شد',
            ],
            'وضعیت' => 'با موفقیت',
            'ID' => $y->id
        ]);
    }
    public function advance_text_create_get_fa(Request $request,$hide_field_text,$form_id,$fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
            'hide_field_text' => '',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->advance()->create([
            'hide_field_text' => $hide_field_text,
            'form_id' => $form_id
        ]);
        return response([
            'داده' => [
                'پیام' => 'ثبت شد',
            ],
            'وضعیت' => 'با موفقیت',
            'ID' => $y->id
        ]);
    }
    public function advance_text_show($id)
    {
        $ee= advanced_answerModel::where([['id',$id],['admin_id',auth()->user()->id]])->get(['id','hide_field_text']);
        $r= implode(', ',array($ee));
        $t=str_replace('[',' ',$r);
        $e= str_replace(']',' ',$t);
        return $e;
    }
    public function advance_text_showall($form_id)
    {
        $ee= advanced_answerModel::where([['admin_id',auth()->user()->id],['form_id',$form_id]])->orderby('id','desc')->paginate(5);
        return $ee;
    }
    public function advance_text_edit(Request $request,$id)
    {
        $valiDate = $this->validate($request, [
            'hide_field_text' => '',
        ]);
        $user = advanced_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->hide_field_text = $valiDate['hide_field_text'];
            if ($user->update()) {
                return response([
                    'data' => [
                        'message' => ' form is register',
                    ],
                    'status' => 'success',
                    'info' => $user
                ]);
            }
        } else {
            return "Id not found";
        }
    }
    public function advance_text_edit_get(Request $request,$id,$hide_field_text){
        $valiDate = $this->validate($request, [
            'hide_field_text' => '',
        ]);
        $user = advanced_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->hide_field_text = $hide_field_text;
            if ($user->update()) {
                return response([
                    'data' => [
                        'message' => ' form is register',
                    ],
                    'status' => 'success',
                    'info' => $user
                ]);
            }
        } else {
            return "Id not found";
        }
    }
    public function advance_text_edit_fa(Request $request,$id,$fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
            'hide_field_text' => '',
        ]);
        $user = advanced_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->hide_field_text = $valiDate['hide_field_text'];
            if ($user->update()) {
                return response([
                    'داده' => [
                        'پیام' => ' آپدیت شد',
                    ],
                    'وضعیت' => 'با موفقیت',
                    'اطلاعات' => $user
                ]);
            }
        } else {
            return "پیدا نشد";
        }
    }
    public function advance_text_edit_get_fa(Request $request,$id,$hide_field_text,$fa){
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
            'hide_field_text' => '',
        ]);
        $user = advanced_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->hide_field_text = $hide_field_text;
            if ($user->update()) {
                return response([
                    'داده' => [
                        'پیام' => ' آپدیت شد',
                    ],
                    'وضعیت' => 'با موفقیت',
                    'اطلاعات' => $user
                ]);
            }
        } else {
            return "پیدا نشد";
        }
    }
    public function advance_text_delete($id)
    {
        $t = advanced_answerModel::where([['id', $id], ['admin_id', auth()->user()->id]])->delete();
        if ($t) {
            return response([

                'data' => 'delete with successfull'
            ]);
        } else {
            return "id not found";
        }
    }
    public function advance_text_delete_fa($id, $fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $t = advanced_answerModel::where([['id', $id], ['admin_id', auth()->user()->id]])->delete();
        if ($t) {
            return response([

                'data' => 'کاربر پاک شد',
                'زبان' => $q
            ]);
        } else {
            return "این id وجود ندارد";
        }
    }
    //--------------------------------End advance text-------------------------------------------
    //--------------------------------start advance dropdown-------------------------------------------
    public function advance_dropdown_show_en()
    {
        $d = advancedModel::where('id', '1')->orderby('id', 'desc')->take(1)
            ->get(['multiple_select','shuffle_option','hidefield'])->toArray();
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
    public function advance_dropdown_show_fa($fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $d = advancedModel::where('id', '1')->orderby('id', 'desc')->take(1)
            ->get(['multiple_select_fa','shuffle_option_fa','hidefield_fa'])->toArray();
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
    public function advance_dropdown_create(Request $request)
    {
        $valiDate = $this->validate($request, [
            'multiple_select' => '',
            'shuffle_option' => '',
            'hide_field_dropdown' => '',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->advance()->create([
            'multiple_select' => $valiDate['multiple_select'],
            'shuffle_option' => $valiDate['shuffle_option'],
            'hide_field_dropdown' => $valiDate['hide_field_dropdown'],
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
    public function advance_dropdown_create_get(Request $request,$multiple_select,$shuffle_option,$hide_field_dropdown,$form_id)
    {
        $valiDate = $this->validate($request, [
            'multiple_select' => '',
            'shuffle_option' => '',
            'hide_field_dropdown' => '',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->advance()->create([
            'multiple_select' => $multiple_select,
            'shuffle_option' => $shuffle_option,
            'hide_field_dropdown' => $hide_field_dropdown,
            'form_id' => $form_id
        ]);
        return response([
            'data' => [
                'message' => 'form is registered',
            ],
            'status' => 'success',
            'ID' => $y->id
        ]);
    }
    public function advance_dropdown_create_fa(Request $request,$fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
            'multiple_select' => '',
            'shuffle_option' => '',
            'hide_field_dropdown' => '',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->advance()->create([
            'multiple_select' => $valiDate['multiple_select'],
            'shuffle_option' => $valiDate['shuffle_option'],
            'hide_field_dropdown' => $valiDate['hide_field_dropdown'],
            'form_id' => $valiDate['form_id']
        ]);
        return response([
            'داده' => [
                'پیام' => 'ثبت شد',
            ],
            'وضعیت' => 'با موفقیت',
            'ID' => $y->id
        ]);
    }
    public function advance_dropdown_create_get_fa(Request $request,$multiple_select,$shuffle_option,$hide_field_dropdown,$form_id,$fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
            'multiple_select' => '',
            'shuffle_option' => '',
            'hide_field_dropdown' => '',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->advance()->create([
            'multiple_select' => $multiple_select,
            'shuffle_option' => $shuffle_option,
            'hide_field_dropdown' => $hide_field_dropdown,
            'form_id' => $form_id
        ]);
        return response([
            'داده' => [
                'پیام' => 'ثبت شد',
            ],
            'وضعیت' => 'با موفقیت',
            'ID' => $y->id
        ]);
    }
    public function advance_dropdown_show($id)
    {
        $ee= advanced_answerModel::where([['id',$id],['admin_id',auth()->user()->id]])->get(['id', 'multiple_select', 'shuffle_option', 'hide_field_dropdown']);
        $r= implode(', ',array($ee));
        $t=str_replace('[',' ',$r);
        $e= str_replace(']',' ',$t);
        return $e;
    }
    public function advance_dropdown_showall($form_id)
    {
        $ee= advanced_answerModel::where([['admin_id',auth()->user()->id],['form_id',$form_id]])->orderby('id','desc')->paginate(5);
        return $ee;
    }
    public function advance_dropdown_edit(Request $request,$id)
    {
        $valiDate = $this->validate($request, [
            'multiple_select' => '',
            'shuffle_option' => '',
            'hide_field_dropdown' => '',
        ]);
        $user = advanced_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->multiple_select = $valiDate['multiple_select'];
            $user->shuffle_option = $valiDate['shuffle_option'];
            $user->hide_field_dropdown = $valiDate['hide_field_dropdown'];
            if ($user->update()) {
                return response([
                    'data' => [
                        'message' => ' form is register',
                    ],
                    'status' => 'success',
                    'info' => $user
                ]);
            }
        } else {
            return "Id not found";
        }
    }
    public function advance_dropdown_edit_get(Request $request,$id,$multiple_select,$shuffle_option,$hide_field_dropdown){
        $valiDate = $this->validate($request, [
            'multiple_select' => '',
            'shuffle_option' => '',
            'hide_field_dropdown' => '',
        ]);
        $user = advanced_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->multiple_select = $multiple_select;
            $user->shuffle_option = $shuffle_option;
            $user->hide_field_dropdown = $hide_field_dropdown;
            if ($user->update()) {
                return response([
                    'data' => [
                        'message' => ' form is register',
                    ],
                    'status' => 'success',
                    'info' => $user
                ]);
            }
        } else {
            return "Id not found";
        }
    }
    public function advance_dropdown_edit_fa(Request $request,$id,$fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
            'multiple_select' => '',
            'shuffle_option' => '',
            'hide_field_dropdown' => '',
        ]);
        $user = advanced_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->multiple_select = $valiDate['multiple_select'];
            $user->shuffle_option = $valiDate['shuffle_option'];
            $user->hide_field_dropdown = $valiDate['hide_field_dropdown'];
            if ($user->update()) {
                return response([
                    'داده' => [
                        'پیام' => ' آپدیت شد',
                    ],
                    'وضعیت' => 'با موفقیت',
                    'اطلاعات' => $user
                ]);
            }
        } else {
            return "پیدا نشد";
        }
    }
    public function advance_dropdown_edit_get_fa(Request $request,$id,$multiple_select,$shuffle_option,$hide_field_dropdown,$fa){
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
            'multiple_select' => '',
            'shuffle_option' => '',
            'hide_field_dropdown' => '',
        ]);
        $user = advanced_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->multiple_select = $multiple_select;
            $user->shuffle_option = $shuffle_option;
            $user->hide_field_dropdown = $hide_field_dropdown;
            if ($user->update()) {
                return response([
                    'داده' => [
                        'پیام' => ' آپدیت شد',
                    ],
                    'وضعیت' => 'با موفقیت',
                    'اطلاعات' => $user
                ]);
            }
        } else {
            return "پیدا نشد";
        }
    }
    public function advance_dropdown_delete($id)
    {
        $t = advanced_answerModel::where([['id', $id], ['admin_id', auth()->user()->id]])->delete();
        if ($t) {
            return response([

                'data' => 'delete with successfull'
            ]);
        } else {
            return "id not found";
        }
    }
    public function advance_dropdown_delete_fa($id, $fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $t = advanced_answerModel::where([['id', $id], ['admin_id', auth()->user()->id]])->delete();
        if ($t) {
            return response([

                'data' => 'کاربر پاک شد',
                'زبان' => $q
            ]);
        } else {
            return "این id وجود ندارد";
        }
    }
    //--------------------------------End advance dropdown-------------------------------------------
    //--------------------------------start advance single choice-------------------------------------------
    public function advance_single_choice_show_en()
    {
        $d = advancedModel::where('id', '1')->orderby('id', 'desc')->take(1)
            ->get(['select_by_default','readonly','hidefield'])->toArray();
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
    public function advance_single_choice_show_fa($fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $d = advancedModel::where('id', '1')->orderby('id', 'desc')->take(1)
            ->get(['select_by_default_fa','readonly_fa','hidefield_fa'])->toArray();
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
    public function advance_single_choice_create(Request $request)
    {
        $valiDate = $this->validate($request, [
            'select_by_default' => '',
            'readonly_single_choice' => '',
            'hidefield_single_choice' => '',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->advance()->create([
            'select_by_default' => $valiDate['select_by_default'],
            'readonly_single_choice' => $valiDate['readonly_single_choice'],
            'hidefield_single_choice' => $valiDate['hidefield_single_choice'],
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
    public function advance_single_choice_create_get(Request $request,$select_by_default,$readonly_single_choice,$hidefield_single_choice,$form_id)
    {
        $valiDate = $this->validate($request, [
            'select_by_default' => '',
            'readonly_single_choice' => '',
            'hidefield_single_choice' => '',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->advance()->create([
            'select_by_default' => $select_by_default,
            'readonly_single_choice' => $readonly_single_choice,
            'hidefield_single_choice' => $hidefield_single_choice,
            'form_id' => $form_id
        ]);
        return response([
            'data' => [
                'message' => 'form is registered',
            ],
            'status' => 'success',
            'ID' => $y->id
        ]);
    }
    public function advance_single_choice_create_fa(Request $request,$fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
            'select_by_default' => '',
            'readonly_single_choice' => '',
            'hidefield_single_choice' => '',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->advance()->create([
            'select_by_default' => $valiDate['select_by_default'],
            'readonly_single_choice' => $valiDate['readonly_single_choice'],
            'hidefield_single_choice' => $valiDate['hidefield_single_choice'],
            'form_id' => $valiDate['form_id']
        ]);
        return response([
            'داده' => [
                'پیام' => 'ثبت شد',
            ],
            'وضعیت' => 'با موفقیت',
            'ID' => $y->id
        ]);
    }
    public function advance_single_choice_create_get_fa(Request $request,$select_by_default,$readonly_single_choice,$hidefield_single_choice,$form_id,$fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
            'select_by_default' => '',
            'readonly_single_choice' => '',
            'hidefield_single_choice' => '',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->advance()->create([
            'select_by_default' => $select_by_default,
            'readonly_single_choice' => $readonly_single_choice,
            'hidefield_single_choice' => $hidefield_single_choice,
            'form_id' => $form_id
        ]);
        return response([
            'داده' => [
                'پیام' => 'ثبت شد',
            ],
            'وضعیت' => 'با موفقیت',
            'ID' => $y->id
        ]);
    }
    public function advance_single_choice_show($id)
    {
        $ee= advanced_answerModel::where([['id',$id],['admin_id',auth()->user()->id]])->get(['id', 'multiple_select', 'shuffle_option', 'hide_field_dropdown']);
        $r= implode(', ',array($ee));
        $t=str_replace('[',' ',$r);
        $e= str_replace(']',' ',$t);
        return $e;
    }
    public function advance_single_choice_showall($form_id)
    {
        $ee= advanced_answerModel::where([['admin_id',auth()->user()->id],['form_id',$form_id]])->orderby('id','desc')->paginate(5);
        return $ee;
    }
    public function advance_single_choice_edit(Request $request,$id)
    {
        $valiDate = $this->validate($request, [
            'select_by_default' => '',
            'readonly_single_choice' => '',
            'hidefield_single_choice' => '',
        ]);
        $user = advanced_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->select_by_default = $valiDate['select_by_default'];
            $user->readonly_single_choice = $valiDate['readonly_single_choice'];
            $user->hidefield_single_choice = $valiDate['hidefield_single_choice'];
            if ($user->update()) {
                return response([
                    'data' => [
                        'message' => ' form is register',
                    ],
                    'status' => 'success',
                    'info' => $user
                ]);
            }
        } else {
            return "Id not found";
        }
    }
    public function advance_single_choice_edit_get(Request $request,$id,$select_by_default,$readonly_single_choice,$hidefield_single_choice){
        $valiDate = $this->validate($request, [
            'select_by_default' => '',
            'readonly_single_choice' => '',
            'hidefield_single_choice' => '',
        ]);
        $user = advanced_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->select_by_default = $select_by_default;
            $user->readonly_single_choice = $readonly_single_choice;
            $user->hidefield_single_choice = $hidefield_single_choice;
            if ($user->update()) {
                return response([
                    'data' => [
                        'message' => ' form is register',
                    ],
                    'status' => 'success',
                    'info' => $user
                ]);
            }
        } else {
            return "Id not found";
        }
    }
    public function advance_single_choice_edit_fa(Request $request,$id,$fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
            'select_by_default' => '',
            'readonly_single_choice' => '',
            'hidefield_single_choice' => '',
        ]);
        $user = advanced_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->select_by_default = $valiDate['select_by_default'];
            $user->readonly_single_choice = $valiDate['readonly_single_choice'];
            $user->hidefield_single_choice = $valiDate['hidefield_single_choice'];
            if ($user->update()) {
                return response([
                    'داده' => [
                        'پیام' => ' آپدیت شد',
                    ],
                    'وضعیت' => 'با موفقیت',
                    'اطلاعات' => $user
                ]);
            }
        } else {
            return "پیدا نشد";
        }
    }
    public function advance_single_choice_edit_get_fa(Request $request,$id,$select_by_default,$readonly_single_choice,$hidefield_single_choice,$fa){
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
            'select_by_default' => '',
            'readonly_single_choice' => '',
            'hidefield_single_choice' => '',
        ]);
        $user = advanced_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->select_by_default = $select_by_default;
            $user->readonly_single_choice = $readonly_single_choice;
            $user->hidefield_single_choice = $hidefield_single_choice;
            if ($user->update()) {
                return response([
                    'داده' => [
                        'پیام' => ' آپدیت شد',
                    ],
                    'وضعیت' => 'با موفقیت',
                    'اطلاعات' => $user
                ]);
            }
        } else {
            return "پیدا نشد";
        }
    }
    public function advance_single_choice_delete($id)
    {
        $t = advanced_answerModel::where([['id', $id], ['admin_id', auth()->user()->id]])->delete();
        if ($t) {
            return response([

                'data' => 'delete with successfull'
            ]);
        } else {
            return "id not found";
        }
    }
    public function advance_single_choice_delete_fa($id, $fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $t = advanced_answerModel::where([['id', $id], ['admin_id', auth()->user()->id]])->delete();
        if ($t) {
            return response([

                'data' => 'کاربر پاک شد',
                'زبان' => $q
            ]);
        } else {
            return "این id وجود ندارد";
        }
    }
    //--------------------------------End advance single choice-------------------------------------------
    //--------------------------------start advance multiple choice-------------------------------------------
    public function advance_multiple_choice_show_en()
    {
        $d = advancedModel::where('id', '1')->orderby('id', 'desc')->take(1)
            ->get(['select_by_default','readonly','hidefield'])->toArray();
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
    public function advance_multiple_choice_show_fa($fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $d = advancedModel::where('id', '1')->orderby('id', 'desc')->take(1)
            ->get(['select_by_default_fa','readonly_fa','hidefield_fa'])->toArray();
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
    public function advance_multiple_choice_create(Request $request)
    {
        $valiDate = $this->validate($request, [
            'select_by_default_multi' => '',
            'ready_only_multi' => '',
            'hide_field_multi' => '',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->advance()->create([
            'select_by_default_multi' => $valiDate['select_by_default_multi'],
            'ready_only_multi' => $valiDate['ready_only_multi'],
            'hide_field_multi' => $valiDate['hide_field_multi'],
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
    public function advance_multiple_choice_create_get(Request $request,$select_by_default_multi,$ready_only_multi,$hide_field_multi,$form_id)
    {
        $valiDate = $this->validate($request, [
            'select_by_default_multi' => '',
            'ready_only_multi' => '',
            'hide_field_multi' => '',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->advance()->create([
            'select_by_default_multi' => $select_by_default_multi,
            'ready_only_multi' => $ready_only_multi,
            'hide_field_multi' => $hide_field_multi,
            'form_id' => $form_id
        ]);
        return response([
            'data' => [
                'message' => 'form is registered',
            ],
            'status' => 'success',
            'ID' => $y->id
        ]);
    }
    public function advance_multiple_choice_create_fa(Request $request,$fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
            'select_by_default_multi' => '',
            'ready_only_multi' => '',
            'hide_field_multi' => '',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->advance()->create([
            'select_by_default_multi' => $valiDate['select_by_default_multi'],
            'ready_only_multi' => $valiDate['ready_only_multi'],
            'hide_field_multi' => $valiDate['hide_field_multi'],
            'form_id' => $valiDate['form_id']
        ]);
        return response([
            'داده' => [
                'پیام' => 'ثبت شد',
            ],
            'وضعیت' => 'با موفقیت',
            'ID' => $y->id
        ]);
    }
    public function advance_multiple_choice_create_get_fa(Request $request,$select_by_default_multi,$ready_only_multi,$hide_field_multi,$form_id,$fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
            'select_by_default_multi' => '',
            'ready_only_multi' => '',
            'hide_field_multi' => '',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->advance()->create([
            'select_by_default_multi' => $select_by_default_multi,
            'ready_only_multi' => $ready_only_multi,
            'hide_field_multi' => $hide_field_multi,
            'form_id' => $form_id
        ]);
        return response([
            'داده' => [
                'پیام' => 'ثبت شد',
            ],
            'وضعیت' => 'با موفقیت',
            'ID' => $y->id
        ]);
    }
    public function advance_multiple_choice_show($id)
    {
        $ee= advanced_answerModel::where([['id',$id],['admin_id',auth()->user()->id]])->get(['id', 'select_by_default_multi', 'ready_only_multi', 'hide_field_multi' ]);
        $r= implode(', ',array($ee));
        $t=str_replace('[',' ',$r);
        $e= str_replace(']',' ',$t);
        return $e;
    }
    public function advance_multiple_choice_showall($form_id)
    {
        $ee= advanced_answerModel::where([['admin_id',auth()->user()->id],['form_id',$form_id]])->orderby('id','desc')->paginate(5);
        return $ee;
    }
    public function advance_multiple_choice_edit(Request $request,$id)
    {
        $valiDate = $this->validate($request, [
            'select_by_default_multi' => '',
            'ready_only_multi' => '',
            'hide_field_multi' => '',
        ]);
        $user = advanced_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->select_by_default_multi = $valiDate['select_by_default_multi'];
            $user->ready_only_multi = $valiDate['ready_only_multi'];
            $user->hide_field_multi = $valiDate['hide_field_multi'];
            if ($user->update()) {
                return response([
                    'data' => [
                        'message' => ' form is register',
                    ],
                    'status' => 'success',
                    'info' => $user
                ]);
            }
        } else {
            return "Id not found";
        }
    }
    public function advance_multiple_choice_edit_get(Request $request,$id,$select_by_default_multi,$ready_only_multi,$hide_field_multi){
        $valiDate = $this->validate($request, [
            'select_by_default_multi' => '',
            'ready_only_multi' => '',
            'hide_field_multi' => '',
        ]);
        $user = advanced_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->select_by_default_multi = $select_by_default_multi;
            $user->ready_only_multi = $ready_only_multi;
            $user->hide_field_multi = $hide_field_multi;
            if ($user->update()) {
                return response([
                    'data' => [
                        'message' => ' form is register',
                    ],
                    'status' => 'success',
                    'info' => $user
                ]);
            }
        } else {
            return "Id not found";
        }
    }
    public function advance_multiple_choice_edit_fa(Request $request,$id,$fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
            'select_by_default_multi' => '',
            'ready_only_multi' => '',
            'hide_field_multi' => '',
        ]);
        $user = advanced_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->select_by_default_multi = $valiDate['select_by_default_multi'];
            $user->ready_only_multi = $valiDate['ready_only_multi'];
            $user->hide_field_multi = $valiDate['hide_field_multi'];
            if ($user->update()) {
                return response([
                    'داده' => [
                        'پیام' => ' آپدیت شد',
                    ],
                    'وضعیت' => 'با موفقیت',
                    'اطلاعات' => $user
                ]);
            }
        } else {
            return "پیدا نشد";
        }
    }
    public function advance_multiple_choice_edit_get_fa(Request $request,$id,$select_by_default_multi,$ready_only_multi,$hide_field_multi,$fa){
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
            'select_by_default_multi' => '',
            'ready_only_multi' => '',
            'hide_field_multi' => '',
        ]);
        $user = advanced_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->select_by_default_multi = $select_by_default_multi;
            $user->ready_only_multi = $ready_only_multi;
            $user->hide_field_multi = $hide_field_multi;
            if ($user->update()) {
                return response([
                    'داده' => [
                        'پیام' => ' آپدیت شد',
                    ],
                    'وضعیت' => 'با موفقیت',
                    'اطلاعات' => $user
                ]);
            }
        } else {
            return "پیدا نشد";
        }
    }
    public function advance_multiple_choice_delete($id)
    {
        $t = advanced_answerModel::where([['id', $id], ['admin_id', auth()->user()->id]])->delete();
        if ($t) {
            return response([

                'data' => 'delete with successfull'
            ]);
        } else {
            return "id not found";
        }
    }
    public function advance_multiple_choice_delete_fa($id, $fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $t = advanced_answerModel::where([['id', $id], ['admin_id', auth()->user()->id]])->delete();
        if ($t) {
            return response([

                'data' => 'کاربر پاک شد',
                'زبان' => $q
            ]);
        } else {
            return "این id وجود ندارد";
        }
    }
    //--------------------------------End advance multiple choice-------------------------------------------
    //--------------------------------start advance image choice-------------------------------------------
    public function advance_image_choice_show_en()
    {
        $d = advancedModel::where('id', '1')->orderby('id', 'desc')->take(1)
            ->get(['readonly','hidefield'])->toArray();
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
    public function advance_image_choice_show_fa($fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $d = advancedModel::where('id', '1')->orderby('id', 'desc')->take(1)
            ->get(['readonly_fa','hidefield_fa'])->toArray();
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
    public function advance_image_choice_create(Request $request)
    {
        $valiDate = $this->validate($request, [
            'ready_only_image' => '',
            'hide_field_image' => '',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->advance()->create([
            'ready_only_image' => $valiDate['ready_only_image'],
            'hide_field_image' => $valiDate['hide_field_image'],
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
    public function advance_image_choice_create_get(Request $request,$ready_only_image,$hide_field_image,$form_id)
    {
        $valiDate = $this->validate($request, [
            'ready_only_image' => '',
            'hide_field_image' => '',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->advance()->create([
            'ready_only_image' => $ready_only_image,
            'hide_field_image' => $hide_field_image,
            'form_id' => $form_id
        ]);
        return response([
            'data' => [
                'message' => 'form is registered',
            ],
            'status' => 'success',
            'ID' => $y->id
        ]);
    }
    public function advance_image_choice_create_fa(Request $request,$fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
            'ready_only_image' => '',
            'hide_field_image' => '',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->advance()->create([
            'ready_only_image' => $valiDate['ready_only_image'],
            'hide_field_image' => $valiDate['hide_field_image'],
            'form_id' => $valiDate['form_id']
        ]);
        return response([
            'داده' => [
                'پیام' => 'ثبت شد',
            ],
            'وضعیت' => 'با موفقیت',
            'ID' => $y->id
        ]);
    }
    public function advance_image_choice_create_get_fa(Request $request,$ready_only_image,$hide_field_image,$form_id,$fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
            'ready_only_image' => '',
            'hide_field_image' => '',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->advance()->create([
            'ready_only_image' => $ready_only_image,
            'hide_field_image' => $hide_field_image,
            'form_id' => $form_id
        ]);
        return response([
            'داده' => [
                'پیام' => 'ثبت شد',
            ],
            'وضعیت' => 'با موفقیت',
            'ID' => $y->id
        ]);
    }
    public function advance_image_choice_show($id)
    {
        $ee= advanced_answerModel::where([['id',$id],['admin_id',auth()->user()->id]])->get(['id',  'ready_only_image', 'hide_field_image']);
        $r= implode(', ',array($ee));
        $t=str_replace('[',' ',$r);
        $e= str_replace(']',' ',$t);
        return $e;
    }
    public function advance_image_choice_showall($form_id)
    {
        $ee= advanced_answerModel::where([['admin_id',auth()->user()->id],['form_id',$form_id]])->orderby('id','desc')->paginate(5);
        return $ee;
    }
    public function advance_image_choice_edit(Request $request,$id)
    {
        $valiDate = $this->validate($request, [
            'ready_only_image' => '',
            'hide_field_image' => '',
        ]);
        $user = advanced_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->ready_only_image = $valiDate['ready_only_image'];
            $user->hide_field_image = $valiDate['hide_field_image'];
            if ($user->update()) {
                return response([
                    'data' => [
                        'message' => ' form is register',
                    ],
                    'status' => 'success',
                    'info' => $user
                ]);
            }
        } else {
            return "Id not found";
        }
    }
    public function advance_image_choice_edit_get(Request $request,$id,$ready_only_image,$hide_field_image){
        $valiDate = $this->validate($request, [
            'ready_only_image' => '',
            'hide_field_image' => '',
        ]);
        $user = advanced_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->ready_only_image = $ready_only_image;
            $user->hide_field_image = $hide_field_image;
            if ($user->update()) {
                return response([
                    'data' => [
                        'message' => ' form is register',
                    ],
                    'status' => 'success',
                    'info' => $user
                ]);
            }
        } else {
            return "Id not found";
        }
    }
    public function advance_image_choice_edit_fa(Request $request,$id,$fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
            'ready_only_image' => '',
            'hide_field_image' => '',
        ]);
        $user = advanced_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->ready_only_image = $valiDate['ready_only_image'];
            $user->hide_field_image = $valiDate['hide_field_image'];
            if ($user->update()) {
                return response([
                    'داده' => [
                        'پیام' => ' آپدیت شد',
                    ],
                    'وضعیت' => 'با موفقیت',
                    'اطلاعات' => $user
                ]);
            }
        } else {
            return "پیدا نشد";
        }
    }
    public function advance_image_choice_edit_get_fa(Request $request,$id,$ready_only_image,$hide_field_image,$fa){
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
            'ready_only_image' => '',
            'hide_field_image' => '',
        ]);
        $user = advanced_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->ready_only_image = $ready_only_image;
            $user->hide_field_image = $hide_field_image;
            if ($user->update()) {
                return response([
                    'داده' => [
                        'پیام' => ' آپدیت شد',
                    ],
                    'وضعیت' => 'با موفقیت',
                    'اطلاعات' => $user
                ]);
            }
        } else {
            return "پیدا نشد";
        }
    }
    public function advance_image_choice_delete($id)
    {
        $t = advanced_answerModel::where([['id', $id], ['admin_id', auth()->user()->id]])->delete();
        if ($t) {
            return response([

                'data' => 'delete with successfull'
            ]);
        } else {
            return "id not found";
        }
    }
    public function advance_image_choice_delete_fa($id, $fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $t = advanced_answerModel::where([['id', $id], ['admin_id', auth()->user()->id]])->delete();
        if ($t) {
            return response([

                'data' => 'کاربر پاک شد',
                'زبان' => $q
            ]);
        } else {
            return "این id وجود ندارد";
        }
    }
    //--------------------------------End advance image choice-------------------------------------------
    //--------------------------------start advance number-------------------------------------------
    public function advance_number_show_en()
    {
        $d = advancedModel::where('id', '1')->orderby('id', 'desc')->take(1)
            ->get(['placeholder','default_value','readonly','hidefield'])->toArray();
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
    public function advance_number_show_fa($fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $d = advancedModel::where('id', '1')->orderby('id', 'desc')->take(1)
            ->get(['placeholder_fa','default_value_fa','readonly_fa','hidefield_fa'])->toArray();
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
    public function advance_number_create(Request $request)
    {
        $valiDate = $this->validate($request, [
            'placeholder_number' => '',
            'default_value_number' => '',
            'readonly_number' => '',
            'hidefield_number' => '',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->advance()->create([
            'placeholder_number' => $valiDate['placeholder_number'],
            'default_value_number' => $valiDate['default_value_number'],
            'readonly_number' => $valiDate['readonly_number'],
            'hidefield_number' => $valiDate['hidefield_number'],
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
    public function advance_number_create_get(Request $request,$placeholder,$default_value,$readonly,$hidefield,$form_id)
    {
        $valiDate = $this->validate($request, [
            'placeholder_number' => '',
            'default_value_number' => '',
            'readonly_number' => '',
            'hidefield_number' => '',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->advance()->create([
            'placeholder_number' => $placeholder,
            'default_value_number' => $default_value,
            'readonly_number' => $readonly,
            'hidefield_number' => $hidefield,
            'form_id' => $form_id
        ]);
        return response([
            'data' => [
                'message' => 'form is registered',
            ],
            'status' => 'success',
            'ID' => $y->id
        ]);
    }
    public function advance_number_create_fa(Request $request,$fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
            'placeholder_number' => '',
            'default_value_number' => '',
            'readonly_number' => '',
            'hidefield_number' => '',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->advance()->create([
            'placeholder_number' => $valiDate['placeholder_number'],
            'default_value_number' => $valiDate['default_value_number'],
            'readonly_number' => $valiDate['readonly_number'],
            'hidefield_number' => $valiDate['hidefield_number'],
            'form_id' => $valiDate['form_id']
        ]);
        return response([
            'داده' => [
                'پیام' => 'ثبت شد',
            ],
            'وضعیت' => 'با موفقیت',
            'ID' => $y->id
        ]);
    }
    public function advance_number_create_get_fa(Request $request,$placeholder,$default_value,$readonly,$hidefield,$form_id,$fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
            'placeholder_number' => '',
            'default_value_number' => '',
            'readonly_number' => '',
            'hidefield_number' => '',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->advance()->create([
            'placeholder_number' => $placeholder,
            'default_value_number' => $default_value,
            'readonly_number' => $readonly,
            'hidefield_number' => $hidefield,
            'form_id' => $form_id
        ]);
        return response([
            'داده' => [
                'پیام' => 'ثبت شد',
            ],
            'وضعیت' => 'با موفقیت',
            'ID' => $y->id
        ]);
    }
    public function advance_number_show($id)
    {
        $ee= advanced_answerModel::where([['id',$id],['admin_id',auth()->user()->id]])->get(['id',  'placeholder' , 'default_value' , 'readonly', 'hidefield' ]);
        $r= implode(', ',array($ee));
        $t=str_replace('[',' ',$r);
        $e= str_replace(']',' ',$t);
        return $e;
    }
    public function advance_number_showall($form_id)
    {
        $ee= advanced_answerModel::where([['admin_id',auth()->user()->id],['form_id',$form_id]])->orderby('id','desc')->paginate(5);
        return $ee;
    }
    public function advance_number_edit(Request $request,$id)
    {
        $valiDate = $this->validate($request, [
            'placeholder_number' => '',
            'default_value_number' => '',
            'readonly_number' => '',
            'hidefield_number' => '',
        ]);
        $user = advanced_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->placeholder_number = $valiDate['placeholder_number'];
            $user->default_value_number = $valiDate['default_value_number'];
            $user->readonly_number = $valiDate['readonly_number'];
            $user->hidefield_number = $valiDate['hidefield_number'];
            if ($user->update()) {
                return response([
                    'data' => [
                        'message' => ' form is register',
                    ],
                    'status' => 'success',
                    'info' => $user
                ]);
            }
        } else {
            return "Id not found";
        }
    }
    public function advance_number_edit_get(Request $request,$id,$placeholder,$default_value,$readonly,$hidefield){
        $valiDate = $this->validate($request, [
            'placeholder_number' => '',
            'default_value_number' => '',
            'readonly_number' => '',
            'hidefield_number' => '',
        ]);
        $user = advanced_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->placeholder_number = $placeholder;
            $user->default_value_number = $default_value;
            $user->readonly_number = $readonly;
            $user->hidefield_number = $hidefield;
            if ($user->update()) {
                return response([
                    'data' => [
                        'message' => ' form is register',
                    ],
                    'status' => 'success',
                    'info' => $user
                ]);
            }
        } else {
            return "Id not found";
        }
    }
    public function advance_number_edit_fa(Request $request,$id,$fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
            'placeholder_number' => '',
            'default_value_number' => '',
            'readonly_number' => '',
            'hidefield_number' => '',
        ]);
        $user = advanced_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->placeholder_number = $valiDate['placeholder_number'];
            $user->default_value_number = $valiDate['default_value_number'];
            $user->readonly_number = $valiDate['readonly_number'];
            $user->hidefield_number = $valiDate['hidefield_number'];
            if ($user->update()) {
                return response([
                    'داده' => [
                        'پیام' => ' آپدیت شد',
                    ],
                    'وضعیت' => 'با موفقیت',
                    'اطلاعات' => $user
                ]);
            }
        } else {
            return "پیدا نشد";
        }
    }
    public function advance_number_edit_get_fa(Request $request,$id,$placeholder,$default_value,$readonly,$hidefield,$fa){
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
            'placeholder_number' => '',
            'default_value_number' => '',
            'readonly_number' => '',
            'hidefield_number' => '',
        ]);
        $user = advanced_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->placeholder_number = $placeholder;
            $user->default_value_number = $default_value;
            $user->readonly_number = $readonly;
            $user->hidefield_number = $hidefield;
            if ($user->update()) {
                return response([
                    'داده' => [
                        'پیام' => ' آپدیت شد',
                    ],
                    'وضعیت' => 'با موفقیت',
                    'اطلاعات' => $user
                ]);
            }
        } else {
            return "پیدا نشد";
        }
    }
    public function advance_number_delete($id)
    {
        $t = advanced_answerModel::where([['id', $id], ['admin_id', auth()->user()->id]])->delete();
        if ($t) {
            return response([

                'data' => 'delete with successfull'
            ]);
        } else {
            return "id not found";
        }
    }
    public function advance_number_delete_fa($id, $fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $t = advanced_answerModel::where([['id', $id], ['admin_id', auth()->user()->id]])->delete();
        if ($t) {
            return response([

                'data' => 'کاربر پاک شد',
                'زبان' => $q
            ]);
        } else {
            return "این id وجود ندارد";
        }
    }
    //--------------------------------End advance number-------------------------------------------
    //--------------------------------start advance image-------------------------------------------
    public function advance_image_show_en()
    {
        $d = advancedModel::where('id', '1')->orderby('id', 'desc')->take(1)
            ->get(['alternative_text','link_image','file_reference','hidefield'])->toArray();
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
    public function advance_image_show_fa($fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $d = advancedModel::where('id', '1')->orderby('id', 'desc')->take(1)
            ->get(['alternative_text_fa','link_image_fa','file_reference_fa','hidefield_fa'])->toArray();
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
    public function advance_image_create(Request $request)
    {
        $valiDate = $this->validate($request, [
            'alternative_text' => '',
            'link_image' => '',
            'file_reference' => '',
            'hidefield_image' => '',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->advance()->create([
            'alternative_text' => $valiDate['alternative_text'],
            'link_image' => $valiDate['link_image'],
            'file_reference' => $valiDate['file_reference'],
            'hidefield_image' => $valiDate['hidefield_image'],
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
    public function advance_image_create_get(Request $request,$alternative_text,$link_image,$file_reference,$hidefield_image,$form_id)
    {
        $valiDate = $this->validate($request, [
            'alternative_text' => '',
            'link_image' => '',
            'file_reference' => '',
            'hidefield_image' => '',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->advance()->create([
            'alternative_text' => $alternative_text,
            'link_image' => $link_image,
            'file_reference' => $file_reference,
            'hidefield_image' => $hidefield_image,
            'form_id' => $form_id
        ]);
        return response([
            'data' => [
                'message' => 'form is registered',
            ],
            'status' => 'success',
            'ID' => $y->id
        ]);
    }
    public function advance_image_create_fa(Request $request,$fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
            'alternative_text' => '',
            'link_image' => '',
            'file_reference' => '',
            'hidefield_image' => '',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->advance()->create([
            'alternative_text' => $valiDate['alternative_text'],
            'link_image' => $valiDate['link_image'],
            'file_reference' => $valiDate['file_reference'],
            'hidefield_image' => $valiDate['hidefield_image'],
            'form_id' => $valiDate['form_id']
        ]);
        return response([
            'داده' => [
                'پیام' => 'ثبت شد',
            ],
            'وضعیت' => 'با موفقیت',
            'ID' => $y->id
        ]);
    }
    public function advance_image_create_get_fa(Request $request,$alternative_text,$link_image,$file_reference,$hidefield_image,$form_id,$fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
            'alternative_text' => '',
            'link_image' => '',
            'file_reference' => '',
            'hidefield_image' => '',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->advance()->create([
            'alternative_text' => $alternative_text,
            'link_image' => $link_image,
            'file_reference' => $file_reference,
            'hidefield_image' => $hidefield_image,
            'form_id' => $form_id
        ]);
        return response([
            'داده' => [
                'پیام' => 'ثبت شد',
            ],
            'وضعیت' => 'با موفقیت',
            'ID' => $y->id
        ]);
    }
    public function advance_image_show($id)
    {
        $ee= advanced_answerModel::where([['id',$id],['admin_id',auth()->user()->id]])->get(['id', 'alternative_text' , 'link_image' , 'file_reference' , 'hidefield_image' ]);
        $r= implode(', ',array($ee));
        $t=str_replace('[',' ',$r);
        $e= str_replace(']',' ',$t);
        return $e;
    }
    public function advance_image_showall($form_id)
    {
        $ee= advanced_answerModel::where([['admin_id',auth()->user()->id],['form_id',$form_id]])->orderby('id','desc')->paginate(5);
        return $ee;
    }
    public function advance_image_edit(Request $request,$id)
    {
        $valiDate = $this->validate($request, [
            'alternative_text' => '',
            'link_image' => '',
            'file_reference' => '',
            'hidefield_image' => '',
        ]);
        $user = advanced_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->alternative_text = $valiDate['alternative_text'];
            $user->link_image = $valiDate['link_image'];
            $user->file_reference = $valiDate['file_reference'];
            $user->hidefield_image = $valiDate['hidefield_image'];
            if ($user->update()) {
                return response([
                    'data' => [
                        'message' => ' form is register',
                    ],
                    'status' => 'success',
                    'info' => $user
                ]);
            }
        } else {
            return "Id not found";
        }
    }
    public function advance_image_edit_get(Request $request,$id,$alternative_text,$link_image,$file_reference,$hidefield_image){
        $valiDate = $this->validate($request, [
            'alternative_text' => '',
            'link_image' => '',
            'file_reference' => '',
            'hidefield_image' => '',
        ]);
        $user = advanced_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->alternative_text = $alternative_text;
            $user->link_image = $link_image;
            $user->file_reference = $file_reference;
            $user->hidefield_image = $hidefield_image;
            if ($user->update()) {
                return response([
                    'data' => [
                        'message' => ' form is register',
                    ],
                    'status' => 'success',
                    'info' => $user
                ]);
            }
        } else {
            return "Id not found";
        }
    }
    public function advance_image_edit_fa(Request $request,$id,$fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
            'alternative_text' => '',
            'link_image' => '',
            'file_reference' => '',
            'hidefield_image' => '',
        ]);
        $user = advanced_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->alternative_text = $valiDate['alternative_text'];
            $user->link_image = $valiDate['link_image'];
            $user->file_reference = $valiDate['file_reference'];
            $user->hidefield_image = $valiDate['hidefield_image'];
            if ($user->update()) {
                return response([
                    'داده' => [
                        'پیام' => ' آپدیت شد',
                    ],
                    'وضعیت' => 'با موفقیت',
                    'اطلاعات' => $user
                ]);
            }
        } else {
            return "پیدا نشد";
        }
    }
    public function advance_image_edit_get_fa(Request $request,$id,$alternative_text,$link_image,$file_reference,$hidefield_image,$fa){
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
            'alternative_text' => '',
            'link_image' => '',
            'file_reference' => '',
            'hidefield_image' => '',
        ]);
        $user = advanced_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->alternative_text = $alternative_text;
            $user->link_image = $link_image;
            $user->file_reference = $file_reference;
            $user->hidefield_image = $hidefield_image;
            if ($user->update()) {
                return response([
                    'داده' => [
                        'پیام' => ' آپدیت شد',
                    ],
                    'وضعیت' => 'با موفقیت',
                    'اطلاعات' => $user
                ]);
            }
        } else {
            return "پیدا نشد";
        }
    }
    public function advance_image_delete($id)
    {
        $t = advanced_answerModel::where([['id', $id], ['admin_id', auth()->user()->id]])->delete();
        if ($t) {
            return response([

                'data' => 'delete with successfull'
            ]);
        } else {
            return "id not found";
        }
    }
    public function advance_image_delete_fa($id, $fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $t = advanced_answerModel::where([['id', $id], ['admin_id', auth()->user()->id]])->delete();
        if ($t) {
            return response([

                'data' => 'کاربر پاک شد',
                'زبان' => $q
            ]);
        } else {
            return "این id وجود ندارد";
        }
    }
    //--------------------------------End advance image-------------------------------------------
    //--------------------------------start advance fileupload-------------------------------------------
    public function advance_fileupload_show_en()
    {
        $d = advancedModel::where('id', '1')->orderby('id', 'desc')->take(1)
            ->get(['hidefield'])->toArray();
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
    public function advance_fileupload_show_fa($fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $d = advancedModel::where('id', '1')->orderby('id', 'desc')->take(1)
            ->get(['hidefield_fa'])->toArray();
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
    public function advance_fileupload_create(Request $request)
    {
        $valiDate = $this->validate($request, [
            'hidefield_fileupload' => '',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->advance()->create([
            'hidefield_fileupload' => $valiDate['hidefield_fileupload'],
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
    public function advance_fileupload_create_get(Request $request,$hidefield_fileupload,$form_id)
    {
        $valiDate = $this->validate($request, [
            'hidefield_fileupload' => '',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->advance()->create([
            'hidefield_fileupload' => $hidefield_fileupload,
            'form_id' => $form_id
        ]);
        return response([
            'data' => [
                'message' => 'form is registered',
            ],
            'status' => 'success',
            'ID' => $y->id
        ]);
    }
    public function advance_fileupload_create_fa(Request $request,$fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
            'hidefield_fileupload' => '',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->advance()->create([
            'hidefield_fileupload' => $valiDate['hidefield_fileupload'],
            'form_id' => $valiDate['form_id']
        ]);
        return response([
            'داده' => [
                'پیام' => 'ثبت شد',
            ],
            'وضعیت' => 'با موفقیت',
            'ID' => $y->id
        ]);
    }
    public function advance_fileupload_create_get_fa(Request $request,$hidefield_fileupload,$form_id,$fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
            'hidefield_fileupload' => '',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->advance()->create([
            'hidefield_fileupload' => $hidefield_fileupload,
            'form_id' => $form_id
        ]);
        return response([
            'داده' => [
                'پیام' => 'ثبت شد',
            ],
            'وضعیت' => 'با موفقیت',
            'ID' => $y->id
        ]);
    }
    public function advance_fileupload_show($id)
    {
        $ee= advanced_answerModel::where([['id',$id],['admin_id',auth()->user()->id]])->get(['id', 'hidefield_fileupload' ]);
        $r= implode(', ',array($ee));
        $t=str_replace('[',' ',$r);
        $e= str_replace(']',' ',$t);
        return $e;
    }
    public function advance_fileupload_showall($form_id)
    {
        $ee= advanced_answerModel::where([['admin_id',auth()->user()->id],['form_id',$form_id]])->orderby('id','desc')->paginate(5);
        return $ee;
    }
    public function advance_fileupload_edit(Request $request,$id)
    {
        $valiDate = $this->validate($request, [
            'hidefield_fileupload' => '',
        ]);
        $user = advanced_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->hidefield_fileupload = $valiDate['hidefield_fileupload'];
            if ($user->update()) {
                return response([
                    'data' => [
                        'message' => ' form is register',
                    ],
                    'status' => 'success',
                    'info' => $user
                ]);
            }
        } else {
            return "Id not found";
        }
    }
    public function advance_fileupload_edit_get(Request $request,$id,$hidefield_fileupload){
        $valiDate = $this->validate($request, [
            'hidefield_fileupload' => '',
        ]);
        $user = advanced_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->hidefield_fileupload = $hidefield_fileupload;
            if ($user->update()) {
                return response([
                    'data' => [
                        'message' => ' form is register',
                    ],
                    'status' => 'success',
                    'info' => $user
                ]);
            }
        } else {
            return "Id not found";
        }
    }
    public function advance_fileupload_edit_fa(Request $request,$id,$fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
            'hidefield_fileupload' => '',
        ]);
        $user = advanced_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->hidefield_fileupload = $valiDate['hidefield_fileupload'];
            if ($user->update()) {
                return response([
                    'داده' => [
                        'پیام' => ' آپدیت شد',
                    ],
                    'وضعیت' => 'با موفقیت',
                    'اطلاعات' => $user
                ]);
            }
        } else {
            return "پیدا نشد";
        }
    }
    public function advance_fileupload_edit_get_fa(Request $request,$id,$hidefield_fileupload,$fa){
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
            'hidefield_fileupload' => '',
        ]);
        $user = advanced_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->hidefield_fileupload = $hidefield_fileupload;
            if ($user->update()) {
                return response([
                    'داده' => [
                        'پیام' => ' آپدیت شد',
                    ],
                    'وضعیت' => 'با موفقیت',
                    'اطلاعات' => $user
                ]);
            }
        } else {
            return "پیدا نشد";
        }
    }
    public function advance_fileupload_delete($id)
    {
        $t = advanced_answerModel::where([['id', $id], ['admin_id', auth()->user()->id]])->delete();
        if ($t) {
            return response([

                'data' => 'delete with successfull'
            ]);
        } else {
            return "id not found";
        }
    }
    public function advance_fileupload_delete_fa($id, $fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $t = advanced_answerModel::where([['id', $id], ['admin_id', auth()->user()->id]])->delete();
        if ($t) {
            return response([

                'data' => 'کاربر پاک شد',
                'زبان' => $q
            ]);
        } else {
            return "این id وجود ندارد";
        }
    }
    //--------------------------------End advance fileupload-------------------------------------------
    //--------------------------------start advance input-------------------------------------------
    public function advance_input_table_show_en()
    {
        $d = advancedModel::where('id', '1')->orderby('id', 'desc')->take(1)
            ->get(['hidefield'])->toArray();
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
    public function advance_input_table_show_fa($fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $d = advancedModel::where('id', '1')->orderby('id', 'desc')->take(1)
            ->get(['hidefield_fa'])->toArray();
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
    public function advance_input_table_create(Request $request)
    {
        $valiDate = $this->validate($request, [
            'hidefield_input' => '',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->advance()->create([
            'hidefield_input' => $valiDate['hidefield_input'],
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
    public function advance_input_table_create_get(Request $request,$hidefield_input,$form_id)
    {
        $valiDate = $this->validate($request, [
            'hidefield_input' => '',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->advance()->create([
            'hidefield_fileupload' => $hidefield_input,
            'form_id' => $form_id
        ]);
        return response([
            'data' => [
                'message' => 'form is registered',
            ],
            'status' => 'success',
            'ID' => $y->id
        ]);
    }
    public function advance_input_table_create_fa(Request $request,$fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
            'hidefield_input' => '',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->advance()->create([
            'hidefield_input' => $valiDate['hidefield_input'],
            'form_id' => $valiDate['form_id']
        ]);
        return response([
            'داده' => [
                'پیام' => 'ثبت شد',
            ],
            'وضعیت' => 'با موفقیت',
            'ID' => $y->id
        ]);
    }
    public function advance_input_table_create_get_fa(Request $request,$hidefield_input,$form_id,$fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
            'hidefield_input' => '',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->advance()->create([
            'hidefield_input' => $hidefield_input,
            'form_id' => $form_id
        ]);
        return response([
            'داده' => [
                'پیام' => 'ثبت شد',
            ],
            'وضعیت' => 'با موفقیت',
            'ID' => $y->id
        ]);
    }
    public function advance_input_table_show($id)
    {
        $ee= advanced_answerModel::where([['id',$id],['admin_id',auth()->user()->id]])->get(['id', 'hidefield_input' ]);
        $r= implode(', ',array($ee));
        $t=str_replace('[',' ',$r);
        $e= str_replace(']',' ',$t);
        return $e;
    }
    public function advance_input_table_showall($form_id)
    {
        $ee= advanced_answerModel::where([['admin_id',auth()->user()->id],['form_id',$form_id]])->orderby('id','desc')->paginate(5);
        return $ee;
    }
    public function advance_input_table_edit(Request $request,$id)
    {
        $valiDate = $this->validate($request, [
            'hidefield_input' => '',
        ]);
        $user = advanced_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->hidefield_input = $valiDate['hidefield_input'];
            if ($user->update()) {
                return response([
                    'data' => [
                        'message' => ' form is register',
                    ],
                    'status' => 'success',
                    'info' => $user
                ]);
            }
        } else {
            return "Id not found";
        }
    }
    public function advance_input_table_edit_get(Request $request,$id,$hidefield_input){
        $valiDate = $this->validate($request, [
            'hidefield_input' => '',
        ]);
        $user = advanced_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->hidefield_input = $hidefield_input;
            if ($user->update()) {
                return response([
                    'data' => [
                        'message' => ' form is register',
                    ],
                    'status' => 'success',
                    'info' => $user
                ]);
            }
        } else {
            return "Id not found";
        }
    }
    public function advance_input_table_edit_fa(Request $request,$id,$fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
            'hidefield_input' => '',
        ]);
        $user = advanced_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->hidefield_input = $valiDate['hidefield_input'];
            if ($user->update()) {
                return response([
                    'داده' => [
                        'پیام' => ' آپدیت شد',
                    ],
                    'وضعیت' => 'با موفقیت',
                    'اطلاعات' => $user
                ]);
            }
        } else {
            return "پیدا نشد";
        }
    }
    public function advance_input_table_edit_get_fa(Request $request,$id,$hidefield_input,$fa){
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
            'hidefield_input' => '',
        ]);
        $user = advanced_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->hidefield_input = $hidefield_input;
            if ($user->update()) {
                return response([
                    'داده' => [
                        'پیام' => ' آپدیت شد',
                    ],
                    'وضعیت' => 'با موفقیت',
                    'اطلاعات' => $user
                ]);
            }
        } else {
            return "پیدا نشد";
        }
    }
    public function advance_input_table_delete($id)
    {
        $t = advanced_answerModel::where([['id', $id], ['admin_id', auth()->user()->id]])->delete();
        if ($t) {
            return response([

                'data' => 'delete with successfull'
            ]);
        } else {
            return "id not found";
        }
    }
    public function advance_input_table_delete_fa($id, $fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $t = advanced_answerModel::where([['id', $id], ['admin_id', auth()->user()->id]])->delete();
        if ($t) {
            return response([

                'data' => 'کاربر پاک شد',
                'زبان' => $q
            ]);
        } else {
            return "این id وجود ندارد";
        }
    }
    //--------------------------------End advance input-------------------------------------------
    //--------------------------------start advance emoji-------------------------------------------
    public function advance_emoji_show_en()
    {
        $d = advancedModel::where('id', '1')->orderby('id', 'desc')->take(1)
            ->get(['hidefield'])->toArray();
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
    public function advance_emoji_show_fa($fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $d = advancedModel::where('id', '1')->orderby('id', 'desc')->take(1)
            ->get(['hidefield_fa'])->toArray();
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
    public function advance_emoji_create(Request $request)
    {
        $valiDate = $this->validate($request, [
            'hidefield_emoji' => '',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->advance()->create([
            'hidefield_emoji' => $valiDate['hidefield_emoji'],
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
    public function advance_emoji_create_get(Request $request,$hidefield_emoji,$form_id)
    {
        $valiDate = $this->validate($request, [
            'hidefield_emoji' => '',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->advance()->create([
            'hidefield_emoji' => $hidefield_emoji,
            'form_id' => $form_id
        ]);
        return response([
            'data' => [
                'message' => 'form is registered',
            ],
            'status' => 'success',
            'ID' => $y->id
        ]);
    }
    public function advance_emoji_create_fa(Request $request,$fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
            'hidefield_emoji' => '',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->advance()->create([
            'hidefield_emoji' => $valiDate['hidefield_emoji'],
            'form_id' => $valiDate['form_id']
        ]);
        return response([
            'داده' => [
                'پیام' => 'ثبت شد',
            ],
            'وضعیت' => 'با موفقیت',
            'ID' => $y->id
        ]);
    }
    public function advance_emoji_create_get_fa(Request $request,$hidefield_emoji,$form_id,$fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
            'hidefield_emoji' => '',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->advance()->create([
            'hidefield_emoji' => $hidefield_emoji,
            'form_id' => $form_id
        ]);
        return response([
            'داده' => [
                'پیام' => 'ثبت شد',
            ],
            'وضعیت' => 'با موفقیت',
            'ID' => $y->id
        ]);
    }
    public function advance_emoji_show($id)
    {
        $ee= advanced_answerModel::where([['id',$id],['admin_id',auth()->user()->id]])->get(['id', 'hidefield_emoji' ]);
        $r= implode(', ',array($ee));
        $t=str_replace('[',' ',$r);
        $e= str_replace(']',' ',$t);
        return $e;
    }
    public function advance_emoji_showall($form_id)
    {
        $ee= advanced_answerModel::where([['admin_id',auth()->user()->id],['form_id',$form_id]])->orderby('id','desc')->paginate(5);
        return $ee;
    }
    public function advance_emoji_edit(Request $request,$id)
    {
        $valiDate = $this->validate($request, [
            'hidefield_emoji' => '',
        ]);
        $user = advanced_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->hidefield_emoji = $valiDate['hidefield_emoji'];
            if ($user->update()) {
                return response([
                    'data' => [
                        'message' => ' form is register',
                    ],
                    'status' => 'success',
                    'info' => $user
                ]);
            }
        } else {
            return "Id not found";
        }
    }
    public function advance_emoji_edit_get(Request $request,$id,$hidefield_emoji){
        $valiDate = $this->validate($request, [
            'hidefield_emoji' => '',
        ]);
        $user = advanced_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->hidefield_emoji = $hidefield_emoji;
            if ($user->update()) {
                return response([
                    'data' => [
                        'message' => ' form is register',
                    ],
                    'status' => 'success',
                    'info' => $user
                ]);
            }
        } else {
            return "Id not found";
        }
    }
    public function advance_emoji_edit_fa(Request $request,$id,$fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
            'hidefield_emoji' => '',
        ]);
        $user = advanced_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->hidefield_emoji = $valiDate['hidefield_emoji'];
            if ($user->update()) {
                return response([
                    'داده' => [
                        'پیام' => ' آپدیت شد',
                    ],
                    'وضعیت' => 'با موفقیت',
                    'اطلاعات' => $user
                ]);
            }
        } else {
            return "پیدا نشد";
        }
    }
    public function advance_emoji_edit_get_fa(Request $request,$id,$hidefield_emoji,$fa){
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
            'hidefield_emoji' => '',
        ]);
        $user = advanced_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->hidefield_emoji = $hidefield_emoji;
            if ($user->update()) {
                return response([
                    'داده' => [
                        'پیام' => ' آپدیت شد',
                    ],
                    'وضعیت' => 'با موفقیت',
                    'اطلاعات' => $user
                ]);
            }
        } else {
            return "پیدا نشد";
        }
    }
    public function advance_emoji_delete($id)
    {
        $t = advanced_answerModel::where([['id', $id], ['admin_id', auth()->user()->id]])->delete();
        if ($t) {
            return response([

                'data' => 'delete with successfull'
            ]);
        } else {
            return "id not found";
        }
    }
    public function advance_emoji_delete_fa($id, $fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $t = advanced_answerModel::where([['id', $id], ['admin_id', auth()->user()->id]])->delete();
        if ($t) {
            return response([

                'data' => 'کاربر پاک شد',
                'زبان' => $q
            ]);
        } else {
            return "این id وجود ندارد";
        }
    }
    //--------------------------------End advance emoji-------------------------------------------
    //--------------------------------start advance start-------------------------------------------
    public function advance_Star_Rating_show_en()
    {
        $d = advancedModel::where('id', '1')->orderby('id', 'desc')->take(1)
            ->get(['default_value','hidefield'])->toArray();
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
    public function advance_Star_Rating_show_fa($fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $d = advancedModel::where('id', '1')->orderby('id', 'desc')->take(1)
            ->get(['default_value_fa','hidefield_fa'])->toArray();
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
    public function advance_Star_Rating_create(Request $request)
    {
        $valiDate = $this->validate($request, [
            'default_value_start' => '',
            'hidefield_start' => '',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->advance()->create([
            'default_value_start' => $valiDate['default_value_start'],
            'hidefield_start' => $valiDate['hidefield_start'],
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
    public function advance_Star_Rating_create_get(Request $request,$default_value_start,$hidefield_start,$form_id)
    {
        $valiDate = $this->validate($request, [
            'default_value_start' => '',
            'hidefield_start' => '',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->advance()->create([
            'default_value_start' => $default_value_start,
            'hidefield_start' => $hidefield_start,
            'form_id' => $form_id
        ]);
        return response([
            'data' => [
                'message' => 'form is registered',
            ],
            'status' => 'success',
            'ID' => $y->id
        ]);
    }
    public function advance_Star_Rating_create_fa(Request $request,$fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
            'default_value_start' => '',
            'hidefield_start' => '',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->advance()->create([
            'default_value_start' => $valiDate['default_value_start'],
            'hidefield_start' => $valiDate['hidefield_start'],
            'form_id' => $valiDate['form_id']
        ]);
        return response([
            'داده' => [
                'پیام' => 'ثبت شد',
            ],
            'وضعیت' => 'با موفقیت',
            'ID' => $y->id
        ]);
    }
    public function advance_Star_Rating_create_get_fa(Request $request,$default_value_start,$hidefield_start,$form_id,$fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
            'default_value_start' => '',
            'hidefield_start' => '',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->advance()->create([
            'default_value_start' => $default_value_start,
            'hidefield_start' => $hidefield_start,
            'form_id' => $form_id
        ]);
        return response([
            'داده' => [
                'پیام' => 'ثبت شد',
            ],
            'وضعیت' => 'با موفقیت',
            'ID' => $y->id
        ]);
    }
    public function advance_Star_Rating_show($id)
    {
        $ee= advanced_answerModel::where([['id',$id],['admin_id',auth()->user()->id]])->get(['id','default_value_start','hidefield_start' ]);
        $r= implode(', ',array($ee));
        $t=str_replace('[',' ',$r);
        $e= str_replace(']',' ',$t);
        return $e;
    }
    public function advance_Star_Rating_showall($form_id)
    {
        $ee= advanced_answerModel::where([['admin_id',auth()->user()->id],['form_id',$form_id]])->orderby('id','desc')->paginate(5);
        return $ee;
    }
    public function advance_Star_Rating_edit(Request $request,$id)
    {
        $valiDate = $this->validate($request, [
            'default_value_start' => '',
            'hidefield_start' => '',
        ]);
        $user = advanced_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->default_value_start = $valiDate['default_value_start'];
            $user->hidefield_start = $valiDate['hidefield_start'];
            if ($user->update()) {
                return response([
                    'data' => [
                        'message' => ' form is register',
                    ],
                    'status' => 'success',
                    'info' => $user
                ]);
            }
        } else {
            return "Id not found";
        }
    }
    public function advance_Star_Rating_edit_get(Request $request,$id,$default_value_start,$hidefield_start){
        $valiDate = $this->validate($request, [
            'default_value_start' => '',
            'hidefield_start' => '',
        ]);
        $user = advanced_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->default_value_start = $default_value_start;
            $user->hidefield_start = $hidefield_start;
            if ($user->update()) {
                return response([
                    'data' => [
                        'message' => ' form is register',
                    ],
                    'status' => 'success',
                    'info' => $user
                ]);
            }
        } else {
            return "Id not found";
        }
    }
    public function advance_Star_Rating_edit_fa(Request $request,$id,$fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
            'default_value_start' => '',
            'hidefield_start' => '',
        ]);
        $user = advanced_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->default_value_start = $valiDate['default_value_start'];
            $user->hidefield_start = $valiDate['hidefield_start'];
            if ($user->update()) {
                return response([
                    'داده' => [
                        'پیام' => ' آپدیت شد',
                    ],
                    'وضعیت' => 'با موفقیت',
                    'اطلاعات' => $user
                ]);
            }
        } else {
            return "پیدا نشد";
        }
    }
    public function advance_Star_Rating_edit_get_fa(Request $request,$id,$default_value_start,$hidefield_start,$fa){
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
            'default_value_start' => '',
            'hidefield_start' => '',
        ]);
        $user = advanced_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->default_value_start = $default_value_start;
            $user->hidefield_start = $hidefield_start;
            if ($user->update()) {
                return response([
                    'داده' => [
                        'پیام' => ' آپدیت شد',
                    ],
                    'وضعیت' => 'با موفقیت',
                    'اطلاعات' => $user
                ]);
            }
        } else {
            return "پیدا نشد";
        }
    }
    public function advance_Star_Rating_delete($id)
    {
        $t = advanced_answerModel::where([['id', $id], ['admin_id', auth()->user()->id]])->delete();
        if ($t) {
            return response([

                'data' => 'delete with successfull'
            ]);
        } else {
            return "id not found";
        }
    }
    public function advance_Star_Rating_delete_fa($id, $fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $t = advanced_answerModel::where([['id', $id], ['admin_id', auth()->user()->id]])->delete();
        if ($t) {
            return response([

                'data' => 'کاربر پاک شد',
                'زبان' => $q
            ]);
        } else {
            return "این id وجود ندارد";
        }
    }
    //--------------------------------End advance start-------------------------------------------
    //---------------------------------------------------------------------------------------------------------
    //-------------------------------------------------------------------------------------------------------
    //---------------------------------------------------------------------------------------------------
    //-------------------------------start confirmation email----------------------------
    public function confirmation_email_show_en()
    {
        $d = advancedModel::where('id', '1')->orderby('id', 'desc')->take(1)
            ->get(['confirmation_text_box'])->toArray();
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
    public function confirmation_email_show_fa($fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $d = advancedModel::where('id', '1')->orderby('id', 'desc')->take(1)
            ->get(['confirmation_text_box_fa'])->toArray();
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
    public function confirmation_email_create(Request $request)
    {
        $valiDate = $this->validate($request, [
            'confirmation_text_box' => '',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->advance()->create([
            'confirmation_text_box' => $valiDate['confirmation_text_box'],
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
    public function confirmation_email_create_get(Request $request,$confirmation_text_box,$form_id)
    {
        $valiDate = $this->validate($request, [
            'confirmation_text_box' => '',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->advance()->create([
            'confirmation_text_box' => $confirmation_text_box,
            'form_id' => $form_id
        ]);
        return response([
            'data' => [
                'message' => 'form is registered',
            ],
            'status' => 'success',
            'ID' => $y->id
        ]);
    }
    public function confirmation_email_create_fa(Request $request,$fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
            'confirmation_text_box' => '',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->advance()->create([
            'confirmation_text_box' => $valiDate['confirmation_text_box'],
            'form_id' => $valiDate['form_id']
        ]);
        return response([
            'داده' => [
                'پیام' => 'ثبت شد',
            ],
            'وضعیت' => 'با موفقیت',
            'ID' => $y->id
        ]);
    }
    public function confirmation_email_create_get_fa(Request $request,$confirmation_text_box,$form_id,$fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
            'confirmation_text_box' => '',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->advance()->create([
            'confirmation_text_box' => $confirmation_text_box,
            'form_id' => $form_id
        ]);
        return response([
            'داده' => [
                'پیام' => 'ثبت شد',
            ],
            'وضعیت' => 'با موفقیت',
            'ID' => $y->id
        ]);
    }
    public function confirmation_email_show($id)
    {
        $ee= advanced_answerModel::where([['id',$id],['admin_id',auth()->user()->id]])->get(['id','confirmation_text_box']);
        $r= implode(', ',array($ee));
        $t=str_replace('[',' ',$r);
        $e= str_replace(']',' ',$t);
        return $e;
    }
    public function confirmation_email_showall($form_id)
    {
        $ee= advanced_answerModel::where([['admin_id',auth()->user()->id],['form_id',$form_id]])->orderby('id','desc')->paginate(5);
        return $ee;
    }
    public function confirmation_email_edit(Request $request,$id)
    {
        $valiDate = $this->validate($request, [
            'confirmation_text_box' => '',
        ]);
        $user = advanced_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->confirmation_text_box = $valiDate['confirmation_text_box'];
            if ($user->update()) {
                return response([
                    'data' => [
                        'message' => ' form is register',
                    ],
                    'status' => 'success',
                    'info' => $user
                ]);
            }
        } else {
            return "Id not found";
        }
    }
    public function confirmation_email_edit_get(Request $request,$id,$confirmation_text_box){
        $valiDate = $this->validate($request, [
            'confirmation_text_box' => '',
        ]);
        $user = advanced_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->confirmation_text_box = $confirmation_text_box;
            if ($user->update()) {
                return response([
                    'data' => [
                        'message' => ' form is register',
                    ],
                    'status' => 'success',
                    'info' => $user
                ]);
            }
        } else {
            return "Id not found";
        }
    }
    public function confirmation_email_edit_fa(Request $request,$id,$fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
            'confirmation_text_box' => '',
        ]);
        $user = advanced_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->confirmation_text_box = $valiDate['confirmation_text_box'];
            if ($user->update()) {
                return response([
                    'داده' => [
                        'پیام' => ' آپدیت شد',
                    ],
                    'وضعیت' => 'با موفقیت',
                    'اطلاعات' => $user
                ]);
            }
        } else {
            return "پیدا نشد";
        }
    }
    public function confirmation_email_edit_get_fa(Request $request,$id,$confirmation_text_box,$fa){
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
            'confirmation_text_box' => '',
        ]);
        $user = advanced_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->confirmation_text_box = $confirmation_text_box;
            if ($user->update()) {
                return response([
                    'داده' => [
                        'پیام' => ' آپدیت شد',
                    ],
                    'وضعیت' => 'با موفقیت',
                    'اطلاعات' => $user
                ]);
            }
        } else {
            return "پیدا نشد";
        }
    }
    public function confirmation_email_delete($id)
    {
        $t = advanced_answerModel::where([['id', $id], ['admin_id', auth()->user()->id]])->delete();
        if ($t) {
            return response([

                'data' => 'delete with successfull'
            ]);
        } else {
            return "id not found";
        }
    }
    public function confirmation_email_delete_fa($id, $fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $t = advanced_answerModel::where([['id', $id], ['admin_id', auth()->user()->id]])->delete();
        if ($t) {
            return response([

                'data' => 'کاربر پاک شد',
                'زبان' => $q
            ]);
        } else {
            return "این id وجود ندارد";
        }
    }
    //---------------------------------end confirmation email-----------------------------
    //---------------------------------start time datepicker-----------------------------
    public function time_datepicker_show_en()
    {
        $d = advancedModel::where('id', '1')->orderby('id', 'desc')->take(1)
            ->get(['time_field','minute_stepping','time_format','default_time'])->toArray();
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
    public function time_datepicker_show_fa($fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $d = advancedModel::where('id', '1')->orderby('id', 'desc')->take(1)
            ->get(['time_field_fa','minute_stepping_fa','time_format_fa','default_time_fa'])->toArray();
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
    public function time_datepicker_create(Request $request)
    {
        $valiDate = $this->validate($request, [
            'time_field' => '',
            'minute_stepping' => '',
            'time_format' => '',
            'default_time' => '',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->advance()->create([
            'time_field' => $valiDate['time_field'],
            'minute_stepping' => $valiDate['minute_stepping'],
            'time_format' => $valiDate['time_format'],
            'default_time' => $valiDate['default_time'],
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
    public function time_datepicker_create_get(Request $request,$time_field,$minute_stepping,$time_format,$default_time,$form_id)
    {
        $valiDate = $this->validate($request, [
            'time_field' => '',
            'minute_stepping' => '',
            'time_format' => '',
            'default_time' => '',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->advance()->create([
            'time_field' => $time_field,
            'minute_stepping' => $minute_stepping,
            'time_format' => $time_format,
            'default_time' => $default_time,
            'form_id' => $form_id
        ]);
        return response([
            'data' => [
                'message' => 'form is registered',
            ],
            'status' => 'success',
            'ID' => $y->id
        ]);
    }
    public function time_datepicker_create_fa(Request $request,$fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
            'time_field' => '',
            'minute_stepping' => '',
            'time_format' => '',
            'default_time' => '',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->advance()->create([
            'time_field' => $valiDate['time_field'],
            'minute_stepping' => $valiDate['minute_stepping'],
            'time_format' => $valiDate['time_format'],
            'default_time' => $valiDate['default_time'],
            'form_id' => $valiDate['form_id']
        ]);
        return response([
            'داده' => [
                'پیام' => 'ثبت شد',
            ],
            'وضعیت' => 'با موفقیت',
            'ID' => $y->id
        ]);
    }
    public function time_datepicker_create_get_fa(Request $request,$time_field,$minute_stepping,$time_format,$default_time,$form_id,$fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
            'time_field' => '',
            'minute_stepping' => '',
            'time_format' => '',
            'default_time' => '',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->advance()->create([
            'time_field' => $time_field,
            'minute_stepping' => $minute_stepping,
            'time_format' => $time_format,
            'default_time' => $default_time,
            'form_id' => $form_id
        ]);
        return response([
            'داده' => [
                'پیام' => 'ثبت شد',
            ],
            'وضعیت' => 'با موفقیت',
            'ID' => $y->id
        ]);
    }
    public function time_datepicker_show($id)
    {
        $ee= advanced_answerModel::where([['id',$id],['admin_id',auth()->user()->id]])->get(['id','time_field', 'minute_stepping' , 'time_format' , 'default_time' ]);
        $r= implode(', ',array($ee));
        $t=str_replace('[',' ',$r);
        $e= str_replace(']',' ',$t);
        return $e;
    }
    public function time_datepicker_showall($form_id)
    {
        $ee= advanced_answerModel::where([['admin_id',auth()->user()->id],['form_id',$form_id]])->orderby('id','desc')->paginate(5);
        return $ee;
    }
    public function time_datepicker_edit(Request $request,$id)
    {
        $valiDate = $this->validate($request, [
            'time_field' => '',
            'minute_stepping' => '',
            'time_format' => '',
            'default_time' => '',
        ]);
        $user = advanced_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->time_field = $valiDate['time_field'];
            $user->minute_stepping = $valiDate['minute_stepping'];
            $user->time_format = $valiDate['time_format'];
            $user->default_time = $valiDate['default_time'];
            if ($user->update()) {
                return response([
                    'data' => [
                        'message' => ' form is register',
                    ],
                    'status' => 'success',
                    'info' => $user
                ]);
            }
        } else {
            return "Id not found";
        }
    }
    public function time_datepicker_edit_get(Request $request,$id,$time_field,$minute_stepping,$time_format,$default_time)
{
        $valiDate = $this->validate($request, [
            'time_field' => '',
            'minute_stepping' => '',
            'time_format' => '',
            'default_time' => '',
        ]);
        $user = advanced_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->time_field = $time_field;
            $user->minute_stepping = $minute_stepping;
            $user->time_format = $time_format;
            $user->default_time = $default_time;
            if ($user->update()) {
                return response([
                    'data' => [
                        'message' => ' form is register',
                    ],
                    'status' => 'success',
                    'info' => $user
                ]);
            }
        } else {
            return "Id not found";
        }
    }
    public function time_datepicker_edit_fa(Request $request,$id,$fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
            'time_field' => '',
            'minute_stepping' => '',
            'time_format' => '',
            'default_time' => '',
        ]);
        $user = advanced_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->time_field = $valiDate['time_field'];
            $user->minute_stepping = $valiDate['minute_stepping'];
            $user->time_format = $valiDate['time_format'];
            $user->default_time = $valiDate['default_time'];
            if ($user->update()) {
                return response([
                    'داده' => [
                        'پیام' => ' آپدیت شد',
                    ],
                    'وضعیت' => 'با موفقیت',
                    'اطلاعات' => $user
                ]);
            }
        } else {
            return "پیدا نشد";
        }
    }
    public function time_datepicker_edit_get_fa(Request $request,$id,$time_field,$minute_stepping,$time_format,$default_time,$fa){
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
            'time_field' => '',
            'minute_stepping' => '',
            'time_format' => '',
            'default_time' => '',
        ]);
        $user = advanced_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->time_field = $time_field;
            $user->minute_stepping = $minute_stepping;
            $user->time_format = $time_format;
            $user->default_time = $default_time;
            if ($user->update()) {
                return response([
                    'داده' => [
                        'پیام' => ' آپدیت شد',
                    ],
                    'وضعیت' => 'با موفقیت',
                    'اطلاعات' => $user
                ]);
            }
        } else {
            return "پیدا نشد";
        }
    }
    public function time_datepicker_delete($id)
    {
        $t = advanced_answerModel::where([['id', $id], ['admin_id', auth()->user()->id]])->delete();
        if ($t) {
            return response([

                'data' => 'delete with successfull'
            ]);
        } else {
            return "id not found";
        }
    }
    public function time_datepicker_delete_fa($id, $fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $t = advanced_answerModel::where([['id', $id], ['admin_id', auth()->user()->id]])->delete();
        if ($t) {
            return response([

                'data' => 'کاربر پاک شد',
                'زبان' => $q
            ]);
        } else {
            return "این id وجود ندارد";
        }
    }
    //---------------------------------End time datepicker-----------------------------
}
