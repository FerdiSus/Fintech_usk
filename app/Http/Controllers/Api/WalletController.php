<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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

    public function request_topup(Request $request)
    {
        Wallet::find($request->id)->update([
            'status' => 'selesai'
        ]);

        return redirect()->back()->with('status', 'Berhasil Konfirmasi Top Up Nasabah');

    }
}
