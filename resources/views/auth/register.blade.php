<div>
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
                        <form>
                            <div class="form-group">

                                <div class="ls-inputicon-box justify-content-center text-center">
                                    <input class="form-control @error('mobile') is-invalid @enderror"
                                           value="{{ old('mobile') }}" name="mobile" id="mobile"
                                           type="text" wire:model.defer="mobile"
                                           placeholder="تلفن همراه">
                                    <i class="fs-input-icon fas fa-user-alt "></i>

                                </div>

                                @error('mobile')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="text-center justify-content-center text-lg-start mt-1 pt-1">
                                <button type="button"
                                        class="btn btn-outline-danger btn-rounded btn-block waves-effect z-depth-0"
                                        wire:click.prevent="register">
                                    ثبت نام
                                </button>
                            </div>
                            <div class="text-center justify-content-center" wire:loading wire:target="register">
                                در حال بارگذاری...
                                <br>
                            </div>
                            <br>
                            <p class="small fw-bold mb-0 mt-2 text-center justify-content-center">
                                قبلا ثبت نام کرده اید؟
                                <a href="{{route('login')}}" class="link-danger">وارد شوید</a>
                            </p>
                            <br>
                            <br>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
