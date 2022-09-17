<?php

namespace App\Http\Livewire\Admin\Triggers;

use App\Models\Trigger;
use App\Models\TriggerRouter;
use Modules\Core\Http\Livewire\BaseComponent;

class Show extends BaseComponent
{
    public $trigger;

    public function mount($id)
    {
        $this->trigger = Trigger::firstWhere('id', $id);
    }

    public function render()
    {
        $months = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];

        $router_service_usage_data = [];
        $router_service_error_logs_data = [];

        foreach ($months as $item) {
            $router_service_usage_data[] = $this->trigger->routers()->whereInMonthJalali('created_at', $item)->count();

            $router_service_error_logs_data[] = $this->trigger->routers()->whereInMonthJalali('created_at', $item)
                                                                       ->whereHas('router_logs', function ($q) {
                                                                           return $q->where('type', 'error');
                                                                       })->count();
        }

        $reports = $this->trigger->reports;
        $routers = TriggerRouter::query()->where('trigger_id', $this->trigger->id)->get();
        // dd($routers);
        $user = auth()->user();

        return view('livewire.admin.triggers.show', [
            'reports'                        => $reports,
            'routers'                        => $routers,
            'user'                           => $user,
            'service'                           => $this->trigger->service,
            'router_service_usage_data'      => json_encode($router_service_usage_data, JSON_NUMERIC_CHECK),
            'router_service_error_logs_data' => json_encode($router_service_error_logs_data, JSON_NUMERIC_CHECK),

        ])->extends('admin.layouts.master', [
            'pageTitle' => 'جزئیات رویداد '.$this->trigger->title,
        ]);
    }
}
