<?php

namespace App\Http\Livewire\Admin\Linkeds;

use App\Models\Linked;
use App\Models\Service;
use DatatableExport;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Core\Http\Livewire\BaseComponent;
use Modules\Core\Http\Livewire\CRUD\DatatableTrait;

class Datatable extends BaseComponent
{
    use DatatableTrait;

    public $user = null;

    public $service = null;

    public function mount($user_id = null, $service_id = null)
    {
        if (! empty($user_id)) {
            $this->user = \Modules\User\Entities\User::query()->find($user_id);
        }

        if (! empty($service_id)) {
            $this->service = Service::query()->find($service_id);
        }
    }

    public function action()
    {
        $this->forgetComputed();

        foreach (Linked::query()->whereIn('id', $this->selected) as $page) {
            if ($this->action_status) {
                $page->status = $this->action_status;
            }

            $page->save();
        }

        $this->dispatchBrowserEvent('success', [
            'title'             => __('Operation completed successfully'),
            'timer'             => 1500,
            'type'              => 'success',
            'showCancelButton'  => false,
            'showConfirmButton' => false,
            'position'          => 'center',
        ]);
    }

    public function toggleSelectAll()
    {
        if (count($this->selected) ===
            Linked::search($this->search)->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')->count()) {
            $this->selected = [];
        } else {
            $this->selected = Linked::search($this->search)->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')->get()
                                    ->pluck('id')->values()->toArray();
        }
        $this->forgetComputed();
    }

    public function export()
    {
        $this->forgetComputed();

        return Excel::download(new DatatableExport(Linked::search($this->search)
                                                          ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                                                          ->get()), date('Ymd').'_linkeds.xlsx');
    }

    public function deleteAll()
    {
        $this->forgetComputed();
        $this->resetPage();

        Linked::query()->whereIn('id', $this->selected)->delete();

        $this->dispatchBrowserEvent('success', [
            'title'             => __('Operation completed successfully'),
            'timer'             => 1500,
            'type'              => 'success',
            'showCancelButton'  => false,
            'showConfirmButton' => false,
            'position'          => 'center',
        ]);
    }

    public function destroy($id): void
    {
        $this->resetPage();

        if (! $id) {
            return;
        }
        $page = Linked::findOrFail($id);

        $page->delete();

        $this->dispatchBrowserEvent('success', [
            'title'             => __('Operation completed successfully'),
            'timer'             => 1500,
            'type'              => 'success',
            'showCancelButton'  => false,
            'showConfirmButton' => false,
            'position'          => 'center',
        ]);
    }

    public function render()
    {
        return view('livewire.admin.linkeds.datatable', [
            'linkeds' => $this->getQuery(),
        ])->extends('admin.layouts.master', ['pageTitle' => 'رویداد ها']);
    }

    public function getQuery()
    {
        if (! empty($this->user)) {
            return $this->user->linkeds()->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')->paginate($this->perPage);
        }
        if (! empty($this->service)) {
            return $this->service->linkeds()->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')->paginate($this->perPage);
        }

        return Linked::search($this->search)->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                     ->paginate($this->perPage);
    }
}
