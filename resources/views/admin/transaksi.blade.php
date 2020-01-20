@extends('layouts.backend')

@section('content')
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Transaksi</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/admin">Home</a></li>
              <li class="breadcrumb-item active">Transaksi</li>
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
            <a class="btn btn-primary" href="javascript:void(0)" id="buatbaru">
            Tambah Data
          </a>
          <br/>
          <br/>
          <table class="table table-bordered data-table" width="100%">
          <thead class="thead-dark">
              <tr>
                  <th width="10px">No</th>
                  <th>Order</th>
                  <th>User</th>
                  <th>Tanggal</th>
                  <th>Jumlah</th>
                  <th width="120px">Opsi</th>
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
        ajax: "{{ url('admin/transaksi') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'order.tgl', name: 'id_order'},
            {data: 'user.name', name: 'id_user'},
            {data: 'tgl', name: 'tgl'},
            {data: 'jmlh', name: 'id_jmlh'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
});

</script>
@endsection
