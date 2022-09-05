<div>
    @include('admin.layouts.livewire_loading')
    <div class="intro-y col-span-12 flex flex-wrap sm:flex-no-wrap items-center mt-2 ltr">
        <a href="{{ route('admin.prices.update',$price->id) }}" class="btn btn-primary shadow-md mr-3">
            ویرایش
        </a>
        <button class="mr-auto ml-3 text-theme-1 dark:text-theme-10" wire:click="$refresh">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                 class="feather feather-refresh-ccw w-4 h-4 mr-3">
                <polyline points="1 4 1 10 7 10"></polyline>
                <polyline points="23 20 23 14 17 14"></polyline>
                <path d="M20.49 9A9 9 0 0 0 5.64 5.64L1 10m22 4l-4.64 4.36A9 9 0 0 1 3.51 15"></path>
            </svg>
        </button>

        <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">

            <h2 class="text-lg font-medium truncate ml-auto">
                اطلاعات لینک با شناسه #{{$price->id}}
            </h2>
        </div>

    </div>


    <div class="intro-y col-span-12 lg:col-span-12">
        <div class="overflow-x-auto">
            <table class="table">
                <thead>
                <tr>
                    <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">لینک</th>
                    <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">کسب و کار</th>
                    <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Selector</th>
                    <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Schema</th>
                    <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">دسته</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="border-b dark:border-dark-5">
                        <a target="_blank" href="{{$price->url}}">{{$price->url}}</a>
                    </td>
                    <td class="border-b dark:border-dark-5">{{$price->business->name ?? '-'}}</td>
                    <td class="border-b dark:border-dark-5">{{$price->main_filter_selector ?? '-'}}</td>
                    <td class="border-b dark:border-dark-5">{{$price->itemSchema->title ?? '-'}}</td>
                    <td class="border-b dark:border-dark-5">{{$price->category->title ?? '-'}}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="pos intro-y grid grid-cols-12 gap-5 mt-5">

        <div class="intro-y col-span-12 lg:col-span-8">

            <div class="grid grid-cols-12 gap-5 mt-5">
                <div wire:click="testingLink"
                     class="col-span-12 sm:col-span-4 xxl:col-span-3 box p-5 cursor-pointer zoom-in">
                    <div class="font-medium text-base text-center">تست لینک
                    </div>
                </div>

                <div wire:click="getProductsLink"
                     class="col-span-12 sm:col-span-4 xxl:col-span-3 box p-5 cursor-pointer zoom-in">
                    <div class="font-medium text-base text-center">دریافت لینک محصولات
                    </div>
                </div>
                <div wire:click="scrapeProducts"
                     class="col-span-12 sm:col-span-4 xxl:col-span-3 box p-5 cursor-pointer zoom-in">
                    <div class="font-medium text-base">دریافت اطلاعات محصولات</div>
                </div>
                <div wire:click="pricingProducts"
                     class="col-span-12 sm:col-span-4 xxl:col-span-3 box p-5 cursor-pointer zoom-in">
                    <div class="font-medium text-base">قیمت گذاری کالا های دریافت شده</div>
                </div>
            </div>
            <div class="grid grid-cols-12 gap-5 mt-5 pt-5 border-t border-theme-5">

            </div>
        </div>
        <!-- END: Item List -->
        <!-- BEGIN: Ticket -->
        <div class="col-span-12 lg:col-span-4">
            <div class="tab-content">
                <div class="box p-5 mt-5">
                    <div class="flex border-b dark:border-dark-5 pb-5">
                        <div class="">
                            <div class="text-gray-600">تعداد کل محصولات</div>
                            <div>{{ $price->crawled_products()->count() }}</div>

                        </div>
                        <a class="mr-auto" href="javascript:void(0)" wire:click="deleteAllCrawledProducts">
                            <i class="far fa-trash-alt"></i>
                        </a>
                    </div>
                    <div class="flex items-center border-b dark:border-dark-5 py-5">
                        <div class="">
                            <div class="text-gray-600">تعداد محصولات دریافت شده</div>
                            <div>{{ $price->crawled_products()->whereNotEmpty('title')->count() }}</div>
                        </div>
                    </div>

                    <div class="flex items-center border-b dark:border-dark-5 py-5">
                        <div style="width: 75%;">
                            <div class="w-full h-4 bg-gray-400 dark:bg-dark-1 rounded ml-6">
                                <div
                                    class="h-full bg-theme-1 rounded text-center text-xs text-white"
                                    style="width: {{ $price->crawled_products_percent }}">{{ $price->crawled_products_percent }}

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- END: Ticket -->
    </div>
</div>
