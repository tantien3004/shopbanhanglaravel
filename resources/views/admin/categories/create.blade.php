@extends('admin_layout')
@section('admin_content')

<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm danh mục sản phẩm
            </header>
            <div class="panel-body">
                <div class="position-center">
                    <form action="" role="form">
                        <div class="form-group">
                            <label for="exampleInputEmail">Tên danh mục</label>
                            <input type="email" name="category_product_name" class="form-control" id="exampleInputEmail" placeholder="Tên danh mục">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả danh mục</label>
                            <textarea style="resize: none" row="11" class="form-control" id="exampleInputPassword1" placeholder="Mô tả danh mục" name="category_product_desc"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail">Hiển thị</label>
                            <select class="form-control input-sm m-bot15">
                                <option>Ẩn</option>
                                <option>Hiển thị</option>
                            </select>
                        </div>
                        <button type="submit" name="add_category_product" class="btn btn-info">Thêm</button>
                    </form>

                </div>
            </div>
        </section>
    </div>
</div>

@endsection