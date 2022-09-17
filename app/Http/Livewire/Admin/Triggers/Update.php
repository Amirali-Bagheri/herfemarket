<?php

namespace App\Http\Livewire\Admin\Triggers;

use App\Models\Service;
use App\Models\Trigger;
use Modules\Core\Http\Livewire\BaseComponent;
use Throwable;

class Update extends BaseComponent
{
    public $title;

    public $en_title;

    public $linked_required = 0;

    public $description;

    public $en_description;

    public $services;

    public $service_id;

    public $service;

    public $recommended =  0;

    public $function_name;

    public $parameters;

    public $variables;

    public $status_type;

    public $slug;

    public $status = 1;

    public $premium = 0;

    public $webhook_setup;

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

    public function mount($id)
    {
        $this->trigger = Trigger::query()->where('id', $id)->orWhere('md5', $id)->orWhere('slug', $id)->first();

        $this->services = Service::query()->orderBy('title', 'asc')->get();

        $this->service = $this->trigger->service;

        $this->title = $this->trigger->title;
        $this->en_title = $this->trigger->en_title;
        $this->linked_required = $this->trigger->linked_required;
        $this->description = $this->trigger->description;
        $this->en_description = $this->trigger->en_description;
        $this->service_id = $this->trigger->service_id;
        $this->recommended = (bool) $this->trigger->recommended;
        $this->function_name = $this->trigger->function_name;
        $this->parameters = $this->trigger->parameters;
        $this->variables = $this->trigger->variables;
        $this->status_type = $this->trigger->status_type;
        $this->slug = $this->trigger->slug;
        $this->status = (bool) $this->trigger->status;
        $this->premium = (bool) $this->trigger->premium;
        $this->webhook_setup = (bool) $this->trigger->webhook_setup;
        $this->linked_key = $this->trigger->linked_key;
        $this->daily_limit = $this->trigger->daily_limit;
        $this->repeatable = $this->trigger->repeatable;
        $this->repeat_type = $this->trigger->repeat_type;
        $this->repeat_every = $this->trigger->repeat_every;
        $this->repeat_at = $this->trigger->repeat_at;
        $this->cron = $this->trigger->cron;

        $this->listenable = $this->trigger->listenable;
        $this->listen_at = $this->trigger->listen_at;
        $this->listen_value = $this->trigger->listen_value;
        $this->listen_type = $this->trigger->listen_type;
        $this->listen_every = $this->trigger->listen_every;
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

        $this->trigger->update([
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

        $this->redirect(route('admin.triggers.update', $this->trigger->id));
    }

    public function render()
    {
        return view('livewire.admin.triggers.update')->extends('admin.layouts.master', [
            'pageTitle' => 'ویرایش رویداد',
        ]);
    }
}
