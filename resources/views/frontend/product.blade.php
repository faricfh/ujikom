@extends('layouts.frontend')

@section('content')
<div class="single-product-area section-padding-100 clearfix">
    <div class="container-fluid">
        <div id="produkdetail">

        </div>
        <div class="single_product_desc" style="margin-left:60%;">
            <div class="product-meta-data">
                <div class="line"></div>
                <form class="cart clearfix" id="form" name="form">
                    <div class="cart-btn d-flex mb-50">
                        <p>Qty</p>
                        <div class="quantity">
                            <span class="qty-minus" onclick="var effect = document.getElementById('qty'); var qty = effect.value; if( !isNaN( qty ) &amp;&amp; qty &gt; 1 ) effect.value--;return false;"><i class="fa fa-caret-down" aria-hidden="true"></i></span>
                            <input type="number" class="qty-text" id="qty" step="1" min="1" max="300" name="qty" value="1">
                            <span class="qty-plus" onclick="var effect = document.getElementById('qty'); var qty = effect.value; if( !isNaN( qty )) effect.value++;return false;"><i class="fa fa-caret-up" aria-hidden="true"></i></span>
                        </div>
                    </div>
                </form>
                <button type="submit" class="btn amado-btn" id="simpan">Add to cart</button>
            </div>
        </div>
    </div>
</div>
<div class="notify-alert notify-success bounceOutRight" role="alert" style="display: none" id="notif">
    <div class="notify-alert-icon"><i class="flaticon2-check-mark"></i></div>
    <div class="notify-alert-text">
        <h4>success</h4>
        <p>Product Successfully Added to Cart</p>
    </div>
    <div class="notify-alert-close">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true"><i class="flaticon2-cross"></i></span>
        </button>
    </div>
</div>
@endsection

@section('js')
<script src="{{ asset('js/produkdetail.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#simpan').click(function(e) {
            e.preventDefault();
            // $(this).hide();
            $.ajax({
                data: $('#form').serialize(),
                url: "{{ url('/formcart') }}",
                type: "POST",
                success: function(data) {
                    $('#form').trigger("reset");
                    $('#notif').show();
                    setInterval(function(){
                        $('#notif').css('display','none');
                    },2000)
                },

                error: function(request, status, error) {
                    console.log(error);
                }
            });
        });
    });
</script>
@endsection
