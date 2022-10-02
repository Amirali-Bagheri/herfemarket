<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, shrink-to-fit=no">
<meta name="robots" content="index, follow"/>
<meta http-equiv="x-ua-compatible" content="ie=edge">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="mobile-web-app-capable" content="yes">
<meta name="application-name" content="{{setting('site_name')}}">
{{-- <meta property="og:title" content="{{setting('site_name')}} - @yield('title') " /> --}}
{{-- <meta property="og:site_name" content="{{setting('site_name')}}" /> --}}
<meta name="description" content="{{setting('seo_meta_description')}}">
<meta name="keywords" content="{{setting('seo_meta_keywords')}}">

<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="apple-mobile-web-app-title" content="{{setting('site_name')}}">
<link rel="apple-touch-icon" sizes="180x180" href="/uploads/apple-icon-180x180.png">
<link rel="mask-icon" href="/uploads/safari-pinned-tab.svg" color="#5bbad5">

<link rel="icon" type="image/png" sizes="32x32" href="/uploads/favicon-16x16.png">
<link rel="icon" type="image/png" sizes="16x16" href="/uploads/favicon-32x32.png">
<link rel="icon" sizes="512x512" href="/uploads/ms-icon-310x310.png">
<meta name="msapplication-TileImage" content="/uploads/ms-icon-310x310.png">

<meta name="msapplication-TileColor" content="#222961">
<meta name="theme-color" content="#222961">
<link rel="manifest" href="/manifest.json" crossorigin="use-credentials">
<link rel="icon" href="/favicon.ico" type="image/x-icon"/>
<link rel="canonical" href="https://yekilink.com/"/>
<meta name="google-signin-client_id" content="{{env('GOOGLE_CLIENT_ID')}}">
<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

@livewireStyles


@if(isset($pageTitle))
    <title>{{ setting('site_name') . ' - ' . $pageTitle }}</title>
@else
    <title>{{ setting('site_name') . ' - ' }}  @yield('pageTitle') </title>
@endif


{{--<link type="text/css" href="/css/icons.css" rel="stylesheet">--}}
<link type="text/css" href="/icons/fontawesome6/css/fontawesome.min.css" rel="stylesheet">
<link type="text/css" href="/icons/fontawesome6/css/all.min.css" rel="stylesheet">
{{--<link type="text/css" href="/icons/fontawesome6/css/regular.min.css" rel="stylesheet">--}}
{{--<link type="text/css" href="/icons/fontawesome6/css/solid.min.css" rel="stylesheet">--}}
{{--<link type="text/css" href="/icons/fontawesome6/css/light.min.css" rel="stylesheet">--}}
{{--<link type="text/css" href="/icons/fontawesome6/css/brands.min.css" rel="stylesheet">--}}
{{--<link type="text/css" href="/icons/fontawesome6/css/v4-shims.min.css" rel="stylesheet">--}}

<link rel="preload" as="style" href="/css/fonts.css" onload="this.rel='stylesheet'"/>

<link rel="preload" href="/fonts/IRANSansWeb.eot" as="font" crossorigin="anonymous">


<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

