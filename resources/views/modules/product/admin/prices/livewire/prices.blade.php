<div class="relative">
    @include('admin.layouts.livewire_loading')

    <div class="grid grid-cols-12 gap-5 mt-5">
        <div wire:click="deleteOldPrices"
             class="col-span-12 sm:col-span-4 xxl:col-span-3 box p-5 cursor-pointer zoom-in">
            <div class="font-medium text-base text-center">
              حذف قیمت های قدیمی
            </div>
        </div>
    </div>


    <div class="intro-y col-span-12 flex flex-wrap sm:flex-no-wrap items-center mt-2 ltr">
        {{--        <a href="{{ route('admin.prices.create') }}" class="btn btn-primary shadow-md mr-2">کسب و کار--}}
        {{--            جدید</a>--}}
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
                    @endif

                    <a href="javascript:void(0)"
                       class="flex items-center block p-2 transition duration-300 ease-in-out bg-white hover:bg-gray-200 rounded-md">
                        <i class="w-4 h-4 ml-2 fal fa-print"></i> چاپ </a>

                    <a href="javascript:void(0)" wire:click='export'
                       class="flex items-center block p-2 transition duration-300 ease-in-out bg-white hover:bg-gray-200 rounded-md">
                        <i class="w-4 h-4 ml-2 fal fa-file-excel"></i> خروجی اکسل </a>

                </div>
            </div>
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

        <div class="hidden md:block mx-auto text-gray-600">
            نمایش {{ $prices->firstItem() }} تا {{ $prices->lastItem() }} از {{ $prices->total() }} مورد
        </div>
        <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">

            <div class="w-56 relative text-gray-700">
                <input type="text" wire:model.debounce.500ms="search"
                       class="form-control w-56 box pr-10 placeholder-theme-13 rtl" placeholder=" جستجو...">
                <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-feather="search"></i>
            </div>
        </div>

    </div>
{{-- <div wire:loading class="text-center"> --}}
{{-- style="position: absolute;top:0;bottom: 0;left: 0;right: 0;margin: auto;">
    <i data-loading-icon="bars" class="w-8 h-8"></i>
    <div class="text-center text-xs mt-2">bars</div> --}}
{{-- </div> --}}
<!-- BEGIN: Data List -->
    <div class="intro-y col-span-12 overflow-auto lg:overflow-visible" style="overflow: auto;">

        <table class="table table-report -mt-2">
            <thead>
            <tr>
                <th class="text-center whitespace-no-wrap">
                    <input type="checkbox" class="form-check-input mr-2"
                           @if(count($selected)===$prices->total()) checked
                           @endif wire:click.lazy="toggleSelectAll">
                </th>

                <th class="text-center whitespace-no-wrap">
                    <a wire:click.prevent="sortBy('id')" role="button" href="javascript:void(0)">
                        شناسه
                        @include('admin.layouts.livewire_sort_icon', ['field' => 'id'])
                    </a>
                </th>

                <th class="text-center whitespace-no-wrap">
                    <a wire:click.prevent="sortBy('product_id')" role="button" href="javascript:void(0)">
                        نام محصول
                        @include('admin.layouts.livewire_sort_icon', ['field' => 'product_id'])
                    </a>
                </th>

                <th class="text-center whitespace-no-wrap">
                    <a wire:click.prevent="sortBy('price')" role="button" href="javascript:void(0)">
                        قیمت
                        @include('admin.layouts.livewire_sort_icon', ['field' => 'price'])
                    </a>
                </th>

                <th class="text-center whitespace-no-wrap">
                    <a wire:click.prevent="sortBy('business_id')" role="button" href="javascript:void(0)">
                        کسب و کار
                        @include('admin.layouts.livewire_sort_icon', ['field' => 'business_id'])
                    </a>
                </th>

                <th class="text-center whitespace-no-wrap">
                    <a wire:click.prevent="sortBy('status')" role="button" href="javascript:void(0)">
                        وضعیت
                        @include('admin.layouts.livewire_sort_icon', ['field' => 'status'])
                    </a>
                </th>

                {{-- <th class="text-center whitespace-no-wrap">
                     <a wire:click.prevent="sortBy('created_at')" role="button" href="javascript:void(0)">
                         زمان ارسال
                         @include('admin.layouts.livewire_sort_icon', ['field' => 'created_at'])
                     </a>
                 </th>

                 <th class="text-center whitespace-no-wrap">
                     <a wire:click.prevent="sortBy('updated_at')" role="button" href="javascript:void(0)">
                         زمان بروزرسانی
                         @include('admin.layouts.livewire_sort_icon', ['field' => 'updated_at'])
                     </a>
                 </th>
                 --}}

                <th class="text-center whitespace-no-wrap">
                    بازدید
                </th>

                <th class="text-center whitespace-no-wrap">
                    <a wire:click.prevent="sortBy('priced_at')" role="button" href="javascript:void(0)">
                        زمان بروزرسانی
                        @include('admin.layouts.livewire_sort_icon', ['field' => 'priced_at'])
                    </a>
                </th>
                <th class="text-center whitespace-no-wrap">
                    گزینه ها
                </th>
            </tr>
            </thead>
            <tbody>
            @forelse ($prices as $price)

                <tr class="intro-x">
                    <td>
                        <input type="checkbox" class="form-check-input mr-2" wire:model="selected"
                               value="{{ $price->id }}">

                    </td>
                    <td class="text-center w-5">{{$price->id}}</td>

                    <td class="text-center">
                        <a class="color-black text-decoration-none"
                           href="{{route('site.products.single',$price->product->slug)}}">{{$price->product->title}}</a>
                    </td>

                    <td class="text-center">{{number_format($price->price)}}
                        تومان
                    </td>

                    <td class="text-center">
                        <a href="{{route('admin.businesses.show',$price->business_id)}}" target="_blank">
                            {{$price->business->name}}
                        </a>
                    </td>

                    <td class="text-center">
                        {{ $price->status_name }}
                    </td>
                    {{----}}
                    {{----}}
                    {{--                    <td class="text-center">{{ verta($price->created_apricedmatDifference() }}</td>--}}
                    {{--                    <td class="text-center">{{ verta($price->updated_at)->formatDifference() }}</td>--}}
                    <td class="text-center">{{ $price->visits()->count() }}</td>
                    <td class="text-center">{{ $price->priced_at_human_ago }}</td>

                    <td class="table-report__action w-40 text-center">
                        <a href="{{route('admin.prices.show',$price->id)}}" style="margin: 5px;">
                            <i class="fa-regular fa-eye"></i>
                        </a>
                        <a style="margin: 5px;" href="{{route('admin.prices.update',$price->id)}}">
                            <i class="fa-regular fa-pen-to-square"></i>

                        </a>
                        <a style="margin: 5px;"
                           href="javascript:void(0)"
                           wire:click="destroy({{$price->id}})"
                        >
                            <i class="far fa-trash-alt"></i>
                        </a>
                    </td>

                </tr>

            @empty

                <tr class="intro-x">
                    <td colspan="10" class="text-center">
                        موردی برای نمایش یافت نشد
                    </td>
                </tr>

            @endforelse
            </tbody>
        </table>
    </div>
    <!-- END: Data List -->


    <!-- BEGIN: Pagination -->
    <div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-no-wrap">

        <div class="form-inline ml-auto w-full">
            {{ $prices->links('admin.layouts.livewire_pagination') }}
        </div>

        @include('core::livewire.layouts.paginate_numbers')

    </div>
    <!-- END: Pagination -->
</div>
