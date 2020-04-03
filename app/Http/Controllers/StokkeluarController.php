<?php

namespace App\Http\Controllers;

use App\Produk;
use Illuminate\Http\Request;
use App\StokKeluar;
use DataTables;
use DB;
use PDF;

class StokkeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = StokKeluar::with('produk')->latest()->get();
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
        return view('admin.stokkeluar');
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

        StokKeluar::updateOrCreate(
            ['id' => $request->stokkeluar_id],
            [
                'tgl' => $request->tgl,
                'id_produk' => $request->id_produk,
                'qty' => $request->qty
            ]
        );

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
        $stokkeluar = StokKeluar::find($id);
        $produk = \DB::select('SELECT id,nama FROM produks');

        $select = '';
        foreach ($produk as $value) {
            $select .= '<option value="' . $value->id . '" ' . ($value->id == $stokkeluar->id_produk ? 'selected' : '') . '>' . $value->nama . '</option>';
        }

        $response = [
            'stokkeluar' => $stokkeluar,
            'produk' => $select
        ];
        return response()->json($response);
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
        StokKeluar::find($id)->delete();
        return response()->json(['success', 'Berhasil Dihapus']);
    }

    public function HtmlToPDF()
    {
        // dd($id);
        $stokkeluar = StokKeluar::with('produk')->orderBy('tgl', 'asc')->get();
        $qty = 0;
        foreach ($stokkeluar as $data) {
            $qty += $data->qty;
        }
        $qtynya = number_format($qty, 0, '', '.');
        // dd($harganya);
        $view = \View::make('StokKeluarToPDF', compact('stokkeluar', 'qtynya'));
        $html_content = $view->render();

        PDF::SetTitle('Laporan Stok Keluar');
        PDF::AddPage();
        PDF::writeHTML($html_content, true, false, true, false, '');

        PDF::Output('StokKeluar.pdf', 'I');
    }
}
