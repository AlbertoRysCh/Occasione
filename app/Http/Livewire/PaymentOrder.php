<?php

namespace App\Http\Livewire;

use App\Models\Order;
use Livewire\Component;

use App\Mail\BoletaFromPay;
use App\Mail\BoletaFromPayAdmin;
use Illuminate\Support\Facades\Mail;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PaymentOrder extends Component
{

    use AuthorizesRequests;

    public $order, $message;

    public $contratega = "1";
    public $stripe = "1";
    public $mercado_pago = "1";
    public $paypal = "0";

    public $city;



    protected $listeners = ['payOrder'];

    public function mount(Order $order)
    {
        $this->order = $order;
        $this->city = json_decode($this->order->envio)->city;

        if ($this->city == "Lima " || $this->city == "Lima") {
            $this->contratega = "1";
        }

        // dd($this->contratega);
    }

    public function payUpOrder()
    {
        dd("hola");
        //  return redirect()->route('orders.payment', $this->order);
    }

    //Paypal
    public function payOrder()
    {

        $items = json_decode($this->order->content);
        $envio = json_decode($this->order->envio);

    dd($items);
        foreach ($items as $item) {
            $this->message = db_discount($item, $this->order->id);
            if ($this->message == "error") {
                break;
            }
        }

        if ($this->message != "error") {
            $this->order->status = 2;
            $this->order->pay_method = 'Paypal';
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


    public function render()
    {

        $this->authorize('author', $this->order);
        $this->authorize('payment', $this->order);

        $items = json_decode($this->order->content);
        $envio = json_decode($this->order->envio);

        return view('livewire.payment-order', compact('items', 'envio'));
    }
}
