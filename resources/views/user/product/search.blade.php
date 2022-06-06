@extends('layout')
@section('content')
                   <div class="features_items"><!--features_items-->
                       <h2 class="title text-center">Kết quả tìm kiếm</h2>
                       {{-- @foreach ($products as $product)
                       <div class="col-sm-4">
                           <div class="product-image-wrapper">
                               <div class="single-products">
                                       <div class="productinfo text-center">
                                           <img src="{{ route('home') . '/' . $product->image }}" alt="" />
                                           <p >{{ $product->description }}</p>
                                           <a color="red" href="#" class="btn btn-default add-to-cart">{{ $product->name }}</a>
                                       </div>
                                       <div class="product-overlay">
                                           <div class="overlay-content">
                                               <h2>đ{{ number_format( $product->price ) }}</h2>
                                               <p></p>
                                               <a href="{{ route('addToCart', ['id' => $product->id]) }}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</a>
                                           </div>
                                       </div>
                               </div>
                               <div class="choose">
                                   <ul class="nav nav-pills nav-justified">
                                       <li><a href="#"><i class="fa fa-plus-square"></i>Lưu</a></li>
                                       <li><a href="#"><i class="fa fa-plus-square"></i>So sánh</a></li>
                                   </ul>
                               </div>
                           </div>
                       </div>
                       @endforeach												 --}}
                   </div><!--features_items-->
@endsection