@extends('admin_layout')
@section('admin_content')

<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm thương hiệu sản phẩm
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
                    <form  role="form" method="post" action="{{ URL::to('/brands/store') }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputEmail">Tên thương hiệu</label>
                            <input type="text" name="name" class="form-control" id="exampleInputEmail" placeholder="Tên thương hiệu">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả thương hiệu</label>
                            <textarea style="resize: none" row="11" class="form-control" id="exampleInputPassword1" placeholder="Mô tả thương hiệu" name="desc"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail">Hiển thị</label>
                            <select name="status" class="form-control input-sm m-bot15">
                                <option value="0">Ẩn</option>
                                <option value="1">Hiển thị</option>
                            </select>
                        </div>
                        <button type="submit" name=" " class="btn btn-info">Thêm thương hiệu</button>
                    </form>

                </div>
            </div>
        </section>
    </div>
</div>

@endsection