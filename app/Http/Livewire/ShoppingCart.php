<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Coupon;
use Gloudemans\Shoppingcart\Facades\Cart;

class ShoppingCart extends Component
{
    public $coupon_applied;
    public $coupon_code;
    public $totalWithDiscount;

    protected $listeners = ['render'];

    public function destroy(){
        Cart::destroy();

        $this->emitTo('cart-mobil', 'render');
        $this->emitTo('dropdown-cart', 'render');
    }

    public function delete($rowID){
        Cart::remove($rowID);
        $this->emitTo('cart-mobil', 'render');
        $this->emitTo('dropdown-cart', 'render');
    }

    public function render()
    {
        return view('livewire.shopping-cart');
    }

    public function applyCoupon()
{
    // Lógica para aplicar el cupón
    // Esto es solo un ejemplo, debes reemplazarlo con tu lógica real
    $coupon = Coupon::where('code', $this->coupon_code)->first();
    if ($coupon) {
        // Aplicar el descuento al total del carrito
        $discount = $coupon->discount;
        $totalWithDiscount = Cart::subtotal() - (Cart::subtotal() * $discount / 100);
    } else {
        // Cupón no válido, mostrar mensaje de error o manejarlo según tus necesidades
    }
}
}
