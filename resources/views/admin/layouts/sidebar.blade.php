<nav class="side-nav">
    <a class="intro-x text-center flex items-center pl-5 pt-4" href="{{route('site.index')}}">
        <img class="ml-1 text-center" src="/uploads/logo-text-white.png">
    </a>
    <div class="side-nav__devider my-6"></div>
    <ul>

        @foreach(menu('admin-menu') as $sub_menu)

            @if ($sub_menu->children()->count() > 0)
                <li>
                    <a href="#" class="side-menu">
                        <div class="side-menu__icon"> <i class="{{$sub_menu->icon}}"></i> </div>
                        <div class="side-menu__title">
                            {{$sub_menu->name}}
                            <div class="side-menu__sub-icon "> <i data-feather="chevron-down"></i> </div>
                        </div>
                    </a>
                    <ul class="">
                        @foreach($sub_menu->children()->where('status',1)->orderBy('sort_id','asc')->get() as $child_menu)

                            <li>
                                <a href="{{ $child_menu->link }}" class="side-menu">
                                    <div class="side-menu__icon"> <i class="{{$child_menu->icon}}"></i> </div>
                                    <div class="side-menu__title"> {{$child_menu->name}} </div>
                                </a>
                            </li>

                        @endforeach
                    </ul>
                </li>

            @elseif ($sub_menu->is_parent)
                <li>
                    <a href="{{ $sub_menu->link ?? '#'}}" class="side-menu">
                        <div class="side-menu__icon"> <i class="{{$sub_menu->icon}}"></i> </div>
                        <div class="side-menu__title"> {{$sub_menu->name}} </div>
                    </a>
                </li>

            @endif


        @endforeach
    </ul>
</nav>
