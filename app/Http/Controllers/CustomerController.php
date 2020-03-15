<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Customer;
use DataTables;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Customer::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-warning btn-sm edit"><i class="nav-icon fas fa-pen" style="color:white"></i></a>';
                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm hapus"><i class="nav-icon fas fa-trash" style="width:15px"></i></a>';

                    return $btn;
                })
                ->addColumn('status', function ($row) {
                    if ($row->status == 1) {
                        $status = '<span class="badge badge-success">Aktif</span>';
                    } else {
                        $status = '<span class="badge badge-danger">Nonaktif</span>';
                    }
                    return $status;
                })
                ->rawColumns(['action', 'status'])
                ->make(true);
        }
        return view('admin.customer');
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
        if ($request->customer_id == null) {
            $request->validate(
                [
                    'nama' => 'required',
                    'email' => 'required|unique:customers,email,' . $request->customer_id . ',id|email',
                    'no_tlp' => 'required',
                    'alamat' => 'required',
                    'password' => 'required|min:6'
                ],
                [
                    'nama.required' => 'Nama Customer harus diisi',
                    'email.required' => 'Email harus diisi',
                    'email.unique' => 'Email sudah ada',
                    'email.email' => 'Harus email yang benar',
                    'no_tlp.required' => 'No Telepon harus diisi',
                    'alamat.required' => 'Alamat harus diisi',
                    'password.required' => 'Password harus diisi',
                    'password.min' => 'Password minimal harus 6',
                ]
            );
        } else {
            $request->validate(
                [
                    'nama' => 'required',
                    'email' => 'required|unique:customers,email,' . $request->customer_id . ',id|email',
                    'no_tlp' => 'required',
                    'alamat' => 'required',
                ],
                [
                    'nama.required' => 'Nama Customer harus diisi',
                    'email.required' => 'Email harus diisi',
                    'email.unique' => 'Email sudah ada',
                    'email.email' => 'Harus email yang benar',
                    'no_tlp.required' => 'No Telepon harus diisi',
                    'alamat.required' => 'Alamat harus diisi'
                ]
            );
        }

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
        $customer = customer::find($id);
        return response()->json($customer);
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
        Customer::find($id)->delete();
        return response()->json(['success' => 'Berhasil Dihapus']);
    }
}
