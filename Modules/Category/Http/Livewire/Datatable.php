<?php

namespace Modules\Category\Http\Livewire;

use App\Exports\DatatableExport;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Category\Entities\Category;
use Modules\Category\Import\CategoriesImport;
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

        foreach (Category::whereIn('id', $this->selected) as $category) {
            if ($this->action_status) {
                $category->status = $this->action_status;
            }

            $category->save();
        }

        $this->alert('success', 'عملیات با موفقیت انجام شد', [
            'position' => 'center',
            'timer' => '2000',
            'toast' => false,
        ]);
    }

    public function clearCache()
    {
        Category::flushQueryCache();
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
        if (count($this->selected) === Category::search($this->search)->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')->count()) {
            $this->selected = [];
        } else {
            $this->selected = Category::search($this->search)->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')->get()->pluck('id')->values()->toArray();
        }
        $this->forgetComputed();
    }

    public function export()
    {
        $this->forgetComputed();

        return Excel::download(new DatatableExport(Category::search($this->search)->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')->get()), date('Ymd') . '_categories.xlsx');
    }

    public function import()
    {
        $this->forgetComputed();
        $this->validate([
            'import' => 'mimes:xlsx,csv|max:10024',
        ]);

        Excel::import(new CategoriesImport(), $this->import);

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

        Category::whereIn('id', $this->selected)->delete();


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
        $category = Category::findOrFail($id);

        $category->delete();

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
        return view('category::livewire.datatable', [
            'categories' => $this->getQuery()
        ])->extends('admin.layouts.master', ['pageTitle' => 'دسته بندی ها']);
    }

    public function getQuery()
    {
        return Category::search($this->search)->withCount('products')->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')->paginate($this->perPage);
    }
}
