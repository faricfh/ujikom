<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Produk;
use App\Kategori;

class FrontendController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $index = Produk::take(7)->get();

        $response = [
            'success' => true,
            'data' => $index,
            'message' => 'Berhasil'
        ];

        return response()->json($response, 200);
    }

    public function shop()
    {
        $kategori = Kategori::all();
        $produk = Produk::paginate(6);

        $response = [
            'success' => true,
            'data' => [
                'kategori' => $kategori,
                'produk' => $produk
            ],
            'message' => 'Berhasil'
        ];

        return response()->json($response, 200);
    }

    public function kategorishop(Kategori $kategori)
    {
        $produk = $kategori->produk()->paginate(6);
        $kategoris = Kategori::all();
        $response = [
            'success' => true,
            'data' => [
                'kategori' => $kategoris,
                'produk' => $produk
            ],
            'message' => 'Berhasil'
        ];

        return response()->json($response, 200);
    }

    public function produkdetail(Produk $produk)
    {
        $produkdet = Produk::where('slug', '=', $produk->slug)->first();

        $response = [
            'success' => true,
            'data' => $produkdet,
            'message' => 'berhasil'
        ];

        return response()->json($response, 200);
    }
}
