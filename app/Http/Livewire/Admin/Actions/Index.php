<?php

namespace App\Http\Livewire\Admin\Actions;

use App\Models\Action;
use App\Models\AvailableTriggerAction;
use App\Models\Service;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Core\Http\Livewire\BaseComponent;
use Modules\Core\Http\Livewire\CRUD\DatatableTrait;
use Modules\Page\Entities\Page;

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

        foreach (Action::query()->whereIn('id', $this->selected) as $page) {
            if ($this->action_status) {
                $page->status = $this->action_status;
            }

            $page->save();
        }

        $this->alert('success', __('Operation completed successfully'), [
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
            Action::search($this->search)->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')->count()) {
            $this->selected = [];
        } else {
            $this->selected = Action::search($this->search)->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')->get()
                                    ->pluck('id')->values()->toArray();
        }
        $this->forgetComputed();
    }

    public function export()
    {
        $this->forgetComputed();

        return Excel::download(new \App\Exports\DatatableExport(Page::search($this->search)
                                                        ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                                                        ->get()), date('Ymd').'_actions.xlsx');
    }

    public function deleteAll()
    {
        $this->forgetComputed();
        $this->resetPage();

        Action::query()->whereIn('id', $this->selected)->delete();

        $this->alert('success', __('Operation completed successfully'), [
            'timer'             => 1500,
            'type'              => 'success',
            'showCancelButton'  => false,
            'showConfirmButton' => false,
            'position'          => 'center',
        ]);
    }

    public function destroy($id)
    {
        // $this->resetPage();
        $page = Action::findOrFail($id);

        $page->delete();

        $this->alert('success', __('Operation completed successfully'), [
            'timer'             => 1500,
            'type'              => 'success',
            'showCancelButton'  => false,
            'showConfirmButton' => false,
            'position'          => 'center',
        ]);
    }

    public function render()
    {
        return view('livewire.admin.actions.index', [
            'actions' => $this->getQuery(),
        ])->extends('admin.layouts.master', ['pageTitle' => 'عملکرد ها']);
    }

    public function getQuery()
    {
        if (! empty($this->service)) {
            return $this->service->actions()->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')->paginate($this->perPage);
        }
        if (! empty($this->available_router)) {
            return $this->available_router->actions()->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')->paginate($this->perPage);
        }

        return Action::search($this->search)->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                     ->paginate($this->perPage);
    }
}
