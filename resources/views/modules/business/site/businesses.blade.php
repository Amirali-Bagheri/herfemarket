<div>
    <div class="section-full small-device bg-white">
        <div class="container-fluid">

            <div class="row d-flex" style="direction: ltr;">
                <div class="col-lg-9 col-md-7 col-sm-12" wire:init="loadBusinesses" style="direction: rtl;">
                    <div class="shadow p-a30 side-bar-opposite">
                        <div class="wt-listing-filter-bar2">
                            <div class="row">
                                <div class="col-xl-2 col-md-3 col-sm-4">
                                    <div class="wt-sortby-wrap">
                                        <div class="wt-sortby-select">

                                            <div class="form-inline " style="margin: 10px; font-size: 12px;">
                                                <select wire:model="filter" class="form-control border flex-1"
                                                        style=" padding: 12px;">
                                                    <option value="0">انتخاب کنید</option>
                                                    <option value="visits">پر بازدید ترین</option>
                                                    {{--                                                    <option value="discounts">تخفیف دار ها</option>--}}
                                                    {{--                                                    <option value="price_desc">گران ترین</option>--}}
                                                    {{--                                                    <option value="price_asc">ارزان ترین</option>--}}
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-10 col-md-9 col-sm-8 ">
                                    <div
                                        class="form-inline d-flex justify-content-center md-form form-sm mt-0 w-100 float-right d-flex">
                                        <i class="far fa-search float-right"
                                           style="color: black; margin-right: 10px;" aria-hidden="true"></i>

                                        <input class="form-control form-control-sm ml-3 w-75 float-right"
                                               type="text" name="q" wire:model="search"
                                               style="margin: 10px" placeholder="جستجو در نتایج"
                                               aria-label="Search">

                                        {{--                                            <button style="font-size: 12px; border-radius: 10px; color: #fff; background-color: #ff1744 !important;" class="btn list-cat-verified" wire:click="searchSubmit">جستجو</button>--}}

                                    </div>

                                </div>
                            </div>

                        </div>

                        <div class="wt-searchReasult-divider"></div>

                        <div class="wt-listing-container row">
                            <br>
                            <br>
                            @include('site.livewire.loading')

                            @if (isset($businesses) and $businesses->count() > 0)
                                @foreach($businesses as $business)
                                    <div
                                        class="wt-listing-container col-xl-6 col-md-6 col-lg-6 col-sm-6 col-12">
                                        <div class="list-item-container m-b30 clearfix"
                                             style="border-radius: 10px;">
                                            <div class="list-image-box bg-cover bg-no-repeat"
                                                 style="height: auto">
                                                <a style="text-decoration: none"
                                                   href="{{route('site.businesses.single',$business->slug)}}">
                                                <img loading="lazy" class="img-responsive"
                                                     style="border-radius: 50%; width: 80px; height: 80px; margin-right: 20px; margin-top: 45px;;"
                                                     src="/uploads/logos/{{ $business->logo  }}"
                                                     alt="{{$business->name}}">
                                                </a>
                                            </div>

                                            <div class="list-category-content">
                                                <a style="text-decoration: none"
                                                   href="{{route('site.businesses.single',$business->slug)}}">
                                                    <span class="listing-cat-address"
                                                          style="font-size: 16px;">{{$business->name}}
                                            </span>
                                                </a>
                                                <div class="listing-logo-outer float-left col-sm-5 mt-3"
                                                     style="font-size: 12px">
{{--                                                    {{ $business->business_type->title }}--}}
                                                    {{ isset($business->category_parent->title) ? '/'.$business->category_parent->title : null}}
                                                </div>
                                                <a style="text-decoration: none"
                                                   href="{{route('site.businesses.single',$business->slug)}}">

                                                </a>
                                                <div class="wt-rating-section text-right mt-3"
                                                     style="font-size: 13px;">
                                            <span class="wt-rating rtl">
                                                @for($i = 0; $i < 5; $i++) <span><i
                                                        class="{{ $business->ratingAvg() <= $i ? 'far fa-star' : 'fas fa-star' }}"></i></span>
                                                @endfor
                                            </span>
                                                    <span
                                                        class="wt-rating-conting">( {{$business->ratingCount()}} )</span>
                                                </div>
                                                <br>
{{--                                                @isset($business->city)--}}
{{--                                                    <p style="font-size: 15px;" style="margin-top: 10px;"><i--}}
{{--                                                            class="fas fa-map"></i>--}}
{{--                                                        شهر:--}}
{{--                                                        {{$business->city->name}}--}}
{{--                                                    </p>--}}
{{--                                                @endisset--}}

                                                <div class="list-category-label" style="margin: 15px;">


                                                    <a href="{{ route('site.businesses.single',$business->slug) }}">
                                                <span style="border-radius: 20px; background-color: #ff1744 !important;"
                                                      class="list-cat-verified "><i class="fas fa-list"></i> جزئیات کسب و
                                                    کار </span>
                                                    </a>


                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
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
                        <div class="text-center justify-content-center float-right">
                            <div class="pagination-bx clearfix">
                                @isset($businesses)
                                    <ul class="pagination">
                                        {{ $businesses->links('site.livewire.pagination') }}
                                    </ul>
                                @endisset
                            </div>
                        </div>
                        <br>
                    </div>
                </div>
                @include('site.layouts.sidebar.businesses_sidebar_right')

            </div>
        </div>
    </div>
</div>

{{--
<div>
    <div class="section-full small-device p-b30 bg-white">
        <div class="container-fluid">
            <form action="{{ route('site.businesses.filter') }}" method="post" id="business_filter_form">
                @csrf
                @isset($url)
                    <input name="url" value="{{ $url }}" type="hidden">
                @endisset
                <div class="row" style="direction: ltr;">
                    <div class="col-lg-9 col-md-7 col-sm-12" style="direction: rtl;">
                        <div class="shadow p-a30 side-bar-opposite">
                            <div
                                class="form-inline d-flex justify-content-center md-form form-sm mt-0 w-100 float-right">
                                <a href="javascript:void(0)"
                                   onclick="document.getElementById('business_filter_form').submit();">
                                    <i class="far fa-search float-right" style="color: black; margin-right: 10px;"
                                       aria-hidden="true"></i>
                                </a>
                                <input class="form-control form-control-sm ml-3 w-75 float-right" type="text"
                                       name="q"
                                       value="{{ request('q') }}" style="margin: 10px"
                                       placeholder="جستجو در کسب و کار ها"
                                       aria-label="Search">
                            </div>

                            <div class="wt-searchReasult-divider"></div>
                            <div class="wt-listing-container">
                                <div class="row d-flex">

                                    @forelse ($businesses as $business)

                                    @empty
                                        <div class="container">
                                            <div class="text-center row justify-content-center">
                                                کسب و کاری یافت نشد!
                                            </div>
                                            <br>
                                            <div class="text-center row justify-content-center">
                                                <a class="text-decoration-none" href="{{route('register.business')}}">
                                                    <div style="font-size: 13px; width: 250px;"
                                                         class="addbusiness-btn">
                                                        <i
                                                            class="fas fa-plus-circle"></i>
                                                        کسب و کارت رو ثبت کن
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    @endforelse


                                </div>
                            </div>
                            <div class="pagination-bx clearfix ">
                                <ul class="pagination">
                                    {{$businesses->links('site.layouts.pagination')}}
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-5 col-sm-12">
                        @include('site.layouts.sidebar.businesses_sidebar_right')

                    </div>
                </div>
            </form>

        </div>
    </div>

</div>
--}}
