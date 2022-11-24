<?php

namespace Modules\Business\Http\Livewire;

use App\Models\City;
use App\Models\State;
use Livewire\WithFileUploads;
use Modules\Business\Entities\Business;
use Modules\Category\Entities\Category;
use Modules\Core\Http\Livewire\BaseComponent;
use Modules\Rating\Entities\Rating;

class Create extends BaseComponent
{
    use WithFileUploads;

    public $business;
    public $name;
    public $slug;
    public $description;
    public $phone;
    public $fax;
    public $email;
    public $latitude;
    public $longitude;
    public $address;
    public $website;
    public $type_id;
    public $logo;
    public $state_id;
    public $city_id;
    public $cities = [];
    public $manager_id;
    public $status = 1;

    public $special_status;
    public $special_type = [];

    public $social_linkedin;
    public $social_telegram;
    public $social_whatsapp;
    public $social_instagram;
    public $social_twitter;
    public $marketer_mobile;
    public $categories = [];
    public $category_search = '';
    public $category_search_list = [];
    public $new_categories = [];
    protected $updatesQueryString = ['category_search'];

    public function searchCategories()
    {
        $this->category_search_list = Category::search($this->category_search)->orderBy('title')->get()->pluck('id');
    }

    public function submit()
    {
        try {
            $validatedDate = $this->validate([
                'name' => 'required',
            ]);

            if (!$this->special_status) {
                $this->special_type = [];
            }

            $business = Business::create([
                'name' => $this->name,
                'description' => $this->description,
                'slug' => $this->slug,
                'phone' => $this->phone,
                'fax' => $this->fax,
                'email' => $this->email,
                'manager_id' => $this->manager_id,
                'type_id' => $this->type_id,
                'website' => $this->website,
                'social_telegram' => $this->social_telegram,
                'social_whatsapp' => $this->social_whatsapp,
                'social_instagram' => $this->social_instagram,
                'social_linkedin' => $this->social_linkedin,
                'social_twitter' => $this->social_twitter,

                'marketer_mobile' => $this->marketer_mobile,
                'latitude' => $this->latitude,
                'longitude' => $this->longitude,
                'address' => $this->address,

                'special_status' => $this->special_status,
                'special_type' => json_encode($this->special_type),

                'state_id' => $this->state_id,
                'city_id' => $this->city_id,
                'status' => $this->status,

            ]);

            $business->save();

            if ($this->logo) {
                $filename = $this->business->id . '_logo' . time() . '.' . $this->logo->extension();
                $this->logo->storeAs('/uploads/logos', $filename);
                $this->business->logo = $filename;
            }

            if ($this->new_categories) {
                $this->business->categories()->sync($this->new_categories);
            }

            $business->save();

            $this->flash('success', 'عملیات با موفقیت انجام شد', [
                'timer' => 3000,
                'showCancelButton' => false,
                'showConfirmButton' => false,
                'position' => 'center'
            ]);

            $this->redirect(route('admin.businesses.index'));
        } catch (\Throwable $ex) {
            throw $ex;
        }
    }

    public function render()
    {
        if (!empty($this->state_id)) {
            $this->cities = City::where('state_id', (int)$this->state_id)->orderBy('name')->get();
        }
        return view('business::livewire.update')
            ->withStates(State::orderBy('name')->get());
    }
}
