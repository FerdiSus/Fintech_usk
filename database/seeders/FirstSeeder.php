<?php

namespace Database\Seeders;

use App\Models\Categorie;
use App\Models\Product;
use App\Models\Student;
use App\Models\Transaction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Support\Facades\Hash;

class FirstSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => "Admin",
            'username' => "admin",
            'password' => Hash::make('123')
        ]);
        User::create([
            'name' => "Tenizen Bank",
            'username' => "bank",
            'password' => Hash::make('123')
        ]);
        User::create([
            'name' => "Tenizen Kantin",
            'username' => "kantin",
            'password' => Hash::make('123')
        ]);
        User::create([
            'name' => "Fauzan",
            'username' => "fauzan",
            'password' => Hash::make('123')
        ]);

        Student::create([
            'user_id' => "4",
            'nis' => 12345,
            'classroom' => "XII RPL"
        ]);

        Categorie::create([
            'name' => "Senjata"
        ]);

        Categorie::create([
            'name' => "Organ"
        ]);

        Categorie::create([
            'name' => "Barang aneh"
        ]);

        Product::create([
            'name' => "Ginjal Kanan",
            'price' => "500000",
            'stock' => 100,
            'photo' => "https://images.unsplash.com/photo-1618939304347-e91b1f33d2ab?auto=format&fit=crop&q=80&w=1887&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
            "desc" => "Ginjal Frozen",
            'category_id' => 2,
            'stand' => '2'
        ]);

        Product::create([
            'name' => "Glock 17",
            'price' => "250000",
            'stock' => 50,
            'photo' => "https://images.unsplash.com/photo-1679759021928-066137103478?auto=format&fit=crop&q=80&w=2070&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
            "desc" => "Punya Ferdy Sambo",
            'category_id' => 1,
            'stand' => '1'
        ]);

        Product::create([
            'name' => "AK47",
            'price' => "185000",
            'stock' => 50,
            'photo' => "https://images.unsplash.com/photo-1669228034704-8fe219a5066b?auto=format&fit=crop&q=80&w=1932&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
            "desc" => "Stock Terbatas",
            'category_id' => 1,
            'stand' => '1'
        ]);

        Wallet::create([
            'user_id' => 4,
            'credit' => 1000000,
            'debit' => null,
            'description' => "Pembukaan tabungan"
        ]);

        Wallet::create([
            'user_id' => 4,
            'credit' => 15000,
            'debit' => null,
            'description' => "Pembelian"
        ]);

        Wallet::create([
            'user_id' => 4,
            'credit' => null,
            'debit' => 21000,
            'description' => "Pembelian"
        ]);


        Transaction::create([
            'user_id' =>  4,
            'product_id' => 1,
            'status' => 'di keranjang',
            'order_id' => 'INV_12345',
            'price' => 5000,
            'quantity' => 1
        ]);

        Transaction::create([
            'user_id' =>  4,
            'product_id' => 2,
            'status' => 'di keranjang',
            'order_id' => 'INV_12345',
            'price' => 10000,
            'quantity' => 1
        ]);

        Transaction::create([
            'user_id' =>  4,
            'product_id' => 3,
            'status' => 'di keranjang',
            'order_id' => 'INV_12345',
            'price' => 3000,
            'quantity' => 2
        ]);


        $total_debit = 0;

        $transaktions = Transaction::where('order_id' ==
        'INV_12345');
        
        foreach($transaktions as $transaction)
        {
            $total_price = $transaction->price * $transaction->quantity;

            $total_debit += $total_price;
        }

        Wallet::create([
            'user_id' => 4,
            'debit' => $total_debit,
            'description' => "Pembelian Product"
        ]);

        foreach($transaktions as $transaction)
        {
            Transaction::find($transaction->id)->update([
                'status' => 'dibayar'
            ]);
        }
        foreach($transaktions as $transaction)
        {
            Transaction::find($transaction->id)->update([
                'status' => 'diambil'
            ]);
        }
        foreach($transaktions as $transaction)
        {
            Transaction::find($transaction->id)->update([
                'status' => 'di keranjang'
            ]);
        }
    }
}
 