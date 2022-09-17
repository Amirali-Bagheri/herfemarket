<!DOCTYPE html>
<html dir="rtl" lang="fa" class="{{ session('isDark') ? 'dark' : 'light' }}" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('admin.layouts.head')


<body class="app">

    <div class="mobile-menu md:hidden">
        <div class="mobile-menu-bar">
            <a class="flex ml-auto" href="/admin">
                <img class="w-6" src="/uploads/adminlogo.png">
            </a>
            <a href="javascript:" id="mobile-menu-toggler"> <i class="w-8 h-8 text-white transform -rotate-90"
                                                               data-feather="bar-chart-2"></i> </a>
        </div>

        <ul class="border-t border-theme-24 py-5 hidden rtl text-right">
            @foreach(menu('admin-menu') as $sub_menu)

                @if ($sub_menu->children()->count() > 0)

                    <li>
                        <a href="{{$sub_menu->link}}" class="menu">
                            <div class="menu__icon"><i class="{{$sub_menu->icon}}"></i></div>
                            <div class="menu__title">{{$sub_menu->name}}
                                <i class="far fa-angle-right right mr-2"></i>
                            </div>
                        </a>
                        <ul>
                            @foreach($sub_menu->children()->orderBy('sort_id','asc')->get() as $child_menu)
                                <li class="mr-5">
                                    <a href="{{ $child_menu->link }}" class="menu">
                                        <div class="menu__icon"><i class="{{$child_menu->icon}}"></i></div>
                                        <div class="menu__title">{{$child_menu->name}}</div>
                                    </a>
                                </li>
                            @endforeach

                        </ul>
                    </li>
                @elseif ($sub_menu->is_parent)
                    <li>
                        <a class="menu" href="{{ $sub_menu->link }}">
                            <div class="menu__icon"><i class="{{$sub_menu->icon}}"></i></div>
                            <div class="menu__title">{{$sub_menu->name}}</div>
                        </a>
                    </li>

                @endif


            @endforeach

        </ul>
    </div>

    <div class="flex" id="admin">

        @include('admin.layouts.sidebar')

        <div class="content">

            @livewire('admin.layouts.header')

{{--            <div class="grid grid-cols-12 gap-6">--}}
            <div class="relative">

                {{--            <div wire:offline>--}}
                {{--                <script>--}}
                {{--                    Swal.fire({--}}
                {{--                        icon: 'error',--}}
                {{--                        title: 'خطا!',--}}
                {{--                        text: 'ازتباط با اینترنت برقرار نیست!',--}}
                {{--                        footer: '<a href="#" wire:click="$refresh">بررسی مجدد</a>'--}}
                {{--                    })--}}
                {{--                </script>--}}
                {{--            </div>--}}
                <div class="col-span-12 container mx-auto sm:px-4 max-w-full mx-auto sm:px-4 xxl:col-span-12">

                    @yield('content')

                </div>

            </div>

            @include('admin.layouts.footer')

        </div>

    </div>
    @include('admin.layouts.scripts')


</body>

</html>
