<?php

use App\Models\Product;
use App\Models\Order;
use App\Models\Size;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\DB;

function quantity($product_id, $color_id = null, $size_id = null){
    $product = Product::find($product_id);

    if($size_id){
        $size = Size::find($size_id);
        $quantity = $size->colors->find($color_id)->pivot->quantity;
    }elseif($color_id){
        $quantity = $product->colors->find($color_id)->pivot->quantity;
    }else{
        $quantity = $product->quantity;
    }

    return $quantity;
}

function qty_added($product_id, $color_id = null, $size_id = null){

    $cart = Cart::content();

    $item = $cart->where('id', $product_id)
                ->where('options.color_id', $color_id)
                ->where('options.size_id', $size_id)
                ->first();

    if($item){
        return $item->qty;
    }else{
        return 0;
    }

}

function qty_available($product_id, $color_id = null, $size_id = null){

    return quantity($product_id, $color_id, $size_id) - qty_added($product_id, $color_id, $size_id);

}


function discount($item){
    $product = Product::find($item->id);
    $qty_available = qty_available($item->id, $item->options->color_id, $item->options->size_id);


    if ($item->options->size_id) {
        
        $size = Size::find($item->options->size_id);

        $size->colors()->detach($item->options->color_id);

        $size->colors()->attach([
            $item->options->color_id => ['quantity' => $qty_available]
        ]);

    }elseif($item->options->color_id){

        $product->colors()->detach($item->options->color_id);

        $product->colors()->attach([
            $item->options->color_id => ['quantity' => $qty_available]
        ]);


    }else{


        $product->quantity = $qty_available;
 
        $product->save();

    }

}

// Discount product cart
 

    function db_qty_added($order_id, $product_id, $color_id = null, $size_id = null){

        $cart = DB::table('orders')->where('id', $order_id)->first();

        // $item = $cart->where('id', $order_id)
        //             ->where('content->options.color_id', $color_id)
        //             ->where('content->options.size_id', $size_id)
        //             ->first();

        $db_cart=json_decode($cart->content);

        // $item = $db_cart->where('id', $product_id)
        //             ->where('options.color_id', $color_id)
        //             ->where('options.size_id', $size_id)
        //             ->first();
        
        foreach($db_cart as $item){
            if($item->id == $product_id){
                return $item->qty;
            }          
        }
                
        // if($item){
        //     // dd($item->content->qty);
        //     return $item->qty;
        // }else{
        //     return 0;
        // }

    }

    function db_qty_available($order_id, $product_id, $color_id = null, $size_id = null){

        return quantity($product_id, $color_id, $size_id) - db_qty_added($order_id, $product_id, $color_id, $size_id);

    }


    function db_discount($item,$order_id){//intentar enviar el id del la orden
        $product = Product::find($item->id);
        $qty_available = db_qty_available($order_id, $item->id, $item->options->color_id, $item->options->size_id);


        if ($item->options->size_id) {
            
            $size = Size::find($item->options->size_id);

            $size->colors()->detach($item->options->color_id);

            $size->colors()->attach([
                $item->options->color_id => ['quantity' => $qty_available]
            ]);

        }elseif($item->options->color_id){

            $product->colors()->detach($item->options->color_id);

            $product->colors()->attach([
                $item->options->color_id => ['quantity' => $qty_available]
            ]);


        }else{

            //Validar campo si es negativo
            if($qty_available >= 0){
                $product->quantity = $qty_available;

                if($qty_available == 0){
                    $product->status = "4";
                }
                // dd($item->id);
                $product->save();
                return "save";
            }else{
                return "error";
            }
          

        }

    }

// Fin Discount product cart

function increase($item){

    $product = Product::find($item->id);
    
    $quantity = quantity($item->id, $item->options->color_id, $item->options->size_id) + $item->qty;


    if ($item->options->size_id) {
        
        $size = Size::find($item->options->size_id);

        $size->colors()->detach($item->options->color_id);

        $size->colors()->attach([
            $item->options->color_id => ['quantity' => $quantity]
        ]);

    }elseif($item->options->color_id){

        $product->colors()->detach($item->options->color_id);

        $product->colors()->attach([
            $item->options->color_id => ['quantity' => $quantity]
        ]);


    }else{


        $product->quantity = $quantity;
        $product->save();

    }

}