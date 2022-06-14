<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;
use GuzzleHttp\Psr7\Request;

// use Illuminate\Http\Request;

class HomeController extends Controller
{
    // public function __construct()
    // {  
    //    $this->middleware('auth'); 
    // }

    public function index()
    {
        $categories = Category::query()->where('status', '1')->orderbyDesc('id')->get();
        $brands = Brand::query()->where('status', '1')->orderbyDesc('id')->get();

        $products = Product::query()->where('status', '1')->orderbyDesc('id')->limit(10)->get();

        return view('pages.home')->with('categories', $categories)->with('brands', $brands)->with('products', $products);
    }

    public function search(Request $request)
    {
        $keywords = $request->keywords;
        $categories = Category::query()->where('status', '1')->orderbyDesc('id')->get();
        $brands = Brand::query()->where('status', '1')->orderbyDesc('id')->get();
        return view('pages.home')->with('categories', $categories)->with('brands', $brands);
    }
}
