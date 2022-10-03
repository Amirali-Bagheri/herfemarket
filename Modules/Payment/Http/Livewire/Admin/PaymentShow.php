<?php

namespace Modules\Payment\Http\Livewire\Admin;

use Modules\Core\Http\Livewire\BaseComponent;
use Modules\Payment\Entities\Payment;

class PaymentShow extends BaseComponent
{
    public $payment;

    public function mount($id)
    {
        $this->payment = Payment::findOrFail($id);
    }

    public function export()
    {
        //        view()->share('payment',$this->payment);
        //        $pdf = \PDF::loadView('payment::admin.show', [
        //            'payment'=>$this->payment,
        //            'user'=>$this->payment->user,
        //            'business'=>$this->payment->user->business ?? null,
        //        ]);
        //
        //        return $pdf->download('payment_'.$this->payment->order_id.'.pdf');
    }

    public function render()
    {
        return view('payment::admin.show', [
            'user'     => $this->payment->user,
            'business' => $this->payment->user->business ?? null,
        ])->extends('admin.layouts.master', ['pageTitle' => 'مشاهده فاکتور پرداخت']);
    }
}
