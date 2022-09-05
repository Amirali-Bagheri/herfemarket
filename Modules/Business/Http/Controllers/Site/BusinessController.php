<?php

namespace Modules\Business\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Jenssegers\Agent\Agent;
use Modules\Business\Entities\Business;
use Modules\Product\Entities\ProductPrices;
use Throwable;

class BusinessController extends Controller
{
    /*
    public function businesses(Request $request, $url = null)
    {

        $params = $request->except('_token');

        $categories = Category::with('children')->get();

        $category = Category::firstWhere('slug', $url);

        if ($category) {
            if ($category->parent_id == 0) {

                return $subCategories = $category->children;

                $subCategories = json_decode(json_encode($subCategories));

                foreach ($subCategories as $subcat) {
                    $cat_ids[] = $subcat->id;
                }

                $businesses = Product::whereHas(['categories' => function ($q) use ($cat_ids) {
                    $q->whereIn('id', $cat_ids);
                }])->where('status', 1)->filter($params)->paginate(14);
            } else {

                $businesses = $category->businesses()->where('status', 1)->filter($params)->paginate(14);
            }


            Meta::setRobots('follow,index');
            Meta::setTitleSeparator('-')->setTitle('کالاها دسته ' . $category->title)->prependTitle(Setting::get('seo_meta_title'));


            return view('site.businesses', compact('businesses', 'category', 'categories', 'url'));
        }

    }

    public function filtering(Request $request)
    {
        $data = $request->except('_token');

        $cityUrl = "";
        if (!empty($data['cityFilter']) and $data['cityFilter'][0] != 0) {
            foreach ($data['cityFilter'] as $city) {
                if (empty($cityUrl)) {
                    $cityUrl = "&city=" . $city;
                } else {
                    $cityUrl .= "," . $city;
                }
            }
        }

        $sortByUrl = "";
        if (!empty($data['sortByFilter'])) {
            $sortByUrl = "&sortBy=" . $data['sortByFilter'];
        }

        $search = "";
        if (!empty($data['q'])) {
            $q = $request->q;

            Meta::setTitleSeparator('-')->setTitle('جستجوی ' . $q . ' در کسب و کار ها')->prependTitle(Setting::get('seo_meta_title'));

            $search = "&q=" . $data['q'];
        }


        // $catUrl = "";
        // if (!empty($data['catFilter'])) {
        //     foreach ($data['catFilter'] as $cat) {
        //         if (empty($catUrl)) {
        //             $catUrl = "&cat=" . $cat;
        //         } else {
        //             $catUrl .= "," . $cat;
        //         }
        //     }
        // }

        $finalUrl = "businesses/" . $data['url'] . "?" . $cityUrl . $search . $sortByUrl;
        return redirect($finalUrl);
    }

    public function index()
    {
        $categories = Category::where('status', 1)->where('parent_id', 718)->paginate(9);

        Meta::setTitleSeparator('-')->setTitle('دسته بندی کسب و کار ها')->prependTitle(Setting::get('seo_meta_title'));

        return view('site.business_categories', compact('categories'));

        // $businesses = Business::withCount('prices')->where('status', 1)->orderBy('prices_count', 'desc')->paginate(9);

        // return view('site.businesses', compact('businesses'));
    }

    public function business(Request $request, $slug)
    {
        $business = Business::where('slug', $slug)->firstOrFail();

        if (!$business->canPricing()) {
            return abort(404, 'این کسب و کار در حال حاضر غیر فعال است!');
        }

        if (!isBot()) {
            $view = visits($business)->seconds(3600)->increment();

            if ($view and $business->canPricing()) {
                $balance_after_transaction = $business->balance;
                $business->forceWithdraw(109, [
                    'description' => 'برداشت بابت بازدید',
                    'balance_after_transaction' => $balance_after_transaction - 109
                ]);
            }

        }


        $prices = $business->prices()->orderBy('stock', 'desc')->orderBy('price', 'asc')->paginate(10);
        $comments = $business->comments()->approved();

        Meta::setTitleSeparator('-')->setTitle('کسب و کار ' . $business->name)->prependTitle(Setting::get('seo_meta_title'));

        return view('site.business', compact('business', 'prices', 'comments'));
    }

    public function category(Request $request, $slug)
    {
        $category = Category::firstWhere('slug', $slug);
        visits($category)->seconds(60)->increment();

        $businesses = $category->businesses()->where('status', 1)->orderBy('created_at', 'DESC')->paginate(12);

        Meta::setTitleSeparator('-')->setTitle('کسب و کار ها')->prependTitle(Setting::get('seo_meta_title'));

        return view('site.businesses', compact('businesses', 'category'));
    }

    public function businessSearch(Request $request)
    {
        $q = $request->q;
        $businesses = Business::where('status', 1)->search($q)->paginate(12);

        Meta::setTitleSeparator('-')->setTitle('جستجوی ' . $q . ' در کسب و کار ها')->prependTitle(Setting::get('seo_meta_title'));

        return view('site.businesses', compact('businesses'));
    }

    public function categoryChildren(Request $request, $slug)
    {
        $category = Category::with('children.products')->firstWhere('slug', $slug);
        visits($category)->seconds(60)->increment();

        $categories = $category->children()->where('status', 1)->paginate(14);
        $businesses = $category->businesses()->where('status', 1)->orderBy('created_at', 'DESC')->paginate(12);

        Meta::setTitleSeparator('-')->setTitle('کسب و کار های دسته ' . $category->title)->prependTitle(Setting::get('seo_meta_title'));

        return view('site.business_category_children', compact('categories', 'category', 'businesses'));
    }
    */

    public function priceLink(Request $request, $id)
    {
        $price = ProductPrices::where('hash_id', $id)->firstOrFail();
        $business = $price->business;
        $product = $price->product;


//        dd();.
//        dd(verta(CrawledProducts::
//        active()->merged()
//            ->orderBy('crawled_at', 'asc')->first()->crawled_at)->formatDifference());
        $link = url_decode(Str::of(url_decode($price->link)));


//            return $link;

        try {
            $userAgent = $request->header('User-Agent');
            $agent = new Agent();

            $agent->setUserAgent($userAgent);
            $agent->setHttpHeaders($request->headers);
//            $geoip = geoip()->getLocation($request->ip());
//            $geoip = null;
//           return redirect()->to($link)->send();


            if ($agent->isRobot()) {
                return redirect()->route('site.products.single', $product->slug);
            }
            $is_duplicate = $price->clicks()->where('created_at', '>', Carbon::now()->subMinutes(5)->toDateTimeString())->where('ip', $request->ip())->exists();
            $click = $price->clicks()->create([
                    'user_id' => Auth::check() ? Auth::id() : null,
                    'ip' => $request->ip(),
                    'method' => $request->getMethod() ?? null,
                    'url' => $link ?? ('tell:' . ($business->phone ?? $business->manager->mobile)),
                    'os' => $agent->platform() ?? null,
                    'referer' => $request->headers->get('referer') ?? null,
                    'bot' => $agent->robot() ?? null,
                    'user_agent' => $userAgent ?? null,
//                    'country' => $geoip['country_name'] ?? null,
//                    'country_code' => $geoip['country_code2'] ?? null,
//                    'city' => $geoip['city'] ?? null,
//                    'lat' => $geoip['latitude'] ?? null,
//                    'long' => $geoip['longitude'] ?? null,
                    'browser' => $agent->browser() ?? null,
                    'is_desktop' => $agent->isDesktop() ?? null,
                    'is_mobile' => $agent->isMobile() ?? null,
                    'is_bot' => $agent->isRobot() ?? null,
                    'status' => $is_duplicate ? 'duplicate' : 'new',
                ]);

            if (isset($click) and !$is_duplicate && $business->canPricing() && !$business->isSpecialType('no_visit_withdraw')) {
                $balance_after_transaction = $business->manager->balance;

//                            $business_wallet = $business->manager->getWallet('default');

                $business->manager->forceWithdraw(setting('withdraw_business_visit'), [
                                'description' => 'برداشت بابت بازدید',
                                'balance_after_transaction' => $balance_after_transaction - setting('withdraw_business_visit')
                            ]);

                $click->update([
                                'price' => setting('withdraw_business_visit')
                            ]);
            }

            if (empty($link)) {
                return redirect('tel:' . $business->phone ?? $business->manager->mobile);
            }
//                    echo $link;
//                    dd($link);
//                    return view('redirect', compact('link'));
            return redirect()->away($link . (parse_url($link, PHP_URL_QUERY) ? '&' : '?') . http_build_query(['utm_medium' => 'PPC', 'utm_source' => 'Shago']));
//                    dd($link);

//                    return redirect(utf8_encode($link));
//                    dd($link . '?' . http_build_query(['utm_medium' => 'PPC', 'utm_source' => 'Shago']));
//                    return redirect(
//                        url_decode($price->link) . '?' . http_build_query(['utm_medium' => 'PPC', 'utm_source' => 'Shago'])
//                    );
        } catch (Throwable $exception) {
//            dd(url_decode($price->link));

//            throw $exception;
            if (isset($price->link)) {
                return redirect($link);

//                return redirect(url_decode(
//                    $price->link
//                ));
            }
            return redirect('tel:' . $business->phone ?? $business->manager->mobile);
        }
//        if (!isBot()) {
//
//            $view = visits($price)->seconds(3600)->increment();
//            $business = $price->business;
//
//            $price->increment('link_click_count');
//
//            if ($view and $business->canPricing()) {
//                if ($business->isSpecialType('no_visit_withdraw')) {
//
//                } else {
//                    $balance_after_transaction = $business->balance;
//                    $business->forceWithdraw(setting('withdraw_business_visit'), [
//                        'description' => 'برداشت بابت بازدید',
//                        'balance_after_transaction' => $balance_after_transaction - setting('withdraw_business_visit')
//                    ]);
//                }
//            }
//        }


        //        return redirect()->to(url(, ));
    }

    public function websiteLink(Request $request, $md5)
    {
        $business = Business::where('hash_id', $md5)->firstOrFail();


        $link = strpos($business->website, 'http') === false ? 'http://' . $business->website : $business->website . '?utm_source=shago';
        try {
            $userAgent = $request->header('User-Agent');
            $agent = new Agent();

            $agent->setUserAgent($userAgent);
            $agent->setHttpHeaders($request->headers);
//            $geoip = geoip()->getLocation($request->ip());
//            $geoip = null;
//           return redirect()->to($link)->send();


            if (!$agent->isRobot()) {
                $is_duplicate = $business->clicks()->where('created_at', '>', Carbon::now()->subMinutes(5)->toDateTimeString())->where('ip', $request->ip())->exists();
                $click = $business->clicks()->create([
                    'user_id' => Auth::check() ? Auth::id() : null,
                    'ip' => $request->ip(),
                    'method' => $request->getMethod() ?? null,
                    'url' => $link ?? ('tell:' . ($business->phone ?? $business->manager->mobile)),
                    'os' => $agent->platform() ?? null,
                    'referer' => $request->headers->get('referer') ?? null,
                    'bot' => $agent->robot() ?? null,
                    'user_agent' => $userAgent ?? null,
//                    'country' => $geoip['country_name'] ?? null,
//                    'country_code' => $geoip['country_code2'] ?? null,
//                    'city' => $geoip['city'] ?? null,
//                    'lat' => $geoip['latitude'] ?? null,
//                    'long' => $geoip['longitude'] ?? null,
                    'browser' => $agent->browser() ?? null,
                    'is_desktop' => $agent->isDesktop() ?? null,
                    'is_mobile' => $agent->isMobile() ?? null,
                    'is_bot' => $agent->isRobot() ?? null,
                    'status' => $is_duplicate ? 'duplicate' : 'new',
                ]);

                if (isset($click) and !$is_duplicate && $business->canPricing() && !$business->isSpecialType('no_visit_withdraw')) {
                    $balance_after_transaction = $business->manager->balance;

//                            $business_wallet = $business->manager->getWallet('default');

                    $business->manager->forceWithdraw(setting('withdraw_business_visit'), [
                                'description' => 'برداشت بابت بازدید از وب سایت',
                                'balance_after_transaction' => $balance_after_transaction - setting('withdraw_business_visit')
                            ]);

                    $click->update([
                                'price' => setting('withdraw_business_visit')
                            ]);
                }
                if (empty($link)) {
                    return redirect('tel:' . $business->phone ?? $business->manager->mobile);
                }
//                    echo $link;
//                    dd($link);
                return view('redirect', compact('link'));
//                    return redirect()->away($link);
//                    dd($link);

//                    return redirect(utf8_encode($link));
//                    dd($link . '?' . http_build_query(['utm_medium' => 'PPC', 'utm_source' => 'Shago']));
//                    return redirect(
//                        url_decode($price->link) . '?' . http_build_query(['utm_medium' => 'PPC', 'utm_source' => 'Shago'])
//                    );
            }
        } catch (Throwable $exception) {
//            dd(url_decode($price->link));

            throw $exception;
            if (isset($price->link)) {
                return redirect($link);

//                return redirect(url_decode(
//                    $price->link
//                ));
            }
            return redirect('tel:' . $business->phone ?? $business->manager->mobile);
        }
//        if (!isBot()) {
//
//            $view = visits($price)->seconds(3600)->increment();
//            $business = $price->business;
//
//            $price->increment('link_click_count');
//
//            if ($view and $business->canPricing()) {
//                if ($business->isSpecialType('no_visit_withdraw')) {
//
//                } else {
//                    $balance_after_transaction = $business->balance;
//                    $business->forceWithdraw(setting('withdraw_business_visit'), [
//                        'description' => 'برداشت بابت بازدید',
//                        'balance_after_transaction' => $balance_after_transaction - setting('withdraw_business_visit')
//                    ]);
//                }
//            }
//        }


        //        return redirect()->to(url(, ));
    }
}
