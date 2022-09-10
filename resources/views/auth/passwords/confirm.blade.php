@extends('site.layouts.master')

@section('content')
<div class="breadcrumb-area" style="background-image: url(/uploads/4.jpg);">
    <div class="container">
        <div class="breadcrumb-content">

        </div>
    </div>
</div>
<br>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('تایید رمز عبور') }}</div>

                <div class="card-body">
                    {{ __('لطفا رمز عبور جدید خود را وارد کنید') }}

                    <form method="POST" action="{{ route('password.confirm') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="password"
                                class="col-md-4 col-form-label text-md-right">{{ __('رمز عبور') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    required autocomplete="current-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('تایید رمز عبور') }}
                                </button>

                                @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your رمز عبور?') }}
                                </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
