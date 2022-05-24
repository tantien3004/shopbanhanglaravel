<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Models\Brand;


use Illuminate\Support\Facades\Session;


class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::query()->get();

        return view('admin.brands.index')->with('brands', $brands);
    }

    
    
    public function create()
    {
        return view('admin.brands.create');
    }

    
    
    public function store(Request $request)
    {
        //lưu ý không làm như này
        $data = array();
        $data['name'] = $request->name;
        $data['desc'] = $request->desc;
        $data['status'] = $request->status;


        DB::table('brands')->insert($data);
        // $category = Category::query()->get();
        // $data = $request->only('name', 'desc', 'status');
        // $categories->insert($data);
        Session::put('message','Thêm danh mục sản phẩm thành công');
        return Redirect::to('/brands/create');
    }

    
    
    public function show($id)
    {
        

    }

    
    
    
    public function edit($id)
    {
        $brand = Brand::query()->findOrFail($id);

        return view('admin.brands.edit')->with('brand', $brand);
    }

    
    
    
    
    public function update($id, Request $request)
    {
        $brand = Brand::query()->findOrFail($id);
        $data = $request->only('name', 'desc');
        $brand->update($data);
        
        Session::put('message', 'Cập nhật thành công');
        return redirect(route('index_brands'));
    }

    
    
    
    
    
    public function destroy($id)
    {
        $brand = Brand::query()->findOrFail($id)->delete();


        Session::put('message', 'Xóa danh mục sản phẩm thành công');
        return Redirect(route('index_brands'));
    }

    
    
    
    
    
    public function changeStatus($id)
    {
        $brand = Brand::query()->findOrFail($id);
        $status = 1;
        if($brand->status == 1) {
            $status = 0;
        }
        $brand->update(['status' => $status]);

        return redirect(route('index_brands'));
    }
}
