<?php

namespace App\Http\Controllers\Api\v1;

use App\AdminModel;
use App\FormModel;
use App\HistoryModel;
use App\LogModel;
use App\LogoModel;
use App\Other_answerModel;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\LangsModel;
use App\OtherModel;
use Illuminate\Support\Facades\Auth;
use Morilog\Jalali\Jalalian;
use App\countrylist;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Cache;

class OtherController extends Controller
{
    protected static $countries=[
        'IR' => 'Iran (Islamic Republic of)',
        'AF' => 'Afghanistan',
        'AL' => 'Albania',
        'DZ' => 'Algeria',
        'DS' => 'American Samoa',
        'AD' => 'Andorra',
        'AO' => 'Angola',
        'AI' => 'Anguilla',
        'AQ' => 'Antarctica',
        'AG' => 'Antigua and Barbuda',
        'AR' => 'Argentina',
        'AM' => 'Armenia',
        'AW' => 'Aruba',
        'AU' => 'Australia',
        'AT' => 'Austria',
        'AZ' => 'Azerbaijan',
        'BS' => 'Bahamas',
        'BH' => 'Bahrain',
        'BD' => 'Bangladesh',
        'BB' => 'Barbados',
        'BY' => 'Belarus',
        'BE' => 'Belgium',
        'BZ' => 'Belize',
        'BJ' => 'Benin',
        'BM' => 'Bermuda',
        'BT' => 'Bhutan',
        'BO' => 'Bolivia',
        'BA' => 'Bosnia and Herzegovina',
        'BW' => 'Botswana',
        'BV' => 'Bouvet Island',
        'BR' => 'Brazil',
        'IO' => 'British Indian Ocean Territory',
        'BN' => 'Brunei Darussalam',
        'BG' => 'Bulgaria',
        'BF' => 'Burkina Faso',
        'BI' => 'Burundi',
        'KH' => 'Cambodia',
        'CM' => 'Cameroon',
        'CA' => 'Canada',
        'CV' => 'Cape Verde',
        'KY' => 'Cayman Islands',
        'CF' => 'Central African Republic',
        'TD' => 'Chad',
        'CL' => 'Chile',
        'CN' => 'China',
        'CX' => 'Christmas Island',
        'CC' => 'Cocos (Keeling) Islands',
        'CO' => 'Colombia',
        'KM' => 'Comoros',
        'CD' => 'Democratic Republic of the Congo',
        'CG' => 'Republic of Congo',
        'CK' => 'Cook Islands',
        'CR' => 'Costa Rica',
        'HR' => 'Croatia (Hrvatska)',
        'CU' => 'Cuba',
        'CY' => 'Cyprus',
        'CZ' => 'Czech Republic',
        'DK' => 'Denmark',
        'DJ' => 'Djibouti',
        'DM' => 'Dominica',
        'DO' => 'Dominican Republic',
        'TP' => 'East Timor',
        'EC' => 'Ecuador',
        'EG' => 'Egypt',
        'SV' => 'El Salvador',
        'GQ' => 'Equatorial Guinea',
        'ER' => 'Eritrea',
        'EE' => 'Estonia',
        'ET' => 'Ethiopia',
        'FK' => 'Falkland Islands (Malvinas)',
        'FO' => 'Faroe Islands',
        'FJ' => 'Fiji',
        'FI' => 'Finland',
        'FR' => 'France',
        'FX' => 'France, Metropolitan',
        'GF' => 'French Guiana',
        'PF' => 'French Polynesia',
        'TF' => 'French Southern Territories',
        'GA' => 'Gabon',
        'GM' => 'Gambia',
        'GE' => 'Georgia',
        'DE' => 'Germany',
        'GH' => 'Ghana',
        'GI' => 'Gibraltar',
        'GK' => 'Guernsey',
        'GR' => 'Greece',
        'GL' => 'Greenland',
        'GD' => 'Grenada',
        'GP' => 'Guadeloupe',
        'GU' => 'Guam',
        'GT' => 'Guatemala',
        'GN' => 'Guinea',
        'GW' => 'Guinea-Bissau',
        'GY' => 'Guyana',
        'HT' => 'Haiti',
        'HM' => 'Heard and Mc Donald Islands',
        'HN' => 'Honduras',
        'HK' => 'Hong Kong',
        'HU' => 'Hungary',
        'IS' => 'Iceland',
        'IN' => 'India',
        'IM' => 'Isle of Man',
        'ID' => 'Indonesia',
        'IR' => 'Iran (Islamic Republic of)',
        'IQ' => 'Iraq',
        'IE' => 'Ireland',
        'IL' => 'Israel',
        'IT' => 'Italy',
        'CI' => 'Ivory Coast',
        'JE' => 'Jersey',
        'JM' => 'Jamaica',
        'JP' => 'Japan',
        'JO' => 'Jordan',
        'KZ' => 'Kazakhstan',
        'KE' => 'Kenya',
        'KI' => 'Kiribati',
        'KP' => 'Korea, Democratic People\'s Republic of',
        'KR' => 'Korea, Republic of',
        'XK' => 'Kosovo',
        'KW' => 'Kuwait',
        'KG' => 'Kyrgyzstan',
        'LA' => 'Lao People\'s Democratic Republic',
        'LV' => 'Latvia',
        'LB' => 'Lebanon',
        'LS' => 'Lesotho',
        'LR' => 'Liberia',
        'LY' => 'Libyan Arab Jamahiriya',
        'LI' => 'Liechtenstein',
        'LT' => 'Lithuania',
        'LU' => 'Luxembourg',
        'MO' => 'Macau',
        'MK' => 'North Macedonia',
        'MG' => 'Madagascar',
        'MW' => 'Malawi',
        'MY' => 'Malaysia',
        'MV' => 'Maldives',
        'ML' => 'Mali',
        'MT' => 'Malta',
        'MH' => 'Marshall Islands',
        'MQ' => 'Martinique',
        'MR' => 'Mauritania',
        'MU' => 'Mauritius',
        'TY' => 'Mayotte',
        'MX' => 'Mexico',
        'FM' => 'Micronesia, Federated States of',
        'MD' => 'Moldova, Republic of',
        'MC' => 'Monaco',
        'MN' => 'Mongolia',
        'ME' => 'Montenegro',
        'MS' => 'Montserrat',
        'MA' => 'Morocco',
        'MZ' => 'Mozambique',
        'MM' => 'Myanmar',
        'NA' => 'Namibia',
        'NR' => 'Nauru',
        'NP' => 'Nepal',
        'NL' => 'Netherlands',
        'AN' => 'Netherlands Antilles',
        'NC' => 'New Caledonia',
        'NZ' => 'New Zealand',
        'NI' => 'Nicaragua',
        'NE' => 'Niger',
        'NG' => 'Nigeria',
        'NU' => 'Niue',
        'NF' => 'Norfolk Island',
        'MP' => 'Northern Mariana Islands',
        'NO' => 'Norway',
        'OM' => 'Oman',
        'PK' => 'Pakistan',
        'PW' => 'Palau',
        'PS' => 'Palestine',
        'PA' => 'Panama',
        'PG' => 'Papua New Guinea',
        'PY' => 'Paraguay',
        'PE' => 'Peru',
        'PH' => 'Philippines',
        'PN' => 'Pitcairn',
        'PL' => 'Poland',
        'PT' => 'Portugal',
        'PR' => 'Puerto Rico',
        'QA' => 'Qatar',
        'RE' => 'Reunion',
        'RO' => 'Romania',
        'RU' => 'Russian Federation',
        'RW' => 'Rwanda',
        'KN' => 'Saint Kitts and Nevis',
        'LC' => 'Saint Lucia',
        'VC' => 'Saint Vincent and the Grenadines',
        'WS' => 'Samoa',
        'SM' => 'San Marino',
        'ST' => 'Sao Tome and Principe',
        'SA' => 'Saudi Arabia',
        'SN' => 'Senegal',
        'RS' => 'Serbia',
        'SC' => 'Seychelles',
        'SL' => 'Sierra Leone',
        'SG' => 'Singapore',
        'SK' => 'Slovakia',
        'SI' => 'Slovenia',
        'SB' => 'Solomon Islands',
        'SO' => 'Somalia',
        'ZA' => 'South Africa',
        'SS' => 'South Sudan',
        'GS' => 'South Georgia South Sandwich Islands',
        'ES' => 'Spain',
        'LK' => 'Sri Lanka',
        'SH' => 'St. Helena',
        'PM' => 'St. Pierre and Miquelon',
        'SD' => 'Sudan',
        'SR' => 'Suriname',
        'SJ' => 'Svalbard and Jan Mayen Islands',
        'SZ' => 'Swaziland',
        'SE' => 'Sweden',
        'CH' => 'Switzerland',
        'SY' => 'Syrian Arab Republic',
        'TW' => 'Taiwan',
        'TJ' => 'Tajikistan',
        'TZ' => 'Tanzania, United Republic of',
        'TH' => 'Thailand',
        'TG' => 'Togo',
        'TK' => 'Tokelau',
        'TO' => 'Tonga',
        'TT' => 'Trinidad and Tobago',
        'TN' => 'Tunisia',
        'TR' => 'Turkey',
        'TM' => 'Turkmenistan',
        'TC' => 'Turks and Caicos Islands',
        'TV' => 'Tuvalu',
        'UG' => 'Uganda',
        'UA' => 'Ukraine',
        'AE' => 'United Arab Emirates',
        'GB' => 'United Kingdom',
        'US' => 'United States',
        'UM' => 'United States minor outlying islands',
        'UY' => 'Uruguay',
        'UZ' => 'Uzbekistan',
        'VU' => 'Vanuatu',
        'VA' => 'Vatican City State',
        'VE' => 'Venezuela',
        'VN' => 'Vietnam',
        'VG' => 'Virgin Islands (British)',
        'VI' => 'Virgin Islands (U.S.)',
        'WF' => 'Wallis and Futuna Islands',
        'EH' => 'Western Sahara',
        'YE' => 'Yemen',
        'ZM' => 'Zambia',
        'ZW' => 'Zimbabwe'
    ];
    public function __construct(Request $request,Route $route)
    {


        if($route->methods()[0]!='GET') {
            // check if user loged in get user id else set null for it .
            $user_id = 1;
            $method = $route->getActionMethod();
            $actions = explode('\\', $route->getActionName());
            $controller = substr(end($actions), 0, strpos(end($actions), "@"));
            LogModel::create([
                'ip' => $request->ip(),
                'agent' =>'',
                'controller' => $controller,
                'method' => $method,
                'user_id' => $user_id,
                'input' => $request->getContent(),
                'route' => $request->path(),
                'http_method' => $route->methods()[0],
                'browser'=>$_SERVER['HTTP_USER_AGENT'],
                'platform'=>PHP_OS,
            ]);
            ///////////////////////////////////disable_to_date////تا تاریخ فلان غیر فعال باشد

            $date = Jalalian::forge('today')->format('%Y-%m-%d'); // جمعه، 23 اسفند 97
            Other_answerModel::where('expire_date','<=',trim($date).' 00:00:00')->update(['form_status'=>'Disabled']);
            ///////////////////////////////////end disable_to_date///////////////////////////////
        }
    }
    public function setting_show_en()
    {
        $d = OtherModel::where('id', '1')->orderby('id', 'desc')->take(1)
            ->get(['title','form _status','expire_data','warning_message','submission','lang','Continue_Forms_Later'])->toArray();
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
    public function setting_show_fa($fa)
    {
        $q = LangsModel::where('name', $fa)->take(1)->pluck('title');
        $d = OtherModel::where('id', '1')->orderby('id', 'desc')->take(1)
            ->get(['title_fa','form _status_fa','expire_data_fa','warning_message_fa','submission_fa','page_title','lang','Continue_Forms_Later'])->toArray();
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
    public function setting_create(Request $request)
    {
        $valiDate = $this->validate($request, [
            'title' => '',
            'form_status' => '',
            'warning_message'=> 'min:0|max:30',//if disable , if disable to date ,if disable on submission limit,if disable on date and on submission limit
            'expire_date' => '',//if disable to date,if disable on date and on submission limit
            'submission'=> '',//if disable on submission limit,if disable on date and on submission limit
            'form_id' => 'exists:forms,id',
            'page_title'=>'',
            'lang'=>'',
            'Continue_Forms_Later'=>'',
            'encrypt_form_data'=>'',
            'unique_submission'=>'',

        ]);
        /////////////////////////////////////////////////////////////////////////////////
         //نام فرم مورد نظر رو با این کد می گیریم  start
                $r=$valiDate['form_id'];
                $rr=FormModel::where('id',$r)->take(1)->pluck('name');
                $q= implode(', ',array($rr));
                $t=str_replace('[',' ',$q);
                $e= str_replace(']',' ',$t);
                $ee= str_replace('"',' ',$e);
        /////////////////////////////////////////////////////////End
        $y = auth()->user()->other()->create([
            'title' => $ee,
            'form_status' => strtoupper($valiDate['form_status']),
            'expire_date' => $valiDate['expire_date'],
            'submission' => $valiDate['submission'],
            'warning_message' => $valiDate['warning_message'],
            'form_id' => $valiDate['form_id'],
            'page_title'=>$valiDate['page_title'],
            'lang'=>$valiDate['lang'],
            'Continue_Forms_Later'=>$valiDate['Continue_Forms_Later'],
            'encrypt_form_data'=>$valiDate['encrypt_form_data'],
            'unique_submission'=>$valiDate['unique_submission'],
        ]);
        HistoryModel::create([
            'name'=>"create form".$y->id,
            'admin_id'=>auth()->user()->id,
            'form_id' =>$y->form_id ,
            'history'=>\Morilog\Jalali\Jalalian::now(),
        ]);
        return response([
            'data' => [
                'message' => 'form is registered',
                'date'=> Jalalian::forge('today')->format('%Y-%m-%d')

            ],
            'status' => 'success',
            'ID' => $y->id
        ]);
    }
    public function setting_edit(Request $request,$id)
    {
        $valiDate = $this->validate($request, [
            'title' => '',
            'form_status' => '',
            'expire_date' => '',
            'submission' => '',
            'warning_message' => '',
            'page_title'=>'',
            'lang'=>'',
            'Continue_Forms_Later'=>'',
            'encrypt_form_data'=>'',

        ]);
        $rr=Other_answerModel::where('id',$id)->take(1)->pluck('title');
        $q= implode(', ',array($rr));
        $t=str_replace('[',' ',$q);
        $e= str_replace(']',' ',$t);
        $ee= str_replace('"',' ',$e);
        $user =Other_answerModel::find($id);
        if ($user->admin_id == auth()->user()->id) {
            $user->title = $ee;
            $user->form_status = strtoupper($valiDate['form_status']);
            $user->expire_date = $valiDate['expire_date'];
            $user->submission = $valiDate['submission'];
            $user->warning_message = $valiDate['warning_message'];
            $user->page_title=$valiDate['page_title'];
            $user->lang=$valiDate['lang'];
            $user->Continue_Forms_Later=$valiDate['Continue_Forms_Later'];
            $user->encrypt_form_data=$valiDate['encrypt_form_data'];
            HistoryModel::create([
                'name'=>"create form".$user->id,
                'admin_id'=>auth()->user()->id,
                'form_id' =>$user->form_id ,
                'history'=>\Morilog\Jalali\Jalalian::now(),
            ]);
            if ($user->update()) {
                return response([
                    'data' => [
                        'message' => ' form is register',
                        'date'=> Jalalian::forge('today')->format('%Y-%m-%d')

                    ],
                    'status' => 'success',
                    'info' => $user
                ]);
            }
        } else {
            return "Id not found";
        }
    }

    public function setting_delete($id)
    {
        $p=Other_answerModel::where('id',$id)->value('form_id');
        HistoryModel::create([
            'name'=>"create form".$id,
            'admin_id'=>auth()->user()->id,
            'form_id' =>$p ,
            'history'=>\Morilog\Jalali\Jalalian::now(),
        ]);
        $t = Other_answerModel::where([['id', $id], ['admin_id', auth()->user()->id]])->delete();
        if ($t) {
            return response([

                'data' => 'delete with successfull',
                'date'=> Jalalian::forge('today')->format('%Y-%m-%d')

            ]);
        } else {
            return "id not found";
        }
    }
    public function setting_email()
    {
      $t=AdminModel::where('id',auth()->user()->id)->take(1)->value('email');
        if ($t) {
            return response([

                'data' =>[
                    'message'=>$t
                ],

            ]);
        } else {
            return "id not found";
        }
    }

    public function rename_pass(Request $request)//تغییر پسورد در داخل پروفایل
    {
        $valiDate = $this->validate($request, [
            'password' => '',
        ]);
        $user =AdminModel::find(61);
        $user->password = bcrypt($valiDate['password']);
        HistoryModel::create([
        'name'=>"rename pass ",
            'admin_id'=>auth()->user()->id,
            'form_id' =>'' ,
            'history'=>\Morilog\Jalali\Jalalian::now(),
            ]);
        if ($user->update()) {

            return response([
                'data' => [
                    'message' => 'رمز عبور تغییر کرد',
                    'date'=> Jalalian::forge('today')->format('%Y-%m-%d')
                ],
                'status' => 'success',

            ]);
        }
    }

    public function page_title(Request $request,$id)//تغییر پسورد در داخل پروفایل
    {
        $valiDate = $this->validate($request, [
            'page_title' => '',
        ]);
        $user =Other_answerModel::find($id);
        $user->page_title = $valiDate['page_title'];
        HistoryModel::create([
            'name'=>"edit page title",
            'admin_id'=>auth()->user()->id,
            'form_id' =>'' ,
            'history'=>\Morilog\Jalali\Jalalian::now(),
        ]);
        if ($user->update()) {

            return response([
                'data' => [
                    'message' => 'تایتل صفحه تغیر کرد',
                    'date'=> Jalalian::forge('today')->format('%Y-%m-%d')
                ],
                'status' => 'success',

            ]);
        }
    }
    public function all_values()//نمایش زبان با مقادیر
    {
        $t=array_values(static::$countries);
        if($t){
            return response([
                'data' => [
                    'message' => $t,
                    'date'=> Jalalian::forge('today')->format('%Y-%m-%d')

                ],
            ]);
        }
    }
    public function all()//نمایش کل زبانها
    {
        $t= static::$countries;
        if($t){
            return response([
                'data' => [
                    'message' => $t,
                    'date'=> Jalalian::forge('today')->format('%Y-%m-%d')

                ],
            ]);
        }
    }
    public function all_keys()//نمایش زبان با کلیدش
    {
        $t= array_keys(static::$countries);
        if($t){
            return response([
                'data' => [
                    'message' => $t,
                    'date'=> Jalalian::forge('today')->format('%Y-%m-%d')

                ],
            ]);
        }
    }
    public function Continue_Forms_Later(Request $request,$form_id)//if Continue_Forms_Later is Enable
    {
        $valiDate = $this->validate($request, [
            'email_message'=>'',
            'email_subject' => '',
        ]);

        $user = FormModel::find($form_id);
        $T=Other_answerModel::where('form_id',$form_id)->value('Continue_Forms_Later');
        if($user->admin_id == auth()->user()->id && $T=="Enable" ){
            $user->email_message = $valiDate['email_message'];
            $user->email_subject = $valiDate['email_subject'];
            if ($user->update()) {
                HistoryModel::create([
                    'name'=>"edit email to send".$user->admin_id,
                    'admin_id'=>auth()->user()->id,
                    'form_id' =>$form_id ,
                    'history'=>\Morilog\Jalali\Jalalian::now(),
                ]);
                return response([
                    'data' => [
                        'message' => ' تغییرات اعمال شد',
                        'date'=> Jalalian::forge('today')->format('%Y-%m-%d')
                    ],
                    'status' => 'success',
                    //'info' => $user
                ]);
            }else{
                return response([
                    'data' => [
                        'message' => ' تغییرات اعمال نشد',
                    ],
                    'status' => 'Fails',
                    //'info' => $user
                ]);
            }
        }else{
            return response([
                'data' => [
                    'message' => 'نمیتوان این کار رو انجام داد زیرا مقدار Continue_Forms_Later  disableهست',
                ],
                'status' => 'Fails',
                //'info' => $user

            ]);
        }


    }

    public function unique_submission(Request $request,$form_id)
    {
        $valiDate = $this->validate($request, [
            'unique_submission'=>'',

        ]);

        $user = Other_answerModel::where('form_id',$form_id)->value('id');
        $user1=Other_answerModel::find($user);

        if($user1->admin_id == auth()->user()->id ){
            $user1->unique_submission = $valiDate['unique_submission'];
            if ($user1->update()) {
                HistoryModel::create([
                    'name'=>"create cookie",
                    'admin_id'=>auth()->user()->id,
                    'form_id' =>'' ,
                    'history'=>\Morilog\Jalali\Jalalian::now(),
                ]);
                if($user1->unique_submission=="Check cookies only"){
                    $info=Other_answerModel::where('form_id',$form_id)->get();
                    if (! Cache::get('channels')) {
                        $expiresAt = Carbon::now()->addMinutes(1440);//24ساعت
                        Cache::store('file')->put('channels',$info, $expiresAt);
                    }else{
                        Cache::store('file')->get('channels');
                    }
                }elseif($user1->unique_submission=="Check cookies and ip"){
                    $info=Other_answerModel::where('form_id',$form_id)->get();
                    if (! Cache::get('channels')) {
                        $expiresAt = Carbon::now()->addMinutes(1440);//24ساعت
                        Cache::store('file')->put('channels',$info.$request->ip(), $expiresAt);
                    }else{
                        Cache::store('file')->get('channels');
                    }
                }
                return response([
                    'data' => [
                        'message' => ' تغییرات اعمال شد',
                        'date'=> Jalalian::forge('today')->format('%Y-%m-%d')
                    ],
                    'status' => 'success',
                    //'info' => $user
                ]);
            }else{
                return response([
                    'data' => [
                        'message' => ' تغییرات اعمال نشد',
                    ],
                    'status' => 'Fails',
                    //'info' => $user
                ]);
            }
        }else{
            return response([
                'data' => [
                    'message' => 'نمیتوان این کار رو انجام داد زیرا مقدار Continue_Forms_Later  disableهست',
                ],
                'status' => 'Fails',
                //'info' => $user

            ]);
        }
        
    }



}
