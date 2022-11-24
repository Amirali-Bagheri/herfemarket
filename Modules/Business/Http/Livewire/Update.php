<?php

namespace Modules\Business\Http\Livewire;

use App\Models\City;
use App\Models\State;
use App\Notifications\SMSNotification;
use Livewire\WithFileUploads;
use Modules\Api\Repositories\ApiRepository;
use Modules\Business\Entities\Business;
use Modules\Category\Entities\Category;
use Modules\Core\Http\Livewire\BaseComponent;
use Modules\Setting\Entities\Setting;
use Throwable;

class Update extends BaseComponent
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
    public $has_enamad;
    public $marketer_mobile;
    public $pricing_status;
    public $wallet_charge;
    public $wallet_charge_description;
    public $enamad_activity_history;
    public $enamad_star;
    public $enamad_expiration;
    public $enamad_response_time;
//    public $category_parent;
//    public $category_parent_children = [];


    public $categories = [];
    public $category_search = '';
    public $category_search_list = [];
    public $new_categories = [];
    public $active_status_sms;
    public $sms_custom_text;
    public $free_charge_sms;
    protected $updatesQueryString = ['category_search'];

    public function searchCategories()
    {
        if (empty($this->category_search)) {
            $this->category_search_list = Category::where('parent_id', 0)->orderBy('title')->get()->pluck('id');
        } else {
            $this->category_search_list = Category::search($this->category_search)->orderBy('title')->get()->pluck('id');
        }
    }

    public function removeCategory($id)
    {
        $this->business->categories()->detach($id);
        unset($this->categories[$id], $this->new_categories[$id]);
//        $this->business->categories()->sync($this->new_categories);
        $this->business->categories()->detach($id);
        $this->business->save();

        $this->categories = $this->business->categories()->pluck('title', 'id')->toArray();
        $this->new_categories = [];


        $this->alert('success', 'عملیات با موفقیت انجام شد', [
            'timer' => 3000,
            'toast' => true,
            'showCancelButton' => false,
            'showConfirmButton' => false,
            'position' => 'center'
        ]);
    }

    public function mount($id)
    {
        $business = Business::findOrFail($id);
        $this->business = $business;
        $this->name = $business->name;
        $this->slug = $business->slug;
        $this->description = $business->description;
        $this->phone = $business->phone;
        $this->fax = $business->fax;
        $this->email = $business->email;
        $this->latitude = $business->latitude;
        $this->longitude = $business->longitude;
        $this->address = $business->address;
        $this->website = $business->website;
        $this->type_id = $business->type_id;
//        $this->logo = $business->logo;
        $this->state_id = $business->state_id;
        $this->city_id = $business->city_id;
        $this->cities = City::where('state_id', (int)$this->state_id)->orderBy('name')->get();
        $this->manager_id = $business->manager_id;
        $this->status = $business->status;
        $this->social_linkedin = $business->social_linkedin;
        $this->social_telegram = $business->social_telegram;
        $this->social_whatsapp = $business->social_whatsapp;
        $this->social_instagram = $business->social_instagram;
        $this->social_twitter = $business->social_twitter;
        $this->marketer_mobile = $business->marketer_mobile;
        $this->has_enamad = $business->has_enamad;
        $this->special_status = $business->special_status;
        $this->enamad_activity_history = $business->enamad_activity_history;
        $this->enamad_star = $business->enamad_star;
        $this->enamad_expiration = $business->enamad_expiration;
        $this->enamad_response_time = $business->enamad_response_time;
        $this->special_type = json_decode($business->special_type);
        $this->pricing_status = $business->pricing_status;
//        $this->category_parent = $business->categories()->where('parent_id', 0)->exists() ? $business->categories()->where('parent_id', 0)->first()->id : 0;
//        $this->category_parent = 0;
//        $this->category_parent_children = $business->has('categories') ? $business->categories->pluck('id')->toArray() : [];
//        dd($business->categories,$business->categories()->pluck('id'))
//        $this->categories = $business->categories->pluck('title', 'id')->toArray();
//        $this->new_categories = $business->categories->pluck('id')->toArray();

        $this->categories = $business->categories()->pluck('title', 'id')->toArray();
        $this->new_categories = $business->categories->pluck('id')->toArray();
    }

    public function submit()
    {
        try {
//            \DB::beginTransaction();
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

            if (!$this->special_status) {
                $this->special_type = [];
            }

            $this->business->update([
                'name' => $this->name,
                'has_enamad' => $this->has_enamad,
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

            ]);
            $this->business->pricing_status = (bool)$this->pricing_status;
            $this->business->save();


            if ($this->logo) {
                $filename = $this->business->id . '_logo' . time() . '.' . $this->logo->extension();
                $this->logo->storeAs('/uploads/logos', $filename);
                $this->business->logo = $filename;
            }
            if (isset($this->wallet_charge)) {
                $balance_after_transaction = $this->business->manager->getWallet('default')->balance;
                $amount = persian_number_to_english($this->wallet_charge);

//                app(DatabaseServiceInterface::class)->transaction(static function () use($amount,$business){
//                    $business->deposit($amount);
//                });

                $business_wallet = $this->business->manager->getWallet('default');

                $business_wallet->deposit($amount, [
                    'description' => $this->wallet_charge_description ?? '-',
                    'balance_after_transaction' => $balance_after_transaction + $amount
                ]);
            }

            if ($this->new_categories) {
                $this->business->categories()->sync($this->new_categories);

//            $this->business->categories()->attach($this->categories);
//                $this->business->categories()->sync($this->new_categories);
//        $this->business->categories()->attach($this->category_parent);
//        $this->business->categories()->sync($this->category_parent_children);

//            $this->business->save();
            }

            $watermark = Setting::get('site_description');


            if ($this->status != $this->business->status) {
                $this->business->update([
                    'status' => $this->status,
                ]);

                if ($this->status == 1) {
                    $business_special_types = json_decode($this->business->special_type, true, 512, JSON_THROW_ON_ERROR) ?? null;
                    if ($this->special_status and !empty($business_special_types) and in_array('new_businesses_campaign', $business_special_types, true)) {
                        $final_sms_text = 'همکار گرامی کسب و کار شما فعال و هدیه ثبت نام به کیف پول شما در پنل کاربری واریز گردید.';

                        $balance_after_transaction = $this->business->manager->getWallet('default')->balance;
                        $free_charge_amount = persian_number_to_english(50000);
//
                        $business_wallet = $this->business->manager->getWallet('default');

                        $business_wallet->deposit($free_charge_amount, [
                            'description' => 'شارژ اولیه هدیه',
                            'balance_after_transaction' => $balance_after_transaction + $free_charge_amount
                        ]);

                        $this->business->update([
                            'pricing_status' => 1,
                        ]);
                    } else {
                        $final_sms_text = 'همکار گرامی، کسب و کار شما فعال گردید. لطفا نسبت به شارژ کیف پول خود اقدام نمایید تا محصولات شما نمایش داده شود.';
                    }
                } elseif ($this->status == 0) {
                    $final_sms_text = 'همکار گرامی کسب و کار شما غیر فعال شد.';
                }
            }

            if (!empty($this->sms_custom_text)) {
                $final_sms_text = $this->sms_custom_text;
            } elseif ($this->active_status_sms) {
                $final_sms_text = 'همکار گرامی، کسب و کار شما فعال گردید. لطفا نسبت به شارژ کیف پول خود اقدام نمایید تا محصولات شما نمایش داده شود.';
            } elseif ($this->free_charge_sms) {
                $final_sms_text = 'همکار گرامی کسب و کار شما فعال و هدیه ثبت نام به کیف پول شما در پنل کاربری واریز گردید.';
            }

            $this->business->save();


//        dump($this->business->wasRecentlyCreated);
//        dump(verta($this->business->created_at)->isLastMonth());
//        dd($this->business->wasRecentlyCreated);
//        if ($this->status != $this->business->status) {
//            $this->business->update([
//                'status' => $this->status,
//            ]);
//
//            if ($this->status == 1) {
//                if (in_array('new_businesses_campaign',$this->special_type)) {
//                    $final_sms_text = 'همکار گرامی کسب و کار شما فعال و هدیه ثبت نام به کیف پول شما در پنل کاربری واریز گردید.';
//
//                }else{
//
//                }
//            }elseif($this->status == 0){
//
//            }
//        }


            if (!empty($final_sms_text)) {
                $final_sms_text .= PHP_EOL . PHP_EOL;
                $final_sms_text .= $watermark;
                $this->business->manager->notify(new SMSNotification($this->business->manager->mobile, $final_sms_text));
            }
//            \DB::commit();

            $this->flash('success', 'عملیات با موفقیت انجام شد', [
                'timer' => 3000,
                'showCancelButton' => false,
                'showConfirmButton' => false,
                'position' => 'center'
            ]);

            $this->redirect(route('admin.businesses.update', $this->business->id));
        } catch (Throwable $ex) {
//            \DB::rollback();
            throw $ex;
        }
    }

    public function updateEnamad()
    {
//        $host = 'http://172.17.0.2:4444/wd/hub';
//        $capabilities = DesiredCapabilities::chrome();
//
//        $driver = RemoteWebDriver::create($host, $capabilities);
//
//        $driver->get('https://enamad.ir/DomainListForMIMT?se=yekilink.com');
//
//        $elements = $driver->findElements(WebDriverBy::cssSelector('#ListContent #Div_Content .row a'));
        //// $elements is now array - containing instances of RemoteWebElement (or empty, if no element is found)
//
//        foreach ($elements as $element) {
//            var_dump($element->getText());
//        }
//
//        dd($element);
//        Salvager::browse(function (Browser $browser) use (&$crawler) {
//            $crawler = $browser->visit('https://www.google.com/')
//                ->keys('input[name=q]', 'Laravel', '{enter}')
//                ->screenshot('google-laravel')
//                ->crawler();
//        });
//
//        /**
//         * @var Crawler $crawler
//         */
//        $crawler->filter('.r')->each(function (Crawler $node) {
//            dump($node->filter('h3')->text());
//            dump($node->filter('a')->attr('href'));
//        });
//        dd('test');
        $repository = new ApiRepository();
        $enamad_reuslt = $repository->enamad($this->business->website);


        if (isset($enamad_reuslt['error']) and $enamad_reuslt['error'] == true) {
            $this->alert('error', 'خطا در برقراری اتصال با نماد الکترونیک', [
                'position' => 'center',
                'timer' => '5000',
                'toast' => false,
                'text' => 'ارتباط با ای نماد در حال حاضر ممکن نیست لطفا بعدا تلاش نمایید',
            ]);
        } elseif (isset($enamad_reuslt)) {
            $this->business->update([
                'has_enamad' => true,
                'enamad_activity_history' => $enamad_reuslt['enamad_activity_history'] ?? null,
                'enamad_star' => $enamad_reuslt['enamad_star'] ?? null,
                'enamad_expiration' => $enamad_reuslt['enamad_expiration'] ?? null,
                'enamad_response_time' => $enamad_reuslt['enamad_response_time'] ?? null,
                'phone' => $enamad_reuslt['phone'] ?? null,
                'address' => $enamad_reuslt['address'] ?? null,
                'email' => $enamad_reuslt['email'] ?? null,
                'enamad_crawled_at' => now(),
            ]);

            $this->flash('success', 'عملیات با موفقیت انجام شد', [
                'timer' => 3000,
                'toast' => true,
                'showCancelButton' => false,
                'showConfirmButton' => false,
                'position' => 'center'
            ]);

            $this->redirect(route('admin.businesses.update', $this->business->id));
        } else {
            $this->alert('warning', 'وب سایت وارد شده دارای نماد اعتماد الکترونیک نمی باشد', [
                'position' => 'center',
                'timer' => '10000',
                'toast' => false,
                'text' => 'اطلاعات کسب و کار ثبت گردید ولی تا زمان دریافت نماد اعتماد الکترونیک، کسب و کار شما غیرفعال خواهد بود',
                'showConfirmButton' => true,
                'onConfirmed' => '',
                'confirmButtonText' => 'متوجه شدم',
            ]);
        }
    }

    public function render()
    {
        if (!empty($this->state_id)) {
            $this->cities = City::where('state_id', (int)$this->state_id)->orderBy('name')->get();
        }
        return view('business::livewire.update')->extends('admin.layouts.master', [
            'pageTitle' => 'ویرایش ' . $this->business->name
        ])
            ->withStates(State::orderBy('name')->get());
    }
}
