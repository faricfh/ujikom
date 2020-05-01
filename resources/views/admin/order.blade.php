@extends('layouts.backend')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1>Order</h1>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/admin">Home</a></li>
                <li class="breadcrumb-item active">Order</li>
            </ol>
            </div>
        </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
        <div class="card-body">
            <!-- <a class="btn btn-primary" href="javascript:void(0)" id="buatbaru">
            Tambah Data
            </a> -->
            <br/>
            <br/>
            <table class="table table-striped data-table" width="100%">
            <thead>
                <tr>
                    <th width="10px">No</th>
                    <th>Nama Customer</th>
                    <th>Provinsi</th>
                    <th>Kota</th>
                    <th>Alamat</th>
                    <th>Subtotal</th>
                    <th>Status</th>
                    <th width="90px">Opsi</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </div>
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
</div>

<!-- {{-- modal mulai --}} -->
<div class="modal fade" id="modal" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <!-- Bagian header modal-->
            <div class="modal-header">
                <h4 class="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal">
                    <img src="{{ asset('assets/backend/open-iconic/svg/x.svg') }}">
                </button>
            </div>
            <!-- Akhir Bagian header modal-->
            <!-- Bagian Body Modal-->
            <div class="modal-body">
                <!-- Form-->
                <form id="form" name="form" class="form-horizontal">
                    <input type="hidden" name="order_id" id="order_id">
                     <div id="form-edit">
                        <div class="form-group">
                            <div class="col-lg-12">
                                <label for="name" class="control-label">Nama Kategori</label>
                                <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Kategori" maxlength="50" autocomplete="off" required>
                                <span style="color: red;" id="error_nama"></span>
                                <br>
                            </div>
                        </div>
                    </div>
                    <div id="form-show">
                        <div class="form-group">
                            <div class="row">Customer      :&nbsp; <p id="show-nama"></p></div>
                            <div class="row">No Hp         :&nbsp; <p id="show-noTlp"></p></div>
                            <div class="row">Provinsi      :&nbsp; <p id="show-provinsi"></p></div>
                            <div class="row">Kota          :&nbsp; <p id="show-kota"></p></div>
                            <div class="row">Alamat        :&nbsp; <p id="show-alamat"></p></div>
                            <div class="row">Subtotal      :&nbsp; <p id="show-subtotal"></p></div>
                            <div class="row">Status        :&nbsp; <p id="show-status"></p></div>
                            -----------------------------------------------------------------------<br>
                            Daftar Produk :
                            <p id="show-produk"></p>
                        </p>
                    </div>
                </form>
                <!-- Akhir Form-->
            </div>
            <!-- modal footer-->
            <div class="modal-footer">
                <button data-dismiss="modal" type="button" class="btn btn-danger pull-left"
                id="reset">Batal</button>

                <button align="right" type="submit" class="btn btn-primary" id="simpan">Simpan</button>
            </div>
            <!-- Akhir modal footer-->
        </div>
    </div>
</div>
<!-- modal berakhir -->
@endsection

@section('js')
<script type="text/javascript">

    $(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

      //INDEX TABEL
    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ url('admin/order') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'nama_customer', name: 'nama_customer'},
            {data: 'provinsi', name: 'provinsi'},
            {data: 'kota', name: 'kota'},
            {data: 'alamat_customer', name: 'alamat_customer'},
            {data: 'subtotal', name: 'subtotal'},
            {data: 'status', name: 'status'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });

    $('body').on('click','.show',function(){
        var idOrder = $(this).data('id');
        $.get("{{ url('admin/order') }}"+"/"+idOrder+"/show", function(data){
            $('.modal-title').html('Lihat Data');
            $('#modal').modal({backdrop: 'static', keyboard: false});
            $('#modal').modal('show');
            $('#form-edit').css('display','none');
            $('.modal-footer').css('display','none');
            $('#show-nama').html(data.order.nama_customer);
            $('#show-noTlp').html(data.order.phone_customer);
            $('#show-alamat').html(data.order.alamat_customer);
            $('#show-subtotal').html(data.order.subtotal);
            $('#show-provinsi').html(data.order.provinsi);
            $('#show-kota').html(data.order.kota);
            $('#show-status').html(data.order.status);
            $.each(data.order_detail,function(key,value){
                console.log(value);
                $('#show-produk').append('+'+value.produk.nama+' <b>x'+value.qty+'</b><br>');
            });
        });
    });

    $('body').on('click','.hapus', function(){
        var idOrder = $(this).data('id');
        Swal.fire({
            title: 'Apakah kamu yakin ingin menghapus ini?',
            // text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: 'Tidak'
            }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "DELETE",
                    url: "{{ url('admin/order-destroy') }}"+"/"+idOrder,
                    success: function(data){
                        table.draw();
                    },
                    error: function(request, status, error) {
                        console.log(error);
                    }
                });
                Swal.fire({
                    title: 'Terhapus!',
                    text: 'Berhasil dihapus',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 1000
                })
            }
        })
    });
});

</script>
@endsection
