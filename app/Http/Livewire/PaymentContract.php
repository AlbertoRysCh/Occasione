<?php

namespace App\Http\Livewire;

use App\Models\Order;
use Livewire\Component;

use App\Mail\BoletaFromPay;
use App\Mail\BoletaFromPayAdmin;
use Illuminate\Support\Facades\Mail;

class PaymentContract extends Component
{

    public $order, $message;

    public function mount(Order $order)
    {
        $this->order = $order;
    }

    public function render()
    {

        return view('livewire.payment-contract');
    }

    public function save()
    {
        // dd( $this->order);

        $items = json_decode($this->order->content);
        $envio = json_decode($this->order->envio);
        // dd(json_decode($this->order->content));

        foreach ($items as $item) {
            $this->message = db_discount($item, $this->order->id);
            if ($this->message == "error") {
                break;
            }
        }

        if ($this->message != "error") {
            $this->order->status = 2;
            $this->order->pay_method = 'Contra Entrega';
            $this->order->save();

            // USER
            Mail::to(auth()->user()->email)->send(new BoletaFromPay(auth()->user()->name, auth()->user()->email, $this->order->id, $this->order, $items, $envio, 'Comprobante de pago'));
            // ADMIN
            Mail::to(env('MAIL_FROM_ADM'))->send(new BoletaFromPayAdmin(auth()->user()->name, auth()->user()->email, $this->order->id, $this->order, $items, $envio, 'Comprobante de pago'));

            return redirect()->route('orders.show', $this->order);
        } else {
            $this->emit('cart_item_stock');
        }
    }
}
