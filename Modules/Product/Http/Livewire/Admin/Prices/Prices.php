<?php

namespace Modules\Product\Http\Livewire\Admin\Prices;

use App\Exports\DatatableExport;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Business\Entities\Business;
use Modules\Core\Http\Livewire\BaseComponent;

class Prices extends BaseComponent
{
    use WithPagination;

    public $query;
    public $search = '';
    public $page = 1;
    public $perPage = 10;
    public $sortField = 'id';
    public $sortAsc = true;
    public $columns = [];
    public $tableClass = 'table';
    public $sortIcon = '&#8597;';
    public $sortAscIcon = '&#8593;';
    public $sortDescIcon = '&#8595;';
    public $selected = [];

    public $business_id = null;


    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortAsc = !$this->sortAsc;
        } else {
            $this->sortAsc = true;
        }

        $this->sortField = $field;
    }

    public function deleteOldPrices()
    {
        $users = \Modules\Product\Entities\ProductPrices::whereDate('created_at', '<=', now()->subDays(3))->delete();

        $this->alert('success', 'عملیات با موفقیت انجام شد', [
            'timer' => 3000,
            'showCancelButton' => false,
            'showConfirmButton' => false,
            'position' => 'center'
        ]);
    }

    public function toggleSelectAll()
    {
        if (count($this->selected) === \Modules\Product\Entities\ProductPrices::search($this->search)->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')->count()) {
            $this->selected = [];
        } else {
            $this->selected = \Modules\Product\Entities\ProductPrices::search($this->search)->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')->get()->pluck('id')->values()->toArray();
        }
        $this->forgetComputed();
    }

    public function export()
    {
        $this->forgetComputed();

        return Excel::download(new DatatableExport(\Modules\Product\Entities\ProductPrices::search($this->search)->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')->get()), date('Ymd') . '_prices.xlsx');
    }

    public function deleteAll()
    {
        $this->forgetComputed();

        \Modules\Product\Entities\ProductPrices::whereIn('id', $this->selected)->delete();

        $this->alert('success', 'عملیات با موفقیت انجام شد', [
            'timer' => 3000,
            'showCancelButton' => false,
            'showConfirmButton' => false,
            'position' => 'center'
        ]);
    }

    public function destroy($id): void
    {
        if (!$id) {
            return;
        }
        $price = \Modules\Product\Entities\ProductPrices::findOrFail($id);

        $price->delete();

        $this->alert('success', 'عملیات با موفقیت انجام شد', [
                'timer' => 3000,
                'showCancelButton' => false,
                'showConfirmButton' => false,
                'position' => 'center'
            ]);
    }

    public function render()
    {
        return view('product::admin.prices.livewire.prices', [
            'prices' => $this->getQuery()
        ])->extends('admin.layouts.master', [
            'pageTitle' => 'مدیریت قیمت ها'
        ]);
    }

    public function getQuery()
    {
        if (isset($this->business_id)) {
            return Business::find($this->business_id)->prices()->search($this->search)->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')->paginate($this->perPage);
        }

        return \Modules\Product\Entities\ProductPrices::search($this->search)->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')->paginate($this->perPage);
    }
}
