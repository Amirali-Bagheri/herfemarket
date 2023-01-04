<?php

namespace App\Http\Livewire\Dashboard;

use Modules\Core\Http\Livewire\BaseComponent;
use Modules\Core\Http\Livewire\Layouts\HeaderTrait;
use Modules\Product\Entities\Product;

class Dashboard extends BaseComponent
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
        $this->user = auth()->user();
    }


    public function render()
    {
        $user = auth()->user();
        $business = $user->business;

        if (! empty($business)) {
            $products = Product::query()->where('business_id', $business->id)->where('isService', 0)->paginate(10);
        }

        return view('site.dashboard.index', [
            'products' => $products ?? [],
        ])->extends('site.layouts.master', [
            'pageTitle' => 'داشبورد',
        ]);
    }
}
