@extends('layouts.frontend')

@section('content')
<div class="cart-table-area section-padding-100">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-lg-8">
                        <div class="cart-title mt-50">
                            <h2>Shopping Cart</h2>
                        </div>

                        <div class="cart-table clearfix">
                            <form id="form">
                            <table class="table table-responsive">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                    </tr>
                                </thead>
                                    <tbody >
                                        @php
                                            $no = 0;
                                        @endphp
                                        @foreach($carts as $data)
                                        @php
                                            $no++
                                        @endphp
                                        <input type="hidden" name="id_produk[]" value="{{ $data['id_produk']}}">
                                        <tr>
                                                <td class="cart_product_img">
                                                    <a href="#"><img src="assets/poto/{{ $data['foto_produk'] }}" alt="Product"></a>
                                                </td>
                                                <td class="cart_product_desc">
                                                    <h5>{{ $data['nama_produk'] }}</h5>
                                                </td>
                                                <td class="price">
                                                    <span>{{ number_format($data['harga_produk']) }}</span>
                                                </td>
                                                <td class="qty">
                                                    <div class="qty-btn d-flex">
                                                        <p>Qty</p>
                                                        <div class="quantity">
                                                            <span class="qty-minus" onclick="var effect = document.getElementById('qty{{ $no }}'); var qty = effect.value; if( !isNaN( qty ) &amp;&amp; qty &gt; 1 ) effect.value--;return false;"><i class="fa fa-minus" aria-hidden="true"></i></span>
                                                            <input type="number" class="qty-text" id="qty{{ $no }}" step="1" min="1" max="300" name="qty[]" value="{{ $data['qty'] }}">
                                                            <span class="qty-plus" onclick="var effect = document.getElementById('qty{{ $no }}'); var qty = effect.value; if( !isNaN( qty )) effect.value++;return false;"><i class="fa fa-plus" aria-hidden="true"></i></span>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                            </table>
                            </form>
                            <button type="submit" class="btn amado-btn" id="update">Update</button>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4">
                        <div class="cart-summary tanda">
                            <h5>Cart Total</h5>
                            <ul class="summary-table">
                                <li><span>subtotal:</span> <span>Rp. {{ number_format($subtotal)  }}</span></li>
                                <li><span>delivery:</span> <span>Free</span></li>
                                <li><span>total:</span> <span>Rp. {{ number_format($subtotal)  }}</span></li>
                            </ul>
                            <div class="cart-btn mt-100">
                                <a href="cart.html" class="btn amado-btn w-100">Checkout</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
<script src="{{ asset('js/cart.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#update').click(function(e) {
            e.preventDefault();
            // $(this).hide();
            $.ajax({
                data: $('#form').serialize(),
                url: "{{ url('/formcart-update') }}",
                type: "POST",
                success: function(data) {
                    //
                },

                error: function(request, status, error) {
                    console.log(error);
                }
            });
        });
    });
</script>
@endsection
