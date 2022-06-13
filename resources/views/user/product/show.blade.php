@extends('layout')
@section('content')

<div class="product-details"><!--product-details-->
    <div class="col-sm-5">
        <div class="view-product">
            <img src="{{ route('home') . '/' . $product->image }}" alt="" />
            <h3>ZOOM</h3>
        </div>
        <div id="similar-product" class="carousel slide" data-ride="carousel">
            
              <!-- Wrapper for slides -->
                <div class="carousel-inner">
                    <div class="item active">
                      <a href=""><img src="{{ URL::to('/frontend/images/similar1.jpg') }}" alt=""></a>
                      <a href=""><img src="{{ URL::to('/frontend/images/similar2.jpg') }}" alt=""></a>
                      <a href=""><img src="{{ URL::to('/frontend/images/similar3.jpg') }}" alt=""></a>
                    </div>
                    </div>
                    
                </div>

              <!-- Controls -->
              <a class="left item-control" href="#similar-product" data-slide="prev">
                <i class="fa fa-angle-left"></i>
              </a>
              <a class="right item-control" href="#similar-product" data-slide="next">
                <i class="fa fa-angle-right"></i>
              </a>
        </div>

    </div>
    <div class="col-sm-7">
        <div class="product-information"><!--/product-information-->
            <img src="{{ URL::to('/frontend/images/new.jpg') }}" class="newarrival" alt="" />
            <h2>{{ $product->name }}</h2>
            <p>ID sản phẩm: {{ $product->id }}</p> 
            <img src="{{ URL::to('/frontend/images/rating.png') }}" alt="" />
            <form action="{{ route('cart.store') }}" method="POST">
                {{ csrf_field() }}
                <span>
                    <span>{{ number_format($product->price ) . 'VNĐ'}}</span>
                    <label>Quantity:</label>
                    <input type="number" min="1" value="1" name="qty"/>
                    <input type="hidden" name="productid_hidden" value="{{ $product->id }}"/>
                    <button type="submit" class="btn btn-fefault cart">
                        <i class="fa fa-shopping-cart"></i>
                        Thêm vào giỏ hàng
                    </button>
                </span>
            </form>
            <p><b>Tình trạng:</b> Còn hàng</p>
            <p><b>Điều kiện:</b> New</p>
            <p><b>Thương hiệu:</b> {{ $product->brand->name }} </p>
            <a href=""><img src="{{ URL::to('/frontend/images/share.png') }}" class="share img-responsive"  alt="" /></a>
        </div><!--/product-information-->
    </div>
</div><!--/product-details-->


<div class="category-tab shop-details-tab"><!--category-tab-->
</div><!--/category-tab-->


<div class="recommended_items"><!--recommended_items-->
    <h2 class="title text-center">Sản phẩm tương tự</h2>
    <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="item active">	
                @foreach ($relatebrands as $relatebrand)
                <div class="col-sm-4">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <img src="{{ route('home') . '/' . $relatebrand->image }}" alt="" />
                                <h2>{{ number_format($relatebrand->price) }}</h2>
                                <p>{{ $relatebrand->name }}</p>
                                <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</button>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="item">	
                @foreach ($relatecategories as $relatecategory)
                <div class="col-sm-4">                   
                    <div class="product-image-wrapper">                                           
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <img src="{{ route('home') . '/' . $relatecategory->image }}" alt="" />
                                <h2>{{ number_format($relatecategory->price) }}</h2>
                                <p>{{ $relatecategory->name }}</p>
                                <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</button>
                            </div>
                        </div>         
                    </div>                    
                </div>
                @endforeach
            </div>
        </div>
         <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
            <i class="fa fa-angle-left"></i>
          </a>
          <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
            <i class="fa fa-angle-right"></i>
          </a>			
    </div>
</div><!--/recommended_items-->
@endsection
