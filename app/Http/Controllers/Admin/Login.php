<?php

namespace App\Http\Controllers\Admin;

use Gregwar\Captcha\CaptchaBuilder;
use Gregwar\Captcha\PhraseBuilder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
class Login extends Controller
{
    public function index(){
        return view('admin.login.index');
    }

    public function login(Request $request){
        if ($request->input('code') != session('code')){
            session()->flash('danger','验证码输入错误');
            return redirect()->back();
        }
        $status = Auth::attempt([
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ]);
        if ($status){
            session()->flash('success','登录成功');
            return redirect()->route('home');
        }
        session()->flash('danger','用户名或密码错误');
        return redirect()->back();
    }

    public function logout(){
        session()->flush();
        session()->flash('success','退出成功');
        return redirect()->route('login');
    }

    public function code(){
        header('Content-type: image/png');
        $phraseBuilder = new PhraseBuilder(4, '0');
        $builder = new CaptchaBuilder(null, $phraseBuilder);
        $builder->build();
        session(['code' => $builder->getPhrase()]);
        $builder->output();
    }
}
