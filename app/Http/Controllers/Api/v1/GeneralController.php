<?php

namespace App\Http\Controllers\Api\v1;

use App\General_answerModel;
use App\GeneralModel;
use App\HeadingModel;
use App\ToolsModel;
use Carbon\Carbon;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\LangsModel;
use function Sodium\crypto_box_publickey_from_secretkey;

class GeneralController extends Controller
{
    //------------------------------------------show every field   and بین تمامتابع ها مشترک است -------------------------------------
    public function show1(Request $request, $name)
    {
        $d = GeneralModel::where('id', '102')->take(1)->pluck($name);
        $r = implode(', ', array($d));
        $t = str_replace('[', ' ', $r);
        $e = str_replace(']', ' ', $t);
        return $e;
    }
    public function showall()
    {
        return General_answerModel::where('admin_id', auth()->user()->id)->paginate(10);
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


    //-------------------------------start Heading----------------------------------------------------

    public function heading_show_en()
    {
        $d = GeneralModel::where('id', '102')->orderby('id', 'desc')->take(1)
            ->get(['heading_text', 'sub_heading_text', 'previous', 'next', 'section_question'])->toArray();
        $r = implode(', ', array_values($d[0]));
        $t = str_replace('[', ' ', $r);
        $e = str_replace(']', ' ', $t);
        $arr = explode(",", $e);
        $j = 0;
        //print_r($arr);
        //echo "<br>";
        //print_r($arr[7]);
        foreach ($arr as $key) {
            echo $key . '\n';
            $j++;
        }
    }
    public function heading_show_fa($fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $d = GeneralModel::where('id', '102')->orderby('id', 'desc')->take(1)
            ->get(['heading_text_fa', 'sub_heading_text_fa', 'previous_fa', 'next_fa', 'section_question_fa'])->toArray();
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
    public function heading_create(Request $request)
    {
        $valiDate = $this->validate($request, [
            'type_name'=>'required|exists:tool,id',
            'heading_text' => ' ',
            'sub_heading_text' => '',
            'previous' => '',
            'next' => '',
            'section_question' => '',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->f()->create([
            'type_name'=>$valiDate['type_name'],
            'heading_text' => $valiDate['heading_text'],
            'sub_heading_text' => $valiDate['sub_heading_text'],
            'previous' => $valiDate['previous'],
            'next' => $valiDate['next'],
            '
            ' => $valiDate['section_question'],
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
    public function heading_create_fa(Request $request,$fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
            'type_name'=>'required|exists:tool,id',
            'heading_text' => '',
            'sub_heading_text' => '',
            'previous' => '',
            'next' => '',
            'section_question' => '',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->f()->create([
            'type_name'=>$valiDate['type_name'],
            'heading_text' => $valiDate['heading_text'],
            'sub_heading_text' => $valiDate['sub_heading_text'],
            'previous' => $valiDate['previous'],
            'next' => $valiDate['next'],
            'section_question' => $valiDate['section_question'],
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

    public function heading_edit(Request $request,$id)
    {
        $valiDate = $this->validate($request, [
            'heading_text' => '',
            'sub_heading_text' => '',
            'previous' => '',
            'next' => '',
            'section_question' => '',

        ]);
        $user = General_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->heading_text = $valiDate['heading_text'];
            $user->sub_heading_text = strtoupper($valiDate['sub_heading_text']);
            $user->previous = $valiDate['previous'];
            $user->next = $valiDate['next'];
            $user->section_question = $valiDate['section_question'];


            if ($user->update()) {
                return response([
                    'data' => [
                        'message' => ' form is register',
                    ],
                    'status' => 'success',
                    //'info' => $user
                ]);
            }
        } else {
            return "Id not found";
        }
    }
    public function heading_edit_fa(Request $request,$id,$fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
            'heading_text' => '',
            'sub_heading_text' => '',
            'previous' => '',
            'next' => '',
            'section_question' => '',

        ]);
        $user = General_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->heading_text = $valiDate['heading_text'];
            $user->sub_heading_text = strtoupper($valiDate['sub_heading_text']);
            $user->previous = $valiDate['previous'];
            $user->next = $valiDate['next'];
            $user->section_question = $valiDate['section_question'];


            if ($user->update()) {
                return response([
                    'داده' => [
                        'پیام' => ' آپدیت شد',
                    ],
                    'وضعیت' => 'با موفقیت',
                    //'info' => $user
                    'زبان'=>$q
                ]);
            }
        } else {
            return "پیدا نشد";
        }
    }

    public function heading_delete($id)
    {
        $t = General_answerModel::where([['id', $id], ['admin_id', auth()->user()->id]])->delete();
        if ($t) {
            return response([

                'data' => 'delete with successfull'
            ]);
        } else {
            return "id not found";
        }
    }

    public function heading_delete_fa($id, $fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $t = General_answerModel::where([['id', $id], ['admin_id', auth()->user()->id]])->delete();
        if ($t) {
            return response([

                'data' => 'کاربر پاک شد',
                'زبان' => $q
            ]);
        } else {
            return "این id وجود ندارد";
        }
    }
    public function heading_show($id, $name)
    {
        $e = General_answerModel::where([['id', $id], ['admin_id', auth()->user()->id]])->take(1)->pluck($name);
        return $e;
    }


    //-------------------------------End Heading----------------------------------------------------
    //-------------------------------start fullname-------------------------------------------------
    public function fullnameshow_en()
    {
        $d = GeneralModel::where('id', '102')->orderby('id', 'desc')->take(1)
            ->get(['name_en', 'description_en', 'left_en', 'right_en', 'top_en', 'required_en', 'sublabels_en', 'sublabel_firstname', 'sublabel_lastname'])->toArray();
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
    public function fullnameshow_fa($fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');

        $d = GeneralModel::where('id', '102')->orderby('id', 'desc')->take(1)
            ->get(['name_fa', 'description_fa', 'left_fa', 'right_fa', 'top_fa', 'required_fa', 'sublabels_fa', 'sublabel_firstname_fa', 'sublabel_lastname_fa'])->toArray();

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

    public function create(Request $request)
    {
        $valiDate = $this->validate($request, [
            'type_name'=>'required|exists:tool,id',
            'name' => '',
            'description' => '',
            'label' => '',
            'requireds' => '',
            'firstname' => '',
            'lastname' => '',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->f()->create([
            'type_name'=>$valiDate['type_name'],
            'name' => $valiDate['name'],
            'description' => $valiDate['description'],
            'label' => $valiDate['label'],
            'requireds' => $valiDate['requireds'],
            'firstname' => $valiDate['firstname'],
            'lastname' => $valiDate['lastname'],
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
    public function create1(Request $request, $fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');

        $valiDate = $this->validate($request, [
            'type_name'=>'required|exists:tool,id',
            'name' => '',
            'description' => '',
            'label' => '',
            'requireds' => '',
            'firstname' => '',
            'lastname' => '',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->f()->create([
            'type_name'=>$valiDate['type_name'],
            'name' => $valiDate['name'],
            'description' => $valiDate['description'],
            'label' => $valiDate['label'],
            'requireds' => $valiDate['requireds'],
            'firstname' => $valiDate['firstname'],
            'lastname' => $valiDate['lastname'],
            'form_id' => $valiDate['form_id']
        ]);
        return response([
            'داده' => [
                'پیام' => 'ایجاد شد',
            ],
            'وضعیت' => 'با موفقیت',
            'ID' => $y->id,
            'زبان' => $q

        ]);
    }
    public function show($id, $name)
    {
        $e = General_answerModel::where([['id', $id], ['admin_id', auth()->user()->id]])->take(1)->pluck($name);
        return $e;
    }
    public function edit(Request $request, $id)
    {

        $valiDate = $this->validate($request, [
            'name' => '',
            'description' => '',
            'label' => '',
            'requireds' => '',
            'firstname' => '',
            'lastname' => '',

        ]);
        $user = General_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->name = $valiDate['name'];
            $user->description = strtoupper($valiDate['description']);
            $user->label = $valiDate['label'];
            $user->requireds = $valiDate['requireds'];
            $user->firstname = $valiDate['firstname'];
            $user->lastname = $valiDate['lastname'];


            if ($user->update()) {
                return response([
                    'data' => [
                        'message' => ' form is register',
                    ],
                    'status' => 'success',
                    //'info' => $user
                ]);
            }
        } else {
            return "Id not found";
        }
    }

    public function edit1(Request $request, $id, $fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');

        $valiDate = $this->validate($request, [
            'name' => '',
            'description' => '',
            'label' => '',
            'requireds' => '',
            'firstname' => '',
            'lastname' => '',

        ]);
        $user = General_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->name = $valiDate['name'];
            $user->description = strtoupper($valiDate['description']);
            $user->label = $valiDate['label'];
            $user->requireds = $valiDate['requireds'];
            $user->firstname = $valiDate['firstname'];
            $user->lastname = $valiDate['lastname'];


            if ($user->update()) {
                return response([
                    'داده' => [
                        'پیام' => ' آپدیت شد',
                    ],
                    'وضعیت' => 'با موفقیت ',
                    //'اطلاعات' => $user,
                    'زبان' => $q
                ]);
            }
        } else {
            return "چنین مشخصاتی وجود ندارد";
        }
    }

    public function delete($id)
    {
        $t = General_answerModel::where([['id', $id], ['admin_id', auth()->user()->id]])->delete();
        if ($t) {
            return response([

                'data' => 'delete with successfull'
            ]);
        } else {
            return "id not found";
        }
    }

    public function delete1($id, $fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $t = General_answerModel::where([['id', $id], ['admin_id', auth()->user()->id]])->delete();
        if ($t) {
            return response([

                'data' => 'کاربر پاک شد',
                'زبان' => $q
            ]);
        } else {
            return "این id وجود ندارد";
        }
    }
//-----------------------------------------Endfullname--------------------------------------------
//------------------------------------------start email--------------------------------------------
    public function emailshow_en()
    {
        $d = GeneralModel::where('id', '102')->orderby('id', 'desc')->take(1)
            ->get(['name_en', 'description_en', 'left_en', 'right_en', 'top_en', 'required_en', 'sublabels_en', 'sublabel_email'])->toArray();

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
    public function emailshow_fa($fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');

        $d = GeneralModel::where('id', '102')->orderby('id', 'desc')->take(1)
            ->get(['name_fa', 'description_fa', 'left_fa', 'right_fa', 'top_fa', 'required_fa', 'sublabels_fa', 'sublabel_email_fa'])->toArray();

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

    public function email_create(Request $request)
    {
        $valiDate = $this->validate($request, [
            'type_name'=>'required|exists:tool,id',
            'name' => '',
            'description' => '',
            'label' => '',
            'requireds' => '',
            'email' => '',
            'form_id' => 'exists:forms,id'//این رو باید یک تکست باکس مخفی بگیره و آی دی  رو بهش بدیم
        ]);
        $y = auth()->user()->f()->create([
            'type_name'=>$valiDate['type_name'],
            'name' => $valiDate['name'],
            'description' => $valiDate['description'],
            'label' => $valiDate['label'],
            'requireds' => $valiDate['requireds'],
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

    public function email_create_fa(Request $request, $fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
            'type_name'=>'required|exists:tool,id',
            'name' => '',
            'description' => '',
            'label' => '',
            'requireds' => '',
            'email' => '',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->f()->create([
            'type_name'=>$valiDate['type_name'],
            'name' => $valiDate['name'],
            'description' => $valiDate['description'],
            'label' => $valiDate['label'],
            'requireds' => $valiDate['requireds'],
            'email' => $valiDate['firstname'],
            'form_id' => $valiDate['form_id']
        ]);
        return response([
            'داده' => [
                'پیام' => 'ایجاد شد',
            ],
            'وضعیت' => 'با موفقیت',
            'ID' => $y->id,
            'زبان' => $q
        ]);
    }

    public function email_edit(Request $request, $id)
    {

        $valiDate = $this->validate($request, [
            'name' => '',
            'description' => '',
            'label' => '',
            'requireds' => '',
            'email' => '',


        ]);
        $user = General_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->name = $valiDate['name'];
            $user->description = strtoupper($valiDate['description']);
            $user->label = $valiDate['label'];
            $user->requireds = $valiDate['requireds'];
            $user->email = $valiDate['email'];
            if ($user->update()) {
                return response([
                    'data' => [
                        'message' => ' form is update',
                    ],
                    'status' => 'success',
                    //'info' => $user
                ]);
            }
        } else {
            return "Id not found";
        }
    }

    public function email_edit_fa(Request $request, $id, $fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');

        $valiDate = $this->validate($request, [
            'name' => '',
            'description' => '',
            'label' => '',
            'requireds' => '',
            'email' => '',

        ]);
        $user = General_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->name = $valiDate['name'];
            $user->description = strtoupper($valiDate['description']);
            $user->label = $valiDate['label'];
            $user->requireds = $valiDate['requireds'];
            $user->email = $valiDate['email'];


            if ($user->update()) {
                return response([
                    'داده' => [
                        'پیام' => ' آپدیت شد',
                    ],
                    'وضعیت' => 'با موفقیت ',
                    //'اطلاعات' => $user,
                    'زبان' => $q
                ]);
            }
        } else {
            return "چنین مشخصاتی وجود ندارد";
        }
    }

    public function email_delete($id)
    {
        $t = General_answerModel::where([['id', $id], ['admin_id', auth()->user()->id]])->delete();
        if ($t) {
            return response([

                'data' => 'delete with successfull'
            ]);
        } else {
            return "id not found";
        }
    }

    public function email_delete_fa($id, $fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $t = General_answerModel::where([['id', $id], ['admin_id', auth()->user()->id]])->delete();
        if ($t) {
            return response([

                'data' => 'کاربر پاک شد',
                'زبان' => $q
            ]);
        } else {
            return "این id وجود ندارد";
        }
    }
    public function email_show($id, $name)
    {
        $e = General_answerModel::where([['id', $id], ['admin_id', auth()->user()->id]])->take(1)->pluck($name);
        return $e;
    }
//------------------------------------------end email-----------------------------------------------
//----------------------------------------Start address--------------------------------------------
    public function address_show_en()
    {
        $d = GeneralModel::where('id', '102')->orderby('id', 'desc')->take(1)
            ->get(['name_en', 'description_en', 'left_en', 'right_en', 'top_en', 'required_en', 'sublabels_en',
                'street_address1', 'street_address2', 'city', 'postal/zip_code', 'state/province'])->toArray();

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

    public function address_show_fa($fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');

        $d = GeneralModel::where('id', '102')->orderby('id', 'desc')->take(1)
            ->get(['name_fa', 'description_fa', 'left_fa', 'right_fa', 'top_fa', 'required_fa', 'sublabels_fa',
                'street address1_fa', 'street address2_fa', 'city_fa', 'postal/zip_code_fa', 'state/province_fa'])->toArray();

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

    public function address_create(Request $request)
    {
        $valiDate = $this->validate($request, [
            'type_name'=>'required|exists:tool,id',
            'name' => '',
            'description' => '',
            'label' => '',
            'requireds' => '',
            'address1' => '',
            'address2' => '',
            'city' => '',
            'zip_code' => '',
            'province' => '',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->f()->create([
            'type_name'=>$valiDate['type_name'],
            'name' => $valiDate['name'],
            'description' => $valiDate['description'],
            'label' => $valiDate['label'],
            'requireds' => $valiDate['requireds'],
            'address1' => $valiDate['address1'],
            'address2' => $valiDate['address2'],
            'city' => $valiDate['city'],
            'zip_code' => $valiDate['zip_code'],
            'province' => $valiDate['province'],
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

    public function address_create_fa(Request $request, $fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');

        $valiDate = $this->validate($request, [
            'type_name'=>'required|exists:tool,id',
            'name' => '',
            'description' => '',
            'label' => '',
            'requireds' => '',
            'address1' => '',
            'address2' => '',
            'city' => '',
            'zip_code' => '',
            'province' => '',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->f()->create([
            'type_name'=>$valiDate['type_name'],
            'name' => $valiDate['name'],
            'description' => $valiDate['description'],
            'label' => $valiDate['label'],
            'requireds' => $valiDate['requireds'],
            'address1' => $valiDate['address1'],
            'address2' => $valiDate['address2'],
            'city' => $valiDate['city'],
            'zip_code' => $valiDate['zip_code'],
            'province' => $valiDate['province'],
            'form_id' => $valiDate['form_id']
        ]);
        return response([
            'داده' => [
                'پیام' => 'ایجاد شد',
            ],
            'وضعیت' => 'با موفقیت',
            'ID' => $y->id,
            'زبان' => $q

        ]);
    }

    public function address_edit(Request $request, $id)
    {
        $valiDate = $this->validate($request, [
            'name' => '',
            'description' => '',
            'label' => '',
            'requireds' => '',
            'address1' => '',
            'address2' => '',
            'city' => '',
            'zip_code' => '',
            'province' => '',
        ]);
        $user = General_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->name = $valiDate['name'];
            $user->description = strtoupper($valiDate['description']);
            $user->label = $valiDate['label'];
            $user->requireds = $valiDate['requireds'];
            $user->address1 = $valiDate['address1'];
            $user->address2 = $valiDate['address2'];
            $user->city = $valiDate['city'];
            $user->zip_code = $valiDate['zip_code'];
            $user->province = $valiDate['province'];

            if ($user->update()) {
                return response([
                    'data' => [
                        'message' => ' form is update',
                    ],
                    'status' => 'success',
                    //'info' => $user
                ]);
            }
        } else {
            return "Id not found";
        }
    }

    public function address_edit_fa(Request $request, $id, $fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');

        $valiDate = $this->validate($request, [
            'name' => '',
            'description' => '',
            'label' => '',
            'requireds' => '',
            'address1' => '',
            'address2' => '',
            'city' => '',
            'zip_code' => '',
            'province' => '',
        ]);
        $user = General_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->name = $valiDate['name'];
            $user->description = strtoupper($valiDate['description']);
            $user->label = $valiDate['label'];
            $user->requireds = $valiDate['requireds'];
            $user->address1 = $valiDate['address1'];
            $user->address2 = $valiDate['address2'];
            $user->city = $valiDate['city'];
            $user->zip_code = $valiDate['zip_code'];
            $user->province = $valiDate['province'];

            if ($user->update()) {
                return response([
                    'داده' => [
                        'پیام' => ' فرم آپدیت شد',
                    ],
                    'وضعیت' => 'با موفقیت',
                    //'info' => $user
                    'زبان' => $q
                ]);
            }
        } else {
            return "Id not found";
        }
    }

    public function address_delete($id)
    {
        $t = General_answerModel::where([['id', $id], ['admin_id', auth()->user()->id]])->delete();
        if ($t) {
            return response([

                'data' => 'delete with successfull'
            ]);
        } else {
            return "id not found";
        }
    }

    public function address_delete_fa($id, $fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $t = General_answerModel::where([['id', $id], ['admin_id', auth()->user()->id]])->delete();
        if ($t) {
            return response([

                'data' => 'کاربر پاک شد',
                'زبان' => $q
            ]);
        } else {
            return "این id وجود ندارد";
        }
    }
    public function address_show($id, $name)//$name یعنی اینکه بر اساس هر فیلدی که این جدول دارد نمایش میده مثلا id,form_id,...
    {
        $e = General_answerModel::where([['id', $id], ['admin_id', auth()->user()->id]])->take(1)->pluck($name);
        return $e;
    }
//----------------------------------------End address----------------------------------------------
//------------------------------------------start phone number------------------------------------
    public function phone_number_show_en()
    {
        $d = GeneralModel::where('id', '102')->orderby('id', 'desc')->take(1)
            ->get(['name_en', 'description_en', 'left_en', 'right_en', 'top_en', 'required_en', 'sublabels_en',
                'Area_Code', 'phone'])->toArray();

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

    public function phone_number_show_fa($fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');

        $d = GeneralModel::where('id', '102')->orderby('id', 'desc')->take(1)
            ->get(['name_fa', 'description_fa', 'left_fa', 'right_fa', 'top_fa', 'required_fa', 'sublabels_fa',
                'Area_Code_fa', 'phone_fa'])->toArray();

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

    public function phone_number_create(Request $request)
    {
        $valiDate = $this->validate($request, [
            'type_name'=>'required|exists:tool,id',
            'name' => '',
            'description' => '',
            'label' => '',
            'requireds' => '',
            'Area_Code' => '',
            'phone' => '',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->f()->create([
            'type_name'=>$valiDate['type_name'],
            'name' => $valiDate['name'],
            'description' => $valiDate['description'],
            'label' => $valiDate['label'],
            'requireds' => $valiDate['requireds'],
            'Area_Code' => $valiDate['Area_Code'],
            'phone' => $valiDate['phone'],
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

    public function phone_number_create_fa(Request $request, $fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
            'type_name'=>'required|exists:tool,id',
            'name' => '',
            'description' => '',
            'label' => '',
            'requireds' => '',
            'Area_Code' => '',
            'phone' => '',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->f()->create([
            'type_name'=>$valiDate['type_name'],
            'name' => $valiDate['name'],
            'description' => $valiDate['description'],
            'label' => $valiDate['label'],
            'requireds' => $valiDate['requireds'],
            'Area_Code' => $valiDate['Area_Code'],
            'phone' => $valiDate['phone'],
            'form_id' => $valiDate['form_id']
        ]);
        return response([
            'data' => [
                'message' => 'form is registered',
            ],
            'status' => 'success',
            'ID' => $y->id,
            'زبان' => $q

        ]);


    }

    public function phone_number_edit(Request $request, $id)
    {
        $valiDate = $this->validate($request, [
            'name' => '',
            'description' => '',
            'label' => '',
            'requireds' => '',
            'Area_Code' => '',
            'phone' => '',
        ]);
        $user = General_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->name = $valiDate['name'];
            $user->description = strtoupper($valiDate['description']);
            $user->label = $valiDate['label'];
            $user->requireds = $valiDate['requireds'];
            $user->Area_Code = $valiDate['Area_Code'];
            $user->phone = $valiDate['phone'];


            if ($user->update()) {
                return response([
                    'data' => [
                        'message' => ' form is update',
                    ],
                    'status' => 'success',
                    //'info' => $user
                ]);
            }
        } else {
            return "Id not found";
        }
    }

    public function phone_number_edit_fa(Request $request, $id, $fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');

        $valiDate = $this->validate($request, [
            'name' => '',
            'description' => '',
            'label' => '',
            'requireds' => '',
            'Area_Code' => '',
            'phone' => '',
        ]);
        $user = General_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->name = $valiDate['name'];
            $user->description = strtoupper($valiDate['description']);
            $user->label = $valiDate['label'];
            $user->requireds = $valiDate['requireds'];
            $user->Area_Code = $valiDate['Area_Code'];
            $user->phone = $valiDate['phone'];

            if ($user->update()) {
                return response([
                    'داده' => [
                        'پیام' => ' فرم آپدیت شد',
                    ],
                    'وضعیت' => 'با موفقیت',
                    //'info' => $user
                    'زبان' => $q
                ]);
            }
        } else {
            return "Id not found";
        }
    }

    public function phone_number_delete($id)
    {
        $t = General_answerModel::where([['id', $id], ['admin_id', auth()->user()->id]])->delete();
        if ($t) {
            return response([

                'data' => 'delete with successfull'
            ]);
        } else {
            return "id not found";
        }
    }

    public function phone_number_delete_fa($id, $fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $t = General_answerModel::where([['id', $id], ['admin_id', auth()->user()->id]])->delete();
        if ($t) {
            return response([

                'data' => 'کاربر پاک شد',
                'زبان' => $q
            ]);
        } else {
            return "این id وجود ندارد";
        }
    }
    public function phone_number_show($id, $name)
    {
        $e = General_answerModel::where([['id', $id], ['admin_id', auth()->user()->id]])->take(1)->pluck($name);
        return $e;
    }
//------------------------------------------End phone number------------------------------------
//-------------------------------------------start Date Picker--------------------------------------------------
    public function datepicker_show_en()
    {
        $d = GeneralModel::where('id', '102')->orderby('id', 'desc')->take(1)
            ->get(['name_en', 'description_en', 'left_en', 'right_en', 'top_en', 'required_en', 'sublabels_en',
                'date'])->toArray();

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

    public function datepicker_show_fa($fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');

        $d = GeneralModel::where('id', '102')->orderby('id', 'desc')->take(1)
            ->get(['name_fa', 'description_fa', 'left_fa', 'right_fa', 'top_fa', 'required_fa', 'sublabels_fa',
                'date_fa'])->toArray();

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

    public function datepicker_create(Request $request)
    {
        $valiDate = $this->validate($request, [
            'type_name'=>'required|exists:tool,id',
            'name' => '',
            'description' => '',
            'label' => '',
            'requireds' => '',
            'updated_at' => '',//updated_at equal date ka dar gadval general vogod darad
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->f()->create([
            'type_name'=>$valiDate['type_name'],
            'name' => $valiDate['name'],
            'description' => $valiDate['description'],
            'label' => $valiDate['label'],
            'requireds' => $valiDate['requireds'],
            'updated_at' => $valiDate['updated_at'],
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

    public function datepicker_create_fa(Request $request, $fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
            'type_name'=>'required|exists:tool,id',
            'name' => '',
            'description' => '',
            'label' => '',
            'requireds' => '',
            'updated_at' => '',//updated_at equal date ka dar gadval general vogod darad
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->f()->create([
            'type_name'=>$valiDate['type_name'],
            'name' => $valiDate['name'],
            'description' => $valiDate['description'],
            'label' => $valiDate['label'],
            'requireds' => $valiDate['requireds'],
            'updated_at' => $valiDate['updated_at'],
            'form_id' => $valiDate['form_id']
        ]);
        return response([
            'data' => [
                'message' => 'form is registered',
            ],
            'status' => 'success',
            'ID' => $y->id,
            'زبان' => $q

        ]);
    }

    public function datepicker_edit(Request $request, $id)
    {
        $valiDate = $this->validate($request, [
            'name' => '',
            'description' => '',
            'label' => '',
            'requireds' => '',
            'updated_at' => '',
        ]);
        $user = General_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->name = $valiDate['name'];
            $user->description = strtoupper($valiDate['description']);
            $user->label = $valiDate['label'];
            $user->requireds = $valiDate['requireds'];
            $user->updated_at = $valiDate['updated_at'];


            if ($user->update()) {
                return response([
                    'data' => [
                        'message' => ' form is update',
                    ],
                    'status' => 'success',
                    //'info' => $user
                ]);
            }
        } else {
            return "Id not found";
        }
    }

    public function datepicker_edit_fa(Request $request, $id, $fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');

        $valiDate = $this->validate($request, [
            'name' => '',
            'description' => '',
            'label' => '',
            'requireds' => '',
            'updated_at' => '',
        ]);
        $user = General_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->name = $valiDate['name'];
            $user->description = strtoupper($valiDate['description']);
            $user->label = $valiDate['label'];
            $user->requireds = $valiDate['requireds'];
            $user->updated_at = $valiDate['updated_at'];


            if ($user->update()) {
                return response([
                    'داده' => [
                        'پیام' => ' فرم آپدیت شد',
                    ],
                    'وضعیت' => 'با موفقیت',
                    //'info' => $user
                    'زبان' => $q
                ]);
            }
        } else {
            return "Id not found";
        }
    }

    public function datepicker_delete($id)
    {
        $t = General_answerModel::where([['id', $id], ['admin_id', auth()->user()->id]])->delete();
        if ($t) {
            return response([

                'data' => 'delete with successfull'
            ]);
        } else {
            return "id not found";
        }
    }

    public function datepicker_delete_fa($id, $fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $t = General_answerModel::where([['id', $id], ['admin_id', auth()->user()->id]])->delete();
        if ($t) {
            return response([

                'data' => 'کاربر پاک شد',
                'زبان' => $q
            ]);
        } else {
            return "این id وجود ندارد";
        }
    }
    public function datepicker_show($id, $name)
    {
        $e = General_answerModel::where([['id', $id], ['admin_id', auth()->user()->id]])->take(1)->pluck($name);
        return $e;
    }
//------------------------------------------End Date Picker----------------------------------------
//-------------------------------------------start Timer--------------------------------------------------
    public function timer_show_en()
    {
        $d = GeneralModel::where('id', '102')->orderby('id', 'desc')->take(1)
            ->get(['name_en', 'description_en', 'left_en', 'right_en', 'top_en', 'required_en', 'sublabels_en',
                'hour', 'minutes'])->toArray();

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

    public function timer_show_fa($fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');

        $d = GeneralModel::where('id', '102')->orderby('id', 'desc')->take(1)
            ->get(['name_fa', 'description_fa', 'left_fa', 'right_fa', 'top_fa', 'required_fa', 'sublabels_fa',
                'hour_fa', 'minutes_fa'])->toArray();

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

    public function timer_create(Request $request)
    {
        $valiDate = $this->validate($request, [
            'type_name'=>'required|exists:tool,id',
            'name' => '',
            'description' => '',
            'label' => '',
            'requireds' => '',
            'hour' => '',
            'minutes' => '',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->f()->create([
            'type_name'=>$valiDate['type_name'],
            'name' => $valiDate['name'],
            'description' => $valiDate['description'],
            'label' => $valiDate['label'],
            'requireds' => $valiDate['requireds'],
            'hour' => $valiDate['hour'],
            'minutes' => $valiDate['minutes'],
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

    public function timer_create_fa(Request $request, $fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');

        $valiDate = $this->validate($request, [
            'type_name'=>'required|exists:tool,id',
            'name' => '',
            'description' => '',
            'label' => '',
            'requireds' => '',
            'hour' => '',
            'minutes' => '',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->f()->create([
            'type_name'=>$valiDate['type_name'],
            'name' => $valiDate['name'],
            'description' => $valiDate['description'],
            'label' => $valiDate['label'],
            'requireds' => $valiDate['requireds'],
            'hour' => $valiDate['hour'],
            'minutes' => $valiDate['minutes'],
            'form_id' => $valiDate['form_id']
        ]);
        return response([
            'data' => [
                'message' => 'form is registered',
            ],
            'status' => 'success',
            'ID' => $y->id,
            'زبان' => $q

        ]);
    }

    public function timer_edit(Request $request, $id)
    {
        $valiDate = $this->validate($request, [
            'name' => '',
            'description' => '',
            'label' => '',
            'requireds' => '',
            'hour' => '',
            'minutes' => '',
        ]);
        $user = General_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->name = $valiDate['name'];
            $user->description = strtoupper($valiDate['description']);
            $user->label = $valiDate['label'];
            $user->requireds = $valiDate['requireds'];
            $user->hour = $valiDate['hour'];
            $user->minutes = $valiDate['minutes'];
            if ($user->update()) {
                return response([
                    'data' => [
                        'message' => ' form is update',
                    ],
                    'status' => 'success',
                    //'info' => $user
                ]);
            }
        } else {
            return "Id not found";
        }
    }

    public function timer_edit_fa(Request $request, $id, $fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
            'name' => '',
            'description' => '',
            'label' => '',
            'requireds' => '',
            'hour' => '',
            'minutes' => '',
        ]);
        $user = General_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->name = $valiDate['name'];
            $user->description = strtoupper($valiDate['description']);
            $user->label = $valiDate['label'];
            $user->requireds = $valiDate['requireds'];
            $user->hour = $valiDate['hour'];
            $user->minutes = $valiDate['minutes'];
            if ($user->update()) {
                return response([
                    'داده' => [
                        'پیام' => ' فرم آپدیت شد',
                    ],
                    'وضعیت' => 'با موفقیت',
                    //'info' => $user
                    'زبان' => $q
                ]);
            }
        } else {
            return "Id not found";
        }
    }

    public function timer_delete($id)
    {
        $t = General_answerModel::where([['id', $id], ['admin_id', auth()->user()->id]])->delete();
        if ($t) {
            return response([

                'data' => 'delete with successfull'
            ]);
        } else {
            return "id not found";
        }
    }

    public function timer_delete_fa($id, $fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $t = General_answerModel::where([['id', $id], ['admin_id', auth()->user()->id]])->delete();
        if ($t) {
            return response([

                'data' => 'کاربر پاک شد',
                'زبان' => $q
            ]);
        } else {
            return "این id وجود ندارد";
        }
    }
    public function timer_show($id, $name)
    {
        $e = General_answerModel::where([['id', $id], ['admin_id', auth()->user()->id]])->take(1)->pluck($name);
        return $e;
    }
//----------------------------------------------End Timer--------------------------------------------------
//-------------------------------------------start short text entry--------------------------------------------------
    public function short_text_show_en()
    {
        $d = GeneralModel::where('id', '102')->orderby('id', 'desc')->take(1)
            ->get(['name_en', 'description_en', 'left_en', 'right_en', 'top_en', 'required_en', 'sublabels_en',
            ])->toArray();

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

    public function short_text_show_fa($fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $d = GeneralModel::where('id', '102')->orderby('id', 'desc')->take(1)
            ->get(['name_fa', 'description_fa', 'left_fa', 'right_fa', 'top_fa', 'required_fa', 'sublabels_fa',
            ])->toArray();

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

    public function short_text_create(Request $request)
    {
        $valiDate = $this->validate($request, [
            'type_name'=>'required|exists:tool,id',
            'name' => '',
            'description' => '',
            'label' => '',
            'requireds' => '',
            'discription_short_text' => '',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->f()->create([
            'type_name'=>$valiDate['type_name'],
            'name' => $valiDate['name'],
            'description' => $valiDate['description'],
            'label' => $valiDate['label'],
            'requireds' => $valiDate['requireds'],
            'discription_short_text' => $valiDate['discription_short_text'],
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

    public function short_text_create_fa(Request $request, $fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');

        $valiDate = $this->validate($request, [
            'type_name'=>'required|exists:tool,id',
            'name' => '',
            'description' => '',
            'label' => '',
            'requireds' => '',
            'discription_short_text' => '',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->f()->create([
            'type_name'=>$valiDate['type_name'],
            'name' => $valiDate['name'],
            'description' => $valiDate['description'],
            'label' => $valiDate['label'],
            'requireds' => $valiDate['requireds'],
            'discription_short_text' => $valiDate['discription_short_text'],
            'form_id' => $valiDate['form_id']
        ]);
        return response([
            'data' => [
                'message' => 'form is registered',
            ],
            'status' => 'success',
            'ID' => $y->id,
            'زبان' => $q

        ]);
    }

    public function short_text_edit(Request $request, $id)
    {
        $valiDate = $this->validate($request, [
            'name' => '',
            'description' => '',
            'label' => '',
            'requireds' => '',
            'discription_short_text' => '',

        ]);
        $user = General_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->name = $valiDate['name'];
            $user->description = strtoupper($valiDate['description']);
            $user->label = $valiDate['label'];
            $user->requireds = $valiDate['requireds'];
            $user->discription_short_text = $valiDate['discription_short_text'];

            if ($user->update()) {
                return response([
                    'data' => [
                        'message' => ' form is update',
                    ],
                    'status' => 'success',
                    //'info' => $user
                ]);
            }
        } else {
            return "Id not found";
        }
    }

    public function short_text_edit_fa(Request $request, $id, $fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
            'name' => '',
            'description' => '',
            'label' => '',
            'requireds' => '',
            'discription_short_text' => '',

        ]);
        $user = General_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->name = $valiDate['name'];
            $user->description = strtoupper($valiDate['description']);
            $user->label = $valiDate['label'];
            $user->requireds = $valiDate['requireds'];
            $user->discription_short_text = $valiDate['discription_short_text'];

            if ($user->update()) {
                return response([
                    'داده' => [
                        'پیام' => ' فرم آپدیت شد',
                    ],
                    'وضعیت' => 'با موفقیت',
                    //'info' => $user
                    'زبان' => $q
                ]);
            }
        } else {
            return "Id not found";
        }
    }

    public function short_text_delete($id)
    {
        $t = General_answerModel::where([['id', $id], ['admin_id', auth()->user()->id]])->delete();
        if ($t) {
            return response([

                'data' => 'delete with successfull'
            ]);
        } else {
            return "id not found";
        }
    }

    public function short_text_delete_fa($id, $fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $t = General_answerModel::where([['id', $id], ['admin_id', auth()->user()->id]])->delete();
        if ($t) {
            return response([

                'data' => 'کاربر پاک شد',
                'زبان' => $q
            ]);
        } else {
            return "این id وجود ندارد";
        }
    }
    public function short_text_show($id, $name)
    {
        $e = General_answerModel::where([['id', $id], ['admin_id', auth()->user()->id]])->take(1)->pluck($name);
        return $e;
    }
//-------------------------------------------End short text entry--------------------------------------------------
//-------------------------------------------start Long text ------------------------------------------------------
    public function long_text_show_en()
    {
        $d = GeneralModel::where('id', '102')->orderby('id', 'desc')->take(1)
            ->get(['name_en', 'description_en', 'left_en', 'right_en', 'top_en', 'required_en', 'sublabels_en',
            ])->toArray();

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

    public function long_text_show_fa($fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $d = GeneralModel::where('id', '102')->orderby('id', 'desc')->take(1)
            ->get(['name_fa', 'description_fa', 'left_fa', 'right_fa', 'top_fa', 'required_fa', 'sublabels_fa',
            ])->toArray();

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

    public function long_text_create(Request $request)
    {
        $valiDate = $this->validate($request, [
            'type_name'=>'required|exists:tool,id',
            'name' => '',
            'description' => '',
            'label' => '',
            'requireds' => '',
            'discription_long_text' => '',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->f()->create([
            'type_name'=>$valiDate['type_name'],
            'name' => $valiDate['name'],
            'description' => $valiDate['description'],
            'label' => $valiDate['label'],
            'requireds' => $valiDate['requireds'],
            'discription_long_text' => $valiDate['discription_long_text'],
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

    public function long_text_create_fa(Request $request, $fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
            'type_name'=>'required|exists:tool,id',
            'name' => '',
            'description' => '',
            'label' => '',
            'requireds' => '',
            'discription_long_text' => '',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->f()->create([
            'type_name'=>$valiDate['type_name'],
            'name' => $valiDate['name'],
            'description' => $valiDate['description'],
            'label' => $valiDate['label'],
            'requireds' => $valiDate['requireds'],
            'discription_long_text' => $valiDate['discription_long_text'],
            'form_id' => $valiDate['form_id']
        ]);
        return response([
            'data' => [
                'message' => 'form is registered',
            ],
            'status' => 'success',
            'ID' => $y->id,
            'زبان' => $q
        ]);
    }

    public function long_text_edit(Request $request, $id)
    {
        $valiDate = $this->validate($request, [
            'name' => '',
            'description' => '',
            'label' => '',
            'requireds' => '',
            'discription_long_text' => '',
        ]);
        $user = General_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->name = $valiDate['name'];
            $user->description = strtoupper($valiDate['description']);
            $user->label = $valiDate['label'];
            $user->requireds = $valiDate['requireds'];
            $user->discription_long_text = $valiDate['discription_long_text'];

            if ($user->update()) {
                return response([
                    'data' => [
                        'message' => ' form is update',
                    ],
                    'status' => 'success',
                    //'info' => $user
                ]);
            }
        } else {
            return "Id not found";
        }
    }

    public function long_text_edit_fa(Request $request, $id, $fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
            'name' => '',
            'description' => '',
            'label' => '',
            'requireds' => '',
            'discription_long_text' => '',

        ]);
        $user = General_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->name = $valiDate['name'];
            $user->description = strtoupper($valiDate['description']);
            $user->label = $valiDate['label'];
            $user->requireds = $valiDate['requireds'];
            $user->discription_long_text = $valiDate['discription_long_text'];

            if ($user->update()) {
                return response([
                    'داده' => [
                        'پیام' => ' فرم آپدیت شد',
                    ],
                    'وضعیت' => 'با موفقیت',
                    //'info' => $user
                    'زبان' => $q
                ]);
            }
        } else {
            return "Id not found";
        }
    }

    public function long_text_delete($id)
    {
        $t = General_answerModel::where([['id', $id], ['admin_id', auth()->user()->id]])->delete();
        if ($t) {
            return response([

                'data' => 'delete with successfull'
            ]);
        } else {
            return "id not found";
        }
    }

    public function long_text_delete_fa($id, $fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $t = General_answerModel::where([['id', $id], ['admin_id', auth()->user()->id]])->delete();
        if ($t) {
            return response([

                'data' => 'کاربر پاک شد',
                'زبان' => $q
            ]);
        } else {
            return "این id وجود ندارد";
        }
    }
    public function long_text_show($id, $name)
    {
        $e = General_answerModel::where([['id', $id], ['admin_id', auth()->user()->id]])->take(1)->pluck($name);
        return $e;
    }
//-------------------------------------------End Long text --------------------------------------------------------
//-------------------------------------------start text --------------------------------------------------------
    public function text_show_en()
    {
        $d = GeneralModel::where('id', '102')->orderby('id', 'desc')->take(1)
            ->get(['question_text',
            ])->toArray();

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

    public function text_show_fa($fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $d = GeneralModel::where('id', '102')->orderby('id', 'desc')->take(1)
            ->get(['question_text_fa',
            ])->toArray();

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

    public function text_create(Request $request)
    {
        $valiDate = $this->validate($request, [
            'type_name'=>'required|exists:tool,id',
            'question_text' => '',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->f()->create([
            'type_name'=>$valiDate['type_name'],
            'question_text' => $valiDate['question_text'],
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

    public function text_create_fa(Request $request, $fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
            'type_name'=>'required|exists:tool,id',
            'question_text' => '',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->f()->create([
            'type_name'=>$valiDate['type_name'],
            'question_text' => $valiDate['question_text'],
            'form_id' => $valiDate['form_id']
        ]);
        return response([
            'داده' => [
                'پیام' => 'ثبت شد',
            ],
            'وضعیت' => 'با موفقیت',
            'ID' => $y->id,
            'زبان' => $q
        ]);
    }

    public function text_edit(Request $request, $id)
    {
        $valiDate = $this->validate($request, [

            'question_text' => '',
        ]);
        $user = General_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {

            $user->question_text = $valiDate['question_text'];

            if ($user->update()) {
                return response([
                    'data' => [
                        'message' => ' form is update',
                    ],
                    'status' => 'success',
                    //'info' => $user
                ]);
            }
        } else {
            return "Id not found";
        }
    }

    public function text_edit_fa(Request $request, $id, $fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [

            'question_text' => '',
        ]);
        $user = General_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {

            $user->question_text = $valiDate['question_text'];

            if ($user->update()) {
                return response([
                    'داده' => [
                        'پیام' => ' فرم آپدیت شد',
                    ],
                    'وضعیت' => 'با موفقیت',
                    //'info' => $user
                    'زبان' => $q
                ]);
            }
        } else {
            return "Id not found";
        }
    }

    public function text_delete($id)
    {
        $t = General_answerModel::where([['id', $id], ['admin_id', auth()->user()->id]])->delete();
        if ($t) {
            return response([

                'data' => 'delete with successfull'
            ]);
        } else {
            return "id not found";
        }
    }

    public function text_delete_fa($id, $fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $t = General_answerModel::where([['id', $id], ['admin_id', auth()->user()->id]])->delete();
        if ($t) {
            return response([
                'data' => 'کاربر پاک شد',
                'زبان' => $q
            ]);
        } else {
            return "این id وجود ندارد";
        }
    }
    public function text_show($id, $name)
    {
        $e = General_answerModel::where([['id', $id], ['admin_id', auth()->user()->id]])->take(1)->pluck($name);
        return $e;
    }
//-------------------------------------------End text --------------------------------------------------------
//-------------------------------------------start dropdown --------------------------------------------------------
    public function dropdown_show_en()
    {
        $d = GeneralModel::where('id', '102')->orderby('id', 'desc')->take(1)
            ->get(['name_en', 'description_en', 'left_en', 'right_en', 'top_en', 'required_en', 'sublabels_en',
            ])->toArray();

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
    public function dropdown_show_fa($fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');

        $d = GeneralModel::where('id', '102')->orderby('id', 'desc')->take(1)
            ->get(['name_fa', 'description_fa', 'left_fa', 'right_fa', 'top_fa', 'required_fa', 'sublabels_fa',
                ])->toArray();

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

    public function dropdown_create(Request $request)
    {
        $valiDate = $this->validate($request, [
            'type_name'=>'required|exists:tool,id',
            'name' => '',
            'description' => '',
            'label' => '',
            'requireds' => '',
            'discription_dropdown' => '',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->f()->create([
            'type_name'=>$valiDate['type_name'],
            'name' => $valiDate['name'],
            'description' => $valiDate['description'],
            'label' => $valiDate['label'],
            'requireds' => $valiDate['requireds'],
            'discription_dropdown' => $valiDate['discription_dropdown'],
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
    public function dropdown_create_fa(Request $request,$fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
            'type_name'=>'required|exists:tool,id',
            'name' => '',
            'description' => '',
            'label' => '',
            'requireds' => '',
            'discription_dropdown' => '',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->f()->create([
            'type_name'=>$valiDate['type_name'],
            'name' => $valiDate['name'],
            'description' => $valiDate['description'],
            'label' => $valiDate['label'],
            'requireds' => $valiDate['requireds'],
            'discription_dropdown' => $valiDate['discription_dropdown'],
            'form_id' => $valiDate['form_id']
        ]);
        return response([
            'داده' => [
                'پیام' => 'ثبت شد',
            ],
            'وضعیت' => 'با موفقیت',
            'ID' => $y->id,
            'زبان' => $q
        ]);
    }
    public function dropdown_edit(Request $request, $id)
    {
        $valiDate = $this->validate($request, [
            'name' => '',
            'description' => '',
            'label' => '',
            'requireds' => '',
            'discription_dropdown' => '',
        ]);
        $user = General_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->name = $valiDate['name'];
            $user->description = strtoupper($valiDate['description']);
            $user->label = $valiDate['label'];
            $user->requireds = $valiDate['requireds'];
            $user->discription_dropdown = $valiDate['discription_dropdown'];

            if ($user->update()) {
                return response([
                    'data' => [
                        'message' => ' form is update',
                    ],
                    'status' => 'success',
                    //'info' => $user
                ]);
            }
        } else {
            return "Id not found";
        }
    }

    public function dropdown_edit_fa(Request $request, $id, $fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [

            'name' => '',
            'description' => '',
            'label' => '',
            'requireds' => '',
            'discription_dropdown' => '',        ]);
        $user = General_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->name = $valiDate['name'];
            $user->description = strtoupper($valiDate['description']);
            $user->label = $valiDate['label'];
            $user->requireds = $valiDate['requireds'];
            $user->discription_dropdown = $valiDate['discription_dropdown'];

            if ($user->update()) {
                return response([
                    'داده' => [
                        'پیام' => ' آپدیت شد',
                    ],
                    'وضعیت' => 'با موفقیت',
                    //'info' => $user
                ]);
            }
        } else {
            return "آیدی پیدا نشد";
        }
    }
    public function dropdown_delete($id)
    {
        $t = General_answerModel::where([['id', $id], ['admin_id', auth()->user()->id]])->delete();
        if ($t) {
            return response([

                'data' => 'delete with successfull'
            ]);
        } else {
            return "id not found";
        }
    }

    public function dropdown_delete_fa($id, $fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $t = General_answerModel::where([['id', $id], ['admin_id', auth()->user()->id]])->delete();
        if ($t) {
            return response([
                'data' => 'کاربر پاک شد',
                'زبان' => $q
            ]);
        } else {
            return "این id وجود ندارد";
        }
    }
    public function dropdown_show($id, $name)
    {
        $e = General_answerModel::where([['id', $id], ['admin_id', auth()->user()->id]])->take(1)->pluck($name);
        return $e;
    }
//-------------------------------------------End dropdown --------------------------------------------------------
//-------------------------------------------start single choice----------------------------------------
    public function single_choice_show_en()
    {
        $d = GeneralModel::where('id', '102')->orderby('id', 'desc')->take(1)
            ->get(['name_en', 'description_en', 'left_en', 'right_en', 'top_en', 'required_en','sublabels_en'
            ])->toArray();

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
    public function single_choice_show_fa($fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');

        $d = GeneralModel::where('id', '102')->orderby('id', 'desc')->take(1)
            ->get(['name_fa', 'description_fa', 'left_fa', 'right_fa', 'top_fa', 'required_fa','sublabels_fa'
            ])->toArray();

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
    public function single_choice_create(Request $request)
    {
        $valiDate = $this->validate($request, [
            'type_name'=>'required|exists:tool,id',
            'name' => '',
            'description' => '',
            'label' => '',
            'requireds' => '',
            'discription_single_choice' => '',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->f()->create([
            'type_name'=>$valiDate['type_name'],
            'name' => $valiDate['name'],
            'description' => $valiDate['description'],
            'label' => $valiDate['label'],
            'requireds' => $valiDate['requireds'],
            'discription_single_choice' => $valiDate['discription_single_choice'],
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
    public function single_choice_create_fa(Request $request,$fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
            'type_name'=>'required|exists:tool,id',
            'name' => '',
            'description' => '',
            'label' => '',
            'requireds' => '',
            'discription_single_choice' => '',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->f()->create([
            'type_name'=>$valiDate['type_name'],
            'name' => $valiDate['name'],
            'description' => $valiDate['description'],
            'label' => $valiDate['label'],
            'requireds' => $valiDate['requireds'],
            'discription_single_choice' => $valiDate['discription_single_choice'],
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
    public function single_choice_edit(Request $request,$id)
    {
        $valiDate = $this->validate($request, [
            'name' => '',
            'description' => '',
            'label' => '',
            'requireds' => '',
            'discription_single_choice' => '',
        ]);
        $user = General_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->name = $valiDate['name'];
            $user->description = strtoupper($valiDate['description']);
            $user->label = $valiDate['label'];
            $user->requireds = $valiDate['requireds'];
            $user->discription_single_choice = $valiDate['discription_single_choice'];

            if ($user->update()) {
                return response([
                    'data' => [
                        'message' => ' form is update',
                    ],
                    'status' => 'success',
                    //'info' => $user
                ]);
            }
        } else {
            return "Id not found";
        }
    }
    public function single_choice_edit_fa(Request $request,$id,$fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');

        $valiDate = $this->validate($request, [
            'name' => '',
            'description' => '',
            'label' => '',
            'requireds' => '',
            'discription_single_choice' => '',
        ]);
        $user = General_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->name = $valiDate['name'];
            $user->description = strtoupper($valiDate['description']);
            $user->label = $valiDate['label'];
            $user->requireds = $valiDate['requireds'];
            $user->discription_single_choice = $valiDate['discription_single_choice'];

            if ($user->update()) {
                return response([
                    'داده' => [
                        'پیام' => 'آپدیت شد',
                    ],
                    'وضعیت' => 'با موفقیت',
                    //'info' => $user
                ]);
            }
        } else {
            return "این آی دی پیدا نشد";
        }
    }
    public function single_choice_delete($id)
    {
        $t = General_answerModel::where([['id', $id], ['admin_id', auth()->user()->id]])->delete();
        if ($t) {
            return response([
                'data' => 'delete with successfull'
            ]);
        } else {
            return "id not found";
        }
    }
    public function single_choice_delete_fa($id, $fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $t = General_answerModel::where([['id', $id], ['admin_id', auth()->user()->id]])->delete();
        if ($t) {
            return response([
                'data' => 'کاربر پاک شد',
                'زبان' => $q
            ]);
        } else {
            return "این id وجود ندارد";
        }
    }
    public function single_show($id, $name)
    {
        $e = General_answerModel::where([['id', $id], ['admin_id', auth()->user()->id]])->take(1)->pluck($name);
        return $e;
    }
//-------------------------------------------End single choice------------------------------------------
//------------------------------------------start multiple choice---------------------------------------
    public function multiple_choice_show_en()
    {
        $d = GeneralModel::where('id', '102')->orderby('id', 'desc')->take(1)
            ->get(['name_en', 'description_en', 'left_en', 'right_en', 'top_en', 'required_en','sublabels_en'
            ])->toArray();

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
    public function multiple_choice_show_fa ($fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');

        $d = GeneralModel::where('id', '102')->orderby('id', 'desc')->take(1)
            ->get(['name_fa', 'description_fa', 'left_fa', 'right_fa', 'top_fa', 'required_fa','sublabels_fa'
            ])->toArray();

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

    public function multiple_choice_create(Request $request)
    {
        $valiDate = $this->validate($request, [
            'type_name'=>'required|exists:tool,id',
            'name' => '',
            'description' => '',
            'label' => '',
            'requireds' => '',
            'discription_multiple_choice' => '',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->f()->create([
            'type_name'=>$valiDate['type_name'],
            'name' => $valiDate['name'],
            'description' => $valiDate['description'],
            'label' => $valiDate['label'],
            'requireds' => $valiDate['requireds'],
            'discription_multiple_choice' => $valiDate['discription_multiple_choice'],
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
    public function multiple_choice_create_fa(Request $request,$fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
            'type_name'=>'required|exists:tool,id',
            'name' => '',
            'description' => '',
            'label' => '',
            'requireds' => '',
            'discription_multiple_choice' => '',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->f()->create([
            'type_name'=>$valiDate['type_name'],
            'name' => $valiDate['name'],
            'description' => $valiDate['description'],
            'label' => $valiDate['label'],
            'requireds' => $valiDate['requireds'],
            'discription_multiple_choice' => $valiDate['discription_multiple_choice'],
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

    public function multiple_choice_edit(Request $request,$id)
    {
        $valiDate = $this->validate($request, [
            'name' => '',
            'description' => '',
            'label' => '',
            'requireds' => '',
            'discription_multiple_choice' => '',
        ]);
        $user = General_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->name = $valiDate['name'];
            $user->description = strtoupper($valiDate['description']);
            $user->label = $valiDate['label'];
            $user->requireds = $valiDate['requireds'];
            $user->discription_multiple_choice = $valiDate['discription_multiple_choice'];
            if ($user->update()) {
                return response([
                    'data' => [
                        'message' => ' form is update',
                    ],
                    'status' => 'success',
                    //'info' => $user
                ]);
            }
        } else {
            return "Id not found";
        }
    }
    public function multiple_choice_edit_fa(Request $request,$fa,$id)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
            'name' => '',
            'description' => '',
            'label' => '',
            'requireds' => '',
            'discription_multiple_choice' => '',
        ]);
        $user = General_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->name = $valiDate['name'];
            $user->description = strtoupper($valiDate['description']);
            $user->label = $valiDate['label'];
            $user->requireds = $valiDate['requireds'];
            $user->discription_multiple_choice = $valiDate['discription_multiple_choice'];
            if ($user->update()) {
                return response([
                    'داده' => [
                        'پیام' => ' آپدیت شد',
                    ],
                    'وضعیت' => 'با موفقیت',
                    //'info' => $user
                ]);
            }
        } else {
            return "Id not found";
        }
    }
    public function multiple_choice_delete($id)
    {
        $t = General_answerModel::where([['id', $id], ['admin_id', auth()->user()->id]])->delete();
        if ($t) {
            return response([
                'data' => 'delete with successfull'
            ]);
        } else {
            return "id not found";
        }
    }
    public function multiple_choice_delete_fa($id, $fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $t = General_answerModel::where([['id', $id], ['admin_id', auth()->user()->id]])->delete();
        if ($t) {
            return response([
                'data' => 'کاربر پاک شد',
                'زبان' => $q
            ]);
        } else {
            return "این id وجود ندارد";
        }
    }
    public function multiple_choice_show($id, $name)
    {
        $e = General_answerModel::where([['id', $id], ['admin_id', auth()->user()->id]])->take(1)->pluck($name);
        return $e;
    }
//------------------------------------------End multiple choice------------------------------------------
//------------------------------------------start image choice------------------------------------------
    public function image_choice_show_en()
    {
        $d = GeneralModel::where('id', '102')->orderby('id', 'desc')->take(1)
            ->get(['name_en', 'description_en', 'left_en', 'right_en', 'top_en', 'required_en','sublabels_en'
            ])->toArray();
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
    public function image_choice_show_fa($fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $d = GeneralModel::where('id', '102')->orderby('id', 'desc')->take(1)
            ->get(['name_fa', 'description_fa', 'left_fa', 'right_fa', 'top_fa', 'required_fa','sublabels_fa'
            ])->toArray();
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
    public function image_choice_create(Request $request)
    {
        $valiDate = $this->validate($request, [
            'type_name'=>'required|exists:tool,id',
            'name' => '',
            'description' => '',
            'label' => '',
            'requireds' => '',
            'discription_image_choice' => '',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->f()->create([
            'type_name'=>$valiDate['type_name'],
            'name' => $valiDate['name'],
            'description' => $valiDate['description'],
            'label' => $valiDate['label'],
            'requireds' => $valiDate['requireds'],
            'discription_image_choice' => $valiDate['discription_image_choice'],
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
    public function image_choice_create_fa(Request $request,$fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
            'type_name'=>'required|exists:tool,id',
            'name' => '',
            'description' => '',
            'label' => '',
            'requireds' => '',
            'discription_image_choice' => '',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->f()->create([
            'type_name'=>$valiDate['type_name'],
            'name' => $valiDate['name'],
            'description' => $valiDate['description'],
            'label' => $valiDate['label'],
            'requireds' => $valiDate['requireds'],
            'discription_image_choice' => $valiDate['discription_image_choice'],
            'form_id' => $valiDate['form_id']
        ]);
        return response([
            'داده' => [
                'پیام' => 'ثبت شد',
            ],
            'وضعیت' => 'با موفقیت',
            'زبان' => $q,
            'ID' => $y->id
        ]);
    }
    public function image_choice_edit(Request $request,$id)
    {
        $valiDate = $this->validate($request, [
            'name' => '',
            'description' => '',
            'label' => '',
            'requireds' => '',
            'discription_image_choice' => '',
        ]);
        $user = General_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->name = $valiDate['name'];
            $user->description = strtoupper($valiDate['description']);
            $user->label = $valiDate['label'];
            $user->requireds = $valiDate['requireds'];
            $user->discription_image_choice = $valiDate['discription_image_choice'];
            if ($user->update()) {
                return response([
                    'data' => [
                        'message' => ' form is update',
                    ],
                    'status' => 'success',
                    //'info' => $user
                ]);
            }
        } else {
            return "Id not found";
        }
    }
    public function image_choice_edit_fa(Request $request,$id,$fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
            'name' => '',
            'description' => '',
            'label' => '',
            'requireds' => '',
            'discription_image_choice' => '',
        ]);
        $user = General_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->name = $valiDate['name'];
            $user->description = strtoupper($valiDate['description']);
            $user->label = $valiDate['label'];
            $user->requireds = $valiDate['requireds'];
            $user->discription_image_choice = $valiDate['discription_image_choice'];
            if ($user->update()) {
                return response([
                    'داده' => [
                        'پیام' => ' آپدیت شد',
                    ],
                    'وضعیت' => 'با موفقیت',
                    //'info' => $user
                    'زبان' => $q
                ]);
            }
        } else {
            return "Id not found";
        }
    }
    public function image_choice_delete($id)
    {
        $t = General_answerModel::where([['id', $id], ['admin_id', auth()->user()->id]])->delete();
        if ($t) {
            return response([
                'data' => 'delete with successfull'
            ]);
        } else {
            return "id not found";
        }
    }
    public function image_choice_delete_fa($id, $fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $t = General_answerModel::where([['id', $id], ['admin_id', auth()->user()->id]])->delete();
        if ($t) {
            return response([
                'data' => 'کاربر پاک شد',
                'زبان' => $q
            ]);
        } else {
            return "این id وجود ندارد";
        }
    }
    public function image_choice_show($id, $name)
    {
        $e = General_answerModel::where([['id', $id], ['admin_id', auth()->user()->id]])->take(1)->pluck($name);
        return $e;
    }
//------------------------------------------End image choice------------------------------------------
//------------------------------------------start number------------------------------------------
    public function number_show_en()
    {
        $d = GeneralModel::where('id', '102')->orderby('id', 'desc')->take(1)
            ->get(['name_en', 'description_en', 'left_en', 'right_en', 'top_en', 'required_en','sublabels_en'
            ])->toArray();
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
    public function number_show_fa($fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $d = GeneralModel::where('id', '102')->orderby('id', 'desc')->take(1)
            ->get(['name_fa', 'description_fa', 'left_fa', 'right_fa', 'top_fa', 'required_fa','sublabels_fa'
            ])->toArray();
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
    public function number_create(Request $request)
    {
        $valiDate = $this->validate($request, [
            'type_name'=>'required|exists:tool,id',
            'name' => '',
            'description' => '',
            'label' => '',
            'requireds' => '',
            'number' => '',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->f()->create([
            'type_name'=>$valiDate['type_name'],
            'name' => $valiDate['name'],
            'description' => $valiDate['description'],
            'label' => $valiDate['label'],
            'requireds' => $valiDate['requireds'],
            'number' => $valiDate['number'],
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
    public function number_create_fa(Request $request,$fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
            'type_name'=>'required|exists:tool,id',
            'name' => '',
            'description' => '',
            'label' => '',
            'requireds' => '',
            'number' => '',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->f()->create([
            'type_name'=>$valiDate['type_name'],
            'name' => $valiDate['name'],
            'description' => $valiDate['description'],
            'label' => $valiDate['label'],
            'requireds' => $valiDate['requireds'],
            'number' => $valiDate['number'],
            'form_id' => $valiDate['form_id']
        ]);
        return response([
            'داده' => [
                'پیام' => 'ثبت شد',
            ],
            'وضعیت' => 'با موفقیت',
            'زبان' => $q,
            'ID' => $y->id
        ]);
    }
    public function number_edit(Request $request,$id)
    {
        $valiDate = $this->validate($request, [
            'name' => '',
            'description' => '',
            'label' => '',
            'requireds' => '',
            'number' => '',
        ]);
        $user = General_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->name = $valiDate['name'];
            $user->description = strtoupper($valiDate['description']);
            $user->label = $valiDate['label'];
            $user->requireds = $valiDate['requireds'];
            $user->number = $valiDate['number'];
            if ($user->update()) {
                return response([
                    'data' => [
                        'message' => ' form is update',
                    ],
                    'status' => 'success',
                    //'info' => $user
                ]);
            }
        } else {
            return "Id not found";
        }
    }
    public function number_edit_fa(Request $request,$id,$fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
            'name' => '',
            'description' => '',
            'label' => '',
            'requireds' => '',
            'number' => '',
        ]);
        $user = General_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->name = $valiDate['name'];
            $user->description = strtoupper($valiDate['description']);
            $user->label = $valiDate['label'];
            $user->requireds = $valiDate['requireds'];
            $user->number = $valiDate['number'];
            if ($user->update()) {
                return response([
                    'داده' => [
                        'پیام' => ' آپدیت شد',
                    ],
                    'وضعیت' => 'با موفقیت',
                    //'info' => $user
                    'زبان' => $q
                ]);
            }
        } else {
            return "Id not found";
        }
    }
    public function number_delete($id)
    {
        $t = General_answerModel::where([['id', $id], ['admin_id', auth()->user()->id]])->delete();
        if ($t) {
            return response([
                'data' => 'delete with successfull'
            ]);
        } else {
            return "id not found";
        }
    }
    public function number_delete_fa($id, $fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $t = General_answerModel::where([['id', $id], ['admin_id', auth()->user()->id]])->delete();
        if ($t) {
            return response([
                'data' => 'کاربر پاک شد',
                'زبان' => $q
            ]);
        } else {
            return "این id وجود ندارد";
        }
    }
    public function number_show($id, $name)
    {
        $e = General_answerModel::where([['id', $id], ['admin_id', auth()->user()->id]])->take(1)->pluck($name);
        return $e;
    }
//------------------------------------------End number------------------------------------------
//------------------------------------------start image------------------------------------------
    public function image_show_en()
    {
        $d = GeneralModel::where('id', '102')->orderby('id', 'desc')->take(1)
            ->get([ 'description_en','question','image', 'left_en', 'right_en', 'top_en','sublabels_en'
            ])->toArray();
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
    public function image_show_fa($fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $d = GeneralModel::where('id', '102')->orderby('id', 'desc')->take(1)
            ->get(['description_fa','question_fa','image_fa', 'left_fa', 'right_fa', 'top_fa','sublabels_fa'
            ])->toArray();
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
    public function image_create(Request $request,Filesystem $filesystem)
    {
        $valiDate = $this->validate($request, [
            'type_name'=>'required|exists:tool,id',
            'description_image' => '',
           'question_image' => '',
            'alignment_image' => '',
            'image' => 'required|mimes:jpeg,jpg,png|max:10240',
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

        $y = auth()->user()->f()->create([
            'type_name'=>$valiDate['type_name'],
            'description_image' => $valiDate['description_image'],
             'question_image' => $valiDate['question_image'],
             'alignment_image' => $valiDate['alignment_image'],
            'image' =>url($imagepath.$filename) ,
            'form_id' => $valiDate['form_id']
        ]);
        $file->move(public_path($imagepath),$filename);
        return response([
            'data' => [
                'image_url'=>url("{$imagepath}/{$filename}"),
                'message' => 'form is registered',
            ],
            'status' => 'success',
            'ID' => $y->id
        ]);
    }
    public function image_create_fa(Request $request,Filesystem $filesystem,$fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
            'type_name'=>'required|exists:tool,id',
            'description_image' => '',
            'question_image' => '',
            'alignment_image' => '',
            'image' => 'required|mimes:jpeg,jpg,png|max:10240',
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
        $y = auth()->user()->f()->create([
            'type_name'=>$valiDate['type_name'],
            'description_image' => $valiDate['description_image'],
            'question_image' => $valiDate['question_image'],
            'alignment_image' => strtoupper($valiDate['alignment_image']),
            'image' =>url($imagepath.$filename) ,
            'form_id' => $valiDate['form_id']
        ]);
        $file->move(public_path($imagepath),$filename);
        return response([
            'داده' => [
                'image_url'=>url("{$imagepath}/{$filename}"),
                'پیام' => 'ثبت شد',
            ],
            'وضعیت' => 'با موفقیت',
            'ID' => $y->id
        ]);
    }
    public function image_edit(Request $request,Filesystem $filesystem,$id)
    {
        $valiDate = $this->validate($request, [
            'description_image' => '',
            'question_image' => '',
            'alignment_image' => '',
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
        $user = General_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->description_image = $valiDate['description_image'];
            $user->question_image = $valiDate['question_image'];
            $user->alignment_image = strtoupper($valiDate['alignment_image']);
            $user->image=url($imagepath.$filename) ;
            if ($user->update()) {
                return response([
                    'data' => [
                        'message' => ' form is update',
                    ],
                    'status' => 'success',
                    //'info' => $user
                ]);
            }
        } else {
            return "Id not found";
        }
    }
    public function image_edit_fa(Request $request,Filesystem $filesystem,$id,$fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
            'description_image' => '',
            'question_image' => '',
            'alignment_image' => '',
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
        $user = General_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->name = $valiDate['name'];
            $user->description_image = $valiDate['description_image'];
            $user->question_image = strtoupper($valiDate['question_image']);
            $user->alignment_image = $valiDate['alignment_image'];
            $user->image=url($imagepath.$filename) ;
            if ($user->update()) {
                return response([
                    'داده' => [
                        'پیام' => ' آپدیت شد',
                    ],
                    'وضعیت' => 'با موفقیت',
                    //'info' => $user
                    'زبان' => $q
                ]);
            }
        } else {
            return "Id not found";
        }
    }
    public function image_delete($id)
    {
        $t = General_answerModel::where([['id', $id], ['admin_id', auth()->user()->id]])->delete();
        if ($t) {
            return response([
                'data' => 'delete with successfull'
            ]);
        } else {
            return "id not found";
        }
    }
    public function image_delete_fa($id, $fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $t = General_answerModel::where([['id', $id], ['admin_id', auth()->user()->id]])->delete();
        if ($t) {
            return response([
                'data' => 'کاربر پاک شد',
                'زبان' => $q
            ]);
        } else {
            return "این id وجود ندارد";
        }
    }
    public function image_show($id, $name)
    {
        $e = General_answerModel::where([['id', $id], ['admin_id', auth()->user()->id]])->take(1)->pluck($name);
        return $e;
    }
//------------------------------------------End image-------------------------------------------------
//------------------------------------------start file upload------------------------------------------
    public function file_upload_show_en()
    {
        $d = GeneralModel::where('id', '102')->orderby('id', 'desc')->take(1)
            ->get(['name_en', 'description_en', 'left_en', 'right_en', 'top_en', 'required_en','sublabels_en'
            ])->toArray();
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
    public function file_upload_show_fa($fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $d = GeneralModel::where('id', '102')->orderby('id', 'desc')->take(1)
            ->get(['name_fa', 'description_fa', 'left_fa', 'right_fa', 'top_fa', 'required_fa','sublabels_fa'
            ])->toArray();
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
    public function file_upload_create(Request $request)
    {
        $valiDate = $this->validate($request, [
            'type_name'=>'required|exists:tool,id',
            'name' => '',
            'description' => '',
            'label' => '',
            'requireds' => '',
            'fileupload' => '',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->f()->create([
            'type_name'=>$valiDate['type_name'],
            'name' => $valiDate['name'],
            'description' => $valiDate['description'],
            'label' => $valiDate['label'],
            'requireds' => $valiDate['requireds'],
            'fileupload' => $valiDate['fileupload'],
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
    public function file_upload_create_fa(Request $request,$fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
            'type_name'=>'required|exists:tool,id',
            'name' => '',
            'description' => '',
            'label' => '',
            'requireds' => '',
            'fileupload' => '',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->f()->create([
            'type_name'=>$valiDate['type_name'],
            'name' => $valiDate['name'],
            'description' => $valiDate['description'],
            'label' => $valiDate['label'],
            'requireds' => $valiDate['requireds'],
            'fileupload' => $valiDate['fileupload'],
            'form_id' => $valiDate['form_id']
        ]);
        return response([
            'داده' => [
                'پیام' => 'ثبت شد',
            ],
            'وضعیت' => 'با موفقیت',
            'زبان' => $q,
            'ID' => $y->id
        ]);
    }
    public function file_upload_edit(Request $request,$id)
    {
        $valiDate = $this->validate($request, [
            'name' => '',
            'description' => '',
            'label' => '',
            'requireds' => '',
            'fileupload' => '',
        ]);
        $user = General_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->name = $valiDate['name'];
            $user->description = strtoupper($valiDate['description']);
            $user->label = $valiDate['label'];
            $user->requireds = $valiDate['requireds'];
            $user->fileupload = $valiDate['fileupload'];
            if ($user->update()) {
                return response([
                    'data' => [
                        'message' => ' form is update',
                    ],
                    'status' => 'success',
                    //'info' => $user
                ]);
            }
        } else {
            return "Id not found";
        }
    }
    public function file_upload_edit_fa(Request $request,$id,$fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
            'name' => '',
            'description' => '',
            'label' => '',
            'requireds' => '',
            'fileupload' => '',
        ]);
        $user = General_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->name = $valiDate['name'];
            $user->description = strtoupper($valiDate['description']);
            $user->label = $valiDate['label'];
            $user->requireds = $valiDate['requireds'];
            $user->fileupload = $valiDate['fileupload'];
            if ($user->update()) {
                return response([
                    'داده' => [
                        'پیام' => ' آپدیت شد',
                    ],
                    'وضعیت' => 'با موفقیت',
                    //'info' => $user
                    'زبان' => $q
                ]);
            }
        } else {
            return "Id not found";
        }
    }
    public function file_upload_delete($id)
    {
        $t = General_answerModel::where([['id', $id], ['admin_id', auth()->user()->id]])->delete();
        if ($t) {
            return response([
                'data' => 'delete with successfull'
            ]);
        } else {
            return "id not found";
        }
    }
    public function file_upload_delete_fa($id, $fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $t = General_answerModel::where([['id', $id], ['admin_id', auth()->user()->id]])->delete();
        if ($t) {
            return response([
                'data' => 'کاربر پاک شد',
                'زبان' => $q
            ]);
        } else {
            return "این id وجود ندارد";
        }
    }
    public function file_upload_show($id, $name)
    {
        $e = General_answerModel::where([['id', $id], ['admin_id', auth()->user()->id]])->take(1)->pluck($name);
        return $e;
    }
//------------------------------------------End file upload------------------------------------------
//------------------------------------------start captcha------------------------------------------
    public function captcha_show_en()
    {
        $d = GeneralModel::where('id', '102')->orderby('id', 'desc')->take(1)
            ->get(['name_en', 'description_en', 'left_en', 'right_en', 'top_en'
            ])->toArray();
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
    public function captcha_show_fa($fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $d = GeneralModel::where('id', '102')->orderby('id', 'desc')->take(1)
            ->get(['name_fa', 'description_fa', 'left_fa', 'right_fa', 'top_fa'
            ])->toArray();
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
    public function captcha_create(Request $request)
    {
        $valiDate = $this->validate($request, [
            'type_name'=>'required|exists:tool,id',
            'name' => '',
            'description' => '',
            'label' => '',
            'requireds' => '',
            'captcha' => '',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->f()->create([
            'type_name'=>$valiDate['type_name'],
            'name' => $valiDate['name'],
            'description' => $valiDate['description'],
            'label' => $valiDate['label'],
            'requireds' => $valiDate['requireds'],
            'captcha' => $valiDate['captcha'],
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
    public function captcha_create_fa(Request $request,$fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
            'type_name'=>'required|exists:tool,id',
            'name' => '',
            'description' => '',
            'label' => '',
            'requireds' => '',
            'captcha' => '',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->f()->create([
            'type_name'=>$valiDate['type_name'],
            'name' => $valiDate['name'],
            'description' => $valiDate['description'],
            'label' => $valiDate['label'],
            'requireds' => $valiDate['requireds'],
            'captcha' => $valiDate['captcha'],
            'form_id' => $valiDate['form_id']
        ]);
        return response([
            'داده' => [
                'پیام' => 'ثبت شد',
            ],
            'وضعیت' => 'با موفقیت',
            'زبان' => $q,
            'ID' => $y->id
        ]);
    }
    public function captcha_edit(Request $request,$id)
    {
        $valiDate = $this->validate($request, [
            'name' => '',
            'description' => '',
            'label' => '',
            'requireds' => '',
            'captcha' => '',
        ]);
        $user = General_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->name = $valiDate['name'];
            $user->description = strtoupper($valiDate['description']);
            $user->label = $valiDate['label'];
            $user->requireds = $valiDate['requireds'];
            $user->captcha = $valiDate['captcha'];
            if ($user->update()) {
                return response([
                    'data' => [
                        'message' => ' form is update',
                    ],
                    'status' => 'success',
                    //'info' => $user
                ]);
            }
        } else {
            return "Id not found";
        }
    }
    public function captcha_edit_fa(Request $request,$id,$fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
            'name' => '',
            'description' => '',
            'label' => '',
            'requireds' => '',
            'captcha' => '',
        ]);
        $user = General_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->name = $valiDate['name'];
            $user->description = strtoupper($valiDate['description']);
            $user->label = $valiDate['label'];
            $user->requireds = $valiDate['requireds'];
            $user->captcha = $valiDate['captcha'];
            if ($user->update()) {
                return response([
                    'داده' => [
                        'پیام' => ' آپدیت شد',
                    ],
                    'وضعیت' => 'با موفقیت',
                    //'info' => $user
                    'زبان' => $q
                ]);
            }
        } else {
            return "Id not found";
        }
    }
    public function captcha_delete($id)
    {
        $t = General_answerModel::where([['id', $id], ['admin_id', auth()->user()->id]])->delete();
        if ($t) {
            return response([
                'data' => 'delete with successfull'
            ]);
        } else {
            return "id not found";
        }
    }
    public function captcha_delete_fa($id, $fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $t = General_answerModel::where([['id', $id], ['admin_id', auth()->user()->id]])->delete();
        if ($t) {
            return response([
                'data' => 'کاربر پاک شد',
                'زبان' => $q
            ]);
        } else {
            return "این id وجود ندارد";
        }
    }
    public function captcha_show($id, $name)
    {
        $e = General_answerModel::where([['id', $id], ['admin_id', auth()->user()->id]])->take(1)->pluck($name);
        return $e;
    }
//------------------------------------------End captcha------------------------------------------
//------------------------------------------start input table------------------------------------------
    public function input_table_show_en()
    {
        $d = GeneralModel::where('id', '102')->orderby('id', 'desc')->take(1)
            ->get(['name_en', 'description_en', 'left_en', 'right_en', 'top_en','required_en'
            ])->toArray();
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
    public function input_table_show_fa($fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $d = GeneralModel::where('id', '102')->orderby('id', 'desc')->take(1)
            ->get(['name_fa', 'description_fa', 'left_fa', 'right_fa', 'top_fa','required_fa'
            ])->toArray();
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
    public function input_table_create(Request $request)
    {
        $valiDate = $this->validate($request, [
            'type_name'=>'required|exists:tool,id',
            'name' => '',
            'description' => '',
            'label' => '',
            'requireds' => '',
            'input_table' => '',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->f()->create([
            'type_name'=>$valiDate['type_name'],
            'name' => $valiDate['name'],
            'description' => $valiDate['description'],
            'label' => $valiDate['label'],
            'requireds' => $valiDate['requireds'],
            'input_table' => $valiDate['input_table'],
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
    public function input_table_create_fa(Request $request,$fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
            'type_name'=>'required|exists:tool,id',
            'name' => '',
            'description' => '',
            'label' => '',
            'requireds' => '',
            'input_table' => '',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->f()->create([
            'type_name'=>$valiDate['type_name'],
            'name' => $valiDate['name'],
            'description' => $valiDate['description'],
            'label' => $valiDate['label'],
            'requireds' => $valiDate['requireds'],
            'input_table' => $valiDate['input_table'],
            'form_id' => $valiDate['form_id']
        ]);
        return response([
            'داده' => [
                'پیام' => 'ثبت شد',
            ],
            'وضعیت' => 'با موفقیت',
            'زبان' => $q,
            'ID' => $y->id
        ]);
    }
    public function input_table_edit(Request $request,$id)
    {
        $valiDate = $this->validate($request, [
            'name' => '',
            'description' => '',
            'label' => '',
            'requireds' => '',
            'input_table' => '',
        ]);
        $user = General_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->name = $valiDate['name'];
            $user->description = strtoupper($valiDate['description']);
            $user->label = $valiDate['label'];
            $user->requireds = $valiDate['requireds'];
            $user->input_table = $valiDate['input_table'];
            if ($user->update()) {
                return response([
                    'data' => [
                        'message' => ' form is update',
                    ],
                    'status' => 'success',
                    //'info' => $user
                ]);
            }
        } else {
            return "Id not found";
        }
    }
    public function input_table_edit_fa(Request $request,$id,$fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
            'name' => '',
            'description' => '',
            'label' => '',
            'requireds' => '',
            'input_table' => '',
        ]);
        $user = General_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->name = $valiDate['name'];
            $user->description = strtoupper($valiDate['description']);
            $user->label = $valiDate['label'];
            $user->requireds = $valiDate['requireds'];
            $user->input_table = $valiDate['input_table'];
            if ($user->update()) {
                return response([
                    'داده' => [
                        'پیام' => ' آپدیت شد',
                    ],
                    'وضعیت' => 'با موفقیت',
                    //'info' => $user
                    'زبان' => $q
                ]);
            }
        } else {
            return "Id not found";
        }
    }
    public function input_table_delete($id)
    {
        $t = General_answerModel::where([['id', $id], ['admin_id', auth()->user()->id]])->delete();
        if ($t) {
            return response([
                'data' => 'delete with successfull'
            ]);
        } else {
            return "id not found";
        }
    }
    public function input_table_delete_fa($id, $fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $t = General_answerModel::where([['id', $id], ['admin_id', auth()->user()->id]])->delete();
        if ($t) {
            return response([
                'data' => 'کاربر پاک شد',
                'زبان' => $q
            ]);
        } else {
            return "این id وجود ندارد";
        }
    }
    public function input_table_show($id, $name)
    {
        $e = General_answerModel::where([['id', $id], ['admin_id', auth()->user()->id]])->take(1)->pluck($name);
        return $e;
    }
//------------------------------------------End input table------------------------------------------
//------------------------------------------start emoji------------------------------------------
    public function emoji_show_en()
    {
        $d = GeneralModel::where('id', '102')->orderby('id', 'desc')->take(1)
            ->get(['name_en', 'description_en', 'left_en', 'right_en', 'top_en','required_en'
            ])->toArray();
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
    public function emoji_show_fa($fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $d = GeneralModel::where('id', '102')->orderby('id', 'desc')->take(1)
            ->get(['name_fa', 'description_fa', 'left_fa', 'right_fa', 'top_fa','required_fa'
            ])->toArray();
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
    public function emoji_create(Request $request)
    {
        $valiDate = $this->validate($request, [
            'type_name'=>'required|exists:tool,id',
            'name' => '',
            'description' => '',
            'label' => '',
            'requireds' => '',
            'emoji' => '',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->f()->create([
            'type_name'=>$valiDate['type_name'],
            'name' => $valiDate['name'],
            'description' => $valiDate['description'],
            'label' => $valiDate['label'],
            'requireds' => $valiDate['requireds'],
            'emoji' => $valiDate['emoji'],
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
    public function emoji_create_fa(Request $request,$fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
            'type_name'=>'required|exists:tool,id',
            'name' => '',
            'description' => '',
            'label' => '',
            'requireds' => '',
            'emoji' => '',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->f()->create([
            'type_name'=>$valiDate['type_name'],
            'name' => $valiDate['name'],
            'description' => $valiDate['description'],
            'label' => $valiDate['label'],
            'requireds' => $valiDate['requireds'],
            'emoji' => $valiDate['emoji'],
            'form_id' => $valiDate['form_id']
        ]);
        return response([
            'داده' => [
                'پیام' => 'ثبت شد',
            ],
            'وضعیت' => 'با موفقیت',
            'زبان' => $q,
            'ID' => $y->id
        ]);
    }
    public function emoji_edit(Request $request,$id)
    {
        $valiDate = $this->validate($request, [
            'name' => '',
            'description' => '',
            'label' => '',
            'requireds' => '',
            'emoji' => '',
        ]);
        $user = General_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->name = $valiDate['name'];
            $user->description = strtoupper($valiDate['description']);
            $user->label = $valiDate['label'];
            $user->requireds = $valiDate['requireds'];
            $user->emoji = $valiDate['emoji'];
            if ($user->update()) {
                return response([
                    'data' => [
                        'message' => ' form is update',
                    ],
                    'status' => 'success',
                    //'info' => $user
                ]);
            }
        } else {
            return "Id not found";
        }
    }
    public function emoji_edit_fa(Request $request,$id,$fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
            'name' => '',
            'description' => '',
            'label' => '',
            'requireds' => '',
            'emoji' => '',
        ]);
        $user = General_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->name = $valiDate['name'];
            $user->description = strtoupper($valiDate['description']);
            $user->label = $valiDate['label'];
            $user->requireds = $valiDate['requireds'];
            $user->emoji = $valiDate['emoji'];
            if ($user->update()) {
                return response([
                    'داده' => [
                        'پیام' => ' آپدیت شد',
                    ],
                    'وضعیت' => 'با موفقیت',
                    //'info' => $user
                    'زبان' => $q
                ]);
            }
        } else {
            return "Id not found";
        }
    }
    public function emoji_delete($id)
    {
        $t = General_answerModel::where([['id', $id], ['admin_id', auth()->user()->id]])->delete();
        if ($t) {
            return response([
                'data' => 'delete with successfull'
            ]);
        } else {
            return "id not found";
        }
    }
    public function emoji_delete_fa($id, $fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $t = General_answerModel::where([['id', $id], ['admin_id', auth()->user()->id]])->delete();
        if ($t) {
            return response([
                'data' => 'کاربر پاک شد',
                'زبان' => $q
            ]);
        } else {
            return "این id وجود ندارد";
        }
    }
    public function emoji_show($id, $name)
    {
        $e = General_answerModel::where([['id', $id], ['admin_id', auth()->user()->id]])->take(1)->pluck($name);
        return $e;
    }
//------------------------------------------End emoji------------------------------------------
//------------------------------------------start Star Rating------------------------------------------
    public function Star_Rating_show_en()
    {
        $d = GeneralModel::where('id', '102')->orderby('id', 'desc')->take(1)
            ->get(['name_en', 'description_en', 'left_en', 'right_en', 'top_en','required_en','sublabels_en'
            ])->toArray();
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
    public function Star_Rating_show_fa($fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $d = GeneralModel::where('id', '102')->orderby('id', 'desc')->take(1)
            ->get(['name_fa', 'description_fa', 'left_fa', 'right_fa', 'top_fa','required_fa','sublabels_fa'
            ])->toArray();
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
    public function Star_Rating_create(Request $request)
    {
        $valiDate = $this->validate($request, [
            'type_name'=>'required|exists:tool,id',
            'name' => '',
            'description' => '',
            'label' => '',
            'requireds' => '',
            'Star_Rating' => '',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->f()->create([
            'type_name'=>$valiDate['type_name'],
            'name' => $valiDate['name'],
            'description' => $valiDate['description'],
            'label' => $valiDate['label'],
            'requireds' => $valiDate['requireds'],
            'Star_Rating' => $valiDate['Star_Rating'],
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
    public function Star_Rating_create_fa(Request $request,$fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
            'type_name'=>'required|exists:tool,id',
            'name' => '',
            'description' => '',
            'label' => '',
            'requireds' => '',
            'Star_Rating' => '',
            'form_id' => 'exists:forms,id'
        ]);
        $y = auth()->user()->f()->create([
            'type_name'=>$valiDate['type_name'],
            'name' => $valiDate['name'],
            'description' => $valiDate['description'],
            'label' => $valiDate['label'],
            'requireds' => $valiDate['requireds'],
            'Star_Rating' => $valiDate['Star_Rating'],
            'form_id' => $valiDate['form_id']
        ]);
        return response([
            'داده' => [
                'پیام' => 'ثبت شد',
            ],
            'وضعیت' => 'با موفقیت',
            'زبان' => $q,
            'ID' => $y->id
        ]);
    }
    public function Star_Rating_edit(Request $request,$id)
    {
        $valiDate = $this->validate($request, [
            'name' => '',
            'description' => '',
            'label' => '',
            'requireds' => '',
            'Star_Rating' => '',
        ]);
        $user = General_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->name = $valiDate['name'];
            $user->description = strtoupper($valiDate['description']);
            $user->label = $valiDate['label'];
            $user->requireds = $valiDate['requireds'];
            $user->Star_Rating = $valiDate['Star_Rating'];
            if ($user->update()) {
                return response([
                    'data' => [
                        'message' => ' form is update',
                    ],
                    'status' => 'success',
                    //'info' => $user
                ]);
            }
        } else {
            return "Id not found";
        }
    }
    public function Star_Rating_edit_fa(Request $request,$id,$fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $valiDate = $this->validate($request, [
            'name' => '',
            'description' => '',
            'label' => '',
            'requireds' => '',
            'Star_Rating' => '',
        ]);
        $user = General_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->name = $valiDate['name'];
            $user->description = strtoupper($valiDate['description']);
            $user->label = $valiDate['label'];
            $user->requireds = $valiDate['requireds'];
            $user->Star_Rating = $valiDate['Star_Rating'];
            if ($user->update()) {
                return response([
                    'داده' => [
                        'پیام' => ' آپدیت شد',
                    ],
                    'وضعیت' => 'با موفقیت',
                    //'info' => $user
                    'زبان' => $q
                ]);
            }
        } else {
            return "Id not found";
        }
    }
    public function Star_Rating_delete($id)
    {
        $t = General_answerModel::where([['id', $id], ['admin_id', auth()->user()->id]])->delete();
        if ($t) {
            return response([
                'data' => 'delete with successfull'
            ]);
        } else {
            return "id not found";
        }
    }
    public function Star_Rating_delete_fa($id, $fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $t = General_answerModel::where([['id', $id], ['admin_id', auth()->user()->id]])->delete();
        if ($t) {
            return response([
                'data' => 'کاربر پاک شد',
                'زبان' => $q
            ]);
        } else {
            return "این id وجود ندارد";
        }
    }
    public function Star_Rating_show($id, $name)
    {
        $e = General_answerModel::where([['id', $id], ['admin_id', auth()->user()->id]])->take(1)->pluck($name);
        return $e;
    }
//------------------------------------------End Star Rating------------------------------------------

}