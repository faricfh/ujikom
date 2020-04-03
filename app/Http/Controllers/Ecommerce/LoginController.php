<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Customer;
use App\Kota;
use App\Kurir;
use App\Provinsi;
use Kavist\RajaOngkir\Facades\RajaOngkir;

class LoginController extends Controller
{
    private function getCarts()
    {
        $carts = json_decode(request()->cookie('dw-carts'), true);
        $carts = $carts != '' ? $carts : [];
        return $carts;
    }

    public function loginForm()
    {
        if (auth()->guard('customer')->check()) return redirect('checkout');
        return view('frontend.login');
        return back();
    }

    public function login(Request $request)
    {
        //VALIDASI DATA YANG DITERIMA
        $this->validate($request, [
            'email' => 'required|email|exists:customers,email',
            'password' => 'required|string'
        ]);

        //CUKUP MENGAMBIL EMAIL DAN PASSWORD SAJA DARI REQUEST
        //KARENA JUGA DISERTAKAN TOKEN
        $auth = $request->only('email', 'password');
        $auth['status'] = 1; //TAMBAHKAN JUGA STATUS YANG BISA LOGIN HARUS 1

        //CHECK UNTUK PROSES OTENTIKASI
        //DARI GUARD CUSTOMER, KITA ATTEMPT PROSESNYA DARI DATA $AUTH
        if (auth()->guard('customer')->attempt($auth)) {
            //JIKA BERHASIL MAKA AKAN DIREDIRECT KE DASHBOARD
            // return redirect()->intended(route('customer.dashboard'));
            return redirect(url('/checkout'));
        }
        //JIKA GAGAL MAKA REDIRECT KEMBALI BERSERTA NOTIFIKASI
        return redirect()->back()->with(['error' => 'Email / Password Salah']);
    }

    public function register(Request $request)
    {
        $request->validate(
            [
                'nama' => 'required',
                'email' => 'required|unique:customers,email,' . $request->customer_id . ',id|email',
                'no_tlp' => 'required',
                'alamat' => 'required',
                'password' => 'required'
            ]
        );

        Customer::updateOrCreate(
            ['id' => $request->customer_id],
            [
                'nama' => $request->nama,
                'email' => $request->email,
                'no_tlp' => $request->no_tlp,
                'alamat' => $request->alamat,
                'password' => $request->password,
                'status' => 1,
            ]
        );

        return response()->json(['success' => 'Berhasil di Simpan']);
    }

    public function checkout()
    {
        //MENGAMBIL DATA DARI COOKIE
        $carts = $this->getCarts();

        //UBAH ARRAY MENJADI COLLECTION, KEMUDIAN GUNAKAN METHOD SUM UNTUK MENGHITUNG SUBTOTAL
        $subtotal = collect($carts)->sum(function ($q) {
            return $q['qty'] * $q['harga_produk']; //SUBTOTAL TERDIRI DARI QTY * PRICE
        });

        $kurir = Kurir::pluck('nama', 'kode');
        $provinsi = Provinsi::pluck('nama', 'id_provinsi');
        $kota = Kota::pluck('nama', 'id_kota');

        $berat = collect($carts)->sum(function ($q) {
            return $q['qty'] * $q['berat_produk'];
        });

        //LOAD VIEW CART.BLADE.PHP DAN PASSING DATA CARTS DAN SUBTOTAL
        return view('frontend.checkout', compact('subtotal', 'kurir', 'provinsi', 'berat', 'kota'));
    }

    public function getKota($id)
    {
        $kota = Kota::where('id_provinsi', $id)->pluck('nama', 'id_kota');
        return response()->json($kota);
    }

    public function submit(Request $request)
    {
        $harga = RajaOngkir::ongkosKirim([
            'origin' => $request->kota_asal,
            'destination' => $request->kota_tujuan,
            'weight' => $request->berat,
            'courier' => $request->kurir,
        ])->get();

        $option = '';
        foreach ($harga[0]['costs'] as $data) {
            foreach ($data['cost'] as $datas) {
                $option .= '<label><input type="radio" name="pilih-layanan" class="form-controll" value="' . $datas['value'] . '">' . $data['description'] . '</label>  ';
            }
        }
        // dd($option);
        return response()->json($option);
    }

    public function logout()
    {
        auth()->guard('customer')->logout(); //JADI KITA LOGOUT SESSION DARI GUARD CUSTOMER
        return view('frontend.index');
    }
}
