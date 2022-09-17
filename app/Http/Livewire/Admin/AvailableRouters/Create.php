<?php

namespace App\Http\Livewire\Admin\AvailableRouters;

use App\Models\AvailableRouterable;
use App\Models\AvailableTriggerAction;
use App\Models\Service;
use Illuminate\Support\Facades\DB;
use Modules\Core\Http\Livewire\BaseComponent;
use Throwable;

class Create extends BaseComponent
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

    public function mount()
    {
        $this->services              = Service::all();
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

    public function trigger_id_click()
    {
        $this->trigger_clicked = true;
        AvailableRouterable::create(['status' => 0, 'trigger_id' => $this->trigger_id]);
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

                $available_router = AvailableTriggerAction::create([
                    'title'       => $this->title,
                    'en_title'    => $this->en_title,
                    'description' => $this->description,
                    'parameters'  => $parameters,
                    'status'      => $this->status,
                    'trigger_id'  => $this->trigger_id,
                    'premium'     => $this->premium,
                    'recommended' => $this->recommended,
                ]);

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
                        $array = [
                            'available_trigger_action_id' => $available_router->id,
                            'trigger_id' => $this->trigger_id ?? null,
                            'action_id'  => ($this->routerable_items[$key]['action_id']) ?? null,
                            'status'     => ($this->routerable_items[$key]['status']) ?? 1,
                            'sort_index' => ($this->routerable_items[$key]['sort_index']) ?? $key,
                            'parameters' => ($this->routerable_items[$key]['parameters']) ?? null,
                        ];

                        AvailableRouterable::query()->create($array);
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
        if ( ! empty($this->service_id)) {
            $service  = Service::findOrFail($this->service_id);
            $triggers = $service->triggers()->get();
        }

        //        dd($this->routerables);
        return view('livewire.admin.available_routers.update', [
            'triggers' => $triggers ?? [],
        ])->extends('admin.layouts.master', [
            'pageTitle' => 'ایجاد سناریو های آماده',
        ]);
    }
}
