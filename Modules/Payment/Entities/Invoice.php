<?php

namespace Modules\Payment\Entities;

use App\Models\Model;
use Modules\Payment\Traits\InvoiceTrait;
use Modules\User\Entities\User;

class Invoice extends Model
{
    use InvoiceTrait;

    protected $guarded = [];

    public static function findByReference($reference)
    {
        return static::where('reference', $reference)->first();
    }

    public static function findByReferenceOrFail($reference)
    {
        return static::where('reference', $reference)->firstOrFail();
    }

    public static function search($query)
    {
        return empty($query) ? static::query()
            : static::where('// NOTE: ', 'like', '%' . $query . '%');
    }

    protected static function boot()
    {
        parent::boot();
        //
        // static::creating(function ($model) {
        //     $model->currency  = config('payment.default_currency', 'IRT');
        //     $model->status    = config('payment.default_status', 0);
        //     $model->reference = 'YL-' . verta()->timestamp;
        //     // $model->reference = InvoiceReferenceGenerator::generate();
        // });
    }

    public function getStatusNameAttribute()
    {
        switch ($this->status) {
            case 0:
                return 'پرداخت نشده';
            case 1:
                return 'پرداخت شده';
            case 2:
                return 'لغو شده';
        }
    }

    /**
     * Get the invoice lines for this invoice
     */
    public function lines()
    {
        return $this->hasMany(InvoiceLine::class);
    }

    public function invoicable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function payments()
    {
        return $this->morphedByMany(Payment::class, 'invoicable');
    }

    public function getTotalWithCurrencyAttribute()
    {
        if ($this->attributes['currency'] == 'IRR') {
            return number_format($this->total) . ' ریال';
        } elseif ($this->attributes['currency'] == 'IRT') {
            return number_format($this->total) . ' تومان';
        } else {
            return number_format($this->total);
        }
    }
}
