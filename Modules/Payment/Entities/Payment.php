<?php

namespace Modules\Payment\Entities;

use App\Models\Model;
use Bavix\Wallet\Interfaces\Customer;
use Bavix\Wallet\Interfaces\Product;
use Bavix\Wallet\Traits\HasWallet;
use Modules\Payment\Traits\IsInvoicableTrait;
use Modules\Plan\Entities\Plan;
use Modules\Plan\Entities\PlanSubscription;
use Modules\User\Entities\User;

class Payment extends Model implements Product
{
    use HasWallet;
    use IsInvoicableTrait;

    // use Sortable;

    //    use Moderatable;
    //    const MODERATION_STATUS = 'verify_status';

    public $sortable = [
        'id',
        'user_id',
        'status',
        'created_at',
    ];
    protected $guarded = ['id'];
    protected $appends = ['created_at_human_ago', 'created_at_human'];

    public static function search($query)
    {
        return empty($query) ? static::query()
            : static::where('first_name', 'like', '%' . $query . '%')
                ->orWhere('last_name', 'like', '%' . $query . '%')
                ->orWhere('mobile', 'like', '%' . $query . '%')
                ->orWhere('email', 'like', '%' . $query . '%');
    }

    public function paymentable()
    {
        return $this->morphTo();
    }

    // public function business()
    // {
    //     return $this->morphMany(Business::class, 'paymentable')->first();
    // }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function subscription()
    {
        return $this->hasOne(PlanSubscription::class);
    }

    public function showStatus()
    {
        switch ($this->status) {
            case 1:
                echo 'پرداخت نشده';
                break;
            case 2:
                echo 'پرداخت ناموفق';
                break;
            case 3:
                echo 'خطا در پرداخت';
                break;
            case 4:
                echo 'بلوکه شده';
                break;
            case 5:
                echo 'برگشت به پرداخت کننده';
                break;
            case 6:
                echo 'برگشت خورده سیستمی';
                break;
            case 7:
                echo 'انصراف از پرداخت';
                break;
            case 8:
                echo 'انتقال به درگاه پرداخت';
                break;
            case 10:
                echo 'در انتظار تایید پرداخت';
                break;
            case 100:
                echo 'پرداخت موفق';
                break;
            case 101:
                echo 'پرداخت قبلا تایید شده است';
                break;
            case 200:
                echo 'به دریافت کننده واریز شد';
                break;
        }
    }

    public function getTitleAttribute()
    {
        if ($this->paymentable_type == Plan::class) {
            return 'پلن ' . Plan::find($this->paymentable_id)->name;
        }

        return 'بدون عنوان';
    }

    public function canBuy(Customer $customer, int $quantity = 1, bool $force = null): bool
    {
        /**
         * If the service can be purchased once, then
         *  return !$customer->paid($this);
         */
        return true;
        //        return !$customer->paid($this);
    }

    public function getAmountProduct(Customer $customer)
    {
        return $this->attributes['price'];
    }

    public function getMetaProduct(): ?array
    {
        return [
            'title' => 'افزایش موجودی',
            'description' => 'افزایش موجودی کیف پول کاربر: ' . $this->user->name,
        ];
    }

    public function getUniqueId(): string
    {
        return (string)$this->getKey();
    }
}
