<?php

namespace App\Http\Livewire\Admin;

 
use App\Models\Review;
use Livewire\WithPagination;

use Livewire\Component;

use Illuminate\Support\Facades\DB;

class CrudReview extends Component
{

    use WithPagination;

    public $search, $review;

    public function updatingSearch(){
        $this->resetPage();
    }

    public $editForm = [
        'open' => false,
        'status' => null,
    ];

    protected $validationAttributes = [
        'editForm.status' => 'status'
    ];

    public function edit(Review $review){
 
        // $this->resetValidation();

        $this->review = $review;

        $this->editForm['open'] = true;
        $this->editForm['status'] = $review->status;
    }

    public function update(){
  
        $this->review->update($this->editForm);
  
        $this->reset(['editForm']);
    }

    public function render()
    {
          //hola mundo

        //   $reviews = Review::where('user_id', 'like', '%' . $this->search . '%')->paginate(10);
          $reviews = DB::table('reviews')
          ->select(DB::raw('reviews.id as id'),DB::raw('reviews.rating as rating'),DB::raw('reviews.status as status'), 
          DB::raw('DATE_FORMAT(reviews.created_at,"%d %M de %Y %H:%i:%s") as time_review'),
          DB::raw('reviews.user_id as user_id'),DB::raw('reviews.title as title'),
          DB::raw('reviews.comment as comment'),DB::raw('reviews.product_id as product_id'),
          DB::raw('users.name as name'),DB::raw('products.name as name_product'),DB::raw('products.slug as products_slug'))
          ->leftJoin('users', 'users.id', '=', 'reviews.user_id')
          ->leftJoin('products', 'products.id', '=', 'reviews.product_id')
          ->where('users.name', 'like', '%' . $this->search . '%')
          ->orWhere('products.name', 'like', '%' . $this->search . '%')
          ->orderBy('reviews.created_at','DESC')
          ->paginate(10);

          return view('livewire.admin.crud-review', compact('reviews'))->layout('layouts.admin');
        
    }
}
