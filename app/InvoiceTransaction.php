<?php

namespace App;

use App\Enums\InvoiceTransactionGateway;
use App\Enums\InvoiceTransactionStatus;
use Illuminate\Database\Eloquent\Model;
use laravel\pagseguro\Config\Config;
use laravel\pagseguro\Platform\Laravel5\PagSeguro;

class InvoiceTransaction extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer()
    {
        return $this->belongsTo('App\Customer');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function invoice()
    {
        return $this->belongsTo('App\Invoice');
    }

    /**
     * @return string
     */
    public function getStatusDescriptionAttribute()
    {
        return InvoiceTransactionStatus::getDescription($this->status);
    }
}