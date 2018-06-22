<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Password;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
class PasswordController extends CommonController
{
    public function password(){
        return view('password.password');
    }

    public function changePwd(Request $request,Password $password){
        Auth::user()->password = bcrypt($request->input('password'));
        Auth::user()->save();
        session()->flash('success','密码修改成功!');
        return redirect()->back();
    }
}
