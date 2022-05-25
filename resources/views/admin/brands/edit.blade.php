@extends('admin_layout')
@section('admin_content')

<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Cập nhật danh mục thương hiệu
            </header>
            
            <div class="panel-body">
                <?php
                $message = Session::get('message');
                if($message)
                {
                    echo '<span class ="text-alert">'.$message.'</span>';
                    Session::put('message', null);
                }   ?>
                <div class="position-center">
                    <form  role="form" method="post" action="{{ route('update_brands', ['id' => $brand->id]) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="exampleInputEmail">Tên danh mục</label>
                            <input value="{{ $brand->name }}" type="text" name="name" class="form-control" id="exampleInputEmail" placeholder="Tên danh mục">
                        </div>
                        
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả danh mục</label>
                            <textarea style="resize: none" row="11" class="form-control" id="exampleInputPassword1" placeholder="Mô tả danh mục" name="desc">{{ $brand->desc }}</textarea>
                        </div>
                        
                        <button type="submit" name="update" class="btn btn-info">Cập nhật danh mục</button>
                    </form>
                </div>
                
               
                
            </div>
        </section>
    </div>
</div>

@endsection