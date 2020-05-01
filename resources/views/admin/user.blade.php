@extends('layouts.backend')

@section('content')
<div class="content-wrapper">
<!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1>User</h1>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/admin">Home</a></li>
                <li class="breadcrumb-item active">User</li>
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
                        <th>Username</th>
                        <th>E-mail</th>
                        <th width="30px">Opsi</th>
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
    <div class="modal-dialog modal-sm">
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
                    <input type="hidden" name="user_id" id="user_id">
                    <div class="form-group">
                        <div class="col-lg-12">
                            <label for="name" class="control-label">Nama User</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Nama User" maxlength="50" autocomplete="off" required>
                            <span style="color: red;" id="error_name"></span>
                            <br>
                        </div>
                        <div class="col-lg-12">
                            <label for="name" class="control-label">Email</label>
                            <input type="text" class="form-control" id="email" name="email" placeholder="Email" maxlength="50" autocomplete="off" required>
                            <span style="color: red;" id="error_email"></span>
                            <br>
                        </div>
                        <div class="col-lg-12">
                            <label for="name" class="control-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" maxlength="50" autocomplete="off" required>
                            <span style="color: red;" id="error_password"></span>
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
    $('#error_name').css('display','none');
    $('#error_email').css('display','none');
    $('#error_password').css('display','none');
    $('#name').removeClass('is-invalid');
    $('#email').removeClass('is-invalid');
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
        ajax: "{{ url('admin/user') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });

    $('#tambahdata').click(function () {
        $('.modal-title').html('Tambah Data');
        $('#user_id').val('');
        $('#form').trigger("reset");
        $('#modal').modal({backdrop: 'static', keyboard: false});
        $('#modal').modal('show');
        $('#name').keypress(function(){
            $('#error_name').css('display','none');
            $('#name').removeClass('is-invalid');
        });
        $('#email').keypress(function(){
            $('#error_email').css('display','none');
            $('#email').removeClass('is-invalid');
        });
        $('#password').keypress(function(){
            $('#error_password').css('display','none');
            $('#password').removeClass('is-invalid');
        });
    });

    $('body').on('click','.hapus', function(){
        var idUser = $(this).data('id');
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
                    url: "{{ url('admin/user-destroy') }}"+"/"+idUser,
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
            url: "{{ url('admin/user-store') }}",
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
                $('#error_name').empty().show();
                $('#error_email').empty().show();
                $('#error_password').empty().show();
                json = $.parseJSON(request.responseText);
                if(json.errors.name != null){
                    $('#name').addClass('is-invalid');
                }
                if(json.errors.email != null){
                    $('#email').addClass('is-invalid');
                }
                if(json.errors.password != null){
                    $('#password').addClass('is-invalid');
                }
                $('#error_name').html(json.errors.name);
                $('#error_email').html(json.errors.email);
                $('#error_password').html(json.errors.password);
            }
        });
    });
});

</script>
@endsection
