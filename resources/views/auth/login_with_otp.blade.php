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
                        <h4 class="text-center mb-4">
                            ورود با یکبار رمز
                        </h4>
                        <form>

                            <div class="form-group" wire:ignore.self>
                                <label class="text-center  mb-1">
                                    <strong>
                                        کد ارسال شده به شماره همراه خود را وارد کنید:
                                    </strong>
                                </label>

                                <br>
                                <div class="ltr w-100 text-center justify-content-center d-flex" id="otp-group" wire:ignore.self>
                                    <input wire:model.defer="otp_1" id="otp_1" class="otp inputs" pattern="[0-9]" type="text" maxlength=1 >
                                    <input wire:model.defer="otp_2" id="otp_2" class="otp inputs" pattern="[0-9]" type="text" maxlength=1 >
                                    <input wire:model.defer="otp_3" id="otp_3" class="otp inputs" pattern="[0-9]" type="text" maxlength=1 >
                                    <input wire:model.defer="otp_4" id="otp_4" class="otp inputs" pattern="[0-9]" type="text" maxlength=1 >
                                    <input wire:model.defer="otp_5" id="otp_5" class="otp inputs" pattern="[0-9]" type="text" maxlength=1 >
                                    <input wire:model.defer="otp_6" id="otp_6" class="otp inputs" pattern="[0-9]" type="text" maxlength=1 >
                                </div>
                                <br> <br>

                                @if ($errors->has('otp_1') or $errors->has('otp_2') or $errors->has('otp_3') or $errors->has('otp_4') or $errors->has('otp_5') or $errors->has('otp_6'))

                                    <span class="text-danger">
                                        لطفا کد تایید را وارد کنید.
                                    </span>

                                @endif

                            </div>
                            <div class="d-flex text-center justify-content-center">
                                <p>
                                    <a wire:click="sendCode" href="javascript:void(0)">کد ارسال نشد؟
                                        برای ارسال مجدد کلیک کنید</a>
                                </p>
                            </div>
                            <div class="text-center justify-content-center text-lg-start mt-1 pt-1">
                                <button type="button" id="submit"
                                        class="btn btn-outline-danger btn-rounded btn-block waves-effect z-depth-0"
                                        wire:click.prevent="submit">
                                    تایید
                                </button>
                            </div>
                            <div class="text-center justify-content-center" wire:loading wire:target="submit">
                                در حال بارگذاری...
                                <br>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
