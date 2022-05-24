@extends('admin_layout')
@section('admin_content')

<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Liệt kê thương hiệu sản phẩm
        </div>
        <div class="row w3-res-tb">
            
            <div class="col-sm-6 m-b-xs">
                <select class="input-sm form-control w-sm inline v-middle">
                    <option value="0">Bulk action</option>
                    <option value="1">Delete selection</option>
                    <option value="2">Bulk edit</option>
                    <option value="3">Export</option>
                </select>
                <button class="btn btn-sm btn-default">Apply</button>
            </div>
            <div class="col-sm-6">
                
                <div class="input-group">
                    <div class="input-group">
                        <input type="text" class="input-sm form-control" placeholder="Search">
                        <span class="input-group-btn">
                            <button class="btn btn-sm btn-default" type="button">Go</button>
                        </span>
                    </div>
                </div>
            </div>
            <div>
                
                <table class="table table-striped b-t b-light">

                    

                    <thead>
                        <tr>
                            <th style="width:20px;">
                            <label class="i-checks m-b-none">
                                <input type="checkbox"> <i></i>
                            </label>
                            </th>
                            <th>Tên thương hiệu</th>
                            <th>Hiển thị</th>
                            <th style="width:30px"></th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($brands as $brand)
                        <tr>
                            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
                            <td>{{ $brand->name }}</td>
                            <td>
                                <span class="text-ellipsis">
                                <?php
                                if ($brand->status==1)
                                {
                                    ?>
                                    <a href="{{ route('changeStatus_brands', ['id' => $brand->id]) }}"><span class="fa fa-thumbs-up"></span></a>
                                    <?php }
                                else {
                                    ?>
                                    <a href="{{ route('changeStatus_brands', ['id' => $brand->id]) }}"><span class="fa fa-thumbs-down"></span></a>
                                    
                                    <?php
                                }
                                ?>
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('edit_brands', ['id' => $brand->id]) }}" class="active" ui-toggle-class="">
                                    <i class="fa fa-pencil-square-o text success text-active"></i>
                                </a>
                                <form method="post" action="{{ route('delete_brands', ['id' => $brand->id]) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="active" ui-toggle-class="">
                                        <i class="fa fa-times text-danger text"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <footer class="panel-footer"> 
                <div class="row">
                    <div class="clo-sm-5 text-center">
                        <small class="text muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
                    </div>
                    <div class="col-sm-7 text-right text-center-xs">
                        <ul class="pagination pagination-sm m-t-none m-b-none" >
                            <li><a><i class="fa fa-chevron-left"></i></a></li>
                            <li><a>1</a></li>
                            <li><a>2</a></li>
                            <li><a>3</a></li>
                            <li><a>4</a></li>
                            <li><a><i class="fa fa-chevron-right"></i></a></li>
                        </ul>
                    </div>
                </div>
            </footer>
        </div>
    </div>
</div>

@endsection