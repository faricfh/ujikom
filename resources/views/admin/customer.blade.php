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
                    <input type="hidden" name="customer_id" id="customer_id">
                    <div class="row">
                        <div class="col-lg-6">
                            <label for="name" class="control-label">Nama Customer</label>
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Customer" maxlength="50" autocomplete="off" required>
                            <span style="color: red;" id="error_nama"></span>
                            <br>
                        </div>
                        <div class="col-lg-6">
                            <label for="name" class="control-label">No Telepon</label>
                            <input type="text" class="form-control" id="no_tlp" name="no_tlp" placeholder="No Telepon" maxlength="50" autocomplete="off" required>
                            <span style="color: red;" id="error_no_tlp"></span>
                            <br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <label for="name" class="control-label">Email</label>
                            <input type="text" class="form-control" id="email" name="email" placeholder="Email" maxlength="50" autocomplete="off" required>
                            <span style="color: red;" id="error_email"></span>
                            <br>
                        </div>
                        <div class="col-lg-6">
                            <label for="name" class="control-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" maxlength="50" autocomplete="off" required>
                            <span style="color: red;" id="error_password"></span>
                            <br>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-12">
                            <label for="name" class="control-label">Alamat</label>
                            <textarea name="alamat" id="alamat" class="form-control" cols="30" rows="5" style="resize: none;"></textarea>
                            <span style="color: red;" id="error_alamat"></span>
                            <br>
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
<script>
$('#modal').on('hidden.bs.modal',function(){
    $('#error_nama').css('display','none');
    $('#error_email').css('display','none');
    $('#error_no_tlp').css('display','none');
    $('#error_alamat').css('display','none');
    $('#error_password').css('display','none');

    $('#nama').removeClass('is-invalid');
    $('#email').removeClass('is-invalid');
    $('#no_tlp').removeClass('is-invalid');
    $('#alamat').removeClass('is-invalid');
    $('#password').removeClass('is-invalid');
})
</script>
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
        $('.modal-title').html('Tambah Data');
        $('#customer_id').val('');
        $('#form').trigger("reset");
        $('#modal').modal({backdrop: 'static', keyboard: false});
        $('#modal').modal('show');
        $('#nama').keypress(function(){
            $('#error_nama').css('display','none');
            $('#nama').removeClass('is-invalid');
        });
        $('#email').keypress(function(){
            $('#error_email').css('display','none');
            $('#email').removeClass('is-invalid');
        });
        $('#no_tlp').keypress(function(){
            $('#error_no_tlp').css('display','none');
            $('#no_tlp').removeClass('is-invalid');
        });
        $('#alamat').keypress(function(){
            $('#error_alamat').css('display','none');
            $('#alamat').removeClass('is-invalid');
        });
        $('#password').keypress(function(){
            $('#error_password').css('display','none');
            $('#password').removeClass('is-invalid');
        });
    });

    $('body').on('click','.edit',function(){
        var idCustomer = $(this).data('id');
        $.get("{{ url('admin/customer') }}"+"/"+idCustomer+"/edit", function(data){
            $('.modal-title').html('Edit Data');
            $('#modal').modal({backdrop: 'static', keyboard: false});
            $('#modal').modal('show');
            $('#customer_id').val(data.id);
            $('#nama').val(data.nama);
            $('#email').val(data.email);
            $('#no_tlp').val(data.no_tlp);
            $('#alamat').val(data.alamat);
            $('#nama').keypress(function(){
                $('#error_nama').css('display','none');
                $('#nama').removeClass('is-invalid');
            });
            $('#email').keypress(function(){
                $('#error_email').css('display','none');
                $('#email').removeClass('is-invalid');
            });
            $('#no_tlp').keypress(function(){
                $('#error_no_tlp').css('display','none');
                $('#no_tlp').removeClass('is-invalid');
            });
            $('#alamat').keypress(function(){
                $('#error_alamat').css('display','none');
                $('#alamat').removeClass('is-invalid');
            });
            $('#password').keypress(function(){
                $('#error_password').css('display','none');
                $('#password').removeClass('is-invalid');
            });
        });
    });

    $('body').on('click','.hapus', function(){
        var idCustomer = $(this).data('id');
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
                    url: "{{ url('admin/customer-destroy') }}"+"/"+idCustomer,
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
                    title: data.success,
                    showConfirmButton: false,
                    timer: 1000
                });
            },

            error: function (request, status, error) {
                $('#error_nama').empty().show();
                $('#error_email').empty().show();
                $('#error_no_tlp').empty().show();
                $('#error_alamat').empty().show();
                $('#error_password').empty().show();
                json = $.parseJSON(request.responseText);
                if(json.errors.nama != null){
                    $('#nama').addClass('is-invalid')
                }
                if(json.errors.email != null){
                    $('#email').addClass('is-invalid')
                }
                if(json.errors.no_tlp != null){
                    $('#no_tlp').addClass('is-invalid')
                }
                if(json.errors.alamat != null){
                    $('#alamat').addClass('is-invalid')
                }
                if(json.errors.password != null){
                    $('#password').addClass('is-invalid')
                }
                $('#error_nama').html(json.errors.nama);
                $('#error_email').html(json.errors.email);
                $('#error_no_tlp').html(json.errors.no_tlp);
                $('#error_alamat').html(json.errors.alamat);
                $('#error_password').html(json.errors.password);
            }
        });
    });
});

</script>
@endsection
