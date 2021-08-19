<?php

namespace App\Http\Controllers\Admin;

use App\Enums\InvoicePaymentType;
use DateTime;
use App\CustomerProfile;
use App\Enums\InvoiceStatus;
use App\Enums\InvoiceType;
use App\Http\Controllers\Controller;
use App\Invoice;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Invoice::query();
        $this->filters($query, $request);

        $invoices = $query->orderBy('invoices.id', 'desc')->paginate(20);
        foreach ($invoices as &$invoice) {
            $invoice->status_description = InvoiceStatus::getDescription($invoice->status);
            $invoice->type_description = InvoiceType::getDescription($invoice->type);
        }

        $data['invoices'] = $invoices;
        $data['filters'] = $request->all();
        $data['breadcrumb'] = [
            'Faturas' => route('invoices')
        ];

        $data['listTypes'] = InvoiceType::getInstances();
        $data['listStatus'] = InvoiceStatus::getInstances();

        return view('admin.invoice.index', $data);
    }

    /**
     * @param Builder $query
     * @param Request $request
     * @return array
     */
    private function filters(Builder $query, Request $request)
    {
        $filters = [];

        if (!empty($request->invoice_id)) {
            $query->whereId($request->invoice_id);
        }

        if (is_numeric($request->type)) {
            $query->whereType($request->type);
        }

        if (is_numeric($request->status)) {
            $query->whereStatus($request->status);
        }

        if (!empty($request->cpf)) {
            $customerProfile = CustomerProfile::query()->where('cpf', $request->cpf)->first();
            $query->where('customer_id', $customerProfile->customer_id ?? 0);
        }

        if (!empty($request->start_created_at) && !empty($request->end_created_at)) {
            $query
                ->whereDate('created_at', '>=', $request->start_created_at, 'and')
                ->whereDate('created_at', '<=', $request->end_created_at)
                ->get();
        }

        if (!empty($request->start_payment_at) && !empty($request->end_payment_at)) {
            $query
                ->whereDate('payment_at', '>=', $request->start_payment_at, 'and')
                ->whereDate('payment_at', '<=', $request->end_payment_at)
                ->get();
        }

        return $filters;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  Invoice $invoice
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice)
    {
        $canPay = false;
        $canCancel = false;
        if ($invoice->status == InvoiceStatus::PENDING || $invoice->status == InvoiceStatus::AWAITING_CONFIRMATION) {
            $canPay = true;
        }

        if ($invoice->status == InvoiceStatus::PENDING || $invoice->status == InvoiceStatus::PAID || $invoice->status == InvoiceStatus::AWAITING_CONFIRMATION) {
            $canCancel = true;
        }

        $data['canPay'] = $canPay;
        $data['canCancel'] = $canCancel;
        $data['invoice'] = $invoice;
        $data['invoicePaymentType'] = InvoicePaymentType::getManualPaymentInstances();
        $data['title'] = 'Detalhes da Fatura';
        $data['typeOrder'] = InvoiceType::ORDER;
        $data['statusCancel'] = InvoiceStatus::CANCELED;
        $data['statusPending'] = InvoiceStatus::PENDING;
        $data['breadcrumb'] = [
            'Faturas' => route('invoices'),
            'Detalhes da Fatura' => route('invoice.show', $invoice->id)
        ];

        return view('admin.invoice.details', $data);
    }

    /**
     * @param Invoice $invoice
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function cancel(Invoice $invoice, Request $request)
    {
        DB::beginTransaction();
        try {
            $invoice->cancel($request->reason);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();

            return back()->withErrors($e->getMessage());
        }

        return redirect()->route('invoices')->withSuccess('Fatura cancelada com sucesso!');
    }

    /**
     * @param Request $request
     * @param Invoice $invoice
     * @return \Illuminate\Http\RedirectResponse
     */
    public function payManually(Request $request, Invoice $invoice)
    {
        $request->validate([
            'payment_type' => 'required|integer'
        ]);

        DB::beginTransaction();
        try {
            $invoice->pay($request->payment_type);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();

            return back()->withErrors($e->getMessage());
        }

        return back()->withSuccess('Fatura paga com sucesso!');
    }
}
