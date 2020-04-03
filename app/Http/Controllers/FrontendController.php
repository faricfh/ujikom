<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produk;
use App\Kategori;
use App\Customer;
use App\Order;
use App\OrderDetail;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{
    public function dashboard()
    {
        $customer = Customer::where('id', Auth::guard('customer')->id())->get();

        $order = Order::with('orderdetail')->where('id_customer', Auth::guard('customer')->id())->get();
        // foreach ($order as $data) {
        //     $orderdetail = OrderDetail::where('id_order', $data->id)->with('produk')->get();
        // }

        return view('frontend.dashboard', compact('customer', 'order'));
    }

    public function shop()
    {
        $produk = Produk::paginate(6);

        return view('frontend.shop', compact('produk'));
    }

    public function kategorishop(Kategori $kategori)
    {
        $produk = $kategori->produk()->paginate(6);

        return view('frontend.shop', compact('produk'));
    }

    public function cariproduk(Request $request)
    {
        $produk = Produk::where('nama', "LIKE", "%{$request->input('produk')}%")->paginate(6);
        return view('frontend.shop', compact('produk'));
    }

    public function search(Request $request)
    {
        $data = Produk::select("nama as name", "foto as img")->where("nama", "LIKE", "%{$request->input('query')}%")->get();
        return response()->json($data);
    }
}
