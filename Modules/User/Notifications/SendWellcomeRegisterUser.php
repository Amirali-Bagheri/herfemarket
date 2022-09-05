<?php

namespace Modules\User\Notifications;

use App\Channels\EmailChannel;
use App\Channels\SmsChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Str;

class SendWellcomeRegisterUser extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [
            EmailChannel::class,
            // 'database',
            SmsChannel::class,
        ];
    }

    public function toEmail($notifiable)
    {
        return [
            'subject' => 'به شاگو خوش آمدید',
            'text' => '
با تشکر از این که از پلتفرم شاگو استفاده می کنید.
 <br>
 <br>
 ثبت نام شما با موفقیت انجام شد. برای استفاده و ورود به پلتفرم بر روی دکمه زیر کلیک کنید.

<div style="text-align: center;">
<br>
<br>
           <button class="btn btn-primary"><a href="https://panel.shago.ir">داشبورد</a></button>
</div>


           ',
            'email' => $notifiable->email,
        ];
    }

    public function toSms($notifiable)
    {
        return [
            'text' => Str::of(
                <<<EOD

به پلتفرم هوشمند شاگو خوش آمدید

برای استفاده از امکانات به داشبورد مراجعه نمایید
EOD
            ),
            'mobile' => $notifiable->mobile,
        ];
    }

    // public function toArray($notifiable)
    // {
    //     return [
    //         'link'    => route('dashboard.index'),
    //         // 'message' => 'برای آموزش نحوه استفاده از پلتفرم کلیک کنید',
    //         // 'title' => 'به شاگو خوش آمدید',
    //         'message' => 'به شاگو خوش آمدید',
    //         'icon'    => 'far fa-info',
    //         //
    //         //            'business_id' => $this->business['id'],
    //         //            'manager_id' => $this->business['manager_id'],
    //     ];
    // }
}
