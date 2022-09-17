<?php

namespace App\Http\Livewire\Admin\Routers;

use App\Events\RouterEvent;
use App\Jobs\TriggerRouterJob;
use App\Models\TriggerRouter;
use Illuminate\Support\Facades\Bus;
use Modules\Core\Http\Livewire\BaseComponent;
use Throwable;

class Show extends BaseComponent
{
    public $router;

    public $trigger;

    public function mount($id)
    {
        $this->router = TriggerRouter::query()->find($id);
    }

    public function dumpTrigger()
    {
        $router = $this->router;
        $data = [];

        $router->update([
            'listen_value'=>null,
            'listen_at'=>null,
        ]);
        $trigger_class = new $router->trigger->service['controller_class'];
        $trigger_result = $trigger_class->{$router->trigger['function_name']}($router, $data);

        dump($trigger_result);
        dump(json_encode($trigger_result));

        dd('test');

        if ($trigger_result != false) {
            foreach ($router->routerables as $routerable) {
                $jobs[] = new TriggerRouterJob($routerable, $data, $trigger_result);
            }

            Bus::chain($jobs)->onConnection('redis')->onQueue('router')->dispatch();
        }
    }

    public function manualRun()
    {
        try {
            $router = $this->router;
            $data = [];

            $router->update([
                'listen_value'=>null,
                'listen_at'=>null,
            ]);

            $trigger_class = new $router->trigger->service['controller_class'];
            $trigger_result = $trigger_class->{$router->trigger['function_name']}($router, $data);

            foreach ($router->routerables as $routerable) {
                TriggerRouterJob::dispatchSync($routerable, $data, $trigger_result);
            }
        } catch (Throwable $exception) {
            throw $exception;
        }
    }

    public function manualAddToJob()
    {
        event(new RouterEvent($this->router));
    }

    public function render()
    {
        $router_logs = $this->router->router_logs()->latest()->paginate(10);

        $months = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];

        $router_service_error_logs_data = [];

        $router_logs_count = 0;
        foreach ($months as $item) {
            $router_service_error_logs_data[] = $this->router->router_logs()->whereInMonthJalali('created_at', $item)->where('type', 'error')->count();
            $router_logs_count += $router_service_error_logs_data[$item - 1];
        }

        $user = auth()->user();

        $router_usage_data = [];
        $router_usage_data[] = $this->router->router_logs()->where('type', 'error')->count();
        $router_usage_data[] = $this->router->router_logs()->where('type', 'success')->count();

        return view('livewire.admin.routers.show', [

            'router_logs' => $router_logs,
            'router_logs_count' => $router_logs_count,
            'user'=>$user,
            'router_service_error_logs_data'=>json_encode($router_service_error_logs_data, JSON_NUMERIC_CHECK),
            'router_usage_data'=>json_encode($router_usage_data, JSON_NUMERIC_CHECK),
        ])->extends('admin.layouts.master', [
            'pageTitle' => 'مشاهده سناریو',
        ]);
    }
}
