<?php

namespace App\Http\Livewire\Admin\AvailableRouters;

use App\Models\AvailableTriggerAction;
use App\Models\Service;
use Modules\Core\Http\Livewire\BaseComponent;

class Show extends BaseComponent
{
    public $available_router;

    public function mount($id)
    {
        $this->available_router = AvailableTriggerAction::firstWhere('id', $id);
    }

    public function render()
    {

        // $months = [1,2,3,4,5,6,7,8,9,10,11,12];
        //
        // $router_service_usage_data = [];
        // $router_service_error_logs_data = [];
        //
        // foreach ($months as $item) {
        //     $router_service_usage_data[] = $this->service->routers->whereInMonthJalali('created_at', $item)->count();
        //
        //     $router_service_error_logs_data[] = $this->service->routers->whereInMonthJalali('created_at', $item)->whereHas('router_logs',function($q){
        //         return $q->where('type','error');
        //     })->count();
        // }

        // $reports   = $this->service->reports;
        $routers = $this->available_router->routers;
        $actions = $this->available_router->actions;
        $triggers = $this->available_router->triggers;

        return view('livewire.admin.available_routers.show', [
            'routers'  => $routers,
            'triggers'  => $triggers,
            'actions'  => $actions,
            // 'router_service_usage_data'=>json_encode($router_service_usage_data,JSON_NUMERIC_CHECK),
            // 'router_service_error_logs_data'=>json_encode($router_service_error_logs_data,JSON_NUMERIC_CHECK),

        ])->extends('admin.layouts.master', [
            'pageTitle' => 'جزئیات سناریو آماده '.$this->available_router->title,
        ]);
    }
}
