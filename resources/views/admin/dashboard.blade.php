@extends('layouts.backend')

@section('content')
<div class="content-wrapper">
    <div class="row" style="margin-left:1%; margin-top:1%; margin-right:1%">
        <div class="col-lg-3 col-6">
        <!-- small card -->
        <div class="small-box bg-info">
            <div class="inner">
            <h3>?</h3>

            <p>Orders</p>
            </div>
            <div class="icon">
            <i class="fas fa-shopping-cart"></i>
            </div>
            <a href="{{ url('admin/order') }}" class="small-box-footer">
            More info <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
        <!-- small card -->
        <div class="small-box bg-success">
            <div class="inner">
            <h3>{{ $produk }}<sup style="font-size: 20px"></sup></h3>

            <p>Produk</p>
            </div>
            <div class="icon">
            <i class="ion ion-stats-bars"></i>
            </div>
            <a href="{{ url('admin/produk') }}" class="small-box-footer">
            More info <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
        <!-- small card -->
        <div class="small-box bg-warning">
            <div class="inner">
            <h3>{{ $user }}</h3>

            <p>User Registrations</p>
            </div>
            <div class="icon">
            <i class="fas fa-user-plus"></i>
            </div>
            <a href="{{ url('admin/user') }}" class="small-box-footer">
            More info <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
        <!-- small card -->
        <div class="small-box bg-danger">
            <div class="inner">
            <h3>{{ $kategori }}</h3>

            <p>Kategori</p>
            </div>
            <div class="icon">
            <i class="fas fa-chart-pie"></i>
            </div>
            <a href="{{ url('admin/kategori') }}" class="small-box-footer">
            More info <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
        </div>
        <!-- ./col -->
    </div>
</div>
@endsection
