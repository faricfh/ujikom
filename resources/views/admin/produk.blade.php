@extends('layouts.backend')

@section('content')
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Produk</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/admin">Home</a></li>
              <li class="breadcrumb-item active">Produk</li>
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
                  <th>Foto</th>
                  <th>Nama</th>
                  <th>Slug</th>
                  <th>Kategori</th>
                  <th>Harga</th>
                  <th>Jumlah</th>
                  <th>Stok</th>
                  <th width="69px">Opsi</th>
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


{{-- modal mulai --}}
<div class="modal fade" id="modal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Bagian header modal-->
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data</h4>
                <button type="button" class="close" data-dismiss="modal">
                    <ion-icon name="close-circle"></ion-icon>
                </button>
            </div>
            <!-- Akhir Bagian header modal-->
            <!-- Bagian Body Modal-->
            <div class="modal-body">
                <!-- Form-->
                <form id="form" name="form" class="form-horizontal">
                    <input type="hidden" name="produk_id" id="produk_id">
                    <div class="form-group">
                        <div class="col-md-6">
                            <label for="name" class="control-label">Nama Produk</label>
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Produk" maxlength="50" autocomplete="off" required>
                            <p style="color: red;" id="error_nama"></p>
                        </div>
                        <div class="col-md-6">
                            <label for="name" class="control-label">Kategori</label>
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Kategori" maxlength="50" autocomplete="off" required>
                            <p style="color: red;" id="error_nama"></p>
                        </div>
                    </div>
                </form>
                <!-- Akhir Form-->
            </div>
            <!-- modal footer-->
            <div class="modal-footer">
                <button data-dismiss="modal" type="button" class="btn btn-danger pull-left"
                id="reset">Batal</button>

                <button align="right" type="submit" class="btn btn-primary" id="simpan"
                value="create">Simpan</button>
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
        ajax: "{{ url('admin/produk') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'foto', name: 'foto'},
            {data: 'nama', name: 'nama'},
            {data: 'slug', name: 'slug'},
            {data: 'kategori.nama', name: 'id_kategori'},
            {data: 'harga', name: 'harga'},
            {data: 'jmlh', name: 'jmlh'},
            {data: 'stok', name: 'stok'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });

    $('#tambahdata').click(function () {
        $('#produk_id').val('');
        $('#form').trigger("reset");
        $('#modal').modal({backdrop: 'static', keyboard: false});
        $('#modal').modal('show');
    });

    // $.ajax({
    //     url: "{{ url('detail-pemakaian-resep') }}",
    //     method: "GET",
    //     dataType: "json",
    //     success: function (berhasil) {
    //         $.each(berhasil, function (key, value) {
    //             $('#id_resep_'+no+'').append(
    //                 `
    //                 <option value="${value.id}">
    //                     ${value.nama}
    //                 </option>
    //                 `
    //             )
    //         })
    //     },
    //     error: function () {
    //         console.log('data tidak ada');
    //     }
    // });
});

</script>
@endsection
