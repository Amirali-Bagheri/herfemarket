<?php

namespace App\Http\Livewire\Site\Layouts;

use Cart;
use Modules\Core\Http\Livewire\BaseComponent;
use Modules\Core\Http\Livewire\Layouts\HeaderTrait;

class Header extends BaseComponent
{
    use HeaderTrait;

    public $q;

    public function search()
    {
        $this->redirect(route('site.products') . '?search=' . $this->q);
    }

    public function removeCart($hash)
    {
        $shoppingCart = Cart::name('shopping');
        $shoppingCart->removeItem($hash);

        $this->alert('success', 'محصول مورد نظر از سبد خرید حذف شد', [
            'timer'             => 3000,
            'showCancelButton'  => false,
            'showConfirmButton' => false,
            'toast'             => true,
            'position'          => 'bottom-start',
        ]);
    }

    public function render()
    {
        return view('site.layouts.header', [
            'cart' => Cart::name('shopping'),
            'items' => \Cart::name('shopping')->getItems(),
        ]);
    }
}
