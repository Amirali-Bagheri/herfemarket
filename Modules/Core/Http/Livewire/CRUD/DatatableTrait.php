<?php

namespace Modules\Core\Http\Livewire\CRUD;

use Livewire\WithPagination;

trait DatatableTrait
{
    use WithPagination;

    public $query;
    public $search       = '';
    public $page         = 1;
    public $perPage      = 10;
    public $sortField    = 'id';
    public $sortAsc      = true;
    public $columns      = [];
    public $tableClass   = 'table';
    public $sortIcon     = '&#8597;';
    public $sortAscIcon  = '&#8593;';
    public $sortDescIcon = '&#8595;';
    public $selected     = [];
    public $import;
    public $action_status;

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortAsc = ! $this->sortAsc;
        } else {
            $this->sortAsc = true;
        }

        $this->sortField = $field;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
}
