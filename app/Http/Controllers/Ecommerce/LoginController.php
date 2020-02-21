<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Customer;

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

    public function checkout()
    {
        //MENGAMBIL DATA DARI COOKIE
        $carts = $this->getCarts();

        //UBAH ARRAY MENJADI COLLECTION, KEMUDIAN GUNAKAN METHOD SUM UNTUK MENGHITUNG SUBTOTAL
        $subtotal = collect($carts)->sum(function ($q) {
            return $q['qty'] * $q['harga_produk']; //SUBTOTAL TERDIRI DARI QTY * PRICE
        });

        //LOAD VIEW CART.BLADE.PHP DAN PASSING DATA CARTS DAN SUBTOTAL        
        return view('frontend.checkout',compact('subtotal'));
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

    public function logout()
    {
        auth()->guard('customer')->logout(); //JADI KITA LOGOUT SESSION DARI GUARD CUSTOMER
        return view('frontend.index');
    }
}
