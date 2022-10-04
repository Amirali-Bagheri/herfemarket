<?php

namespace App\Http\Livewire\Site\Businesses;

use Cart;
use Livewire\WithPagination;
use Modules\Business\Entities\Business;
use Modules\Core\Http\Livewire\BaseComponent;
use Modules\Product\Entities\Product;

class BusinessIndex extends BaseComponent
{
    use WithPagination;

    public function render()
    {
        return view('site.businesses.index', [
            'businesses' => Business::where('status', 1)->paginate(10),
        ])->extends('site.layouts.master', [
            'pageTitle' => 'کسب و کار ها',
        ]);
    }
}
