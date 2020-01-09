<?php
namespace App\Http\Controllers\Api\v1;
use App\SubmissionanswerModel;
use App\SubmissionsModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class Submission_AnswersController extends Controller
{
    public function submission_answer(Request $request,$submission_id,$answer)
    {
        $valiDate=$this->validate($request,[
           //'answer'=>'required'
        ]);
        auth()->user()->submission_answers()->create([
            'answer'=>$answer,
            'submission_id'=>$submission_id,

        ]);
            return response([
                'data' => 'it is registered',
                'status' => 'success'
            ]);
    }

    public function submission_answer1(Request $request,$submission_id,$answer)
    {
        $valiDate=$this->validate($request,[
           // 'answer'=>'required'
        ]);
        auth()->user()->submission_answers()->create([
            'answer'=>$answer,
            'submission_id'=>$submission_id,

        ]);
        return response([
            'داده'=>'ثبت شد',
            'وضعیت'=>'با موفقیت'
        ]);
    }

    public function delete($id)
    {
        $t= SubmissionanswerModel::find($id)->delete();
        return response([
            'data'=>$t,
            'status'=>'delete user successfull'
        ]);
    }

    public function delete1($id,$fa)
    {
        $t= SubmissionanswerModel::find($id)->delete();
        return response([
            'داده'=>$t,
            'وضعیت'=>'یوزر پاک شد'
        ]);
    }

    public function b($id)
    {
        $bb=SubmissionsModel::where('admin_id',$id)->take(50)->pluck('id');
        $r= implode(', ',array($bb));
        $t=str_replace('[',' ',$r);
        $e= str_replace(']',' ',$t);
        return $e;

    }
}
