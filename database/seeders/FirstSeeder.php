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
            'name' => "Minuman"
        ]);

        Categorie::create([
            'name' => "Makanan"
        ]);

        Categorie::create([
            'name' => "Snack"
        ]);

        Product::create([
            'name' => "Lemon Tea",
            'price' => "5000",
            'stock' => 100,
            'photo' => ".jpg",
            "desc" => "Es Teh Lemon",
            'category_id' => 3,
            'stand' => '2'
        ]);

        Product::create([
            'name' => "Meat Ball",
            'price' => "10000",
            'stock' => 50,
            'photo' => ".jpg",
            "desc" => "Bakso Daging",
            'category_id' => 3,
            'stand' => '1'
        ]);

        Product::create([
            'name' => "Risoles",
            'price' => "3000",
            'stock' => 50,
            'photo' => ".jpg",
            "desc" => "Risol Mayo",
            'category_id' => 3,
            'stand' => '1'
        ]);

        Wallet::create([
            'user_id' => 4,
            'credit' => 100000,
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
 