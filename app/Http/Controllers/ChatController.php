<?php

namespace App\Http\Controllers;

use App\AkunChat;
use App\Pesan;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function chat(Request $request)
    {
        Pesan::updateOrCreate(
            ['id' => $request->id_pesan],
            [
                'kirim_dari' => $request->id_customer,
                'kirim_ke' => 'admin',
                'pesan' => $request->pesan
            ]
        );
        return response()->json($request->pesan);
    }

    public function akun(Request $request)
    {
        $akun =  AkunChat::updateOrCreate(
            ['id' => $request->id_chat],
            [
                'nama' => $request->nama,
                'email' => $request->email
            ]
        );
        return response()->json(['success' => $akun]);
    }
}
