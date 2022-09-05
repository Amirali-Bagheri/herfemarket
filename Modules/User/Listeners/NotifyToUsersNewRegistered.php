<?php

namespace Modules\User\Listeners;

use App\Services\Telegram\Methods\Bot;
use App\Services\Telegram\Methods\SendMessage;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use Modules\User\Events\NewUserCreated;
use Modules\User\Notifications\SendWellcomeRegisterUser;
use Throwable;

class NotifyToUsersNewRegistered implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle(NewUserCreated $event)
    {
        try {
            $user = $event->user;

            $bot = new Bot('1190195935:AAG_ykn8pcR05Ks0LkNE69XlybK9UGOJ8ro');
            $bot->sendMessage(new SendMessage('105627554', $user->name));

            $to_name = $user->name;
            $to_email = $user->email;
            $data = [
                'name' => $user->name,
                "text" => '
با تشکر از این که از پلتفرم هوشمند یکی لینک استفاده می کنید.
 <br>
 <br>
 ثبت نام شما با موفقیت انجام شد. برای استفاده و ورود به پلتفرم بر روی دکمه زیر کلیک کنید.

<div style="text-align: center;">
<br>
<br>
           <button class="btn btn-primary"><a href="https://panel.shago.ir">داشبورد</a></button>
</div>


           ',
            ];

            Mail::send('mail.template', $data, function ($message) use ($to_name, $to_email) {
                $message->to($to_email, $to_name)
                    ->subject('خوش آمدید');
                $message->from('no-reply@shago.ir', 'Yeki Link');
            });

            // Mail::to()->send(new Gmail($details));

            $event->user->notify(new SendWellcomeRegisterUser());
            /*
            Notification::send(User::role('admin')->get(), new NewBusinessNotification($event->business));
            $manager = $event->business->manager;

            $watermark = Setting::get('site_description');

            foreach (User::role('admin')->get() as $user) {

                $user->notify(new SMSNotification($user->mobile, Str::of(<<<EOD
کسب و کار جدیدی ثبت گردید.

$watermark
EOD
                )));
            }


            $manager->notify(new SMSNotification($manager->mobile, Str::of(<<<EOD
همکار گرامی، کسب و کار شما ثبت گردید.

$watermark
EOD
            )));

*/
        } catch (Throwable $ex) {
            $bot = new Bot('1190195935:AAG_ykn8pcR05Ks0LkNE69XlybK9UGOJ8ro');
            $bot->sendMessage(new SendMessage('105627554', $ex->getMessage() . ' ' .
                $ex->getFile() . ' ' . $ex->getLine()));

            throw $ex;
        }
    }
}
