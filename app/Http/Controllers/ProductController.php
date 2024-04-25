<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Models\Product;

class ProductController extends Controller
{
    public function show(Product $product){
        return view('products.show', compact('product'));
    }
    public function show_id($id_product){

        $product = DB::table('products')
        ->where('slug',$id_product)
        ->get(); 

        return view('products.show', compact('product'));
    }
}
