<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Models\Category;


use Illuminate\Support\Facades\Session;

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
        //lưu ý không làm như này
        $data = array();
        $data['name'] = $request->name;
        $data['desc'] = $request->desc;
        $data['status'] = $request->status;


        DB::table('categories')->insert($data);
        // $category = Category::query()->get();
        // $data = $request->only('name', 'desc', 'status');
        // $categories->insert($data);
        Session::put('message','Thêm danh mục sản phẩm thành công');
        return redirect(route('index'));
    }

    
    
    public function show($id)
    {
        

    }

    
    
    
    public function edit($id)
    {
        $category = Category::query()->findOrFail($id);

        return view('admin.categories.edit')->with('category', $category);
    }

    
    
    
    
    public function update($id, Request $request)
    {
        $category = Category::query()->findOrFail($id);
        $data = $request->only('name', 'desc');
        $category->update($data);
        
        Session::put('message', 'Cập nhật thành công');
        return redirect(route('index'));
    }

    
    
    
    
    
    public function destroy($id)
    {
        $category = Category::query()->findOrFail($id)->delete();


        Session::put('message', 'Xóa danh mục sản phẩm thành công');
        return Redirect(route('index'));
    }

    
    
    
    
    
    public function changeStatus($id)
    {
        $category = Category::query()->findOrFail($id);
        $status = 1;
        if($category->status == 1) {
            $status = 0;
        }
        $category->update(['status' => $status]);

        return redirect(route('index'));
    }
}
