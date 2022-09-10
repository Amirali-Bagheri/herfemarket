@extends('site.layouts.master')
@section('title','تغییر رمز عبور')

@section('content')

<div class="text-center">
    <div class="section-full p-t80 p-b50 bg-orange-light">

        <div class="container">

            <div class="section-content text-right">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <!-- Card -->
                            <div class="card">

                                <!-- Card body -->
                                <div class="card-body text-center justify-content-center">
                                    @include('site.layouts.errors')

                                    <form method="post" action="{{ route('password.update') }}">
                                        @csrf
                                        <p class="h4 py-4">تغییر رمز عبور</p>
                                        <input type="hidden" name="token" value="{{ $token }}">
                                        <div class="form-group row">
                                            <label for="mobile" class="grey-text font-weight-light">
                                                شماره تلفن همراه:</label>
                                            <input type="text" id="mobile"
                                                class="form-control text-center justify-content-center mb-4 @error('mobile') is-invalid @enderror"
                                                value="{{ old('mobile') }}" name="mobile">

                                            @error('mobile')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group row">
                                            <label for="password" class="grey-text font-weight-light">
                                                رمز عبور جدید:</label>
                                            <input type="password" id="password"
                                                class="form-control text-center justify-content-center mb-4 @error('password') is-invalid @enderror"
                                                value="{{ old('password') }}" name="password">

                                            @error('password')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group row">
                                            <label for="password_confirmation" class="grey-text font-weight-light">
                                                رمز عبور جدید:</label>
                                            <input type="password" id="password_confirmation"
                                                class="form-control text-center justify-content-center mb-4 @error('password_confirmation') is-invalid @enderror"
                                                value="{{ old('password_confirmation') }}" name="password_confirmation">

                                            @error('password_confirmation')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>



                                        <div class="text-center py-4 mt-3">
                                            <button class="btn btn-outline-purple" type="submit"> تغییر رمز
                                            </button>
                                        </div>
                                    </form>
                                    <!-- Default form subscription -->

                                </div>
                                <!-- Card body -->

                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center"></div>

                <div class="card-body">

                    @include('site.layouts.errors')

                    <form method="POST" action="{{ route('password.update') }}">
@csrf

<input type="hidden" name="token" value="{{ $token }}">

<div class="form-group row">
    <label for="mobile" class="col-md-4 col-form-label text-md-right">{{ __('تلفن همراه') }}</label>

    <div class="col-md-6">
        <input id="mobile" type="text" class="form-control @error('mobile') is-invalid @enderror" name="mobile"
            value="{{ $mobile ?? old('mobile') }}" required autocomplete="mobile" autofocus>

        @error('mobile')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('رمز عبور') }}</label>

    <div class="col-md-6">
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
            name="password" required autocomplete="new-password">

        @error('password')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('تایید رمز عبور') }}</label>

    <div class="col-md-6">
        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required
            autocomplete="new-password">
    </div>
</div>

<div class="form-group row mb-0">
    <div class="col-md-6 offset-md-4">
        <button type="submit" class="btn btn-primary">
            {{ __('تغییر رمز عبور') }}
        </button>
    </div>
</div>
</form>
</div>
</div>
</div>
</div>
</div> --}}


@endsection