<?php

namespace App\Http\Controllers;

use App\Models\AccPenjualan;
use Illuminate\Http\Request;

class AccPenjualanController extends Controller
{
    public function index(Request $request)
    {
        $pagination = 5;

        $data = AccPenjualan::whereHas('produk', function ($q) use ($request) {
            $q->where('nama_produk', 'LIKE', '%' . $request->search . '%');
        })->orderBy('id', 'asc')->paginate($pagination);
        return view('accpenjualan.index', compact('data'));
    }
    public function Update(Request $request, $id)
    {
        $penjualan = AccPenjualan::find($id);
        $penjualan->update($request->all());
        return redirect()->route('accpenjualan')->with('message', 'Berhasil Memperbarui Data');

    }
    public function Delete($id)
    {
        $data = AccPenjualan::find($id);
        if ($data->items()->exists()) {
            return redirect()->route('accpenjualan')->with('error', 'kategori masih memiliki relasi');
        }
        ;
        $data->delete($id);
        return redirect()->route('accpenjualan')->with('message', 'Berhasil Menghapus Data');
    }
    public function Send(Request $request, $id)
    {
        $user_id = auth()->user()->id;

        $accPenjualan = new AccPenjualan([
            'user_id' => $user_id,
            'id_produk' => $id,
            'status' => 'Menunggu',
        ]);

        $accPenjualan->save();
        return redirect()->back()->with('message', 'Berhasil Checkout Barang');
    }

}
