<?php

namespace App\Http\Controllers;

use App\Models\AccPenjualan;
use App\Models\Keranjang;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccPenjualanController extends Controller
{
    public function index(Request $request)
    {

        $userId = Auth::id();

        $data = AccPenjualan::whereHas('produk', function ($q) use ($request, $userId) {
            $q->where('nama_produk', 'LIKE', '%' . $request->search . '%')
                ->where('user_id', $userId); // Menambahkan kondisi untuk memastikan hanya produk milik user yang login
        })
            ->orderBy('id', 'asc')
            ->get();

        return view('accpenjualan.index', compact('data'));
    }
    public function Update(Request $request, $id)
    {
        $penjualan = AccPenjualan::find($id);

        if ($penjualan->jumlah > $penjualan->produk->stok) {
            return redirect()->route('accpenjualan')->with('error', 'Stok tidak cukup untuk memproses pesanan.');
        }

        $penjualan->status = 'Terkirim';
        $penjualan->save();

        $produk = $penjualan->produk;
        $produk->stok -= $penjualan->jumlah;
        $produk->save();

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

        $request->validate([
            'pesan' => 'nullable',
            'jumlah' => 'required',

        ]);

        $produk = Produk::findOrFail($id);
        // dd($produk);

        $total_bayar = $request->jumlah * $produk->harga_jual;

        $accPenjualan = new AccPenjualan([
            'user_id' => $user_id,
            'produk_id' => $id,
            'status' => 'Menunggu',
            'pesan' => $request->pesan,
            'jumlah' => $request->jumlah,
            'total_bayar' => $total_bayar,
        ]);

        $accPenjualan->save();
        return redirect()->route('success.page', ['id' => $accPenjualan->id])->with('message', 'Berhasil Checkout Barang');
    }
    public function add(Request $request, $id)
    {
        $cartItem = Keranjang::findOrFail($id);

        AccPenjualan::create([
            'user_id' => auth()->id(),
            'produk_id' => $cartItem->produk_id,
            'status' => 'Menunggu',
            'jumlah' => $cartItem->stok,
            'pesan' => 'Beli',
            'total_bayar' => $cartItem->produk->harga_jual * $cartItem->stok,
        ]);

        $cartItem->delete();

        return redirect()->back()->with('message', 'Berhasil Checkout Barang');
    }

}
