<?php

namespace App\Http\Livewire\Admin\Triggers;

use App\Models\Service;
use App\Models\Trigger;
use Modules\Core\Http\Livewire\BaseComponent;

class Create extends BaseComponent
{
    public $title;

    public $en_title;

    public $linked_required = 0;

    public $description;

    public $en_description;

    public $services;

    public $service_id;

    public $service;

    public $function_name;

    public $parameters;

    public $variables;

    public $status_type;

    public $slug;

    public $status = 1;

    public $recommended = 0;

    public $premium = 0;

    public $webhook_setup = 0;

    public $linked_key;

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

    public $daily_limit = 10000;

    public $trigger;

    public function mount()
    {
        $this->services = Service::query()->orderBy('title', 'asc')->get();
    }

    public function submit()
    {
        $this->validate(
            [
                'title'         => 'required',
                'status'        => 'required',
                // 'linked_required' => 'required',
                'service_id'    => 'required',
                'function_name' => 'required',
                // 'parameters' => 'required',
                // 'variables' => 'required'
            ]
        );
        $parameters = str_replace(["\n", "\t"], '', $this->parameters);

        $variables = str_replace(["\n", "\t"], '', $this->variables);

        $trigger = Trigger::query()->create([
            'title'           => $this->title,
            'en_title'        => $this->en_title,
            'linked_required' => $this->linked_required,
            'description'     => $this->description,
            'en_description'  => $this->en_description,
            'service_id'      => $this->service_id,
            'recommended'     => $this->recommended,
            'function_name'   => $this->function_name,
            'parameters'      => $this->parameters,
            'variables'       => $this->variables,
            'status_type'     => $this->status_type,
            'slug'            => $this->slug,
            'status'          => $this->status,
            'premium'         => $this->premium,
            'webhook_setup'   => $this->webhook_setup,
            'linked_key'      => $this->linked_key,
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
            'daily_limit'     => $this->daily_limit,
        ]);

        $this->flash('success', __('Operation completed successfully'), [
            'timer'             => 3000,
            'showCancelButton'  => false,
            'showConfirmButton' => false,
            'position'          => 'center',
        ]);

        $this->redirect(route('admin.triggers.index'));
    }

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
        } catch (\Throwable $exception) {
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
        } catch (\Throwable $exception) {
            $this->alert('error', 'خطایی رخ داد!', [
                'timer'             => 3000,
                'showCancelButton'  => false,
                'showConfirmButton' => false,
                'position'          => 'center',
            ]);
        }
    }

    public function render()
    {
        return view('livewire.admin.triggers.update')->extends('admin.layouts.master', [
            'pageTitle' => 'افزودن رویداد جدید',
        ]);
    }
}
