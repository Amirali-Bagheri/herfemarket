<?php

namespace Modules\Payment\Http\Livewire\Admin;

use App\Exports\DatatableExport;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Core\Http\Livewire\BaseComponent;
use Modules\Core\Http\Livewire\CRUD\DatatableTrait;
use Modules\Payment\Entities\Invoice;

class InvoiceList extends BaseComponent
{
    use DatatableTrait;

    public function toggleSelectAll()
    {
        if (count($this->selected) ===
            Invoice::search($this->search)->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')->count()) {
            $this->selected = [];
        } else {
            $this->selected = Invoice::search($this->search)->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')->get()
                                     ->pluck('id')->values()->toArray();
        }
        $this->forgetComputed();
    }

    public function export()
    {
        $this->forgetComputed();

        return Excel::download(new DatatableExport(Invoice::search($this->search)
                                                          ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                                                          ->get()), date('Ymd') . '_invoices.xlsx');
    }

    public function deleteAll()
    {
        $this->forgetComputed();

        Invoice::whereIn('id', $this->selected)->delete();

        self::alert('success', 'انجام شد', [
            'position'          => 'bottom-start',
            'timer'             => 3000,
            'toast'             => true,
            'text'              => 'عملیات با موفقیت انجام شد',
            'showCancelButton'  => false,
            'showConfirmButton' => false,
        ]);
    }

    public function destroy($id): void
    {
        $payment = Invoice::findOrFail($id);
        $payment->delete();

        $this->alert('success', 'انجام شد', [
            'position'          => 'bottom-start',
            'timer'             => 3000,
            'toast'             => true,
            'text'              => 'عملیات با موفقیت انجام شد',
            'showCancelButton'  => false,
            'showConfirmButton' => false,
        ]);
    }

    public function render()
    {
        $invoices = Invoice::search($this->search)->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                           ->paginate($this->perPage);

        return view('payment::livewire.admin.invoice-list', [
            'invoices' => $invoices,
        ])->extends('admin.layouts.master', ['pageTitle' => 'مدیریت پرداخت ها']);
    }
}
