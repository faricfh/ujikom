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
                <br><br>
            </div>
        </div>
    </div>
    <div id="disqus_thread"></div>
</div>
<div class="notify-alert notify-success bounceOutRight" role="alert" style="display: none" id="notif">
    <div class="notify-alert-icon"><i class="flaticon2-check-mark"></i></div>
    <div class="notify-alert-text">
        <h4>success</h4>
        <p>Product Successfully Added to Cart</p>
    </div>
    <!-- <div class="notify-alert-close">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true"><i class="flaticon2-cross"></i></span>
        </button>
    </div> -->
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
                    $('#totalproduk').load('/totalproduk');
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
<script>

/**
*  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
*  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/
/*
var disqus_config = function () {
this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
};
*/
(function() { // DON'T EDIT BELOW THIS LINE
var d = document, s = d.createElement('script');
s.src = 'https://ecommercewebsite-1.disqus.com/embed.js';
s.setAttribute('data-timestamp', +new Date());
(d.head || d.body).appendChild(s);
})();
</script>
<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>

@endsection
