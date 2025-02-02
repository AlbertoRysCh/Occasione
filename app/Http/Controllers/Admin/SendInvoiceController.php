<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Support\Invoice;
use App\Notifications\InvoiceNotification;
use Illuminate\Support\Facades\Notification;


class SendInvoiceController extends Controller
{
    public function __invoke()
    {
        // String representation of invoice (binary string) can't be passed as parameter
        // Uncomment lines below and see what the string looks like
        //$binary = Invoice::outputAsBinary();
        //dd($binary);

        $filename = Invoice::filename();

        Notification::route('mail', 'customer@example.test')
            ->notify(new InvoiceNotification($filename));

        return back();
    }
}
