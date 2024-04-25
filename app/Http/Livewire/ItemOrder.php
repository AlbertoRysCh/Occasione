<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\Order;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Http;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ItemOrder extends Component
{
    use AuthorizesRequests;
    public $order;

    // public function mount(){
       
    // }
    public function render()
    {
        $this->authorize('author', $this->order); 
        $items = json_decode($this->order->content); 
        // dd($items);
        // dd($this->order);
        return view('livewire.item-order',compact('items'));
    }
}
