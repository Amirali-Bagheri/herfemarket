<?php

namespace App\Http\Livewire\Admin\Services;

use App\Models\Service;
use Illuminate\Support\Facades\DB;
use Modules\Category\Entities\Category;
use Modules\Core\Http\Livewire\BaseComponent;
use Throwable;

class Update extends BaseComponent
{
    public $service;

    public $categories = [];

    public $title;

    public $en_title;

    public $slug;

    public $website;

    public $description;

    public $en_description;

    public $logo;

    public $color;

    public $direct_webhook;

    public $linked_required;

    public $recommended =  0;

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

    public $socialite;

    public $isHolder;

    public $isTesting;

    public $vpn_need;

    public $after_linked_setup;

    public $has_sub_linked;

    public $premium =  0;

    public $isHide;

    public $parameters;

    public $hasWebhook;

    public $linked_count_limit = 2;

    protected $rules = [
        'title' => ['required'],
        'en_title' => ['required'],
        'auth_type' => ['required'],
        'slug' => ['required'],
        'logo' => ['required'],
        'status_type'  => ['required'],
    ];

    public function mount($slug)
    {
        $this->service = Service::firstWhere('slug', $slug);
        $service = $this->service;
        $this->title = $service->title;
        $this->en_title = $service->en_title;
        $this->slug = $service->slug;
        $this->website = $service->website;
        $this->description = $service->description;
        $this->en_description = $service->en_description;
        $this->logo = $service->logo;
        $this->color = $service->color;
        $this->linked_required = (bool) $service->linked_required;
        $this->recommended = (bool) $service->recommended;
        $this->status = (bool) $service->status;
        $this->direct_webhook = (bool) $service->direct_webhook;
        $this->token = $service->token;
        $this->controller_class = $service->controller_class;
        $this->provider_class = $service->provider_class;
        $this->client_id = $service->client_id;
        $this->client_secret = $service->client_secret;
        $this->callback_type = $service->callback_type;
        $this->callback_url = $service->callback_url;
        $this->auth_url = $service->auth_url;
        $this->webhook_url = $service->webhook_url;
        $this->socialite = (bool) $service->socialite;
        $this->isHolder = (bool) $service->isHolder;
        $this->isTesting = (bool) $service->isTesting;
        $this->vpn_need = (bool) $service->vpn_need;
        $this->after_linked_setup = (bool) $service->after_linked_setup;
        $this->has_sub_linked = (bool) $service->has_sub_linked;
        $this->premium = (bool) $service->premium;
        $this->isHide = (bool) $service->isHide;
        $this->hasWebhook = (bool) $service->hasWebhook;
        $this->linked_count_limit = $service->linked_count_limit;
        $this->auth_type = $service->auth_type;
        $this->status_type = $service->status_type;
        $this->parameters = $service->parameters;
        $this->categories = ! empty($service->categories()->get()) ? $service->categories()->get()->pluck('id')->toArray() : [];
    }

    public function updated($input)
    {
        $this->validateOnly($input);
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

    public function submit()
    {
        try {
            $this->validate();

            // DB::beginTransaction();

            $parameters = str_replace(["\n", "\t"], '', $this->parameters);

            $this->service->update([
                'title' => $this->title,
                'en_title' => $this->en_title,
                'slug' => $this->slug,
                'website' => $this->website,
                'color' => $this->color,
                'logo'  => $this->logo,
                'description' => $this->description,
                'en_description' => $this->en_description,
                'token' => $this->token,
                'linked_required' => $this->linked_required,
                'controller_class' => $this->controller_class,
                'provider_class' => $this->provider_class,
                'client_id' => $this->client_id,
                'client_secret' => $this->client_secret,
                'recommended' => $this->recommended,
                'status_type' => $this->status_type,
                'status' => $this->status,
                'auth_url' => $this->auth_url,
                'auth_type' => $this->auth_type,
                'callback_type' => $this->callback_type,
                'callback_url' => $this->callback_url,
                'socialite' => $this->socialite,
                'isHolder' => $this->isHolder,
                'isTesting' => $this->isTesting,
                'vpn_need' => $this->vpn_need,
                'after_linked_setup' => $this->after_linked_setup,
                'has_sub_linked' => $this->has_sub_linked,
                'premium' => $this->premium,
                'linked_count_limit' => $this->linked_count_limit,
                'hasWebhook' => $this->hasWebhook,
                'webhook_url' => $this->webhook_url,
                'isHide' => $this->isHide,
                'direct_webhook' => $this->direct_webhook,
                'parameters' => $parameters,
            ]);

            $intArrayCategories = array_map(static function ($value) { return (int) $value; }, $this->categories);

            // if ($this->categories){
            $this->service->categories()->sync($intArrayCategories);
            // }else{
            //     $this->service->categories()->attach(implode(',', $intArrayCategories));
            // }

            $this->service->save();

            // DB::commit();
            //
            $this->flash('success', __('Operation completed successfully'), [
                'timer' => 3000,
                'showCancelButton' => false,
                'showConfirmButton' => false,
                'position' => 'center',
            ]);

            $this->redirect(route('admin.services.update', $this->service->slug));
        } catch (Throwable $ex) {
            // DB::rollback();
            throw $ex;
        }
    }

    public function render()
    {
        return view('livewire.admin.services.update', [
            'categories_items'=>Category::all(),
        ])->extends('admin.layouts.master', [
            'pageTitle' => 'ویرایش سرویس'.$this->title, ]);
    }
}
