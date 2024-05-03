<?php

namespace App\Http\Livewire;

use App\Models\Order;
use Livewire\Component;
use App\Models\Coupon;
use App\Mail\BoletaFromPay;
use Illuminate\Support\Facades\Session;
use App\Mail\BoletaFromPayAdmin;
use Illuminate\Support\Facades\Mail;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PaymentOrder extends Component
{

    use AuthorizesRequests;

    public $order, $message, $coupon;
    public $coupon_applied = '';
    public $contratega = "1";
    public $stripe = "1";
    public $mercado_pago = "1";
    public $paypal = "0";
    public $originalTotal;
    public $city;
    public $coupon_code;
    public $couponApplied = false;


    protected $listeners = ['payOrder'];

    public function mount(Order $order)
    {
        $this->coupon_applied = Session::get('applied_coupon', null);
        // Guardar el total original de la orden
        $this->order = $order;
        /*$this->coupon = Coupon::where('code', $this->order->coupon_code)->first();*/
        $this->city = json_decode($this->order->envio)->city;

         // Inicializar originalTotal si aún no está definido
         if (!isset($this->originalTotal)) {
            $this->originalTotal = $order->total;
        }

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


public function applyCoupon()
{
    // Verificar si se proporcionó un código de cupón
    if (!$this->coupon_code) {
        // Mostrar mensaje de error o hacer algo apropiado
        return;
    }

    // Obtener el cupón de la base de datos según el código proporcionado
    $coupon = Coupon::where('code', $this->coupon_code)->first();

    // Verificar si se encontró un cupón válido
    if (!$coupon) {
        // Mostrar mensaje de cupón no válido o hacer algo apropiado
        return;
    }

    // Aplicar el descuento del cupón al total de la orden
    $this->order->total -= $this->order->total * ($coupon->discount / 100);
    $this->order->save();

    // Guardar el cupón aplicado en la sesión
    Session::put('applied_coupon', $this->coupon_code);

     // Asignar el código del cupón aplicado para mostrarlo en la vista
     $this->coupon_applied = $this->coupon_code;
     // Después de aplicar el cupón, establece $couponApplied en true
     $this->couponApplied = true;


    // Mensaje de éxito o redireccionar a la misma página con un mensaje
    session()->flash('message', '¡Cupón aplicado con éxito!');
}
public function removeCoupon()
{
    Session::forget('applied_coupon');
    // Restaurar el total original de la orden
    $this->order->total = $this->originalTotal;
    $this->order->save();

    // Eliminar el cupón aplicado
    $this->coupon_applied = '';
    $this->coupon_code = '';
    $this->couponApplied = false;
    // Mensaje de éxito o redireccionar a la misma página con un mensaje
    session()->flash('message', '¡Cupón eliminado con éxito!');
}

}
