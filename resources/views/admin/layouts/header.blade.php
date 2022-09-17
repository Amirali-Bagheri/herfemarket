<div>
{{--    @include('admin.layouts.livewire_loading')--}}

{{--    <header>--}}
<!-- BEGIN: Top Bar -->
    <div class="top-bar">
        <div class="-intro-x breadcrumb ml-auto hidden sm:flex">
            <a class="" href="{{ route('dashboard.index') }}">داشبورد</a>
            <i class="breadcrumb__icon" data-feather="chevron-left"></i>
            <a class="breadcrumb--active" href="{{ url()->current() }}">
                @if(isset($pageTitle))
                    {{ $pageTitle }}
                @else
                    @yield('pageTitle')
                @endif
            </a>
        </div>

        <div class="intro-x dropdown ml-auto sm:ml-6">
            <div class="cursor-pointer">
                <div class="dark-mode-switcher" wire:ignore>
                    <a title="حالت تاریک یا روشن" href="#" wire:click="changeThemeDark">

                        @if (session('isDark'))

                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z">
                                </path>
                            </svg>

                        @else
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z">
                                </path>
                            </svg>
                        @endif
                    </a>

                    {{-- <div class="dark-mode-switcher__toggle border"></div>--}}
                </div>
                {{-- <i class="notification__icon dark:text-gray-300" data-feather="bell"></i>--}}
            </div>
        </div>
        <div class="intro-x dropdown ml-auto sm:ml-6">
            <div wire:ignore class="dropdown-toggle notification {{ (isset($notifications) and count($notifications) > 0) ? 'notification--bullet' : ''}}  cursor-pointer" role="button" aria-expanded="false">
                <i class="far fa-xl fa-bell notification__icon dark:text-gray-300"></i>
            </div>
            <div class="notification-content pt-2 dropdown-menu">
                <div class="notification-content__box dropdown-menu__content box dark:bg-dark-6">
                    <div class="notification-content__title">اعلان ها</div>
                    @if (isset($notifications) and count($notifications) > 0)
                        @foreach($notifications as $notification)

                            <a href="#" title="{{$notification->data['message']}}" wire:click="readNotification('{{$notification->id}}')">
                                <div class="cursor-pointer relative flex items-center mt-2">
                                    <div class="flex-none image-fit ml-3">
                                        <i class="{{ $notification->data['icon'] }} fa-1x mr-2"></i>
                                        <div
                                            class="w-3 h-3 bg-theme-9 absolute right-0 bottom-0 rounded-full border-2 border-white">
                                        </div>

                                    </div>
                                    <div class="ml-2 overflow-hidden">
                                        <div class="w-full text-sm font-small truncate text-gray-600">
                                            {{ $notification->data['message'] }}
                                        </div>
                                        <div class="flex items-center">
                                            <div
                                                class="text-xs font-small text-gray-500 ml-auto whitespace-no-wrap">
                                                {{ verta($notification->updated_at)->formatDifference() }}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </a>

                            <br>
                            @if (!$loop->last)
                                <hr>
                            @endif



                        @endforeach

                        <hr>
                        <div class="items-center text-center mt-3">
                            <a class="text-center" href="#" wire:click="markNotifications">علامت
                                گذاری
                                همه به عنوان خوانده
                                شده</a>
                        </div>
                    @else
                        <div class="text-center">
                            <p>اعلان جدیدی دریافت نشده است</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="intro-x dropdown w-8 h-8">
            <div class="dropdown-toggle w-8 h-8 rounded-full overflow-hidden shadow-lg image-fit zoom-in" role="button"
                 aria-expanded="false">
                <img src="{{ Auth::user()->avatar_url }}">
            </div>
            <div class="dropdown-menu w-56">
                <div class="dropdown-menu__content box bg-theme-26 dark:bg-dark-6 text-white">
                    <div class="p-4 border-b border-theme-27 dark:border-dark-3">
                        <div class="font-medium">{{ Auth::user()->full_name ?? '-' }}</div>
                        <div
                            class="text-xs text-theme-28 mt-0.5 dark:text-gray-600">{{ Auth::user()->roles->pluck('title')->implode(' , ') }}</div>
                    </div>
                    <div class="p-2">
                        <a href="{{route('dashboard.index')}}"
                           class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 dark:hover:bg-dark-3 rounded-md">
                            <i data-feather="user" class="w-4 h-4 ml-2"></i> پروفایل
                        </a>
                    </div>
                    <div class="p-2 border-t border-theme-27 dark:border-dark-3">
                        <a href="#" wire:click="logout"
                           class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 dark:hover:bg-dark-3 rounded-md">
                            <i data-feather="toggle-right" class="w-4 h-4 ml-2"></i> خروج از حساب
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{--    </header>--}}
    </div>
</div>

@push('scripts')
    <script>
        window.addEventListener('refresh-page', event => {
            location.reload();
        })
    </script>
@endpush
