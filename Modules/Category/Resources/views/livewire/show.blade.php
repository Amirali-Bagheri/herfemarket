<div>

    <div class="pos intro-y grid grid-cols-12 gap-5 mt-5">

        <div class="intro-y col-span-12 lg:col-span-8">

            <div class="grid grid-cols-12 gap-5 mt-5">
                <div wire:click="cacheSlider"
                     class="col-span-12 sm:col-span-4 xxl:col-span-3 box p-5 cursor-pointer zoom-in">
                    <div class="font-medium text-base text-center">
                        کش اسلایدر
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    @include('admin.layouts.livewire_loading')
    <div class="intro-y col-span-12 flex flex-wrap sm:flex-no-wrap items-center mt-2 ltr">
        <a href="{{ route('admin.categories.update',$category->id) }}"
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
                اطلاعات دسته {{$category->title}} با شناسه #{{$category->id}}
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
                                <div class="text-gray-600">تعداد کل محصولات</div>
                                <div>{{ $category->products()->count() }}</div>

                            </div>
                            <a class="mr-auto" href="javascript:void(0)" wire:click="deleteAllProducts">
                                <i class="far fa-trash-alt"></i>
                            </a>
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

                {{--                <th class="text-center whitespace-no-wrap">--}}
                {{--                    <a wire:click.prevent="sortBy('slug')" role="button" href="javascript:void(0)">--}}
                {{--                     نام نمایشی--}}
                {{--                        @include('admin.layouts.livewire_sort_icon', ['field' => 'slug'])--}}
                {{--                    </a>--}}
                {{--                </th>--}}

                <th class="text-center whitespace-no-wrap">
                    <a wire:click.prevent="sortBy('parent_id')" role="button" href="javascript:void(0)">
                        مادر
                        @include('admin.layouts.livewire_sort_icon', ['field' => 'parent_id'])
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
            @forelse ($category->children as $sub_category)

                <tr class="intro-x">
                    <td class="text-center w-5">{{$sub_category->id}}</td>
                    <td class="text-center">{{$sub_category->title}}</td>
                    {{--                    <td class="text-center">{{$sub_category->slug}}</td>--}}
                    <td class="text-center">{{$sub_category->parent_title}}</td>
                    <td class="text-center">
                        {{ $sub_category->status_name }}
                    </td>
                    <td class="text-center">{{ $sub_category->created_at_human}}</td>

                    {{-- <td class="text-center">{{ verta($sub_category->last_login_at)->formatDifference()  }}</td> --}}
                    <td class="table-report__action w-50 text-center">
                        <a style="margin: 5px;"
                           href="{{$sub_category->url}}"
                           target="_blank">
                            <i class="fas fa-link"></i>
                        </a>

                        <a href="{{route('admin.categories.show',$sub_category->id)}}" style="margin: 5px;">
                            <i class="fa-regular fa-eye"></i>
                        </a>
                        <a style="margin: 5px;" href="{{route('admin.categories.update',$sub_category->id)}}">
                            <i class="fa-regular fa-pen-to-square"></i>

                        </a>
                        <a style="margin: 5px;"
                           href="javascript:void(0)"
                           wire:click="destroy({{$sub_category->id}})"
                            {{--                           href="{{route('admin.categories.delete',$sub_category->id)}}"--}}
                        >
                            <i class="fa-regular fa-trash-alt"></i>
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

    <div class="intro-y col-span-12 flex flex-wrap sm:flex-no-wrap items-center mt-2 ltr">
        <div class="dropdown">
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
                                    class="btn btn-danger w-24 border text-white-700 mr-1 ml-2 ml-2">لغو
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
            نمایش {{ $products->firstItem() }} تا {{ $products->lastItem() }} از {{ $products->total() }} مورد
        </div>
        <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">

            <div class="w-56 relative text-gray-700">
                <input type="text" wire:model.debounce.500ms="search"
                       class="form-control w-56 box pr-10 placeholder-theme-13 rtl" placeholder=" جستجو...">
                <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-feather="search"></i>
            </div>
        </div>

    </div>

    <div class="intro-y col-span-12 overflow-auto lg:overflow-visible" style="overflow: auto;">
        <table class="table table-report -mt-2">
            <thead>
            <tr>
                <th class="text-center whitespace-no-wrap">
                    <input type="checkbox" class="form-check-input mr-2"
                           @if(count($selected)===$products->total()) checked
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
                        زمان ایجاد
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
                    <td class="text-center">{{ $product->updated_at_human_ago}}</td>

                    {{-- <td class="text-center">{{ verta($product->last_login_at)->formatDifference()  }}</td> --}}
                    <td class="table-report__action w-50 text-center">
                        <a href="{{route('admin.products.show',$product->id)}}" style="margin: 5px;">
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
                            <i class="fa-regular fa-trash-alt"></i>
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

    <div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center">

        <div class="form-inline ml-auto">
            {{ $products->links('admin.layouts.livewire_pagination') }}
        </div>

        @include('core::livewire.layouts.paginate_numbers')
    </div>

    <div class="intro-y box mt-4">
        <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200">
            <h2 class="font-medium text-base ml-auto">
                وارد کردن محصولات
            </h2>
        </div>
        <div class="p-5" id="file-type-validation">
            <form wire:submit.prevent="import">

                <input type="file" class="form-control" id="exampleInputName" wire:model="import">
                @error('import') <span class="text-danger">{{ $message }}</span> @enderror

                <button class="btn btn-primary shadow-md mr-2 float-left">آپلود</button>
            </form>
        </div>
    </div>

</div>
