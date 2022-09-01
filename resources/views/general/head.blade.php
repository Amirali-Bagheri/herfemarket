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

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-193141074-1"></script>
<script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {dataLayer.push(arguments);}

    gtag('js', new Date());

    gtag('config', 'UA-193141074-1');
</script>

<!-- Google Tag Manager -->
<script>(function (w, d, s, l, i) {
        w[l] = w[l] || [];
        w[l].push({
            'gtm.start':
                new Date().getTime(), event: 'gtm.js',
        });
        var f                          = d.getElementsByTagName(s)[0],
            j   = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : '';
        j.async = true;
        j.src   =
            'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
        f.parentNode.insertBefore(j, f);
    })(window, document, 'script', 'dataLayer', 'GTM-58D977S');</script>
<!-- End Google Tag Manager -->

<meta name="p:domain_verify" content="12c3ebfc47d536271f896142161b8a97"/>

{{--<script type="module">--}}
{{--    import 'https://cdn.jsdelivr.net/npm/@pwabuilder/pwaupdate';--}}
{{--    const el = document.createElement('pwa-update');--}}
{{--    document.body.appendChild(el);--}}
{{--</script>--}}

{{--<script--}}
{{--    type="module"--}}
{{--    src="https://cdn.jsdelivr.net/npm/@pwabuilder/pwainstall"--}}
{{--></script>--}}

<!-- Najva Push Notification -->
{{--<script type="text/javascript">--}}
{{--    (function(){--}}
{{--        var now = new Date();--}}
{{--        var version = now.getFullYear().toString() + "0" + now.getMonth() + "0" + now.getDate() +--}}
{{--            "0" + now.getHours();--}}
{{--        var head = document.getElementsByTagName("head")[0];--}}
{{--        var link = document.createElement("link");--}}
{{--        link.rel = "stylesheet";--}}
{{--        link.href = "https://app.najva.com/static/css/local-messaging.css" + "?v=" + version;--}}
{{--        head.appendChild(link);--}}
{{--        var script = document.createElement("script");--}}
{{--        script.type = "text/javascript";--}}
{{--        script.async = true;--}}
{{--        script.src = "https://app.najva.com/static/js/scripts/yekilink-website-37587-a02a4713-0bc6-4a9d-9e93-3a0f5d572edf.js" + "?v=" + version;--}}
{{--        head.appendChild(script);--}}
{{--    })()--}}
{{--</script>--}}
<!-- END NAJVA PUSH NOTIFICATION -->


{{--<!-- start webpushr code --> <script>(function(w,d, s, id) {if(typeof(w.webpushr)!=='undefined') return;w.webpushr=w.webpushr||function(){(w.webpushr.q=w.webpushr.q||[]).push(arguments)};var js, fjs = d.getElementsByTagName(s)[0];js = d.createElement(s); js.id = id;js.async=1;js.src = "https://cdn.webpushr.com/app.min.js";fjs.parentNode.appendChild(js);}(window,document, 'script', 'webpushr-jssdk'));webpushr('setup',{'key':'BM6j_OsEmwLXxflcO6Mic_wLtJ5WJWHvgqcg9WqFEoJ4dhlKCvScdEIUGvu-wDhMPSK-x4a8rncn5hwIJkZq5OM' });</script><!-- end webpushr code -->--}}
{{--<script async custom-element="amp-web-push" src="https://cdn.ampproject.org/v0/amp-web-push-0.1.js"></script>--}}
{{--@arcaptchaScript--}}
