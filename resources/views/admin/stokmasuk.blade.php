@extends('layouts.backend')

@section('content')
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Stok Masuk</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/admin">Home</a></li>
              <li class="breadcrumb-item active">Stok Masuk</li>
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
                  <th>Tanggal</th>
                  <th>Produk</th>
                  <th>Quantity</th>
                  <th width="71px">Opsi</th>
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
    <div class="modal-dialog modal-lg">
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
                <form id="form" name="form" class="form-horizontal" enctype="multipart/form-data">
                    <input type="hidden" name="stokmasuk_id" id="stokmasuk_id">
                    <div class="row">
                        <div class="col-sm-4">
                            <label for="name" class="control-label">Tanggal</label>
                            <input type="date" name="tgl" id="tgl" class="form-control" required>
                            <span style="color: red;" id="error_tgl"></span>
                            <br>
                        </div>
                        <div class="col-sm-4">
                            <label for="name" class="control-label">Produk</label>
                            <select name="id_produk" id="id_produk" class="select2 select2-selection--single">
                              <option></option>
                            </select>
                            <span style="color: red;" id="error_produk"></span>
                            <br>
                        </div>
                        <div class="col-sm-4">
                            <label for="name" class="control-label">Quantity</label>
                            <input type="text" class="form-control" id="qty" name="qty" placeholder="Quantity" autocomplete="off" required>
                            <span style="color: red;" id="error_qty"></span>
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
$('.select2').select2({
    placeholder: "Pilih Produk",
    allowClear: true
});
</script>
<script>
$('#modal').on('hidden.bs.modal',function(){
    $('#error_tgl').css('display','none');
    $('#error_produk').css('display','none');
    $('#error_qty').css('display','none');
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
        ajax: "{{ url('admin/stokmasuk') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'tgl', name: 'tgl'},
            {data: 'produk.nama', name: 'id_produk'},
            {data: 'qty', name: 'qty'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });

    $('#tambahdata').click(function () {
        $('.modal-title').html('Tambah Data');
        $('#form').trigger("reset");
        $('#id_produk').trigger("reset");
        $('#stokmasuk_id').val('');
        $('#modal').modal({backdrop: 'static', keyboard: false});
        $('#modal').modal('show');
        $('#tgl').on('change',function(){
            $('#error_tgl').css('display','none');
        });
        $('#id_produk').on('change',function(){
            $('#error_produk').css('display','none');
        });
        $('#qty').keypress(function(){
            $('#error_qty').css('display','none');
        });
    });

    $('body').on('click','.edit',function(){
        var idStok = $(this).data('id');
        $.get("{{ url('admin/stokmasuk') }}"+"/"+idStok+"/edit", function(data){
            // console.log(data);
            $('.modal-title').html('Edit Data');
            $('#modal').modal({backdrop: 'static', keyboard: false});
            $('#modal').modal('show');
            $('#stokmasuk_id').val(data.stokmasuk.id);
            $('#tgl').val(data.stokmasuk.tgl);
            $('#id_produk').html('');
            $('#id_produk').html(data.produk);
            $('#qty').val(data.stokmasuk.qty);
            $('#tgl').on('change',function(){
                $('#error_tgl').css('display','none');
            });
            $('#id_produk').on('change',function(){
                $('#error_produk').css('display','none');
            });
            $('#qty').keypress(function(){
                $('#error_qty').css('display','none');
            });
        });
    });

    $('body').on('click','.hapus', function(){
        var idStok = $(this).data('id');
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "DELETE",
                    url: "{{ url('admin/stokmasuk-destroy') }}"+"/"+idStok,
                    success: function(data){
                        table.draw();
                    },
                    error: function(request, status, error) {
                        console.log(error);
                    }
                });
                Swal.fire({
                    title: 'Deleted!',
                    text: 'Your file has been deleted.',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 1000
                })
            }
        })
    });

    //KETIKA BUTTON SAVE DI KLIK
    $('#simpan').click(function (e) {
        e.preventDefault();
        // $(this).hide();
        var formdata = new FormData($('#form')[0]);
        $.ajax({
            data: formdata,
            url: "{{ url('admin/stokmasuk-store') }}",
            type: "POST",
            cache:false,
            contentType: false,
            processData: false,
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
                $('#error_tgl').empty().show();
                $('#error_produk').empty().show();
                $('#error_qty').empty().show();
                json = $.parseJSON(request.responseText);
                $('#error_tgl').html(json.errors.tgl);
                $('#error_produk').html(json.errors.id_produk);
                $('#error_qty').html(json.errors.qty);
            }
        });
    });

    $.ajax({
        url: "{{ url('admin/produk') }}",
        method: "GET",
        dataType: "json",
        success: function (berhasil) {
            $.each(berhasil.data, function (key, value) {
                $('#id_produk').append(
                    `
                    <option value="${value.id}">
                        ${value.nama}
                    </option>
                    `
                )
            })
        },
        error: function () {
            console.log('data tidak ada');
        }
    });
});

</script>
@endsection
