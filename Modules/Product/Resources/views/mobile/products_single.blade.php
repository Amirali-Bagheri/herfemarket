<div>
    @include('mobile.layouts.sidebar')

    <div class="text-center justify-content-center">
        <div class="">
            <img class="img-fluid img-thumbnail" src="{{$product->thumbnail_url}}">
        </div>
    </div>

    <div class="product-description pb-3">
        <div class="product-title-meta-data bg-white mb-3">
            <div class="container d-flex justify-content-center">
                <div class="p-title-price">
                    <h6 style="font-size: 15px" class="mb-2">{{$product->title}}</h6>
                    <h6 style="text-align:center; direction: ltr; font-size: 12px; color: #c0c2c5; margin-top: 5px;"
                        class="mb-1">{{$product->en_title}}</h6>
                    <p class="text-center justify-content-center mt-3 mb-0">
                        @if($product->has_prices and $product->max_price != 0)
                            قیمت
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

                        @else
                            بدون قیمت
                        @endif
                    </p>
                </div>
            </div>

            <div class="d-flex text-center justify-content-center" style="padding-top: 20px;">
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
            </div>

            <div class="d-flex text-center justify-content-center" style="padding-top: 20px;">
                <div class="product-ratings">
                    <div class="container d-flex align-items-center justify-content-between">
                        <div class="ratings">
                            @for($i = 0; $i < 5; $i++)
                                <span><i
                                        class="{{ $product->ratingAvg() <= $i ? 'far fa-star' : 'fas fa-star' }}"></i></span>
                            @endfor
                            <span class="pl-1">( {{ $product->ratingCount() }} )</span>
                        </div>

                    </div>
                </div>
            </div>

            <br>
            <div class="text-center justify-content-center d-flex">


                <a href="#" title="اشتراک گذاری"
                   data-bs-toggle="offcanvas"
                   data-bs-target="#share-product-Modal">
                    <i style="color:#9E9E9E; font-size: 20px; margin: 10px;"
                       class="fal fa-share-nodes"></i>
                </a>

                <div title="مقایسه">
                    <i style="color:#9E9E9E; font-size: 20px; margin: 10px;"
                       class="fal fa-balance-scale"></i>
                </div>

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

        </div>

        <div class="d-flex align-items-center p-3"
             style="background: #F4FF81; border-radius: 5px; padding: 10px; font-size: 13px; line-height: 2; color: #000; text-align: center;">
            مسئولیت قیمت های درج شده برای کالاها و خدمات به عهده فروشندگان و ارائه
            دهندگان
            خدمات
            بوده و شاگو تنها
            مرجع و
            راهنمای معرفی فروشندگان به خریداران است.
        </div>
        <div class="rating-and-review-wrapper bg-white py-3 mb-3">
            <div class="container-fluid">
                <h5 style="font-size:17px; padding-bottom: 10px;" class="accordian-title">فهرست فروشندگان
                    ({{ $product->prices_count ?? count($prices) }})
                </h5>
                <div class="accordion" id="accordionProductPrices" wire:init="loadPrices">
                    @if($product->has_prices)
                        @if(count($prices) > 0)
                            @foreach($prices as $price)
                                <div class="accordian-header">
                                    <div
                                        class="align-items-center justify-content-between w-100 collapsed btn mb-2"
                                        {{--                                        type="button"--}}
                                        {{--                                        data-toggle="collapse"--}}
                                        {{--                                        data-target="#price-{{$price->id}}"--}}
                                        aria-expanded="false"
                                        aria-controls="price-{{$price->id}}">

                                        <div>
                                            <a rel="nofollow"
                                               class="text-decoration-none link text-right float-right"
                                               href="{{ route('site.businesses.single',$price->business->slug) }}">
                                                <img width="50" height="50"
                                                     src="/uploads/logos/{{$price->business->logo}}">
                                                <div style="text-align: center; justify-content: center;">
                                                    <p style="font-size: 13px; color: gray; margin-top: 5px;"
                                                       class="font-weight-bold">{{$price->business->name}}</p>

                                                    <p style="font-size: 9px; text-align: center; justify-content: center; margin-top: 5px;">
                                                        @isset($price->business->city)
                                                            <i class="far fa-location"></i>
                                                            {{ $price->business->city->name ?? ' ' }}
                                                        @endisset
                                                    </p>

                                                </div>


                                            </a>
                                            <a href="javascript:void(0)"
                                               {{--                                               data-bs-toggle="modal" data-bs-target="#report-price-Modal-{{$price->id}}"--}}
                                               data-bs-toggle="offcanvas"
                                               data-bs-target="#report-price-Modal-{{$price->id}}"
                                               class="float-left link" style="font-size: 11px; color: red">
                                                گزارش
                                            </a>
                                        </div>
                                        <br>

                                        <a class="no-collapsable link"
                                           target="_blank"
                                           href="{{ route('site.product.price.link',md5($price->id)) }}"
                                        >
                                         <span
                                             class="name-date text-center justify-content-center link">
                                     @if ($price->final_price == 0 || !isset($price->price))
                                                 <div
                                                     class="d-flex text-center justify-content-center mt-3">
                                            <p class="ml-1"
                                               style="font-size: 20px; padding-right: 70px;">
                                                ناموجود
                                            </p>
                                        </div>


                                             @else
                                                 <div
                                                     class="d-flex text-center justify-content-center mt-3">
                                            <p class="ml-1"
                                               style="font-size: 16px;">
                                                @if ($price->hasDiscount())
                                                    <span
                                                        style="text-decoration:line-through;  white-space:nowrap; color: red;">{{ number_format($price->price) }}
                                                    </span>
                                                    <span style="margin-right: 10px; color: #8BC34A;">
                                                        {{ number_format($price->final_price) }}
                                                    </span>
                                                @else
                                                    {{  number_format($price->final_price) }}
                                                @endif
                                                <span style="font-size: 13px;" class="left-align"> تومان </span>
                                            </p>
                                        </div>
                                             @endif
                                </span>

                                            @if (isset($price->crawled_product))
                                                <p class="w-100"
                                                   style="font-size: 12px; font-weight: 700; text-align: center;">{{ $price->crawled_product->title }}</p>
                                            @endif

                                        </a>
                                        <div>


                                            <p class="float-right"
                                               style="font-size: 11px; margin-top: 10px; position: absolute">
                                                <i class="far fa-clock"></i>
                                                {{ verta($price->priced_at)->formatDifference() }}
                                            </p>

                                            <div
                                                class="text-center justify-content-center float-left no-collapsable link">
                                                @if ($price->link)
                                                    {{--                                                    <form action="{{ route('site.product.price.link',md5($price->id)) }}" target="_blank">--}}

                                                    <a
                                                        {{--                                                    <button type="submit"--}}
                                                        title="برای رفتن به سایت فروشنده کلیک کنید"
                                                        class="text-decoration-none float-left btn btn-rounded waves-effect no-collapsable link"
                                                        style="font-size: 12px; background-color: #7C4DFF; color: #fff;"
                                                        rel="nofollow noopener noreferer"
                                                        {{--                                                            onclick=" window.open('{{ route('site.product.price.link',md5($price->id)) }}','_blank')"--}}
                                                        target="_blank"
                                                        href="{{ route('site.product.price.link',md5($price->id)) }}"
                                                    >
                                                        مشاهده در سایت فروشنده
                                                    </a>
                                                    {{--                                                    </form>--}}
                                                @else
                                                    <a title="برای تماس کلیک کنید"
                                                       class="text-decoration-none btn btn-rounded waves-effect float-left no-collapsable"
                                                       style="font-size: 12px; padding: 10px; background-color: #7C4DFF; color: #fff;"
                                                       href="{{ route('site.product.price.link',md5($price->id)) }}">
                                                        تماس بگیرید
                                                    </a>
                                                @endif
                                            </div>
                                        </div>

                                        <div wire:ignore class="offcanvas offcanvas-start suha-filter-offcanvas-wrap"
                                             tabindex="-1" id="report-price-Modal-{{$price->id}}"
                                             aria-labelledby="suhaFilterOffcanvasLabel">
                                            <button class="btn-close text-reset" type="button"
                                                    data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                            <div class="offcanvas-body py-5">
                                                <div class="container">
                                                    <div class="row">
                                                        <form wire:submit.prevent="reportPrice('{{$price->id}}')">
                                                            <div class="col-12">
                                                                <div class="widget catagory mb-4">
                                                                    <br>
                                                                    <h6 class="widget-title mb-2">
                                                                        گزارش قیمت ثبت شده توسط
                                                                        <b>{{ $price->business->name }}</b>
                                                                    </h6>
                                                                    <hr>
                                                                </div>
                                                            </div>

                                                            <div>
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
                                                            <div class="col-12 d-flex">
                                                                <br>
                                                                <br>
                                                                <button type="button"
                                                                        class="btn btn-danger w-100 mr-1 ml-1"
                                                                        {{--                                                                    data-mdb-dismiss="modal"--}}
                                                                        data-bs-dismiss="offcanvas"
                                                                >
                                                                    بستن
                                                                </button>
                                                                <button type="submit"
                                                                        class="btn btn-success w-100 mr-1 ml-1"
                                                                        data-bs-dismiss="offcanvas"
                                                                >
                                                                    ارسال
                                                                </button>
                                                                <!-- Apply Filter-->
                                                                {{--                                                            <div class="apply-filter-btn"><a class="btn btn-success w-100" href="#">اعمال محدودیت</a></div>--}}
                                                            </div>

                                                        </form>

                                                    </div>
                                                </div>
                                                <br>
                                                <br>
                                            </div>
                                        </div>

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
        </div>

        <div class="p-specification bg-white mb-3 py-3">
            <div class="container">
                <h5 style="font-size:17px; padding-bottom: 10px;" class="accordian-title">
                    اطلاعات و مشخصات کالا
                </h5>
                <div class="accordion" id="accordionProductInformation" wire:ignore.self>

                    <div class="accordian-header" id="properties">
                        <button class="d-flex align-items-center justify-content-between w-100 collapsed btn"
                                type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false"
                                aria-controls="collapseOne"><span>مشخصات فنی</span><i
                                class="lni lni-chevron-left"></i></button>
                    </div>
                    <div class="collapse" id="collapseOne" aria-labelledby="properties" style="line-height: 30px;"
                         data-parent="#accordionProductInformation">
                        <br>

                        @forelse($product_properties as $key => $value)
                            @if (isset($key,$value))
                                <li>
                                    <?php try{ ?>
                                    <b> <span>{!! $key !!}:</span></b>
                                    <?php } catch (Exception $e) { ?>
                                    <span>-</span> <?php } ?>
                                    <?php try{ ?>
                                    <span>{!! is_array($value) ? implodeValue($value) : $value !!}</span> <?php } catch (Exception $e) { ?>
                                    <span>-</span> <?php } ?>
                                </li>
                            @endif
                        @empty
                            <p class="text-center justify-content-center">
                                مشخصات فنی برای این محصول ثبت نشده است
                            </p>
                        @endforelse
                    </div>

                    {{--                    <div class="accordian-header mt-3" id="description">--}}
                    {{--                        <button class="d-flex align-items-center justify-content-between w-100 collapsed btn"--}}
                    {{--                                type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false"--}}
                    {{--                                aria-controls="collapseTwo"><span>توضیحات</span><i--}}
                    {{--                                class="lni lni-chevron-left"></i></button>--}}
                    {{--                    </div>--}}
                    {{--                    <div class="collapse" id="collapseTwo" aria-labelledby="description"--}}
                    {{--                         data-parent="#accordionProductInformation">--}}
                    {{--                        <br>--}}
                    {{--                        <p style="font-size:14px; line-height:2;">--}}
                    {{--                            {!! html_entity_decode($product->description) !!}--}}
                    {{--                        </p>--}}
                    {{--                    </div>--}}
                </div>
            </div>
        </div>


        @livewire('site.comment', ['model' => $product])

    </div>

    <div wire:ignore class="offcanvas offcanvas-start suha-filter-offcanvas-wrap"
         tabindex="-1" id="share-product-Modal"
         aria-labelledby="suhaFilterOffcanvasLabel">
        <button class="btn-close text-reset" type="button"
                data-bs-dismiss="offcanvas" aria-label="Close"></button>
        <div class="offcanvas-body py-5">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="widget catagory mb-4">
                            <br>
                            <h6 class="widget-title mb-2">
                                این کالا را با دوستان خود به اشتراک
                                بگذارید!
                            </h6>
                            <hr>
                        </div>
                    </div>

                    <div>
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
                            <div class="col-md-6 col-sm-12 mt-2">
                                <a href="https://api.whatsapp.com/send?text={{ route('site.products.single',$product->slug) }}"
                                   class="btn btn-success w-100" style="background-color: #25d366 !important;">
                                    <i class="fab fa-whatsapp"></i>
                                    واتس اپ
                                </a>
                            </div>
                            <div class="col-md-6 col-sm-12 mt-2">
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
                    <div class="col-12 d-flex text-center justify-content-center ">
                        <a href="#"
                           class="m-5 text-black"
                           data-bs-dismiss="offcanvas">
                            بستن
                        </a>
                    </div>


                </div>
            </div>
            <br>
            <br>
        </div>
    </div>

</div>


@push ('head')
    <style>
        .offcanvas {
            z-index: 1000000 !important;
        }

    </style>
@endpush
@push ('scripts')

    <script src="https://code.jquery.com/jquery-3.6.0.slim.js"
            integrity="sha256-HwWONEZrpuoh951cQD1ov2HUK5zA5DwJ1DNUXaM6FsY=" crossorigin="anonymous"></script>

    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

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


        document.addEventListener('livewire:load', function () {
            var products_slider = new Swiper('#products-slider', {
                freeMode: true,
                slidesPerView: 3,
                slidesPerColumn: 1,
                autoplay: {
                    delay: 5000,
                },
                loop: true,
                spaceBetween: 1,
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
            });

            $('.no-collapsable').on('click', function (e) {
                e.stopPropagation();
            });

            $('.link').bootstrapToggle('off');
            $('.collapse').bootstrapToggle('on');

        })

    </script>

@endpush
