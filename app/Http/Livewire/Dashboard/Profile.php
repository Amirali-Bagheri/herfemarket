<?php

namespace App\Http\Livewire\Dashboard;

use Carbon\Carbon;
use Hekmatinasser\Verta\Verta;
use Modules\Core\Http\Livewire\BaseComponent;
use Modules\Core\Http\Livewire\Layouts\HeaderTrait;
use Modules\Product\Entities\Product;

class Profile extends BaseComponent
{
    use HeaderTrait;

    public $first_name;
    public $last_name;
    public $user;
    public $mobile;
    public $email;
    public $password;
    public $password_confirmation;

    public function mount()
    {
        $this->user       = auth()->user();
        $this->first_name = $this->user->first_name;
        $this->last_name  = $this->user->last_name;
        $this->email      = $this->user->email;
        $this->mobile     = $this->user->mobile;
    }

    public function editProfile()
    {

        $this->validate([
            'first_name' => 'required',
            'last_name'  => 'required',
            'email'      => 'nullable|sometimes|unique:users,email,' . $this->user->id,
        ]);

        if ( ! empty($this->password)) {
            $this->validate([
                'password' => 'required|confirmed',
            ]);
        }

        $this->user->update([
            'first_name' => $this->first_name,
            'last_name'  => $this->last_name,
            'email'      => $this->email,
        ]);

        if ( ! empty($this->password)) {
            $this->user->update([
                'password' => $this->password,
            ]);
        }

        $this->user->save();

        $this->alert('success', 'عملیات با موفقیت انجام شد', [
            'position'          => 'center',
            'timer'             => 3500,
            'toast'             => true,
            'text'              => '',
            'showCancelButton'  => false,
            'showConfirmButton' => false,
        ]);
    }

    public function render()
    {
        $user              = auth()->user();
        $business          = $user->business;

        if(!empty($business)){

            $products          = Product::query()->where('business_id', $business->id)->where('isService', 0)->paginate(10);
        }

        return view('site.dashboard.index', [
            'products'          => $products ?? [],
        ])->extends('site.layouts.master', [
            'pageTitle' => 'داشبورد',
        ]);
    }
}
