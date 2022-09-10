<div>
    @include('site.livewire.loading')

    @include ('general.element.otp_input')
    <br>
    <br>
    <div class="text-center">
        <div class="section-full bg-orange-light">

            <div class="container">
                <div class="row d-flex justify-content-center h-100">
                    <div class="col-md-9 col-lg-6 col-xl-5">
                        <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.webp" style="padding: 0px 15px 10px 10px;"
                             class="img-fluid">
                    </div>
                    <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                        <h4 class="text-center mb-4">تایید تلفن همراه</h4>
                        <form wire:submit.prevent="sendCode">

                            <div class="form-group" wire:ignore.self>
                                <label class="text-center  mb-1">
                                    <strong>
                                        شماره تلفن همراه خود را وارد کنید:
                                    </strong>
                                </label>

                                <br><br>
                                <div class="ls-inputicon-box">
                                    <input class="form-control @error('mobile') is-invalid @enderror"
                                           value="{{ old('mobile') }}" name="mobile" id="mobile"
                                           type="text" wire:model.defer="mobile"
                                           placeholder="تلفن همراه">
                                    <i class="fs-input-icon fas fa-user-alt "></i>

                                </div>

                                @error('mobile')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <br>
                            </div>
                            <div class="text-center justify-content-center text-lg-start mt-1 pt-1">
                                <button type="submit" id="submit"
                                        class="btn btn-outline-danger btn-rounded btn-block waves-effect z-depth-0">
                                    ارسال
                                </button>
                            </div>
                            <div class="text-center justify-content-center" wire:loading wire:target="submit">
                                در حال بارگذاری...
                            </div>
                            <br>
                            <br>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
