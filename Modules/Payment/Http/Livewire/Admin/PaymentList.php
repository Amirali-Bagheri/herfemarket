<?php

namespace Modules\Payment\Http\Livewire\Admin;

use App\Exports\DatatableExport;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Core\Http\Livewire\BaseComponent;
use Modules\Core\Http\Livewire\CRUD\DatatableTrait;
use Modules\Payment\Entities\Payment;

class PaymentList extends BaseComponent
{
    use DatatableTrait;

    public $user = null;

    public function mount($user_id = null)
    {
        if (!empty($user_id)) {
            $this->user = \Modules\User\Entities\User::find($user_id);
        }
    }

    public function toggleSelectAll()
    {
        if (count($this->selected) ===
            Payment::search($this->search)->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')->count()) {
            $this->selected = [];
        } else {
            $this->selected = Payment::search($this->search)->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')->get()
                                     ->pluck('id')->values()->toArray();
        }
        $this->forgetComputed();
    }

    public function export()
    {
        $this->forgetComputed();

        return Excel::download(new DatatableExport(Payment::search($this->search)
                                                          ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                                                          ->get()), date('Ymd') . '_payments.xlsx');
    }

    public function deleteAll()
    {
        $this->forgetComputed();

        Payment::whereIn('id', $this->selected)->delete();

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
        $payment = Payment::findOrFail($id);
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

    public function getQuery()
    {
        if (!empty($this->user)) {
            return $this->user->payments()->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')->paginate($this->perPage);
        }

        return Payment::search($this->search)->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                           ->paginate($this->perPage);
    }
    public function render()
    {
        return view('payment::admin.datatable', [
            'payments' => $this->getQuery(),
        ])->extends('admin.layouts.master', ['pageTitle' => 'مدیریت پرداخت ها']);
    }
}
