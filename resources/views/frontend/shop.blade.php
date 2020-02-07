@extends('layouts.frontend')

@section('content')
<div class="shop_sidebar_area">

    <!-- ##### Single Widget ##### -->
    <div class="widget catagory mb-50">
        <!-- Widget Title -->
        <h6 class="widget-title mb-30">Kategori</h6>

        <!--  Catagories  -->
        <div class="catagories-menu">
            <ul id="kategori">
            </ul>
        </div>
    </div>
</div>

<div class="amado_product_area section-padding-100">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="product-topbar d-xl-flex align-items-end justify-content-between">
                    <h3>Produk</h3>
                </div>
            </div>
        </div>

        <div class="row" id="produk">

        </div>

        <div class="row">
            <div class="col-12" id="pp">
                <!-- Pagination -->
                <nav aria-label="navigation">
                    <ul class="pagination justify-content-end mt-50">
                            <li class="page-item active">{{ $produk->links() }}</li>
                    </ul>
                </nav>
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
<script src="{{ asset('js/frontend.js') }}"></script>
@endsection
