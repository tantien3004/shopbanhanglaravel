<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Illuminate\Contracts\Session\Session as SessionSession;
use Illuminate\Routing\Redirector;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();


use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Session as FacadesSession;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::query()->get();

        return view('admin.categories.index')->with('categories', $categories);
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $data = array();
        $data['name'] = $request->category_product_name;
        $data['desc'] = $request->category_product_desc;
        $data['status'] = $request->category_product_status;


        DB::table('tbl_category_product')->insert($data);
        Session::put('message','Thêm danh mục sản phẩm thành công');
        return Redirect::to('/categories/create');
    }

    public function show($id)
    {
        

    }

    public function edit($id)
    {

    }

    public function update($id, Request $request)
    {

    }

    public function destroy($id)
    {

    }
}
