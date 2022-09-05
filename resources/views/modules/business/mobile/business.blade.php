<div>
    @include('mobile.layouts.sidebar')
    @include('slider::site.swiper_init',['type'=>'mobile'])


    <div class="product-description pb-3">
        <div class="product-title-meta-data bg-white mb-3 py-3">
            <div class="row text-center justify-content-center">
                <div class="col-5">
                    <img class="img-fluid img-thumbnail" src="/uploads/logos/{{$business->logo}}" style="width: 100px;">

                </div>

                <div class="col-7">
                    <a target="_blank"
                       href="{{route('site.business.website.link',$business->hash_id)}}">

                        <p class="post-catagory d-block color-black"
                           style="font-size:15px; color:#000;">
                            {{ $business->name }}
                        </p>
                    </a>

                    <p class="post-meta d-block color-black mt-3" style="font-size:11px;">
                        {{--                        {{ $business->business_type->title }}--}}
                        {{ isset($business->category_parent->title) ? '/' .$business->category_parent->title : null}}
                    </p>
                    <div class="product-ratings mt-3 text-center justify-content-center">
                        <div class="ratings d-flex align-items-center justify-content-center text-center">
                            @for($i = 0; $i < 5; $i++)
                                <span><i
                                        class="{{ $business->ratingAvg() <= $i ? 'far fa-star' : 'fas fa-star' }}"></i></span>
                            @endfor
                            <span class="pl-1">( {{ $business->ratingCount() }} )</span>
                        </div>
                    </div>

                    @isset($business->website)
                        <p style="font-size: 15px;">

                            <a class="text-decoration-none btn btn-black" rel="nofollow"
                               style="text-transform: lowercase; background-color: #8BC34A; font-size: 14px; color: indigo; text-shadow: 0 0 black; margin: 5px;"
                               target="_blank"
                               href="{{route('site.business.website.link',$business->hash_id)}}">
                                {{ $business->website }}
                            </a>
                        </p>
                    @endisset
                </div>
            </div>
            <!-- Ratings-->

        </div>

    {{--        <div class="d-flex align-items-center p-3"--}}
    {{--             style="background: #F4FF81; border-radius: 5px; padding: 10px; font-size: 13px; line-height: 2;">--}}
    {{--            مسئولیت قیمت های درج شده برای کالاها و خدمات به عهده فروشندگان و ارائه--}}
    {{--            دهندگان--}}
    {{--            خدمات--}}
    {{--            بوده و شاگو تنها--}}
    {{--            مرجع و--}}
    {{--            راهنمای معرفی فروشندگان به خریداران است. لطفا دقت فرمایید در زمان انتخاب--}}
    {{--            فروشندگان و--}}
    {{--            تماس با آنها علاوه--}}
    {{--            بر--}}
    {{--            قیمت،با مشاهده سایر موارد درج شده در کنار قیمت و مشخصات فروشنده از خرید کالا--}}
    {{--            و--}}
    {{--            خدمات--}}
    {{--            با کیفیت موردنظر--}}
    {{--            خود--}}
    {{--            اطمینان حاصل فرمایید.--}}
    {{--        </div>--}}
    <!-- Product Specification-->
        <div class="p-specification bg-white mb-3 py-3">
            <div class="container">
                <h5 class="accordian-title">اطلاعات کسب و کار</h5>
                <div class="accordion" id="accordionExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingDescription">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseDescription" aria-expanded="true"
                                    aria-controls="collapseDescription">
                                توضیحات
                            </button>
                        </h2>
                        <div id="collapseDescription" class="accordion-collapse collapse"
                             aria-labelledby="headingDescription" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                @if (isset($business->description))
                                    <strong>
                                        درباره کسب و کار:
                                    </strong>

                                    <p style="font-size: 13px;">
                                        {{$business->description}}
                                    </p>
                                @endif

                                @isset ($business->has_enamad)
                                    <strong>
                                        وضعیت نماد الکترونیکی:
                                    </strong>
                                    <p style="font-size: 14px;">
                                        @if ($business->has_enamad)
                                            ({{$business->enamad_star}} ستاره) {{$business->enamad_expiration}}
                                            <br>
                                            {{ $business->enamad_activity_history }}
                                        @else
                                            نا مشخص
                                        @endif
                                    </p>

                                @endisset

                                @if (isset($business->send_order_method))
                                    <strong>
                                        روش ارسال سفارشات:
                                    </strong>

                                    <p style="font-size: 14px;">
                                        {{$business->send_order_method}}
                                    </p>
                                    @if (isset($business->send_order_method_link))
                                        <a class="color-black" rel="nofollow"
                                           href="{{$business->send_order_method_link}}">
                                            برای اطلاعات بیشتر کلیک کنید
                                        </a>
                                    @endif

                                @endif

                                @if (isset($business->payment_method))
                                    <strong>
                                        روش پرداخت:
                                    </strong>

                                    <p style="font-size: 14px;">

                                        {{$business->payment_method}}
                                    </p>
                                    @if (isset($business->payment_method_link))
                                        <a class="color-black" rel="nofollow"
                                           href="{{$business->payment_method_link}}">
                                            برای اطلاعات بیشتر کلیک کنید
                                        </a>
                                    @endif
                                @endif

                                @isset($business->test_product_time)
                                    <strong>
                                        مهلت تست:
                                    </strong>

                                    <p style="font-size: 14px;">

                                        {{$business->test_product_time}}
                                    </p>
                                    @if (isset($business->test_product_time_link))
                                        <a class="color-black" rel="nofollow"
                                           href="{{$business->test_product_time_link}}">
                                            برای اطلاعات بیشتر کلیک کنید
                                        </a>
                                    @endif
                                @endisset
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingContact">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseContact" aria-expanded="false"
                                    aria-controls="collapseContact">
                                اطلاعات تماس
                            </button>
                        </h2>
                        <div id="collapseContact" class="accordion-collapse collapse" aria-labelledby="headingContact"
                             data-bs-parent="#accordionExample">
                            <div class="accordion-body">

                                {{--                                @isset($business->manager->full_name)--}}
                                {{--                                    <strong>--}}
                                {{--                                        نام مدیر:--}}
                                {{--                                    </strong>--}}

                                {{--                                    <p style="font-size: 15px;">--}}
                                {{--                                        {{$business->manager->full_name}}--}}
                                {{--                                    </p>--}}

                                {{--                                @endisset--}}

                                <div class="row">
                                    <div class="col-6">
                                        @isset($business->phone)
                                            <strong>
                                                تلفن:
                                            </strong>

                                            <p style="font-size: 15px;">

                                                <a title="برای تماس کلیک کنید"
                                                   class="text-decoration-none color-black"
                                                   href="tel:{{$business->phone}}">
                                                            <span>
                                                                <i class="far fa-phone site-text-secondry"></i>
                                                            </span>
                                                    <span style="margin-right: 10px;">
                                                {{$business->phone}}
                                            </span>
                                                </a>

                                            </p>


                                        @endisset
                                    </div>

                                    {{--                                    <div class="col-6">--}}
                                    {{--                                        @isset($business->business_type)--}}
                                    {{--                                            <strong>--}}
                                    {{--                                                نوع کسب و کار:--}}
                                    {{--                                            </strong>--}}

                                    {{--                                            <p style="font-size: 15px;">--}}
                                    {{--                                                {{ $business->business_type->title }}--}}
                                    {{--                                            </p>--}}

                                    {{--                                        @endisset--}}
                                    {{--                                    </div>--}}
                                    <div class="col-6">
                                        @isset($business->website)
                                            <strong>
                                                وب سایت:
                                            </strong>

                                            <p style="font-size: 15px;">
                                                <a class="text-decoration-none" rel="nofollow"
                                                   target="_blank"
                                                   href="{{route('site.business.website.link',$business->hash_id)}}">
                                                    {{ $business->website }}
                                                </a>
                                            </p>
                                        @endisset
                                    </div>
                                    @if (isset($business->social_whatsapp) or isset($business->social_telegram) or isset($business->social_instagram))
                                        <strong>
                                            شبکه های اجتماعی:
                                        </strong>

                                        <ul class="vandad-icons-social">
                                            @if (!is_null($business->social_whatsapp))
                                                <li>
                                                    <a href="//{{ $business->social_whatsapp }}"
                                                       target="_blank"
                                                       class="icon-whatsapp"></a>
                                                </li>
                                            @endif
                                            @if (!is_null($business->social_telegram))
                                                <li>
                                                    <a href="//{{ $business->social_telegram }}"
                                                       target="_blank"
                                                       class="icon-telegram"></a>
                                                </li>
                                            @endif
                                            @if (!is_null($business->social_instagram))
                                                <li>
                                                    <a href="//{{ $business->social_instagram }}"
                                                       target="_blank"
                                                       class="icon-instagram"></a>
                                                </li>
                                            @endif
                                        </ul>

                                    @endif

                                    {{--                                    <div class="row">--}}
                                    {{--                                        <div class="col-6">--}}
                                    {{--                                            @isset($business->phone)--}}
                                    {{--                                                <strong>--}}
                                    {{--                                                    تلفن:--}}
                                    {{--                                                </strong>--}}

                                    {{--                                                <p style="font-size: 15px;">--}}

                                    {{--                                                    <a title="برای تماس کلیک کنید"--}}
                                    {{--                                                       class="text-decoration-none color-black"--}}
                                    {{--                                                       href="tel:{{$business->phone}}">--}}
                                    {{--                                                            <span>--}}
                                    {{--                                                                <i class="far fa-phone site-text-secondry"></i>--}}
                                    {{--                                                            </span>--}}
                                    {{--                                                        <span style="margin-right: 10px;">--}}
                                    {{--                                                {{$business->phone}}--}}
                                    {{--                                            </span>--}}
                                    {{--                                                    </a>--}}

                                    {{--                                                </p>--}}


                                    {{--                                            @endisset--}}
                                    {{--                                        </div>--}}
                                    {{--                                        <div class="col-6">--}}
                                    {{--                                            @isset($business->manager->mobile)--}}
                                    {{--                                                <strong>--}}
                                    {{--                                                    تلفن همراه:--}}
                                    {{--                                                </strong>--}}

                                    {{--                                                <p style="font-size: 15px;">--}}

                                    {{--                                                    <a title="برای تماس کلیک کنید"--}}
                                    {{--                                                       class="text-decoration-none color-black"--}}
                                    {{--                                                       href="tel:{{$business->manager->mobile}}">--}}
                                    {{--                                                            <span>--}}
                                    {{--                                                                <i class="far fa-mobile site-text-secondry"></i>--}}
                                    {{--                                                            </span>--}}
                                    {{--                                                        <span style="margin-right: 10px;">--}}
                                    {{--                                                {{$business->manager->mobile}}--}}
                                    {{--                                            </span>--}}
                                    {{--                                                    </a>--}}

                                    {{--                                                </p>--}}

                                    {{--                                            @endisset--}}
                                    {{--                                        </div>--}}
                                    {{--                                    </div>--}}

                                    @isset($business->email)
                                        <strong>
                                            پست الکترونیکی:
                                        </strong>

                                        <p style="font-size: 15px;">

                                            <a title="برای ارسال ایمیل کلیک کنید"
                                               class="text-decoration-none color-black"
                                               href="mailto:{{$business->email}}">
                                                            <span>
                                                                <i class="far fa-envelope site-text-secondry"></i>
                                                            </span>
                                                <span style="margin-right: 10px;">
                                                {{$business->email}}
                                            </span>
                                            </a>

                                        </p>


                                    @endisset


                                    @isset($business->address)
                                        <strong>
                                            نشانی:
                                        </strong>

                                        <p style="font-size: 15px;">
                                            {{$business->address}}
                                        </p>
                                    @endisset
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{--                <div class="accordion" id="accordionProductInformation">--}}


                {{--                </div>--}}
            </div>
            <br>
            <br>
            <div class="section-content">

                <div class="section-head text-center">
                    <div class="container-fluid">
                        <h5 style="font-size:16px; float:right; text-align: right; margin-right:15px;"> کالا های قیمت
                            گذاری شده ({{$prices->total() ?? 0}})</h5>
                        {{--                        <a href="{{route('site.businesses.products',$business->slug)}}">--}}
                        <a href="{{route('site.products') .'?business='.$business->slug}}">
                            <p
                                style="font-size:13px; float: left; color: blue;">همه موارد</p></a>
                    </div>

                    {{--                    <div class="wt-separator sep-gradient-light"></div>--}}
                </div>
                {{--                @livewire('swiper',['id'=>35,'model'=>'business'])--}}

                @livewire('swiper',['id'=>$business->id,'model'=>'business','type'=>'mobile'])
                {{--
                                <div class="swiper-container" style="width: 100%; height: 100%;" id="products-slider">
                                    <div class="swiper-wrapper">

                                        @forelse ($products_slider as $product)

                                            <div class="swiper-slide" id="categories-slider-slide" style="width: 132px !important; margin-right: 16px; text-align: center; font-size: 18px; background: #fff; display: -webkit-box; display: -ms-flexbox; display: -webkit-flex; display: flex; -webkit-box-pack: center; -ms-flex-pack: center; -webkit-justify-content: center; justify-content: center; -webkit-box-align: center; -ms-flex-align: center; -webkit-align-items: center; align-items: center;">

                                                <div class="card top-product-card" style="height: 100%;">
                                                    <div style="max-height: 200px; min-height: 200px;" class="card-body">
                                                        --}}
                {{--                                    <span class="badge badge-success">فروش</span>--}}{{--


                                                        --}}
                {{--                                    <a class="wishlist-btn" href="#"><i class="lni lni-heart"></i></a>--}}{{--


                                                        <a class="product-thumbnail d-block"
                                                           href="{{route('site.products.single',$product->slug)}}">
                                                            <img class="mb-2" src="{{$product->thumbnail_url}}"
                                                                 alt=""></a>
                                                        <a style="font-size: 10px; overflow: hidden; text-overflow: ellipsis; display: -webkit-box !important; -webkit-line-clamp: 3; -webkit-box-orient: vertical;"
                                                           class="product-title d-block text-decoration-none"
                                                           href="{{route('site.products.single',$product->slug)}}">{{\Illuminate\Support\Str::limit($product->title,40)}}</a>
                                                        <div class="text-center justify-content-center mt-3"
                                                             style="font-size: 11px; color: #000; position: absolute; bottom: 10px; left: 0; right: 0;">
                                                            @if($product->hasPrices() and $product->max_price != 0)
                                                                @if ($product->min_price == $product->max_price)
                                                                    {{ number_format($product->min_price) }}
                                                                @else
                                                                    از
                                                                    {{ number_format($product->min_price) }}
                                                                    تا
                                                                    {{ number_format($product->max_price) }}
                                                                @endif
                                                                تومان
                                                                --}}
                {{--                                                @isset($product->best_price)--}}{{--

                                                                --}}
                {{--                                                    <p class="text-center justify-content-center"--}}{{--

                                                                --}}
                {{--                                                       style="font-size: 9px; margin-top: 20px; position:absolute; bottom:0;">بهترین--}}{{--

                                                                --}}
                {{--                                                        قیمت در--}}{{--

                                                                --}}
                {{--                                                        <b style="color: #ff1744;">{{ $product->best_price }}</b>--}}{{--

                                                                --}}
                {{--                                                    </p>--}}{{--

                                                                --}}
                {{--                                                @endisset--}}{{--


                                                            @else
                                                                <span class="listing-cat-address">بدون قیمت</span>

                                                            @endif

                                                        </div>
                                                    </div>
                                                </div>
                                                --}}
                {{--   <div class="card flash-sale-card">
                                                       <div class="card-body"><a href="{{route('site.products.single',$product->slug)}}">
                                                               <img src="{{$product->thumbnail_url}}" height="100" alt="">
                                                               --}}{{--
                --}}
                {{--                                                <span class="product-title">{{$product->title}}</span>--}}{{--
                --}}
                {{--
                                                               --}}{{--
                --}}
                {{--                                                <p class="sale-price">36 تومان <span class="real-price"> 55 تومان</span></p>--}}{{--
                --}}
                {{--
                                                               <p class="color-black" style="font-size:11px;">
                                                                   {{ \Illuminate\Support\Str::limit($product->title,20) }}
                                                               </p>

                                                           </a>
                                                       </div>
                                                   </div>--}}{{--

                                            </div>
                                        @empty

                                        @endforelse

                                    </div>

                                    <!-- Add Pagination -->
                                    --}}
                {{--                    <div class="swiper-pagination"></div>--}}{{--

                                </div>
                --}}
            </div>
        </div>

        @livewire('site.comment', ['model' => $business])

    </div>
</div>
