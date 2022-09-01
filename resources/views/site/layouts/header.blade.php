<div>
    <div class="topbar" id="top">
        <div class="header light">
            <div class="container po-relative">
                <nav class="navbar navbar-expand-lg header-nav-bar">
                    <a href="{{route('site.index')}}" class="navbar-brand">
                        @if(app()->getLocale() == 'fa')
                            <img src="/uploads/logo-text.png"
                                 alt="{{setting('site_name')}}">
                        @else
                            <img src="/uploads/logo-en.png"
                                 alt="{{setting('site_name')}}">
                        @endif
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation"
                            aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation"><span
                            class="ti-align-right"></span></button>
                    <div class="collapse navbar-collapse hover-dropdown font-14 mr-auto" id="navigation">
                        <ul class="navbar-nav mr-auto">
                            @foreach(menu('site-header-menu') as $sub_menu)

                                <li class="nav-item">
                                    @if (app()->getLocale() == 'fa')
                                        <a class="nav-link" target="{{$sub_menu->target ?? '_self'}}" href="{{ $sub_menu->link }}"
                                           title="{{$sub_menu->name ?? null}}">
                                            <i class="{{$sub_menu->icon}}"></i>
                                            {{$sub_menu->name}}
                                        </a>
                                    @else
                                        <a class="nav-link" target="{{$sub_menu->target ?? '_self'}}" href="{{ $sub_menu->link }}"
                                           title="{{$sub_menu->en_name ?? null}}">
                                            <i class="{{$sub_menu->icon}}"></i>
                                            {{$sub_menu->en_name}}
                                        </a>
                                    @endif
                                </li>

                            @endforeach

                        </ul>

                        <div class="act-buttons">
                            <div class="btn-group mr-lg-2">
                                <div class="dropdown show">
                                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
                                       aria-haspopup="true" aria-expanded="false">
                                        {{ str(app()->getLocale())->upper() }}
                                    </a>

                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        @foreach (config('app.locales') as $locale)
                                            <a class="dropdown-item" href="#" wire:click="setLocale('{{$locale}}')">
                                                {{ str($locale)->upper() }}
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <a class="btn btn-info font-14" href="{{route('login')}}">
                                {{ __("Start") }}
                            </a>
                        </div>

                    </div>
                </nav>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
</div>

@push('scripts')
    <script>
        window.addEventListener('refresh-page', event => {
            location.reload();
        });
    </script>
@endpush
