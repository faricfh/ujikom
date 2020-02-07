<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produk;
use App\Kategori;

class FrontendController extends Controller
{
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
}
