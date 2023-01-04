<?php

namespace Modules\Payment\Http\Livewire\Admin\Invoices;

use Modules\Core\Http\Livewire\BaseComponent;
use Modules\Payment\Entities\Invoice;

class InvoiceShow extends BaseComponent
{
    public $invoice;
    public $user;
    public $business;
    public $legal_person = 0;
    
    public function mount($id)
    {
        $this->invoice = Invoice::where('id', $id)->orWhere('invoice_number', $id)->first();
        $this->user = $this->invoice->user ?? null;
        $this->business = $this->user->business ?? null;
        if (!empty($this->user->economic_national_code) or !empty($this->user->economic_code) or !empty($this->user->company_name)) {
            $this->legal_person = 1;
        }
    }

    public function render()
    {
        return view('payment::livewire.admin.invoice-show', [

        ])->extends('admin.layouts.master', [
            'pageTitle' => 'مشاهده صورتحساب',
        ]);
    }
}
