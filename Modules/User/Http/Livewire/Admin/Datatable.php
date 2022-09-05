<?php

namespace Modules\User\Http\Livewire\Admin;

use App\Exports\DatatableExport;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Core\Http\Livewire\BaseComponent;
use Modules\User\Entities\User;

class Datatable extends BaseComponent
{
    use WithPagination;

    public $query;
    public $search = '';
    public $page = 1;
    public $perPage = 10;
    public $sortField = 'id';
    public $sortAsc = false;
    public $columns = [];
    public $tableClass = 'table';
    public $sortIcon = '&#8597;';
    public $sortAscIcon = '&#8593;';
    public $sortDescIcon = '&#8595;';
    public $selected = [];
    public $users_ids;

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
        if (count($this->selected) ===
            User::search($this->search)->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')->count()) {
            $this->selected = [];
        } else {
            $this->selected = User::search($this->search)->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')->get()
                ->pluck('id')->values()->toArray();
        }
        $this->forgetComputed();
    }

    public function export()
    {
        $this->forgetComputed();

        return Excel::download(new DatatableExport(User::search($this->search)
            ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
            ->get()), date('Ymd') . '_users.xlsx');
    }

    public function deleteAll()
    {
        $this->forgetComputed();

        User::whereIn('id', $this->selected)->delete();

        $this->alert('success', 'انجام شد', [
            'position' => 'bottom-start',
            'timer' => 3000,
            'toast' => true,
            'text' => 'عملیات با موفقیت انجام شد',
            'showCancelButton' => false,
            'showConfirmButton' => false,
        ]);
    }

    public function destroy($id)
    {
        $user = User::firstWhere('id', $id);

//         $business->payments()->delete();
//         $business->rating()->delete();
//         $business->responses()->delete();
//         $business->inquiries()->delete();
//         $business->reports()->delete();
//         $business->comments()->delete();
//         $business->delete();
        $user->comments()->delete();
        $user->reports()->delete();
        $user->inquiries()->delete();

        $user->delete();

        $this->alert('success', 'انجام شد', [
            'position' => 'bottom-start',
            'timer' => 3000,
            'toast' => true,
            'text' => 'عملیات با موفقیت انجام شد',
            'showCancelButton' => false,
            'showConfirmButton' => false,
        ]);
    }

    public function render()
    {
        return view('user::livewire.index', [
            'users' => $this->getQuery(),
        ])->extends('admin.layouts.master', ['pageTitle' => 'مدیریت کاربران']);
    }

    public function getQuery()
    {
        if (!empty($this->users_ids)) {
            return User::search($this->search)->whereIn('id', $this->users_ids)->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                ->paginate($this->perPage);
        }
        return User::search($this->search)->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
            ->paginate($this->perPage);
    }
}
