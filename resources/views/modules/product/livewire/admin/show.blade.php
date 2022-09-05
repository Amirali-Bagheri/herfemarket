<div>
    @include('admin.layouts.livewire_loading')
    <div class="intro-y col-span-12 flex flex-wrap sm:flex-no-wrap items-center mt-2 ltr">
        <a href="{{ route('admin.products.update',$product->id) }}"
           class="btn btn-primary shadow-md mr-2">
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
                اطلاعات محصول {{$product->title}} با شناسه #{{$product->id}}
            </h2>
        </div>

    </div>

    <div class="pos intro-y grid grid-cols-12 gap-5 mt-5">

        <div class="intro-y col-span-12 lg:col-span-8">

            <div class="col-span-12 lg:col-span-4">
                <div class="tab-content">
                    <div class="box p-5 mt-5">
                        <div class="flex border-b dark:border-dark-5 pb-5">
                            <div class="">
                                <div class="text-gray-600">
                                    قیمت ها
                                </div>
                                <div>{{ $product->prices()->count() }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="pos intro-y grid grid-cols-12 gap-5 mt-5">

        <div class="intro-y col-span-12 lg:col-span-8">

            <div class="col-span-12 lg:col-span-4">
                <div class="tab-content">
                    <div class="box p-5 mt-5">
                        <div class="flex border-b dark:border-dark-5 pb-5">
                            <div class="">
                                <div class="text-gray-600">
                                    محصول دریافت شده
                                </div>
                                <div>
                                    <a href="{{route('admin.crawled_products.show',$product->crawled_id)}}">
                                        {{ $product->crawled_product->title }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



</div>
