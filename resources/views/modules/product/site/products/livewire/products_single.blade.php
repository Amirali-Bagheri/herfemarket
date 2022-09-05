<div>
    @include('site.layouts.errors')

    @push('scripts')
        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
        <script src="/plugins/blowup/blowup.min.js"></script>

        <script>
            $(document).ready(function () {
                $(".img-container").blowup({
                    "width": 100,
                    "height": 100
                });
            })

            document.addEventListener('livewire:load', () => {
                Livewire.hook('message.processed', (message, component) => {
                    $(".img-container").blowup({
                        "width": 100,
                        "height": 100
                    });
                });
            });
        </script>

    @endpush

    <div class="section-full small-device p-b30 bg-white">

        <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #eee !important;">
            <div class="container-fluid">

                {{--                <nav aria-label="breadcrumb color-black">--}}
                {{--                    <ol class="breadcrumb lighten-4">--}}
                {{--                        <li class="breadcrumb-item">--}}
                {{--                            <a class="black-text" href="#">Home</a>--}}
                {{--                            <i class="far fa-caret-left mx-2 color-black" aria-hidden="true"></i>--}}
                {{--                        </li>--}}
                {{--                        <li class="breadcrumb-item"><a class="black-text" href="#">Library</a>--}}
                {{--                            <i class="fae fa-caret-left mx-2 color-black" aria-hidden="true"></i>--}}
                {{--                        </li>--}}
                {{--                        <li class="breadcrumb-item color-black">Data</li>--}}
                {{--                    </ol>--}}
                {{--                </nav>--}}
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a class="color-black" href="{{ route('site.index') }}">صفحه
                                نخست</a>
                            <i class="fal fa-caret-left mx-2 color-black" aria-hidden="true"></i>

                        </li>

                        <li class="breadcrumb-item"><a class="color-black" href="{{ route('site.products') }}">دسته
                                بندی کالاها</a>
                            <i class="fal fa-caret-left mx-2 color-black" aria-hidden="true"></i>
                        </li>
                        @if($product->has('categories'))
                            @isset($product->categories()->orderBy('id','desc')->first()->parent->parent)
                                <li class="breadcrumb-item"><a class="color-black"
                                                               href="{{ route('site.products',$product->categories()->orderBy('id','desc')->first()->parent->parent->slug) }}">{{ $product->categories()->orderBy('id','desc')->first()->parent->parent->title }}</a>
                                    <i class="fal fa-caret-left mx-2 color-black" aria-hidden="true"></i>

                                </li>
                            @endisset

                            @isset($product->categories()->orderBy('id','desc')->first()->parent)
                                <li class="breadcrumb-item"><a class="color-black"
                                                               href="{{ route('site.products',$product->categories()->orderBy('id','desc')->first()->parent->slug) }}">{{ $product->categories()->orderBy('id','desc')->first()->parent->title }}</a>
                                    <i class="fal fa-caret-left mx-2 color-black" aria-hidden="true"></i>

                                </li>


                            @endisset
                            @isset($product->categories()->orderBy('id','desc')->first()['slug'])
                                <li class="breadcrumb-item"><a class="color-black"
                                                               href="{{ route('site.products',$product->categories()->orderBy('id','desc')->first()->slug) }}">{{ $product->categories()->orderBy('id','desc')->first()->title }}</a>
                                </li>

                            @endisset
                        @endif
                    </ol>
                </nav>
            </div>
        </nav>

        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-9 col-md-12">
                    <div class="wt-list-panel m-b30 p-a20 bg-white shadow row">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-3 col-sm-12 text-center mfp-gallery">

                                    <img width="200" height="200" class="img-fluid img-container"
                                         src="{{$product->thumbnail_url}}">
                                    {{--                                        <product-slides--}}
                                    {{--                                            v-bind:data="{{ isset($product->images) && isset($product->slides) ? json_encode($product->slides) : json_encode(['product.png']) }}">--}}
                                    {{--                                        </product-slides>--}}
                                </div>

                                <div class="col-md-9 col-sm-12">
                                    <div class="container-fluid">
                                        <div>
                                            <h5 class="m-t0">{{ $product->title }}</h5>
                                            <h2 class="wt-list-panel-en-title float-right mt-1"
                                                style="color: #c0c2c5;">
                                                {{ $product->en_title }}
                                            </h2>
                                            <br>
                                            <div class="wt-rating-section text-right m-t10" style="font-size: 13px;">
                                                    <span class="wt-rating rtl">
                                                        @for($i = 0; $i < 5; $i++) <span><i
                                                                class="{{ $product->rating_avg <= $i ? 'far fa-star' : 'fas fa-star' }}"></i>
                                                        </span>
                                                        @endfor
                                                    </span>
                                                <span
                                                    class="wt-rating-conting">( {{ $product->rating_count }} )</span>
                                            </div>

                                            <ul>
                                                @if($product->code)
                                                    <li class="listing-cat-address wt-list-panel-title">

                                                        شناسه کالا:
                                                        {{ $product->code }}


                                                    </li>
                                                @endif

                                                @isset($product->brand)
                                                    <li class="listing-cat-address wt-list-panel-title mt-1">
                                                        <a
                                                            class="text-decoration-none" style="color: #000"
                                                            href="{{ route('site.products',$product->brand->slug) }}">برند:
                                                            {{ $product->brand->title }}</a>


                                                    </li>
                                                @endisset
                                                @isset($product->categories()->orderBy('id','desc')->first()['slug'])
                                                    <li class="listing-cat-address wt-list-panel-title mt-1">
                                                        <a
                                                            class="text-decoration-none" style="color: #000"
                                                            href="{{ route('site.products',$product->categories()->orderBy('id','desc')->first()->slug) }}">دسته
                                                            بندی:
                                                            {{ $product->categories()->orderBy('id','desc')->first()->title }}</a>
                                                    </li>
                                                @endisset
                                            </ul>


                                            <div class="float-left">

                                                @if($product->has_prices_with_stock and $product->max_price != 0)
                                                    <h5 class="">قیمت
                                                        @if ($product->min_price == $product->max_price)
                                                            {{ number_format($product->min_price) }}
                                                        @else

                                                            از
                                                            <span
                                                                style="color: #8BC34A;">{{ number_format($product->min_price) }}</span>
                                                            تا
                                                            <span
                                                                style="color:#ff1744; ">{{ number_format($product->max_price) }}</span>
                                                        @endif

                                                        تومان</h5>

                                                @else
                                                    <span
                                                        class="listing-cat-address text-center justify-content-center font-weight-bold">بدون
                                        قیمت</span>
                                                @endif
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col-4 col-sm-12 d-flex">
                                                    {{--                                                    <a href="javascript:void(0)" title="نمودار قیمت">--}}
                                                    {{--                                                        <i style="font-size: 30px; color: rgb(192, 194, 197); margin: 10px;"--}}
                                                    {{--                                                           class="fas fa-chart-line"></i>--}}
                                                    {{--                                                    </a>--}}
                                                    <a href="#" title="اشتراک گذاری"
                                                       data-bs-toggle="modal"
                                                       data-bs-target="#share-product-modal">
                                                        <i style="color:#9E9E9E; font-size: 20px; margin: 10px;"
                                                           class="fal fa-share-nodes"></i>
                                                    </a>

                                                    <div title="مقایسه">
                                                        <i style="color:#9E9E9E; font-size: 20px; margin: 10px;"
                                                           class="fal fa-balance-scale"></i>
                                                    </div>
                                                    {{--                                                    <div href="javascript:void(0)" title="علاقه مندی" wire:ignore.self>--}}

                                                    @if ($wished)
                                                        <a style="color:#9E9E9E; font-size: 20px; margin: 10px;"
                                                           wire:click="wishlist" href="javascript:void(0)"><i
                                                                class="fas fa-heart"></i></a>

                                                    @else
                                                        <a style="color:#9E9E9E; font-size: 20px; margin: 10px;"
                                                           wire:click="wishlist" href="javascript:void(0)"><i
                                                                class="fal fa-heart"></i></a>
                                                    @endif

                                                </div>
                                                {{--                                                    <div class="col-8 col-sm-12">--}}
                                                {{--                                                        <a class="site-button-secondry  text-decoration-none"--}}
                                                {{--                                                           style="padding: 10px;"--}}
                                                {{--                                                           href="@if (auth()->check() and auth()->user()->hasRole('seller')) {{ route('dashboard.business.products') }} @else {{ route('register.business') }} @endif">--}}
                                                {{--                                                            همین حالا قیمت دهید</a>--}}
                                                {{--                                                    </div>--}}
                                            </div>


                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="wt-list-panel m-b30  p-r10 p-l10 p-t5 p-b10 bg-white shadow">
                        <div class="wt-list-single-about-detail">
                            <div class="m-b30 text-right">
                                <h6 class="wt-list-panel-title m-t0">فهرست فروشندگان
                                    ({{ $product->prices_count ?? count($prices) }})</h6>
                                <hr>
                                @if($product->has_prices)

                                    <div style="margin-top: 10px;">
                                        <div class="accordion ltr" id="prices" wire:init="loadPrices">
                                            @if(count($prices) > 0)
                                                @foreach($prices as $price)

                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="heading-price-{{$price->id}}">

                                                            <button
                                                                class="accordion-button collapsed"
                                                                type="button"
                                                                style="padding: 0px 40px;"
                                                                data-mdb-toggle="collapse"
                                                                data-mdb-target="#price-{{$price->id}}"
                                                                data-bs-toggle="collapse"
                                                                data-bs-target="#price-{{$price->id}}"
                                                                aria-expanded="false"
                                                                aria-controls="price-{{$price->id}}">

                                                                <div class="row w-100"
                                                                     style="margin: 10px 0px 10px 0px;">

                                                                    <div
                                                                        class="col-md-4 col-sm-12 justify-content-between d-flex">
                                                                        <div class="row" style="margin-top: 15px;">
                                                                            <div class="col-md-6 col-sm-12 w-auto">
                                                                                @if ($price->link)

                                                                                    <a rel="nofollow noopener noreferer"
                                                                                       target="_blank"
                                                                                       title="برای رفتن به سایت فروشنده کلیک کنید"
                                                                                       class="text-decoration-none float-right btn btn-outline-danger btn-rounded waves-effect"
                                                                                       style="background-color: #ff3547; color:#fff; font-size: 12px; padding: 10px;"
                                                                                       href="{{ route('site.product.price.link',md5($price->id)) }}">
                                                                                        <p style="font-size: 12px; padding: 10px; margin: -10px;">
                                                                                            مشاهده در سایت فروشنده</p>
                                                                                    </a>
                                                                                @else
                                                                                    <a rel="nofollow noopener noreferer"
                                                                                       target="_blank"
                                                                                       title="برای تماس کلیک کنید"
                                                                                       class="text-decoration-none float-right btn btn-outline-danger btn-rounded waves-effect"
                                                                                       style="background-color: #ff3547; font-size: 12px; padding: 10px;"
                                                                                       href="tel:{{$price->business->phone}}">
                                                                                        <p style="font-size: 12px; padding: 10px; margin: -10px;">
                                                                                            تماس با فروشنده</p>
                                                                                    </a>
                                                                                @endif
                                                                            </div>
                                                                            <div class="col-md-6 col-sm-12 w-auto">
                                                                                {{--                                                                                <a href="javascript:void(0)" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#report-price-Modal-{{$price->id}}">--}}
                                                                                {{--                                                                                    Launch demo modal--}}
                                                                                {{--                                                                                </a>--}}
                                                                                <a href="javascript:void(0)"
                                                                                   title="برای گزارش کلیک کنید"
                                                                                   {{--                                                                                    type="button"--}}
                                                                                   {{--                                                                                   class="btn btn-primary"--}}
                                                                                   data-bs-toggle="modal"
                                                                                   data-bs-target="#report-price-Modal-{{$price->id}}"
                                                                                   class="far fa-flag text-decoration-none waves-effect"
                                                                                   style="font-size: 14px; width:max-content; padding: 8px; margin:10px; color:#ff3547;"

                                                                                >
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div
                                                                        class="col-md-5 col-sm-6 justify-content-between">
                                                                        <a rel="nofollow"
                                                                           class="text-decoration-none color-black mt-1 float-right rtl text-right"
                                                                           href="{{ route('site.product.price.link',md5($price->id)) }}"
                                                                           target="_blank"
                                                                        >
                                                                            @if (isset($price->crawled_product))
                                                                                <p style="font-size: 15px; font-weight: 700; text-align: right;">{{ $price->crawled_product->title }}</p>
                                                                                <br>
                                                                            @endif

                                                                            <span
                                                                                class="block d-flex w-100 float-right ml-2"
                                                                                data-bs-toggle="collapse"
                                                                                data-bs-target="#price-{{$price->id}}"
                                                                                style="font-size: 11px; color: darkslategray;">
                                                                                   {{  $price->priced_at_human_ago }}
                                                                               </span>

                                                                            @if ($price->final_price == 0 || empty($price->final_price) || $price->stock == 0)
                                                                                <div class="d-flex mt-3">
                                                                                    ناموجود
                                                                                </div>
                                                                            @else
                                                                                <div class="d-flex rtl w-100 ">
                                                                                    <p class="ml-1 mt-2"
                                                                                       style="font-size: 20px; display: flex;">
                                                                                        @if ($price->hasDiscount())
                                                                                            <span
                                                                                                style="text-decoration:line-through;  white-space:nowrap; color: red;">
                                                                                       {{ number_format($price->price) }}
                                                                                </span>
                                                                                            <span
                                                                                                style="margin-right: 10px; color: #8BC34A;">
                                                                                    {{ number_format($price->final_price) }}
                                                                                </span>

                                                                                        @else
                                                                                            {{  number_format($price->final_price) }}
                                                                                        @endif
                                                                                    </p>
                                                                                    <span
                                                                                        style="font-size: 15px; margin: 10px;"
                                                                                        class="left-align"> تومان </span>

                                                                                </div>
                                                                            @endif

                                                                        </a>

                                                                    </div>

                                                                    <div class="col-md-2 col-sm-6 text-center"
                                                                         style="padding: 20px 30px; position: absolute; padding-right: 23px; right: 30px;">

                                                                        <a rel="nofollow"
                                                                           class="text-decoration-none"
                                                                           href="{{ route('site.businesses.single',$price->business->slug) }}">
                                                                            <img width="50" height="50"
                                                                                 style="margin-top: -10px"
                                                                                 class="text-center"
                                                                                 src="/uploads/logos/{{$price->business->logo}}">
                                                                            <br>
                                                                            <h6 style="font-size: 15px; padding: 10px;"
                                                                                class="font-weight-bold">{{$price->business->name}}</h6>
                                                                        </a>
                                                                    </div>

                                                                </div>
                                                            </button>

                                                        </h2>
                                                        <div
                                                            id="price-{{$price->id}}"
                                                            class="accordion-collapse collapse"
                                                            aria-labelledby="heading-price-{{$price->id}}"
                                                            data-mdb-parent="#prices"
                                                        >
                                                            <div class="accordion-body rtl">

                                                                <div style="line-height:20px; font-size: 12px;">
                                                                    @if ($price->hasGuarantee())
                                                                        <p class="font-small">
                                                                            گارانتی: {{ $price->guarantee_time . ' ' . $price->guarantee_name }}
                                                                        </p>
                                                                    @endif
                                                                    <p>
                                                                        روش پرداخت
                                                                        سفارش: {{ \Illuminate\Support\Str::limit($price->business->payment_method ?? '-',300) }}
                                                                    </p>
                                                                    <p>
                                                                    <p>
                                                                        نحوه تحویل
                                                                        کالا: {{ \Illuminate\Support\Str::limit($price->business->send_order_method ?? '-',300) }}
                                                                    </p>
                                                                    <p>
                                                                        مهلت
                                                                        تست: {{ \Illuminate\Support\Str::limit($price->business->test_product_time ?? '-',300) }}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div wire:ignore class="modal fade rtl"
                                                         id="report-price-Modal-{{$price->id}}" tabindex="-1"
                                                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <form wire:submit.prevent="reportPrice('{{$price->id}}')">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">
                                                                            گزارش قیمت ثبت شده توسط
                                                                            <b>{{ $price->business->name }}</b>
                                                                        </h5>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        @foreach(\Modules\Report\Entities\ReasonType::firstWhere('slug', 'report_price')->reasons ?? [] as $reason)
                                                                            <div class="form-check">
                                                                                <input type="checkbox"
                                                                                       class="form-check-input"
                                                                                       wire:model.defer="selected_report_reasons"
                                                                                       value="{{ $reason->id }}"
                                                                                       id="{{ $reason->id }}">
                                                                                <label class="form-check-label"
                                                                                       for="{{ $reason->id }}">
                                                                                    {{$reason->reason}}
                                                                                </label>
                                                                            </div>
                                                                        @endforeach
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-danger"
                                                                                data-bs-dismiss="modal">
                                                                            خروج
                                                                        </button>
                                                                        <button type="submit" class="btn btn-success">
                                                                            ارسال
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>

                                                @endforeach
                                            @else
                                                @if ($this->readyToLoadPrices)
                                                    <p class="text-center justify-content-center">قیمتی برای این محصول
                                                        ثبت نشده است</p>
                                                @else
                                                    @include('site.livewire.loading',['target'=>'readyToLoadPrices'])
                                                    <div class="text-center justify-content-center">
                                                        <p>در حال بارگذاری...</p>
                                                    </div>
                                                @endif
                                            @endif
                                        </div>

                                    </div>
                                @else

                                    <p class="text-center justify-content-center">قیمتی برای این محصول ثبت نشده است</p>

                                @endif

                                <div
                                    style="background: #F4FF81; border-radius: 5px; padding: 10px; font-size: 13px; margin-top:15px;">
                                    مسئولیت قیمت های درج شده برای کالاها و خدمات به عهده فروشندگان و ارائه
                                    دهندگان
                                    خدمات
                                    بوده و شاگو تنها
                                    مرجع و
                                    راهنمای معرفی فروشندگان به خریداران است.
                                    لطفا دقت فرمایید در زمان انتخاب
                                    فروشندگان و
                                    تماس با آنها علاوه
                                    بر
                                    قیمت،با مشاهده سایر موارد درج شده در کنار قیمت و مشخصات فروشنده از خرید کالا
                                    و
                                    خدمات
                                    با کیفیت موردنظر
                                    خود
                                    اطمینان حاصل فرمایید.

                                </div>

                            </div>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 wt-listing-sidebar-form">
                            {{--                            <x-banner alt="{{ \Modules\Advert\Entities\Ad::get('banner_sidebar_first','alt') }}"--}}
                            {{--                                      class="banner-sidebar"--}}
                            {{--                                      image="{{ \Modules\Advert\Entities\Ad::get('banner_sidebar_first','image') }}"--}}
                            {{--                                      url="{{ \Modules\Advert\Entities\Ad::get('banner_sidebar_first','url') }}"/>--}}
                            <div class="wt-listing-sidebar-form " wire:ignore>
                                <div id="pos-article-display-67263"></div>
                                {{--                                <img class="img-responsive"--}}
                                {{--                                     style="margin-bottom: 10px; border-radius: 10px; border: 1px solid #ddd;"--}}
                                {{--                                     src="/uploads/product.png">--}}
                            </div>
                        </div>
                        {{--                        <div class="col-md-3 col-sm-12 wt-listing-sidebar-form ">--}}
                        {{--                            <div class="wt-listing-sidebar-form " wire:ignore>--}}
                        {{--                                <div id="pos-article-display-67263"></div>--}}
                        {{--                                                                <img class="img-responsive"--}}
                        {{--                                                                     style="margin-bottom: 10px; border-radius: 10px; border: 1px solid #ddd;"--}}
                        {{--                                                                     src="/uploads/product.png">--}}
                        {{--                            </div>--}}
                        {{--                            --}}{{--                            <x-banner alt="{{ \Modules\Advert\Entities\Ad::get('banner_sidebar_secend','alt') }}"--}}
                        {{--                            --}}{{--                                      class="banner-sidebar"--}}
                        {{--                            --}}{{--                                      image="{{ \Modules\Advert\Entities\Ad::get('banner_sidebar_secend','image') }}"--}}
                        {{--                            --}}{{--                                      url="{{ \Modules\Advert\Entities\Ad::get('banner_sidebar_secend','url') }}"/>--}}
                        {{--                        </div>--}}
                        {{--                        <div class="col-md-3 col-sm-12 wt-listing-sidebar-form ">--}}
                        {{--                            <div class="wt-listing-sidebar-form " wire:ignore>--}}
                        {{--                                <div id="pos-article-display-67263"></div>--}}
                        {{--                                                                <img class="img-responsive"--}}
                        {{--                                                                     style="margin-bottom: 10px; border-radius: 10px; border: 1px solid #ddd;"--}}
                        {{--                                                                     src="/uploads/product.png">--}}
                        {{--                            </div>--}}
                        {{--                            --}}{{--                            <x-banner alt="{{ \Modules\Advert\Entities\Ad::get('banner_sidebar_first','alt') }}"--}}
                        {{--                            --}}{{--                                      class="banner-sidebar"--}}
                        {{--                            --}}{{--                                      image="{{ \Modules\Advert\Entities\Ad::get('banner_sidebar_first','image') }}"--}}
                        {{--                            --}}{{--                                      url="{{ \Modules\Advert\Entities\Ad::get('banner_sidebar_first','url') }}"/>--}}

                        {{--                        </div>--}}
                        {{--                        <div class="col-md-3 col-sm-12 wt-listing-sidebar-form ">--}}
                        {{--                            <div class="wt-listing-sidebar-form ">--}}
                        {{--                                <img class="img-responsive"--}}
                        {{--                                     style="margin-bottom: 10px; border-radius: 10px; border: 1px solid #ddd;"--}}
                        {{--                                     src="/uploads/product.png">--}}
                        {{--                            </div>--}}
                        {{--                            --}}{{--                            <x-banner alt="{{ \Modules\Advert\Entities\Ad::get('banner_sidebar_secend','alt') }}"--}}
                        {{--                            --}}{{--                                      class="banner-sidebar"--}}
                        {{--                            --}}{{--                                      image="{{ \Modules\Advert\Entities\Ad::get('banner_sidebar_secend','image') }}"--}}
                        {{--                            --}}{{--                                      url="{{ \Modules\Advert\Entities\Ad::get('banner_sidebar_secend','url') }}"/>--}}
                        {{--                        </div>--}}
                        {{--                        <div class="col-lg-8 col-md-12">--}}
                        <div class="col-md-12">

                            {{--                            <div class="wt-list-panel m-b30  p-a20 bg-white shadow">--}}
                            {{--                                <div class="wt-list-single-about-detail" style="font-size: 13px">--}}
                            {{--                                    <div class="m-b30 text-center">--}}
                            {{--                                        <h6 class="wt-list-panel-title m-t0">توضیحات</h6>--}}
                            {{--                                        <div class="wt-separator sep-gradient-light"></div>--}}
                            {{--                                    </div>--}}
                            {{--                                    {!! html_entity_decode($product->description) !!}--}}
                            {{--                                </div>--}}
                            {{--                            </div>--}}
                            @livewire('site.comment', ['model' => $product])

                            @isset($similarProducts)
                                <div class="wt-list-panel m-b30  p-a20 bg-white shadow" wire:init="loadSimilarProducts">
                                    <div class="wt-list-single-about-detail" style="font-size: 13px">
                                        <div class="m-b30 text-center">
                                            <h6 class="wt-list-panel-title m-t0">
                                                کالاهای مشابه
                                            </h6>
                                            <div class="wt-separator sep-gradient-light"></div>
                                        </div>
                                        <div class="row">
                                            @include('site.livewire.loading',['target'=>'loadSimilarProducts'])
                                            @forelse($similarProducts as $similar_product)
                                                @include('product::site.products.prodouct_list_single_component',['product'=>$similar_product])
                                            @empty

                                            @endforelse
                                        </div>
                                    </div>
                                </div>

                            @endisset
                        </div>


                    </div>


                </div>
                {{--                <div class="col-lg-4 col-md-12">--}}
                <div class="col-lg-3 col-sm-6 col-md-12 text-right">

                    <div class="wt-list-panel  p-a20 bg-white m-b30 shadow">
                        <div class="col-xl-12 col-md-6 col-sm-6 col-6 wt-listing-sidebar-form ">
                            {{--                            <x-banner alt="{{ \Modules\Advert\Entities\Ad::get('banner_sidebar_first','alt') }}"--}}
                            {{--                                      class="banner-sidebar"--}}
                            {{--                                      image="{{ \Modules\Advert\Entities\Ad::get('banner_sidebar_first','image') }}"--}}
                            {{--                                      url="{{ \Modules\Advert\Entities\Ad::get('banner_sidebar_first','url') }}"/>--}}
                            <div class="wt-listing-sidebar-form " wire:ignore>
                                <div id="pos-article-display-67263"></div>
                                {{--                                <img class="img-responsive"--}}
                                {{--                                     style="margin-bottom: 10px; border-radius: 10px; border: 1px solid #ddd;"--}}
                                {{--                                     src="/uploads/product.png">--}}
                            </div>
                        </div>
                        <div class="wt-list-single-about-detail">
                            <div class="m-b30 text-center">
                                <h6 class="wt-list-panel-title m-t0">مشخصات فنی</h6>
                                <div class="wt-separator sep-gradient-light"></div>
                            </div>
                            <ul class="list-unstyled wt-list-working-hours m-b0">
                                @if(count($product_properties) > 0)
                                    @foreach($product_properties as $key => $value)
                                        @if (isset($key,$value))
                                            @if($loop->index + 1 > 5)
                                                <li class="show-more-item" style="display: none;">
                                            @else
                                                <li class="show-more-item">
                                            @endif
                                                <?php try{ ?>
                                                <span>{!! $key !!}:</span> <?php } catch (Exception $e) { ?>
                                                <span>-</span> <?php } ?>
                                                <?php try{ ?>
                                                <span>{!! is_array($value) ? implodeValue($value) : $value !!}</span> <?php } catch (Exception $e) { ?>
                                                <span>-</span> <?php } ?>
                                            </li>

                                        @endif

                                    @endforeach

                                    @if(count($product_properties) > 5)
                                        <div class="text-center justify-content-center show-more-btn" style="cursor: pointer;">
                                            نمایش همه مشخصات
                                            <br>
                                            <i class="far fa-angles-down"></i>
                                        </div>
                                    @endif

                                @else
                                    <p class="text-center justify-content-center">
                                        مشخصات فنی برای این محصول ثبت نشده است
                                    </p>
                                @endif


                            </ul>

                        </div>
                    </div>

                    <div class="side-bar shadow p-a30">
                        <div class="text-center m-b30">
                            <h4 class="widget-title">تبلیغات</h4>
                            <div class="wt-separator sep-gradient-light"></div>
                        </div>
                        <div class="wt-list-single-about-detail row">
                            <div class="col-xl-12 col-md-6 col-sm-6 col-6 wt-listing-sidebar-form ">
                                {{--                                <x-banner alt="{{ \Modules\Advert\Entities\Ad::get('banner_sidebar_first','alt') }}"--}}
                                {{--                                          class="banner-sidebar"--}}
                                {{--                                          image="{{ \Modules\Advert\Entities\Ad::get('banner_sidebar_first','image') }}"--}}
                                {{--                                          url="{{ \Modules\Advert\Entities\Ad::get('banner_sidebar_first','url') }}"/>--}}
                                <div class="wt-listing-sidebar-form" wire:ignore>
                                    <div
                                        id="pos-article-display-67377"></div>{{--                                    <img class="img-responsive"--}}
                                    {{--                                         style="margin-bottom: 10px; border-radius: 10px; border: 1px solid #ddd;"--}}
                                    {{--                                         src="/uploads/product.png">--}}
                                </div>
                            </div>
                            {{--                            <div class="col-xl-12 col-md-6 col-sm-6 col-6 wt-listing-sidebar-form ">--}}
                            {{--                                --}}{{--                                <x-banner alt="{{ \Modules\Advert\Entities\Ad::get('banner_sidebar_secend','alt') }}"--}}
                            {{--                                --}}{{--                                          class="banner-sidebar"--}}
                            {{--                                --}}{{--                                          image="{{ \Modules\Advert\Entities\Ad::get('banner_sidebar_secend','image') }}"--}}
                            {{--                                --}}{{--                                          url="{{ \Modules\Advert\Entities\Ad::get('banner_sidebar_secend','url') }}"/>--}}
                            {{--                                <div class="wt-listing-sidebar-form ">--}}
                            {{--                                    <img class="img-responsive"--}}
                            {{--                                         style="margin-bottom: 10px; border-radius: 10px; border: 1px solid #ddd;"--}}
                            {{--                                         src="/uploads/product.png">--}}
                            {{--                                </div>--}}
                            {{--                            </div>--}}
                            {{--                            <div class="col-xl-12 col-md-6 col-sm-6 col-6 wt-listing-sidebar-form ">--}}
                            {{--                                --}}{{--                                <x-banner alt="{{ \Modules\Advert\Entities\Ad::get('banner_sidebar_first','alt') }}"--}}
                            {{--                                --}}{{--                                          class="banner-sidebar"--}}
                            {{--                                --}}{{--                                          image="{{ \Modules\Advert\Entities\Ad::get('banner_sidebar_first','image') }}"--}}
                            {{--                                --}}{{--                                          url="{{ \Modules\Advert\Entities\Ad::get('banner_sidebar_first','url') }}"/>--}}
                            {{--                                <div class="wt-listing-sidebar-form ">--}}
                            {{--                                    <img class="img-responsive"--}}
                            {{--                                         style="margin-bottom: 10px; border-radius: 10px; border: 1px solid #ddd;"--}}
                            {{--                                         src="/uploads/product.png">--}}
                            {{--                                </div>--}}

                            {{--                            </div>--}}
                            {{--                            <div class="col-xl-12 col-md-6 col-sm-6 col-6 wt-listing-sidebar-form ">--}}
                            {{--                                --}}{{--                                <x-banner alt="{{ \Modules\Advert\Entities\Ad::get('banner_sidebar_secend','alt') }}"--}}
                            {{--                                --}}{{--                                          class="banner-sidebar"--}}
                            {{--                                --}}{{--                                          image="{{ \Modules\Advert\Entities\Ad::get('banner_sidebar_secend','image') }}"--}}
                            {{--                                --}}{{--                                          url="{{ \Modules\Advert\Entities\Ad::get('banner_sidebar_secend','url') }}"/>--}}
                            {{--                                <div class="wt-listing-sidebar-form ">--}}
                            {{--                                    <img class="img-responsive"--}}
                            {{--                                         style="margin-bottom: 10px; border-radius: 10px; border: 1px solid #ddd;"--}}
                            {{--                                         src="/uploads/product.png">--}}
                            {{--                                </div>--}}
                            {{--                            </div>--}}
                            {{--                            <div class="col-xl-12 col-md-6 col-sm-6 col-6 wt-listing-sidebar-form ">--}}
                            {{--                                --}}{{--                                <x-banner alt="{{ \Modules\Advert\Entities\Ad::get('banner_sidebar_first','alt') }}"--}}
                            {{--                                --}}{{--                                          class="banner-sidebar"--}}
                            {{--                                --}}{{--                                          image="{{ \Modules\Advert\Entities\Ad::get('banner_sidebar_first','image') }}"--}}
                            {{--                                --}}{{--                                          url="{{ \Modules\Advert\Entities\Ad::get('banner_sidebar_first','url') }}"/>--}}
                            {{--                                <div class="wt-listing-sidebar-form ">--}}
                            {{--                                    <img class="img-responsive"--}}
                            {{--                                         style="margin-bottom: 10px; border-radius: 10px; border: 1px solid #ddd;"--}}
                            {{--                                         src="/uploads/product.png">--}}
                            {{--                                </div>--}}
                            {{--                            </div>--}}
                            {{--                            <div class="col-xl-12 col-md-6 col-sm-6 col-6 wt-listing-sidebar-form ">--}}
                            {{--                                --}}{{--                                <x-banner alt="{{ \Modules\Advert\Entities\Ad::get('banner_sidebar_secend','alt') }}"--}}
                            {{--                                --}}{{--                                          class="banner-sidebar"--}}
                            {{--                                --}}{{--                                          image="{{ \Modules\Advert\Entities\Ad::get('banner_sidebar_secend','image') }}"--}}
                            {{--                                --}}{{--                                          url="{{ \Modules\Advert\Entities\Ad::get('banner_sidebar_secend','url') }}"/>--}}
                            {{--                                <div class="wt-listing-sidebar-form ">--}}
                            {{--                                    <img class="img-responsive"--}}
                            {{--                                         style="margin-bottom: 10px; border-radius: 10px; border: 1px solid #ddd;"--}}
                            {{--                                         src="/uploads/product.png">--}}
                            {{--                                </div>--}}
                            {{--                            </div>--}}
                        </div>
                    </div>

                </div>

                {{--                @include('site.layouts.sidebar')--}}
            </div>


            {{--            <div class="col-12 row">--}}
            {{--                <div class="col-md-3 col-sm-12 wt-listing-sidebar-form ">--}}
            {{--                    <x-banner alt="{{ \Modules\Advert\Entities\Ad::get('banner_sidebar_first','alt') }}"--}}
            {{--                              class="banner-sidebar"--}}
            {{--                              image="{{ \Modules\Advert\Entities\Ad::get('banner_sidebar_first','image') }}"--}}
            {{--                              url="{{ \Modules\Advert\Entities\Ad::get('banner_sidebar_first','url') }}"/>--}}

            {{--                </div>--}}
            {{--                <div class="col-md-3 col-sm-12 wt-listing-sidebar-form ">--}}
            {{--                    <x-banner alt="{{ \Modules\Advert\Entities\Ad::get('banner_sidebar_secend','alt') }}"--}}
            {{--                              class="banner-sidebar"--}}
            {{--                              image="{{ \Modules\Advert\Entities\Ad::get('banner_sidebar_secend','image') }}"--}}
            {{--                              url="{{ \Modules\Advert\Entities\Ad::get('banner_sidebar_secend','url') }}"/>--}}
            {{--                </div>--}}
            {{--                <div class="col-md-3 col-sm-12 wt-listing-sidebar-form ">--}}
            {{--                    <x-banner alt="{{ \Modules\Advert\Entities\Ad::get('banner_sidebar_first','alt') }}"--}}
            {{--                              class="banner-sidebar"--}}
            {{--                              image="{{ \Modules\Advert\Entities\Ad::get('banner_sidebar_first','image') }}"--}}
            {{--                              url="{{ \Modules\Advert\Entities\Ad::get('banner_sidebar_first','url') }}"/>--}}

            {{--                </div>--}}
            {{--                <div class="col-md-3 col-sm-12 wt-listing-sidebar-form ">--}}
            {{--                    <x-banner alt="{{ \Modules\Advert\Entities\Ad::get('banner_sidebar_secend','alt') }}"--}}
            {{--                              class="banner-sidebar"--}}
            {{--                              image="{{ \Modules\Advert\Entities\Ad::get('banner_sidebar_secend','image') }}"--}}
            {{--                              url="{{ \Modules\Advert\Entities\Ad::get('banner_sidebar_secend','url') }}"/>--}}
            {{--                </div>--}}
            {{--            </div>--}}

        </div>


        {{--        @livewire('swiper',['model' => 'relative_products','id'=>$product->id])--}}


    </div>

    <div wire:ignore class="modal fade rtl" id="share-product-modal" tabindex="-1" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        اشتراک گذاری
                    </h5>
                </div>
                <div class="modal-body">
                    <div class="pb-4 border-b-200"><p class="text-body-1">این کالا را با دوستان خود به اشتراک
                            بگذارید!</p>
                        <div class="text-center justify-content-center mt-4">
                            <button
                                onclick="copyToClipboard('{{ route('site.products.single',$product->slug) }}')"
                                class="btn btn-outline-danger text-center justify-content-center w-100">
                                <div class="d-flex text-center justify-content-center ">
                                    <div class="d-flex ml-2">
                                        <i class="far fa-copy c-pointer"></i>
                                    </div>
                                    کپی کردن لینک
                                </div>
                            </button>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6 col-sm-12">
                                <a href="https://api.whatsapp.com/send?text={{ route('site.products.single',$product->slug) }}"
                                   class="btn btn-success w-100" style="background-color: #25d366 !important;">
                                    <i class="fab fa-whatsapp"></i>
                                    واتس اپ
                                </a>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <a href="https://www.facebook.com/sharer.php?u={{ route('site.products.single',$product->slug) }}"
                                   class="btn btn-success w-100" style="background-color: #00acee !important">
                                    <i class="fab fa-twitter"></i>
                                    توییتر
                                </a>
                            </div>
                            <div class="col-md-6 col-sm-12 mt-2">
                                <a href="https://twitter.com/intent/tweet?url={{ route('site.products.single',$product->slug) }}&text={{ route('site.products.single',$product->slug) }}&hashtags=shago"
                                   class="btn btn-success w-100" style="background-color: #3b5998!important">
                                    <i class="fab fa-facebook"></i>
                                    فیسبوک
                                </a>
                            </div>
                            <div class="col-md-6 col-sm-12 mt-2">
                                <a href="https://t.me/share/url?url={{ route('site.products.single',$product->slug) }}&text={{ $product->title }}"
                                   class="btn btn-success w-100" style="background-color: #0088cc !important;">
                                    <i class="fab fa-telegram-plane"></i>
                                    تلگرام
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger"
                            data-bs-dismiss="modal">
                        بستن
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{--    @if (auth()->check() and auth()->user()->hasRole('admin'))--}}
    {{--        <div class="text-center justify-content-center">--}}
    {{--            <a href="{{route('admin.products.update',$product->id)}}">--}}
    {{--                ویرایش در پنل ادمین--}}
    {{--            </a>--}}
    {{--        </div>--}}
    {{--    @endif--}}

</div>


@push('scripts')
    <script>

        function copyToClipboard(value) {

            navigator.clipboard.writeText(value);

            const Toast = Swal.mixin({
                toast: true,
                position: 'bottom-start',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer);
                    toast.addEventListener('mouseleave', Swal.resumeTimer);
                },
            });

            Toast.fire({
                icon: 'success',
                title: 'متن در کلیپ بورد کپی شد',
            });
        }

        jQuery(document).ready(function ($) {
            $(".show-more-btn").click(function (e) {
                $(".show-more-item:hidden").fadeIn();
                if ($(".show-more-item:hidden").length < 1) $(this).fadeOut();
            })
        })
    </script>
@endpush
