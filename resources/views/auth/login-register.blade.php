<div>
    <br>
    <br>
    <div class="row no-gutters">
        <div class="col-xl-12">
            <div class="auth-form">
                <div class="text-center mb-3">
                    <a href="{{route('site.index')}}">
                        <img style="width: 60%" class="img-responsive img-fluid" src="/uploads/logo-text.png"
                                                           alt="">
                    </a>
                </div>

                <h4 class="text-center mb-4">ورود به حساب کاربری</h4>
                <form wire:submit.prevent="login">

                    <div class="form-group">
                        <label class="text-right float-left mb-1"><strong>نام کاربری</strong></label>
                        <input placeholder="نام کاربری" type="text" wire:model.defer="mobile" value="{{ old('mobile') }}" class="text-center form-control">
                        @error('mobile')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror

                    </div>
                    <div class="form-group">
                        <label class="text-right float-left mb-1"><strong>رمز عبور</strong></label>
                        <input class="text-center form-control" wire:model.defer="password" value="{{ old('password') }}"
                               type="password" placeholder="کلمه عبور">
                        @error('password')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-row d-flex justify-content-between mt-4 mb-2">
                        <div class="form-group">
                            <div class="custom-control custom-checkbox ml-1">
                                <input type="checkbox" class="custom-control-input" wire:model.defer="remember"
                                       id="remember" value="true">
                                <label class="custom-control-label" for="remember">مرا به خاطر بسپار</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <a href="{{route('password.request')}}">فراموشی رمز عبور</a>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary btn-block">ورود</button>
                    </div>
                </form>
                <div class="text-center">
{{--                    یا--}}
                    <br>
                    <div class="text-center justify-content-center d-flex">

                       <a href="#" wire:click="googleSignin">
                           <img width="32" class="mr-2" src="/uploads/logo/google.png">
                       </a>
                        <a href="#" wire:click="facebookSignin">
                           <img width="32" class="ml-2" src="/uploads/logo/facebook.png">
                       </a>
                    </div>

                </div>
                <div class="new-account mt-3 text-center">
                    <p>حساب کاربری ندارید؟ <a class="text-primary" href="{{route('register')}}">ثبت نام کنید</a></p>
                </div>

                <div class="text-center justify-content-center items-center mt-3">
                    <p>
                        با ورود و یا ثبت نام شما
                        <a href="/privacy">شرایط استفاده</a>
                        از خدمات ما و
                        <a href="/terms"> قوانین و حریم و خصوصی</a>
                        آن را می پذیرید
                    </p>
                </div>
            </div>
        </div>
    </div>

    {{--  <h2 class="intro-x text-black font-bold text-2xl xl:text-3xl text-center xl:text-left">
          ورود
      </h2>
      <div class="intro-x mt-8">

          <input type="text" wire:model.defer="mobile" value="{{ old('mobile') }}" name="mobile"
                 class="intro-x login__input input input--lg border border-gray-300 block" placeholder="تلفن همراه">
          @error('mobile')
          <span class="text-danger">{{ $message }}</span>
          @enderror

          <input wire:model.defer="password"
                 class="intro-x login__input input input--lg border border-gray-300 block mt-4"
                 value="{{ old('password') }}" name="password"
                 type="password" placeholder="کلمه عبور">

          @error('password')
          <span class="text-danger">{{ $message }}</span>
          @enderror
      </div>
      <div class="intro-x flex text-gray-700 dark:text-gray-600 text-xs sm:text-sm mt-4">
          <div class="flex items-center ml-auto">
              <input type="checkbox" class="form-control border mr-2" wire:model.defer="remember"
                     name="remember" id="remember" value="true"
                  {{ old('remember') ? 'checked' : '' }}>

              <label class="cursor-pointer select-none" for="remember"> مرا به خاطر داشته باش </label>
          </div>
          <a class="" href="{{ route('password.request') }}"> فراموشی رمز عبور؟</a>
      </div>

      <div class="intro-x mt-5 xl:mt-8 text-center xl:text-right">
          <button wire:click.prevent="login" class="button button--lg w-full xl:w-32 text-white bg-theme-1 xl:ml-3">ورود</button>
          <a href="{{route('register')}}">
              <button
                  class="button button--lg w-full xl:w-32 text-gray-700 border border-gray-300 dark:border-dark-5 dark:text-gray-300 mt-3 xl:mt-0">
                  ثبت نام
              </button>
          </a>
      </div>

      <div class="text-center justify-content-center items-center mt-3">
          <p>
              با ورود و یا ثبت نام شما
              <a href="/privacy">شرایط استفاده</a>
              از خدمات ما و
              <a href="/terms"> قوانین و حریم و خصوصی</a>
              آن را می پذیرید
          </p>
      </div>--}}
</div>
