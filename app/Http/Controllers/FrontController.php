<?php

namespace App\Http\Controllers;

use App\Models\AccPenjualan;
use App\Models\Keranjang;
use App\Models\Produk;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontController extends Controller
{
    public function index(Request $request)
    {
        $minPrice = $request->input('min_price');
        $maxPrice = $request->input('max_price');


        $produkfront = Produk::query();

        if ($minPrice && $maxPrice) {
            $produkfront->whereBetween('harga_jual', [$minPrice, $maxPrice]);
        }

        $produkfront = $produkfront->get();
        return view('front.content', compact('produkfront', 'minPrice', 'maxPrice'));
    }
    public function cart()
    {
        $cartItems = Keranjang::where('user_id', Auth::id())->get();
        return view('front.cart', compact('cartItems'));
    }

    public function detailcontent($id)
    {
        $detail = Produk::find($id);

        return view('front.detailcontent', compact('detail'));
    }

    public function wishlist()
    {
        $wishlistItem = Wishlist::where('user_id', Auth::id())->get();
        return view('front.wishlist', compact('wishlistItem'));
    }

    public function addwishlist($id)
    {
        $data = Produk::find($id);

        $existingWishlist = Wishlist::where('produk_id', $data->id)->where('user_id', auth()->id())->first();

        if($existingWishlist){
            return redirect()->route('front.index')->with('message', 'Item sudah ada di wishlist kamu');
        } else {
            Wishlist::create([
                'produk_id' => $data->id,
                'user_id' => auth()->id(),
            ]);
        }

        return redirect()->route('front.index');
    }

    public function deletewishlist(Wishlist $item)
    {
        if ($item->user_id !== auth()->id()) {
            abort(403, 'Unauthorized'); // Or redirect to an error page
        }

        $item->delete();

        return redirect()->route('wishlist.index');
    }

    public function profile()
    {
        $user = Auth::user();
        return view('front.profile', compact('user'));
    }

    public function showorders()
    {
        $orders = AccPenjualan::with('produk')->where('user_id', auth()->id())->get();
        return view('front.order', ['orders' => $orders]);
    }

    public function successPage($id)
    {
        $data = AccPenjualan::with('produk.user')->where('id', $id)->first();

        // dd($data);
        return view('front.successpage', compact('data'));
    }
}