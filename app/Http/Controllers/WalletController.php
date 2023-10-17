<?php

namespace App\Http\Controllers;

use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WalletController extends Controller
{
    public function topUpNow(Request $request){
        $user_id = Auth::user()->id;
        $credit = $request->credit;
        $status = "proses";
        $description = "Top up Saldo";

        Wallet::create([
            'user_id' =>$user_id,
            'credit' =>$credit,
            'status' =>$status,
            'description' => $description
        ]);

        return redirect()->back()->with('status','Berhasil Top up Setor di bank terdekat');
    }
}
