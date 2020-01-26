@extends('layouts.backend')

@section('content')
<div class="content-wrapper">
<!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1>Customer</h1>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/admin">Home</a></li>
                <li class="breadcrumb-item active">Customer</li>
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
                <a class="btn btn-primary" href="javascript:void(0)" id="tambahdata">
                    Tambah Data
                </a>
                <br/>
                <br/>
                <table class="table table-bordered data-table" width="100%">
                <thead class="thead-dark">
                    <tr>
                        <th width="10px">No</th>
                        <th>Nama</th>
                        <th>E-mail</th>
                        <th>No Telp</th>
                        <th>Alamat</th>
                        <th>Status</th>
                        <th width="71px">Opsi</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
            </div>
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
</div>

<!-- {{-- modal mulai --}} -->
<div class="modal fade" id="modal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Bagian header modal-->
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data</h4>
                <button type="button" class="close" data-dismiss="modal">
                    <img src="{{ asset('assets/backend/open-iconic/svg/x.svg') }}">
                </button>
            </div>
            <!-- Akhir Bagian header modal-->
            <!-- Bagian Body Modal-->
            <div class="modal-body">
                <!-- Form-->
                <form id="form" name="form" class="form-horizontal">
                    <input type="hidden" name="customer_id" id="customer_id">
                    <div class="row">
                        <div class="col-lg-4">
                            <label for="name" class="control-label">Nama Customer</label>
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Customer" maxlength="50" autocomplete="off" required>
                            <p style="color: red;" id="error_name"></p>
                        </div>
                        <div class="col-lg-4">
                            <label for="name" class="control-label">Email</label>
                            <input type="text" class="form-control" id="email" name="email" placeholder="Email" maxlength="50" autocomplete="off" required>
                            <p style="color: red;" id="error_email"></p>
                        </div>
                        <div class="col-lg-4">
                            <label for="name" class="control-label">No Telepon</label>
                            <input type="text" class="form-control" id="no_tlp" name="no_tlp" placeholder="No Telepon" maxlength="50" autocomplete="off" required>
                            <p style="color: red;" id="error_no_telp"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-12">
                            <label for="name" class="control-label">Alamat</label>
                            <textarea name="alamat" id="alamat" class="form-control" cols="30" rows="5" style="resize: none;"></textarea>
                            <p style="color: red;" id="error_alamat"></p>
                        </div>
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
        ajax: "{{ url('admin/customer') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'nama', name: 'nama'},
            {data: 'email', name: 'email'},
            {data: 'no_tlp', name: 'no_tlp'},
            {data: 'alamat', name: 'alamat'},
            {data: 'status', name: 'status'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });

    $('#tambahdata').click(function () {
        $('#customer_id').val('');
        $('#form').trigger("reset");
        $('#modal').modal({backdrop: 'static', keyboard: false});
        $('#modal').modal('show');
    });

    $('body').on('click','.edit',function(){
        var idCustomer = $(this).data('id');
        $.get("{{ url('admin/customer') }}"+"/"+idCustomer+"/edit", function(data){
            console.log(data);
            $('#modal').modal({backdrop: 'static', keyboard: false});
            $('#modal').modal('show');
            $('#customer_id').val(data.id);
            $('#nama').val(data.nama);
            $('#email').val(data.email);
            $('#no_tlp').val(data.no_tlp);
            $('#alamat').val(data.alamat);

        });
    });

    $('body').on('click','.hapus', function(){
        var idCustomer = $(this).data('id');
        $.ajax({
            type: "DELETE",
            url: "{{ url('admin/customer-destroy') }}"+"/"+idCustomer,
            success: function(data){
                table.draw();
            },
            error: function(request, status, error) {
                console.log(error);
            }
        });
    });

    $('#simpan').click(function (e) {
        e.preventDefault();
        // $(this).hide();
        $.ajax({
            data: $('#form').serialize(),
            url: "{{ url('admin/customer-store') }}",
            type: "POST",
            dataType: 'json',
            success: function (data) {
                $('#form').trigger("reset");
                $('#modal').modal('hide');
                table.draw();
                Swal.fire({
                    icon: 'success',
                    title: 'Your work has been saved',
                    showConfirmButton: false,
                    timer: 1000
                });
            },

            error: function (request, status, error) {
                console.log(error);
            }
        });
    });
});

</script>
@endsection
