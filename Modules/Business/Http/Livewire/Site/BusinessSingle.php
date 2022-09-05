<?php

namespace Modules\Business\Http\Livewire\Site;

use Agent;
use Livewire\WithPagination;
use Modules\Business\Entities\Business;
use Modules\Core\Http\Livewire\BaseComponent;
use Modules\Product\Entities\ProductPrices;
use Modules\Seo\Facades\Meta;
use Modules\Setting\Entities\Setting;

class BusinessSingle extends BaseComponent
{
    use WithPagination;

    public $business;
    public $search;
    public $readyToLoadPrices = false;

    public function mount($slug)
    {
        $this->business = Business::where('slug', $slug)->firstOrFail();
        visits($this->business)->seconds(60)->increment();

    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    protected $queryString = [
        'search' => ['except' => ''],
        'page' => ['except' => 1],
    ];

    public function loadPrices()
    {
        $this->readyToLoadPrices = true;
    }

    public function render()
    {
        $business = $this->business;

//        if (!$business->canPricing()) {
//            return abort(404, 'این کسب و کار در حال حاضر غیر فعال است!');
//        }

        $userAgent = request()->header('User-Agent');
        $agent = new \Jenssegers\Agent\Agent();

        $agent->setUserAgent($userAgent);
        $agent->setHttpHeaders(request()->headers);


        /*        $geoip = geoip()->getLocation(request()->ip());

                if (!$agent->isRobot()) {
        //            $view = visits($business)->seconds(3600)->increment();
                    $is_duplicate = $business->clicks()->where('ip',request()->ip())->exists();
                    $click = $business->clicks()->create([
                        'user_id' => \Auth::check() ? \Auth::id() : null,
                        'ip' => request()->ip() ?? null,
                        'method' => request()->getMethod() ?? null,
                        'url' => route('site.businesses.single',$business->slug) ?? null,
                        'os' => $agent->platform() ?? null,
                        'referer' => request()->headers->get('referer') ?? null,
                        'bot' => $agent->robot() ?? null,
                        'user_agent' => $userAgent ?? null,
                        'country' => $geoip['country_name'] ?? null,
                        'country_code' => $geoip['country_code2'] ?? null,
                        'city' => $geoip['city'] ?? null,
                        'lat' => $geoip['latitude'] ?? null,
                        'long' => $geoip['longitude'] ?? null,
                        'browser' => $agent->browser() ?? null,
                        'is_desktop' => $agent->isDesktop() ?? null,
                        'is_mobile' => $agent->isMobile() ?? null,
                        'is_bot' => $agent->isRobot() ?? null,
                        'status' => $is_duplicate ? 'duplicate' : 'new',
                    ]);
                    if ($click and $business->canPricing()) {
                        if ($business->isSpecialType('no_visit_withdraw')) {

                        } else {
                            $balance_after_transaction = $business->balance;
                            $business->forceWithdraw(setting('withdraw_business_visit'), [
                                'description' => 'برداشت بابت بازدید',
                                'balance_after_transaction' => $balance_after_transaction - setting('withdraw_business_visit')
                            ]);
                        }
                    }

        //            if ($view and $business->canPricing()) {
        //               if ($business->type_id != 7){
        //                   if ($business->isSpecialType('no_visit_withdraw')) {
        //
        //                   } else {
        //                       $balance_after_transaction = $business->balance;
        //                       $business->forceWithdraw(109, [
        //                           'description' => 'برداشت بابت بازدید',
        //                           'balance_after_transaction' => $balance_after_transaction - 109
        //                       ]);
        //                   }
        //               }
        //            }

                }*/

        $pricing_status = $business->pricing_status;

        if ($pricing_status == 1) {
            $search = persian_number_to_english($this->search);
            $prices = ProductPrices::where('business_id', $business->id)->where('status', 1)
                ->when(!empty($search), function ($query) use ($search) {
                    $query->whereHas('crawled_product', function ($q) use ($search) {
                        $q->where('status', 1)->whereLike('title', $search);

                    });
                })

//                ->orderBy('stock', 'desc')
//                ->cacheFor(3600)
//                ->dontCache()
                ->get()
                ->sortByDesc('stock');
            $prices = collect($prices)->paginate(10);
        } else {
            $prices = collect([])->paginate(10);
        }

        $comments = $business->comments()->approved();

        Meta::setTitleSeparator('-')->setTitle('کسب و کار ' . $business->name)->prependTitle(Setting::get('seo_meta_title'));

        if (!Agent::isMobile()) {
            return view('business::site.business', [
                'business' => $business,
                'comments' => $comments,
                'prices' => $this->readyToLoadPrices ? $prices : [],
            ])->extends('site.layouts.master');
        }
//            $products_slider =  $this->business->products()->with('prices')->has('prices')
//                ->whereHas('prices', function (Builder $query) {
//                    $query->whereNotNull('price');
//                })
//                ->withCount('visits')->orderBy('visits_count', 'desc')
//                ->offset(10)
//                ->limit(9)
//                ->cacheFor(3600 * 24 * 7)
//                ->get();
        return view('business::mobile.business', [
            'business' => $business,
            'comments' => $comments,
            'prices' => $prices ?? [],
        ])->extends('mobile.layouts.master');
    }
}
