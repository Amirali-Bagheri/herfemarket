<div>
    <style>

        .without-price {
            bottom: 15px;
            right: 0;
            left: 0;
            color: #000;
            font-weight: 600;
            font-size: 14px;
            position: absolute;
        }

        @media (max-width: 360px) {
            .img-swiper {
                padding: 5px;
            }

            .product-title {
                bottom: 80px;
                position: absolute;
                right: 0;
                left: 0;
            }

        }

        @media (max-width: 535px) {
            .img-swiper {
                padding: 0px 20px 0px 20px;
                text-align: center;
                justify-content: center;
            }

            .price-range-slide {
                font-size: 11px;
                color: #000;
                position: absolute;
                bottom: 0px;
                left: 2px;
                right: 2px;
            }

            .swiper-slide .card-body {
                max-height: 240px;
                min-height: 240px;
            }

            .top-product-card {
                height: 100%;
                min-height: 250px;
            }

        }

        @media (min-width: 535px) {
            .img-swiper {
                padding: 25px;
            }

            .price-range-slide {
                font-size: 11px;
                color: #000;
                position: absolute;
                bottom: 0;
                left: 0;
                right: 0;
                top: auto;
            }

            .swiper-slide .card-body {
                max-height: 240px;
                min-height: 240px;
            }

            .top-product-card {
                height: 100%;
                min-height: 260px;
            }
        }

        @media (min-width: 550px) {
            .product-title {
                position: absolute;
                bottom: 50px;
                right: 0;
                left: 0;
            }

            .img-swiper {
                padding: 5px;
                /*padding: 35px;*/
            }

            .price-range-slide {
                font-size: 11px;
                color: #000;
                position: absolute;
                bottom: 0px;
                left: 0;
                right: 0;
                top: auto;
            }


            .swiper-slide .card-body {
                max-height: 240px;
                min-height: 240px;
            }

            .top-product-card {
                height: 100%;
                min-height: 300px;
            }
        }

        @media (max-width: 550px) {
            .product-title {
                position: absolute;
                bottom: auto;
                right: 0;
                left: 0;
            }
        }

        @media (max-width: 670px) {
            .img-swiper {
                padding: 20px;
            }

            .product-title {
                position: absolute;
                bottom: auto;
                right: 0;
                left: 0;
            }
        }

        @media (min-width: 670px) {
            .product-title {
                position: absolute;
                right: 0;
                left: 0;
                margin-bottom: 45px !important;
            }

            .img-swiper {
                padding: 40px;
            }

            .price-range-slide {
                font-size: 11px;
                color: #000;
                position: absolute;
                bottom: 10px;
                left: 0;
                right: 0;
            }

            .swiper-slide .card-body {
                max-height: 240px;
                min-height: 240px;
            }


            .top-product-card {
                height: 100%;
                min-height: 320px;
            }
        }

        @media (min-width: 700px) {
            .top-product-card {
                height: 100%;
                min-height: 320px;
            }

            .product-title {
                /*position: absolute;*/
                /*bottom: 30px;*/
                margin-bottom: 45px !important;
            }

            .img-swiper {
                padding: 50px;
            }

            .price-range-slide {
                font-size: 11px;
                color: #000;
                position: absolute;
                bottom: 10px;
                left: 0;
                right: 0;
            }

            .swiper-slide .card-body {
                max-height: 240px;
                min-height: 240px;
            }
        }

        @media (min-width: 780px) {
            .top-product-card {
                height: 100%;
                min-height: 320px;
            }

            .product-title {
                /*position: absolute;*/
                /*bottom: 30px;*/
                margin-bottom: 45px !important;
            }


            .img-swiper {
                padding: 60px;
            }

            .price-range-slide {
                font-size: 11px;
                color: #000;
                position: absolute;
                bottom: 10px;
                left: 0;
                right: 0;
            }

            .swiper-slide .card-body {
                max-height: 240px;
                min-height: 240px;
            }
        }

        @media (min-width: 800px) {
            .top-product-card {
                height: 100%;
                min-height: 320px;
            }

            .product-title {
                /*position: absolute;*/
                /*bottom: 30px;*/
                margin-bottom: 45px !important;
            }


            .img-swiper {
                padding: 55px;
            }

            .price-range-slide {
                font-size: 11px;
                color: #000;
                position: absolute;
                bottom: 10px;
                left: 0;
                right: 0;
            }

            .swiper-slide .card-body {
                max-height: 240px;
                min-height: 240px;
            }
        }

        @media (min-width: 1000px) {
            .top-product-card {
                height: 100%;
                min-height: 320px;
            }

            .product-title {
                /*position: absolute;*/
                /*bottom: 30px;*/
                margin-bottom: 45px !important;
            }


            .img-swiper {
                padding: 0px;
            }

            .price-range-slide {
                font-size: 11px;
                color: #000;
                position: absolute;
                bottom: 10px;
                left: 0;
                right: 0;
            }

            /*.swiper-slide .card-body{*/
            /*    max-height: 240px;*/
            /*    min-height: 240px;*/
            /*}*/
        }

    </style>
    @if (!empty($products))

        <div class="section-head text-center">
            <div class="container-fluid">
                <h5 style="font-size:16px; float:right; text-align: right; margin-right:15px;">
                    {{$title ?? ''}}
                </h5>
                <a href="{{ $show_more_link ?? '#' }}">
                    <button class="btn btn-outline-danger"
                            style="font-size: 10px; float: left; margin-bottom: 10px;">همه موارد
                    </button>
                </a>
            </div>
        </div>
        <div class="swiper-container" style="width: 100%; height: 100%;" id="products-slider">
            <div class="swiper-wrapper" wire:ignore>

                @forelse ($products as $product)
                    <div class="swiper-slide"
                         id="categories-slider-slide wire:ignore"
                         wire:key="id-{{$product['id'] ?? $loop->index}}"
                         style="width: 132px !important; min-width: 132px !important; margin-right: 16px; text-align: center; font-size: 18px; background: #fff; display: -webkit-box; display: -ms-flexbox; display: -webkit-flex; display: flex; -webkit-box-pack: center; -ms-flex-pack: center; -webkit-justify-content: center; justify-content: center; -webkit-box-align: center; -ms-flex-align: center; -webkit-align-items: center; align-items: center;">

                        <div class="card top-product-card">
                            <div class="card-body"
                                 @if ($_model == 'business')
                                 style="max-height: 200px; min-height: 200px;"
                                @endif>

                                <a class="product-thumbnail d-block"
                                   href="{{route('site.products.single',$product['slug'])}}">
                                    <img loading="lazy" class="mb-2 img-responsive img-swiper"
                                         src="{{$product['thumbnail_url']}}"
                                         alt="">
                                </a>

                                <a style="font-size: 10px; overflow: hidden; text-overflow: ellipsis; display: -webkit-box !important; -webkit-line-clamp: 3; -webkit-box-orient: vertical;"
                                   class="product-title d-block text-decoration-none"
                                   href="{{route('site.products.single',$product['slug'] ?? null)}}">{{\Illuminate\Support\Str::limit($product['title'] ?? null,40)}}</a>
                                <div class="text-center justify-content-center mt-3 price-range-slide">
                                    @if ($_model == 'business')
                                        <span class="listing-cat-address">
                                              @if($product['price'] == 0)
                                                <p class="text-center justify-content-center without-price">
                                                        بدون قیمت
                                                    </p>
                                            @else
                                                {{ number_format($product['price'] ?? 0) }} تومان
                                            @endif

                                            </span>
                                    @else
                                        @if (isset($product['max_price'],$product['min_price']))
                                            @if ($product['min_price'] == $product['max_price'])
                                                @if($product['min_price'] == 0)
                                                    <p class="text-center justify-content-center without-price">
                                                        بدون قیمت
                                                    </p>
                                                @else
                                                    {{ number_format($product['min_price']) }} تومان
                                                @endif
                                            @else
                                                از
                                                <span
                                                    style="color: #8BC34A;">{{ number_format($product['min_price']) }}</span>
                                                تا
                                                <span
                                                    style="color:#ff1744; ">{{ number_format($product['max_price']) }}</span>
                                                تومان

                                            @endif
                                        @else
                                            <p class="text-center justify-content-center without-price">
                                                بدون قیمت
                                            </p>

                                        @endif
                                        <br>
                                        @if(isset($product['best_price']) and $model == 'category')
                                            <p class="text-center justify-content-center"
                                               style="font-size: 9px; margin-top: 10px;">
                                                بهترین
                                                قیمت در
                                                <br>
                                                <b style="color: #8BC34A; ">{{ $product['best_price'] ?? null }}</b>
                                            </p>

                                            {{--                                        @else--}}
                                            {{--                                            <p class="text-center justify-content-center without-price">--}}
                                            {{--                                                بدون قیمت--}}
                                            {{--                                            </p>--}}

                                            {{--                                        <span class="listing-cat-address">--}}

                                            {{--                                        </span>--}}
                                        @endif
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="swiper-slide"
                         style="width: 132px !important; margin-right: 16px; text-align: center; font-size: 18px; background: #fff; display: -webkit-box; display: -ms-flexbox; display: -webkit-flex; display: flex; -webkit-box-pack: center; -ms-flex-pack: center; -webkit-justify-content: center; justify-content: center; -webkit-box-align: center; -ms-flex-align: center; -webkit-align-items: center; align-items: center;">

                        <div class="card top-product-card"
                             style="height: 100%; background-color:lightgrey; width: 100%;">
                            <div class="card-body">
                                {{--                                    <span class="badge badge-success">فروش</span>--}}

                                {{--                                    <a class="wishlist-btn" href="#"><i class="lni lni-heart"></i></a>--}}

                                <a class="product-thumbnail d-block"
                                   href="javascript:void(0)">
                                    <div class="mb-2" style="background-color:lightgrey;"></div>
                                    <a style="font-size: 10px; overflow: hidden; text-overflow: ellipsis; display: -webkit-box !important; -webkit-line-clamp: 3; -webkit-box-orient: vertical; background-color:lightgrey;"
                                       class="product-title d-block text-decoration-none"
                                       href="javascript:void(0)">

                                    </a>
                                    <div class="text-center justify-content-center mt-3"
                                         style="font-size: 11px; color: #000; position: absolute; bottom: 10px; left: 0; right: 0; background-color:lightgrey;">
                                        {{--                                            @if($product->has_prices and $product->max_price != 0)--}}
                                        {{--                                                @if ($product->min_price == $product->max_price)--}}
                                        {{--                                                    {{ number_format($product->min_price) }}--}}
                                        {{--                                                @else--}}
                                        {{--                                                    از--}}
                                        {{--                                                    {{ number_format($product->min_price) }}--}}
                                        {{--                                                    تا--}}
                                        {{--                                                    {{ number_format($product->max_price) }}--}}
                                        {{--                                                @endif--}}
                                        {{--                                                تومان--}}
                                        {{--                                                @isset($product->best_price)--}}
                                        {{--                                                    <p class="text-center justify-content-center"--}}
                                        {{--                                                       style="font-size: 9px; margin-top: 20px; position:absolute; bottom:0;">بهترین--}}
                                        {{--                                                        قیمت در--}}
                                        {{--                                                        <b style="color: #ff1744;">{{ $product->best_price }}</b>--}}
                                        {{--                                                    </p>--}}
                                        {{--                                                @endisset--}}

                                        {{--                                            @else--}}
                                        <span style="background-color:lightgrey;"
                                              class="listing-cat-address"></span>
                                        {{----}}
                                        {{--                                            @endif--}}

                                    </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide"
                         style="width: 132px !important; margin-right: 16px; text-align: center; font-size: 18px; background: #fff; display: -webkit-box; display: -ms-flexbox; display: -webkit-flex; display: flex; -webkit-box-pack: center; -ms-flex-pack: center; -webkit-justify-content: center; justify-content: center; -webkit-box-align: center; -ms-flex-align: center; -webkit-align-items: center; align-items: center;">

                        <div class="card top-product-card"
                             style="height: 100%; background-color:lightgrey; width: 100%;">
                            <div class="card-body">
                                {{--                                    <span class="badge badge-success">فروش</span>--}}

                                {{--                                    <a class="wishlist-btn" href="#"><i class="lni lni-heart"></i></a>--}}

                                <a class="product-thumbnail d-block"
                                   href="javascript:void(0)">
                                    <div class="mb-2" style="background-color:lightgrey;"></div>
                                    <a style="font-size: 10px; overflow: hidden; text-overflow: ellipsis; display: -webkit-box !important; -webkit-line-clamp: 3; -webkit-box-orient: vertical; background-color:lightgrey;"
                                       class="product-title d-block text-decoration-none"
                                       href="javascript:void(0)">

                                    </a>
                                    <div class="text-center justify-content-center mt-3"
                                         style="font-size: 11px; color: #000; position: absolute; bottom: 10px; left: 0; right: 0; background-color:lightgrey;">
                                        {{--                                            @if($product->has_prices and $product->max_price != 0)--}}
                                        {{--                                                @if ($product->min_price == $product->max_price)--}}
                                        {{--                                                    {{ number_format($product->min_price) }}--}}
                                        {{--                                                @else--}}
                                        {{--                                                    از--}}
                                        {{--                                                    {{ number_format($product->min_price) }}--}}
                                        {{--                                                    تا--}}
                                        {{--                                                    {{ number_format($product->max_price) }}--}}
                                        {{--                                                @endif--}}
                                        {{--                                                تومان--}}
                                        {{--                                                @isset($product->best_price)--}}
                                        {{--                                                    <p class="text-center justify-content-center"--}}
                                        {{--                                                       style="font-size: 9px; margin-top: 20px; position:absolute; bottom:0;">بهترین--}}
                                        {{--                                                        قیمت در--}}
                                        {{--                                                        <b style="color: #ff1744;">{{ $product->best_price }}</b>--}}
                                        {{--                                                    </p>--}}
                                        {{--                                                @endisset--}}

                                        {{--                                            @else--}}
                                        <span style="background-color:lightgrey;"
                                              class="listing-cat-address"></span>
                                        {{----}}
                                        {{--                                            @endif--}}

                                    </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide"
                         style="width: 132px !important; margin-right: 16px; text-align: center; font-size: 18px; background: #fff; display: -webkit-box; display: -ms-flexbox; display: -webkit-flex; display: flex; -webkit-box-pack: center; -ms-flex-pack: center; -webkit-justify-content: center; justify-content: center; -webkit-box-align: center; -ms-flex-align: center; -webkit-align-items: center; align-items: center;">

                        <div class="card top-product-card"
                             style="height: 100%; background-color:lightgrey; width: 100%;">
                            <div class="card-body">
                                {{--                                    <span class="badge badge-success">فروش</span>--}}

                                {{--                                    <a class="wishlist-btn" href="#"><i class="lni lni-heart"></i></a>--}}

                                <a class="product-thumbnail d-block"
                                   href="javascript:void(0)">
                                    <div class="mb-2" style="background-color:lightgrey;"></div>
                                    <a style="font-size: 10px; overflow: hidden; text-overflow: ellipsis; display: -webkit-box !important; -webkit-line-clamp: 3; -webkit-box-orient: vertical; background-color:lightgrey;"
                                       class="product-title d-block text-decoration-none"
                                       href="javascript:void(0)">

                                    </a>
                                    <div class="text-center justify-content-center mt-3"
                                         style="font-size: 11px; color: #000; position: absolute; bottom: 10px; left: 0; right: 0; background-color:lightgrey;">
                                        {{--                                            @if($product->has_prices and $product->max_price != 0)--}}
                                        {{--                                                @if ($product->min_price == $product->max_price)--}}
                                        {{--                                                    {{ number_format($product->min_price) }}--}}
                                        {{--                                                @else--}}
                                        {{--                                                    از--}}
                                        {{--                                                    {{ number_format($product->min_price) }}--}}
                                        {{--                                                    تا--}}
                                        {{--                                                    {{ number_format($product->max_price) }}--}}
                                        {{--                                                @endif--}}
                                        {{--                                                تومان--}}
                                        {{--                                                @isset($product->best_price)--}}
                                        {{--                                                    <p class="text-center justify-content-center"--}}
                                        {{--                                                       style="font-size: 9px; margin-top: 20px; position:absolute; bottom:0;">بهترین--}}
                                        {{--                                                        قیمت در--}}
                                        {{--                                                        <b style="color: #ff1744;">{{ $product->best_price }}</b>--}}
                                        {{--                                                    </p>--}}
                                        {{--                                                @endisset--}}

                                        {{--                                            @else--}}
                                        <span style="background-color:lightgrey;"
                                              class="listing-cat-address"></span>
                                        {{----}}
                                        {{--                                            @endif--}}

                                    </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide"
                         style="width: 132px !important; margin-right: 16px; text-align: center; font-size: 18px; background: #fff; display: -webkit-box; display: -ms-flexbox; display: -webkit-flex; display: flex; -webkit-box-pack: center; -ms-flex-pack: center; -webkit-justify-content: center; justify-content: center; -webkit-box-align: center; -ms-flex-align: center; -webkit-align-items: center; align-items: center;">

                        <div class="card top-product-card"
                             style="height: 100%; background-color:lightgrey; width: 100%;">
                            <div class="card-body">
                                {{--                                    <span class="badge badge-success">فروش</span>--}}

                                {{--                                    <a class="wishlist-btn" href="#"><i class="lni lni-heart"></i></a>--}}

                                <a class="product-thumbnail d-block"
                                   href="javascript:void(0)">
                                    <div class="mb-2" style="background-color:lightgrey;"></div>
                                    <a style="font-size: 10px; overflow: hidden; text-overflow: ellipsis; display: -webkit-box !important; -webkit-line-clamp: 3; -webkit-box-orient: vertical; background-color:lightgrey;"
                                       class="product-title d-block text-decoration-none"
                                       href="javascript:void(0)">

                                    </a>
                                    <div class="text-center justify-content-center mt-3"
                                         style="font-size: 11px; color: #000; position: absolute; bottom: 10px; left: 0; right: 0; background-color:lightgrey;">
                                        {{--                                            @if($product->has_prices and $product->max_price != 0)--}}
                                        {{--                                                @if ($product->min_price == $product->max_price)--}}
                                        {{--                                                    {{ number_format($product->min_price) }}--}}
                                        {{--                                                @else--}}
                                        {{--                                                    از--}}
                                        {{--                                                    {{ number_format($product->min_price) }}--}}
                                        {{--                                                    تا--}}
                                        {{--                                                    {{ number_format($product->max_price) }}--}}
                                        {{--                                                @endif--}}
                                        {{--                                                تومان--}}
                                        {{--                                                @isset($product->best_price)--}}
                                        {{--                                                    <p class="text-center justify-content-center"--}}
                                        {{--                                                       style="font-size: 9px; margin-top: 20px; position:absolute; bottom:0;">بهترین--}}
                                        {{--                                                        قیمت در--}}
                                        {{--                                                        <b style="color: #ff1744;">{{ $product->best_price }}</b>--}}
                                        {{--                                                    </p>--}}
                                        {{--                                                @endisset--}}

                                        {{--                                            @else--}}
                                        <span style="background-color:lightgrey;"
                                              class="listing-cat-address"></span>
                                        {{----}}
                                        {{--                                            @endif--}}

                                    </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide"
                         style="width: 132px !important; margin-right: 16px; text-align: center; font-size: 18px; background: #fff; display: -webkit-box; display: -ms-flexbox; display: -webkit-flex; display: flex; -webkit-box-pack: center; -ms-flex-pack: center; -webkit-justify-content: center; justify-content: center; -webkit-box-align: center; -ms-flex-align: center; -webkit-align-items: center; align-items: center;">

                        <div class="card top-product-card"
                             style="height: 100%; background-color:lightgrey; width: 100%;">
                            <div class="card-body">
                                {{--                                    <span class="badge badge-success">فروش</span>--}}

                                {{--                                    <a class="wishlist-btn" href="#"><i class="lni lni-heart"></i></a>--}}

                                <a class="product-thumbnail d-block"
                                   href="javascript:void(0)">
                                    <div class="mb-2" style="background-color:lightgrey;"></div>
                                    <a style="font-size: 10px; overflow: hidden; text-overflow: ellipsis; display: -webkit-box !important; -webkit-line-clamp: 3; -webkit-box-orient: vertical; background-color:lightgrey;"
                                       class="product-title d-block text-decoration-none"
                                       href="javascript:void(0)">

                                    </a>
                                    <div class="text-center justify-content-center mt-3"
                                         style="font-size: 11px; color: #000; position: absolute; bottom: 10px; left: 0; right: 0; background-color:lightgrey;">
                                        {{--                                            @if($product->has_prices and $product->max_price != 0)--}}
                                        {{--                                                @if ($product->min_price == $product->max_price)--}}
                                        {{--                                                    {{ number_format($product->min_price) }}--}}
                                        {{--                                                @else--}}
                                        {{--                                                    از--}}
                                        {{--                                                    {{ number_format($product->min_price) }}--}}
                                        {{--                                                    تا--}}
                                        {{--                                                    {{ number_format($product->max_price) }}--}}
                                        {{--                                                @endif--}}
                                        {{--                                                تومان--}}
                                        {{--                                                @isset($product->best_price)--}}
                                        {{--                                                    <p class="text-center justify-content-center"--}}
                                        {{--                                                       style="font-size: 9px; margin-top: 20px; position:absolute; bottom:0;">بهترین--}}
                                        {{--                                                        قیمت در--}}
                                        {{--                                                        <b style="color: #ff1744;">{{ $product->best_price }}</b>--}}
                                        {{--                                                    </p>--}}
                                        {{--                                                @endisset--}}

                                        {{--                                            @else--}}
                                        <span style="background-color:lightgrey;"
                                              class="listing-cat-address"></span>
                                        {{----}}
                                        {{--                                            @endif--}}

                                    </div>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>

    @endif
</div>
