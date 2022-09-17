{{--<errors inline-template>--}}


    @if(\Illuminate\Support\Facades\Session::has('success'))


{{--            <script style="direction: rtl; text-align: right;">--}}
{{--                Swal.fire({--}}
{{--                    position: 'top-center',--}}
{{--                    type: 'success',--}}
{{--                    title: '{{\Illuminate\Support\Facades\Session::get('success')}}',--}}
{{--                    showConfirmButton: false,--}}
{{--                    timer: 1500--}}
{{--                })--}}
{{--            </script>--}}
        <div class="alert alert-success alert-dismissible text-right rtl">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fa fa-check"></i>{{ \Illuminate\Support\Facades\Session::get('success') }}</h5>

        </div>

    @endif
    @if(\Illuminate\Support\Facades\Session::has('error'))

{{--        --}}{{--    <script style="direction: rtl; text-align: right;">--}}
{{--        --}}{{--        Swal.fire({--}}
{{--        --}}{{--            position: 'top-center',--}}
{{--        --}}{{--            type: 'error',--}}
{{--        --}}{{--            title: '{{\Illuminate\Support\Facades\Session::get('error')}}',--}}
{{--        --}}{{--            showConfirmButton: false,--}}
{{--        --}}{{--            timer: 1500--}}
{{--        --}}{{--        })--}}
{{--        --}}{{--    </script>--}}

        <div class="alert alert-danger alert-dismissible text-right rtl">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-times"></i> {{ \Illuminate\Support\Facades\Session::get('error') }}  </h5>
        </div>
    @endif
    {{--@if(count($errors) > 0)--}}
    {{--    <div class="alert alert-danger alert-dismissible" style="direction: rtl;text-align: right;">--}}
    {{--        <button type="button" class="close pull-left" data-dismiss="alert" aria-hidden="true">&times;</button>--}}
    {{--        <h4><i class="icon fa fa-ban"></i>عملیات با خطا روبه رو شد</h4>--}}
    {{--        @foreach($errors->all() as $error)--}}
    {{--

      <li>{{ $error }}</li>--}}
    {{--        @endforeach--}}
    {{--    </div>--}}

    {{--@endif--}}


    {{--@if (session('status'))--}}

    {{--    <div class="alert alert-success" style="direction: rtl;text-align: right;">--}}
    {{--        {{ session('status') }}--}}
    {{--    </div>--}}
    {{--@endif--}}
    {{--@if (session('warning'))--}}
    {{--    <div class="alert alert-warning" style="direction: rtl;text-align: right;">--}}
    {{--        {{ session('warning') }}--}}
    {{--    </div>--}}
    {{--@endif--}}

{{--    @foreach(auth()->user()->unreadNotifications as $notification)--}}

{{--        <div class="alert alert-info alert-dismissible text-right rtl">--}}
{{--            <a href="{{ route('admin.notifications.markRead',$notification->id) }}" class="close"--}}
{{--               style="text-decoration: none;"--}}
{{--               id="mark-all">--}}
{{--                ×--}}
{{--            </a>--}}
{{--            --}}{{--            <button type="button" class="close"--}}
{{--            --}}{{--                    data-dismiss="alert"--}}
{{--            --}}{{--                    aria-hidden="true">×--}}
{{--            --}}{{--            </button>--}}

{{--            <a href="{{$notification->data['link']}}" style="float: right; text-decoration: none;">--}}
{{--                <p class="color-black">--}}
{{--                    <i class="{{ $notification->data['icon'] }}"></i> {{ $notification->data['message'] }}--}}
{{--                </p>--}}
{{--            </a>--}}

{{--            @if($loop->last)--}}
{{--                <a href="{{ route('admin.notifications.markAllRead') }}" class="badge badge-warning"--}}
{{--                   style="float: left; text-decoration: none;">--}}
{{--                    علامت گذاری همه به عنوان خوانده شده--}}
{{--                </a>--}}
{{--            @endif--}}

{{--            <br>--}}
{{--        </div>--}}

{{--    @endforeach--}}
    {{--{{ auth()->user()->unreadNotifications->count() }}--}}

    {{--<a href="{{ route('mark') }}">Mark All</a>--}}
    {{--@foreach(auth()->user()->unreadNotifications as $notification)--}}

    {{--    {{ $notification->data['data'] }}--}}

    {{--@endforeach--}}
    {{--@foreach(auth()->user()->readNotifications as $read)--}}

    {{--    {{ $read->data['data'] }}--}}

    {{--@endforeach--}}
{{--</errors>--}}
@if(\Illuminate\Support\Facades\Session::has('error'))

    <script>
        Swal.fire({
            icon: 'error',
            title: '!خطا',
            text: '{{ \Illuminate\Support\Facades\Session::get('error') }}',
        })
    </script>

@endif
@if(\Illuminate\Support\Facades\Session::has('success'))

    <script>
        Swal.fire({
            icon: 'success',
            title: 'انجام شد!',
            text: '{{ \Illuminate\Support\Facades\Session::get('success') }}',
        })

    </script>

@endif
@if(\Illuminate\Support\Facades\Session::has('info'))

    <script>
        Swal.fire({
            icon: 'info',
            title: 'توجه!',
            text: '{{ \Illuminate\Support\Facades\Session::get('info') }}',
        })

    </script>

@endif
