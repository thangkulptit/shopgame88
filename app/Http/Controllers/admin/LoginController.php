<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{

    public function getLogin(){
        return view('backend.login');
    }

    public function postLogin(Request $request){
        $this->validate($request,[
            'email' => 'required|email',
            'password' => 'required|min:3'
            ] 
        );
        $arr = ['email' => $request->get('email'), 'password' => $request->get('password')];
        if (Auth::attempt($arr, false)){ //False la nho' dang nhap hay khong.
            return redirect()->intended('admin/home');
        } else {
            return back()->withInput()->with('error','Tài khoản hoặc mật khẩu không đúng');
        }
    }
}
