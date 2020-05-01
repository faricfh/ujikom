@extends('layouts.frontend')

@section('content')
<div class="cart-table-area section-padding-100">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-lg-8">
                <div class="checkout_details_area mt-50 clearfix">

                    <div class="cart-title">
                        <h2>Checkout</h2>
                    </div>
                    <div id="alertgagal"></div>
                    <form id="order">
                        <input type="hidden" id="id_orderdetail" name="id_orderdetail">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <input type="text" name="nama_customer" class="form-control" id="nama_customer" value="" placeholder="Nama Lengkap" autocomplete="off" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <input type="text" name="phone_customer" class="form-control" id="phone_customer" placeholder="No Telepon" value="" autocomplete="off" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <input type="email" name="email_customer" class="form-control" id="email_customer" placeholder="Email" value="" autocomplete="off" required>
                            </div>
                            {{-- --------------- --}}
                            <div hidden>
                                <div class="col-md-6 mb-3">
                                    <label for="">Provinsi Asal</label>
                                    <select class="w-100" name="provinsi_asal" id="provinsi_asal">
                                        <option selected disabled>--Provinsi Asal--</option>
                                        @foreach($provinsi as $provinsis => $value)
                                            <option value="{{ $provinsis }}" {{ ($provinsis == 9 ? "selected" : "") }} readonly>{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="">Kota Asal</label>
                                    <select class="w-100" name="kota_asal" id="kota_asal">
                                        @foreach($kota as $kotas => $value)
                                            <option value="{{ $kotas }}" {{ ($kotas == 23 ? "selected" : "")  }} readonly>{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Provinsi Tujuan</label>
                                <select class="w-100" name="provinsi_tujuan" id="provinsi_tujuan">
                                    <option selected disabled>--Provinsi Tujuan--</option>
                                    @foreach($provinsi as $provinsis => $value)
                                        <option value="{{ $provinsis }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Kota Tujuan</label>
                                <select class="w-100" name="kota_tujuan" id="kota_tujuan">
                                   <option value="kota_tujuan" selected disabled>--Kota Tujuan--</option>
                                </select>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="">Kurir</label>
                                <select class="w-100" name="kurir" id="kurir">
                                    <option selected disabled>--Kurir--</option>
                                    @foreach($kurir as $kurirs => $value)
                                        <option value="{{ $kurirs }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12 mb-3">
                                <div id="layanan">

                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <textarea name="alamat_customer" id="alamat_customer" class="form-control" cols="30" rows="10" placeholder="Alamat Lengkap" style="resize: none;" required></textarea>
                            </div>
                            {{-- -------------- --}}
                            {{-- <div class="col-12 mb-3">
                                <select class="w-100" name="provinsi" id="provinsi">
                                    @foreach($propinsi as $data)
                                        <option value="{{ $data->name }}">{{ $data->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12 mb-3">
                                <select class="w-100" name="kabkot" id="kabkot">
                                    @foreach($kabkot as $data)
                                        <option value="{{ $data->name }}">{{ $data->name }}</option>
                                    @endforeach
                                </select>
                            </div> --}}
                            <input type="hidden" name="berat" id="berat" value="{{ $berat }}" value="">
                            <input type="hidden" name="GetSubtotal" id="GetSubtotal" value="{{ $subtotal }}">
                            <input type="hidden" name="subtotal" id="subtotal" value="">
                            <input type="hidden" name="ongkir" id="ongkir" value="">
                            <!-- <div class="col-md-6 mb-3">
                                <input type="text" class="form-control" id="zipCode" placeholder="Zip Code" value="">
                            </div>
                            <div class="col-md-6 mb-3">
                                <input type="number" class="form-control" id="phone_number" min="0" placeholder="Phone No" value="">
                            </div> -->
                            {{-- <div class="col-12 mb-3">
                                <textarea name="pesan" class="form-control w-100" id="pesan" cols="30" rows="10" placeholder="Pesan (Opsi)"></textarea>
                            </div> --}}

                            <!-- <div class="col-12">
                                <div class="custom-control custom-checkbox d-block mb-2">
                                    <input type="checkbox" class="custom-control-input" id="customCheck2">
                                    <label class="custom-control-label" for="customCheck2">Create an accout</label>
                                </div>
                                <div class="custom-control custom-checkbox d-block">
                                    <input type="checkbox" class="custom-control-input" id="customCheck3">
                                    <label class="custom-control-label" for="customCheck3">Ship to a different address</label>
                                </div>
                            </div> -->
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-12 col-lg-4">
                <div class="cart-summary">
                    <h5>Cart Total</h5>
                    <ul class="summary-table">
                        <input type="hidden" id="cek" value="{{ $subtotal }}">
                        <li><span>subtotal:</span> <span>Rp{{ number_format($subtotal) }}</span></li>
                        <li><span>delivery:</span> <span>Rp<label id="harga-kirim"></label></span></li>
                        <li><span>total:</span> <span>Rp<label id="SetSubtotal">{{ number_format($subtotal) }}</label></span></li>
                    </ul>

                    <div class="payment-method">
                        <!-- Cash on delivery -->
                        {{-- <div class="custom-control custom-checkbox mr-sm-2">
                            <input type="checkbox" class="custom-control-input" id="cod" checked>
                            <label class="custom-control-label" for="cod">Cash on Delivery</label>
                        </div> --}}
                        <!-- Paypal -->
                        <div class="custom-control custom-checkbox mr-sm-2">
                            <input type="checkbox" class="custom-control-input" id="paypal" checked disabled>
                            <label class="custom-control-label" for="paypal">Paypal </label>
                            {{-- <img class="ml-15" src="{{ asset('assets/frontend/img/core-img/paypal.png') }}" alt=""> --}}
                        </div>
                    </div>

                    <div class="cart-btn mt-100">
                        <a href="#" class="btn amado-btn w-100" id="submitForm">Checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script
        {{-- src="https://code.jquery.com/jquery-3.3.1.min.js" --}}
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous"></script>
    <script src="{{ !config('services.midtrans.isProduction') ? 'https://app.sandbox.midtrans.com/snap/snap.js' : 'https://app.midtrans.com/snap/snap.js' }}" data-client-key="{{ config('services.midtrans.clientKey') }}"></script>
    <script type="text/javascript">
    $('ul[class="list"]').attr('style','width: 300px;height: 200px;overflow: auto;');
    $('#modal-dismiss').click(function() {
        $('#modal').hide();
    })

    $('select[name="provinsi_asal"],select[name="kota_asal"],select[name="provinsi_tujuan"],select[name="provinsi_asal"],#kurir').on('change',function(){
        $.ajax({
            data: $('#order').serialize(),
            url: '/test-submit',
            type: 'POST',
            dataType: 'json',
            success: function(berhasil) {
                // console.log(berhasil);
                $('#layanan').empty();
                $('#layanan').append(berhasil);
            }
        });
    });

    $('body').on('click','input:radio[name="pilih-layanan"]',function(){
        console.log('masuk layanan')
        var hargaKirim = $(this).val();
        $('#harga-kirim').empty();
        $('#harga-kirim').append(hargaKirim);
        $('#ongkir').empty();
        $('#ongkir').val(hargaKirim);
        var GetSubtotal = $('#GetSubtotal').val();
        $('#SetSubtotal').empty();
        $sub = parseInt(GetSubtotal);
        $hKirim = parseInt(hargaKirim);
        var total = $sub+$hKirim;
        $('#SetSubtotal').append(total);
        $('#subtotal').empty();
        $('#subtotal').val(total);
    });

    function submitForm() {
        // Kirim request ajax
        $.post("{{ route('order.store') }}",
        {
            _method: 'POST',
            _token: '{{ csrf_token() }}',
            subtotal: $('#subtotal').val(),
            nama_customer: $('#nama_customer').val(),
            phone_customer: $('#phone_customer').val(),
            email_customer: $('#email_customer').val(),
            provinsi_tujuan: $('#provinsi_tujuan').val(),
            kota_tujuan: $('#kota_tujuan').val(),
            alamat_customer: $('#alamat_customer').val(),
            id_orderdetail: $('#id_orderdetail').val(),
            ongkir: $('#ongkir').val(),
        },
        function (data, status) {
            snap.pay(data.snap_token, {
                // Optional
                onSuccess: function (result) {
                    window.location.href = "/dashboard";
                    // location.reload();
                },
                // Optional
                onPending: function (result) {
                    window.location.href = "/dashboard";
                    // location.reload();
                },
                // Optional
                onError: function (result) {
                    location.reload();
                }
            });
        });
        return false;
    }

    $('#submitForm').click(function(){
        if ($('#cek').val() == 0) {
            $('#alertgagal').append(
                `
                    <div class="alert alert-danger alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                        Anda tidak memiliki produk untuk di beli! Silahkan pilih produk terlebih dahulu!
                    </div>
                `
            )
        } else {
            submitForm();
        }
    })

    $('select[name="provinsi_asal"]').on('change', function(){
        let provinsiId = $(this).val();
        if(provinsiId){
            $.ajax({
                url: '/provinsi/'+provinsiId+'/kota',
                type: 'GET',
                dataType: 'json',
                success: function(data){
                    // $('ul[data-value="kota_asal"]').parents(".list").empty();
                    $('select[name="kota_asal"').empty();
                    $('li[data-value="kota_asal"]').closest('ul').empty().append('<li data-value="kota_asal" class="option selected disabled">--Kota Asal--</li>');
                    $.each(data, function(key,value){
                        $('li[data-value="kota_asal"]').after('<li data-value="'+key+'" class="option">'+value+'</li>');
                        $('#kota_asal').append('<option value="'+key+'">'+value+'</option>');
                    });
                }
            });
        }else{
            $('select[name="kota_asal"').empty();
            $('li[data-value="kota_asal"]').closest('ul').empty().append('<li data-value="kota_asal" class="option selected disabled">--Kota Asal--</li>');
        }
    });

    $('select[name="provinsi_tujuan"]').on('change', function(){
        let provinsiId = $(this).val();
        if(provinsiId){
            $.ajax({
                url: '/provinsi/'+provinsiId+'/kota',
                type: 'GET',
                dataType: 'json',
                success: function(data){
                    $('select[name="kota_tujuan"').empty();
                    $('li[data-value="kota_tujuan"]').closest('ul').empty().append('<li data-value="kota_tujuan" class="option selected disabled">--Kota Tujuan--</li>');
                    $.each(data, function(key,value){
                        $('li[data-value="kota_tujuan"]').after('<li data-value="'+key+'" class="option">'+value+'</li>');
                        $('#kota_tujuan').append('<option value="'+key+'">'+value+'</option>');
                    });
                }
            });
        }else{
            $('select[name="kota_tujuan"').empty();
            $('li[data-value="kota_tujuan"]').closest('ul').empty().append('<li data-value="kota_tujuan" class="option selected disabled">--Kota Tujuan--</li>');
        }
    });
    </script>
@endsection
