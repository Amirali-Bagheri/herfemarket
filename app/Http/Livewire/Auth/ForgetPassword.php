<?php

namespace App\Http\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Jenssegers\Agent\Facades\Agent;
use Modules\User\Entities\User;
use Modules\User\Traits\LivewireOtpVerify;

class ForgetPassword extends \Modules\Core\Http\Livewire\BaseComponent
{
    use LivewireOtpVerify;

    public $isResetPassword = false;
    public $password;
    public $password_confirmation;

    public function mount()
    {
        $this->mobile = session('mobile');

        if (!empty($this->mobile)) {
            $this->sendCode();
        }

        $this->otp = null;
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
                return view('auth.verify-enter-mobile')->extends('mobile.layouts.master', ['pageTitle' => 'فراموشی رمز عبور']);
            }
            return view('auth.verify-enter-mobile')->extends('site.layouts.master', ['pageTitle' => 'فراموشی رمز عبور']);
        }
        $this->user = User::where('mobile', $this->mobile)->first();

        if ($this->isResetPassword) {
            if (Agent::isMobile()) {
                return view('livewire.auth.reset-password')->extends('mobile.layouts.master', ['pageTitle' => 'تغییر رمز عبور']);
            }
            return view('livewire.auth.reset-password')->extends('site.layouts.master', ['pageTitle' => 'تغییر رمز عبور']);
        }
        if (\Agent::isMobile()) {
            return view('auth.verify-otp-mobile')->extends('mobile.layouts.master', ['pageTitle' => 'فراموشی رمز عبور']);
        }
        return view('auth.verify-otp-mobile')->extends('site.layouts.master', ['pageTitle' => 'فراموشی رمز عبور']);
    }

    public function submit()
    {
        if ($this->isResetPassword) {
            $this->validate([
                'password' => 'required|confirmed',
            ]);

            $this->user->update([
                'password' => $this->password,
            ]);

            $this->user->save();

            Auth::login($this->user);

            self::flash('success', 'رمز عبور شما با موفقیت تغییر کرد', [
                'position' => 'bottom-start',
                'toast' => true,
                'timer' => 3000,
                'showCancelButton' => false,
                'showConfirmButton' => false,
            ]);

            $this->redirect('/');
        } else {
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
                    $this->isResetPassword = true;
                    session()->put('mobile', $this->mobile);

//                $this->redirect(route('password.reset'));
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
}
