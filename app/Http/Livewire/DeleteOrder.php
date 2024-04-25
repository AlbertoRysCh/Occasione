<?php

namespace App\Http\Livewire;

use App\Models\Order;
use Livewire\Component;
 
use Livewire\WithPagination;

class DeleteOrder extends Component
{
    use WithPagination; 

    public $order,$order_id;
    
    protected $listeners = ['delete'];
 
    public function delete(Order $order){
        $order->delete();
        // $this->getBrands();
        // dd($order->id);
        // return view('orders.index');
        return redirect()->route('orders.index');
    }

    public function render()
    {
        // dd($this->order);
        return view('livewire.delete-order');
    }
}
