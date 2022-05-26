<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
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
        $products=Product::query()
            ->with('category:id,name')
            ->with('brand:id,name')
            ->get();
       return view('admin.products.index')->with('products', $products);
    }

    
    
    public function create(Request $request)
    {
        $this->loggin();
        $categories = Category::query()->orderbyDesc('id')->get();
        $brands = Brand::query()->orderbyDesc('id')->get();


        return view('admin.products.create')->with('categories', $categories)->with('brands', $brands);
    }

    
    
    public function store(Request $request)
    {
        $this->loggin();
        if($request->file('image')) {
            $path = $request->file('image')->store('public/images');
            $path = str_replace('public', 'storage', $path);
        }
        $product = new Product();
        $product->name = $request->get('name');
        $product->price = $request->get('price');
        $product->description = $request->get('description');
        $product->status = $request->get('status');
        $product->category_id = $request->get('category_id');
        $product->brand_id = $request->get('brand_id');
        $product->image = $path;
        $product->save();

        Session::put('message','Thêm sản phẩm thành công');
        return Redirect::to('/products/create');
    }  
    
    public function update( Request $request, $id)
    {
        $this->loggin();
        $product = Product::query()->findOrFail($id);
        if($request->file('image')) {
            $path = $request->file('image')->store('public/images');
            $path = str_replace('public', 'storage', $path);
        }
        $product->name = $request->post('name');
        $product->price = $request->post('price');
        $product->description = $request->post('description');
        // $product->status = $request->post('status');
        $product->category_id = $request->post('category_id');
        $product->brand_id = $request->post('brand_id');        
        $product->image=$path;
        $product->update();

        //bug: phải sửa đồng thời và trạng thái của sản phẩm không đúng như sản phẩm hiện có
 
        Session::put('message', 'Cập nhật thành công');
        return redirect(route('index_products'));
    }

    public function edit($id)
    {
        $this->loggin();
        $product = Product::query()
            ->with('category:id,name')
            ->with('brand:id,name')
            ->findOrFail($id);
        $categories = Category::query()->get();
        $brands = Brand::query()->get();
        
        return view('admin.products.edit')->with('product', $product)->with('categories', $categories)->with('brands', $brands);
    }

    
    
    
    
    
    public function destroy($id)
    {
        $this->loggin();
        $product = Product::query()->findOrFail($id)->delete();


        Session::put('message', 'Xóa danh mục sản phẩm thành công');
        return Redirect(route('index_products'));
    }

    
    
    
    
    
    public function changeStatus($id)
    {
        $this->loggin();
        $product = Product::query()->findOrFail($id);
        $status = 1;
        if($product->status == 1) {
            $status = 0;
            Session::put('message', 'Hủy kích hoạt sản phẩm thành công');
        } else Session::put('message','Kích hoạt sản phẩm thành công');
        $product->update(['status' => $status]);
        
        return redirect(route('index_products'));
    }
    public function show($id)
    {
        $this->loggin();
    }
}
