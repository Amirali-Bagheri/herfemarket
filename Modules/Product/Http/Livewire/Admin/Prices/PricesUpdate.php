<?php

namespace Modules\Product\Http\Livewire\Admin\Prices;

use Modules\Core\Http\Livewire\BaseComponent;

class PricesUpdate extends BaseComponent
{
    public $price;

    public function pricing()
    {
    }

    public function render()
    {
        return view('product::admin.prices.livewire.prices_update');
    }
}
