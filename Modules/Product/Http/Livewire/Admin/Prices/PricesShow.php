<?php

namespace Modules\Product\Http\Livewire\Admin\Prices;

use Modules\Core\Http\Livewire\BaseComponent;

class PricesShow extends BaseComponent
{
    public $price;

    public function mount($price)
    {
        $this->price = $price;
    }

    public function pricing()
    {
    }

    public function render()
    {
        dd($this->price->visits()->count());
        return view('product::admin.prices.livewire.prices_show');
    }
}
