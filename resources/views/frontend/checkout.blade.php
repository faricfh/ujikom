@extends('layouts.frontend')

@section('content')
<?php
$propinsi = \App\Provinsi::all();
$kabkot = \App\KabupatenKota::all();

?>
<div class="cart-table-area section-padding-100">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-lg-8">
                <div class="checkout_details_area mt-50 clearfix">

                    <div class="cart-title">
                        <h2>Checkout</h2>
                    </div>

                    <form id="order">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <input type="text" name="nama_customer" class="form-control" id="nama_customer" value="" placeholder="Nama Lengkap" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <input type="text" name="phone_customer" class="form-control" id="phone_customer" placeholder="No Telepon" value="" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <input type="email" name="email_customer" class="form-control" id="email_customer" placeholder="Email" value="" required>
                            </div>
                            <div class="col-12 mb-3">
                                <textarea name="alamat_customer" id="alamat_customer" class="form-control" cols="30" rows="10" placeholder="Alamat" style="resize: none;" required></textarea>
                            </div>
                            <div class="col-12 mb-3">
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
                            </div>
                            <input type="hidden" name="subtotal" id="subtotal" value="{{ $subtotal }}">
                            <!-- <div class="col-md-6 mb-3">
                                <input type="text" class="form-control" id="zipCode" placeholder="Zip Code" value="">
                            </div>
                            <div class="col-md-6 mb-3">
                                <input type="number" class="form-control" id="phone_number" min="0" placeholder="Phone No" value="">
                            </div> -->
                            <div class="col-12 mb-3">
                                <textarea name="pesan" class="form-control w-100" id="pesan" cols="30" rows="10" placeholder="Leave a comment about your order"></textarea>
                            </div>

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
                        <li><span>subtotal:</span> <span>Rp{{ number_format($subtotal) }}</span></li>
                        <li><span>delivery:</span> <span>Free</span></li>
                        <li><span>total:</span> <span>Rp{{ number_format($subtotal) }}</span></li>
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
        src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous"></script>
    <script src="{{ !config('services.midtrans.isProduction') ? 'https://app.sandbox.midtrans.com/snap/snap.js' : 'https://app.midtrans.com/snap/snap.js' }}" data-client-key="{{ config('services.midtrans.clientKey') }}"></script>
    <script>
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
            alamat_customer: $('#alamat_customer').val(),
        },
        function (data, status) {
            snap.pay(data.snap_token, {
                // Optional
                onSuccess: function (result) {
                    location.reload();
                },
                // Optional
                onPending: function (result) {
                    location.reload();
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
        submitForm();
    })
    </script>
@endsection
