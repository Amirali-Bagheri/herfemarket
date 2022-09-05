<?php

namespace Modules\Business\Http\Livewire;

use App\Exports\DatatableExport;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Business\Entities\Business;
use Modules\Core\Http\Livewire\BaseComponent;

class Datatable extends BaseComponent
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

    public function toggleSelectAll()
    {
        if (count($this->selected) === Business::search($this->search)->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')->count()) {
            $this->selected = [];
        } else {
            $this->selected = Business::search($this->search)->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')->get()->pluck('id')->values()->toArray();
        }
        $this->forgetComputed();
    }

    public function export()
    {
        $this->forgetComputed();

        return Excel::download(new DatatableExport(Business::search($this->search)->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')->get()), date('Ymd') . '_businesses.xlsx');
    }

    public function deleteAll()
    {
        $this->forgetComputed();

        Business::whereIn('id', $this->selected)->delete();

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
        $business = Business::findOrFail($id);

        isset($business->payments) ?? $business->payments()->delete();
        isset($business->rating) ?? $business->rating()->delete();
        isset($business->responses) ?? $business->responses()->delete();
        isset($business->inquiries) ?? $business->inquiries()->delete();
        isset($business->reports) ?? $business->reports()->delete();
        isset($business->comments) ?? $business->comments()->delete();
        isset($business->reports) ?? $business->reports()->delete();
        isset($business->inquiries) ?? $business->inquiries()->delete();

        $business->delete();

        $this->alert('success', 'عملیات با موفقیت انجام شد', [
                'timer' => 3000,
                'showCancelButton' => false,
                'showConfirmButton' => false,
                'position' => 'center'
            ]);
    }


    public function render()
    {
        return view('business::livewire.datatable', [
            'businesses' => $this->getQuery()
        ])->extends('admin.layouts.master', [
            'pageTitle'=>'لیست کسب و کارها',
        ]);
    }

    public function getQuery()
    {
        return Business::search($this->search)->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')->paginate($this->perPage);
    }
}
