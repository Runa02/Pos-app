<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontController extends Controller
{
    public function index()
    {
        $produkfront = Produk::all();
        return view('front.content', compact('produkfront'));
    }

    public function cart()
    {
        $cartItems = Keranjang::where('user_id', Auth::id())->get();

        return view('front.cart', compact('cartItems'));
    }
}
