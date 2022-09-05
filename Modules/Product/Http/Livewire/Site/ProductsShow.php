<?php

namespace Modules\Product\Http\Livewire\Site;

use Agent;
use App\Jobs\Actions\NewReportByUserJob;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Exception;
use Modules\Core\Http\Livewire\BaseComponent;
use Modules\Product\Entities\Product;
use Modules\Product\Entities\ProductPrices;
use Modules\Report\Entities\ReasonType;
use Modules\Seo\Facades\Meta;
use Modules\Seo\Packages\Entities\OpenGraphPackage;
use Modules\Seo\Packages\Entities\TwitterCardPackage;
use Modules\Setting\Entities\Setting;
use Modules\Wishlist\Entities\Wishlist;
use Throwable;

class ProductsShow extends BaseComponent
{
    public $product;
    public $selected_report_reasons = [];
    public $wished = false;
    public $readyToLoadSimilarProducts = false;
    public $readyToLoadPrices = false;
    protected $listeners = [
        'sendReport',
    ];

    public function updatedWished()
    {
        if ($this->wished) {
            $this->wished = false;
        } else {
            $this->wished = true;
        }

    }

    public function mount($slug)
    {
        $this->product = Product::where('slug', $slug)
//            ->cacheFor(3600 * 24)
            ->first();

        if (empty($this->product)) {
//            abort(404);
            $this->redirect(route('site.products'));
        }



    }

    public function reportPrice($id)
    {
        try {
            $price = ProductPrices::find($id);

            NewReportByUserJob::dispatch(auth()->id(), $price, $this->selected_report_reasons);

            $this->flash('success', 'گزارش با موفقیت ارسال شد.', [
                'position' => 'center',
                'timer' => 3000,
                'toast' => true,
                'showCancelButton' => false,
                'showConfirmButton' => false,
            ]);

            $this->redirect(route('site.products.single', $this->product->slug));
        } catch (Throwable $ex) {
            throw $ex;
            $this->flash('error', 'خطا در ارسال گزارش رخ داد.', [
                'position' => 'center',
                'timer' => 3000,
                'toast' => true,
                'showCancelButton' => false,
                'showConfirmButton' => false,
            ]);

            $this->redirect(route('site.products.single', $this->product->slug));
        }
    }

    /**
     * @throws Exception
     */
    public function wishlist()
    {

//
//        if(auth()->user()->wishes()){
//
//        }
        if (Auth::check()) {

            $user = Auth::user();

            if ($this->wished) {
                $wish = auth()->user()->wishes()->where('wishable_id', $this->product->id)->delete();

                $this->flash('success', 'محصول مورد نظر از علاقه مندی های شما حذف شد', [
                    'position' => 'center',
                    'timer' => 3000,
                    'toast' => true,
                    'showCancelButton' => false,
                    'showConfirmButton' => false,
                ]);
                $this->redirect(route('site.products.single', $this->product->slug));
            } else {

                $wish = new Wishlist();
                $wish->collection_name = 'products';
                $wish->user_id = $user->id;
                $wish->wishable_type = get_class($this->product);
                $wish->wishable_id = $this->product->id;

                $wish->save();

//                $user->wish($this->product);
                $this->flash('success', 'محصول مورد نظر به فهرست علاقه مندی های شما افزوده شد', [
                    'position' => 'center',
                    'timer' => 3000,
                    'toast' => true,
                    'showCancelButton' => false,
                    'showConfirmButton' => false,
                ]);
                $this->redirect(route('site.products.single', $this->product->slug));
            }

        } else {
            $this->flash('error', 'برای افزودن و حذف علاقه مندی ها باید اول وارد حساب کاربری خود شوید', [
                'position' => 'center',
                'timer' => 3000,
                'toast' => true,
                'showCancelButton' => false,
                'showConfirmButton' => false,
            ]);
            $this->redirect(route('site.products.single', $this->product->slug));
        }
    }

    public function loadSimilarProducts()
    {
        $this->readyToLoadSimilarProducts = true;
    }

    public function loadPrices()
    {
        $this->readyToLoadPrices = true;
    }

    public function render()
    {

        if (Auth::check()) {
            $this->wished = Auth::user()->wishes()->where('wishable_id', $this->product->id)->exists();
        } else {
            $this->wished = false;
        }

        Meta::setTitleSeparator('-')->setTitle($this->product->title);
//        Meta::setDescription('لیست قیمت و فروشندگان کالای '.$this->product->title);

        $product = $this->product;

        session()->push('products.recently_viewed', $product->id);


        if (isset($product->images) and $product->images != ["product.png"]) {
            $og = new OpenGraphPackage('og_product');
            $twitter = new TwitterCardPackage('twitter_product');

            $og->setType('website')
                ->setSiteName(Setting::get('seo_meta_title'))
                ->setTitle($product->title . ' - ' . $product->en_title)
                ->setDescription('لیست قیمت و فروشندگان کالای ' . $product->title)
                ->setLocale('fa_IR')
                ->addImage($product->thumbnail_url)
                ->setUrl(route('site.products.single', $product->slug));

            $twitter->setType('summary')
                ->setSite('@' . Setting::get('social_twitter'))
                ->setTitle($product->title . ' - ' . $product->en_title)
                ->setDescription('لیست قیمت و فروشندگان کالای ' . $product->title)
                ->setImage($product->thumbnail_url);

            Meta::registerPackage($og);
            Meta::registerPackage($twitter);
            Meta::setMetaFrom($product);
        }

//        $similarProducts = Product::whereHas('categories', function ($query) use ($product) {
//            return $query->whereIn('id', $product->categories->pluck('id')->unique()->toArray());
//        })->whereNotIn('id', [$product->id])->cacheFor(3600 * 24)->limit(10)->take(10)->get();
        $similarProducts = [];
        if (isset($product->categories->last()->id)) {
            $similarProducts = Cache::rememberForever('similar_products_' . $product->id, function () use ($product) {
                return Product::whereHas('categories', function ($query) use ($product) {
                    return $query->where('id', $product->categories->last()->id);
                })->whereNotIn('id', [$product->id])
//                    ->cacheFor(3600 * 24 * 7)
                    ->limit(10)->take(10)->get();
//            return  Category::active()->where('parent_id', 0)->withCount(['products' => function ($query) {
//                $query->cacheFor(3600 * 24 * 7);
//            }])->get();
            });
        }

        $reasons = Cache::rememberForever('report_reasons', function () {
            $report_business = ReasonType::firstWhere('slug', 'report_business');
            return $report_business->reasons ?? [];
        });

//        $similarProducts =;
//        $similarProducts = [];

        visits($product)->seconds(60)->increment();

        $comments = $product->comments;
        $prices = $product->prices()
            ->whereHas('business', function ($q) {
                $q->where('status', 1);
                $q->where('pricing_status', 1);
            })
//            ->orderBy('stock', 'desc')
//            ->orderBy('stock', 'asc')
//            ->orderBy('price', 'asc')
//            ->cacheFor(3600)
//            ->dontCache()
//            ->orderBy('stock','asc')
//            ->paginate(20);
            ->get()
//            ->sortBy('stock')

            ->sortBy([['stock', 'desc'], ['final_price', 'asc']])
//                        ->sortBy('stock')
//        ->sortByDesc('final_price')
//            ->sortByDesc('stock')

        ;

        try {
            if (isset($product->property_json) and !empty($product->property_json) and $product->property_json != "null") {
                $product_properties = Cache::remember($this->id . '_product_properties', 3600 * 24 * 7, function () use ($product) {
                    return json_decode($product->property_json, true, 512, JSON_THROW_ON_ERROR);
                });
            }
        } catch (Throwable $ex) {
            $product_properties = [];
        }


        if (Agent::isMobile()) {
            return view('product::mobile.products_single', [
                'product' => $product,
                'comments' => $comments,
                'similarProducts' => $this->readyToLoadSimilarProducts ? $similarProducts : [],
                'prices' => $this->readyToLoadPrices ? $prices : [],
                'reasons' => $reasons,
                'product_properties' => $product_properties ?? [],
            ])->extends('mobile.layouts.master', ['pageTitle' => $this->product->title]);
        }

        return view('product::site.products.livewire.products_single', [
            'product' => $product,
            'comments' => $comments,
            'reasons' => $reasons,
            'similarProducts' => $this->readyToLoadSimilarProducts ? $similarProducts : [],
            'prices' => $this->readyToLoadPrices ? $prices : [],
            'product_properties' => $product_properties ?? [],
        ])
            ->extends('site.layouts.master', [
                'pageTitle' => $this->product->title
            ]);
    }
}
