<div>
    @include('dashboard.layouts.livewire_loading')

    <section class="contact-page-wrap bg--accent">
        <form style="padding-bottom:100px;">
            <div class="content-admin-main text-right " wire:loading.class="blur">

                <div class="container">
                    <div class="row text-center justify-content-center">
                        <div class="col-lg-6 col-md-6 container">
                            <div class="panel panel-default">
                                <div class="panel-heading wt-panel-heading p-a20">
                                    <p class="panel-tittle m-a0">
                                        کاربر گرامی، جهت فعال سازی حساب کاربری فرم زیر را تکمیل کنید.
                                    </p>
                                </div>
                                <div class="panel-body wt-panel-body p-a20 p-b0 m-b30 bg-white">

                                    <div class="row">
                                        @if(empty($user->mobile))
                                            <div class="col-12">
                                                <div class="form-group text-left">
                                                    <label class="text-right float-right mb-1"><strong>تلفن
                                                            همراه</strong></label>
                                                    <input placeholder="تلفن همراه" type="text"
                                                           wire:model.defer="mobile"
                                                           {{ !empty($user->mobile) ? 'disabled' : '' }}
                                                           class="text-center form-control">
                                                    @error('mobile')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                        @endif

                                        @if(empty($user->first_name))
                                            <div class="col-md-6 col-sm-12">
                                                <div class="form-group text-left">
                                                    <label
                                                        class="text-left float-right mb-1"><strong>نام</strong></label>
                                                    <input type="text" wire:model.defer="first_name"
                                                           value="{{ old('first_name') }}"
                                                           placeholder="نام" class="form-control">
                                                    @error('first_name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        @endif

                                        @if(empty($user->last_name))
                                            <div class="col-md-6 col-sm-12">
                                                <div class="form-group text-left">
                                                    <label class="text-left float-right mb-1"><strong>نام
                                                            خانوادگی</strong></label>
                                                    <input type="text" wire:model.defer="last_name"
                                                           value="{{ old('last_name') }}"
                                                           class="form-control" placeholder="نام خانوادگی">

                                                    @error('last_name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        @endif

                                        @if(empty($user->password))
                                            <div class="col-md-6 col-sm-12">
                                                <div class="form-group text-left">
                                                    <label class="text-left float-right mb-1"><strong>رمز عبور</strong></label>
                                                    <input class="form-control" wire:model.defer="password"
                                                           name="password"
                                                           type="password" placeholder="کلمه عبور">
                                                    @error('password')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                            </div>

                                            <div class="col-md-6 col-sm-12">
                                                <div class="form-group text-left">
                                                    <label class="text-left float-right mb-1"><strong>تکرار رمز
                                                            عبور</strong></label>
                                                    <input class="form-control" wire:model.defer="password_confirmation"
                                                           name="password_confirmation" type="password"
                                                           placeholder="تکرار  رمز عبور">
                                                    @error('password_confirmation')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        @endif

                                        @if(empty($user->email))
                                            <div class="col-12">
                                                <div class="form-group text-left">
                                                    <label class="text-right float-right mb-1"><strong>
                                                            پست الکترونیکی (اختیاری)
                                                        </strong></label>
                                                    <input placeholder="پست الکترونیکی" type="text"
                                                           wire:model.defer="email"
                                                           class="text-center form-control">
                                                    @error('email')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                        @endif
                                    </div>

                                </div>
                            </div>
                        </div>

{{--                        @if($is_register_business)--}}

{{--                            <div class="col-lg-6 col-md-6 container">--}}
{{--                                <div class="panel panel-default">--}}
{{--                                    <div class="panel-heading wt-panel-heading p-a20">--}}
{{--                                        <p class="panel-tittle m-a0">اطلاعات حقوقی</p>--}}
{{--                                    </div>--}}
{{--                                    <div class="panel-body wt-panel-body p-a20 p-b0 m-b30 bg-white">--}}
{{--                                        <div class="row">--}}
{{--                                            <div class="col-md-6 col-sm-12">--}}
{{--                                                <div class="form-group text-left">--}}
{{--                                                    <label--}}
{{--                                                        class="text-left float-right mb-1"><strong>--}}
{{--                                                            نام شرکت/موسسه (اختیاری)--}}
{{--                                                        </strong></label>--}}
{{--                                                    <input type="text" wire:model.defer="company_name"--}}
{{--                                                           value="{{ old('company_name') }}"--}}
{{--                                                           placeholder="نام شرکت/موسسه" class="form-control">--}}
{{--                                                    @error('company_name')--}}
{{--                                                    <span class="text-danger">{{ $message }}</span>--}}
{{--                                                    @enderror--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-md-6 col-sm-12">--}}
{{--                                                <div class="form-group text-left">--}}
{{--                                                    <label--}}
{{--                                                        class="text-left float-right mb-1"><strong>--}}
{{--                                                            شناسه ملی/اقتصادی (اختیاری)--}}
{{--                                                        </strong></label>--}}
{{--                                                    <input type="text" wire:model.defer="economic_code"--}}
{{--                                                           value="{{ old('economic_code') }}"--}}
{{--                                                           placeholder="شناسه ملی/اقتصادی" class="form-control">--}}
{{--                                                    @error('economic_code')--}}
{{--                                                    <span class="text-danger">{{ $message }}</span>--}}
{{--                                                    @enderror--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

{{--                                </div>--}}
{{--                            </div>--}}

{{--                        @endif--}}
                    </div>

                    <div class="text-center container justify-content-center">
                        <button style="min-width: 150px;" type="submit"
{{--                                data-bs-toggle="modal" data-bs-target="#register-marketing-modal"--}}
                                wire:click.prevent="submit"
                                class="btn btn-outline-danger btn-rounded my-4 waves-effect">
                            ذخیره
                        </button>
                    </div>

                    <div wire:ignore class="modal fade rtl" id="register-marketing-modal"
                         tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">
                                            هم خرید کنید و هم درآمد کسب کنید
                                        </h5>
                                    </div>
                                    <div class="modal-body text-center">
                                        <img style="max-width: 450px;" src="/uploads/register-marketer.jpeg" class="text-center justify-content-center">
                                      <br>
                                        <p class="text-right">
                                             شاگو برای کاربران خود امکان کسب درآمد را فراهم کرده است. شما می توانید علاوه بر استفاده از امکانات متنوع موتور جستجوی شاگو و تجربه کردن یک خرید ارزان و آسان از معتبرترین فروشگاه های کشور، کسب و کارهای اینترنتی و غیر اینترنتی را به ما معرفی نمایید و به ازای هر بار شارژ توسط کسب و کار درآمد کسب کنید.

                                        </p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" wire:click="rejectMarketing" class="btn btn-danger"
                                                data-bs-dismiss="modal">
                                            تمایل ندارم
                                        </button>
                                        <button type="button" wire:click="submitMarketing" class="btn btn-success">
                                            موافقم
                                        </button>
                                    </div>
                                </div>
                        </div>
                    </div>

                </div>
            </div>

        </form>

    </section>

</div>
