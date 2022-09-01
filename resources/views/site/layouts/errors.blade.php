
@if(\Illuminate\Support\Facades\Session::has('error') or \Illuminate\Support\Facades\Session::has('error'))

    <script>
        Swal.fire({
            icon: 'error',
            title: '!خطا',
            showCancelButton: false,
            timer: 3500,
            showConfirmButton: false,
            text: '{{ \Illuminate\Support\Facades\Session::get('error') }}',
        });
    </script>

@endif
@if(\Illuminate\Support\Facades\Session::has('success') or \Illuminate\Support\Facades\Session::has('success'))

    <script>
        Swal.fire({
            icon: 'success',
            showCancelButton: false,
            showConfirmButton: false,
            timer: 3500,
            title: 'انجام شد!',
            text: '{{ \Illuminate\Support\Facades\Session::get('success') }}',
        });

    </script>

@endif
@if(\Illuminate\Support\Facades\Session::has('info'))

    <script>
        Swal.fire({
            icon: 'info',
            showCancelButton: false,
            showConfirmButton: false,
            timer: 3500,
            title: 'توجه!',
            text: '{{ \Illuminate\Support\Facades\Session::get('info') }}',
        });

    </script>

@endif
