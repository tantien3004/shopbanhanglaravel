@extends('layout')
@section('content')

<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
              <li><a href="{{ route('user.home') }}">Trang chủ</a></li>
              <li class="active">Giỏ hàng của bạn</li>
            </ol>
        </div>
        <div class="table-responsive cart_info">
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <td class="image">Hình ảnh</td>
                        <td class="price">Giá</td>
                        <td class="quantity">Số lượng</td>
                        <td class="total">Thành tiền</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    @if($cartItems)
                        <?php $total = 0; ?>
                        @foreach ($cartItems as $item)
                            @if($item->product)
                            <?php
                                $total = $total + ($item->product->price * $item->quantity);
                            ?>
                            <tr class="product-{{ $item->product->id }}">
                                <td class="cart_product">
                                    <a href="" style="width: 200px; display: block ">
                                        <img src="{{ $item->product->image }}" alt="" style="max-width: 100%; height: auto">
                                    </a><br/><i href="" style="color: green">
                                    {{ $item->product->name }}</i>
                                </td>
                                <td class="cart_price">
                                    <p>{{ number_format($item->product->price, 0, '', '.') }} ₫</p>
                                </td>
                                <td class="cart_quantity">
                                    <div class="cart_quantity_button">
                                        <input class="cart_quantity_input" data-product="{{ $item->product->id }}" data-price="{{ $item->product->price }}" type="number" name="quantity" value="{{ $item->quantity }}"  min="1" max="1000">
                                    </div>
                                </td>
                                <td class="cart_total">
                                    <p class="cart_total_price price-{{ $item->product->id }}">
                                        {{ number_format($item->product->price * $item->quantity, 0, '', '.') }} ₫
                                    </p>
                                </td>
                                <td class="btn btn-danger" >
                                    <a class="delete-button" data-product="{{ $item->product->id }}"><i class="fa fa-times"></i></a>
                                </td>
                            </tr>
                            @endif
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>

    <section id="do_action">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="total_area" >
                        <ul>
                            <li>Thành tiền<span>{{ number_format($total, 0, '', '.') }} ₫</span></li>
                            <li>Phí ship<span>{{ number_format($total * 0.001 , 0, '', '.') }} ₫</span></li>
                            <li>Thuế<span>{{ number_format(($total + ($total * 0.001)) * 0.1 , 0, '', '.') }} ₫</span></li>
                            <li>Tống số tiền<span>{{ number_format($total + $total * 0.1 + ($total + ($total * 0.1)) * 0.001, 0, '', '.') }} ₫</span></li>
                        </ul>
                            <a class="btn btn-default update" href="">Update</a>
                            <a class="btn btn-default check_out" href="">Check Out</a>
                    </div>
                </div>
            </div>
        </div>
    </section><!--/#do_action-->
</section> <!--/#cart_items-->
@endsection

@section('script')
<script>
    $(document).ready(function() {
        $('.delete-button').on('click', function() {
            var productId = $(this).data('product');
            if(confirm('bạn chắc chắn xóa sản phẩm này?')) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'DELETE',
                    method: 'DELETE',
                    dataType: 'json',
                    url: "/cart/remove/" + productId,

                }).done(function(result) {
                    var className = '.product-' + productId;
                    $(className).remove();
                    updateMoney();
                });
            }
        });

        $('.cart_quantity_input').on('change', function() {
            var productId = $(this).data('product');
            var quantity = $(this).val();
            var price = $(this).data('price');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                method: 'POST',
                url: "{{ route('update.quantity') }}",
                dataType: 'json',
                data: {
                    _token: '{{ csrf_token() }}',
                    product_id: productId,
                    quantity: quantity
                }
            }).done(function(result) {
                var className = 'price-' + productId;
                var total = parseInt(quantity) * parseInt(price);
                $('.' + className).text(new Intl.NumberFormat('vi-VN', {
                    style: 'currency',
                    currency: 'VND'
                }).format(total) + '');
                updateMoney();
            });
        });

        function updateMoney(){
            
        }
	});

</script>
@endsection