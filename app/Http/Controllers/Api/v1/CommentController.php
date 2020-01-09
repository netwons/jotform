<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Lang;

class CommentController extends Controller
{
    public function store1(Request $request)
    {
         Lang::setLocale('fa');
        $valiDate=$this->validate($request,[

            'final_answer'=>'required',

        ])  ;
        auth()->user()->submissions()->create($valiDate);
        return response([
            'data'=>[
                'message'=>'نظر شما با موفقیت ثبت شد.',
            ] ,
            'status'=>'success'
        ]);
    }

    public function store(Request $request)
    {
        //Lang::setLocale('fa');
        $valiDate=$this->validate($request,[

            'final_answer'=>'required',

        ])  ;
        auth()->user()->submissions()->create($valiDate);
        return response([
           'data'=>[
               'message'=>'نظر شما با موفقیت ثبت شد.',
           ] ,
            'status'=>'success'
        ]);
    }

    public function answer(Request $request)
    {
        $valiDate=$this->validate($request,[
           'submission_id'=>'required|numeric',
            'answer'=>'required'
        ]);
        auth()->user()->submission_answers()->create($valiDate);
        return response([
            'data'=>[
                'message'=>'The response to the comment was successfully',
            ] ,
            'status'=>'success'
        ]);
    }

    public function answer1(Request $request)
    {
        Lang::setLocale('fa');
        $valiDate=$this->validate($request,[
            'submission_id'=>'required|numeric',
            'answer'=>'required'
        ]);
        auth()->user()->submission_answers()->create($valiDate);
        return response([
            'data'=>[
                'message'=>'پاسخ به نظر  با موفقیت ثبت شد.',
            ] ,
            'status'=>'موفق'
        ]);
    }
}
