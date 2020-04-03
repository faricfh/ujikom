<?php

namespace App\Http\Controllers;

use App\Produk;
use Illuminate\Http\Request;
use App\StokMasuk;
use DataTables;
use DB;
use PDF;

class StokmasukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = StokMasuk::with('produk')->latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-warning btn-sm edit"><i class="nav-icon fas fa-pen" style="color:white"></i></a>';
                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm hapus"><i class="nav-icon fas fa-trash" style="width:15px"></i></a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.stokmasuk');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'tgl' => 'required',
                'id_produk' => 'required',
                'qty' => 'required'
            ],
            [
                'tgl.required' => 'Tanggal harus diisi',
                'id_produk.required' => 'Produk harus dipilih',
                'qty.required' => 'Jumlah harus diisi'
            ]
        );

        DB::transaction(function () use ($request) {

            $stokproduk = '';
            $getdataproduk = \DB::select('SELECT stok FROM produks WHERE id = ' . $request->id_produk . '');
            foreach ($getdataproduk as $value) {
                $stokproduk .= $value->stok;
            }

            if (isset($request->stokmasuk_id)) {

                $produkStokMasuk = '';
                $getdatastokmasuk = \DB::select('SELECT stokmasuk.qty,stokmasuk.id_produk,produk.stok
                                                FROM stok_masuks AS stokmasuk
                                                LEFT JOIN produks AS produk ON produk.id = stokmasuk.id_produk
                                                WHERE stokmasuk.id = ' . $request->stokmasuk_id . '');
                foreach ($getdatastokmasuk as $value) {
                    $produkStokMasuk .= $value->id_produk;
                }

                if ($request->id_produk == $produkStokMasuk) {
                    $data = '';
                    $getdata = \DB::select('select qty from stok_masuks where id =' . $request->stokmasuk_id . '');
                    foreach ($getdata as $key) {
                        $data .= $key->qty;
                    }
                    //
                    $old_qty = $data;
                    $qty = $request->qty;

                    if ($qty < $old_qty) {
                        $new_qty = $old_qty - $qty;
                        $stok = $stokproduk - $new_qty;
                        Produk::updateOrCreate(
                            ['id' => $request->id_produk],
                            ['stok' => $stok]
                        );
                    } elseif ($qty > $old_qty) {

                        $new_qty = $qty - $old_qty;
                        $stok = $stokproduk + $new_qty;
                        Produk::updateOrCreate(
                            ['id' => $request->id_produk],
                            ['stok' => $stok]
                        );
                    } else {
                        Produk::updateOrCreate(
                            ['id' => $request->id_produk],
                            ['stok' => $stokproduk]
                        );
                    }
                } else {
                    foreach ($getdatastokmasuk as $value) {
                        $stok = $value->stok - $value->qty;
                        Produk::updateOrCreate(
                            ['id' => $value->id_produk],
                            ['stok' => $stok]
                        );

                        $stok2 = $stokproduk + $request->qty;
                        Produk::updateOrCreate(
                            ['id' => $request->id_produk],
                            ['stok' => $stok2]
                        );
                    }
                }
            } else {
                $stok = $stokproduk + $request->qty;
                Produk::updateOrCreate(
                    ['id' => $request->id_produk],
                    ['stok' => $stok]
                );
            }

            StokMasuk::updateOrCreate(
                ['id' => $request->stokmasuk_id],
                [
                    'tgl' => $request->tgl,
                    'id_produk' => $request->id_produk,
                    'qty' => $request->qty
                ]
            );
        });

        return response()->json(['success' => 'Berhasil di Simpan']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $stokmasuk = StokMasuk::find($id);
        $produk = \DB::select('SELECT id,nama FROM produks');
        foreach ($produk as $value) {
            $data[] = '<option value="' . $value->id . '" ' . ($value->id == $stokmasuk->id_produk ? 'selected' : '') . '>' . $value->nama . '</option>';
        }

        $option = implode('', $data);

        return response()->json(['stokmasuk' => $stokmasuk, 'produk' => $option]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        StokMasuk::find($id)->delete();
        return response()->json(['success' => 'Berhasil Dihapus']);
    }

    public function HtmlToPDF()
    {
        // dd($id);
        $stokmasuk = StokMasuk::with('produk')->orderBy('tgl', 'asc')->get();
        $qty = 0;
        foreach ($stokmasuk as $data) {
            $qty += $data->qty;
        }
        $qtynya = number_format($qty, 0, '', '.');
        // dd($harganya);
        $view = \View::make('StokMasukToPDF', compact('stokmasuk', 'qtynya'));
        $html_content = $view->render();

        PDF::SetTitle('Laporan Stok Masuk');
        PDF::AddPage();
        PDF::writeHTML($html_content, true, false, true, false, '');

        PDF::Output('StokMasuk.pdf', 'I');
    }
}
