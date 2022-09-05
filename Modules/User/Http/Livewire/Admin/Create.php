<?php

namespace Modules\User\Http\Livewire\Admin;

use Livewire\WithFileUploads;
use Modules\Core\Http\Livewire\BaseComponent;
use Modules\User\Entities\User;

class Create extends BaseComponent
{
    use WithFileUploads;

    public $first_name;
    public $last_name;
    public $mobile;
    public $mobile_approve = true;
    public $email;
    public $newsletter_subscribe = true;
    public $password;
    public $password_confirmation;
    public $status = true;
    public $phone;
    public $avatar;
//    public    $plan_id;
    public $roles = [];

    protected $rules = [
        'first_name' => 'required',
        'last_name' => 'required',
        'mobile' => 'required|max:12|regex:/[0-9]{10}/|digits:11|unique:users,mobile',
        'email' => 'nullable|email|unique:users,email',
        'password' => 'required|min:6|confirmed',
        'avatar' => 'nullable|sometimes|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ];

    public function submit()
    {
        $this->validate();

        $user = User::create([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'mobile' => $this->mobile,
            'mobile_verified_at' => $this->mobile_approve ? now() : null,
            'newsletter_subscribe' => $this->newsletter_subscribe,
            'password' => $this->password,
            'status' => $this->status,
            //            'phone' => $this->phone,
        ]);

        if ($this->avatar) {
            $filename = $user->id . '_avatar_' . time() . '.' . $this->avatar->extension();
            $this->avatar->storeAs('/uploads/avatars', $filename);
            $user->avatar = $filename;
        }

        if ($this->roles) {
            $user->syncRoles($this->roles);
            $user->assignRole($this->roles);
        }


//        if ($this->plan_id) {
//            $plan = Plan::find($this->plan_id);
//
//            $subscription      = $user->getSubscription();
//
//            if(empty($subscription)){
//                $user->newSubscription('main',$plan);
//            }else{
//                $subscription->changePlan($plan);
//                $subscription->renew();
//            }
//        }

        //        if ($request['birth-day'] && $request['birth-month'] && $request['birth-year']) {
        //            $date = Verta::getGregorian($request['birth-year'], $request['birth-month'], $request['birth-day']);
        //
        //            $user->birth = Carbon::create($date[0], $date[1], $date[2]);
        //        }

        $user->save();
        $this->resetInput();

        $this->alert('success', 'عملیات با موفقیت انجام شد', [
            'position' => 'bottom-start',
            'timer' => 3000,
            'toast' => true,
            'showCancelButton' => false,
            'showConfirmButton' => false,
        ]);
    }

    private function resetInput()
    {
        $this->first_name = null;
        $this->last_name = null;
        $this->mobile = null;
        $this->mobile_approve = true;
        $this->email = null;
        $this->newsletter_subscribe = true;
        $this->password = null;
        $this->password_confirmation = null;
        $this->status = true;
        $this->phone = null;
        $this->avatar = null;
        $this->roles = [];
    }

    public function render()
    {
        return view('user::livewire.update')->extends('admin.layouts.master', ['pageTitle' => 'کاربر  جدید']);
    }
}
