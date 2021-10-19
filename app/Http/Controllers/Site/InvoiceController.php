<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Invoice;
use App\InvoiceTransaction;

class InvoiceController extends Controller
{
    public function show(Invoice $invoice)
    {
        return view('site.panel.customer.invoice', compact('invoice'));
    }

    public function checkTransaction()
    {
        $invoiceTransaction = new InvoiceTransaction();
        $invoiceTransaction->checkTransaction();
    }
}
