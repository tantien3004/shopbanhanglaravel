<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }
    
    public function checkLogin(Request $request)
    {
        if(Auth::attempt(['email'=>$request, 'password'=>$request]))
            {
                return redirect()->route('user.home');
            }
        else return redirect()->route('user.checkLogin')->with('error','Vui lòng thử lại!');
    }
}
