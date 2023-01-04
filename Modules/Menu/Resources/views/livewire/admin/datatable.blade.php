<div>
    @include('admin.layouts.livewire_loading')

    <div class="intro-y col-span-12 flex flex-wrap sm:flex-no-wrap items-center mt-2 ltr">
        <a href="{{ route('admin.menus.create') }}" class="btn btn-primary shadow-md mr-2">منو
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
            نمایش {{ $menus->firstItem() }} تا {{ $menus->lastItem() }} از {{ $menus->total() }} مورد
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
                           @if(count($selected)===$menus->total()) checked
                           @endif wire:click.lazy="toggleSelectAll">
                </th>
                <th class="text-center whitespace-no-wrap">
                    <a wire:click.prevent="sortBy('id')" role="button" href="javascript:void(0)">
                        شناسه
                        @include('admin.layouts.livewire_sort_icon', ['field' => 'id'])
                    </a>
                </th>

                <th class="text-center whitespace-no-wrap">
                    <a wire:click.prevent="sortBy('name')" role="button" href="javascript:void(0)">
                        عنوان
                        @include('admin.layouts.livewire_sort_icon', ['field' => 'name'])
                    </a>
                </th>

                <th class="text-center whitespace-no-wrap">
                    <a wire:click.prevent="sortBy('slug')" role="button" href="javascript:void(0)">
                        نام نمایشی
                        @include('admin.layouts.livewire_sort_icon', ['field' => 'slug'])
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
            @forelse($menus as $menu)

                <tr class="intro-x">
                    <td>
                        <input type="checkbox" class="form-check-input mr-2" wire:model="selected"
                               value="{{ $menu->id }}">

                    </td>
                    <td class="text-center w-5">{{$menu->id}}</td>
                    <td class="text-center">{{$menu->name}}</td>
                    <td class="text-center">{{$menu->slug}}</td>
                    <td class="text-center">
                        {{ $menu->status_name }}
                    </td>
                    <td class="text-center">{{ $menu->created_at_human}}</td>

                    {{-- <td class="text-center">{{ verta($menu->last_login_at)->formatDifference()  }}</td> --}}
                    <td class="table-report__action w-50 text-center">
                        <a style="margin: 5px;"
                           href="{{route('admin.sub_menus.index',$menu->slug)}}">
                            <i class="fas fa-sitemap"></i>
                        </a>

                        <a style="margin: 5px;" href="{{route('admin.menus.update',$menu->slug)}}">
                            <i class="fa-regular fa-pen-to-square"></i>

                        </a>
                        <a style="margin: 5px;"
                           href="javascript:void(0)"
                           wire:click="destroy({{$menu->id}})"
                            {{--                           href="{{route('admin.menus.delete',$menu->id)}}"--}}
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
            {{ $menus->links('admin.layouts.livewire_pagination') }}
        </div>

        @include('core::livewire.layouts.paginate_numbers')
    </div>

</div>

