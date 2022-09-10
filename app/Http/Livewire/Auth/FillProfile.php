<?php

namespace App\Http\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Modules\Core\Http\Livewire\BaseComponent;

class FillProfile extends BaseComponent
{
    public $mobile;
    public $name;
    public $email;
    public $user;
    public $register_business;
    public $is_register_business;
    public $first_name;
    public $last_name;
    public $password;
    public $password_confirmation;
    public $recaptcha;

//    public $company_name;
//    public $economic_code;

    public function mount()
    {
        $this->user = Auth::user();

        $this->mobile = $this->user->mobile;
        $this->email = $this->user->email;
        $this->first_name = $this->user->first_name;
        $this->last_name = $this->user->last_name;
//        $this->company_name = $this->user->company_name;
//        $this->economic_code = $this->user->economic_code;


        $this->register_business = session('register_business');
        $this->is_register_business = !empty($this->register_business);
    }

    public function submitMarketing()
    {
        $this->redirect(route('dashboard.marketer.index'));
    }

    public function rejectMarketing()
    {
        $this->redirect(route('dashboard'));
    }

    public function submit()
    {
        if (empty($this->user->name)) {
            $this->validate([
                'first_name' => 'required|max:255',
                'last_name' => 'required|max:255',
            ]);
            $this->user->first_name = $this->first_name;
            $this->user->last_name = $this->last_name;
        }

        if (empty($this->user->mobile)) {
            $this->validate([
                'mobile' => 'required|max:12|regex:/[0-9]{10}/|digits:11|unique:users,mobile',
            ]);
            $this->user->mobile = $this->mobile;
        }

        if (empty($this->user->password)) {
            $this->validate([
                'password' => 'required|min:6|confirmed',
            ]);
            $this->user->password = $this->password;
        }

        if (empty($this->user->email)) {
            $this->validate([
                'email' => 'nullable|sometimes|unique:users,email,' . $this->user->id,
            ]);
            $this->user->email = $this->email;
        }

//        $this->user->update([
//            'company_name' => $this->company_name ?? null,
//            'economic_code' => $this->economic_code ?? null,
//        ]);
//        $this->user->company_name = $this->company_name;
//        $this->user->economic_code = $this->economic_code;

        $this->user->save();

//        event(new Registered($this->user));

        if (!$this->is_register_business) {
            $this->alert('success', 'پروفایل با موفقیت تکمیل شد', [
                'position' => 'bottom-start',
                'timer' => 3000,
                'toast' => true,
                'showCancelButton' => false,
                'showConfirmButton' => false,
            ]);

            return redirect()->route('dashboard')->with(['marketing_modal' => true]);

//            $this->redirect(route('dashboard'));
        }
        $this->flash('success', 'پروفایل با موفقیت تکمیل شد', [
                'position' => 'bottom-start',
                'timer' => 3000,
                'toast' => true,
                'showCancelButton' => false,
                'showConfirmButton' => false,
            ]);
        if ($this->register_business == 'offline_business') {
            $this->redirect(route('register.offline.business'));
        } elseif ($this->register_business == 'online_business') {
            $this->redirect(route('register.online.business'));
        } else {
            return redirect()->route('dashboard')->with(['marketing_modal' => true]);

//                $this->redirect(route('dashboard'));
        }
    }


    public function render()
    {
        return view('auth.fill-profile')->extends('dashboard.layouts.master', [
            'pageTitle' => 'تکمیل اطلاعات کاربری',
        ]);
    }
}
