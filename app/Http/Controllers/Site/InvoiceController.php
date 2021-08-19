<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Invoice;
use App\InvoiceTransaction;
use Exception;

class InvoiceController extends Controller
{
    private $invoice;

    public function __construct()
    {
        $this->invoice = new Invoice();
    }

    public function show(Invoice $invoice)
    {
        return view('site.panel.customer.invoice', compact('invoice'));
    }

    public function checkTransaction()
    {
        $invoiceTransaction = new InvoiceTransaction();
        $invoiceTransaction->checkTransaction();
    }

    /**
     * @param Invoice $invoice
     * @return \Illuminate\Http\RedirectResponse
     */
    public function payWithPagseguro(Invoice $invoice)
    {
        if ($invoice->customer_id != auth()->id()) {
            return back()->withErrors('Fatura não encontrada.');
        }

        try {
            $url = $invoice->payWithPagSeguro();
        } catch (Exception $e) {
            return redirect()->route('panel.order.show', $invoice->order->id)->withErrors($e->getMessage());
        }

        return redirect()->away($url);
    }
}
