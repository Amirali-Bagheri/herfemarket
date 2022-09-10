@include('dashboard.layouts.head')
<body>
    @include('dashboard.layouts.errors')

    <div class="authincation h-100">
        <div class="container h-100">
            <div class="row justify-content-center align-items-center">
                <div class="col-xl-6 col-md-8 col-sm-12 col-12">
                    <div class="authincation-content">
                        @include('dashboard.layouts.errors')

                        @yield('content')

                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('dashboard.layouts.scripts')

</body>
