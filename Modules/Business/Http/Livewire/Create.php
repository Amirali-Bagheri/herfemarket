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
    public $social_linkedin;
    public $social_telegram;
    public $social_whatsapp;
    public $social_instagram;
    public $social_twitter;
    public $has_enamad;
    public $category_parent;
    public $special_status = 0;
    public $special_type = [];

    public $marketer_mobile;

    public $categories = [];
    public $category_search = '';
    public $category_search_list = [];
    protected $updatesQueryString = ['category_search'];

    public function searchCategories()
    {
        $this->category_search_list = Category::search($this->category_search)->orderBy('title')->get()->pluck('id');
    }

    public function submit()
    {
        $validatedDate = $this->validate([
            'name' => 'required',
            //            'manager_first_name' => 'required|max:255',
            //            'manager_last_name' => 'required|max:255',
            //            'manager_email' => 'nullable|email',
            //            'manager_mobile' => 'required|min:11|max:11|regex:/[0-9]{10}/|digits:11|unique:users,mobile',
            //            'password' => 'required|min:6|confirmed',
            //            'category_parent' => 'required',
            //            'manager_id' => 'required',
            //            'has_enamad' => 'required',
            //            'accept_rules' => 'required|boolean',
        ]);


        $business = Business::create([
            'name' => $this->name,
            'has_enamad' => $this->has_enamad,
            'description' => $this->description,
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

            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'address' => $this->address,
            'marketer_mobile' => $this->marketer_mobile,

            'special_status' => $this->special_status,
            'special_type' => json_encode($this->special_type),

            'state_id' => $this->state_id,
            'city_id' => $this->city_id,
            'status' => $this->status,
        ]);

        if ($this->logo) {
            $filename = $business->id . '_logo' . time() . '.' . $this->logo->extension();
            $this->logo->storeAs('/uploads/logos', $filename);
            $business->logo = $filename;
        }

        $rating = new Rating();

        $rating->rating = 5;
        $business->rating()->save($rating);

        //        $business->categories()->attach($this->category_parent);
        $business->categories()->sync($this->categories);

        $business->save();

        $this->alert('success', 'عملیات با موفقیت انجام شد', [
            'timer' => 3000,
            'showCancelButton' => false,
            'showConfirmButton' => false,
            'position' => 'center'
        ]);
    }

    public function render()
    {
        if (!empty($this->state_id)) {
            $this->cities = City::where('state_id', (int)$this->state_id)->orderBy('name')->get();
        }
        return view('business::livewire.create')
            ->withStates(State::orderBy('name')->get());
    }
}
