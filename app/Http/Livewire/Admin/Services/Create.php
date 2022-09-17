<?php

namespace App\Http\Livewire\Admin\Services;

use App\Models\Service;
use Illuminate\Support\Facades\DB;
use Modules\Category\Entities\Category;
use Modules\Core\Http\Livewire\BaseComponent;
use Throwable;

class Create extends BaseComponent
{
    public $service;
    public $categories = [];
    public $title;
    public $en_title;
    public $slug;
    public $website;
    public $direct_webhook = false;
    public $description;
    public $en_description;
    public $logo;
    public $color;
    public $linked_required;
    public $recommended = false;
    public $status = 1;
    public $token;
    public $controller_class;
    public $provider_class;
    public $client_id;
    public $client_secret;
    public $callback_type = 'default';
    public $auth_types;
    public $auth_type;
    public $status_type;
    public $callback_url;
    public $auth_url;
    public $webhook_url;
    public $socialite = false;
    public $isHolder = false;
    public $isTesting = false;
    public $vpn_need = false;
    public $after_linked_setup = false;
    public $has_sub_linked = false;
    public $premium = false;
    public $isHide = false;
    public $hasWebhook = false;
    public $linked_count_limit = 2;
    protected $rules = [
        'title'       => ['required'],
        'en_title'    => ['required'],
        'auth_type'   => ['required'],
        'slug'        => ['required'],
        'logo'        => ['required'],
        'status_type' => ['required'],
    ];

    public function updated($input)
    {
        $this->validateOnly($input);
    }

    public function submit()
    {
        try {
            $this->validate();

            DB::beginTransaction();

            $service = Service::query()->create([
                'title'              => $this->title,
                'en_title'           => $this->en_title,
                'direct_webhook'     => $this->direct_webhook,
                'slug'               => $this->slug,
                'website'            => $this->website,
                'color'              => $this->color,
                'logo'               => $this->logo,
                'description'        => $this->description,
                'en_description'     => $this->en_description,
                'token'              => $this->token,
                'linked_required'    => $this->linked_required,
                'controller_class'   => $this->controller_class,
                'provider_class'     => $this->provider_class,
                'client_id'          => $this->client_id,
                'client_secret'      => $this->client_secret,
                'recommended'        => $this->recommended,
                'status_type'        => $this->status_type,
                'status'             => $this->status,
                'auth_url'           => $this->auth_url,
                'auth_type'          => $this->auth_type,
                'callback_type'      => $this->callback_type,
                'callback_url'       => $this->callback_url,
                'socialite'          => $this->socialite,
                'isHolder'           => $this->isHolder,
                'isTesting'          => $this->isTesting,
                'vpn_need'           => $this->vpn_need,
                'after_linked_setup' => $this->after_linked_setup,
                'has_sub_linked'     => $this->has_sub_linked,
                'premium'            => $this->premium,
                'linked_count_limit' => $this->linked_count_limit,
                'hasWebhook'         => $this->hasWebhook,
                'webhook_url'        => $this->webhook_url,
                'isHide'             => $this->isHide,
                'direct_webhook'     => $this->direct_webhook,
            ]);
            if ($this->categories) {
                $intArrayCategories = array_map(static function ($value) { return (int) $value; }, $this->categories);

                $service->categories()->sync($intArrayCategories);
                $service->save();
            }

            DB::commit();

            $this->flash('success', __('Operation completed successfully'), [
                'timer'             => 3000,
                'showCancelButton'  => false,
                'showConfirmButton' => false,
                'position'          => 'center',
            ]);

            $this->redirect(route('admin.services.index'));
        } catch (Throwable $ex) {
            DB::rollback();
            throw $ex;
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

    public function render()
    {
        return view('livewire.admin.services.update', [
            'categories_items' => Category::all(),
        ])->extends('admin.layouts.master', [
            'pageTitle' => 'افزودن سرویس جدید',
        ]);
    }
}
