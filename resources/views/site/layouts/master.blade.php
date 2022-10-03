<!DOCTYPE html>
<html lang="{{ session()->get('locale','fa') }}" dir="rtl" class="rtl">

<head>

    @include ('general.head')

    {!! Meta::toHtml() !!}


    <meta name="theme-color" content="#c40316">

    <link href="/css/plugins.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">

    @stack('head')

    @stack('styles')


</head>
<body>
    @include('general.body')

    <div id="main-wrapper">


        @livewire('site.layouts.header')

{{--        @include('site.layouts.errors')--}}

        @yield('content')

        @include('site.layouts.footer')

    </div>

    <script src="/js/plugins.js"></script>

    <script src="/js/main.js"></script>

    @include('general.scripts')

    @stack('scripts')

</body>

</html>
