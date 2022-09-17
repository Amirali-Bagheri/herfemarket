<?php

namespace App\Http\Livewire\Admin\Triggers;

use App\Models\AvailableTriggerAction;
use App\Models\Service;
use App\Models\Trigger;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Core\Http\Livewire\BaseComponent;
use Modules\Core\Http\Livewire\CRUD\DatatableTrait;

class Index extends BaseComponent
{
    use DatatableTrait;

    public $service = null;

    public $available_router = null;

    public function mount($service_id = null, $available_router_id = null)
    {
        if (! empty($service_id)) {
            $this->service = Service::query()->find($service_id);
        }

        if (! empty($available_router_id)) {
            $this->available_router = AvailableTriggerAction::query()->find($available_router_id);
        }
    }

    public function action()
    {
        $this->forgetComputed();

        foreach (Trigger::query()->whereIn('id', $this->selected) as $page) {
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
            Trigger::search($this->search)->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')->count()) {
            $this->selected = [];
        } else {
            $this->selected = Trigger::search($this->search)->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')->get()
                                     ->pluck('id')->values()->toArray();
        }
        $this->forgetComputed();
    }

    public function export()
    {
        $this->forgetComputed();

        return Excel::download(new \App\Exports\DatatableExport(Trigger::search($this->search)
                                                           ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                                                           ->get()), date('Ymd').'_triggers.xlsx');
    }

    public function deleteAll()
    {
        $this->forgetComputed();
        $this->resetPage();

        Trigger::query()->whereIn('id', $this->selected)->delete();

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
        $page = Trigger::findOrFail($id);

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
        return view('livewire.admin.triggers.index', [
            'triggers' => $this->getQuery(),
        ])->extends('admin.layouts.master', ['pageTitle' => 'رویداد ها']);
    }

    public function getQuery()
    {
        if (! empty($this->service)) {
            return $this->service->triggers()->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')->paginate($this->perPage);
        }
        if (! empty($this->available_router)) {
            return $this->available_router->actions()->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')->paginate($this->perPage);
        }

        return Trigger::search($this->search)->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                      ->paginate($this->perPage);
    }
}
