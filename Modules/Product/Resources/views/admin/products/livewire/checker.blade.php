<div>
    @include('admin.layouts.livewire_loading')
    <div class="grid grid-cols-12 gap-5 mt-5">

        <div wire:click="checkDuplicates"
             class="col-span-12 sm:col-span-4 xxl:col-span-3 box p-5 cursor-pointer zoom-in">
            <div class="font-medium text-base text-center">بررسی محصولات تکراری
            </div>
        </div>
        <div wire:click="checkDuplicatesCrawledProducts"
             class="col-span-12 sm:col-span-4 xxl:col-span-3 box p-5 cursor-pointer zoom-in">
            <div class="font-medium text-base text-center">بررسی محصولات دریافت شده تکراری
            </div>
        </div>
        <div wire:click="checkLinksHealth"
             class="col-span-12 sm:col-span-4 xxl:col-span-3 box p-5 cursor-pointer zoom-in">
            <div class="font-medium text-base">بررسی سلامت لینک محصولات</div>
        </div>
        <div wire:click="hash_id_prices"
             class="col-span-12 sm:col-span-4 xxl:col-span-3 box p-5 cursor-pointer zoom-in">
            <div class="font-medium text-base">Sha1 Prices Id</div>
        </div>
        <div wire:click="checkImagesHealth"
             class="col-span-12 sm:col-span-4 xxl:col-span-3 box p-5 cursor-pointer zoom-in">
            <div class="font-medium text-base">بررسی سلامت تصویر محصولات</div>
        </div>
        <div wire:click="productsWithoutImage"
             class="col-span-12 sm:col-span-4 xxl:col-span-3 box p-5 cursor-pointer zoom-in">
            <div class="font-medium text-base">فهرست محصولات بدون تصویر</div>
        </div>
        <div wire:click="checkPropertiesHealth"
             class="col-span-12 sm:col-span-4 xxl:col-span-3 box p-5 cursor-pointer zoom-in">
            <div class="font-medium text-base">بررسی سلامت مشخصات محصولات</div>
        </div>
        <div wire:click="priceDuplicates"
             class="col-span-12 sm:col-span-4 xxl:col-span-3 box p-5 cursor-pointer zoom-in">
            <div class="font-medium text-base">بررسی قیمت های ثبت شده تکراری</div>
        </div>
    </div>

    @if (count($products) > 0)

        <div class="intro-y col-span-12 flex flex-wrap sm:flex-no-wrap items-center mt-4 ltr">

            <div class="modal" id="action-selected-modal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body p-0">
                    <form wire:submit.prevent="action">
                        <div class="p-5 text-center">
                            <div class="grid grid-cols-12 gap-4 row-gap-3">
                                <div class="col-span-6">
                                    <div class="text-xs text-right">وضعیت</div>
                                    <select class="form-control w-full border mt-2 flex-1"
                                            wire:model="action_status">
                                        <option value="">انتخاب کنید</option>
                                        <option value="1">فعال</option>
                                        <option value="0">غیرفعال</option>
                                    </select>
                                </div>
                                <div class="col-span-6">
                                    <div class="text-xs text-right">عملیات</div>
                                    <select class="form-control w-full border mt-2 flex-1"
                                            wire:model="action_type">
                                        <option value="">انتخاب کنید</option>
                                        <option value="change_default_without_image">تغییر تصویر به پیشفرض بدون تصویر
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="px-5 pb-8 text-center">
                            <button type="button" data-dismiss="modal"
                                    class="btn btn-danger w-24 border text-white-700 mr-1 ml-2">لغو
                            </button>
                            <button data-dismiss="modal" type="submit"
                                    class="btn w-24 bg-theme-6 text-white">انجام
                            </button>
                        </div>
                    </form>
                </div>
                </div>
                </div>
            </div>


            <div class="dropdown relative">
                <button class="dropdown-toggle btn px-2 box text-gray-700">
                <span class="w-5 h-5 flex items-center justify-center"> <i class="w-4 h-4 fas fa-plus"></i>
                </span>
                </button>
                <div class="dropdown-menu w-40">
                    <div class="dropdown-menu__content box p-2">

                        @if (count($selected) > 0) <a href="javascript:void(0)" data-toggle="modal"
                                                      data-target="#delete-selected-modal"
                                                      class="flex items-center block p-2 transition duration-300 ease-in-out bg-white hover:bg-gray-200 rounded-md">
                            <i class="w-4 h-4 ml-2 fal fa-trash"></i> حذف موارد انتخاب شده </a>

                        <a href="javascript:void(0)" data-toggle="modal"
                           data-target="#action-selected-modal"
                           class="flex items-center block p-2 transition duration-300 ease-in-out bg-white hover:bg-gray-200 rounded-md">
                            <i class="w-4 h-4 ml-2 fal fa-tools"></i>
                            عملیات</a>
                        @endif

                        <a href="javascript:void(0)"
                           class="flex items-center block p-2 transition duration-300 ease-in-out bg-white hover:bg-gray-200 rounded-md">
                            <i class="w-4 h-4 ml-2 fal fa-print"></i> چاپ </a>

                        <a href="javascript:void(0)" wire:click='export'
                           class="flex items-center block p-2 transition duration-300 ease-in-out bg-white hover:bg-gray-200 rounded-md">
                            <i class="w-4 h-4 ml-2 fal fa-file-excel"></i> خروجی اکسل </a>

                    </div>
                </div>
                <button class="mr-auto ml-3 text-theme-1 dark:text-theme-10" wire:click="$refresh">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                         class="feather feather-refresh-ccw w-4 h-4 mr-3">
                        <polyline points="1 4 1 10 7 10"></polyline>
                        <polyline points="23 20 23 14 17 14"></polyline>
                        <path d="M20.49 9A9 9 0 0 0 5.64 5.64L1 10m22 4l-4.64 4.36A9 9 0 0 1 3.51 15"></path>
                    </svg>
                </button>
            </div>
            <div class="modal" id="delete-selected-modal" wire:ignore>
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body p-0">
                            <div class="p-5 text-center">
                                <i data-feather="x-circle" class="w-16 h-16 text-theme-6 mx-auto mt-3"></i>
                                <div class="text-3xl mt-5">آیا مطمئن هستید؟</div>
                                <div class="text-gray-600 mt-2">پس از حذف این اطلاعات قابل بازیابی نیست</div>
                            </div>
                            <div class="px-5 pb-8 text-center">
                                <button type="button" data-dismiss="modal"
                                        class="btn btn-danger w-24 border text-white-700 mr-1 ml-2">لغو
                                </button>
                                <button type="button" wire:click="deleteAll" data-dismiss="modal"
                                        class="btn w-24 bg-theme-6 text-white">حذف
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>


        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible" style="overflow: auto;">
            <table class="table table-report -mt-2">
                <thead>
                <tr>
                    <th class="text-center whitespace-no-wrap">
                        <input type="checkbox" class="form-check-input mr-2"
                               @if(count($selected)===$products->count()) checked
                               @endif wire:click.lazy="toggleSelectAll">
                    </th>
                    <th class="text-center whitespace-no-wrap">
                        <a wire:click.prevent="sortBy('id')" role="button" href="javascript:void(0)">
                            شناسه
                            @include('admin.layouts.livewire_sort_icon', ['field' => 'id'])
                        </a>
                    </th>

                    <th class="text-center whitespace-no-wrap">
                        <a wire:click.prevent="sortBy('title')" role="button" href="javascript:void(0)">
                            عنوان
                            @include('admin.layouts.livewire_sort_icon', ['field' => 'title'])
                        </a>
                    </th>
                    <th class="text-center whitespace-no-wrap">
                        قیمت ها
                    </th>

                    <th class="text-center whitespace-no-wrap">
                        بازدید
                    </th>

                    <th class="text-center whitespace-no-wrap">
                        <a wire:click.prevent="sortBy('status')" role="button" href="javascript:void(0)">
                            وضعیت
                            @include('admin.layouts.livewire_sort_icon', ['field' => 'status'])
                        </a>
                    </th>

                    <th class="text-center whitespace-no-wrap">
                        <a wire:click.prevent="sortBy('created_at')" role="button" href="javascript:void(0)">
                            زمان
                            @include('admin.layouts.livewire_sort_icon', ['field' => 'created_at'])
                        </a>
                    </th>

                    <th class="text-center whitespace-no-wrap">
                        گزینه ها
                    </th>
                </tr>
                </thead>
                <tbody>
                @forelse($products as $product)

                    <tr class="intro-x">
                        <td>
                            <input type="checkbox" class="form-check-input mr-2" wire:model="selected"
                                   value="{{ $product->id }}">

                        </td>
                        <td class="text-center w-5">{{$product->id}}</td>
                        <td class="text-center">{{$product->title}}</td>
                        <td class="text-center">{{$product->prices->count()}}</td>
                        <td class="text-center">{{visits($product)->count()}}</td>
                        <td class="text-center">
                            {{ $product->status_name }}
                        </td>
                        <td class="text-center">{{ $product->created_at_human}}</td>

                        {{-- <td class="text-center">{{ verta($product->last_login_at)->formatDifference()  }}</td> --}}
                        <td class="table-report__action w-40 text-center">
                            <a href="{{route('site.products.single',$product->slug)}}" style="margin: 5px;">
                                <i class="fa-regular fa-eye"></i>
                            </a>
                            <a style="margin: 5px;" href="{{route('admin.products.update',$product->id)}}">
                                <i class="fa-regular fa-pen-to-square"></i>

                            </a>
                            <a style="margin: 5px;"
                               href="javascript:void(0)"
                               wire:click="destroy({{$product->id}})"
                                {{--                           href="{{route('admin.products.delete',$product->id)}}"--}}
                            >
                                <i class="far fa-trash-alt"></i>
                            </a>
                        </td>

                    </tr>

                @empty
                    <tr class="intro-x">
                        <td colspan="8" class="text-center">
                            موردی برای نمایش یافت نشد
                        </td>
                    </tr>

                @endforelse
                </tbody>
            </table>

        </div>

        {{--
                <div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-no-wrap">


                    <div class="form-inline ml-auto w-full">
                        {{ $products->links('admin.layouts.livewire_pagination') }}
                    </div>

                          @include('core::livewire.layouts.paginate_numbers')

                </div>
        --}}
    @endif


</div>
