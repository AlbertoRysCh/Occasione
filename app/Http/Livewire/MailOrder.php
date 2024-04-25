<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Mail\BoletaFromPay;
use Illuminate\Support\Facades\Mail;

class MailOrder extends Component
{
    public $product;//Order

    public function update(){
        // dd($this->product);
        $items = json_decode($this->product->content);
        $envio = json_decode($this->product->envio);
        // dd($items);
        Mail::to(auth()->user()->email)->send(new BoletaFromPay(auth()->user()->name,auth()->user()->email,$this->product->id,$this->product,$items,$envio,'Comprobante de pago'));
    }

    public function render()
    {
        return view('livewire.mail-order');
    }
}
