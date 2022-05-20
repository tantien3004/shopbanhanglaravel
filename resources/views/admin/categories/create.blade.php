@extends('admin_layout')
@section('admin_content')

<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm danh mục sản phẩm
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
                    <form  role="form" method="post" action="{{ URL::to('/categories/store') }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputEmail">Tên danh mục</label>
                            <input type="text" name="category_product_name" class="form-control" id="exampleInputEmail" placeholder="Tên danh mục">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả danh mục</label>
                            <textarea style="resize: none" row="11" class="form-control" id="exampleInputPassword1" placeholder="Mô tả danh mục" name="category_product_desc"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail">Hiển thị</label>
                            <select name="category_product_status" class="form-control input-sm m-bot15">
                                <option value="0">Ẩn</option>
                                <option value="1">Hiển thị</option>
                            </select>
                        </div>
                        <button type="submit" name=" " class="btn btn-info">Thêm danh mục</button>
                    </form>

                </div>
            </div>
        </section>
    </div>
</div>

@endsection