<?php

namespace Modules\User\Traits;

use App\Notifications\SMSNotification;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Modules\User\Entities\User;
use Throwable;

trait LivewireOtpVerify
{
    use ThrottlesLogins;

    public $one_time_password;
    public $user;
    public $mobile;
    public $code;
    public $otp;
    public $isOtp = false;
    public $otp_1;
    public $otp_2;
    public $otp_3;
    public $otp_4;
    public $otp_5;
    public $otp_6;

    public function mount()
    {
        $this->mobile = session('mobile');

        $this->otp_1 = null;
        $this->otp_2 = null;
        $this->otp_3 = null;
        $this->otp_4 = null;
        $this->otp_5 = null;
        $this->otp_6 = null;
    }

    public function sendCode()
    {
        $this->validate([
            'mobile' => 'required|max:12|regex:/[0-9]{10}/|digits:11|exists:users'
        ]);

        try {
//            if ( ! empty($this->user->mobile)) {
            $mobile = $this->mobile;
            $this->user = User::firstWhere('mobile', $mobile);
            if (!empty($this->user)) {
                $executed = RateLimiter::attempt(
                    'sms-send-otp:' . (string)$mobile,
                    $perMinute = 1,
                    function () use ($mobile) {
                        $this->code = null;
                        $this->otp_1 = null;
                        $this->otp_2 = null;
                        $this->otp_3 = null;
                        $this->otp_4 = null;
                        $this->otp_5 = null;
                        $this->otp_6 = null;

                        $code = random_int(111111, 999999);
//                    \Cache::set('sms_id_code_' . (string)$mobile, $code, 300);
                        $this->user->update([
                            'verification_code' => $code,
                        ]);

                        $this->user->notify(new SMSNotification($mobile, Str::of(
                            <<<EOD
کد فعال سازی: $code

شاگو، راهنمای هوشمند تو
EOD
                        )));


                        $this->isOtp =true;
                        $this->alert('success', 'کد تایید ارسال شد', [
                            'position' => 'center',
                            'timer' => 3000,
                            'toast' => true,
                            'text' => '',
                            'showCancelButton' => false,
                            'showConfirmButton' => false,
                        ]);
                    }
                );

                if (!$executed) {
                    $this->alert('error', 'قبل از درخواست مجدد برای کد تایید کمی صبر کنید', [
                        'position' => 'center',
                        'timer' => 3000,
                        'toast' => true,
                        'text' => '',
                        'showCancelButton' => false,
                        'showConfirmButton' => false,
                    ]);
                }
            } else {
                $this->alert('error', 'کاربری با این تلفن همراه یافت نشد!', [
                    'position'          => 'center',
                    'timer'             => 3000,
                    'toast'             => true,
                    'text'              => 'لطفا شماره تلفن وارد شده را اصلاح و یا ثبت نام کنید.',
                    'showCancelButton'  => false,
                    'showConfirmButton' => false,
                ]);
                // $this->redirect(route('phoneverification.verify'));
            }
        } catch (Throwable $ex) {
            throw $ex;
            $this->alert('error', 'خطایی در ارسال کد تایید رخ داد', [
                'position' => 'center',
                'timer' => 3000,
                'toast' => true,
                'text' => '',
                'showCancelButton' => false,
                'showConfirmButton' => false,
            ]);
        }
    }

    public function ensureIsNotRateLimited()
    {
        if (!RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this->mobile));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'one_time_password' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    public function throttleKey(): string
    {
        return Str::lower($this->one_time_password) . '|' . request()->ip();
    }

//    public function submit()
//    {
//        $this->validate([
//            'otp' => 'required',
////            'otp_1' => 'required',
////            'otp_2' => 'required',
////            'otp_3' => 'required',
////            'otp_4' => 'required',
////            'otp_5' => 'required',
////            'otp_6' => 'required',
//        ]);
//
//        try {
//
//            $verify_code = $this->otp;
////                number_clean_format($this->otp_1) .
////                number_clean_format($this->otp_2) .
////                number_clean_format($this->otp_3) .
////                number_clean_format($this->otp_4) .
////                number_clean_format($this->otp_5) .
////                number_clean_format($this->otp_6);
//
//            $mobile = $this->user->mobile;
//            $verification_code = $this->user->verification_code;
////            $verification_code = Cache::get('sms_id_code_' . $mobile);
//
//            if ( empty($verification_code)) {
//                $this->flash('error', '!کد وارد شده منقضی شده است', [
//                    'text'              => 'کد دیگری برای تلفن همراه شما ارسال شد',
//                    'position'          => 'center',
//                    'timer'             => 3000,
//                    'showCancelButton'  => false,
//                    'showConfirmButton' => false,
//                ]);
////                $this->redirect(route('phoneverification.verify'));
//            } elseif ((int)$verification_code != (int)$verify_code) {
//                $this->alert('error', '!کد وارد شده اشتباه است', [
//                    'position'          => 'center',
//                    'timer'             => 3000,
//                    'showCancelButton'  => false,
//                    'showConfirmButton' => false,
//                ]);
//            } else {
//                \Auth::login($this->user, true);
//                $this->flash('success', 'ورود با موفقیت انجام شد.', [
//                    'position'          => 'center',
//                    'timer'             => 3000,
//                    'showCancelButton'  => false,
//                    'showConfirmButton' => false,
//                ]);
////                session()->forget('mobile');
////                Cache::forget('sms_id_code_'. (string)$this->mobile);
//
//                $this->redirect(route('dashboard.index'));
//            }
//        } catch (\Throwable $ex) {
//            $this->alert('error', 'خطایی رخ داد!', [
//                'position'          => 'bottom-start',
//                'timer'             => 3000,
//                'toast'             => true,
//                'showCancelButton'  => false,
//                'showConfirmButton' => false,
//            ]);
//
//            throw $ex;
//        }
//
//    }
}
