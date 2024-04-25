<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Support\Invoice;

class DownloadInvoiceController extends Controller
{
    public function __invoke()
    {
        return Invoice::download();
    }
}