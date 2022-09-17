<?php

namespace App\Http\Livewire\Admin\Services;

use App\Models\Service;
use Modules\Core\Http\Livewire\BaseComponent;

class Show extends BaseComponent
{
    public $service;

    public function mount($slug)
    {
        $this->service = Service::firstWhere('slug', $slug);
    }

    public function render()
    {
        $months = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];

        $router_service_usage_data = [];
        $router_service_error_logs_data = [];

        foreach ($months as $item) {
            $router_service_usage_data[] = $this->service->routers->whereInMonthJalali('created_at', $item)->count();

            $router_service_error_logs_data[] = $this->service->routers->whereInMonthJalali('created_at', $item)->whereHas('router_logs', function ($q) {
                return $q->where('type', 'error');
            })->count();
        }

        $reports = $this->service->reports;
        $routers = $this->service->routers;
        $actions = $this->service->actions;
        $triggers = $this->service->triggers;
        // dd($routers);
        $linkeds = $this->service->linkeds;
        $user = auth()->user();

        return view('livewire.admin.services.show', [
            'reports'   => $reports,
            'routers'  => $routers,
            'linkeds'  => $linkeds,
            'triggers'  => $triggers,
            'actions'  => $actions,
            'user'=>$user,

            'router_service_usage_data'=>json_encode($router_service_usage_data, JSON_NUMERIC_CHECK),
            'router_service_error_logs_data'=>json_encode($router_service_error_logs_data, JSON_NUMERIC_CHECK),

        ])->extends('admin.layouts.master', [
            'pageTitle' => 'جزئیات سرویس '.$this->service->title,
        ]);
    }
}
