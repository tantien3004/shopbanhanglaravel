<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
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
        // if($request->remember == trans('remember.Keep me signed in')) $remember = true;
        // else $remember = false;

        if(Auth::attempt(['email' => $request->get('email'), 'password' =>  $request->get('password')]))
        {
            return redirect()->route('user.home');
        }
        else return redirect()->route('user.login')->with('error','Vui lòng thử lại!');
    }

    public function logout(Request $request)
    {
        Session::flush();
        Auth::logout();
        return redirect()->route('home');
    }
}
