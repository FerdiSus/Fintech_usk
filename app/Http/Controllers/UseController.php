<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();

        return view('data_user', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $cekUsername = User::withTrashed()->where('username', $request->username)->first();
        if($cekUsername )
        {
            return redirect()->back()->with('status','username sudah terpakai');
        }

        if($request->confirm_password == $request->password)
        {
            $user = User::create([
                'name' => $request->name,
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'role_id' => $request->role,
            ]
        );
            return redirect()->back()->with('status','Berhasil Menambahkan User');
        }
        else
        {
            return redirect()->back()->with('status','Password Salah');
        }
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $user)
    {
        $user = User::find($user)->delete();

        if($user)
        {
            return redirect()->back()->with('status','Berhasil Menghapus ');
        }
        return redirect()->back()->with('status','Gagal menghapus');

    }
}
