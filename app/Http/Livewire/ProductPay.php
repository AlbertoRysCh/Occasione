<?php

namespace App\Http\Livewire;

use App\Models\Order;
use Livewire\Component;

use Exception;

use App\Mail\BoletaFromPay;
use App\Mail\BoletaFromPayAdmin;
use Illuminate\Support\Facades\Mail;

class ProductPay extends Component
{
    public $order, $message, $paymentMethod; //Order 

    protected $listeners = ['paymentMethodCreate'];

    public function mount(Order $order)
    {
        $this->order = $order;
    }

    public function render()
    {
        return view('livewire.product-pay');
    }

    public function paymentMethodCreate($paymentMethod)
    {
        try {

            $items = json_decode($this->order->content);
            $envio = json_decode($this->order->envio);

            foreach ($items as $item) {
                $this->message = db_discount($item, $this->order->id);
                if ($this->message == "error") {
                    break;
                }
            }

            if ($this->message != "error") {

                //Metodo de parametro que envia el precio y el token guardamos informacion en dolares *100
                // auth()->user()->charge($this->product->total * 100, $paymentMethod); 

                auth()->user()->charge($this->order->total * 100, $paymentMethod);

                $this->emit('resetStripe');

                $this->order->status = 2;
                $this->order->pay_method = 'Tarjeta (Stripe)';
                $this->order->save();

                //USER
                Mail::to(auth()->user()->email)->send(new BoletaFromPay(auth()->user()->name, auth()->user()->email, $this->order->id, $this->order, $items, $envio, 'Comprobante de pago'));
                // ADMIN
                Mail::to(env('MAIL_FROM_ADM'))->send(new BoletaFromPayAdmin(auth()->user()->name, auth()->user()->email, $this->order->id, $this->order, $items, $envio, 'Comprobante de pago'));

                return redirect()->route('orders.show', $this->order);
            } else {
                $this->emit('cart_item_stock');
            }
        } catch (Exception $e) {
            $this->emit('cart_item_stock');
            $this->emit('errorPayment');
        }
    }
}
