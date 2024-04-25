<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Support\Invoice;
use Barryvdh\DomPDF\PDF;

class ShowInvoiceController extends Controller
{
    public function __invoke()
    {

        return view('admin.pdf.invoice', Invoice::attributes());
    }

    public function show(Order $order)
    {

        $items = json_decode($order->content);

        $envio = json_decode($order->envio);

        return view('admin.pdf.show', Invoice::attributes(), compact('order', 'items', 'envio'));
    }

    public function show_detail(Order $orders)
    {

        $items = json_decode($orders->content);

        $envio = json_decode($orders->envio);

        return view('admin.pdf.show_detail', Invoice::attributes(), compact('orders', 'items', 'envio'));
    }

    public function show_pdf(Order $order_pdf)
    {

        $data = [
            'order' => $order_pdf
        ];

        $items = json_decode($order_pdf->content);

        $envio = json_decode($order_pdf->envio);

        $pdf = app('pdf/reportpdf');
        $pdf->loadView('admin.pdf.show_pdf', $data);
        // $pdf = PDF::loadView('pdf/reportpdf', compact('order_pdf', 'items', 'envio'));

        return $pdf->download('report.pdf');
        // return view('admin.pdf.show_detail', Invoice::attributes(), compact('orders', 'items', 'envio'));
    }
}
