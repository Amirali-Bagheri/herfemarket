<div>
    <style>

        .product-thumbnail {
            text-align: center;
            justify-content: center;
            align-content: center;
        }

        .swiper-slide {
            margin-right: 5px;
            margin-left: 5px;
        }

        .best-price-business {
            font-size: 10px;
            margin-top: 20px;
            position: absolute;
            bottom: 10px;
            left: 0;
            right: 0;
            text-align: center !important;
            justify-content: center !important;
            color: #8BC34A;
        }

        .product-title {
            font-size: 12px;
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box !important;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            color: #000;
        }

        .slider-all-link {
            font-size: 13px;
            float: left;
            color: #000;
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
                bottom: 10px;
                left: 0;
                right: 0;
            }

            .swiper-slide .card-body {
                max-height: 300px;
                min-height: 300px;
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
                bottom: 10px;
                left: 0;
                right: 0;
            }

            .swiper-slide .card-body {
                max-height: 300px;
                min-height: 300px;
            }
        }

        @media (min-width: 550px) {
            .product-title {
                position: absolute;
                bottom: 40px;
            }

            .img-swiper {
                padding: 5px;
                /*padding: 35px;*/
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
                max-height: 300px;
                min-height: 300px;
            }
        }

        @media (min-width: 670px) {
            .product-title {
                position: absolute;
                bottom: 33px;
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
                max-height: 300px;
                min-height: 300px;
            }
        }

        @media (min-width: 700px) {
            .product-title {
                position: absolute;
                bottom: 30px;
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
                max-height: 300px;
                min-height: 300px;
            }
        }

        @media (min-width: 780px) {
            .product-title {
                position: absolute;
                bottom: 30px;
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
                max-height: 300px;
                min-height: 300px;
            }
        }

        @media (min-width: 800px) {
            .product-title {
                position: absolute;
                bottom: 20px;
            }

            .img-swiper {
                padding: 8px;
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
                max-height: 330px;
                min-height: 330px;
            }
        }

        @media (min-width: 1000px) {
            .product-title {
                position: absolute;
                bottom: 80px;
                right: 0;
                left: 0;
                text-align: center;
            }

            .img-swiper {
                padding: 0px;
                max-width: 150px;
                min-width: 150px;
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
            /*    max-height: 300px;*/
            /*    min-height: 300px;*/
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
        <div class="swiper-container" style="width: 100%; height: 100%;" id="products-slider"
        >
            <div class="swiper-wrapper" wire:ignore>

                @forelse ($products as $product)
                    <div class="swiper-slide"
                         {{--                         wire:key="{{ ($model ?? 'model') . '_product_'.$product['id'] }}"--}}
                         id="categories-slider-slide wire:ignore"
                         wire:key="id-{{$product['id'] ?? $loop->index}}"
                        {{--                         style="width: 132px !important; margin-right: 16px; text-align: center; font-size: 18px; background: #fff; display: -webkit-box; display: -ms-flexbox; display: -webkit-flex; display: flex; -webkit-box-pack: center; -ms-flex-pack: center; -webkit-justify-content: center; justify-content: center; -webkit-box-align: center; -ms-flex-align: center; -webkit-align-items: center; align-items: center;"--}}
                    >

                        <div class="card top-product-card" style="height: 100%;">
                            <div class="card-body"
                                 @if ($_model == 'business')
                                 style="max-height: 300px; min-height: 300px;"
                                @endif
                            >
                                {{--                                    <span class="badge badge-success">فروش</span>--}}

                                {{--                                    <a class="wishlist-btn" href="#"><i class="lni lni-heart"></i></a>--}}

                                <a class="product-thumbnail d-block"
                                   href="{{route('site.products.single',$product['slug'])}}">
                                    {{--                                <img class="mb-2" src="{{$product->thumbnail_url}}" alt=""></a>--}}
                                    <img loading="lazy" class="mb-2 img-responsive img-swiper"
                                         src="{{$product['thumbnail_url']}}"
                                         alt=""></a>

                                <a
                                    class="product-title d-block text-decoration-none"
                                    href="{{route('site.products.single',$product['slug'] ?? null)}}">{{\Illuminate\Support\Str::limit($product['title'] ?? null,40)}}</a>
                                <div class="text-center justify-content-center mt-3 price-range-slide">
                                    @if(isset($product['has_prices_with_stock']) and $product['max_price'] != 0)
                                        @if ($product['min_price'] == $product['max_price'])
                                            {{ number_format($product['min_price']) }}
                                        @else
                                            از
                                            <span
                                                style="color: #8BC34A;">{{ number_format($product['min_price']) }}</span>
                                            تا
                                            <span
                                                style="color:#ff1744; ">{{ number_format($product['max_price']) }}</span>
                                        @endif
                                        تومان
                                        @if(isset($product['best_price']) and $model == 'category')
                                            <p class="text-center justify-content-center best-price-business">
                                                بهترین
                                                قیمت در
                                                <b style="color: #8BC34A; ">{{ $product['best_price'] ?? null }}</b>
                                            </p>
                                        @endif
                                    @else
                                        <span class="listing-cat-address">بدون قیمت</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        {{--   <div class="card flash-sale-card">
                               <div class="card-body"><a href="{{route('site.products.single',$product->slug)}}">
                                       <img src="{{$product->thumbnail_url}}" height="100" alt="">
                                       --}}{{--                                                <span class="product-title">{{$product->title}}</span>--}}{{--
                                       --}}{{--                                                <p class="sale-price">36 تومان <span class="real-price"> 55 تومان</span></p>--}}{{--
                                       <p class="color-black" style="font-size:11px;">
                                           {{ \Illuminate\Support\Str::limit($product->title,20) }}
                                       </p>

                                   </a>
                               </div>
                           </div>--}}
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
                                </a>
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
                                </a>
                            </div>
                        </div>
                    </div>
                @endforelse

            </div>

            <!-- Add Pagination -->
            {{--                    <div class="swiper-pagination"></div>--}}
        </div>

    @endif

</div>
