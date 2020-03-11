(function($) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var grabedurl = window.location.pathname;
    var url = "/api" + grabedurl;
    var tambahan = window.location.search;

    $.ajax({
        url: url,
        method: "GET",
        datatype: "json",
        success: function(berhasil) {
            $.each(berhasil.data, function(key, value) {
                $("#home-produk").append(
                    `
                <div class="single-products-catagory clearfix">
                    <a href="/produk/${value.slug}">
                        <img src="assets/poto/${value.foto}" alt="">
                        <!-- Hover Content -->
                        <div class="hover-content">
                            <div class="line"></div>
                            <p>From $${value.harga}</p>
                            <h4>${value.nama}</h4>
                        </div>
                    </a>
                </div>
                `
                );
            });
        }
    });

    $.ajax({
        url: url,
        method: "GET",
        datatype: "json",
        success: function(berhasil) {
            $.each(berhasil.data.kategori, function(key, value) {
                $("#kategori").append(
                    `
                    <li><a href="/shop/${value.slug}">${value.nama}</a></li>
                `
                );
            });
        }
    });

    var no = 0;
    $.ajax({
        url: url + tambahan,
        method: "GET",
        datatype: "json",
        success: function(berhasil) {
            console.log(berhasil)
            $.each(berhasil.data.produk.data, function(key, value) {
                no++;
                $("#produk").append(
                    `
                    <div class="col-12 col-sm-6 col-md-12 col-xl-6">
                        <div class="single-product-wrapper">
                            <!-- Product Image -->
                            <div class="product-img">
                                <img src="/assets/poto/${value.foto}" style="width:500px; height:450px">
                            </div>

                            <!-- Product Description -->
                            <div class="product-description d-flex align-items-center justify-content-between">
                                <!-- Product Meta Data -->
                                <div class="product-meta-data">
                                    <div class="line"></div>
                                    <p class="product-price">Rp${value.harga}</p>
                                    <a href="/produk/${value.slug}">
                                        <h6>${value.nama}</h6>
                                    </a>
                                </div>
                                <!-- Ratings & Cart -->
                                <div class="ratings-cart text-right">
                                    <div class="ratings">
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                    </div>
                                    <div class="cart">
                                        <form id="form` + no + `">
                                            <input type="hidden" id="id_produk` + no + `" value="${value.id}">
                                            <input type="hidden" id="qty` + no + `" value="1">
                                        </form>
                                        <a href='javascript:void(0)'><img src="/assets/frontend/img/core-img/cart.png" alt="" class="simpan" data-id="` + no + `"></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                `
                ).add(
                    $('#id_produk' + no + '').attr('name', 'id_produk'), //
                    $('#qty' + no + '').attr('name', 'qty'), //
                    //
                );
            });
            $('.simpan').click(function(e) {
                e.preventDefault();
                var noform = $(this).data('id');
                // $(this).hide();
                $.ajax({
                    data: $('#form' + noform + '').serialize(),
                    url: "/formcart",
                    type: "POST",
                    success: function(data) {
                        $('#form').trigger("reset");
                        $('#notif').show();
                        $('#totalproduk').load('/totalproduk');
                        setTimeout(() => {
                            $('#notif').css('display', 'none');
                        }, 3000);
                    },

                    error: function(request, status, error) {
                        console.log(error);
                    }
                })
            })
        }
    });

})(jQuery);