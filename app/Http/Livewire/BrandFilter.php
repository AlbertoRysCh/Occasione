<?php

namespace App\Http\Livewire;

use Livewire\Component;
 
use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Support\Facades\Redirect;

use Illuminate\Database\Eloquent\Builder;

use Illuminate\Support\Facades\DB;

class BrandFilter extends Component
{

    public $category_id,$category,$marca_id,$marca_name;

    public $categoria; 

    public $view = "grid";

    public $title,$parameters;

    
    protected $queryString = ['categoria'];

    public function mount($product){
        // $this->product = $product;
        // $this->category_id = $product->subcategory->category->id;
        $this->marca_name = $product; 
        
        $this->getCategories();
    }

    public function getCategories(){

        $this->marca_id = Brand::where('name', $this->marca_name)->value('id'); 
        $this->category_id = DB::table('brand_category')->where('brand_id', $this->marca_id)->value('category_id');
        
        $this->category = Category::where('id', $this->category_id)->get(); 
        // dd($this->category);
    }

    public function render()
    {
        // $productsQuery = Product::query()->whereHas('brand', function(Builder $query){
        //     $query->where('name', $this->marca_name)->where('status', 2);
        // });

        $productsQuery = Product::query()->whereHas('brand', function(Builder $query){
            $query->where('name', $this->marca_name)
            ->where(function($query) {
                $query->where('status', 2)
                      ->orWhere('status', 3);
            });
        });

        
        
        // if ($this->categoria) {
        //     // dd($this->categoria);
        //     // return redirect()->to('/categories/'.$this->categoria);
        //     return Redirect::route('categories.show_id', $this->categoria);

        // }

        $products = $productsQuery->paginate(20);
 

        return view('livewire.brand-filter', compact('products'));
    }
}
