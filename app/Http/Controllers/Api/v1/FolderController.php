<?php
namespace App\Http\Controllers\Api\v1;
use App\FolderModel;
use App\FormModel;
use App\HistoryModel;
use App\LangsModel;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\folder;
use Illuminate\Support\Facades\Lang;
use Morilog\Jalali\Jalalian;
use Nexmo\Client;

class FolderController extends Controller
{

    public function f(Request $request)//create
    {

        $valiDate=$this->validate($request,[
            'name'=>'required'
        ]);
        mkdir('folder/'.$valiDate['name']);
        auth()->user()->folders()->create($valiDate);

        HistoryModel::create([
            'name'=>"create folder ".$request->name,
            'admin_id'=>auth()->user()->id,
            'form_id' =>1,
            'history'=>\Morilog\Jalali\Jalalian::now(),
        ]);
        return response([
            'data'=>[
                'message'=>'folder is registered',
                'date'=>$date = Jalalian::forge('today')->format('%Y-%m-%d')

            ],
            'status'=>'success'
        ]);
    }


    public function f1(Request $request,$fa)//create farsi
    {
        $q=LangsModel::where('name',$fa)->take(1)->pluck('title');
        $valiDate=$this->validate($request,[
            'name'=>'required'
        ]) ;
        HistoryModel::create([
            'name'=>"create folder ".$request->name,
            'admin_id'=>auth()->user()->id,
            'form_id' =>1,
            'history'=>\Morilog\Jalali\Jalalian::now(),
        ]);
        mkdir('folder/'.$valiDate['name']);
        auth()->user()->folders()->create($valiDate);

        return response([
            'داده'=>[
                'پیام'=>'فولدر ایجاد شد',
                'date'=>$date = Jalalian::forge('today')->format('%Y-%m-%d')

            ],
            'وضعیت'=>'با موفقیت',
            'زبان'=>$q
        ]);
    }

    public function newfolder(Request $request,$api,$name)
    {
//        $valiDate=$this->validate($request,[
//            'name'=>'required'
//        ]) ;
        auth()->user()->api_token;
        mkdir('folder/'.$name);
        auth()->user()->folders()->create(
            [
                'name'=>$name,
                'api_token'=>$api
            ]
        );
        HistoryModel::create([
            'name'=>"create folder ".$request->name,
            'admin_id'=>auth()->user()->id,
            'form_id' =>1,
            'history'=>\Morilog\Jalali\Jalalian::now(),
        ]);
        return response([
            'data'=>[
                'message'=>'folder is registered',
                'date'=>$date = Jalalian::forge('today')->format('%Y-%m-%d')

            ],
            'status'=>'success'
        ]);
    }

    public function newfolder1(Request $request,$api,$name,$fa)
    {
        $q=LangsModel::where('name',$fa)->take(1)->pluck('title');
//        $valiDate=$this->validate($request,[
//            'name'=>'required'
//        ]) ;
        auth()->user()->api_token;
        mkdir('folder/'.$name);
        auth()->user()->folders()->create(
            [
                'name'=>$name,
                'api_token'=>$api
            ]
        );
        HistoryModel::create([
            'name'=>"create folder ".$request->name,
            'admin_id'=>auth()->user()->id,
            'form_id' =>1,
            'history'=>\Morilog\Jalali\Jalalian::now(),
        ]);
        return response([
            'داده'=>[
                'پیام'=>'فولدر ایجاد شد',
                'زبان'=>$q,
                'date'=>$date = Jalalian::forge('today')->format('%Y-%m-%d')

            ]
        ]);
    }
    public function c($id)
    {

//        $http= new \GuzzleHttp\Client();
//        $response = $http->request('GET', 'localhost:8000/api/v1/api_token', [
//            'headers' => [
//                'Accept'=>'application/json',
//                'Authorization' => 'Bearer ' . auth()->user()->api_token,
//            ],
//        ]);
//        return $response;
//        return auth()->user()->id;
        $cc = FormModel::where('admin_id', auth()->user()->id)->take(50)->pluck('id');
        $r = implode(', ', array($cc));
        $t = str_replace('[', ' ', $r);
        $e = str_replace(']', ' ', $t);
        if(!empty($e)){
            response([
                'data'=>[
                    'message'=>$e,
                    'date'=>$date = Jalalian::forge('today')->format('%Y-%m-%d')

                ],
                'status'=>'success'
            ]);
        }else{
            return "پیدا نکرد";
        }
    }
    public function show($id)
    {
        //$id=auth()->user()->id;
        $t= FolderModel::where('admin_id',auth()->user()->id)->orderBy('id','desc')->get();
        $t1 = str_replace('[', ' ', $t);
        $e = str_replace(']', ' ', $t1);
            return response()->json([
                'data'=>[
                    'message'=>$e,
                ],
                'status'=>'success'
            ]);

    }

    public function det($id)
    {
        HistoryModel::create([
            'name'=>"delete folder ",
            'admin_id'=>auth()->user()->id,
            'form_id' =>$id,
            'history'=>\Morilog\Jalali\Jalalian::now(),
        ]);
        $t=FolderModel::where([['id',$id],['admin_id',auth()->user()->id]])->delete();
        if($t) {

            return response([

                'data' => 'delete with successfull',
                'date'=>$date = Jalalian::forge('today')->format('%Y-%m-%d')

            ]);
        }else{
            return "id not found";
        }
    }

    public function det1($id,$fa)
    {
        HistoryModel::create([
            'name'=>"delete folder ",
            'admin_id'=>auth()->user()->id,
            'form_id' =>$id,
            'history'=>\Morilog\Jalali\Jalalian::now(),
        ]);
        $q=LangsModel::where('name',$fa)->take(1)->pluck('title');
        $t=FolderModel::where([['id',$id],['admin_id',auth()->user()->id]])->delete();
        if($t) {

            return response([

                'داده' => 'کاربر پاک شد',
                'زبان'=>$q,
                'date'=>$date = Jalalian::forge('today')->format('%Y-%m-%d')

            ]);
        }else{
            return "این id وجود ندارد";
        }
    }

}
