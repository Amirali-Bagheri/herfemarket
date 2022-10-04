<?php

namespace App\Http\Livewire\Dashboard\Services;

use Carbon\Carbon;
use Hekmatinasser\Verta\Verta;
use Modules\Core\Http\Livewire\BaseComponent;
use Modules\Core\Http\Livewire\Layouts\HeaderTrait;
use Modules\Product\Entities\Product;

class Index extends BaseComponent
{

    public function deleteProduct($id)
    {
        $product = Product::find($id);

        $product->delete();

        $this->flash('success', 'عملیات با موفقیت انجام شد', [
            'timer'             => 3000,
            'showCancelButton'  => false,
            'showConfirmButton' => false,
            'position'          => 'center',
        ]);

        $this->redirect(route('dashboard.services.index'));
    }

    public function render()
    {
        $user              = auth()->user();
        $business          = $user->business;
        $products          = Product::query()->where('business_id', $business->id)->where('isService', 1)->paginate(10);

        return view('site.dashboard.services.index', [
            'products'          => $products,
        ])->extends('site.layouts.master', [
            'pageTitle' => 'فهرست خدمات',
        ]);
    }
}
