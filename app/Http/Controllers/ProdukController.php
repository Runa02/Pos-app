<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\User;
use PDF;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = Kategori::all();
        $categoryList = $categories->pluck('nama_kategori', 'id_kategori');
    
        // Retrieve the authenticated user (current seller)
        $currentUser = auth()->user();
    
        // Use where to filter products based on the current seller's user_id
        $produk = Produk::where('user_id', $currentUser->id)->get();
    
        return view('produk.index', compact('produk', 'categoryList'));
    }
    
    

    // public function data()
    // {
    //     $produk = Produk::leftJoin('kategori', 'kategori.id_kategori', 'produk.id_kategori')
    //         ->select('produk.*', 'nama_kategori')
    //         // ->orderBy('kode_produk', 'asc')
    //         ->get();

    //     return datatables()
    //         ->of($produk)
    //         ->addIndexColumn()
    //         ->addColumn('select_all', function ($produk) {
    //             return '
    //                 <input type="checkbox" name="id_produk[]" value="'. $produk->id_produk .'">
    //             ';
    //         })
    //         ->addColumn('kode_produk', function ($produk) {
    //             return '<span class="label label-success">'. $produk->kode_produk .'</span>';
    //         })
    //         ->addColumn('harga_beli', function ($produk) {
    //             return format_uang($produk->harga_beli);
    //         })
    //         ->addColumn('harga_jual', function ($produk) {
    //             return format_uang($produk->harga_jual);
    //         })
    //         ->addColumn('stok', function ($produk) {
    //             return format_uang($produk->stok);
    //         })
    //         ->addColumn('aksi', function ($produk) {
    //             return '
    //             <div class="btn-group">
    //                 <button type="button" onclick="editForm(`'. route('produk.update', $produk->id_produk) .'`)" class="btn btn-xs btn-info btn-flat"><i class="fa fa-pencil"></i></button>
    //                 <button type="button" onclick="deleteData(`'. route('produk.destroy', $produk->id_produk) .'`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button>
    //             </div>
    //             ';
    //         })
    //         ->rawColumns(['aksi', 'kode_produk', 'select_all'])
    //         ->make(true);
    // }

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
        $user = auth()->user();
    
        // Create a new Produk instance
        $produk = new Produk($request->all());
        $produk->user_id = $user->id;
    
        // Set the kode_produk based on the current timestamp or any logic you prefer
        $produk->kode_produk = 'P' . now()->format('YmdHis');
    
        // Save the Produk instance
        $produk->save();
    
        return redirect()->route('produk.index')->with('message', 'Data berhasil disimpan', 200);
    }
    
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $produk = Produk::find($id);

        return response()->json($produk);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $produk = Produk::find($id);
        $produk->update($request->all());

        return redirect()->route('produk.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $produk = Produk::find($id);
        $produk->delete();

        return redirect()->route('produk.index')->with('message', 'berhasil menghapus project');
    }

    public function deleteSelected(Request $request)
    {
        foreach ($request->id_produk as $id) {
            $produk = Produk::find($id);
            $produk->delete();
        }

        return response(null, 204);
    }

    public function cetakBarcode(Request $request)
    {
        $dataproduk = array();
        foreach ($request->id_produk as $id) {
            $produk = Produk::find($id);
            $dataproduk[] = $produk;
        }

        $no  = 1;
        $pdf = PDF::loadView('produk.barcode', compact('dataproduk', 'no'));
        $pdf->setPaper('a4', 'potrait');
        return $pdf->stream('produk.pdf');
    }
}
