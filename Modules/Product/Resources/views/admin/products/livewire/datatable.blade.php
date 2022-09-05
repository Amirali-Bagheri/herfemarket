<div>
    <div class="grid grid-cols-12 gap-5 mt-5">
        <div wire:click="deleteOldPrices"
             class="col-span-12 sm:col-span-4 xxl:col-span-3 box p-5 cursor-pointer zoom-in">
            <div class="font-medium text-base text-center">
               حذف قیمت های قدیمی
            </div>
        </div>
    </div>

    <style>
        .sub_title {
            font-size: 12px !important;
            color: gray !important;
        }
    </style>
    @include('admin.layouts.livewire_loading')

    <div class="intro-y col-span-12 flex flex-wrap sm:flex-no-wrap items-center mt-2 ltr">
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary shadow-md mr-2">محصول
            جدید</a>
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

        <a
            href="javascript:void(0)"
            wire:click="$toggle('isUpdatingProduct')"
            {{--            data-toggle="modal"--}}
            class="btn px-2 box text-gray-700 ml-2" wire:ignore>
            <i class="w-4 h-4 ml-2 fal fa-tools"></i>
            ویرایش محصول گروهی
        </a>

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
            نمایش {{ $products->firstItem() }} تا {{ $products->lastItem() }} از {{ $products->total() }} مورد
        </div>
        <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">

            {{--            <div class="w-56 relative text-gray-700">--}}
            {{--                <input type="text" wire:model.debounce.500ms="search"--}}
            {{--                       class="form-control w-56 box pr-10 placeholder-theme-13 rtl" placeholder=" جستجو...">--}}
            {{--                <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-feather="search"></i>--}}
            {{--            </div>--}}
        </div>

    </div>
    <div class="w-full sm:w-auto mt-3  flex flex-col sm:flex-row sm:items-end xl:items-start xl:flex text-center justify-content-center">
        <div class="sm:flex items-center ml-3 sm:mr-4 mt-2 xl:mt-0 rtl">
            <label class="w-12 flex-none xl:w-auto xl:flex-initial ml-2 mr-2">برند: </label>
            <div class="intro-x relative">
                <div class="search hidden sm:block">
                    <input type="text"
                           class="form-control w-56 box pr-10 placeholder-theme-13 rtl" placeholder="جستجو (با اینتر)"
                           wire:model.defer="searchFilterBrandQuery"
                           wire:keydown.enter="searchFilterBrandQuerySearch">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                         class="feather feather-search search__icon dark:text-gray-300">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                </div>
                <a class="notification sm:hidden" href="">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                         class="feather feather-search notification__icon dark:text-gray-300">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                </a>
                @if (!empty($searchFilterBrandsSuggestions))
                    <div class="search-result"
                         style="visibility: visible; opacity: inherit; width: 220px; position: absolute; right: 0; top: 20px; transition: visibility 0s linear 0.2s, opacity 0.2s 0s; ">
                        <div class="search-result__content">
                            @foreach($searchFilterBrandsSuggestions as $key => $value)
                                <div wire:click="selectFilterBrand('{{$key}}')" style="cursor: pointer;"
                                     class="search-result__content__title">{{$value}}</div>
                            @endforeach
                        </div>
                    </div>
                @endif
                <div class="flex">

                    @forelse($this->searchFilterBrands as $key => $value)
                        <a href="javascript:void(0)" wire:click.prefetch="removeFilterBrand({{$key}})"><i
                                class="far fa-times ml-2 mr-2"></i></a>
                        {{$value}}

                    @empty

                    @endforelse
                </div>
            </div>
        </div>
        <div class="sm:flex items-center ml-3 sm:mr-4 mt-2 xl:mt-0 rtl">
            <label class="w-12 flex-none xl:w-auto xl:flex-initial ml-2 mr-2">دسته بندی: </label>
            <div class="intro-x relative">
                <div class="search hidden sm:block">
                    <input type="text"
                           class="form-control w-56 box pr-10 placeholder-theme-13 rtl" placeholder="جستجو (با اینتر)"
                           wire:model.defer="searchFilterCategoryQuery"
                           wire:keydown.enter="searchFilterCategoryQuerySearch">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                         class="feather feather-search search__icon dark:text-gray-300">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                </div>
                <a class="notification sm:hidden" href="">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                         class="feather feather-search notification__icon dark:text-gray-300">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                </a>
                @if (!empty($searchFilterCategoriesSuggestions))
                    <div class="search-result"
                         style="visibility: visible; opacity: inherit; width: 220px; position: absolute; right: 0; top: 20px; transition: visibility 0s linear 0.2s, opacity 0.2s 0s; ">
                        <div class="search-result__content">
                            @foreach($searchFilterCategoriesSuggestions as $key => $value)
                                <div wire:click="selectFilterCategory('{{$key}}')" style="cursor: pointer;"
                                     class="search-result__content__title">{{$value}}</div>
                            @endforeach
                        </div>
                    </div>
                @endif
                <div class="flex">

                    @forelse($this->searchFilterCategories as $key => $value)
                        <a href="javascript:void(0)" wire:click.prefetch="removeFilterCategory({{$key}})"><i
                                class="far fa-times ml-2 mr-2"></i></a>
                        {{$value}}

                    @empty

                    @endforelse
                </div>
            </div>
        </div>
        <div class="sm:flex items-center mt-2 xl:mt-0 rtl">
            <label class="w-12 flex-none xl:w-auto xl:flex-initial ml-2 mr-2">کسب و کار: </label>
            <select wire:model.defer="searchFilterBusiness" class="form-select w-full mt-2 sm:mt-0 sm:w-auto">
                <option value="0">انتخاب کنید</option>
                @foreach(\Modules\Business\Entities\Business::orderBy('name')->get()->pluck('name','id') as $key => $value)
                    <option value="{{$key}}">
                        {{$value}}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="sm:flex items-center sm:mr-4 mt-2 xl:mt-0">
            <div class="w-56 relative text-gray-700">
                <input type="text" wire:model.defer="search"
                       class="form-control w-56 box pr-10 placeholder-theme-13 rtl" placeholder=" جستجو...">
                <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-feather="search"></i>
            </div>
        </div>
        <div class="mt-2 mr-2 xl:mt-0">
            <button wire:click.prevent="searchClick" type="button" class="btn btn-primary w-full sm:w-16">
                جستجو
            </button>
            {{--                <button id="tabulator-html-filter-reset" type="button" class="btn btn-secondary w-full sm:w-16 mt-2 sm:mt-0 sm:ml-1">پاک کردن</button>--}}
        </div>
    </div>

    @if ($isUpdatingProduct)

        <div class="intro-y mt-5 box">
            <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200 dark:border-dark-5">
                <h2 class="font-medium text-base ml-auto">
                    ویرایش محصول جدید گروهی
                </h2>
            </div>

            <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200 dark:border-dark-5">
                @include('admin.layouts.livewire_loading',['target'=>'updateProduct'])

                <div>
                    <div class="form-label text-right">
                        برند
                    </div>

                    <label>
                        حذف برند
                    </label>
                    <input type="checkbox" class="form-check-input mr-2" wire:model="updateProductRemoveBrand">

                    <div class="intro-x relative">
                        <div class="search hidden sm:block">
                            <input type="text"
                                   class="form-control w-56 box pr-10 placeholder-theme-13 rtl"
                                   placeholder="جستجو (با اینتر)"
                                   wire:model.defer="updateProductSearchFilterBrandQuery"
                                   wire:keydown.enter="updateProductSearchFilterBrandQuerySearch">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                 viewBox="0 0 24 24" fill="none"
                                 stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                 stroke-linejoin="round"
                                 class="feather feather-search search__icon dark:text-gray-300">
                                <circle cx="11" cy="11" r="8"></circle>
                                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                            </svg>
                        </div>


                        <div class="grid grid-cols-12 gap-6 mt-5" wire:ignore.self>

                            @forelse($updateProductSearchFilterBrandsSuggestions as $key_brand_search => $value_brand_search)
                                <div class="flex col-span-6 items-center text-gray-700 mt-2">
                                    <input type="radio" class="form-check-input mr-1 ml-1"
                                           wire:key="{{$key_brand_search}}"
                                           value="{{$key_brand_search}}"
                                           id="{{$key_brand_search}}"
                                           wire:model="updateProductSearchFilterBrands">
                                    <label class="cursor-pointer select-none"
                                           for="{{$key_brand_search}}"> {{$value_brand_search}}</label>

                                    @if (!empty($updateProductSearchFilterBrands))
                                        <a class="mr-3 red font-small" href="javascript:void(0)" wire:click="updateProductRemoveSearchFilterBrands">
                                            (حذف)
                                        </a>
                                    @endif
                                </div>

                            @empty

                            @endforelse


                        </div>
                    </div>


                    @error('brand_id_manual')
                    <div class="text-theme-6 mt-2">{{ $message }}</div>
                    @enderror

                </div>
                <div class="mt-3">
                    <div class="form-label text-right">دسته بندی</div>
                    {{--                        <div class="flex">--}}

                    {{--                            @forelse(\Modules\Category\Entities\Category::whereIn('id',$this->searchFilterCategories)->pluck('title','id')->toArray() as $key => $value)--}}
                    {{--                                <a href="javascript:void(0)"--}}
                    {{--                                   wire:click.prefetch="removeFilterCategory({{$key}})"><i--}}
                    {{--                                        class="far fa-times ml-2 mr-2"></i></a>--}}
                    {{--                                {{$value}}--}}

                    {{--                            @empty--}}

                    {{--                            @endforelse--}}
                    {{--                        </div>--}}
                    <div class="intro-x relative">
                        <div class="search hidden sm:block">
                            <input type="text"
                                   class="form-control w-56 box pr-10 placeholder-theme-13 rtl"
                                   placeholder="جستجو (با اینتر)"
                                   wire:model.defer="updateProductSearchFilterCategoryQuery"
                                   wire:keydown.enter="updateProductSearchFilterCategoryQuerySearch">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                 viewBox="0 0 24 24" fill="none"
                                 stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                 stroke-linejoin="round"
                                 class="feather feather-search search__icon dark:text-gray-300">
                                <circle cx="11" cy="11" r="8"></circle>
                                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                            </svg>


                            {{--                                    <button type="button" wire:click.prefetch="searchFilterCategoryQuerySearch"--}}
                            {{--                                            class="btn btn-primary">--}}
                            {{--                                        جستجو--}}
                            {{--                                    </button>--}}
                        </div>
                        <div class="grid grid-cols-12 gap-6 mt-5">
                            {{--                                {{ dump(json_encode($searchFilterCategoriesSuggestions)) }}--}}
                            {{--                                        @if (!empty($searchFilterCategoriesSuggestions))--}}

                            @forelse($updateProductSearchFilterCategoriesSuggestions as $key_category_search => $value_category_search)
                                <div class="flex col-span-6 items-center text-gray-700 mt-2">
                                    <input type="radio" class="form-check-input mr-1 ml-1"
                                           wire:key="{{$key_category_search}}"
                                           value="{{$key_category_search}}"
                                           id="{{$key_category_search}}"
                                           wire:model="updateProductSearchFilterCategories"
                                        {{--                                               wire:click="selectFilterCategory('{{$key_category_search}}')"--}}
                                        {{--                                                               wire:model.defer="new_categories"--}}

                                        {{--                                                   @if (isset($categories[$key_category_search]))--}}
                                        {{--                                                       {{ dd(isset($categories[$key_category_search]),$categories,$key_category_search,$value_category_search) }}--}}
                                        {{--                                                   checked--}}
                                        {{--                                                   @endif--}}>
                                    <label class="cursor-pointer select-none"
                                           for="{{$key_category_search}}"> {{$value_category_search}}</label>
                                </div>

                            @empty

                            @endforelse


                            {{--                                            <div class="search-result"--}}
                            {{--                                                 style="visibility: visible; opacity: inherit; width: 220px; position: absolute; right: 0; top: 20px; transition: visibility 0s linear 0.2s, opacity 0.2s 0s; ">--}}
                            {{--                                                <div class="search-result__content">--}}
                            {{--                                                    @foreach($searchFilterCategoriesSuggestions as $key => $value)--}}
                            {{--                                                        <div wire:click="selectFilterCategory('{{$key}}')" style="cursor: pointer;"--}}
                            {{--                                                             class="search-result__content__title">{{$value}}</div>--}}
                            {{--                                                    @endforeach--}}
                            {{--                                                </div>--}}
                            {{--                                            </div>--}}
                            {{--                                        @endif--}}
                        </div>

                    </div>
                    {{--                                    <p><i class="far fa-info-circle"></i> فقط زیر دسته را انتخاب نمایید</p>--}}
                    {{--                                    <select class="tom-select w-full tomselected" wire:model.defer="category_id_manual">--}}
                    {{--                                        @foreach (\Modules\Category\Entities\Category::query()->orderBy('title')->pluck('title','id') as $key => $value)--}}
                    {{--                                            <option value="null">انتخاب نشده</option>--}}
                    {{--                                            <option value="{{$key}}">{{$value}}</option>--}}
                    {{--                                        @endforeach--}}
                    {{--                                    </select>--}}
                    @error('category_id_manual')
                    <div class="text-theme-6 mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="text-center w-full">
                    <button type="button"
                            wire:click.prevent="$toggle('isCreatingProduct')"
                            class="btn btn-outline-danger w-24 border mr-1 ml-2">لغو
                    </button>
                    <button data-dismiss="modal" type="submit"
                            wire:click.prevent="updateProduct()"
                            class="btn w-24 btn-primary text-white">انجام
                    </button>

                </div>
            </div>
        </div>

    @endif


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
                    <a wire:click.prevent="sortBy('brand_id')" role="button" href="javascript:void(0)">
                        برند
                        @include('admin.layouts.livewire_sort_icon', ['field' => 'brand_id'])
                    </a>
                </th>
                <th class="text-center whitespace-no-wrap">
                    قیمت ها
                </th>

                <th class="text-center whitespace-no-wrap">
                    <a wire:click.prevent="sortBy('visits_count')" role="button" href="javascript:void(0)">
                        بازدید
                        @include('admin.layouts.livewire_sort_icon', ['field' => 'visits_count'])
                    </a>

                </th>

                <th class="text-center whitespace-no-wrap">
                    <a wire:click.prevent="sortBy('status')" role="button" href="javascript:void(0)">
                        وضعیت
                        @include('admin.layouts.livewire_sort_icon', ['field' => 'status'])
                    </a>
                </th>

                {{--                <th class="text-center whitespace-no-wrap">--}}
                {{--                    <a wire:click.prevent="sortBy('created_at')" role="button" href="javascript:void(0)">--}}
                {{--                        زمان ایجاد--}}
                {{--                        @include('admin.layouts.livewire_sort_icon', ['field' => 'created_at'])--}}
                {{--                    </a>--}}
                {{--                </th>--}}

                <th class="text-center whitespace-no-wrap">
                    <a wire:click.prevent="sortBy('created_by')" role="button" href="javascript:void(0)">
                        ایجاد شده توسط
                        @include('admin.layouts.livewire_sort_icon', ['field' => 'created_by'])
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
                        <input type="checkbox" class="form-check-input mr-2" wire:model="selected"
                               value="{{ $product->id }}">

                    </td>
                    <td class="text-center w-5">{{$product->id}}</td>
                    <td class="text-center">
                        {{$product->title}}
                        <br>
                        <span class="sub_title"> {{$product->en_title}}</span>
                    </td>
                    <td class="text-center">{{$product->brand->title ?? '-'}}</td>
                    <td class="text-center">{{$product->prices->count()}}</td>
                    <td class="text-center">{{$product->visits_count}}</td>
                    <td class="text-center">
                        {{ $product->status_name }}
                    </td>
                    <td class="text-center">{{ $product->created_by_name}}</td>
                    <td class="text-center">{{ $product->created_at_human_ago}}</td>
                    <td class="text-center">{{ $product->updated_at_human_ago}}</td>

                    {{-- <td class="text-center">{{ verta($product->last_login_at)->formatDifference()  }}</td> --}}
                    <td class="table-report__action w-40 text-center">
                        <a target="_blank" href="{{route('site.products.single',$product->slug ?? '#')}}"
                           style="margin: 5px;">
                            <i class="fa fa-link"></i>
                        </a>
                        {{--                        <a href="{{route('admin.products.show',$product->id)}}" style="margin: 5px;">--}}
                        {{--                            <i class="fa-regular fa-eye"></i>--}}
                        {{--                        </a>--}}
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


    {{--    <div class="intro-y box mt-4">--}}
    {{--        <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200">--}}
    {{--            <h2 class="font-medium text-base ml-auto">--}}
    {{--                وارد کردن محصولات--}}
    {{--            </h2>--}}
    {{--        </div>--}}
    {{--        <div class="p-5" id="file-type-validation">--}}
    {{--            <form wire:submit.prevent="import">--}}

    {{--                <input type="file" class="form-control" id="exampleInputName" wire:model="import">--}}
    {{--                @error('import') <span class="text-danger">{{ $message }}</span> @enderror--}}

    {{--                <button class="btn btn-primary shadow-md mr-2 float-left">آپلود</button>--}}
    {{--            </form>--}}
    {{--        </div>--}}
    {{--    </div>--}}


</div>
