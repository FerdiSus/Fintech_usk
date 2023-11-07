<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function index()
    {
        $nasabah = User::all(); 
        $porduk = Product::all();

        return response()->json([
            'data' => $nasabah,
            'produk' => $porduk
        ]);
    }
}
