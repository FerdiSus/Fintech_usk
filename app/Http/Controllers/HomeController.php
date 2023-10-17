<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function rupiah($saldo){
	
        $hasil_rupiah = "Rp " . number_format($saldo,2,',','.');
        return view('home', compact('hasil_rupiah'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $wallets = Wallet::where('user_id',Auth::user()->id)->where('status', 'selesai')->get();
        $credit = 0;
        $debit = 0;

        foreach($wallets as $wallet)
        {
            $credit += $wallet->credit;
            $debit += $wallet->debit;
        }

        $saldo = $credit - $debit;

        $products = Product::all();
        $carts = Transaction::where('status', 'di keranjang')->get();
        $total_biaya = 0;


        foreach($carts as $cart){
            $total_price = $cart->price * $cart->quantity;

            $total_biaya += $total_price;
        }

        $mutasi = Wallet::where('user_id', Auth::user()->id)->orderBy('created_at', 'DESC')->paginate(8);

        $transactions = Transaction::where('status', 'diambil')->where('user_id', Auth::user()->id)->orderBy('created_at', 'DESC')->paginate(5)->groupBy('order_id');
        // dd($transactions);

        return view('home', compact('saldo','products','carts','total_biaya','mutasi','transactions'));
    }
}
