<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\City;
use DB;
use Illuminate\Support\Collection;
use Modules\Business\Entities\Business;
use Modules\Category\Entities\Category;
use Modules\Core\Http\Livewire\BaseComponent;
use Modules\Core\Http\Livewire\Layouts\HeaderTrait;
use Modules\Product\Entities\Product;
use Modules\Rating\Entities\Rating;
use Modules\Seo\Facades\Meta;
use Modules\Setting\Entities\Setting;

class ProfileBusiness extends BaseComponent
{
    public            $user;
    public            $business;
    public            $business_name;
    public            $business_phone;
    public            $business_fax;
    public            $business_address;
    public            $business_website;
    public            $business_type;
    public            $business_email;
    public            $business_description;
    public            $accept_rules;
    public            $social_instagram;
    public            $social_telegram;
    public            $social_whatsapp;
    public            $state;
    public            $city;
    public            $cities;
    public            $category_parent;
    public            $category_child = [];
    public Collection $category_children;
    public            $check_all_category_children;
    public            $marketer_code;
    public            $marketer_name;


    public function mount()
    {
        $this->user             = auth()->user();
        $this->business         = $this->user->business;
        $this->business_name    = $this->business->name;
        $this->category_parent  = $this->business->category_id;
        $this->business_email   = $this->business->email;
        $this->business_address = $this->business->address;
        $this->state            = $this->business->state_id;
        $this->city             = $this->business->city_id;

        Meta::setTitleSeparator('-')->setTitle('ثبت نام کسب و کار')->prependTitle(Setting::get('seo_meta_title'));

    }

    public function editProfile()
    {
        $validatedData = $this->validate([
            'business_name'    => 'required|max:255',
            'category_parent'  => 'required',
            'business_address' => 'required',
            'business_email'   => 'sometimes|nullable|email:rfc,dns|unique:businesses,email',
            'state'            => 'required',
            'city'             => 'required',
        ]);

        try {
            DB::beginTransaction();

            $user = auth()->user();

            $this->business->update(
                [
                    'name'             => $this->business_name,
                    'description'      => $this->business_description,
                    'phone'            => $this->business_phone,
                    'fax'              => $this->business_fax,
                    'address'          => $this->business_address,
                    'website'          => $this->business_website,
                    'email'            => $this->business_email,
                    'social_telegram'  => $this->social_telegram,
                    'social_whatsapp'  => $this->social_whatsapp,
                    'social_instagram' => $this->social_instagram,
                    'category_id' => $this->category_parent,
                    'state_id' => $this->state,
                    'city_id'  => $this->city,
                    'status'   => 1,
                ]
            );

            DB::commit();

            $this->flash('success', 'اطلاعات کسب و کار با موفقیت ویرایش شد.', [
                'position'          => 'center',
                'timer'             => 10000,
                'toast'             => false,
                'showCancelButton'  => false,
                'showConfirmButton' => false,
            ]);

            return redirect()->route('dashboard.profile.business');

        } catch (\Throwable $ex) {
            DB::rollBack();

            $this->alert('error', 'خطایی رخ داد', [
                'position'          => 'center',
                'timer'             => '3000',
                'toast'             => false,
                'text'              => 'لطفا مجددا تلاش کنید',
                'showConfirmButton' => false,
                'onConfirmed'       => '',
                'confirmButtonText' => 'متوجه شدم',
            ]);

            throw $ex;
        }

    }

    public function render()
    {
        if ( ! empty($this->state)) {
            $this->cities = City::where('state_id', $this->state)->get();
        }

        if ( ! empty($this->category_parent)) {
            //            $this->category_child = [];
            //            $this->check_all_category_children = false;
            $this->category_children = Category::find($this->category_parent)->children;
        }
        if ($this->check_all_category_children === true) {
            $this->category_child = $this->category_children->pluck('id');
        } elseif ($this->check_all_category_children === false) {
            $this->category_child = [];
        }

        return view('site.dashboard.business_profile', [
        ])->extends('site.layouts.master', [
            'pageTitle' => 'داشبورد',
        ]);
    }
}
