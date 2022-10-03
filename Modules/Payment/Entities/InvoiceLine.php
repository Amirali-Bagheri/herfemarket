<?php

namespace Modules\Payment\Entities;

use App\Models\Model;

class InvoiceLine extends Model
{
    protected $guarded = [];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
}
