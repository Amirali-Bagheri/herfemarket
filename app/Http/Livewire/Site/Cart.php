<?php

namespace App\Http\Livewire\Site;

use Modules\Core\Http\Livewire\BaseComponent;
use Modules\Payment\Entities\Invoice;

class Cart extends BaseComponent
{
    public function removeCart($hash)
    {
        $shoppingCart = \Cart::name('shopping');
        $shoppingCart->removeItem($hash);

        $this->alert('success', 'محصول مورد نظر از سبد خرید حذف شد', [
            'timer'             => 3000,
            'showCancelButton'  => false,
            'showConfirmButton' => false,
            'toast'             => true,
            'position'          => 'bottom-start',
        ]);
    }

    public function payment()
    {
        $cart = \Cart::name('shopping');

        $invoice_number = 'ORDER-' . random_code();
        $invoice        = Invoice::create([
            'isPaymentable'  => true,
            'status'         => 1,
            'currency'       => 'IRR',
            'total'          => price_t2r((int) number_clean_format($cart->getSubtotal())),
            'tax'            => 0,
            'invoice_number' => $invoice_number,
            'user_id' => auth()->id(),
        ]);

        foreach (\Cart::name('shopping')->getItems() as $item) {
            $invoice->lines()->create([
                'amount'      => price_t2r((int) $item->getPrice()),
                'description' => $item->getTitle(),
                'product_id' => $item->getId(),
            ]);
        }

        \Cart::name('shopping')->clearItems();

        $this->redirect(route('dashboard.orders.show', $invoice->invoice_number));

        // $this->alert('success', 'سفارش شما با موفقیت ثبت شد.', [
        //     'position'          => 'center',
        //     'timer'             => 3000,
        //     'toast'             => true,
        //     'text'              => 'شماره سفارش شما: ' . $invoice_number,
        //     'showConfirmButton' => true,
        //     'onConfirmed'       => '',
        // ]);
    }

    public function render()
    {

        return view('site.cart', [
            'cart'  => \Cart::name('shopping'),
            'items' => \Cart::name('shopping')->getItems(),
        ])->extends('site.layouts.master', [
            'pageTitle' => 'سبد خرید',
        ]);
    }
}
