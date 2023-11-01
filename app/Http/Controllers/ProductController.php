<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Product;
use Illuminate\Http\Request;
use Symfony\Component\CssSelector\Node\FunctionNode;

class ProductController extends Controller
{

    public function store(Request $request)
    {
    
        $name = $request->name;
        $price= $request->price;
        $stock= $request->stock;
        $photo= $request->photo;
        $stand= $request->stand;
        $desc= $request->desc;
        $category_id= $request->category_id;

        Product::create([
            'name' => $name,
            'price' => $price,
            'stock' => $stock,
            'stand' => $stand,
            'category_id' => $category_id,
            'desc' => $desc,
            'photo' => $photo,
        ]);


      return redirect()->back()->with('status', 'Berhasil Menambahkan product');
    
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

        Product::find($id)->update([
            'name' => $name,
            'price' => $price,
            'stock' => $stock,
            'stand' => $stand,
            'category_id' => $category_id,
            'desc' => $desc,
            'photo' => $photo,
        ]);


      return redirect()->back()->with('status', 'Berhasil Menambahkan product');
    
    }
    
    public function destroy($id)
    {
     
        $delete = Product::find($id)->delete();

        if ($delete)
        {
            return redirect('/home')->with('status', 'Berhasil menghapus produk');
        }
        else
        {
            return redirect('/home')->with('status','Gagal menghapus produk');
        }
    }
}


