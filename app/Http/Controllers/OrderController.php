<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;


use App\Mail\BoletaFromPay;
use App\Mail\BoletaFromPayAdmin;
use Illuminate\Support\Facades\Mail;

use Illuminate\Support\Facades\Http;

class OrderController extends Controller
{

    public function index()
    {

        $orders = Order::query()->where('user_id', auth()->user()->id)->orderBy('id', 'desc');

        if (request('status')) {
            $orders->where('status', request('status'));
        }

        $orders = $orders->get();


        $pendiente = Order::where('status', 1)->where('user_id', auth()->user()->id)->count();
        $recibido = Order::where('status', 2)->where('user_id', auth()->user()->id)->count();
        $enviado = Order::where('status', 3)->where('user_id', auth()->user()->id)->count();
        $entregado = Order::where('status', 4)->where('user_id', auth()->user()->id)->count();
        $anulado = Order::where('status', 5)->where('user_id', auth()->user()->id)->count();


        // dd($orders);

        return view('orders.index', compact('orders', 'pendiente', 'recibido', 'enviado', 'entregado', 'anulado'));
    }

    public function show(Order $order)
    {

        $this->authorize('author', $order);

        $items = json_decode($order->content);
        $envio = json_decode($order->envio);

        return view('orders.show', compact('order', 'items', 'envio'));
    }


    public function pay(Order $order, Request $request)
    {

        $this->authorize('author', $order);

        $payment_id = $request->get('payment_id');

        // $response = Http::get("https://api.mercadopago.com/v1/payments/$payment_id" . "?access_token=APP_USR-2966754438242803-052115-15da96c087a2fc4d07794f08fe496606-763006654");

        $response = Http::get("https://api.mercadopago.com/v1/payments/$payment_id" . "?access_token=APP_USR-6518375790104201-080519-69473b9992a6e8f6f2b30c0836235c46-768380305");

        $response = json_decode($response);

        $status = $response->status;

        if ($status == 'approved') {
            $order->status = 2;
            $order->pay_method = 'Mercado Pago';
            $order->save();
        }

        $order->status = 2;
        $order->pay_method = 'Mercado Pago';
        $order->save();

        $items = json_decode($order->content);
        $envio = json_decode($order->envio);
        // USER
        Mail::to(auth()->user()->email)->send(new BoletaFromPay(auth()->user()->name, auth()->user()->email, $order->id, $order, $items, $envio, 'Comprobante de pago'));
        // ADMIN
        Mail::to(env('MAIL_FROM_ADM'))->send(new BoletaFromPayAdmin(auth()->user()->name, auth()->user()->email, $order->id, $order, $items, $envio, 'Comprobante de pago'));


        return redirect()->route('orders.show', $order);
    }

    // public function delete(){
    //     Post::where('id', 1)->delete();


    //     // return view('orders.index', compact('orders', 'pendiente', 'recibido', 'enviado', 'entregado', 'anulado'));

    //     return redirect()->route('orders.index');
    // }
}
