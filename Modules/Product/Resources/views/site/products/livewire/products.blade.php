<div>

    <div class="section-full small-device bg-white">
        <div class="container-fluid">

            <div class="row" style="direction: ltr;">
                <div class="col-lg-9 col-md-8 col-sm-9"
                     wire:init="loadProducts"
                     style="direction: rtl;">
                    <div class="shadow p-a30 side-bar-opposite">
                        <div class="wt-listing-filter-bar2">
                            <div class="row text-center justify-content-center">
                                {{--                                <div class="col-xl-2 col-md-3 col-sm-4">--}}
                                {{--                                    <div class="wt-sortby-wrap">--}}
                                {{--                                        <div class="wt-sortby-select">--}}

                                {{--                                            <div class="form-inline " style="margin: 10px; font-size: 12px;">--}}
                                {{--                                                <select wire:model="sortField" class="form-control border flex-1"--}}
                                {{--                                                        style=" padding: 12px;">--}}
                                {{--                                                    <option value="">انتخاب کنید</option>--}}
                                {{--                                                    <option value="visits">پر بازدید ترین</option>--}}
                                {{--                                                    --}}{{--                                                    <option value="popular">محبوب ترین</option>--}}
                                {{--                                                    --}}{{--                                                    <option value="discounts">تخفیف دار ها</option>--}}
                                {{--                                                    <option value="price_desc">گران ترین</option>--}}
                                {{--                                                    <option value="price_asc">ارزان ترین</option>--}}
                                {{--                                                </select>--}}
                                {{--                                            </div>--}}
                                {{--                                        </div>--}}
                                {{--                                    </div>--}}
                                {{--                                </div>--}}
                                <div class="col-xl-10 col-md-9 col-sm-8 text-center justify-content-center">
                                    <div
                                        class="form-inline d-flex justify-content-center md-form form-sm mt-0 w-100 float-right d-flex">
                                        <i class="far fa-search float-right"
                                           style="color: black; margin-right: 10px; padding-top: 25px;"
                                           aria-hidden="true"></i>

                                        <input class="form-control form-control-sm ml-3 w-75 float-right"
                                               type="text" name="q" wire:model="sub_search"
                                               style="margin: 10px" placeholder="جستجو در نتایج"
                                               aria-label="Search">

                                        {{--                                            <button style="font-size: 12px; border-radius: 10px; color: #fff; background-color: #ff1744 !important;" class="btn list-cat-verified" wire:click="searchSubmit">جستجو</button>--}}


                                    </div>
                                    <br>
                                    <div class="col-xl-10 col-md-9 col-sm-8 text-center justify-content-center d-flex">
                                        <div>
                                            <p style="font-size: 13px; margin: 10px;">
                                                مرتب سازی بر اساس:
                                            </p>
                                        </div>

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
                                </div>
                            </div>

                        </div>
                        @include('site.livewire.loading')

                        <div class="wt-searchReasult-divider text-center justify-content-center"></div>

                        <div class="wt-listing-container row text-center justify-content-center">
                            <br>
                            @if (isset($products) and $products->count() > 0)
                                <div class="row text-center justify-content-center" wire:ignore.self>

                                    @foreach($products as $product)
                                        @include('product::site.products.prodouct_list_single_component',['product'=>$product])
                                    @endforeach

                                </div>
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
                        @if(count($products) > 0)
                            @include('site.livewire.loading')

                            <div class="text-center justify-content-center float-right">

                                <div class="pagination-bx clearfix">

                                    <ul class="pagination">
                                        {!! $products->links('site.livewire.pagination') !!}
                                        {{--                                                                                {{ $products->render() }}--}}
                                    </ul>

                                </div>
                            </div>
                        @endif
                        <br>
                    </div>
                </div>
                @include('site.layouts.sidebar.product_sidebar_right',['url'=>$url])

            </div>
        </div>
    </div>

</div>

@push ('scripts')
    <script type="text/javascript">

        document.addEventListener('livewire:load', function () {

            window.addEventListener('addQueryString', event => {
                insertUrlParam(event.detail.queryKey, event.detail.queryValue, event.detail.queryValueType)
            });

            function insertUrlParam(key, value, valueType) {
                if (history.pushState) {

                    let searchParams = new URLSearchParams(window.location.search);

                    const getQueryParam = (key) => {
                        const url = new URL(window.location.href);
                        return url.searchParams.get(key) || null;
                    };

                    if (valueType == 'array') {
                        for (const item of value) {
                            if (getQueryParam(key) != null) {
                                const oldValue = getQueryParam(key);
                                const newValue = oldValue + ',' + item;

                                searchParams.set(key, newValue);

                            } else {
                                searchParams.set(key, item);
                            }
                        }

                    } else {
                        if (getQueryParam(key) != null) {
                            const oldValue = getQueryParam(key);
                            const newValue = oldValue + ',' + value;

                            searchParams.set(key, newValue);

                        } else {
                            searchParams.set(key, value);
                        }
                    }

                    let newurl = window.location.protocol + '//' + window.location.host + window.location.pathname + '?' + searchParams.toString();
                    history.pushState({}, null, newurl);

                    // window.history.pushState({ path: newurl }, '', newurl);

                    // let searchParams = new URLSearchParams(window.location.search);
                    // searchParams.set(key, value);

                    // const url = new URL(window.location.href);
                    // url.searchParams.set(key, value);
                    // window.history.pushState({}, '', url.toString());
                    //
                    // const getQueryParam = (key) => {
                    //     const url = new URL(window.location.href);
                    //     return url.searchParams.get(key) || null;
                    // };
                    // //
                    // // // const queries = addQueryParam(key,value)
                    //
                    // console.log(getQueryParam('action'))
                    //
                    // if (getQueryParam('action') != null) {
                    //     const oldActionsValue = getQueryParam('action');
                    //     const newActionsValue = oldActionsValue + "," + value;
                    //
                    //     url.searchParams.set(key, newActionsValue);
                    //
                    // } else {
                    //     url.searchParams.set(key, value);
                    //
                    // }
                    //
                    //
                    // window.history.pushState({path: newurl}, '', newurl);
                }
            }

        });


    </script>

    <script type="text/javascript">

        // waiting for DOM loaded
        document.addEventListener('DOMContentLoaded', function () {

            // listen for the event
            window.livewire.on('urlChanged', param => {

                // pushing on the history by passing the current url with the param appended
                history.pushState(null, null, `${document.location.pathname}?${param}`);
            });
        });
    </script>
@endpush
