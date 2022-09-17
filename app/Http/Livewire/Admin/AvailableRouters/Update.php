<?php

namespace App\Http\Livewire\Admin\AvailableRouters;

use App\Models\AvailableRouterable;
use App\Models\AvailableTriggerAction;
use App\Models\Service;
use App\Models\Trigger;
use Illuminate\Support\Facades\DB;
use Modules\Core\Http\Livewire\BaseComponent;
use Throwable;

class Update extends BaseComponent
{
    public $update_on = false;
    public $title;
    public $en_title;
    public $description;
    public $trigger_id;
    public $user_id;
    public $action_id;
    public $action_ids;
    public $parameters;
    public $status = 1;
    public $recommended = 0;
    public $premium = 0;
    public $available_router;
    public $services;
    public $service;
    public $service_id;
    public $trigger;
    public $num = 0;
    public $trigger_clicked = false;
    public $routerable_items = [];
    public $i = 0;
    public $listeners = [
        'refreshComponent' => '$refresh',
    ];
    public $available_routerables;

    public function mount($id)
    {
        $this->services = Service::all();
        $this->available_router      = AvailableTriggerAction::query()->where('id', $id)->first();
        $this->title                 = $this->available_router->title;
        $this->en_title              = $this->available_router->en_title;
        $this->description           = $this->available_router->description;
        $this->trigger_id            = $this->available_router->trigger_id;
        $this->trigger               = $this->available_router->trigger;
        $this->service               = $this->trigger->service;
        $this->service_id            = $this->trigger->service_id;
        $this->available_routerables = $this->available_router->available_routerables;
        $this->parameters            = $this->available_router->parameters;
        $this->status                = (bool) $this->available_router->status;
        $this->premium               = (bool) $this->available_router->premium;
        $this->recommended           = (bool) $this->available_router->recommended;
        $this->action_ids            = $this->available_router->action_ids;

        foreach ($this->available_routerables as $routerable){
            $this->i++;
            $key = $this->i;
            $this->routerable_items[$key]['action_id'] = $routerable['action_id'] ?? null;
            $this->routerable_items[$key]['service_id'] = $routerable->action->service_id ?? null;
            $this->routerable_items[$key]['trigger_id'] = $routerable['trigger_id'] ?? null;
            $this->service_id = $routerable->trigger->service_id ?? null;
            $this->routerable_items[$key]['status'] = $routerable['status'] ?? null;
            $this->routerable_items[$key]['sort_index'] = $routerable['sort_index'] ?? null;
            $this->routerable_items[$key]['parameters'] = $routerable['parameters'] ?? null;

        }

    }
    public function createRouterableBox()
    {
        $this->i++;
        $key = $this->i;
        //        $this->routerable_items[$key]['available_trigger_action_id'] = null;
        $this->routerable_items[$key]['action_id'] = null;
        $this->routerable_items[$key]['trigger_id'] = $this->trigger_id;
        $this->routerable_items[$key]['status'] = 1;

        //            $key = $this->i + 1;
        $key = $this->i;
        //        $this->routerable_items[$key]['available_trigger_action_id'] = null;
        $this->routerable_items[$key]['action_id']  = null;
        $this->routerable_items[$key]['trigger_id'] = $this->trigger_id;
        $this->routerable_items[$key]['status']     = 1;
        $this->routerable_items[$key]['sort_index'] = $key;
        $this->routerable_items[$key]['parameters'] = null;

        $this->emit('refreshComponent');
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
                'title'      => 'required',
                'status'     => 'required',
                // 'linked_required' => 'required',
                'trigger_id' => 'required',
                // 'parameters' => 'required',
                // 'variables' => 'required'
            ]
        );

        try {
            $parameters = str_replace(["\n", "\t"], '', $this->parameters);

            DB::transaction(function () use ($parameters) {

                $available_router = $this->available_router->update([
                    'title'       => $this->title,
                    'en_title'    => $this->en_title,
                    'description' => $this->description,
                    'parameters'  => $parameters,
                    'status'      => $this->status,
                    'trigger_id'  => $this->trigger_id,
                    'premium'     => $this->premium,
                    'recommended' => $this->recommended,
                ]);

                $this->available_router->available_routerables()->delete();

                foreach ($this->routerable_items as $key => $value) {
                    if ( ! isset($this->routerable_items[$key]) or ! isset($this->routerable_items[$key]['action_id']) or
                        ! isset($this->routerable_items[$key]['sort_index'])) {
                        $this->alert('error', 'اطلاعات را وارد کنید!', [
                            'timer'             => 3000,
                            'showCancelButton'  => false,
                            'showConfirmButton' => false,
                            'position'          => 'center',
                        ]);
                    } else {
                        AvailableRouterable::query()->create([
                            'available_trigger_action_id' => $this->available_router->id ,
                            'trigger_id' => $this->trigger_id ?? null,
                            'action_id'  => ($this->routerable_items[$key]['action_id']) ?? null,
                            'status'     => ($this->routerable_items[$key]['status']) ?? 1,
                            'sort_index' => ($this->routerable_items[$key]['sort_index']) ?? $key,
                            'parameters' => ($this->routerable_items[$key]['parameters']) ?? null,
                        ]);
                    }
                }
            });

            $this->alert('success', __('Operation completed successfully'), [
                'timer'             => 3000,
                'showCancelButton'  => false,
                'showConfirmButton' => false,
                'position'          => 'center',
            ]);
        } catch (Throwable $ex) {
            throw $ex;
            // $this->alert('error',$ex->getMessage() , [
            //     'timer'             => 3000,
            //     'showCancelButton'  => false,
            //     'showConfirmButton' => false,
            //     'position'          => 'center',
            // ]);
        }
        // $this->redirect(route('admin.available_routers.index'));
    }

    public function render()
    {
        if (isset($this->service_id)) {
            $service          = Service::findOrFail($this->service_id);
            $this->triggers   = $service->triggers()->where('status', 1)->get();
            $this->trigger_id = $this->available_router->trigger_id;
        } else {
            $this->triggers = Trigger::all();
        }

        return view('livewire.admin.available_routers.update')->extends('admin.layouts.master', [
            'pageTitle' => 'ویرایش سناریو سناریو های آماده',
        ]);
    }
}
