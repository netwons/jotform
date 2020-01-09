<?php

namespace App\Http\Controllers\Api\v1;

use App\OtherModel;
use Carbon\Carbon;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Option_answerModel;
use App\OptionModel;
use App\LangsModel;
class OptionController extends Controller
{
    //-----------------------------------------public-----------------------------------------------
    public function option_show($id, $name)
    {
        $ee = OptionModel::where('id', $id)->take(1)->pluck($name);
        $r= implode(', ',array($ee));
        $t=str_replace('[',' ',$r);
        $e= str_replace(']',' ',$t);
        return $e;
    }

    public function option_t_showall()
    {
        $ee= Option_answerModel::where('admin_id',auth()->user()->id)->orderby('id','desc')->paginate(5);
        return $ee;
    }
    //-----------------------------------------end public----------------------------------------
    //-------------------------------------start option fullname---------------------------------------------
    public function option_fullname_show_en()
    {
        $d = OptionModel::where('id', '1')->orderby('id', 'desc')->take(1)
            ->get(['middle_name', 'prefix', 'suffix'])->toArray();
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
    public function option_fullname_show_fa($fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $d = OptionModel::where('id', '1')->orderby('id', 'desc')->take(1)
            ->get(['middle_name_fa', 'prefix_fa', 'suffix_fa'])->toArray();
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
    //-------------------------------------End option fullname---------------------------------------------
    //-------------------------------------start option email---------------------------------------------
    public function option_email_show_en()
    {
        $d = OptionModel::where('id', '1')->orderby('id', 'desc')->take(1)
            ->get(['limit_entry', 'disallow_free_addresses', 'allow_specific_Domain'])->toArray();
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
    public function option_email_show_fa($fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $d = OptionModel::where('id', '1')->orderby('id', 'desc')->take(1)
            ->get(['limit_entry_fa', 'disallow_free_addresses_fa', 'allow_specific_Domain_fa'])->toArray();
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
    //-------------------------------------End option email---------------------------------------------
    //-------------------------------------start option address---------------------------------------------
    public function option_address_show_en()
    {
        $d = OptionModel::where('id', '1')->orderby('id', 'desc')->take(1)
            ->get(['custom_country_list', 'default_country', 'state_optionss'])->toArray();
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
    public function option_address_show_fa($fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $d = OptionModel::where('id', '1')->orderby('id', 'desc')->take(1)
            ->get(['custom_country_list_fa', 'default_country_fa', 'state_optionss_fa'])->toArray();
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
    //-------------------------------------End option address---------------------------------------------
    //-------------------------------------start option phone number---------------------------------------------
    public function option_phonenumber_show_en()
    {
        $d = OptionModel::where('id', '1')->orderby('id', 'desc')->take(1)
            ->get(['country_code', 'input_mask'])->toArray();
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
    public function option_phonenumber_show_fa($fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $d = OptionModel::where('id', '1')->orderby('id', 'desc')->take(1)
            ->get(['country_code_fa', 'input_mask_fa'])->toArray();
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
    //-------------------------------------End option phone number---------------------------------------------
//-------------------------------------start option datepicker---------------------------------------------
    public function option_datepicker_show_en()
    {
        $d = OptionModel::where('id', '1')->orderby('id', 'desc')->take(1)
            ->get(['default_date', 'months','days','today'])->toArray();
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
    public function option_datepicker_show_fa($fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $d = OptionModel::where('id', '1')->orderby('id', 'desc')->take(1)
            ->get(['default_date_fa', 'months_fa','days_fa','today_fa'])->toArray();
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
    public function option_datepicker_create(Request $request)
    {
        $valiDate = $this->validate($request, [
            'date' => '',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->foption()->create([
            'date' => $valiDate['date'],
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
    public function option_datepicker_create_fa(Request $request,$fa)
    {
        $valiDate = $this->validate($request, [
            'date' => '',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->foption()->create([
            'date' => $valiDate['date'],
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
    public function option_datepicker_show($id)
    {
        $ee= Option_answerModel::where([['id',$id],['admin_id',auth()->user()->id]])->get(['id','date']);
        $r= implode(', ',array($ee));
        $t=str_replace('[',' ',$r);
        $e= str_replace(']',' ',$t);
        return $e;
    }
    public function option_datepicker_showall($form_id)
    {
        $ee= Option_answerModel::where([['admin_id',auth()->user()->id],['form_id',$form_id]])->orderby('id','desc')->paginate(5);
        return $ee;
    }
    public function option_datepicker_edit(Request $request,$id)
    {
        $valiDate = $this->validate($request, [
            'date' => '',
        ]);
        $user = Option_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->date = $valiDate['date'];
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
    public function option_datepicker_edit_fa(Request $request,$id,$fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
            'date' => '',
        ]);
        $user = Option_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->date = $valiDate['date'];
            if ($user->update()) {
                return response([
                    'داده' => [
                        'پیام' => ' آپدیت شد',
                    ],
                    'وضعیت' => 'با موفقیت',
                    'اطلاعات' => $user,
                    'زبان'=>$q
                ]);
            }
        } else {
            return "پیدا نشد";
        }
    }
    public function option_datepicker_delete($id)
    {
        $t = Option_answerModel::where([['id', $id], ['admin_id', auth()->user()->id]])->delete();
        if ($t) {
            return response([

                'data' => 'delete with successfull'
            ]);
        } else {
            return "id not found";
        }
    }
    public function option_datepicker_delete_fa($id, $fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $t = Option_answerModel::where([['id', $id], ['admin_id', auth()->user()->id]])->delete();
        if ($t) {
            return response([

                'data' => 'کاربر پاک شد',
                'زبان' => $q
            ]);
        } else {
            return "این id وجود ندارد";
        }
    }
    //-------------------------------------End option datepicker---------------------------------------------
    //-------------------------------------start option timer---------------------------------------------

    public function option_timer_show_en()
    {
        $d = OptionModel::where('id', '1')->orderby('id', 'desc')->take(1)
            ->get(['minute_stepping', 'time_format','24hour','ampm','limit_time','both_ampm','am_only','pm_only','default_time','none','current','custom'])->toArray();
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
    public function option_timer_show_fa($fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $d = OptionModel::where('id', '1')->orderby('id', 'desc')->take(1)
            ->get(['minute_stepping_fa', 'time_format_fa','24hour_fa','ampm_fa','limit_time_fa','both_ampm_fa','am_only_fa','pm_only_fa','default_time_fa','none_fa','current_fa','custom_fa'])->toArray();
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

    public function option_timer_create(Request $request)
    {
        $valiDate = $this->validate($request, [
            'minute_stepping' => '',
            'time_format' => '',
            'limit_time' => '',
            'default_time' => '',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->foption()->create([
            'minute_stepping' => $valiDate['minute_stepping'],
            'time_format' => $valiDate['time_format'],
            'limit_time' => $valiDate['limit_time'],
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
    public function option_timer_create_fa(Request $request,$fa)
    {
        $valiDate = $this->validate($request, [
            'minute_stepping' => '',
            'time_format' => '',
            'limit_time' => '',
            'default_time' => '',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->foption()->create([
            'minute_stepping' => $valiDate['minute_stepping'],
            'time_format' => $valiDate['time_format'],
            'limit_time' => $valiDate['limit_time'],
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
    public function option_timer_show($id)
    {
        $ee= Option_answerModel::where([['id',$id],['admin_id',auth()->user()->id]])->get(['id','minute_stepping','time_format','limit_time','default_time']);
        $r= implode(', ',array($ee));
        $t=str_replace('[',' ',$r);
        $e= str_replace(']',' ',$t);
        return $e;
    }
    public function option_timer_showall($form_id)
    {
        $ee= Option_answerModel::where([['admin_id',auth()->user()->id],['form_id',$form_id]])->orderby('id','desc')->paginate(5);
        return $ee;
    }
    public function option_timer_edit(Request $request,$id)
    {
        $valiDate = $this->validate($request, [
            'minute_stepping' => '',
            'time_format' => '',
            'limit_time' => '',
            'default_time' => '',        ]);
        $user = Option_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->minute_stepping = $valiDate['minute_stepping'];
            $user->time_format = strtoupper($valiDate['time_format']);
            $user->limit_time =strtoupper( $valiDate['limit_time']);
            $user->default_time = strtoupper($valiDate['default_time']);
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
    public function option_timer_edit_fa(Request $request,$id,$fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
            'minute_stepping' => '',
            'time_format' => '',
            'limit_time' => '',
            'default_time' => '',        ]);
        $user = Option_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->minute_stepping = $valiDate['minute_stepping'];
            $user->time_format = strtoupper($valiDate['time_format']);
            $user->limit_time =strtoupper( $valiDate['limit_time']);
            $user->default_time = strtoupper($valiDate['default_time']);
            if ($user->update()) {
                return response([
                    'داده' => [
                        'پیام' => ' آپدیت شد',
                    ],
                    'وضعیت' => 'با موفقیت',
                    'اطلاعات' => $user,
                    'زبان'=>$q
                ]);
            }
        } else {
            return "پیدا نشد";
        }
    }
    public function option_timer_delete($id)
    {
        $t = Option_answerModel::where([['id', $id], ['admin_id', auth()->user()->id]])->delete();
        if ($t) {
            return response([

                'data' => 'delete with successfull'
            ]);
        } else {
            return "id not found";
        }
    }
    public function option_timer_delete_fa($id, $fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $t = Option_answerModel::where([['id', $id], ['admin_id', auth()->user()->id]])->delete();
        if ($t) {
            return response([

                'data' => 'کاربر پاک شد',
                'زبان' => $q
            ]);
        } else {
            return "این id وجود ندارد";
        }
    }
//-------------------------------------End option timer---------------------------------------------
//-------------------------------------start option short text---------------------------------------------
    public function option_short_text_show_en()
    {
        $d = OptionModel::where('id', '1')->orderby('id', 'desc')->take(1)
            ->get(['limit_entry1', 'input_mask1'])->toArray();
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
    public function option_short_text_show_fa($fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $d = OptionModel::where('id', '1')->orderby('id', 'desc')->take(1)
            ->get(['limit_entry1_fa', 'input_mask1_fa'])->toArray();
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

    public function option_short_text_create(Request $request)
    {
        $valiDate = $this->validate($request, [
            'limit_entry1' => '',
            'input_mask1' => '',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->foption()->create([
            'limit_entry1' => $valiDate['limit_entry1'],
            'input_mask1' => $valiDate['input_mask1'],
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
    public function option_short_text_create_fa(Request $request,$fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
            'limit_entry1' => '',
            'input_mask1' => '',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->foption()->create([
            'limit_entry1' => $valiDate['limit_entry1'],
            'input_mask1' => $valiDate['input_mask1'],
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
    public function option_short_text_show($id)
    {
        $ee= Option_answerModel::where([['id',$id],['admin_id',auth()->user()->id]])->get(['id','limit_entry1','input_mask1']);
        $r= implode(', ',array($ee));
        $t=str_replace('[',' ',$r);
        $e= str_replace(']',' ',$t);
        return $e;
    }
    public function option_short_text_showall($form_id)
    {
        $ee= Option_answerModel::where([['admin_id',auth()->user()->id],['form_id',$form_id]])->orderby('id','desc')->paginate(5);
        return $ee;
    }
    public function option_short_text_edit(Request $request,$id)
    {
        $valiDate = $this->validate($request, [
            'limit_entry1' => '',
            'input_mask1' => '',
                   ]);
        $user = Option_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->limit_entry1 = $valiDate['limit_entry1'];
            $user->input_mask1 =$valiDate['input_mask1'];
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
    public function option_short_text_edit_fa(Request $request,$id,$fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
            'limit_entry1' => '',
            'input_mask1' => '',        ]);
        $user = Option_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->limit_entry1 = $valiDate['limit_entry1'];
            $user->input_mask1 = $valiDate['input_mask1'];
            if ($user->update()) {
                return response([
                    'داده' => [
                        'پیام' => ' آپدیت شد',
                    ],
                    'وضعیت' => 'با موفقیت',
                    'اطلاعات' => $user,
                    'زبان'=>$q
                ]);
            }
        } else {
            return "پیدا نشد";
        }
    }
    public function option_short_text_delete($id)
    {
        $t = Option_answerModel::where([['id', $id], ['admin_id', auth()->user()->id]])->delete();
        if ($t) {
            return response([

                'data' => 'delete with successfull'
            ]);
        } else {
            return "id not found";
        }
    }
    public function option_short_text_delete_fa($id, $fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $t = Option_answerModel::where([['id', $id], ['admin_id', auth()->user()->id]])->delete();
        if ($t) {
            return response([

                'data' => 'کاربر پاک شد',
                'زبان' => $q
            ]);
        } else {
            return "این id وجود ندارد";
        }
    }
//-------------------------------------End option short text---------------------------------------------
//-------------------------------------start option long text---------------------------------------------
    public function option_long_text_show_en()
    {
        $d = OptionModel::where('id', '1')->orderby('id', 'desc')->take(1)
            ->get(['entry_limits'])->toArray();
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
    public function option_long_text_show_fa($fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $d = OptionModel::where('id', '1')->orderby('id', 'desc')->take(1)
            ->get(['entry_limits_fa'])->toArray();
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
    public function option_long_text_create(Request $request)
    {
        $valiDate = $this->validate($request, [
            'entry_limits' => '',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->foption()->create([
            'entry_limits' => $valiDate['entry_limits'],
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
    public function option_long_text_create_fa(Request $request,$fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
            'entry_limits' => '',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->foption()->create([
            'entry_limits' => $valiDate['entry_limits'],
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
    public function option_long_text_show($id)
    {
        $ee= Option_answerModel::where([['id',$id],['admin_id',auth()->user()->id]])->get(['id','entry_limits']);
        $r= implode(', ',array($ee));
        $t=str_replace('[',' ',$r);
        $e= str_replace(']',' ',$t);
        return $e;
    }
    public function option_long_text_showall($form_id)
    {
        $ee= Option_answerModel::where([['admin_id',auth()->user()->id],['form_id',$form_id]])->orderby('id','desc')->paginate(5);
        return $ee;
    }
    public function option_long_text_edit(Request $request,$id)
    {
        $valiDate = $this->validate($request, [
            'entry_limits' => '',
        ]);
        $user = Option_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->entry_limits = $valiDate['entry_limits'];
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
    public function option_long_text_edit_fa(Request $request,$id,$fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
            'entry_limits' => '',
        ]);
        $user = Option_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->entry_limits = $valiDate['entry_limits'];
            if ($user->update()) {
                return response([
                    'داده' => [
                        'پیام' => ' آپدیت شد',
                    ],
                    'وضعیت' => 'با موفقیت',
                    'اطلاعات' => $user,
                    'زبان'=>$q
                ]);
            }
        } else {
            return "پیدا نشد";
        }
    }
    public function option_long_text_delete($id)
    {
        $t = Option_answerModel::where([['id', $id], ['admin_id', auth()->user()->id]])->delete();
        if ($t) {
            return response([

                'data' => 'delete with successfull'
            ]);
        } else {
            return "id not found";
        }
    }
    public function option_long_text_delete_fa($id, $fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $t = Option_answerModel::where([['id', $id], ['admin_id', auth()->user()->id]])->delete();
        if ($t) {
            return response([

                'data' => 'کاربر پاک شد',
                'زبان' => $q
            ]);
        } else {
            return "این id وجود ندارد";
        }
    }
//-------------------------------------End option long text---------------------------------------------

//-------------------------------------start option text---------------------------------------------
//-------------------------------------End option text---------------------------------------------

//-------------------------------------start option dropdown---------------------------------------------
    public function option_dropdown_show_en()
    {
        $d = OptionModel::where('id', '1')->orderby('id', 'desc')->take(1)
            ->get(['options'])->toArray();
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
    public function option_dropdown_show_fa($fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $d = OptionModel::where('id', '1')->orderby('id', 'desc')->take(1)
            ->get(['options_fa'])->toArray();
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

    public function option_dropdown_create(Request $request)
    {
        $valiDate = $this->validate($request, [
            'options' => '',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->foption()->create([
            'options' => $valiDate['options'],
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
    public function option_dropdown_create_fa(Request $request,$fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
            'options' => '',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->foption()->create([
            'options' => $valiDate['options'],
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
    public function option_dropdown_show($id)
    {
        $ee= Option_answerModel::where([['id',$id],['admin_id',auth()->user()->id]])->get(['id','options']);
        $r= implode(', ',array($ee));
        $t=str_replace('[',' ',$r);
        $e= str_replace(']',' ',$t);
        return $e;
    }
    public function option_dropdown_showall($form_id)
    {
        $ee= Option_answerModel::where([['admin_id',auth()->user()->id],['form_id',$form_id]])->orderby('id','desc')->paginate(5);
        return $ee;
    }
    public function option_dropdown_edit(Request $request,$id)
    {
        $valiDate = $this->validate($request, [
            'options' => '',
        ]);
        $user = Option_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->options = $valiDate['options'];
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
    public function option_dropdown_edit_fa(Request $request,$id,$fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
            'options' => '',
        ]);
        $user = Option_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->options = $valiDate['options'];
            if ($user->update()) {
                return response([
                    'داده' => [
                        'پیام' => ' آپدیت شد',
                    ],
                    'وضعیت' => 'با موفقیت',
                    'اطلاعات' => $user,
                    'زبان'=>$q
                ]);
            }
        } else {
            return "پیدا نشد";
        }
    }
    public function option_dropdown_delete($id)
    {
        $t = Option_answerModel::where([['id', $id], ['admin_id', auth()->user()->id]])->delete();
        if ($t) {
            return response([

                'data' => 'delete with successfull'
            ]);
        } else {
            return "id not found";
        }
    }
    public function option_dropdown_delete_fa($id, $fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $t = Option_answerModel::where([['id', $id], ['admin_id', auth()->user()->id]])->delete();
        if ($t) {
            return response([

                'data' => 'کاربر پاک شد',
                'زبان' => $q
            ]);
        } else {
            return "این id وجود ندارد";
        }
    }
//-------------------------------------End option dropdown---------------------------------------------
//-------------------------------------start option single choice---------------------------------------
    public function option_single_choice_show_en()
    {
        $d = OptionModel::where('id', '1')->orderby('id', 'desc')->take(1)
            ->get(['option_single_choice','predefined_options'])->toArray();
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
    public function option_single_choice_show_fa($fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $d = OptionModel::where('id', '1')->orderby('id', 'desc')->take(1)
            ->get(['option_single_choice_fa','predefined_options_fa'])->toArray();
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
    public function option_single_choice_create(Request $request)
    {
        $valiDate = $this->validate($request, [
            'option_single_choice' => '',
            'predefined_options' => [
                'required',
                'regex:/(none|gender|days|months)$/i'//or none or gender or days or months
            ],
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->foption()->create([
            'option_single_choice' => $valiDate['option_single_choice'],
            'predefined_options' => $valiDate['predefined_options'],
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

    public function gender()
    {
        $d = OtherModel::where('id', '1')->orderby('id', 'desc')->take(1)
            ->get(['male','female','n_a'])->toArray();
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

    public function days()
    {
        $d = OtherModel::where('id', '1')->orderby('id', 'desc')->take(1)
            ->get(['monday','tuesday','wednesday','thursday','friday','saturday'
                ,'sunday'])->toArray();
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
    public function months()
    {
        $d = OtherModel::where('id', '1')->orderby('id', 'desc')->take(1)
            ->get(['january','february','march','april','may','june','july','august','september','october','november'
                ,'december'])->toArray();
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
    public function option_single_choice_create_fa(Request $request,$fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
            'option_single_choice' => '',
            'predefined_options' => [
                'required',
                'regex:/(none|gender|days|months)$/i'//or none or gender or days or months
            ],
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->foption()->create([
            'option_single_choice' => $valiDate['option_single_choice'],
            'predefined_options' => $valiDate['predefined_options'],
            'form_id' => $valiDate['form_id']
        ]);
        return response([
            'داده' => [
                'پیام' => 'ثبت شد',
            ],
            'وضعیت' => 'با موفقیت',
            'ID' => $y->id,
            'زبان'=>$q
        ]);
    }
    public function option_single_choice_show($id)
    {
        $ee= Option_answerModel::where([['id',$id],['admin_id',auth()->user()->id]])->get(['id','option_single_choice']);
        $r= implode(', ',array($ee));
        $t=str_replace('[',' ',$r);
        $e= str_replace(']',' ',$t);
        $q= str_replace('\n',' ',$e);
        return $q;
    }
    public function option_single_choice_showall($form_id)
    {
        $ee= Option_answerModel::where([['admin_id',auth()->user()->id],['form_id',$form_id]])->orderby('id','desc')->paginate(5);
        return $ee;
    }
    public function option_single_choice_edit(Request $request,$id)
    {
        $valiDate = $this->validate($request, [
            'option_single_choice' => '',
            'predefined_options' => [
                'required',
                'regex:/(none|gender|days|months)$/i'//or none or gender or days or months
            ],
        ]);
        $user = Option_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->option_single_choice = $valiDate['option_single_choice'];

            $user->predefined_options = $valiDate['predefined_options'];
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
    public function option_single_choice_edit_fa(Request $request,$id,$fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
            'option_single_choice' => '',
            'predefined_options' => [
                'required',
                'regex:/(none|gender|days|months)$/i'//or none or gender or days or months
            ],
        ]);
        $user = Option_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->option_single_choice = $valiDate['option_single_choice'];
            $user->predefined_options = $valiDate['predefined_options'];
            if ($user->update()) {
                return response([
                    'داده' => [
                        'پیام' => ' آپدیت شد',
                    ],
                    'وضعیت' => 'با موفقیت',
                    'اطلاعات' => $user,
                    'زبان'=>$q
                ]);
            }
        } else {
            return "پیدا نشد";
        }
    }
    public function option_single_choice_delete($id)
    {
        $t = Option_answerModel::where([['id', $id], ['admin_id', auth()->user()->id]])->delete();
        if ($t) {
            return response([

                'data' => 'delete with successfull'
            ]);
        } else {
            return "id not found";
        }
    }
    public function option_single_choice_delete_fa($id, $fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $t = Option_answerModel::where([['id', $id], ['admin_id', auth()->user()->id]])->delete();
        if ($t) {
            return response([

                'data' => 'کاربر پاک شد',
                'زبان' => $q
            ]);
        } else {
            return "این id وجود ندارد";
        }
    }
//-------------------------------------End option single choice----------------------------------------
//-------------------------------------start option multiple choice----------------------------------------
    public function option_multiple_choice_show_en()
    {
        $d = OptionModel::where('id', '1')->orderby('id', 'desc')->take(1)
            ->get(['option_multiple_choice','predefined_options_multiple'])->toArray();
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
    public function option_multiple_choice_show_fa($fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $d = OptionModel::where('id', '1')->orderby('id', 'desc')->take(1)
            ->get(['option_multiple_choice','predefined_options_multiple'])->toArray();
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
    public function option_multiple_choice_create(Request $request)
    {
        $valiDate = $this->validate($request, [
            'option_multiple_choice' => '',
            'predefined_options_multiple' => [
                'required',
                'regex:/(none|gender|days|months)$/i'//or none or gender or days or months
            ],
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->foption()->create([
            'option_multiple_choice' => $valiDate['option_multiple_choice'],
            'predefined_options_multiple' => $valiDate['predefined_options_multiple'],
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

    public function genders()
    {
        $d = OtherModel::where('id', '1')->orderby('id', 'desc')->take(1)
            ->get(['male','female','n_a'])->toArray();
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

    public function dayss()
    {
        $d = OtherModel::where('id', '1')->orderby('id', 'desc')->take(1)
            ->get(['monday','tuesday','wednesday','thursday','friday','saturday'
                ,'sunday'])->toArray();
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
    public function monthss()
    {
        $d = OtherModel::where('id', '1')->orderby('id', 'desc')->take(1)
            ->get(['january','february','march','april','may','june','july','august','september','october','november'
                ,'december'])->toArray();
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
    public function option_multiple_choice_create_fa(Request $request,$fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
            'option_multiple_choice' => '',
            'predefined_options_multiple' => [
                'required',
                'regex:/(none|gender|days|months)$/i'//or none or gender or days or months
            ],
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->foption()->create([
            'option_multiple_choice' => $valiDate['option_multiple_choice'],
            'predefined_options_multiple' => $valiDate['predefined_options_multiple'],
            'form_id' => $valiDate['form_id']
        ]);
        return response([
            'داده' => [
                'پیام' => 'ثبت شد',
            ],
            'وضعیت' => 'با موفقیت',
            'ID' => $y->id,
            'زبان'=>$q
        ]);
    }
    public function option_multiple_choice_show($id)
    {
        $ee= Option_answerModel::where([['id',$id],['admin_id',auth()->user()->id]])->get(['id','option_multiple_choice']);
        $r= implode(', ',array($ee));
        $t=str_replace('[',' ',$r);
        $e= str_replace(']',' ',$t);
        $q= str_replace('\n',' ',$e);
        return $q;
    }
    public function option_multiple_choice_showall($form_id)
    {
        $ee= Option_answerModel::where([['admin_id',auth()->user()->id],['form_id',$form_id]])->orderby('id','desc')->paginate(5);
        return $ee;
    }
    public function option_multiple_choice_edit(Request $request,$id)
    {
        $valiDate = $this->validate($request, [
            'option_multiple_choice' => '',
            'predefined_options_multiple' => [
                'required',
                'regex:/(none|gender|days|months)$/i'//or none or gender or days or months
            ],
        ]);
        $user = Option_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->option_multiple_choice = $valiDate['option_multiple_choice'];
            $user->predefined_options_multiple = $valiDate['predefined_options_multiple'];
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
    public function option_multiple_choice_edit_fa(Request $request,$id,$fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
            'option_multiple_choice' => '',
            'predefined_options_multiple' => [
                'required',
                'regex:/(none|gender|days|months)$/i'//or none or gender or days or months
            ],
        ]);
        $user = Option_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->option_multiple_choice = $valiDate['option_multiple_choice'];
            $user->predefined_options_multiple = $valiDate['predefined_options_multiple'];
            if ($user->update()) {
                return response([
                    'داده' => [
                        'پیام' => ' آپدیت شد',
                    ],
                    'وضعیت' => 'با موفقیت',
                    'اطلاعات' => $user,
                    'زبان'=>$q
                ]);
            }
        } else {
            return "پیدا نشد";
        }
    }
    public function option_multiple_choice_delete($id)
    {
        $t = Option_answerModel::where([['id', $id], ['admin_id', auth()->user()->id]])->delete();
        if ($t) {
            return response([

                'data' => 'delete with successfull'
            ]);
        } else {
            return "id not found";
        }
    }
    public function option_multiple_choice_delete_fa($id, $fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $t = Option_answerModel::where([['id', $id], ['admin_id', auth()->user()->id]])->delete();
        if ($t) {
            return response([

                'data' => 'کاربر پاک شد',
                'زبان' => $q
            ]);
        } else {
            return "این id وجود ندارد";
        }
    }
//-------------------------------------End option multiple choice----------------------------------------
//-------------------------------------start option image choice----------------------------------------
    public function option_image_choice_show_en()
    {
        $d = OptionModel::where('id', '1')->orderby('id', 'desc')->take(1)
            ->get(['allow_multiple_selection','image'])->toArray();
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
    public function option_image_choice_show_fa($fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $d = OptionModel::where('id', '1')->orderby('id', 'desc')->take(1)
            ->get(['allow_multiple_selection_fa','image_fa'])->toArray();
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
    public function option_image_choice_create(Request $request,Filesystem $filesystem)
    {
        //return $request->file('image');
       $valiDate= $this->validate($request,[
           'allow_multiple_selection'=>'',
            'image'=>'required|mimes:jpeg,jpg,png|max:10240',
            'form_id'=>'exists:forms,id'
            ]);
        $file=$request->file('image');
        $year=Carbon::now()->year;
        $month=Carbon::now()->month;
        $day=Carbon::now()->day;
        $imagepath="/upload/images/{$year}/{$month}/{$day}";
        $filename=$file->getClientOriginalName();
        if($filesystem->exists( public_path("{$imagepath}/{$filename}"))){
            $filename=Carbon::now()->timestamp."-{$filename}";
        }
        //echo url($imagepath.$filename)."<br>";
        $y = auth()->user()->foption()->create([
            'allow_multiple_selection'=>$valiDate['allow_multiple_selection'],
            'image' =>url($imagepath.$filename) ,
            'form_id' => $valiDate['form_id']

        ]);
        $file->move(public_path($imagepath),$filename);
        return response([
           'data'=>[
               'image_url'=>url("{$imagepath}/{$filename}")
           ],
           'status'=>'success',

        ]);
    }

    public function option_image_choice_create_fa(Request $request,Filesystem $filesystem,$fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
            'allow_multiple_selection'=>'',
            'image'=>'required|mimes:jpeg,jpg,png|max:10240',
            'form_id' => 'exists:forms,id'
        ]);
        $file=$request->file('image');
        $year=Carbon::now()->year;
        $month=Carbon::now()->month;
        $day=Carbon::now()->day;
        $imagepath="/upload/images/{$year}/{$month}/{$day}";
        $filename=$file->getClientOriginalName();
        if($filesystem->exists( public_path("{$imagepath}/{$filename}"))){
            $filename=Carbon::now()->timestamp."-{$filename}";
        }
        $y = auth()->user()->foption()->create([
            'allow_multiple_selection'=>$valiDate['allow_multiple_selection'],
            'options_images' =>url($imagepath.$filename) ,
            'form_id' => $valiDate['form_id']
        ]);
        $file->move(public_path($imagepath),$filename);
        return response([
            'data'=>[
                'image_url'=>url("{$imagepath}/{$filename}")
            ],
            'status'=>'با موفقیت',

        ]);
    }

    public function option_image_choice_show($id)
    {
        $ee= Option_answerModel::where([['id',$id],['admin_id',auth()->user()->id]])->get(['id','allow_multiple_selection','options_images']);
        $r= implode(', ',array($ee));
        $t=str_replace('[',' ',$r);
        $e= str_replace(']',' ',$t);
        $q= str_replace('\n',' ',$e);
        return $q;
    }
    public function option_image_choice_showall($form_id)
    {
        $ee= Option_answerModel::where([['admin_id',auth()->user()->id],['form_id',$form_id]])->orderby('id','desc')->paginate(5);
        return $ee;
    }
    public function option_image_choice_edit(Request $request,Filesystem $filesystem,$id)
    {
        $valiDate = $this->validate($request, [
            'allow_multiple_selection' => '',
            'image' => 'required|mimes:jpeg,jpg,png|max:10240',
        ]);
        $file=$request->file('image');
        $year=Carbon::now()->year;
        $month=Carbon::now()->month;
        $day=Carbon::now()->day;
        $imagepath="/upload/images/{$year}/{$month}/{$day}";
        $filename=$file->getClientOriginalName();
        if($filesystem->exists( public_path("{$imagepath}/{$filename}"))){
            $filename=Carbon::now()->timestamp."-{$filename}";
        }
        $user = Option_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->allow_multiple_selection = $valiDate['allow_multiple_selection'];
            $user->image =url($imagepath.$filename);
            if ($user->update()) {
                return response([
                    'data' => [
                        'message' => ' form is update',
                    ],
                    'status' => 'success',
                    'info' => $user
                ]);
            }
        }

    }
    public function option_image_choice_edit_fa(Request $request,Filesystem $filesystem,$id,$fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
            'allow_multiple_selection' => '',
            'image' => 'required|mimes:jpeg,jpg,png|max:10240',
        ]);
        $file=$request->file('image');
        $year=Carbon::now()->year;
        $month=Carbon::now()->month;
        $day=Carbon::now()->day;
        $imagepath="/upload/images/{$year}/{$month}/{$day}";
        $filename=$file->getClientOriginalName();
        if($filesystem->exists( public_path("{$imagepath}/{$filename}"))){
            $filename=Carbon::now()->timestamp."-{$filename}";
        }
        $user = Option_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->allow_multiple_selection = $valiDate['allow_multiple_selection'];
            $user->image =url($imagepath.$filename);
            if ($user->update()) {
                return response([
                    'داده' => [
                        'پیام' => ' آپدیت شد',
                    ],
                    'وضعیت' => 'success',
                    'اطلاعات' => $user
                ]);
            }
        }
    }
    public function option_image_choice_delete($id)
    {
        $t = Option_answerModel::where([['id', $id], ['admin_id', auth()->user()->id]])->delete();
        if ($t) {
            return response([

                'data' => 'delete with successfull'
            ]);
        } else {
            return "id not found";
        }
    }
    public function option_image_choice_delete_fa($id, $fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $t = Option_answerModel::where([['id', $id], ['admin_id', auth()->user()->id]])->delete();
        if ($t) {
            return response([

                'data' => 'کاربر پاک شد',
                'زبان' => $q
            ]);
        } else {
            return "این id وجود ندارد";
        }
    }
//-------------------------------------End option image choice----------------------------------------
//-------------------------------------start option number----------------------------------------
    public function option_number_show_en()
    {
        $d = OptionModel::where('id', '1')->orderby('id', 'desc')->take(1)
            ->get(['limit_entry_number'])->toArray();
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
    public function option_number_show_fa($fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $d = OptionModel::where('id', '1')->orderby('id', 'desc')->take(1)
            ->get(['limit_entry_number_fa'])->toArray();
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
    public function option_number_create(Request $request)
    {
        $valiDate = $this->validate($request, [
            'minumum' => 'required|numeric',
            'maximum' => 'required|numeric',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->foption()->create([
            'minumum' => $valiDate['minumum'],
            'maximum' => $valiDate['maximum'],
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
    public function option_number_create_get(Request $request,$minumum,$maximum,$form_id)
    {
        $valiDate = $this->validate($request, [
//            'minumum' => $minumum,
//            'maximum' => $maximum,
//            'form_id' => $form_id//.'exists:forms,id'
        ]);
        $y = auth()->user()->foption()->create([
            'minumum' => $minumum,
            'maximum' => $maximum,
            'form_id' => $form_id//.'exists:forms,id'
        ]);
        return response([
            'data' => [
                'message' => 'form is registered',
            ],
            'status' => 'success',
            'ID' => $y->id
        ]);
    }
    public function option_number_create_fa(Request $request,$fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
            'minumum' => 'required|numeric',
            'maximum' => 'required|numeric',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->foption()->create([
            'minumum' => $valiDate['minumum'],
            'maximum' => $valiDate['maximum'],
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
    public function option_number_create_fa_get(Request $request,$minumum,$maximum,$form_id,$fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
//            'minumum' => $minumum,
//            'maximum' => $maximum,
//            'form_id' => $form_id//.'exists:forms,id'
        ]);
        $y = auth()->user()->foption()->create([
            'minumum' => $minumum,
            'maximum' => $maximum,
            'form_id' => $form_id//.'exists:forms,id'
        ]);
        return response([
            'داده' => [
                'پیام' => 'ثبت شد',
            ],
            'وضعیت' => 'با موفقیت',
            'ID' => $y->id
        ]);
    }
    public function option_number_show($id)
    {
        $ee= Option_answerModel::where([['id',$id],['admin_id',auth()->user()->id]])->get(['id','minumum','maximum']);
        $r= implode(', ',array($ee));
        $t=str_replace('[',' ',$r);
        $e= str_replace(']',' ',$t);
        $q= str_replace('\n',' ',$e);
        return $q;
    }
    public function option_number_showall($form_id)
    {
        $ee= Option_answerModel::where([['admin_id',auth()->user()->id],['form_id',$form_id]])->orderby('id','desc')->paginate(5);
        return $ee;
    }
    public function option_number_edit(Request $request,$id)
    {
        $valiDate = $this->validate($request, [
            'minumum' => 'required|numeric',
            'maximum' => 'required|numeric',
        ]);
        $user = Option_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->minumum = $valiDate['minumum'];
            $user->maximum = $valiDate['maximum'];
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
    public function option_number_edit_get(Request $request,$minumum,$maximum,$id)
    {
        $valiDate = $this->validate($request, [
//            'minumum' => '',
//            'maximum' =>'',
        ]);
        $user = Option_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->minumum = $minumum;
            $user->maximum = $maximum;
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
    public function option_number_edit_fa(Request $request,$id,$fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
            'minumum' => 'required|numeric',
            'maximum' => 'required|numeric',
        ]);
        $user = Option_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->minumum = $valiDate['minumum'];
            $user->maximum = $valiDate['maximum'];
            if ($user->update()) {
                return response([
                    'داده' => [
                        'پیام' => ' آپدیت شد',
                    ],
                    'وضعیت' => 'با موفقیت',
                    'اطلاعات' => $user,
                    'زبان'=>$q
                ]);
            }
        } else {
            return "پیدا نشد";
        }
    }
    public function option_number_edit_get_fa(Request $request,$id,$minumum,$maximum,$fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
//            'minumum' => '',
//            'maximum' => [
//                'required',
//                'regex:/(none|gender|days|months)$/i'//or none or gender or days or months
//            ],
        ]);
        $user = Option_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->minumum = $minumum;
            $user->maximum = $maximum;
            if ($user->update()) {
                return response([
                    'داده' => [
                        'پیام' => ' آپدیت شد',
                    ],
                    'وضعیت' => 'با موفقیت',
                    'اطلاعات' => $user,
                    'زبان'=>$q
                ]);
            }
        } else {
            return "پیدا نشد";
        }
    }

    public function option_number_delete($id)
    {
        $t = Option_answerModel::where([['id', $id], ['admin_id', auth()->user()->id]])->delete();
        if ($t) {
            return response([

                'data' => 'delete with successfull'
            ]);
        } else {
            return "id not found";
        }
    }
    public function option_number_delete_fa($id, $fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $t = Option_answerModel::where([['id', $id], ['admin_id', auth()->user()->id]])->delete();
        if ($t) {
            return response([

                'data' => 'کاربر پاک شد',
                'زبان' => $q
            ]);
        } else {
            return "این id وجود ندارد";
        }
    }
//-------------------------------------End option number---------------------------------------
//-------------------------------------start option file upload---------------------------------------
    public function option_fileupload_show_en()
    {
        $d = OptionModel::where('id', '1')->orderby('id', 'desc')->take(1)
            ->get(['limit_entry_fileupload','file_type'])->toArray();
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

    public function option_fileupload_show_fa($fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $d = OptionModel::where('id', '1')->orderby('id', 'desc')->take(1)
            ->get(['limit_entry_fileupload_fa','file_type_fa'])->toArray();
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

    public function option_fileupload_create(Request $request)
    {
        $valiDate = $this->validate($request, [
            'minumum_fileupload' => 'required|numeric',
            'maximumfileupload' => 'required|numeric',
            'filetype' => '',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->foption()->create([
            'minumum_fileupload' => $valiDate['minumum_fileupload'],
            'maximumfileupload' => $valiDate['maximumfileupload'],
            'filetype' => $valiDate['filetype'],
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
    public function option_fileupload_create_get(Request $request,$minumum_fileupload,$maximumfileupload,$filetype,$form_id)
    {
        $valiDate = $this->validate($request, [
//            'minumum_fileupload' => 'required|numeric',
//            'maximumfileupload' => 'required|numeric',
//            'filetype' => '',
//            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->foption()->create([
            'minumum_fileupload' => $minumum_fileupload,
            'maximumfileupload' => $maximumfileupload,
            'filetype' => $filetype,
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
    public function option_fileupload_create_fa(Request $request,$fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
            'minumum_fileupload' => 'required|numeric',
            'maximumfileupload' => 'required|numeric',
            'filetype' => '',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->foption()->create([
            'minumum_fileupload' => $valiDate['minumum_fileupload'],
            'maximumfileupload' => $valiDate['maximumfileupload'],
            'filetype' => $valiDate['filetype'],
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
    public function option_fileupload_create_get_fa(Request $request,$fa,$form_id,$minumum_fileupload,$maximumfileupload,$filetype)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');

        $valiDate = $this->validate($request, [
//            'minumum_fileupload' => 'required|numeric',
//            'maximumfileupload' => 'required|numeric',
//            'filetype' => '',
//            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->foption()->create([
            'minumum_fileupload' => $minumum_fileupload,
            'maximumfileupload' => $maximumfileupload,
            'filetype' => $filetype,
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
    public function option_fileupload_show($id)
    {
        $ee= Option_answerModel::where([['id',$id],['admin_id',auth()->user()->id]])->get(['id','minumum_fileupload','maximumfileupload','filetype']);
        $r= implode(', ',array($ee));
        $t=str_replace('[',' ',$r);
        $e= str_replace(']',' ',$t);
        $q= str_replace('\n',' ',$e);
        return $q;
    }
    public function option_fileupload_showall($form_id)
    {
        $ee= Option_answerModel::where([['admin_id',auth()->user()->id],['form_id',$form_id]])->orderby('id','desc')->paginate(5);
        return $ee;
    }
    public function option_fileupload_edit(Request $request,$id)
    {
        $valiDate = $this->validate($request, [
//            'minumum_fileupload' => 'required|numeric',
//            'maximumfileupload' => 'required|numeric',
//            'filetype' => '',
        ]);
        $user = Option_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->minumum_fileupload = $valiDate['minumum_fileupload'];
            $user->maximumfileupload = $valiDate['maximumfileupload'];
            $user->filetype = $valiDate['filetype'];

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
    public function option_fileupload_edit_get(Request $request,$minumum_fileupload,$maximumfileupload,$filetype,$id)
    {
        $valiDate = $this->validate($request, [
//            'minumum' => '',
//            'maximum' =>'',
        ]);
        $user = Option_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->minumum = $minumum_fileupload;
            $user->maximum = $maximumfileupload;
            $user->filetype = $filetype;
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
    public function option_fileupload_edit_fa(Request $request,$id,$fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
            'minumum_fileupload' => 'required|numeric',
            'maximumfileupload' => 'required|numeric',
            'filetype'=>'',
        ]);
        $user = Option_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->minumum_fileupload = $valiDate['minumum_fileupload'];
            $user->maximumfileupload = $valiDate['maximumfileupload'];
            $user->filetype = $valiDate['filetype'];
            if ($user->update()) {
                return response([
                    'داده' => [
                        'پیام' => ' آپدیت شد',
                    ],
                    'وضعیت' => 'با موفقیت',
                    'اطلاعات' => $user,
                    'زبان'=>$q
                ]);
            }
        } else {
            return "پیدا نشد";
        }
    }
    public function option_fileupload_edit_get_fa(Request $request,$minumum_fileupload,$maximumfileupload,$filetype,$id,$fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
//            'minumum' => '',
//            'maximum' => [
//                'required',
//                'regex:/(none|gender|days|months)$/i'//or none or gender or days or months
//            ],
        ]);
        $user = Option_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->minumum_fileupload = $valiDate['minumum_fileupload'];
            $user->maximumfileupload = $valiDate['maximumfileupload'];
            $user->filetype = $valiDate['filetype'];
            if ($user->update()) {
                return response([
                    'داده' => [
                        'پیام' => ' آپدیت شد',
                    ],
                    'وضعیت' => 'با موفقیت',
                    'اطلاعات' => $user,
                    'زبان'=>$q
                ]);
            }
        } else {
            return "پیدا نشد";
        }
    }

    public function option_fileupload_delete($id)
    {
        $t = Option_answerModel::where([['id', $id], ['admin_id', auth()->user()->id]])->delete();
        if ($t) {
            return response([

                'data' => 'delete with successfull'
            ]);
        } else {
            return "id not found";
        }
    }
    public function option_fileupload_delete_fa($id, $fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $t = Option_answerModel::where([['id', $id], ['admin_id', auth()->user()->id]])->delete();
        if ($t) {
            return response([

                'data' => 'کاربر پاک شد',
                'زبان' => $q
            ]);
        } else {
            return "این id وجود ندارد";
        }
    }

//-------------------------------------End option file upload---------------------------------------
//---------------------------------------start option input table ---------------------------------------

//---------------------------------------End option input table ------------------------------------------
//---------------------------------------start option emoji ---------------------------------------

//---------------------------------------End option emoji ------------------------------------------
//---------------------------------------start option star rating ---------------------------------------
    public function option_Star_Rating_show_en()
    {

        $d = OptionModel::where('id', '1')->orderby('id', 'desc')->take(1)
            ->get(['ratihn_style','lowest','rating_amount','lowest_rating_text','highest_rating'])->toArray();
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
    public function option_Star_Rating_show_fa($fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $d = OptionModel::where('id', '1')->orderby('id', 'desc')->take(1)
            ->get(['ratihn_style_fa','lowest_fa','rating_amount_fa','lowest_rating_text_fa','highest_rating_fa'])->toArray();
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
    public function option_Star_Rating_create(Request $request)
    {
        $valiDate = $this->validate($request, [
            'ratihn_style' => 'required|numeric',
            'lowest' => 'required|numeric',
            'rating_amount' => 'numeric',
            'lowest_rating_text' => '',
            'highest_rating' => '',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->foption()->create([
            'ratihn_style' => $valiDate['ratihn_style'],
            'lowest' => $valiDate['lowest'],
            'rating_amount' => $valiDate['rating_amount'],
            'lowest_rating_text' => $valiDate['lowest_rating_text'],
            'highest_rating' => $valiDate['highest_rating'],
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
    public function option_Star_Rating_create_get(Request $request,$ratihn_style,$lowest,$rating_amount,$lowest_rating_text,$highest_rating,$form_id)
    {
        $valiDate = $this->validate($request, [
//            'ratihn_style' => 'required|numeric',
//            'lowest' => 'required|numeric',
//            'rating_amount' => 'numeric',
//            'lowest_rating_text' => '',
//            'highest_rating' => '',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->foption()->create([
            'ratihn_style' => $ratihn_style,
            'lowest' => $lowest,
            'rating_amount' => $rating_amount,
            'lowest_rating_text' => $lowest_rating_text,
            'highest_rating' => $highest_rating,
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
    public function option_Star_Rating_create_fa(Request $request,$fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
            'ratihn_style' => 'required|numeric',//or 1 or 0   شامل این دو تا کارادتر می باشد
            'lowest' => 'required|numeric',
            'rating_amount' => 'numeric',
            'lowest_rating_text' => '',
            'highest_rating' => '',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->foption()->create([
            'ratihn_style' => $valiDate['ratihn_style'],//or 1 or 0   شامل این دو تا کارادتر می باشد
            'lowest' => $valiDate['lowest'],
            'rating_amount' => $valiDate['rating_amount'],
            'lowest_rating_text' => $valiDate['lowest_rating_text'],
            'highest_rating' => $valiDate['highest_rating'],
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
    public function option_Star_Rating_create_get_fa(Request $request,$ratihn_style,$lowest,$rating_amount,$lowest_rating_text,$highest_rating,$form_id,$fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
//            'ratihn_style' => 'required|numeric',
//            'lowest' => 'required|numeric',
//            'rating_amount' => 'numeric',
//            'lowest_rating_text' => '',
//            'highest_rating' => '',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->foption()->create([
            'ratihn_style' => $ratihn_style,//or 1 or 0   شامل این دو تا کارادتر می باشد
            'lowest' => $lowest,
            'rating_amount' => $rating_amount,
            'lowest_rating_text' => $lowest_rating_text,
            'highest_rating' => $highest_rating,
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
    public function option_Star_Rating_show($id)
    {
        $ee= Option_answerModel::where([['id',$id],['admin_id',auth()->user()->id]])->get(['id','ratihn_style','lowest','rating_amount','lowest_rating_text','highest_rating']);
        $r= implode(', ',array($ee));
        $t=str_replace('[',' ',$r);
        $e= str_replace(']',' ',$t);
        $q= str_replace('\n',' ',$e);
        return $q;
    }
    public function option_Star_Rating_showall($form_id)
    {
        $ee= Option_answerModel::where([['admin_id',auth()->user()->id],['form_id',$form_id]])->orderby('id','desc')->paginate(5);
        return $ee;
    }
    public function option_Star_Rating_edit(Request $request,$id)
    {
        $valiDate = $this->validate($request, [
            'ratihn_style' => 'required|numeric',//or 1 or 0   شامل این دو تا کارادتر می باشد
            'lowest' => 'required|numeric',
            'rating_amount' => 'numeric',
            'lowest_rating_text' => '',
            'highest_rating' => '',
        ]);
        $user = Option_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->ratihn_style = $valiDate['ratihn_style'];//or 1 or 0   شامل این دو تا کارادتر می باشد
            $user->lowest = $valiDate['lowest'];
            $user->rating_amount = $valiDate['rating_amount'];
            $user->lowest_rating_text = $valiDate['lowest_rating_text'];
            $user->highest_rating = $valiDate['highest_rating'];

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
    public function option_Star_Rating_edit_get(Request $request,$id,$ratihn_style,$lowest,$rating_amount,$lowest_rating_text,$highest_rating)
    {
        $valiDate = $this->validate($request, [
//            'ratihn_style' => 'required|numeric',
//            'lowest' => 'required|numeric',
//            'rating_amount' => 'numeric',
//            'lowest_rating_text' => '',
//            'highest_rating' => '',
        ]);
        $user = Option_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->ratihn_style = $ratihn_style;//or 1 or 0   شامل این دو تا کارادتر می باشد
            $user->lowest = $lowest;
            $user->rating_amount = $rating_amount;
            $user->lowest_rating_text = $lowest_rating_text;
            $user->highest_rating = $highest_rating;

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
    public function option_Star_Rating_edit_get_fa(Request $request,$id,$ratihn_style,$lowest,$rating_amount,$lowest_rating_text,$highest_rating,$fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
//            'ratihn_style' => 'required|numeric',
//            'lowest' => 'required|numeric',
//            'rating_amount' => 'numeric',
//            'lowest_rating_text' => '',
//            'highest_rating' => '',
        ]);
        $user = Option_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->ratihn_style = $ratihn_style;//or 1 or 0   شامل این دو تا کارادتر می باشد
            $user->lowest = $lowest;
            $user->rating_amount = $rating_amount;
            $user->lowest_rating_text = $lowest_rating_text;
            $user->highest_rating = $highest_rating;

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
//---------------------------------------End option  star rating ------------------------------------------

}