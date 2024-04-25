<?php

namespace App\Http\Livewire;

use App\Models\Size;
use Livewire\Component;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class AddCartItemSize extends Component
{

    public $product, $sizes;
    public $color_id = "";
    public $qty = 1;
    public $dif_price=0.0;
    public $sub_price=0.0;
    public $price=0.0;
    public $quantity = 0;
    public $size_id = "";

    public $colors = [];

    public $options = [];

    public function mount()
    {
        $this->sizes = $this->product->sizes;
        // $this->options['image'] = Storage::url($this->product->images->first()->url);
        $this->options['image'] = Storage::url(DB::table('images')
            ->leftJoin('products', 'products.id', '=', 'images.imageable_id') 
            ->orWhere('products.id', $this->product->id)
            ->where('images.position', 'primary')->value('url'));
        
    }

    public function updatedSizeId($value)
    {
        $size = Size::find($value);
        $this->colors = $size->colors;
        $this->options['size'] = $size->name;
        $this->options['size_id'] = $size->id;
    }

    public function updatedColorId($value)
    {
        $size = Size::find($this->size_id);
        $color = $size->colors->find($value);
        $this->quantity = qty_available($this->product->id, $color->id, $size->id);
        $this->options['color'] = $color->name;
        $this->options['color_id'] = $color->id;
    }


    public function decrement()
    {
        $this->qty = $this->qty - 1;
    }

    public function increment()
    {
        $this->qty = $this->qty + 1;
    }

    public function addItem()
    {
        $this->sub_price = $this->product->sub_price; 
        if($this->sub_price != null || $this->sub_price != 0.0){
            $this->sub_price = (double)filter_var(number_format($this->product->price,2), FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION) ;
            $this->price = (double)filter_var(number_format($this->product->sub_price,2), FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            // $this->dif_price = round((($this->product->price - $this->product->sub_price) / $this->product->sub_price ) * 100.00, 0);
            // dd( (double)filter_var(number_format($this->product->sub_price,2), FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION) );
            $this->dif_price = round((100-(($this->product->sub_price *100.00) / $this->product->price )), 0);
       }else{
            $this->price = number_format($this->product->price,2);
        }
        
        Cart::add([ 'id' => $this->product->id, 
                    'name' => $this->product->name, 
                    'slug' => $this->product->slug,
                    'qty' => $this->qty, 
                    'sub_price' => $this->sub_price, 
                    'porcentaje' => $this->dif_price,
                    'price' => $this->price, 
                    'weight' => 550,
                    'options' => $this->options
                ]);

        $this->quantity = qty_available($this->product->id, $this->color_id, $this->size_id);

        $this->reset('qty');

        $this->emit('add_cart_item_size');
        
        $this->emitTo('cart-mobil', 'render');
        $this->emitTo('dropdown-cart', 'render');
    }

    public function render()
    {
        return view('livewire.add-cart-item-size');
    }
}
