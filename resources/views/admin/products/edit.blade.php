@extends('admin_layout')
@section('admin_content')

<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Cập nhật sản phẩm
            </header>
            <div class="panel-body">
                <?php
                $message = Session::get('message');
                if($message)
                {
                    echo '<span class ="text-alert">'.$message.'</span>';
                    Session::put('message', null);
                }
                ?>
                <div class="position-center">
                    <form  role="form" method="post" action="{{ URL::to('/products/update') }}" enctype="multipart/form-data">
                        {{-- {{ csrf_field() }} --}}
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="exampleInputEmail">Tên sản phẩm</label>
                            <input type="text" name="name" class="form-control" id="exampleInputEmail" placeholder="Tên sản phẩm" value="{{ $product->name }}">
                        </div>          
                        <div class="form-group">
                            <label for="exampleInputEmail">Hình ảnh sản phẩm</label>
                            <input type="file" name="image" class="form-control" id="exampleInputEmail" placeholder="Hình ảnh sản phẩm">
                            <img src="{{ route('home') . '/' . $product->image }}" height="100" width="100">
                        </div>              
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả sản phẩm</label>
                            <textarea style="resize: none" row="11" class="form-control" id="exampleInputPassword1" placeholder="Mô tả sản phẩm" name="description">{{ $product->description }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Giá sản phẩm</label>
                            <input class="form-control" name="price" value="{{ $product->price }}" />
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail">Danh mục sản phẩm</label>
                            <select name="category_id" class="form-control input-sm m-bot15">
                                
                               @foreach ($categories as $category)
                               <option value="{{ $category->id }}" <?php if($category->id == $product->category_id) echo "selected" ?>>{{ $category->name }}</option>
                               @endforeach

                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail">Thương hiệu</label>
                            <select name="brand_id" class="form-control input-sm m-bot15">
                                
                                @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}" <?php if($brand->id == $product->brand_id) echo "selected" ?>>{{ $brand->name }}</option>
                                @endforeach                               

                            </select>
                        </div>
                        {{-- <div class="form-group">
                            <label for="exampleInputEmail">Hiển thị</label>
                            <select name="status" class="form-control input-sm m-bot15" value="{{ $product->status }}" >
                                <option value="0">Ẩn</option>
                                <option value="1">Hiển thị</option>
                            </select>
                        </div> --}}
                        <button type="submit" name=" " class="btn btn-info">Cập nhật sản phẩm</button>
                    </form>

                </div>
            </div>
        </section>
    </div>
</div>

@endsection