<?php

namespace App\Http\Controllers\admin;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
class HomeController extends Controller
{   

    // protected $redirectTo = 'admin/home';
    // public function __construct(){
    //     $this->middleware('auth:admin');
    // }

    public function getHome(){
        return view('backend.index');
    }

    public function getLogout(){
        Auth::logout();
        return redirect()->intended('login');
    }

}
