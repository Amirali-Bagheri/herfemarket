<?php

namespace Modules\User\Http\Livewire\Admin;

use Livewire\WithFileUploads;
use Modules\Core\Http\Livewire\BaseComponent;
use Modules\User\Entities\User;

class Update extends BaseComponent
{
    use WithFileUploads;

    public $user;
    public $first_name;
    public $last_name;
    public $name;
    public $mobile;
    public $mobile_approve = true;
    public $email;
    public $newsletter_subscribe = true;
    public $password;
    public $password_confirmation;
    public $status = true;
    public $phone;
    public $avatar;
//    public $plan_id;
    public $roles = [];

    public function mount($id)
    {
        $this->user                 = User::find($id);
        $this->name                 = $this->user->name;
        $this->first_name           = $this->user->first_name;
        $this->last_name            = $this->user->last_name;
        $this->mobile               = $this->user->mobile;
        $this->mobile_approve       = !empty($this->user->mobile_verified_at);
        $this->email                = $this->user->email;
        $this->newsletter_subscribe = $this->user->newsletter_subscribe;
        $this->status               = $this->user->status;
        $this->phone                = $this->user->phone;
        $this->roles                = $this->user->roles->pluck('name')->toArray();
    }

    public function submit()
    {
        $this->validate([
            'first_name' => 'required',
            'last_name' => 'required',
//            'name'     => 'required',
            'mobile' => 'sometimes|required|max:12|regex:/[0-9]{10}/|digits:11|unique:users,mobile,' . $this->user->id . ',id',
            'email' => 'sometimes|nullable|email|unique:users,email,' . $this->user->id . ',id',
            'password' => 'nullable|min:6|confirmed',
            'avatar' => 'nullable|sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $user = User::findOrFail($this->user->id);

        if ($this->password) {
            $user->password = $this->password;
        }

        $user->update([
             'first_name' => $this->first_name,
             'last_name' => $this->last_name,
            'name' => $this->name,
            'email' => $this->email,
            'mobile' => $this->mobile,
            'mobile_verified_at' => $this->mobile_approve ? now() : null,
            'newsletter_subscribe' => $this->newsletter_subscribe,
            'status' => $this->status,
            //            'phone' => $this->phone,
        ]);

        if ($this->avatar) {
            $filename = $user->id . '_avatar_' . time() . '.' . $this->avatar->extension();
            $this->avatar->storeAs('/uploads/avatars', $filename);
            $user->avatar = $filename;
            //            $avatar = $this->avatar->file('avatar');

            //            $basename = $avatar->getClientOriginalName();
            //            $extension = $avatar->getClientOriginalExtension();
            //            $avatarName = $user->id . '_avatar' . time() . '.' . basename($basename, '.' . $extension);
            //            $slug = Str::slug($avatarName, '-');
            //            $this->avatar->storeAs('avatars', $slug . '.' . $extension, 'uploads');
            //            $user->avatar = $slug . '.' . $extension;
        }

        if ($this->roles) {
            $user->syncRoles($this->roles);
            $user->assignRole($this->roles);
        }

//        if (!empty($this->plan_id)) {
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
//
//        }

        //        if ($request['birth-day'] && $request['birth-month'] && $request['birth-year']) {
        //            $date = Verta::getGregorian($request['birth-year'], $request['birth-month'], $request['birth-day']);
        //
        //            $user->birth = Carbon::create($date[0], $date[1], $date[2]);
        //        }

        $user->save();

        $this->alert('success', 'عملیات با موفقیت انجام شد', [
            'position' => 'bottom-start',
            'timer' => 3000,
            'toast' => true,
            'showCancelButton' => false,
            'showConfirmButton' => false,
        ]);
    }

    public function render()
    {
        return view('user::livewire.update')->extends('admin.layouts.master', [
            'pageTitle' => 'ویرایش کاربر ' . $this->user->full_name,
        ]);
    }
}
