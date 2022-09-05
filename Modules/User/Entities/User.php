<?php

namespace Modules\User\Entities;

use App\Events\NewUserRegistered;
use App\Models\Model;
use App\Notifications\SMSNotification;
use Bavix\Wallet\Interfaces\Wallet;
use Bavix\Wallet\Traits\HasWallet;
use Bavix\Wallet\Traits\HasWallets;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Modules\Business\Entities\Business;
use Modules\Comments\Entities\Comment;
use Modules\Inquiry\Entities\Inquiry;
use Modules\Payment\Entities\Invoice;
use Modules\Payment\Entities\Payment;
use Modules\Rating\Entities\Rating;
use Modules\Report\Entities\Report;
use Modules\Setting\Entities\Setting;
use Modules\Ticket\Entities\Ticket;
use Modules\Ticket\Entities\TicketDepartment;
use Modules\Ticket\Entities\TicketReply;
use Modules\Todo\Entities\Task;
use Modules\Voucher\Traits\CanRedeemVouchers;
use Modules\Wishlist\Traits\HasWishlists;
use Spatie\Permission\Traits\HasRoles;

class User extends Model implements
    AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract,
    \Illuminate\Contracts\Auth\MustVerifyEmail
{
    use Authenticatable;
    use Authorizable;
    use CanResetPassword;
    use MustVerifyEmail;
    use HasWishlists;
    use Notifiable;
    use HasRoles;

    protected $searchable = [
        'first_name',
        'last_name',
        'email',
        'mobile',
    ];

    protected $appends = ['avatar_url', 'full_name', 'role_name', 'status_name', 'last_login_at_human_ago', 'created_at_human_ago', 'created_at_human'];

    protected $guarded = ['id'];

    protected $casts = [
        'mobile_verified_at' => 'datetime',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'updated_at',
    ];

    protected $dispatchesEvents = [
        'creating' => NewUserRegistered::class,
    ];

    public static function search($query)
    {
        return empty($query) ? static::query()
            : static::where('transaction_id', 'like', '%' . $query . '%')
                ->orWhere('user_id', 'like', '%' . $query . '%')
                ->orWhere('price', 'like', '%' . $query . '%')
                ->orWhere('order_id', 'like', '%' . $query . '%')
                ->orWhere('card_number', 'like', '%' . $query . '%')
                ->orWhere('track_id', 'like', '%' . $query . '%');
    }

    protected static function booted()
    {
        static::created(function ($model) {
            $model->update([
                'marketing_code' => 'SHAGO'.random_code(4),
            ]);
            $model->update([
                'md5' => md5($model->id),
            ]);
        });
        static::retrieved(function ($model) {
            if (empty($model->marketing_code)) {
                $model->update([
                    'marketing_code' => 'SHAGO'.random_code(4),
                ]);
            }
//            $model->update([
//                'md5' => md5($model->id),
//            ]);
        });
    }

    public function generateRandomString($length = 10, $only_characters = false)
    {
        if ($only_characters) {
            $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        } else {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        }
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::needsRehash($password) ? Hash::make($password) : $password;
        //        $this->attributes['password'] = bcrypt($password);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'user_id', 'id');
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function scopeInactive($query)
    {
        return $query->where('status', 0);
    }

    public function getFullNameAttribute()
    {
        return ($this->attributes['first_name'] ?? null) . ' ' . ($this->attributes['last_name'] ?? null);
    }

    public function getRoleNameAttribute()
    {
        return $this->roles->pluck('title')->implode(', ');
    }

    public function getStatusNameAttribute()
    {
        return $this->showStatus();
    }

    public function showStatus()
    {
        switch ($this->attributes['status']) {
            case 1:
                return 'فعال';
                break;
            case 0:
                return 'غیر فعال';
                break;
        }
    }

    public function getAvatarUrlAttribute()
    {
        return $this->attributes['avatar'] ? '/uploads/avatars/' . $this->attributes['avatar'] : '/uploads/avatars/avatar.png';
    }

    public function getLastLoginAtHumanAgoAttribute()
    {
        return $this->attributes['last_login_at'] !== null ? verta($this->attributes['last_login_at'])->timezone('Asia/Tehran')->formatDifference() : '-';
    }

    public function roleName()
    {
        if ($this->hasRole('admin')) {
            return 'ادمین';
        } elseif ($this->hasRole('seller')) {
            return 'فروشنده';
        } elseif ($this->hasRole('marketer')) {
            return 'بازاریاب';
        } elseif ($this->hasRole('member')) {
            return 'خریدار';
        }
    }

    public function hasVerifiedPhone()
    {
        return !is_null($this->mobile_verified_at);
    }

    public function hasBusiness()
    {
        return !is_null($this->business);
    }

    public function isBusinessSeller()
    {
        return !is_null($this->business) and $this->hasRole('seller') and $this->business->isActive();
    }

    public function markPhoneAsVerified()
    {
        return $this->forceFill([
            'mobile_verified_at' => $this->freshTimestamp(),
        ])->save();
    }

    public function callToVerify()
    {
        $code = mt_rand(1000, 9999);

        $this->forceFill([
            'verification_code' => $code,
        ])->save();
        $welcome = Setting::get('register_welcome_message_text');
        $watermark = Setting::get('site_description');

        $text = Str::of(
            <<<EOD
$welcome
کد فعال سازی: $code

$watermark
EOD
        );

        $this->notify(new SMSNotification($this->attributes['mobile'], $text));
    }

    public function getGravatarAttribute()
    {
        $hash = md5(strtolower(trim($this->attributes['email'])));

        return "http://www.gravatar.com/avatar/$hash";
    }

    public function business()
    {
        return $this->hasOne(Business::class, 'manager_id', 'id');
    }
    public function businesses()
    {
        return $this->hasMany(Business::class, 'manager_id', 'id');
    }

    public function inquiries()
    {
        return $this->hasMany(Inquiry::class);
    }

    public function reports()
    {
        return $this->hasMany(Report::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'user_id', 'id');

//        return $this->morphMany(Payment::class, 'paymentable');
    }

    public function tasks()
    {
        return $this->hasMany(Task::class, 'user_id', 'id');
    }

    public function departments()
    {
        return $this->belongsToMany(TicketDepartment::class, 'ticket_departments_user');
    }

    public function ticket_replies()
    {
        return $this->hasMany(TicketReply::class);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
}