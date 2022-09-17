<?php

namespace App\Http\Livewire\Admin\Actions;

use App\Models\Action;
use App\Models\Service;
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
    public $status = 1;
    public $recommended = 0;
    public $function_name;
    public $parameters;
    public $variables;
    public $action;
    public $linked_key;
    public $premium = 0;
    public $status_type;
    public $is_query = 0;
    public $daily_limit = 10000;

    public function mount($id)
    {
        $this->action = Action::query()->find($id);

        $this->services = Service::all();

        $this->title           = $this->action->title;
        $this->en_title        = $this->action->en_title;
        $this->description     = $this->action->description;
        $this->en_description  = $this->action->en_description;
        $this->service_id      = $this->action->service_id;
        $this->linked_required = (bool) $this->action->linked_required;
        $this->status          = (bool) $this->action->status;
        $this->recommended     = (bool) $this->action->recommended;
        $this->premium         = (bool) $this->action->premium;
        $this->function_name   = $this->action->function_name;
        $this->parameters      = $this->action->parameters;
        $this->status_type     = $this->action->status_type;
        $this->variables       = $this->action->variables;
        $this->linked_key      = $this->action->linked_key;
        $this->daily_limit     = $this->action->daily_limit;
        $this->is_query        = $this->action->is_query;
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
        $this->validate([
            'title'         => 'required',
            'status'        => 'required',
            // 'linked_required' => 'required',
            'service_id'    => 'required',
            'function_name' => 'required',
            // 'parameters' => 'required',
        ]);

        $parameters = str_replace(["\n", "\t"], '', $this->parameters);

        $variables = str_replace(["\n", "\t"], '', $this->variables);

        $this->action->update([
            'title'           => $this->title,
            'en_title'        => $this->en_title,
            'description'     => $this->description,
            'en_description'  => $this->en_description,
            'service_id'      => $this->service_id,
            'linked_required' => $this->linked_required,
            'status'          => $this->status,
            'recommended'     => $this->recommended,
            'function_name'   => $this->function_name,
            'parameters'      => $parameters,
            'variables'       => $variables,
            'linked_key'      => $this->linked_key,
            'daily_limit'     => $this->daily_limit,
            'status_type'     => $this->status_type,
            'is_query'     => $this->is_query,
        ]);

        $this->flash('success', __('Operation completed successfully'), [
            'timer'             => 3000,
            'showCancelButton'  => false,
            'showConfirmButton' => false,
            'position'          => 'center',
        ]);

        $this->redirect(route('admin.actions.update', $this->action->id));
    }

    public function render()
    {
        return view('livewire.admin.actions.update', ['services', $this->services])->extends('admin.layouts.master', [
            'pageTitle' => 'ویرایش اکشن',
        ]);
    }
}
