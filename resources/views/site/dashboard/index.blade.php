<div>
    <!-- my account start  -->
    <div class="account_page_bg">
        <div class="container">
            <section class="main_content_area">
                <div class="account_dashboard">
                    <div class="row">
                        <div class="col-sm-12 col-md-3 col-lg-3">
                            @include('site.dashboard.layouts.sidebar')
                        </div>
                        <div class="col-sm-12 col-md-9 col-lg-9">

                            <div class="tab-content dashboard_content">
                                <div class="tab-pane fade show active">
                                    <h3 class="float-left">
                                        پروفایل کاربری
                                    </h3>
                                    <br>
                                    <br>
                                    <br>
                                    <div class="login">
                                        <div class="login_form_container">
                                            <div class="account_login_form">
                                                <form wire:submit.prevent="editProfile">
                                                    <div class="row">
                                                        <div class=" col-md-6 col-sm-12">
                                                            <label>نام</label>
                                                            <input type="text" wire:model.defer="first_name" class="form-control">
                                                            @error('first_name')
                                                            <em style="color: red">
                                                                {{ $message }}
                                                            </em>
                                                            <br>
                                                            <br>
                                                            @enderror

                                                            <label>ایمیل</label>
                                                            <input type="email" wire:model.defer="email" class="form-control">
                                                            @error('email')
                                                            <em style="color: red">
                                                                {{ $message }}
                                                            </em>
                                                            <br>
                                                            <br>
                                                            @enderror


                                                            <label>رمز عبور جدید</label>
                                                            <input type="password" wire:model.defer="password" class="form-control">
                                                            @error('password')
                                                            <em style="color: red">
                                                                {{ $message }}
                                                            </em>
                                                            <br>
                                                            <br>
                                                            @enderror
                                                        </div>

                                                        <div class=" col-md-6 col-sm-12">
                                                            <label>نام خانوادگی</label>
                                                            <input type="text" wire:model.defer="last_name"
                                                                   class="form-control">
                                                            @error('last_name')
                                                            <em style="color: red">
                                                                {{ $message }}
                                                            </em>
                                                            <br>
                                                            <br>
                                                            @enderror

                                                            <label>تلفن همراه</label>
                                                            <input type="text" wire:model.defer="mobile" disabled="disabled"
                                                                   class="form-control">



                                                            <label>تکرار رمز عبور جدید</label>
                                                            <input type="password" wire:model.defer="password_confirmation" class="form-control">
                                                            @error('password_confirmation')
                                                            <em style="color: red">
                                                                {{ $message }}
                                                            </em>
                                                            <br>
                                                            <br>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="save_button primary_btn default_button">
                                                        <button type="submit">ذخیره</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <!-- my account end   -->
</div>
