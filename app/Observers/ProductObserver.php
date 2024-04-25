<?php

namespace App\Observers;
use App\Models\Product;
use App\Models\Subcategory;

class ProductObserver
{
    public function updated(Product $product){
        $subcategory_id = $product->subcategory_id;
        if($subcategory_id !=null){
            $subcategory = Subcategory::find($subcategory_id);
        }else{
            $subcategory = null; 
        }
        if($subcategory != null){
            if ($subcategory->size) {

                if ($product->colors->count()) {
                    $product->colors()->detach();
                }
                
            }elseif ($subcategory->color) {
                if ($product->sizes->count()) {
                    foreach ($product->sizes as $size) {
                        $size->delete();
                    }
                }
            }else{
                if ($product->colors->count()) {
                    $product->colors()->detach();
                }
    
                if ($product->sizes->count()) {
                    foreach ($product->sizes as $size) {
                        $size->delete();
                    }
                }
            }
        }else{
            if ($product->colors->count()) {
                $product->colors()->detach();
            }

            if ($product->sizes->count()) {
                foreach ($product->sizes as $size) {
                    $size->delete();
                }
            }
        }
        
    }
}
