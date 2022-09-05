<div>
    <div class="section-full p-b50 p-t20">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-9 col-md-12">
                    <div class="row">

                        <div class="col-md-6 col-sm-12">

                            <div class="wt-list-panel m-b30 p-a20 bg-white shadow">
                                <div class="wt-list-single-about-detail">
                                    {{--                                        <div class="m-b30 text-center">--}}
                                    {{--                                            <h5 style="font-size: 16px;" class="wt-list-panel-title m-t0">تماس با کسب و--}}
                                    {{--                                                کار--}}
                                    {{--                                            </h5>--}}
                                    {{--                                            <div class="wt-separator sep-gradient-light"></div>--}}
                                    {{--                                        </div>--}}
                                    <div class="d-flex mt-2">

                                        <a target="_blank"
                                           href="{{route('site.business.website.link',$business->hash_id)}}">
                                            <img class="img-fluid float-right text-right"
                                                 width="100px"
                                                 height="100px"
                                                 src="/uploads/logos/{{$business->logo}}"
                                                 alt="{{$business->name}}">
                                        </a>


                                        <div class="mr-3 mt-4" style="padding-right: 55px;">
                                            <a target="_blank"
                                               href="{{route('site.business.website.link',$business->hash_id)}}">
                                                <h5 class="wt-list-single-title">{{$business->name}}</h5>
                                            </a>

                                            <div class="wt-rating-section" style="font-size: 13px">
                                                                <span class="wt-rating rtl">
                                                                    @for($i = 0; $i < 5; $i++) <span>
                                                                        <i class="{{ $business->ratingAvg() <= $i ? 'far fa-star' : 'fas fa-star' }}"></i>
                                                                    </span>
                                                                    @endfor
                                                                </span>
                                                <span
                                                    class="wt-rating-conting">( {{$business->ratingCount()}})</span>
                                            </div>
                                        </div>
                                    </div>

                                    {{--                                    @if (!$business->isSpecialType('not_show_manager'))--}}
                                    {{--                                        @isset($business->manager->full_name)--}}
                                    {{--                                            <strong>--}}
                                    {{--                                                نام مدیر:--}}
                                    {{--                                            </strong>--}}

                                    {{--                                            <p style="font-size: 15px;">--}}
                                    {{--                                                {{$business->manager->full_name}}--}}
                                    {{--                                            </p>--}}

                                    {{--                                        @endisset--}}

                                    {{--                                    @endif--}}

                                    <div class="row mt-4">
{{--                                        <div class="col-6">--}}
{{--                                            @isset($business->business_type)--}}
{{--                                                <strong>--}}
{{--                                                    نوع کسب و کار:--}}
{{--                                                </strong>--}}

{{--                                                <p style="font-size: 15px;">--}}
{{--                                                    {{ $business->business_type->title }}--}}
{{--                                                </p>--}}

{{--                                            @endisset--}}
{{--                                        </div>--}}
                                        <div class="col-4">
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
                                        <div class="col-8">
                                            @isset($business->website)
                                                <p style="float:left; font-size: 15px;">

                                                    <a class="text-decoration-none btn btn-black" rel="nofollow" style="text-transform: lowercase; background-color: #8BC34A; font-size: 14px; color: indigo; text-shadow: 0 0 black; margin: 5px; }"
                                                       target="_blank"
                                                       href="{{route('site.business.website.link',$business->hash_id)}}">
                                                        {{ getDomain($business->website) }}
                                                    </a>
{{--                                                    <strong>--}}
{{--                                                        <a  target="_blank"--}}
{{--                                                            href="{{route('site.business.website.link',$business->hash_id)}}">{{ $business->website }}</a>--}}
{{--                                                    </strong>--}}
                                                </p>
                                            @endisset
                                        </div>
                                    </div>

                                    <div class="row">

                                        <div class="col-6">
                                            {{--                                            @if (!$business->isSpecialType('not_show_manager'))--}}

                                            {{--                                                @isset($business->manager->mobile)--}}
                                            {{--                                                    <strong>--}}
                                            {{--                                                        تلفن همراه:--}}
                                            {{--                                                    </strong>--}}

                                            {{--                                                    <p style="font-size: 15px;">--}}

                                            {{--                                                        <a title="برای تماس کلیک کنید"--}}
                                            {{--                                                           class="text-decoration-none color-black"--}}
                                            {{--                                                           href="tel:{{$business->manager->mobile}}">--}}
                                            {{--                                                            <span>--}}
                                            {{--                                                                <i class="far fa-mobile site-text-secondry"></i>--}}
                                            {{--                                                            </span>--}}
                                            {{--                                                            <span style="margin-right: 10px;">--}}
                                            {{--                                                {{$business->manager->mobile}}--}}
                                            {{--                                            </span>--}}
                                            {{--                                                        </a>--}}

                                            {{--                                                    </p>--}}

                                            {{--                                                @endisset--}}
                                            {{--                                            @endif--}}
                                        </div>
                                    </div>

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
                                    @if (!empty($business->social_whatsapp) or !empty($business->social_telegram) or !empty($business->social_instagram))
                                        <strong>
                                            شبکه های اجتماعی:
                                        </strong>

                                        <ul class="vandad-icons-social"
                                            style="margin: -10px;">
                                            @if (!empty($business->social_whatsapp))
                                                <li>
                                                    <a href="https://api.whatsapp.com/send?phone=98{{ $business->social_whatsapp }}"
                                                       target="_blank"
                                                       class="icon-whatsapp"></a>
                                                </li>
                                            @endif
                                            @if (!empty($business->social_telegram))
                                                <li>
                                                    <a href="https://t.me/{{ $business->social_telegram }}"
                                                       target="_blank"
                                                       class="icon-telegram"></a>
                                                </li>
                                            @endif
                                            @if (!empty($business->social_instagram))
                                                <li>
                                                    <a href="https://instagram.com/{{ $business->social_instagram }}"
                                                       target="_blank"
                                                       class="icon-instagram"></a>
                                                </li>
                                            @endif
                                        </ul>

                                    @endif


                                </div>
                                <br>
                            </div>

                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="wt-list-panel m-b30 p-a20 bg-white shadow">
                                <div class="wt-list-single-about-detail">
                                    <div class="m-b30 text-center">
                                        <h5 style="font-size: 16px;" class="wt-list-panel-title m-t0">اطلاعات کسب و
                                            کار
                                            {{--                                                    {{$business->name}}--}}
                                        </h5>
                                        <div class="wt-separator sep-gradient-light"></div>
                                    </div>


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
                            <br>

                        </div>
                        {{--
                                                    @if ($business->longitude != '0.000000' and $business->latitude != '0.000000')
                                                        <div class="col-md-6 col-sm-12">

                                                            <div class="wt-list-panel m-b30  p-a20 bg-white shadow"
                                                                 style="max-height: 259px; min-height: 259px;">
                                                                <div class="m-b30 text-center">
                                                                    <h5 style="font-size: 16px;" class="wt-list-panel-title m-t0">نشانی روی
                                                                        نقشه</h5>
                                                                    <div class="wt-separator sep-gradient-light"></div>
                                                                </div>
                                                                <div class="wt-list-single-map">
                                                                    <a target="_blank"
                                                                       href="https://www.google.com/maps/place/{{$business->latitude}},{{$business->longitude}}">
                                                                        <cedarmaps-marker latitude="{{$business->latitude}}"
                                                                                          longitude="{{$business->longitude}}">

                                                                        </cedarmaps-marker>
                                                                    </a>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                        --}}

                    </div>
                    <div class="col-12" id='prices'>
                        <div class="wt-list-panel m-b30  p-a20 bg-white shadow">
                            <div class="wt-list-single-about-detail">
                                <div class="m-b30 text-right">

                                    <h5 style="font-size: 16px;" class="wt-list-panel-title m-t0">فهرست قیمت ها
                                        ({{ $business->prices()->count() }})</h5>
                                    <hr>

                                    @if ($business->has('prices'))

                                        <div class="justify-content-center md-form form-sm d-flex">
                                            <i class="far fa-search float-right"
                                               style="color: black; margin-right: 10px; padding-top: 25px;"
                                               aria-hidden="true"></i>

                                            <input class="form-control form-control-sm ml-3 w-75 float-right"
                                                   type="text" name="q" wire:model="search"
                                                   style="margin: 10px" placeholder="جستجو در نتایج"
                                                   aria-label="Search">

                                            {{--                                            <button style="font-size: 12px; border-radius: 10px; color: #fff; background-color: #ff1744 !important;" class="btn list-cat-verified" wire:click="searchSubmit">جستجو</button>--}}

                                        </div>
                                        <div class="table-responsive" wire:init="loadPrices">
                                            <table class="table text-center">
                                                <thead class="site-bg-primary white-text">
                                                <tr>
                                                    <th scope="col">ردیف</th>
                                                    <th scope="col">تصویر</th>
                                                    <th scope="col">نام کالا</th>
                                                    <th scope="col">قیمت (تومان)</th>
                                                    <th scope="col">بروزرسانی</th>
                                                    <th scope="col">گزینه ها</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @if(!$business->canPricing())
                                                <tr>
                                                    <th colspan="6" scope="row">

                                                        این کسب و کار در حال حاضر غیرفعال است.
                                                    </th>
                                                </tr>
                                                @elseif(count($prices) > 0)
                                                    <tr>
                                                        @include('site.livewire.loading',['target'=>'sub_search'])
                                                    </tr>

                                                    @foreach($prices as $price)
                                                        <tr>

                                                            <th scope="row">
                                                                {{ ($prices ->currentpage()-1) * $prices ->perpage() + $loop->index + 1 }}
                                                            </th>

                                                            <td>
                                                                <a target="_blank"
                                                                   href="{{ isset($price->product->slug) ? route('site.products.single',$price->product->slug) : '#' }}">
                                                                    <img width="60"
                                                                         src="{{  isset($price->product->thumbnail_url) ? $price->product->thumbnail_url : '/uploads/product.png' }}">
                                                                </a>
                                                            </td>

                                                            <td>
                                                                <a target="_blank"
                                                                   title="{{ $price->product->title ?? '-' }}"
                                                                   href="{{ isset($price->product->slug) ? route('site.products.single',$price->product->slug) : '#' }}">
                                                                    {{ Str::limit($price->product->title ?? '-',30) }}
                                                                </a>
                                                            </td>

                                                            <td>

                                                                @if ($price->final_price == 0 or $price->stock == 0)
                                                                    <div class="d-flex">
                                                                        ناموجود
                                                                    </div>
                                                                @else
                                                                    <div class="d-flex">
                                                                        <p class="ml-1"
                                                                           style="font-size: 17px; display: flex;">
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
                                                                            style="font-size: 15px; margin-right: 10px;"
                                                                            class="left-align"> تومان </span>

                                                                    </div>


                                                                @endif

                                                            </td>

                                                            <td>{{verta($price->priced_at)->formatDifference()}}</td>

                                                            <td>
                                                                <div class="d-flex">

{{--                                                                    --}}
{{--                                                                    <a--}}
{{--                                                                        title="برای گزارش کلیک کنید"--}}
{{--                                                                        type="button"--}}
{{--                                                                        data-mdb-toggle="modal"--}}
{{--                                                                        class="far fa-flag text-decoration-none waves-effect"--}}
{{--                                                                        style="font-size: 14px; width:max-content; padding: 8px; margin-right: 2px; color:#ff3547;"--}}
{{--                                                                        data-mdb-target="#report-price-{{$price->id}}">--}}

{{--                                                                    </a>--}}
                                                                    @if ($price->link)
                                                                        <a title="برای رفتن به سایت فروشنده کلیک کنید"
                                                                           class="text-decoration-none float-right btn btn-outline-danger btn-rounded waves-effect w-max"
                                                                           style="font-size: 11px; width:max-content; padding: 8px; margin-left: 2px; color: #212529 !important; background: #FBE9E7 !important;"
                                                                           target=" _blank"
                                                                           href="{{ route('site.product.price.link',md5($price->id)) }}">

                                                                            مشاهده در سایت فروشنده


                                                                        </a>
                                                                    @else

                                                                        <a title="برای تماس کلیک کنید"
                                                                           class="text-decoration-none btn btn-outline-danger btn-rounded waves-effect"
                                                                           style="font-size: 11px; width:max-content; padding: 8px; margin-left: 2px;  color: #212529 !important;"
                                                                           href="tel:{{$price->business->phone}}">
                                                                            تماس با فروشنده

                                                                        </a>
                                                                    @endif

                                                                    <a href="javascript:void(0)"
                                                                       title="برای گزارش کلیک کنید"
                                                                       data-bs-toggle="modal"
                                                                       data-bs-target="#report-price-Modal-{{$price->id}}"
                                                                       class="far fa-flag text-decoration-none waves-effect"
                                                                       style="font-size: 14px; padding: 5px; margin:10px; color:#ff3547;"

                                                                    >
                                                                    </a>

                                                                </div>
                                                            </td>

{{--
                                                            <div class="modal fade" wire:ignore
                                                                 id="report-price-{{$price->id}}"
                                                                 tabindex="-1"
                                                                 aria-labelledby="report-price-{{$price->id}}Label"
                                                                 aria-hidden="true"
                                                            >
                                                                <div class="modal-dialog">
                                                                    <form
                                                                        wire:submit.prevent="reportPrice('{{$price->id}}')">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title"
                                                                                    id="exampleModalLabel">
                                                                                    گزارش قیمت ثبت شده توسط
                                                                                    <b>{{ $price->business->name }}</b>
                                                                                </h5>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                @foreach(\Modules\Report\Entities\ReasonType::firstWhere('slug', 'report_business')->reasons ?? [] as $reason)
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
                                                                                <button type="button"
                                                                                        class="btn btn-danger"
                                                                                        data-mdb-dismiss="modal">
                                                                                    خروج
                                                                                </button>
                                                                                <button type="submit"
                                                                                        class="btn btn-success">
                                                                                    ارسال
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
--}}

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

                                                        </tr>

                                                    @endforeach
                                                @else

                                                    @if ($this->readyToLoadPrices)
                                                        <tr>
                                                            <th colspan="6" scope="row">
                                                                @if(!empty($sub_search))
                                                                    موردی برای نمایش یافت نشد.
                                                                @else
                                                                    این کسب و کار قیمتی ثبت نکرده است.
                                                                @endif
                                                            </th>
                                                        </tr>

                                                    @else
                                                        <tr>
                                                            <th colspan="6" scope="row">
                                                                @include('site.livewire.loading',['target'=>'readyToLoadPrices'])
                                                                <p>در حال بارگذاری...</p>
                                                            </th>
                                                        </tr>
                                                    @endif
                                                @endif


                                                </tbody>
                                            </table>
                                        </div>

                                        @if(count($prices) > 0)
                                            @include('site.livewire.loading')

                                            <div class="text-center justify-content-center float-right">

                                                <div class="pagination-bx clearfix">

                                                    <ul class="pagination">
                                                        {!! $prices->links('site.livewire.pagination') !!}
                                                        {{--                                                        {{$prices->appends(Request::all())->links('site.layouts.pagination')}}--}}
                                                    </ul>

                                                </div>
                                            </div>
                                        @endif

                                        <br>
                                        <br>
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

                                    @else
                                        <div class="text-center justify-content-center">
                                            <span class="listing-cat-address">این فروشنده قیمتی ثبت نکرده است</span>
                                        </div>
                                    @endif

                                </div>

                            </div>
                        </div>
                    </div>


                    <div class="col-12">
                        @livewire('site.comment', ['model' => $business])
                    </div>
                </div>

                @include('site.layouts.sidebar')

            </div>

        </div>
    </div>
</div>
