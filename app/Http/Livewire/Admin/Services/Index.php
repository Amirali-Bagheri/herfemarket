<?php

namespace App\Http\Livewire\Admin\Services;

use App\Exports\DatatableExport;
use App\Models\Service;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Core\Http\Livewire\BaseComponent;

class Index extends BaseComponent
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

    public $import;

    public $action_status;

    public function action()
    {
        $this->forgetComputed();

        foreach (Service::query()->whereIn('id', $this->selected) as $category) {
            if ($this->action_status) {
                $category->status = $this->action_status;
            }

            $category->save();
        }

        $this->alert('success', __('Operation completed successfully'), [
            'position'         => 'center',
            'timer'            => '1500',
            'toast'            => false,
            'timerProgressBar' => true,
        ]);
    }

    public function destroy($id): void
    {
        $this->resetPage();

        if (! $id) {
            return;
        }
        $page = Service::findOrFail($id);

        $page->delete();

        $this->alert('success', __('Operation completed successfully'), [
            'timer'             => 1500,
            'type'              => 'success',
            'showCancelButton'  => false,
            'showConfirmButton' => false,
            'position'          => 'center',
        ]);
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortAsc = ! $this->sortAsc;
        } else {
            $this->sortAsc = true;
        }

        $this->sortField = $field;
    }

    public function toggleSelectAll()
    {
        if (count($this->selected) ===
            Service::search($this->search)->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')->count()) {
            $this->selected = [];
        } else {
            $this->selected = Service::search($this->search)->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')->get()
                                     ->pluck('id')->values()->toArray();
        }
        $this->forgetComputed();
    }

    public function export()
    {
        $this->forgetComputed();

        return Excel::download(new DatatableExport(Service::search($this->search)
                                                          ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                                                          ->get()), date('Ymd').'_categories.xlsx');
    }

    public function getQuery()
    {
        return Service::search($this->search)->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                      ->paginate($this->perPage);
    }

    public function render()
    {
        return view('livewire.admin.services.index', [
            'services' => $this->getQuery(),
        ])->extends('admin.layouts.master', ['pageTitle' => 'مدیریت سرویس ها']);
    }
}
