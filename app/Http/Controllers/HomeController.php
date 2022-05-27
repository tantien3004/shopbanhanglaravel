<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;
// use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $categories = Category::query()->where('status', '1')->orderbyDesc('id')->get();
        $brands = Brand::query()->where('status', '1')->orderbyDesc('id')->get();

        $products = Product::query()->where('status', '1')->orderbyDesc('id')->limit(6)->get();

        return view('pages.home')->with('categories', $categories)->with('brands', $brands)->with('products', $products);
    }
}
