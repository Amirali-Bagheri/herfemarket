<?php

namespace App\Http\Livewire\Admin\AvailableRouters\AvailableRouterable;

use App\Models\Action;
use App\Models\AvailableRouterable;
use App\Models\Service;
use Modules\Core\Http\Livewire\BaseComponent;

class Routerable extends BaseComponent
{
    public $on_update;

    public $routerable;

    public $sort_index;

    public $trigger_id;

    public $actions;

    public $action;

    public $action_id;

    public $trigger_linked_id;

    public $action_linked_id;

    public $services;

    public $service;

    public $service_id;

    public $parameters;

    public $active;

    public $status;

    public function mount($routerable = null)
    {
        if ($routerable == null) {
            $this->on_update = false;
            $this->services = Service::all();
        } else {
            $this->on_update = true;
            $this->routerable = $routerable;
            dd($routerable);
            $this->sort_index = $this->routerable->sort_index;
            $this->trigger_id = $this->routerable->trigger_id;
            $this->actions = Action::all();
            $this->action = $this->routerable->action;
            $this->services = Service::all();
            $this->service = $this->action->service;
            $this->service_id = $this->action->service_id;
            $this->trigger_linked_id = $this->routerable->trigger_linked_id;
            $this->action_linked_id = $this->routerable->action_linked_id;
            $this->parameters = $this->routerable->parameters;
            $this->active = (bool) $this->routerable->active;
            $this->status = (bool) $this->routerable->status;
        }
    }

    public function encodeParameters()
    {
        try {
            //        if($this->switchEncode == 0){
            //
            //        }
            $this->parameters = json_encode($this->parameters);
        } catch (Throwable $exception) {
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

    public function submit_r()
    {
        $this->validate(
            [
                'sort_index'         => 'required',
                'action_id'        => 'required',
                'status'         => 'required',
                // 'linked_required' => 'required',
                // 'parameters' => 'required',
                // 'variables' => 'required'
            ]
        );

        $parameters = str_replace(["\n", "\t"], '', $this->parameters);

        if ($this->on_update) {
            $this->routerable->update([
                'sort_index' => $this->sort_index,
                'action_id' => $this->action_id,
                'status' => $this->status,
                'active' => $this->active,
                'parameters' => $parameters,
            ]);
        } else {
            AvailableRouterable::query()->create([
                'sort_index' => $this->sort_index,
                'action_id' => $this->action_id,
                'status' => $this->status,
                'active' => $this->active,
                'parameters' => $parameters,
            ]);
        }

        $this->alert('success', __('Operation completed successfully'), [
            'timer'             => 3000,
            'showCancelButton'  => false,
            'showConfirmButton' => false,
            'position'          => 'center',
        ]);
    }

    public function render()
    {
        if (isset($this->service_id)) {
            $service = Service::findOrFail($this->service_id);
            $this->actions = $service->actions()->where('status', 1)->get();
        } else {
            $this->actions = Action::all();
        }

        return view('livewire.admin.available_routers.available_routerable.routerable')->extends('admin.layouts.master');
    }
}
