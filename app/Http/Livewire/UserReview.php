<?php

namespace App\Http\Livewire;

use App\Models\Review;
use App\Models\Order;
use Livewire\Component; 


use Illuminate\Support\Facades\DB;

class UserReview extends Component
{
    public $reviews, $review, $orders ="";
    // public $orders = [];
    public $product;

 
    public function mount(){
        $this->getReview();
        $this->getOrders();   
    } 

    public function getReview(){

        $this->reviews = DB::table('reviews')
        ->select(DB::raw('reviews.rating as rating'),DB::raw('reviews.status as status'), 
        DB::raw('DATE_FORMAT(reviews.created_at,"%d %M de %Y %H:%i:%s") as time_review'),
        DB::raw('reviews.user_id as user_id'),DB::raw('reviews.title as title'),
        DB::raw('reviews.comment as comment'),DB::raw('reviews.product_id as product_id'),
        DB::raw('users.name as name'))
        ->leftJoin('users', 'users.id', '=', 'reviews.user_id')
        ->leftJoin('products', 'products.id', '=', 'reviews.product_id')
        ->where('reviews.product_id',$this->product->id)
        ->where('reviews.status',1)
        ->get();
  
    }
    public function getOrders(){
  
            $this->orders = Order::where('status', 2)->get();
          
          
    }

    public function render()
    { 
        if($this->reviews != null){
            $items = $this->orders;
            $id_prod = $this->product;
        }else{
            $items ="";
        }
        // $reviews = Review::all();
        // dd($reviews);
        return view('livewire.user-review', compact('items','id_prod'));
    }
}
