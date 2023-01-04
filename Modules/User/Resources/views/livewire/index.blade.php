<div>
    @include('admin.layouts.livewire_loading')

    <div class="intro-y col-span-12 flex flex-wrap sm:flex-no-wrap items-center mt-2 ltr">
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary shadow-md mr-2">کاربر جدید</a>
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
            نمایش {{ $users->firstItem() }} تا {{ $users->lastItem() }} از {{ $users->total() }} مورد
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
                           @if(count($selected)===$users->total()) checked @endif wire:click.lazy="toggleSelectAll">
                    {{-- <input type="checkbox"  class="form-checkbox mt-1 h-4 w-4 text-blue-600 transition duration-150 ease-in-out" /> --}}

                </th>
                <th class="text-center whitespace-no-wrap">
                    <a wire:click.prevent="sortBy('id')" role="button" href="javascript:void(0)">
                        شناسه
                        @include('admin.layouts.livewire_sort_icon', ['field' => 'id'])
                    </a>
                </th>

                {{--                    <th class="text-center whitespace-no-wrap">--}}
                {{--                        <a wire:click.prevent="sortBy('name')" role="button" href="javascript:void(0)">--}}
                {{--                            نام و نام خانوادگی--}}
                {{--                            @include('admin.layouts.livewire_sort_icon', ['field' => 'name'])--}}
                {{--                        </a>--}}
                {{--                    </th>--}}

                <th class="text-center whitespace-no-wrap">
                    <a wire:click.prevent="sortBy('first_name')" role="button" href="javascript:void(0)">
                        نام
                        @include('admin.layouts.livewire_sort_icon', ['field' => 'first_name'])
                    </a>
                </th>

                <th class="text-center whitespace-no-wrap">
                    <a wire:click.prevent="sortBy('last_name')" role="button" href="javascript:void(0)">
                        نام خانوادگی
                        @include('admin.layouts.livewire_sort_icon', ['field' => 'last_name'])
                    </a>
                </th>

                <th class="text-center whitespace-no-wrap">
                    <a wire:click.prevent="sortBy('mobile')" role="button" href="javascript:void(0)">
                        تلفن همراه
                        @include('admin.layouts.livewire_sort_icon', ['field' => 'mobile'])
                    </a>
                </th>

                <th class="text-center whitespace-no-wrap">
                    {{-- <a wire:click.prevent="sortBy('role_name')" role="button" href="javascript:void(0)"> --}}
                    نقش کاربر
                    {{-- @include('admin.layouts.livewire_sort_icon', ['field' => 'role_name']) --}}
                    {{-- </a> --}}
                </th>

                {{--                    <th class="text-center whitespace-no-wrap">--}}
                {{--                        پلن--}}
                {{--                    </th>--}}

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
                    <a wire:click.prevent="sortBy('last_login_at')" role="button" href="javascript:void(0)">
                        آخرین ورود
                        @include('admin.layouts.livewire_sort_icon', ['field' => 'last_login_at'])
                    </a>
                </th>
                <th class="text-center whitespace-no-wrap">
                    گزینه ها
                </th>
            </tr>
            </thead>
            <tbody>
            @forelse ($users as $user)

                <tr class="intro-x">
                    <td>
                        <input type="checkbox" class="form-check-input mr-2" wire:model="selected"
                               value="{{ $user->id }}">

                    </td>
                    <td class="text-center w-5">{{$user->id}}</td>
                    <td class="text-center">{{$user->first_name}}</td>
                    <td class="text-center">{{$user->last_name}}</td>
                    {{--                        <td class="text-center">{{$user->name}}</td>--}}
                    <td class="text-center">{{$user->mobile}}</td>
                    <td class="text-center">{{$user->roles->pluck('title')->implode(', ')}}</td>
                    {{--                        <td class="text-center">{{$user->getPlan()->name ?? '-'}}</td>--}}
                    <td class="text-center">
                        {{ $user->status_name }}
                    </td>
                    <td class="text-center">{{ $user->created_at_human}}</td>

                    <td class="text-center">{{ $user->last_login_at ? verta($user->last_login_at)->formatDifference()  : '-' }}</td>
                    <td class="table-report__action w-50 text-center">
                        <a href="{{route('admin.users.show',$user->id)}}" style="margin: 5px;">
                            <i class="fa-regular fa-eye"></i>
                        </a>
                        <a style="margin: 5px;" href="{{route('admin.users.update',$user->id)}}">
                            <i class="fa-regular fa-pen-to-square"></i>

                        </a>
                        <a style="margin: 5px;"
                           href="javascript:void(0)"
                           wire:click="destroy('{{$user->id}}')"
                            {{--                           href="{{route('admin.users.delete',$user->id)}}"--}}
                        >
                            <i class="fa-regular fa-trash-alt"></i>
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
    <div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center">

        <div class="form-inline ml-auto">
            {{ $users->links('admin.layouts.livewire_pagination') }}
        </div>

        @include('core::livewire.layouts.paginate_numbers')
    </div>
    <!-- END: Pagination -->
</div>
