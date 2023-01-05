<div>
    {{--  @include('admin.layouts.livewire_loading')  --}}

    <div class="intro-y col-span-12 flex flex-wrap sm:flex-no-wrap items-center mt-2 ltr">
        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary shadow-md mr-2">دسته بندی
            جدید</a>
        @if (count($selected) > 0)
        <a href="javascript:void(0)" class="mr-2 ml-2" data-toggle="modal" data-target="#delete-selected-modal">
            <i class="far fa-trash"></i>
        </a>
        @endif
        <a wire:click='export' href="javascript:void(0)">
            <i class="far fa-file-export"></i>
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
                            <button type="button" data-dismiss="modal" class="btn btn-danger w-24 border text-white-700 mr-1 ml-2 ml-2">لغو
                            </button>
                            <button type="button" wire:click="deleteAll" data-dismiss="modal" class="btn w-24 bg-theme-6 text-white">حذف
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="hidden md:block mx-auto text-gray-600">
            نمایش {{ $categories->firstItem() }} تا {{ $categories->lastItem() }} از {{ $categories->total() }} مورد
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
                        <input type="checkbox" class="form-check-input mr-2" @if(count($selected)===$categories->total()) checked
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

                    {{-- <th class="text-center whitespace-no-wrap">--}}
                    {{-- <a wire:click.prevent="sortBy('slug')" role="button" href="javascript:void(0)">--}}
                    {{-- نام نمایشی--}}
                    {{-- @include('admin.layouts.livewire_sort_icon', ['field' => 'slug'])--}}
                    {{-- </a>--}}
                    {{-- </th>--}}

                    <th class="text-center whitespace-no-wrap">
                        <a wire:click.prevent="sortBy('parent_id')" role="button" href="javascript:void(0)">
                            مادر
                            @include('admin.layouts.livewire_sort_icon', ['field' => 'parent_id'])
                        </a>
                    </th>

                    <th class="text-center whitespace-no-wrap">
                        تعداد محصولات
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
                @forelse($categories as $category)

                <tr class="intro-x">
                    <td>
                        <input type="checkbox" class="form-check-input mr-2" wire:model="selected" value="{{ $category->id }}">

                    </td>
                    <td class="text-center w-5">{{$category->id}}</td>
                    <td class="text-center">{{$category->title}}</td>
                    {{-- <td class="text-center">{{$category->slug}}</td>--}}
                    <td class="text-center">{{$category->parent_title}}</td>
                    <td class="text-center">{{$category->products_count}}</td>
                    <td class="text-center">
                        {{ $category->status_name }}
                    </td>
                    <td class="text-center">{{ $category->created_at_human}}</td>

                    {{-- <td class="text-center">{{ verta($category->last_login_at)->formatDifference()  }}</td> --}}
                    <td class="table-report__action w-50 text-center">
                        <a style="margin: 5px;" href="{{$category->url}}" target="_blank">
                            <i class="fas fa-link"></i>
                        </a>

                        <a href="{{route('admin.categories.show',$category->id)}}" style="margin: 5px;">
                            <i class="fa-regular fa-eye"></i>
                        </a>
                        <a style="margin: 5px;" href="{{route('admin.categories.update',$category)}}">
                            <i class="fa-regular fa-pen-to-square"></i>

                        </a>
                        <a style="margin: 5px;" href="javascript:void(0)" wire:click="destroy({{$category->id}})" {{--                           href="{{route('admin.categories.delete',$category->id)}}"--}}>
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
            {{ $categories->links('admin.layouts.livewire_pagination') }}
        </div>

        @include('core::livewire.layouts.paginate_numbers')
    </div>

    <div class="intro-y box mt-4">
        <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200">
            <h2 class="font-medium text-base ml-auto">
                وارد کردن دسته بندی ها
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
