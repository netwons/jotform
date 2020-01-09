<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CustomerModel;
use App\User;
use Validator;
class CustomerController extends Controller
{
    public function customercreate(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'name'=>'required',
            'email'=>'required|unique:api|email',
            'password'=>'required',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(),400);

        }
        $input=$request->all();
        $input['password']=bcrypt($input['password']);
        $user=User::create($input);
        return response()->json(['details'=>$user],200);
    }
}
