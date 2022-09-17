<div>
    <br>
    <br>
    <div class="customer_login text-center justify-content-center d-flex mb-4">
        <div class="col-md-6 col-sm-12 text-center justify-content-center">
            <div class="account_form login text-center">
                <h2>ورود</h2>
                <form>
                    <p>
                        <label>تلفن همراه <span>*</span></label>
                        <input class="form-control @error('mobile') is-invalid @enderror"
                               value="{{ old('mobile') }}" name="mobile" id="mobile"
                               type="text" wire:model.defer="mobile"
                               placeholder="تلفن همراه">

                        @error('mobile')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </p>

                    <p>
                        <label>رمز عبور <span>*</span></label>
                        <input wire:model.defer="password"
                               class="form-control @error('password') is-invalid @enderror"
                               value="{{ old('password') }}" name="password"
                               type="password" placeholder="کلمه عبور">
                        @error('password')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </p>
                    <div class="login_submit">
                        <a href="{{route('password.request')}}">رمز عبور خود را فراموش کرده اید؟</a>
                        <label for="remember">
                            <input id="remember" type="checkbox" wire:model.defer="remember"
                                   name="remember" id="remember" value="true"
                                {{ old('remember') ? 'checked' : '' }}>
                            به خاطر سپاری
                        </label>
                        <button wire:click.prevent="login" type="submit">ورود</button>
                        <div class="text-center justify-content-center" wire:loading wire:target="login">
                            در حال بارگذاری...
                            <br>
                        </div>
                        <p class="small fw-bold mb-0 mt-2 text-center justify-content-center">
                            <a href="{{route('register')}}" style="font-size: 13px;">ثبت نام کنید</a>
                        </p>
                        <br>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <br>
    <br>
    <br>
</div>
