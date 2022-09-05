<div>

    @include('mobile.layouts.sidebar')

    @push ('scripts')
        <script type="text/javascript">
            window.onscroll = function (ev) {
                if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight) {
                    window.livewire.emit('load-more');
                }
            };
        </script>
    @endpush

    <div class="top-products-area py-3">
        <div class="container" wire:ignore.self>
            <div class="section-heading d-flex align-items-center justify-content-between">
                <div class="form-inline d-flex justify-content-center md-form form-sm mt-0 w-100 float-right d-flex">
                    {{--                        <i class="far fa-search float-right"--}}
                    {{--                           style="color: black; margin-right: 10px; padding-top: 30px;" aria-hidden="true"></i>--}}

                    <input class="form-control form-control-sm ml-3 float-right"
                           type="text" name="q" wire:model="sub_search"
                           style="margin: 10px" placeholder="جستجو در نتایج"
                           aria-label="Search">

                    {{--                                            <button style="font-size: 12px; border-radius: 10px; color: #fff; background-color: #ff1744 !important;" class="btn list-cat-verified" wire:click="searchSubmit">جستجو</button>--}}

                    {{--                    </div>--}}

                </div>

                {{--                <div class="layout-options">--}}
                {{--                    <a href="javascript:void(0)" class="suha-navbar-toggler" id="suhaNavbarToggler">--}}
                {{--                        <i class="lni lni-radio-button"></i>--}}
                {{--                    </a>--}}
                {{--                </div>--}}
            </div>

            {{--            <div class="section-heading d-flex align-items-center justify-content-between">--}}
            {{--                <h6 class="ml-1">--}}
            {{--                    @if(isset($pageTitle))--}}
            {{--                        {{ $pageTitle }}--}}
            {{--                    @elseif (isset($title))--}}
            {{--                        {{ $title }}--}}
            {{--                    @endif--}}
            {{--                </h6>--}}
            {{--            </div>--}}
            {{--            <div class="product-catagories">--}}
            {{--                <div class="row g-3">--}}
            {{--                    <!-- Single Catagory-->--}}
            {{--                    <div class="col-4"><a class="shadow-sm" href="#"><img src="/mobile/img/product/5.png" alt="">Furniture</a>--}}
            {{--                    </div>--}}
            {{--                    <!-- Single Catagory-->--}}
            {{--                    <div class="col-4"><a class="shadow-sm" href="#"><img src="/mobile/img/product/9.png"--}}
            {{--                                                                          alt="">Shoes</a></div>--}}
            {{--                    <!-- Single Catagory-->--}}
            {{--                    <div class="col-4"><a class="shadow-sm" href="#"><img src="/mobile/img/product/4.png"--}}
            {{--                                                                          alt="">Dress</a></div>--}}
            {{--                </div>--}}
            {{--            </div>--}}
            <div class="row g-3"
                 wire:init="loadProducts"
            >

                @if(isset($sortBy))
                    <div class="g-w row">

                        <div>
                            <p style="font-size: 13px; margin: 10px;">
                                مرتب سازی بر اساس:
                            </p>
                        </div>
                        <br>
                        <div class="text-center justify-content-center d-flex">

                            @if (!empty($search))
                                <a href="#" wire:click="$set('sortBy', 'related')"
                                   class="btn btn-sm btn-outline-default btn-rounded waves-effect sort-button {{ (isset($sortBy) and $sortBy == 'related') ? 'sort-button-active' : '' }}">
                                    مرتبط ترین
                                </a>
                            @endif
                            <a href="#" wire:click="$set('sortBy', 'visits')"
                               class="btn btn-sm btn-outline-default btn-rounded waves-effect sort-button {{ (isset($sortBy) and $sortBy == 'visits') ? 'sort-button-active' : ''}}">
                                پربازدید ترین
                            </a>
                            <a href="#" wire:click="$set('sortBy', 'price_asc')"
                               class="btn btn-sm btn-outline-default btn-rounded waves-effect sort-button {{ (isset($sortBy) and $sortBy == 'price_asc') ? 'sort-button-active' : '' }}">
                                ارزان ترین
                            </a>
                            <a href="#" wire:click="$set('sortBy', 'price_desc')"
                               class="btn btn-sm btn-outline-default btn-rounded waves-effect sort-button {{ (isset($sortBy) and $sortBy == 'price_desc') ? 'sort-button-active' : '' }}">
                                گران ترین
                            </a>
                        </div>


                        {{--                <div class="col-xl-2 col-md-3 col-sm-4">--}}
                        {{--                                        <div class="form-inline " style="margin: 10px; font-size: 12px;">--}}
                        {{--                                            <select wire:model="sortField" class="form-control border flex-1"--}}
                        {{--                                                    style=" padding: 12px;">--}}
                        {{--                                                <option value="">انتخاب کنید</option>--}}
                        {{--                                                <option value="visits">پر بازدید ترین</option>--}}
                        {{--                                                <option value="discounts">تخفیف دار ها</option>--}}
                        {{--                                                <option value="price_desc">گران ترین</option>--}}
                        {{--                                                <option value="price_asc">ارزان ترین</option>--}}
                        {{--                                            </select>--}}
                        {{--                                        </div>--}}
                        {{--                </div>--}}
                        {{--                <div class="col-xl-10 col-md-9 col-sm-8 ">--}}

                    </div>

                @endif
                @if ($products and $products->count() > 0)
                    @include('site.livewire.loading')
                    @foreach($products as $product)
                        <div class="col-6 col-md-4 col-lg-3"
                            {{--                             wire:loading.class="blur"--}}
                        >

                            <div class="card top-product-card" style="height: 100%;">
                                <div class="card-body">
                                    {{--                                    <span class="badge badge-success">فروش</span>--}}

                                    {{--                                    <a class="wishlist-btn" href="#"><i class="lni lni-heart"></i></a>--}}

                                    <a class="product-thumbnail d-block"
                                       href="{{route('site.products.single',$product->slug)}}">
                                        <img
                                            {{--                                            data-mdb-lazy-src loading="lazy"--}}
                                            class="mb-2"
                                            src="{{$product->thumbnail_url}}"
                                            alt=""></a>
                                    <a style="font-size: 9px; overflow: hidden; text-overflow: ellipsis; display: -webkit-box !important; -webkit-line-clamp: 3; -webkit-box-orient: vertical;"
                                       class="product-title d-block text-decoration-none"
                                       href="{{route('site.products.single',$product->slug)}}">{{\Illuminate\Support\Str::limit($product->title,100)}}</a>
                                    <div class="text-center justify-content-center mt-2"
                                         style="font-size: 11px; color: #000;">
                                        @if($product->has_prices and $product->max_price != 0)
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
                                            تومان
                                            @isset($product->best_price)
                                                <p class="text-center justify-content-center"
                                                   style="color: #8BC34A; font-size: 9px; margin-top: 20px;">بهترین
                                                    قیمت در
                                                    <b style="color: #8BC34A8BC34A;">{{ $product->best_price }}</b>
                                                </p>
                                            @endisset

                                        @else
                                            <span class="listing-cat-address">بدون قیمت</span>

                                        @endif

                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    {{--                    {{$products->links('s')}}--}}

                    @if ($products->hasMorePages())
                        <div wire:click="loadMore" class="select-all-products-btn btn btn-danger w-100"
                             wire:loading.class.remove="btn-danger" wire:loading.class="btn-red-lighten">مشاهده بیشتر
                        </div>
                        <div class="col-12 text-center justify-content-center">

                            @include('site.livewire.loading')

                            <div class="text-center justify-content-center" wire:loading>
                                <p>در حال بارگذاری...</p>
                            </div>
                            <br>

                        </div>

                    @endif
                @else
                    @if ($this->readyToLoad)
                        <div class="text-center justify-content-center">
                            <p>موردی برای نمایش یافت نشد</p>
                        </div>
                    @else
                        <div class="text-center justify-content-center">
                            <p>در حال بارگذاری...</p>
                        </div>
                    @endif
                @endif

            </div>
        </div>
    </div>

</div>


@push ('head')
    <style>
        /* Remove default bullets */
        ul, #myUL {
            list-style-type: none;
            direction: rtl;
        }

        /* Remove margins and padding from the parent ul */
        #myUL {
            margin: 0px;
            border: 1px solid #eee;
            border-radius: 5%;
            padding: 20px;
        }

        #myUL .main-li {
            margin: 10px;
            border-bottom: 1px solid #eeee;
        }

        #myUL .main-li:last-child {
            border-bottom: none;
        }

        /* Style the caret/arrow */
        .caret {
            font-size: 14px;
            cursor: pointer;
            user-select: none; /* Prevent text selection */
        }

        .caret i {
            margin-left: 10px;
            display: inline-block;
        }

        /* Rotate the caret/arrow icon when clicked on (using JavaScript) */
        .caret-down::before {
            transform: rotate(90deg);
        }

        /* Hide the nested list */
        .nested {
            display: none;
            margin: 15px;
            width: 100%;
            padding: 0;
            font-size: 13px;

        }


        .nested li {
            margin: 15px;
        }

        .nested li a {
            color: #000;
            margin: 5px;
        }

        /* Show the nested list when the user clicks on the caret/arrow (with JavaScript) */
        .active {
            display: block;
        }
    </style>
@endpush
@push ('scripts')
    <script>
        $(".caret").each(function (index) {

            $(this).on("click", function () {
                if ($(".nested:eq(" + index + ")").hasClass('active')) {
                    $(".nested:eq(" + index + ")").removeClass("active");
                } else {
                    $(".nested:eq(" + index + ")").addClass("active");
                }
                if ($(".caret:eq(" + index + ")").hasClass('caret-down')) {
                    $(".caret:eq(" + index + ")").removeClass("caret-down");
                } else {
                    $(".caret:eq(" + index + ")").addClass("caret-down");
                }
            });
        });
    </script>
@endpush
