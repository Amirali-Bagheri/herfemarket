<?php

namespace App\Http\Livewire\Admin\Routers;

use App\Models\Service;
use App\Models\Trigger;
use App\Models\TriggerRouter;
use Modules\Core\Http\Livewire\BaseComponent;
use Modules\Plan\Entities\Plan;
use Modules\User\Entities\User;

class Update extends BaseComponent
{
    public $title;

    public $linked_required = 0;

    public $description;

    public $trigger_id;

    public $user_id;

    public $plan_id;

    public $repeatable = 0;

    public $repeat_type;

    public $repeat_every;

    public $repeat_at;

    public $cron;

    public $listenable = 0;

    public $listen_at;

    public $listen_value;

    public $listen_type;

    public $listen_every;

    public $attempt_fail = 0;

    public $parameters;

    public $active = 0;

    public $referer_type;

    public $trigger_linked_id;

    public $status;

    public $last_status;

    public $router;

    public $services;

    public $service;

    public $service_id;

    public $triggers;

    public $trigger;

    public $routerables;

    public $users;

    public $plans;

    public $daily_limit = 10000;

    public $num = 0;

    public function mount($id)
    {
        $this->router = TriggerRouter::query()->where('id', $id)->first();
        $this->title = $this->router->title;
        $this->description = $this->router->description;
        $this->triggers = Trigger::all();
        $this->trigger = $this->router->trigger;
        $this->services = Service::all();
        $this->service = $this->trigger->service;
        $this->service_id = $this->trigger->service_id;
        $this->routerables = $this->router->routerables;
        $this->users = User::all();
        $this->user_id = $this->router->user_id;
        $this->plans = Plan::all();
        $this->plan_id = $this->router->plan_id;
        $this->attempt_fail = $this->router->attempt_fail;
        $this->parameters = $this->router->parameters;
        $this->status = $this->router->status;
        $this->active = (bool) $this->router->active;
        $this->repeatable = $this->router->repeatable;
        $this->repeat_type = $this->router->repeat_type;
        $this->repeat_every = $this->router->repeat_every;
        $this->repeat_at = $this->router->repeat_at;
        $this->cron = $this->router->cron;
        $this->listenable = $this->router->listenable;
        $this->listen_at = $this->router->listen_at;
        $this->listen_value = $this->router->listen_value;
        $this->listen_type = $this->router->listen_type;
        $this->listen_every = $this->router->listen_every;
        $this->last_status = $this->router->last_status;

        $this->daily_limit = $this->router->daily_limit;

        $this->attempt_fail = $this->router->attempt_fail;
        $this->referer_type = $this->router->referer_type;
    }

//    public function updatedService_id(){
//
//    }
    public function encodeParameters()
    {
        try {
            //        if($this->switchEncode == 0){
            //
            //        }
            $this->parameters = json_encode($this->parameters);
        } catch (\Throwable $exception) {
            $this->alert('error', 'خطایی رخ داد!', [
                'timer'             => 3000,
                'showCancelButton'  => false,
                'showConfirmButton' => false,
                'position'          => 'center',
            ]);
        }
    }

    public function decodeParameters()
    {
        try {
            $this->parameters = json_decode($this->parameters, false);
        } catch (Throwable $exception) {
            $this->alert('error', 'خطایی رخ داد!', [
                'timer'             => 3000,
                'showCancelButton'  => false,
                'showConfirmButton' => false,
                'position'          => 'center',
            ]);
        }
    }

    public function encodeVariables()
    {
        try {
            //        if($this->switchEncode == 0){
            //
            //        }
            $this->variables = json_encode($this->variables);
        } catch (Throwable $exception) {
            $this->alert('error', 'خطایی رخ داد!', [
                'timer'             => 3000,
                'showCancelButton'  => false,
                'showConfirmButton' => false,
                'position'          => 'center',
            ]);
        }
    }

    public function decodeVariables()
    {
        try {
            $this->variables = json_decode($this->variables, false);
        } catch (Throwable $exception) {
            $this->alert('error', 'خطایی رخ داد!', [
                'timer'             => 3000,
                'showCancelButton'  => false,
                'showConfirmButton' => false,
                'position'          => 'center',
            ]);
        }
    }

    public function createRouterableBox()
    {
        $this->num+=1;
        $sort_index = $this->num + 1;
        $this->routerables->create([
            'sort_index' => $sort_index,
        ]);

    }

    public function submit()
    {
        $this->validate(
            [
                'title'         => 'required',
                'status'        => 'required',
                // 'linked_required' => 'required',
                'trigger_id'    => 'required',
                // 'parameters' => 'required',
                // 'variables' => 'required'
            ]
        );
        $parameters = str_replace(["\n", "\t"], '', $this->parameters);

        $this->router->update([
            'title'           => $this->title,
            'description'     => $this->description,
            'parameters'      => $this->parameters,
            'status'          => $this->status,
            'repeatable'      => $this->repeatable,
            'repeat_type'     => $this->repeat_type,
            'repeat_every'    => $this->repeat_every,
            'repeat_at'       => $this->repeat_at,
            'cron'            => $this->cron,
            'listenable'      => $this->listenable,
            'listen_at'       => $this->listen_at,
            'listen_value'    => $this->listen_value,
            'listen_type'     => $this->listen_type,
            'listen_every'    => $this->listen_every,
            'trigger_id'      => $this->trigger_id,
            'user_id'         => $this->user_id,
            'plan_id'         => $this->plan_id,
            'attempt_fail'    => $this->attempt_fail,
            'active'          => $this->active,
            'referer_type'    => $this->referer_type,
            'trigger_linked_id' => $this->trigger_linked_id,
            'last_status'     => $this->last_status,
            'daily_limit'    => $this->daily_limit,
        ]);

        $this->flash('success', __('Operation completed successfully'), [
            'timer'             => 3000,
            'showCancelButton'  => false,
            'showConfirmButton' => false,
            'position'          => 'center',
        ]);

        $this->redirect(route('admin.routers.update', $this->router->id));
    }

    public function render()
    {
        if (isset($this->service_id)) {
            $service = Service::findOrFail($this->service_id);
            $this->triggers = $service->triggers()->where('status', 1)->get();
            $this->trigger_id = $this->router->trigger_id;
        } else {
            $this->triggers = Trigger::all();
        }
//        dd($this->routerables);
        return view('livewire.admin.routers.update')->extends('admin.layouts.master', [
            'pageTitle' => 'ویرایش سناریو',
        ]);
    }
}
