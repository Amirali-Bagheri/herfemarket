<?php

namespace Modules\Notification\Http\Livewire\Admin;

use App\Exports\DatatableExport;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Core\Http\Livewire\BaseComponent;
use Modules\Notification\Entities\Notification;

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
            $this->sortAsc = ! $this->sortAsc;
        } else {
            $this->sortAsc = true;
        }

        $this->sortField = $field;
    }

    public function toggleSelectAll()
    {
        if (count($this->selected) ===
            Notification::search($this->search)->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')->count()) {
            $this->selected = [];
        } else {
            $this->selected = Notification::search($this->search)->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                                          ->get()->pluck('id')->values()->toArray();
        }
        $this->forgetComputed();
    }

    public function export()
    {
        $this->forgetComputed();

        return Excel::download(new DatatableExport(Notification::search($this->search)
                                                               ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                                                               ->get()), date('Ymd').'_notifications.xlsx');
    }

    public function deleteAll()
    {
        $this->forgetComputed();

        Notification::query()->whereIn('id', $this->selected)->delete();

        self::alert('success', 'انجام شد', [
            'position'          => 'bottom-start',
            'timer'             => 3000,
            'toast'             => true,
            'text'              => __('Operation completed successfully'),
            'showCancelButton'  => false,
            'showConfirmButton' => false,
        ]);
    }

    public function destroy($id): void
    {
        $notification = Notification::findOrFail($id);

        $notification->delete();

        $this->alert('success', 'انجام شد', [
            'position'          => 'bottom-start',
            'timer'             => 3000,
            'toast'             => true,
            'text'              => __('Operation completed successfully'),
            'showCancelButton'  => false,
            'showConfirmButton' => false,
        ]);
    }

    public function render()
    {
        return view('notification::admin.datatable', [
            'notifications' => $this->getQuery(),
        ])->extends('admin.layouts.master', ['pageTitle' => 'مدیریت اعلان ها']);
    }

    public function getQuery()
    {
        return Notification::search($this->search)->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                           ->paginate($this->perPage);
    }
}
