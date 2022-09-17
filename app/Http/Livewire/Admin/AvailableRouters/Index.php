<?php

namespace App\Http\Livewire\Admin\AvailableRouters;

use App\Exports\DatatableExport;
use App\Models\AvailableTriggerAction;
use App\Models\Service;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Core\Http\Livewire\BaseComponent;
use Modules\Core\Http\Livewire\CRUD\DatatableTrait;

class Index extends BaseComponent
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

        foreach (AvailableTriggerAction::query()->whereIn('id', $this->selected) as $category) {
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

    public function toggleSelectAll()
    {
        if (count($this->selected) ===
            AvailableTriggerAction::search($this->search)->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')->count()) {
            $this->selected = [];
        } else {
            $this->selected = AvailableTriggerAction::search($this->search)->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                                           ->get()
                                           ->pluck('id')->values()->toArray();
        }
        $this->forgetComputed();
    }

    public function export()
    {
        $this->forgetComputed();

        return Excel::download(new DatatableExport(AvailableTriggerAction::search($this->search)
                                                                ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                                                                ->get()), date('Ymd').'_categories.xlsx');
    }

    public function getQuery()
    {
        if (! empty($this->user)) {
            return $this->user->routers()->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')->paginate($this->perPage);
        }

        if (! empty($this->service)) {
            return $this->service->routers()->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')->paginate($this->perPage);
        }

        return AvailableTriggerAction::search($this->search)->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                            ->paginate($this->perPage);
    }

    public function destroy($id): void
    {
        $this->resetPage();

        if (! $id) {
            return;
        }
        $router = AvailableTriggerAction::findOrFail($id);

        $router->delete();

        $this->alert('success', __('Operation completed successfully'), [
            'position'         => 'center',
            'timer'            => '1500',
            'toast'            => false,
            'timerProgressBar' => true,
        ]);
    }

    public function render()
    {
        return view('livewire.admin.available_routers.index', [
            'available_routers' => $this->getQuery(),

        ])->extends('admin.layouts.master', [
            'pageTitle' => 'مدیریت سناریو ها',
        ]);
    }
}
