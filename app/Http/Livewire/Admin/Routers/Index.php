<?php

namespace App\Http\Livewire\Admin\Routers;

use App\Models\AvailableTriggerAction;
use App\Exports\DatatableExport;
use App\Models\Action;
use App\Models\Service;
use App\Models\Trigger;
use App\Models\TriggerRouter;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Core\Http\Livewire\BaseComponent;
use Modules\Core\Http\Livewire\CRUD\DatatableTrait;
use Modules\User\Entities\User;

class Index extends BaseComponent
{
    use DatatableTrait;

    public $service = null;

    public $available_router = null;

    public $user = null;

    public $action = null;

    public $trigger = null;

    public function mount($user_id = null, $service_id = null, $available_router_id = null, $action_id = null, $trigger_id = null)
    {
        if (! empty($service_id)) {
            $this->service = Service::query()->find($service_id);
        }

        if (! empty($user_id)) {
            $this->user = User::query()->find($user_id);
        }

        if (! empty($trigger_id)) {
            $this->trigger = Trigger::query()->find($trigger_id);
        }

        if (! empty($action_id)) {
            $this->action = Action::query()->find($action_id);
        }

        if (! empty($available_router_id)) {
            $this->available_router = AvailableTriggerAction::query()->find($available_router_id);
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

    public function changeStatus($id)
    {
        $router = TriggerRouter::query()->find($id);

        if ($router->status == 1) {
            $router->update([
                'status' => 0,
            ]);
        } else {
            $router->update([
                'status' => 1,
            ]);
        }
    }

    public function changeActive($id)
    {
        $router = TriggerRouter::query()->find($id);

        if ($router->active == 1) {
            $router->update([
                'active' => 0,
            ]);
        } else {
            $router->update([
                'active' => 1,
            ]);
        }
    }

    public function toggleSelectAll()
    {
        if (count($this->selected) ===
            TriggerRouter::search($this->search)->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')->count()) {
            $this->selected = [];
        } else {
            $this->selected = TriggerRouter::search($this->search)->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                                           ->get()
                                           ->pluck('id')->values()->toArray();
        }
        $this->forgetComputed();
    }

    public function export()
    {
        $this->forgetComputed();

        return Excel::download(new DatatableExport(TriggerRouter::search($this->search)
                                                                ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                                                                ->get()), date('Ymd').'_categories.xlsx');
    }

    public function getQuery()
    {
        if (! empty($this->user)) {
            return $this->user->routers()->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')->paginate($this->perPage);
        }

        if (! empty($this->service)) {
            return $this->service->routers()->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                                 ->paginate($this->perPage);
        }

        if (! empty($this->trigger)) {
            return $this->trigger->routers()->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                                 ->paginate($this->perPage);
        }

        if (! empty($this->action)) {
            return $this->action->routers()->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')->paginate($this->perPage);
        }

        if (! empty($this->available_router)) {
            return $this->available_router->routers()->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                                          ->paginate($this->perPage);
        }

        return TriggerRouter::search($this->search)->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                            ->paginate($this->perPage);
    }

    public function destroy($id): void
    {
        $this->resetPage();

        if (! $id) {
            return;
        }
        $router = TriggerRouter::findOrFail($id);
        $router->routerables()->delete();
        $router->router_logs()->delete();

        $router->delete();

        $this->alert('success', __('Operation completed successfully'), [
            'position'         => 'center',
            'timer'            => '1500',
            'toast'            => false,
            'timerProgressBar' => true,
        ]);
    }

    /**
     * @throws \JsonException
     */
    public function render()
    {
        $months = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];

        $router_service_usage_data = [];
        $routers_services_data = [];

        foreach ($months as $item) {
            $router_service_usage_data[] = TriggerRouter::query()->whereInMonthJalali('created_at', $item)->count();
        }

        $service_ids = [];
        $services_names = [];
        $services_colors = [];
        foreach (\App\Models\Routerable::all() as $routerable) {
            $trigger = $routerable->trigger ?? null;
            $action = $routerable->action ?? null;

            $service_ids[] = $trigger->service_id ?? null;
            $service_ids[] = $action->service_id ?? null;
        }

        $service_ids = collect($service_ids)->unique()->toArray();
        $services_names = collect($services_names)->unique()->toArray();

        foreach ($service_ids as $service_id) {
            $routers_services_data[] = TriggerRouter::query()->whereHas('routerables', function (Builder $q) use ($service_id) {
                return $q->whereHas('trigger', function ($qTrigger) use ($service_id) {
                    $qTrigger->where('service_id', $service_id);
                })
                         ->orWhereHas('action', function ($qAction) use ($service_id) {
                             $qAction->where('service_id', $service_id);
                         });
            })->get()->unique()->count();

            $service = Service::query()->find($service_id);
            $color = $service->color ?? null;
            $services_colors[] = $color ?? '#9E9E9E';

            $services_names[] = $service->title ?? null;
        }

        return view('livewire.admin.routers.index', [
            'routers' => $this->getQuery(),
            'router_service_usage_data' => json_encode($router_service_usage_data, JSON_THROW_ON_ERROR | JSON_NUMERIC_CHECK),
            'routers_services_data'     => json_encode($routers_services_data, JSON_THROW_ON_ERROR | JSON_NUMERIC_CHECK),
            'services_names'            => json_encode($services_names, JSON_THROW_ON_ERROR | JSON_NUMERIC_CHECK),
            'services_colors'           => json_encode($services_colors, JSON_THROW_ON_ERROR | JSON_NUMERIC_CHECK),
        ])->extends('admin.layouts.master', [
            'pageTitle' => 'مدیریت سناریو ها',
        ]);
    }
}
