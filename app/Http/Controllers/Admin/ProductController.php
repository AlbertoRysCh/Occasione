<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    //Imagenes de Reales
    public function files(Product $product, Request $request){

        $request->validate([
            'file' => 'required|image|max:4096'
        ]);
        // $path = $request->file('avatar')->store('public/subcategories'); 
        
        $imageName = time().'.'.$request->file('file')->extension();  

        $request->file('file')->move(public_path('storage/products'), $imageName);
    
        $url = 'products/'.$imageName;
 
        // $url = Storage::put('products', $request->file('file')); 

        $product->images()->create([
            'url' => $url
        ]);
    }

    ///Imagenes de Web
    public function files_w(Product $product, Request $request){

        $request->validate([
            'file' => 'required|image|max:4096'
        ]);
        // $path = $request->file('avatar')->store('public/subcategories'); 
        
        $imageName = time().'.'.$request->file('file')->extension();  

        $request->file('file')->move(public_path('storage/products'), $imageName);
    
        $url = 'products/'.$imageName;
 
        // $url = Storage::put('products', $request->file('file')); 

        $product->images()->create([
            'url' => $url,
            'position' => 'web'
        ]);
    }

    ///Imagenes de Modelo
    public function files_m(Product $product, Request $request){

        $request->validate([
            'file' => 'required|image|max:4096'
        ]);
        // $path = $request->file('avatar')->store('public/subcategories'); 
        
        $imageName = time().'.'.$request->file('file')->extension();  

        $request->file('file')->move(public_path('storage/products'), $imageName);
    
        $url = 'products/'.$imageName;
 
        // $url = Storage::put('products', $request->file('file')); 

        $product->images()->create([
            'url' => $url,
            'position' => 'models'
        ]);
    }
}
