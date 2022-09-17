<?php

namespace App\Http\Livewire\Admin\Actions;

use App\Models\Action;
use Modules\Core\Http\Livewire\BaseComponent;

class Show extends BaseComponent
{
    public $action;

    public function mount($id)
    {
        $this->action = Action::firstWhere('id', $id);
    }

    public function render()
    {
        $months = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];

        $router_service_usage_data = [];
        $router_service_error_data = [];

        foreach ($months as $item) {
            $router_service_usage_data[] = $this->action->routers()
                                                        ->whereInMonthJalali('trigger_routers.created_at', $item)
                                                        ->count();

            $router_service_error_data[] = $this->action->routers()
                                                             ->whereInMonthJalali('trigger_routers.created_at', $item)
                                                             ->whereHas('router_logs', function ($q) {
                                                                 return $q->where('type', 'error');
                                                             })->count();
        }

        $reports = $this->action->reports;
        $routers = $this->action->routers;

        $user = auth()->user();

        return view('livewire.admin.actions.show', [
            'reports'                        => $reports,
            'routers'                        => $routers,
            'user'                           => $user,
            'service'                        => $this->action->service,

            'router_service_usage_data'      => json_encode($router_service_usage_data, JSON_THROW_ON_ERROR | JSON_NUMERIC_CHECK),
            'router_service_error_data' => json_encode($router_service_error_data, JSON_THROW_ON_ERROR | JSON_NUMERIC_CHECK),

        ])->extends('admin.layouts.master', [
            'pageTitle' => 'جزئیات عملکرد '.$this->action->title,
        ]);
    }
}
