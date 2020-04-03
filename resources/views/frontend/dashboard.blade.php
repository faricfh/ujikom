@extends('layouts.frontend')

@section('content')
<div class="cart-table-area section-padding-100">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-lg-12">
                <div class="cart-title mt-50">
                    <h2>Dashboard</h2>
                </div>
                <div class="row">
                    <div class="col-6 col-lg-4">
                        <div class="cart-summary" style="margin-top:unset;">
                            <h5>Profile</h5>
                            <div style="width:80px; height: 3px; background-color:#fbb710; margin-bottom:15px; display:block;"></div>
                            <ul class="summary-table">
                                @foreach ($customer as $data)
                                    <li><span>Nama       : {{ $data->nama }}</li>
                                    <li><span>Email      : {{ $data->email }}</li>
                                    <li><span>No Telepon : {{ $data->no_tlp }}</li>
                                    <li><span>Alamat     : {{ $data->alamat }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="col-6 col-lg-8">
                        <div class="cart-summary" style="margin-top:unset;">
                            <h5>Orderan</h5>
                            <div style="width:80px; height: 3px; background-color:#fbb710; margin-bottom:15px; display:block;"></div>
                            <div class="row">
                                @foreach ($order as $data)
                                <ul class="summary-table">
                                    <div class="col-3 col-lg-3">
                                        <div class="cart-summary" style="margin-top:unset; width:260px; background-color:azure; box-shadow: 5px 5px;">
                                            <div style="width:80px; height: 3px; background-color:#fbb710; margin-bottom:15px; display:block;"></div>
                                            <li><span>Produk       :
                                                @foreach ($data->orderdetail as $item)
                                                <ul>-{{ $item->produk->nama }}<b> &nbsp; x{{ $item->qty }}</b></ul>
                                                @endforeach
                                            </li>
                                            <li><span>Subtotal     : {{ $data->subtotal }}</li>
                                            <li><span>Status       : {{ $data->status }}</li>
                                        </div>
                                    </div>
                                </ul>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
