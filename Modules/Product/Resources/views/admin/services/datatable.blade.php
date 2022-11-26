<div>
    <style>
        .sub_title {
            font-size: 12px !important;
            color: gray !important;
        }

    </style>
    @include('admin.layouts.livewire_loading')

    <div class="intro-y col-span-12 flex flex-wrap sm:flex-no-wrap items-center mt-2 ltr">
        <div class="dropdown relative">
            <button class="dropdown-toggle btn px-2 box text-gray-700">
                <span class="w-5 h-5 flex items-center justify-center"> <i class="w-4 h-4 fas fa-plus"></i>
                </span>
            </button>
            <div class="dropdown-menu w-40">
                <div class="dropdown-menu__content box p-2">

                    @if (count($selected) > 0) <a href="javascript:void(0)" data-toggle="modal" data-target="#delete-selected-modal" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white hover:bg-gray-200 rounded-md">
                        <i class="w-4 h-4 ml-2 fal fa-trash"></i> حذف موارد انتخاب شده </a>
                    @endif

                    <a href="javascript:void(0)" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white hover:bg-gray-200 rounded-md">
                        <i class="w-4 h-4 ml-2 fal fa-print"></i> چاپ </a>

                    <a href="javascript:void(0)" wire:click='export' class="flex items-center block p-2 transition duration-300 ease-in-out bg-white hover:bg-gray-200 rounded-md">
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
                            <button type="button" data-dismiss="modal" class="btn btn-danger w-24 border text-white-700 mr-1 ml-2">لغو
                            </button>
                            <button type="button" wire:click="deleteAll" data-dismiss="modal" class="btn w-24 bg-theme-6 text-white">حذف
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="hidden md:block mx-auto text-gray-600">
            نمایش {{ $products->firstItem() }} تا {{ $products->lastItem() }} از {{ $products->total() }} مورد
        </div>
        <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">

            <div class="w-56 relative text-gray-700">
                <input type="text" wire:model.debounce.500ms="search" class="form-control w-56 box pr-10 placeholder-theme-13 rtl" placeholder=" جستجو...">
                <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-feather="search"></i>
            </div>
        </div>

    </div>

    <div class="intro-y col-span-12 overflow-auto lg:overflow-visible" style="overflow: auto;">
        <table class="table table-report -mt-2">
            <thead>
                <tr>
                    <th class="text-center whitespace-no-wrap">
                        <input type="checkbox" class="form-check-input mr-2" @if (count($selected)===$products->total()) checked @endif wire:click.lazy="toggleSelectAll">
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
                        <a wire:click.prevent="sortBy('status')" role="button" href="javascript:void(0)">
                            وضعیت
                            @include('admin.layouts.livewire_sort_icon', ['field' => 'status'])
                        </a>
                    </th>
                    <th class="text-center whitespace-no-wrap">
                        <a wire:click.prevent="sortBy('created_at')" role="button" href="javascript:void(0)">
                            ایجاد شده در
                            @include('admin.layouts.livewire_sort_icon', ['field' => 'created_at'])
                        </a>
                    </th>
                    <th class="text-center whitespace-no-wrap">
                        <a wire:click.prevent="sortBy('updated_at')" role="button" href="javascript:void(0)">
                            روز رسانی
                            @include('admin.layouts.livewire_sort_icon', ['field' => 'updated_at'])
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
                        <input type="checkbox" class="form-check-input mr-2" wire:model="selected" value="{{ $product->id }}">

                    </td>
                    <td class="text-center w-5">{{ $product->id }}</td>
                    <td class="text-center">
                        {{ $product->title }}
                        <br>
                        <span class="sub_title"> {{ $product->en_title }}</span>
                    </td>
                    <td class="text-center">
                        {{ $product->status_name }}
                    </td>
                    <td class="text-center">{{ $product->created_at_human_ago }}</td>
                    <td class="text-center">{{ $product->updated_at_human_ago }}</td>
                    <td class="table-report__action w-40 text-center">
                        <a target="_blank" href="{{ route('site.services.single', $product->slug ?? '#') }}" style="margin: 5px;">
                            <i class="fa fa-link"></i>
                        </a>
                        <a style="margin: 5px;" href="{{ route('admin.services.update', $product->id) }}">
                            <i class="fa-regular fa-pen-to-square"></i>

                        </a>
                        <a style="margin: 5px;" href="javascript:void(0)" wire:click="destroy({{ $product->id }})" {{--                           href="{{route('admin.products.delete',$product->id)}}" --}}>
                            <i class="far fa-trash-alt"></i>
                        </a>
                    </td>

                </tr>
                @empty
                <tr class="intro-x">
                    <td colspan="9" class="text-center">
                        موردی برای نمایش یافت نشد
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

    </div>

    <div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-no-wrap">


        <div class="form-inline ml-auto w-full">
            {{ $products->links('admin.layouts.livewire_pagination') }}
        </div>

        @include('core::livewire.layouts.paginate_numbers')

    </div>


    {{-- <div class="intro-y box mt-4"> --}}
    {{-- <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200"> --}}
    {{-- <h2 class="font-medium text-base ml-auto"> --}}
    {{-- وارد کردن محصولات --}}
    {{-- </h2> --}}
    {{-- </div> --}}
    {{-- <div class="p-5" id="file-type-validation"> --}}
    {{-- <form wire:submit.prevent="import"> --}}

    {{-- <input type="file" class="form-control" id="exampleInputName" wire:model="import"> --}}
    {{-- @error('import') <span class="text-danger">{{ $message }}</span> @enderror --}}

    {{-- <button class="btn btn-primary shadow-md mr-2 float-left">آپلود</button> --}}
    {{-- </form> --}}
    {{-- </div> --}}
    {{-- </div> --}}


</div>
