<?php

namespace Modules\Brand\Http\Livewire\Admin;

use App\Exports\DatatableExport;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Brand\Entities\Brand;
use Modules\Brand\Import\BrandsImport;
use Modules\Core\Http\Livewire\BaseComponent;

class Datatable extends BaseComponent
{
    use WithPagination;
    use WithFileUploads;

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
    public $import;
    public $action_status;

    public function action()
    {
        $this->forgetComputed();

        foreach (Brand::whereIn('id', $this->selected) as $brand) {
            if ($this->action_status) {
                $brand->status = $this->action_status;
            }

            $brand->save();
        }

        $this->alert('success', 'عملیات با موفقیت انجام شد', [
            'position' => 'center',
            'timer' => '2000',
            'toast' => false,
        ]);
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
        if (count($this->selected) === Brand::search($this->search)->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')->count()) {
            $this->selected = [];
        } else {
            $this->selected = Brand::search($this->search)->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')->get()->pluck('id')->values()->toArray();
        }
        $this->forgetComputed();
    }

    public function export()
    {
        $this->forgetComputed();

        return Excel::download(new DatatableExport(Brand::search($this->search)->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')->get()), date('Ymd') . '_brands.xlsx');
    }

    public function import()
    {
        $this->forgetComputed();
        $this->validate([
            'import' => 'mimes:xlsx,csv|max:10024',
        ]);

        Excel::import(new BrandsImport(), $this->import);

        $this->alert('success', 'عملیات با موفقیت انجام شد', [
            'position' => 'center',
            'timer' => '2000',
            'toast' => false,
        ]);
    }

    public function deleteAll()
    {
        $this->forgetComputed();
        $this->resetPage();

        Brand::whereIn('id', $this->selected)->delete();


        $this->alert('success', 'عملیات با موفقیت انجام شد', [
            'position' => 'center',
            'timer' => '2000',
            'toast' => false,
        ]);
    }


    public function destroy($id): void
    {
        $this->resetPage();

        if (!$id) {
            return;
        }
        $brand = Brand::findOrFail($id);

        $brand->delete();

        $this->alert('success', 'عملیات با موفقیت انجام شد', [
                'timer' => 1500,
                'showCancelButton' => false,
                'showConfirmButton' => false,
                'position' => 'center'
            ]);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('brand::admin.livewire.datatable', [
            'brands' => $this->getQuery()
        ])->extends('admin.layouts.master', [
            'pageTitle' => 'برندها'
        ]);
    }

    public function getQuery()
    {
        $search = $this->search;

        return Brand::search($search)
            ->withCount('products')
//        ->when(!empty($search), function ($query) use ($search) {
//            $matching = Brand::search($search)->get()->pluck('id');
//            $query->whereIn('id', $matching);
//        })

            ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')->paginate($this->perPage);
    }
}
