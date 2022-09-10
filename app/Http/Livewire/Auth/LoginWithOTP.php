<?php

namespace App\Http\Livewire\Auth;

use Modules\Core\Http\Livewire\BaseComponent;
use Modules\User\Entities\User;
use Modules\User\Traits\LivewireOtpVerify;

class LoginWithOTP extends BaseComponent
{
    use LivewireOtpVerify;

    public function mount()
    {
        $this->mobile = session('mobile');

        if (!empty($this->mobile)) {
            $this->sendCode();
        }

        $this->otp_1 = null;
        $this->otp_2 = null;
        $this->otp_3 = null;
        $this->otp_4 = null;
        $this->otp_5 = null;
        $this->otp_6 = null;
    }


    public function render()
    {
        if (!$this->isOtp) {
            if (\Agent::isMobile()) {
                return view('auth.verify-enter-mobile')->extends('mobile.layouts.master', ['pageTitle' => 'ورود با یکبار رمز']);
            }
            return view('auth.verify-enter-mobile')->extends('site.layouts.master', ['pageTitle' => 'ورود با یکبار رمز']);
        }
        $this->user = User::where('mobile', $this->mobile)->first();

        if (\Agent::isMobile()) {
            return view('auth.verify-otp-mobile')->extends('mobile.layouts.master', ['pageTitle' => 'ورود با یکبار رمز']);
        }
        return view('auth.verify-otp-mobile')->extends('site.layouts.master', ['pageTitle' => 'ورود با یکبار رمز']);
    }

    public function submit()
    {
        $this->validate([
            'otp' => 'required',
        ]);

        try {
            $verify_code = $this->otp;
            $verification_code = $this->user->verification_code;

            if (empty($verification_code)) {
                $this->flash('error', '!کد وارد شده منقضی شده است', [
                    'text'              => 'کد دیگری برای تلفن همراه شما ارسال شد',
                    'position'          => 'center',
                    'timer'             => 3000,
                    'showCancelButton'  => false,
                    'showConfirmButton' => false,
                ]);
            } elseif ((int)$verification_code != (int)$verify_code) {
                $this->alert('error', '!کد وارد شده اشتباه است', [
                    'position'          => 'center',
                    'timer'             => 3000,
                    'showCancelButton'  => false,
                    'showConfirmButton' => false,
                ]);
            } else {
                \Auth::login($this->user, true);
                $this->flash('success', 'ورود با موفقیت انجام شد.', [
                    'position'          => 'center',
                    'timer'             => 3000,
                    'showCancelButton'  => false,
                    'showConfirmButton' => false,
                ]);
                $this->redirect(route('dashboard'));
            }
        } catch (\Throwable $ex) {
            $this->alert('error', 'خطایی رخ داد!', [
                'position'          => 'bottom-start',
                'timer'             => 3000,
                'toast'             => true,
                'showCancelButton'  => false,
                'showConfirmButton' => false,
            ]);

            throw $ex;
        }
    }
}
