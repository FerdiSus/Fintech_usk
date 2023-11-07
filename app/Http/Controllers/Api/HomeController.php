<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Categorie;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
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
        if(Auth::user()->role_id == "kantin"){
            $products = Product::all();   
            $categories = Categorie::all();
            $transactions = Transaction::where('status','dibayar')->orderBy('created_at','DESC')->paginate(12);

            return view('home', compact('products','categories','transactions'));
        }
        if(Auth::user()->role_id == "bank"){
            $wallets = Wallet::where('status', 'selesai')->where('user_id', '4')->get();
            $credit = 0;
            $debit = 0;
            foreach($wallets as $wallet)
            {
                $credit += $wallet->credit;
                $debit += $wallet->debit;
            }
            $saldo = $credit - $debit;
            
            $nasabah = User::where('role_id', 'siswa')->groupBy('order_id')->get()->count();

            $transactions = Transaction::all()->count();
            $transaction_user = Transaction::groupBy('order_id');
            $request_topup = Wallet::where('status', 'proses')->get();

            return view('home', compact('saldo', 'nasabah', 'transactions', 'request_topup'));
        }
        if(Auth::user()->role_id == "siswa"){

            $wallets = Wallet::where('user_id', Auth::user()->id)->where('status', 'selesai')->get();
            $credit = 0;
            $debit = 0;
            
            foreach($wallets as $wallet)
            {
                $credit += $wallet->credit;
                $debit += $wallet->debit;
            }
            $saldo = $credit - $debit;

            $products = Product::all();

            $carts = Transaction::where('status', 'di keranjang')->where('user_id',  Auth::user()->id)->get();
    
            $total_biaya = 0;
    
            foreach($carts as $cart){
                $total_price = $cart->price * $cart->quantity;
                $total_biaya += $total_price;
            }
    
            $mutasi = Wallet::where('user_id', Auth::user()->id)->orderBy('created_at','DESC')->paginate(12);

            $transactions = Transaction::where('status', 'diambil')->where('user_id', Auth::user()->id)->orderBy('created_at', 'DESC')->paginate(3)->groupBy('order_id');
            
            return view('home', compact('products', 'carts', 'saldo', 'total_biaya','mutasi','transactions'));
        }
        if(Auth::user()->role_id == "admin"){
            $nasabah = User::where('role_id','siswa')->get()->count();
            $transactions = Transaction::all()->groupBy('order_id')->count();
            $products = Product::all()->count();


            return view('home',compact('nasabah', 'transactions','products'));
        }
    }
}
