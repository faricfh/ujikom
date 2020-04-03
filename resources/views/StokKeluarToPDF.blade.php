<h1 align="center"><center>Laporan Stok Keluar</center></h1>
<br/>

<table border="1" width="100%" cellpadding="2" align="center">
	<tr style="background-color:yellow;">
		<th width="10%">No</th>
        <th width="40%">Tanggal</th>
        <th width="40%">Nama Produk</th>
        <th width="10%">Quantity</th>
	</tr>
    <?php $no = 1 ?>
	@foreach ($stokkeluar as $item)
    <tr>
        <td>{{ $no++ }}</td>
        <td>{{ $item->tgl }}</td>
        <td>{{ $item->produk->nama }}</td>
        <td>{{ number_format($item->qty,0,'','.') }}</td>
    </tr>
    @endforeach


</table>
<h3>Total Quantity : {{ $qtynya }}</h3>
<hr>
