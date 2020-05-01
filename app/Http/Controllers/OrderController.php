<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\Order;
use App\OrderDetail;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Order::all();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Show" class="btn btn-success btn-sm show"><i class="nav-icon fas fa-eye" style="color:white"></i></a>';
                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm hapus"><i class="nav-icon fas fa-trash" style="width:15px"></i></a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.order');
    }

    public function show($id)
    {
        $order = Order::find($id);
        $order_detail = OrderDetail::with('produk')->where('id_order', $id)->get();

        $response = [
            'order' => $order,
            'order_detail' => $order_detail
        ];
        return response()->json($response);
    }

    public function destroy($id)
    {
        Order::find($id)->delete();
        OrderDetail::where('id_order', $id)->delete();
        return response()->json(['success' => 'Berhasil Dihapus']);
    }
}
