<div>
    @include('admin.layouts.livewire_loading')
    <div class="col-span-12 xxl:col-span-12 grid grid-cols-12 gap-6">

        <div class="col-span-12 xxl:col-span-9 grid grid-cols-12 gap-6 mt-2">

            <div class="col-span-12">
                <div class="grid grid-cols-12 gap-6">
                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <a href="{{ route('admin.comments.index') }}">
                            <div class="report-box zoom-in">
                                <div class="box p-5">
                                    <div class="flex">
                                        <i class="report-box__icon text-theme-11" data-feather="message-circle"></i>
                                    </div>
                                    <div
                                        class="text-3xl font-bold leading-8 mt-6">{{\Modules\Comments\Entities\Comment::pending()->count() ?? 0}}</div>
                                    <div class="text-base text-gray-600 mt-1">دیدگاه های بررسی نشده</div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <a href="{{route('admin.users.index')}}">
                            <div class="report-box zoom-in">
                                <div class="box p-5">
                                    <div class="flex">
                                        <i class="report-box__icon text-theme-12" data-feather="users"></i>
                                    </div>
                                    <div
                                        class="text-3xl font-bold leading-8 mt-6">{{\Modules\User\Entities\User::count() ?? 0}}</div>
                                    <div class="text-base text-gray-600 mt-1">کاربران</div>
                                </div>
                            </div>
                        </a>

                    </div>
                </div>
                <div class="col-12 mt-2 text-center justify-content-center" wire:ignore>
                    <button class="btn btn-primary mr-2 mb-2" wire:click.prevent="toolboxAction('octane_reload')">
                        <i data-feather="activity" class="w-4 h-4 ml-2"></i> Octane Reload
                    </button>
                    <button class="btn btn-success mr-2 mb-2" wire:click.prevent="toolboxAction('queue_clear')">
                        <i data-feather="calendar" class="w-4 h-4 ml-2"></i> Queue Clear
                    </button>
                    <button class="btn btn-danger mr-2 mb-2" wire:click.prevent="toolboxAction('cache_clear')">
                        <i data-feather="trash" class="w-4 h-4 ml-2"></i> Cache Clear
                    </button>
                    <button class="btn btn-dark mr-2 mb-2" wire:click.prevent="toolboxAction('maintenance')">
                        <i data-feather="alert-triangle" class="w-4 h-4 ml-2"></i> Maintenance
                    </button>

                </div>

            </div>

            <div class="col-span-12 xl:col-span-4">
                <div class="intro-x flex items-center h-10">
                    <h1 class="text-lg font-medium truncate mr-5">
                        جدید ترین کسب و کار ها
                    </h1>
                </div>
                <div class="mt-2">
                    @if (\Modules\Business\Entities\Business::count() > 0)
                        @foreach(\Modules\Business\Entities\Business::latest()->get()->take(20) as $business)
                            <div class="intro-x">
                                <a href="{{route('admin.businesses.update',$business->id)}}">
                                    <div class="box px-5 py-3 mb-3 flex items-center zoom-in">
                                        <div class="w-10 h-10 flex-none image-fit rounded-full overflow-hidden">
                                            <img
                                                src="/uploads/logos/{{$business->logo}}">
                                        </div>
                                        <div class="mr-4 ml-auto ">
                                            <div class="font-medium">{{$business->name}}</div>
                                            <div class="text-gray-600 text-xs">
                                                {{ verta($business->created_at)->formatDifference() }}
                                            </div>
                                        </div>
                                        <div class="text-theme-1">
                                            {{ $business->status_name }}

                                            {{--                                            @if ($business->latest_crawled_products_count > 0)--}}
                                            {{--                                                <span class="badge badge-danger">--}}
                                            {{--                                                    ( {{$business->latest_crawled_products_count }}  محصول جدید )--}}
                                            {{--                                            </span>--}}
                                            {{--                                            @endif--}}
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                        <a href="{{route('admin.businesses.index')}}"
                           class="intro-x w-full block text-center rounded-md py-3 border border-dotted border-theme-15 dark:border-dark-5 text-theme-16 dark:text-gray-600">مشاهده
                            بیشتر</a>
                    @else
                        <p class="text-center">
                            موردی برای نمایش وجود ندارد
                        </p>
                    @endif

                </div>
            </div>

            <div class="col-span-12 xl:col-span-4">
                <div class="intro-x flex items-center h-10">
                    <h2 class="text-lg font-medium truncate mr-5">
                        کاربران جدید
                    </h2>
                </div>
                <div class="mt-5">
                    @if (\Modules\User\Entities\User::count() > 0)
                        @foreach(\Modules\User\Entities\User::latest()->get()->take(5) as $user)
                            <a href="{{route('admin.users.update',$user->id)}}" target="_blank">
                                <div class="intro-x">
                                    <div class="box px-5 py-3 mb-3 flex items-center zoom-in">
                                        <div class="w-10 h-10 flex-none image-fit rounded-full overflow-hidden">
                                            <img
                                                src="/uploads/avatars/{{$user->avatar}}">
                                        </div>
                                        <div class="mr-4 ml-auto">
                                            <div class="font-medium">{{$user->full_name}}</div>
                                            <div class="text-gray-600 text-xs">
                                                {{ verta($user->created_at)->formatDifference() }}
                                            </div>
                                        </div>
                                        <div class="text-theme-1">
                                            {{ $user->status_name }}
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                        <a href="{{route('admin.users.index')}}"
                           class="intro-x w-full block text-center rounded-md py-3 border border-dotted border-theme-15 dark:border-dark-5 text-theme-16 dark:text-gray-600">مشاهده
                            بیشتر</a>
                    @else
                        <p class="text-center">
                            موردی برای نمایش وجود ندارد
                        </p>
                    @endif

                </div>

                <div class="intro-x flex items-center h-10">
                    <h2 class="text-lg font-medium truncate mr-5">
                        آخرین ورود کاربران
                    </h2>
                </div>
                <div class="mt-5">
                    @if (\Modules\User\Entities\User::count() > 0)
                        @foreach(\Modules\User\Entities\User::orderBy('last_login_at','desc')->get()->take(5) as $user)
                            <a href="{{route('admin.users.update',$user->id)}}" target="_blank">
                                <div class="intro-x">
                                    <div class="box px-5 py-3 mb-3 flex items-center zoom-in">
                                        <div class="w-10 h-10 flex-none image-fit rounded-full overflow-hidden">
                                            <img
                                                src="/uploads/avatars/{{$user->avatar}}">
                                        </div>
                                        <div class="mr-4 ml-auto">
                                            <div class="font-medium">{{$user->full_name}}</div>
                                            <div class="text-gray-600 text-xs">
                                                {{ isset($user->last_login_at) ? verta($user->last_login_at)->formatDifference() : '-' }}
                                            </div>
                                        </div>
                                        <div class="text-theme-1">
                                            {{ $user->status_name }}
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                        <a href="{{route('admin.users.index')}}"
                           class="intro-x w-full block text-center rounded-md py-3 border border-dotted border-theme-15 dark:border-dark-5 text-theme-16 dark:text-gray-600">مشاهده
                            بیشتر</a>
                    @else
                        <p class="text-center">
                            موردی برای نمایش وجود ندارد
                        </p>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
