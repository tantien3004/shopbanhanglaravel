<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;


use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::query()->get();

        return view('admin.products.index')->with('products', $products);
    }

    
    
    public function create(Request $request)
    {
        $categories = Category::query()->orderbyDesc('id')->get();
        $brands = Brand::query()->orderbyDesc('id')->get();


        return view('admin.products.create')->with('categories', $categories)->with('brands', $brands);
    }

    
    
    public function store(Request $request)
    {
        //lưu ý không làm như này
        $data = array();
        $data['name'] = $request->name;
        $data['desc'] = $request->desc;
        $data['status'] = $request->status;


        DB::table('products')->insert($data);
        // $category = Category::query()->get();
        // $data = $request->only('name', 'desc', 'status');
        // $categories->insert($data);
        Session::put('message','Thêm danh mục sản phẩm thành công');
        return Redirect::to('/products/create');
    }

    
    
    public function show($id)
    {
        

    }

    
    
    
    public function edit($id)
    {
        $product = Product::query()->findOrFail($id);

        return view('admin.products.edit')->with('product', $product);
    }

    
    
    
    
    public function update($id, Request $request)
    {
        $product = Product::query()->findOrFail($id);
        $data = $request->only('name', 'desc');
        $product->update($data);
        
        Session::put('message', 'Cập nhật thành công');
        return redirect(route('index_products'));
    }

    
    
    
    
    
    public function destroy($id)
    {
        $product = Product::query()->findOrFail($id)->delete();


        Session::put('message', 'Xóa danh mục sản phẩm thành công');
        return Redirect(route('index_products'));
    }

    
    
    
    
    
    public function changeStatus($id)
    {
        $product = Product::query()->findOrFail($id);
        $status = 1;
        if($product->status == 1) {
            $status = 0;
        }
        $product->update(['status' => $status]);

        return redirect(route('index_products'));
    }
}
