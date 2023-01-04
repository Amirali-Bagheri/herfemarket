<?php

namespace Modules\Payment\Entities;

use App\Models\Model;
use Modules\Product\Entities\Product;

class InvoiceLine extends Model
{
    protected $guarded = [];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
