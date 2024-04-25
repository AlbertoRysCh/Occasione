<?php

namespace App\Http\Livewire;

use App\Models\Order;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class VerifiedOrderUser extends Component
{

    public $verifieds, $orders = [];
    public $product_id, $user_id;

    public function mount(){
        $this->getVerified();  
    } 

    public function getVerified(){

        $this->orders = DB::table('orders')
        ->where('user_id',$this->user_id)
        ->get();
        // dd( $this->orders );
    }

    public function render()
    {
        if($this->orders != null){
            $iors = $this->orders;
            $id_prod = $this->product_id;
        }else{
            $iors ="";
            $id_prod ="";
        }
        
         
        return view('livewire.verified-order-user', compact('iors','id_prod'));
    }
}
