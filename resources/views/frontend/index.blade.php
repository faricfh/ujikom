@extends('layouts.frontend')

@section('content')
<div class="products-catagories-area clearfix">
    <div class="amado-pro-catagory clearfix">
        @php
            $produk = \App\Produk::take(9)->latest()->get();
        @endphp

        @foreach ($produk as $data)
            <!-- Single Catagory -->
            <div class="single-products-catagory clearfix">
                <a href="/produk/{{ $data->slug }}">
                    <img src="/assets/poto/{{ $data->foto }}" style="width:500px; height:400px">
                    <!-- Hover Content -->
                    <div class="hover-content">
                        <div class="line"></div>
                        <p>Rp. {{ number_format($data->harga) }}</p>
                        <h4>{{ $data->nama }}</h4>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
</div>
@endsection
