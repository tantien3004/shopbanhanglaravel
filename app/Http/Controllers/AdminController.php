<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Redirect;

class AdminController extends Controller
{
    public function loggin()
    {
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return redirect(route('dashboard.admin'));
        } else return redirect(route('index.admin'))->send();
    }

    public function index()
    {
        return view('admin_login');
    }

    public function show_dashboard()
    {
        $this->loggin();
        return view('admin.dashboard');
    }

    public function dashboard( Request $request)
    {
        $admin_email = $request->admin_email;
        $admin_password = md5($request->admin_password);

        $result = DB :: table('admin')->where('admin_email', $admin_email)->where('admin_password', $admin_password)->first();
        if($result){
            Session::put('admin_name',$result->admin_name);
            Session::put('admin_id', $result->admin_id);

            return Redirect::to('/dashboard');
        } else {
            Session::put('message', 'Gmail hoặc mật khẩu sai.');
            return Redirect::to('/admin');
        }
    }

    public function logout()
    {
        Session::put('admin_name', null);
        Session::put('admin_id', null);
        return Redirect::to('/admin');
    }

    public function admin()
    {
        return view('admin.dashboard');
    }

    
}
