<?php

namespace App\Http\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Modules\User\Entities\User;
use Modules\User\Traits\LivewireOtpVerify;

class VerifyMobile extends \Modules\Core\Http\Livewire\BaseComponent
{
    use LivewireOtpVerify;

    public function mount()
    {
        $this->user = Auth::user();
        $this->mobile = $this->user->mobile;

        if (!empty($this->mobile)) {
            $this->sendCode();
        }

        if ($this->user->hasVerifiedPhone()) {
            $this->redirect(route('dashboard.index'));
        }
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
                $this->user->markPhoneAsVerified();
                \Auth::login($this->user, true);
                $this->flash('success', 'ورود با موفقیت انجام شد.', [
                    'position'          => 'center',
                    'timer'             => 3000,
                    'showCancelButton'  => false,
                    'showConfirmButton' => false,
                ]);
                $this->redirect(route('dashboard.index'));
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

    public function render()
    {
        $this->user = User::where('mobile', $this->mobile)->first();

        if (\Agent::isMobile()) {
            return view('auth.verify-otp-mobile')->extends('mobile.layouts.master', ['pageTitle' => 'تایید شماره تلفن همراه']);
        }
        return view('auth.verify-otp-mobile')->extends('site.layouts.master', ['pageTitle' => 'تایید شماره تلفن همراه']);
    }
}
