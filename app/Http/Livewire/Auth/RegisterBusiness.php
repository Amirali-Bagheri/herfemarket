<?php

namespace App\Http\Livewire\Auth;

use App\Models\City;
use DB;
use Illuminate\Support\Collection;
use Jenssegers\Agent\Facades\Agent;
use Modules\Business\Entities\Business;
use Modules\Category\Entities\Category;
use Modules\Core\Http\Livewire\BaseComponent;
use Modules\Rating\Entities\Rating;
use Modules\Seo\Facades\Meta;
use Modules\Setting\Entities\Setting;
use Modules\User\Entities\User;
use Throwable;

class RegisterBusiness extends BaseComponent
{
    public $password;
    public $password_confirmation;
    public $business_name;
    public $business_phone;
    public $business_fax;
    public $latitude;
    public $longitude;
    public $business_address;
    public $business_website;
    public $business_type;
    public $business_email;
    public $business_description;
    public $accept_rules;
    public $social_instagram;
    public $social_telegram;
    public $social_whatsapp;
    public $state;
    public $city;
    public $cities;
    public            $category_parent;
    public            $category_child = [];
    public Collection $category_children;
    public $check_all_category_children;
    public $marketer_code;
    public $marketer_name;

    public function mount()
    {
        Meta::setTitleSeparator('-')->setTitle('ثبت نام کسب و کار')->prependTitle(Setting::get('seo_meta_title'));
    }

    public function submit()
    {
        $validatedData = $this->validate([
            'business_name'        => 'required|max:255',
            //            'business_type' => 'required',
            // 'business_description' => 'required|max:380|min:10',
            //        'category_parent_type' => 'required',
            'category_parent'      => 'required',
            // 'category_child'       => 'required',
            //        'latitude' => 'required',
            //        'longitude' => 'required',
            'business_address'     => 'required',
            //            'business_address_building' => 'required',
            // 'business_address_plaque' => 'required',
            //            'business_address_unit' => 'required',
            // 'business_logo' => 'mimes:jpeg,jpg,png',
            // 'business_phone'       => 'required|min:11|max:11|regex:/[0-9]{10}/|digits:11|unique:businesses,phone',
            'business_email'       => 'sometimes|nullable|email:rfc,dns|unique:businesses,email',
            //            'manager_first_name' => 'required|max:255',
            //            'manager_last_name' => 'required|max:255',
            //            'manager_mobile' => 'required|min:11|max:11|regex:/[0-9]{10}/|digits:11|unique:users,mobile',
            //            'manager_email' => 'sometimes|nullable|email:rfc,dns|unique:users,email',
            //            'password' => 'required|min:6|confirmed',

            //            'sale_expert_first_name' => 'max:255',
            //            'sale_expert_last_name' => 'max:255',
            //            'sale_expert_mobile' => 'min:11|max:11',
            'accept_rules'         => 'required|boolean',
            'state'                => 'required',
            'city'                 => 'required',
            //            social_telegram
            //            social_whatsapp
            //            social_telegram
            //            marketer_mobile
        ]);

        try {
            DB::beginTransaction();

            $user = auth()->user();

            $user->assignRole([
                'seller',
            ]);
            $user->save();
            // Manager
            //        $user = User::firstOrCreate(['mobile' => $this->manager_mobile,],
            //            [
            //                'first_name' => $this->manager_first_name,
            //                'last_name' => $this->manager_last_name,
            //                'mobile' => $this->manager_mobile,
            //                'email' => $this->manager_email,
            //                'password' => $this->password,
            //                'status' => 1,
            //            ])->assignRole([
            //            'seller',
            //            'member',
            //        ]);

            // Business
            $business = Business::firstOrCreate(
                ['manager_id' => $user->id,],
                [
                    'name'             => $this->business_name,
                    'description'      => $this->business_description,
                    'phone'            => $this->business_phone,
                    'fax'              => $this->business_fax,
                    //                'latitude' => $this->latitude,
                    //                'longitude' => $this->longitude,
                    'address'          => $this->business_address,
                    'website'          => $this->business_website,
                    //                'type_id' => $this->business_type,
                    'email'            => $this->business_email,
                    'manager_id'       => $user->id,
                    'social_telegram'  => $this->social_telegram,
                    'social_whatsapp'  => $this->social_whatsapp,
                    'social_instagram' => $this->social_instagram,

                    'state_id' => $this->state,
                    'city_id'  => $this->city,
                    'category_id'  => $this->category_parent,
                    'status'   => 0,

                    //                'marketer_mobile' => User::role('marketer')->active()->where('mobile', $this->marketer_mobile)->exists() ? $this->marketer_mobile : null,

                ]
            );

            $business->save();


            DB::commit();

            $this->flash('success', 'ثبت نام با موفقیت انجام شد', [
                'position'          => 'center',
                'timer'             => 10000,
                'toast'             => false,
                'text'              => 'اطلاعات کسب و کار ثبت گردید. پس از بررسی توسط تیم فنی به شما اطلاع داده خواهد شد',
                'showCancelButton'  => false,
                'showConfirmButton' => false,
            ]);

            return redirect()->route('dashboard.index');
        } catch (Throwable $ex) {
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

        return view('auth.register-business')->extends('site.layouts.master', [
            'pageTitle' => 'ثبت نام کسب و کار',
        ]);
    }
}
