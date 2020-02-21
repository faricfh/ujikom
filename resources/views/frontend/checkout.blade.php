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

                    <form action="#" method="post">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <input type="text" name="nama" class="form-control" id="nama" value="" placeholder="Nama Lengkap" required>
                            </div>                            
                            <div class="col-md-6 mb-3">
                                <input type="text" name="phone_number" class="form-control" id="no_tlp" placeholder="No Telepon" value="" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <input type="email" name="email" class="form-control" id="email" placeholder="Email" value="" required> 
                            </div>
                            <div class="col-12 mb-3">
                                <textarea name="alamat" id="alamat" class="form-control" cols="30" rows="10" placeholder="Alamat" style="resize: none;" required></textarea>
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
                            <!-- <div class="col-md-6 mb-3">
                                <input type="text" class="form-control" id="zipCode" placeholder="Zip Code" value="">
                            </div>
                            <div class="col-md-6 mb-3">
                                <input type="number" class="form-control" id="phone_number" min="0" placeholder="Phone No" value="">
                            </div> -->
                            <div class="col-12 mb-3">
                                <textarea name="comment" class="form-control w-100" id="comment" cols="30" rows="10" placeholder="Leave a comment about your order"></textarea>
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
                        <div class="custom-control custom-checkbox mr-sm-2">
                            <input type="checkbox" class="custom-control-input" id="cod" checked>
                            <label class="custom-control-label" for="cod">Cash on Delivery</label>
                        </div>
                        <!-- Paypal -->
                        <div class="custom-control custom-checkbox mr-sm-2">
                            <input type="checkbox" class="custom-control-input" id="paypal">
                            <label class="custom-control-label" for="paypal">Paypal <img class="ml-15" src="{{ asset('assets/frontend/img/core-img/paypal.png') }}" alt=""></label>
                        </div>
                    </div>

                    <div class="cart-btn mt-100">
                        <a href="#" class="btn amado-btn w-100">Checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
