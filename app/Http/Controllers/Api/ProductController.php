<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Categorie;
use App\Models\Product;
use Illuminate\Http\Request;
use Symfony\Component\CssSelector\Node\FunctionNode;

class ProductController extends Controller
{   
    public function index()
    {
        $product = Product::all();

        // return view('data_user', compact('users'));
        return response()->json([
            "message" => "Berhasil Ambil Product",
            "status" => 200,
            "data" => $product
        ]);
    }

    public function store(Request $request)
    {
    
        $name = $request->name;
        $price= $request->price;
        $stock= $request->stock;
        $photo= $request->photo;
        $stand= $request->stand;
        $desc= $request->desc;
        $category_id= $request->category_id;

        $product = Product::create([
            'name' => $name,
            'price' => $price,
            'stock' => $stock,
            'stand' => $stand,
            'category_id' => $category_id,
            'desc' => $desc,
            'photo' => $photo,
        ]);


        return response()->json([
            "message" => "Berhasil Tambah data",
            "status" => 200,
            "data" => $product
        ]);
    
    }

    public function update(Request $request, $id)
    {
    
        $name = $request->name;
        $price= $request->price;
        $stock= $request->stock;
        $photo= $request->photo;
        $stand= $request->stand;
        $desc= $request->desc;
        $category_id= $request->category_id;

       $product = Product::find($id)->update([
            'name' => $name,
            'price' => $price,
            'stock' => $stock,
            'stand' => $stand,
            'category_id' => $category_id,
            'desc' => $desc,
            'photo' => $photo,
        ]);

        return response()->json([
            "message" => "Berhasil update data",
            "status" => 200,
            "data" => $product
        ]);
      
    
    }
    
    public function destroy($id)
    {
     
        $delete = Product::find($id)->delete();

        if ($delete)
        {
            return response()->json([
                "message" => "Berhasil hapus data",
                "status" => 200,
            ]);
        }
        else
        {
            return response()->json([
                "message" => "Gagal hapus data",
                "status" => 200,
            ]);
        }
    }
}


