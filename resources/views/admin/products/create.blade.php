@extends('admin_layout')
@section('admin_content')

<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm sản phẩm
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
                    <form  role="form" method="post" action="{{ URL::to('/products/store') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputEmail">Tên sản phẩm</label>
                            <input type="text" name="name" class="form-control" id="exampleInputEmail" placeholder="Tên sản phẩm">
                        </div>          
                        <div class="form-group">
                            <label for="exampleInputEmail">Hình ảnh sản phẩm</label>
                            <input type="file" name="image" class="form-control" id="exampleInputEmail" placeholder="Hình ảnh sản phẩm">
                        </div>              
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả sản phẩm</label>
                            <textarea style="resize: none" row="11" class="form-control" id="exampleInputPassword1" placeholder="Mô tả sản phẩm" name="description"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Giá sản phẩm</label>
                            <input class="form-control" name="price"/>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail">Danh mục sản phẩm</label>
                            <select name="category_id" class="form-control input-sm m-bot15">
                                
                               @foreach ($categories as $category)
                               <option value="{{ $category->id }}">{{ $category->name }}</option>
                               @endforeach

                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail">Thương hiệu</label>
                            <select name="brand_id" class="form-control input-sm m-bot15">
                                
                                @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}" >{{ $brand->name }}</option>
                                @endforeach                               

                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail">Hiển thị</label>
                            <select name="status" class="form-control input-sm m-bot15">
                                <option value="0">Ẩn</option>
                                <option value="1">Hiển thị</option>
                            </select>
                        </div>
                        <button type="submit" name=" " class="btn btn-info">Thêm sản phẩm</button>
                    </form>

                </div>
            </div>
        </section>
    </div>
</div>

@endsection