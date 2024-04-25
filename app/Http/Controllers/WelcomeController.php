<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Subbanner;
use App\Models\Order;

class WelcomeController extends Controller
{
    public function __invoke()
    {
        // $mensaje = "¡EMPEZÓ BLACK FRIDAY en Tiendamia! Hasta 90% dscto + ENVÍO INTL GRATIS  <a class='font-bold' href='" . route('orders.index') ."?status=1'>Ver Ofertas</a>";

        // session()->flash('flash.banner', $mensaje);

        if (auth()->user()) {

            $pendiente = Order::where('status', 1)->where('user_id', auth()->user()->id)->count();

            if ($pendiente) {

                $mensaje = "Usted tiene $pendiente ordenes pendientes. <a class='font-bold' href='" . route('orders.index') ."?status=1'>Ir a pagar</a>";

                session()->flash('flash.banner', $mensaje);
            }

        }

        $categories = Category::all();
        $subbanner = Subbanner::all();

        return view('welcome', compact('categories','subbanner'));
    }
}
