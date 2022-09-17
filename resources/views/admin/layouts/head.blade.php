<head>

    @include ('general.head')

    {!! Meta::toHtml() !!}

    <meta name="robots" content="noindex, nofollow">
    <meta name="theme-color" content="#85D16A">

    {{--    <link type="text/css" rel="stylesheet" href="/css/admin.css">--}}
    <link type="text/css" rel="stylesheet" href="/css/admin/styles.css">

    @stack('head')

    @stack('styles')


{{--    <link type="text/css" rel="stylesheet" href="/css/icons.css">--}}


{{--    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-R3QzTxyukP03CMqKFe0ssp5wUvBPEyy9ZspCB+Y01fEjhMwcXixTyeot+S40+AjZ" crossorigin="anonymous"/>--}}
{{--    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/fontawesome.css" integrity="sha384-eHoocPgXsiuZh+Yy6+7DsKAerLXyJmu2Hadh4QYyt+8v86geixVYwFqUvMU8X90l" crossorigin="anonymous"/>--}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

</head>
