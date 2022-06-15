<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Cart;
use Illuminate\Support\Facades\Session;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    
    public function cartList()
    {
        $cartItems = Cart::query()
            ->where('user_id', Auth::user()->id)
            ->with('product')
            ->get();
        $categories = Category::query()->where('status', '1')->orderbyDesc('id')->get();
        $brands = Brand::query()->where('status', '1')->orderbyDesc('id')->get();

        $products = Product::query()->where('status', '1')->orderbyDesc('id')->limit(10)->get();

        return view('user.product.cart')
                ->with('cartItems', $cartItems)
                ->with('categories', $categories)
                ->with('brands', $brands)
                ->with('products', $products);
    }

    public function add($id, Request $request)
    {
        $quantity = $request->get('quantity') ?? 1;
        $product = Product::query()->findOrFail($id);
        $cart = Cart::query()
            ->where('user_id', Auth::user()->id)
            ->where('product_id', $product->id)
            ->first();
        if($cart) {
            $cart->update([
                'quantity' => $cart->quantity + 1
            ]);
        } else {
            $data = [
                'user_id' => Auth::user()->id,
                'product_id' => $product->id,
                'quantity' => $quantity,
            ];
            Cart::query()->create($data);
        }
        return redirect()->route('cart.list');
    }


    public function addToCart(Request $request)
    {
        Cart::add([
            'id' => $request->id,
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity,
        ]);
        session()->flash('success', 'Product is added to Cart Successfully !');
        return redirect()->route('cart.list');
    }

    public function updateCart(Request $request)
    {
        Cart::query()->update( // sửa
            $request->id,
            [
                'quantity' => [
                    'relative' => false,
                    'value' => $request->quantity
                ],
            ]
        );

        session()->flash('success', 'Item Cart is Updated Successfully !');

        return redirect()->route('cart.list');
    }

    public function removeCart($id)
    {
        $cart = Cart::query()
            ->where('user_id', Auth::user()->id)
            ->where('product_id', $id)
            ->first();
        if(!$cart) return false;
        return $cart->delete();
    }

    public function clearAllCart()
    {
        Cart::clear();

        session()->flash('success', 'All Item Cart Clear Successfully !');

        return redirect()->route('cart.list');
    }

    public function updateQuantity(Request $request)
    {
        $data = $request->only('product_id', 'quantity');
        if(empty($data['product_id']) || empty($data['quantity'])) {
            return false;
        }
        $cart = Cart::query()
            ->where('user_id', Auth::user()->id)
            ->where('product_id', $data['product_id'])
            ->first();
        if(!$cart) return false;
        return $cart->update([
            'quantity' => $data['quantity']
        ]);

    }

    // public function updateTotal(Request $request)
    // {
    //     $data = $request->only();
    // }
    
    public function addToCartAjax(Request $request)
    {
        $productId = $request->get('product_id');
        if(!$productId) return false;
        $cart = Cart::query()
            ->where('user_id', Auth::user()->id)
            ->where('product_id', $productId)
            ->first();
        if($cart) {
            return $cart->update([
                'quantity' => $cart->quantity + 1
            ]);
        } else {
            $data = [
                'user_id' => Auth::user()->id,
                'product_id' => $productId,
                'quantity' => 1,
            ];
            return Cart::query()->create($data);
        }
        return false;
    }

}
