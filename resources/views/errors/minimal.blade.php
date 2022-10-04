@extends ('site.layouts.master')

@section('content')
    <div class="error_page_bg">
        <div class="container">
            <div class="error_section">
                <div class="row">
                    <div class="col-12">
                        <div class="error_form">
                            <h1> @yield('code')</h1>
                            <h2> @yield('message')</h2>
                            <a href="/">بازگشت به صفحه خانه</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
