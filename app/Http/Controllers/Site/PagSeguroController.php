<?php


namespace App\Http\Controllers\Site;

use App\Enums\Gateway;
use App\Enums\InvoicePaymentType;
use App\Enums\InvoiceStatus;
use App\Enums\InvoiceTransactionStatus;
use App\Invoice;
use App\InvoiceTransaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PagSeguroController
{
    /**
     * @param $infor
     */
    public static function notification($infor)
    {
        DB::beginTransaction();
        try {
            $invoiceId = $infor->getReference();

            Log::info('Notificação Pagseguro', ['invoice_id' => $invoiceId]);

            $invoice = Invoice::find($invoiceId);

            $invoiceTransaction = new InvoiceTransaction();
            $invoiceTransaction->invoice_id = $invoiceId;
            $invoiceTransaction->code = $infor->getCode();
            $invoiceTransaction->gateway = Gateway::PAGSEGURO;
            $invoiceTransaction->customer_id = $invoice->customer_id;
            $invoiceTransaction->value = $infor->getAmounts()->getGrossAmount();

            $infoStatus = $infor->getStatus();

            switch ($infoStatus->getCode()) {
                case 1:
                    $invoiceTransaction->status = InvoiceTransactionStatus::AWAITING_PAYMENT;
                    break;
                case 2:
                    $invoiceTransaction->status = InvoiceTransactionStatus::REVIEW;
                    break;
                case 3:
                    $invoiceTransaction->status = InvoiceTransactionStatus::PAID;
                    if ($invoice->status != InvoiceStatus::PAID) {
                        $invoice->pay(InvoicePaymentType::PAGSEGURO);
                    }
                    break;
                case 4:
                    $invoiceTransaction->status = InvoiceTransactionStatus::AVAILABLE;
                    if ($invoice->status != InvoiceStatus::PAID) {
                        $invoice->pay(InvoicePaymentType::PAGSEGURO);
                    }
                    break;
                case 5:
                    $invoiceTransaction->status = InvoiceTransactionStatus::DISPUTED;
                    break;
                case 6:
                    $invoiceTransaction->status = InvoiceTransactionStatus::REVERSED;
                    $invoice->cancel();
                    break;
                case 7:
                    $invoiceTransaction->status = InvoiceTransactionStatus::CANCELED;
                    $invoice->cancel();
                    break;
            }

            $invoiceTransaction->save();

            DB::commit();

            Log::info('Notificação Pagseguro', [
                'invoiceTransaction' => $invoiceTransaction
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Notificação Pagseguro', [
                'invoice_id' => $infor->getReference(),
                'message' => $e->getMessage(),
                'exception' => $e
            ]);
        }
    }
}