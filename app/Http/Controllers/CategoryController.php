<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;


use Illuminate\Support\Facades\Session;

// use function PHPUnit\Framework\returnSelf;

class CategoryController extends Controller
{
    public function loggin()
    {
        $admin_id=Session::get('admin_id');
        if($admin_id)
        {
            return redirect(route('dashboard.admin'));
        } else return redirect(route('index.admin'))->send();
    }

    public function index()
    {
        $this->loggin();
        $categories = Category::query()->get();

        return view('admin.categories.index')->with('categories', $categories);
    }

    
    
    public function create()
    {
        $this->loggin();
        return view('admin.categories.create');
    }

    
    
    public function store(Request $request)
    {
        $this->loggin();

        //lưu ý không làm như này
        $data = array();
        $data['name'] = $request->name;
        $data['desc'] = $request->desc;
        $data['status'] = $request->status;


        DB::table('categories')->insert($data);
        Session::put('message','Thêm danh mục sản phẩm thành công');
        return redirect(route('index'));
    }

    
    
    public function show($id)
    {
        $this->loggin();

    }

    
    
    
    public function edit($id)
    {
        $this->loggin();
        $category = Category::query()->findOrFail($id);

        return view('admin.categories.edit')->with('category', $category);
    }

    
    
    
    
    public function update($id, Request $request)
    {
        $this->loggin();
        $category = Category::query()->findOrFail($id);
        $data = $request->only('name', 'desc');
        $category->update($data);
        
        Session::put('message', 'Cập nhật thành công');
        return redirect(route('index'));
    }

    
    
    
    
    
    public function destroy($id)
    {
        $this->loggin();
        $category = Category::query()->findOrFail($id)->delete();


        Session::put('message', 'Xóa danh mục sản phẩm thành công');
        return Redirect(route('index'));
    }

    public function changeStatus($id)
    {
        $this->loggin();
        $category = Category::query()->findOrFail($id);
        $status = 1;
        if($category->status == 1) {
            $status = 0;
            Session::put('message', 'Hủy kích hoạt danh mục sản phẩm thành công');
        } else Session::put('message', 'kích hoạt danh mục sản phẩm thành công');
        $category->update(['status' => $status]);

        return redirect(route('index'));
    }


    //code dưới đây là viết chuẩn php, học theo
    // Controller Category user
 
    public function showCategory($id)
    {
        $categories = Category::query()->where('status', '1')->orderbyDesc('id')->get();
        $brands = Brand::query()->where('status', '1')->orderbyDesc('id')->get();

        $category = Category::query()->with('products')->findOrFail($id);
        
        return view('user.category.show')
            ->with('categories', $categories)
            ->with('brands', $brands)
            ->with('category', $category);
    }

    
}
