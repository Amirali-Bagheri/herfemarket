<div>
    @include('admin.layouts.livewire_loading')

    <div class="pos intro-y grid-cols-12 gap-5 mt-5">
        <form wire:submit.prevent="submit">
            <div class="col-span-12">
                <div class="intro-y pr-1">
                    <div class="box p-2">
                        <div class="pos__tabs nav nav-tabs justify-center" role="tablist">
                            <a id="general-tab" data-toggle="tab"
                               data-target="#general" href="javascript:"
                               class="flex-1 py-2 rounded-md text-center active"
                               role="tab" aria-controls="general"
                               aria-selected="true">عمومی</a>

                            <a id="images-tab" data-toggle="tab" data-target="#images" href="javascript:"
                               class="flex-1 py-2 rounded-md text-center" role="tab" aria-controls="images"
                               aria-selected="false">
                                تصاویر و لوگو
                            </a>

                            <a id="seo-tab" data-toggle="tab" data-target="#seo" href="javascript:"
                               class="flex-1 py-2 rounded-md text-center" role="tab" aria-controls="seo"
                               aria-selected="false">
                                سئو
                            </a>

                            <a id="security-tab" data-toggle="tab" data-target="#security" href="javascript:"
                               class="flex-1 py-2 rounded-md text-center" role="tab" aria-controls="security"
                               aria-selected="false">
                                امنیت
                            </a>

                            <a id="social-tab" data-toggle="tab" data-target="#social" href="javascript:"
                               class="flex-1 py-2 rounded-md text-center" role="tab" aria-controls="social"
                               aria-selected="false">
                                شبکه های اجتماعی
                            </a>

                            <a id="analyse-tab" data-toggle="tab" data-target="#analyse" href="javascript:"
                               class="flex-1 py-2 rounded-md text-center" role="tab" aria-controls="analyse"
                               aria-selected="false">
                                آنالیز
                            </a>

                            <a id="pwa-tab" data-toggle="tab" data-target="#pwa" href="javascript:"
                               class="flex-1 py-2 rounded-md text-center" role="tab" aria-controls="pwa"
                               aria-selected="false">
                                PWA
                            </a>

                        </div>
                    </div>
                </div>
                <div class="tab-content">
                    <div id="general" class="tab-pane active" role="tabpanel" aria-labelledby="general-tab">
                        <div class="box p-5 mt-5">

                            <div class="form-group mt-2">
                                <label class="control-label" for="site_name">نام سایت</label>
                                <input class="form-control" type="text"
                                       placeholder="نام وبسایت را وارد کنید" id="site_name"
                                       wire:model.defer="keys.site_name"
                                       name="site_name"/>
                            </div>
                            <div class="form-group mt-2">
                                <label class="control-label" for="site_description">عنوان سایت</label>
                                <input class="form-control" type="text" wire:model.defer="keys.site_description"
                                       placeholder="عنوان سایت را وارد کنید" id="site_description"
                                       name="site_description"
                                />
                            </div>

                            <div class="form-group mt-2">
                                <label class="control-label" for="footer_copyright">متن کپی رایت
                                    فوتر</label>
                                <textarea class="form-control tinymce"
                                          placeholder="میتواند کد HTML باشد"
                                          wire:model.defer="keys.footer_copyright"
                                          id="footer_copyright" name="footer_copyright">
                                                </textarea>
                            </div>
                            {{--                            <div class="form-group mt-2">--}}
                            {{--                                <label class="control-label" for="enamad_logo">کد اینماد</label>--}}
                            {{--                                <textarea class="form-control ltr"--}}
                            {{--                                          placeholder="میتواند کد HTML باشد"--}}
                            {{--                                          id="enamad_logo" name="enamad_logo">--}}
                            {{--                                                    {{ setting('enamad_logo') }}--}}
                            {{--                                                </textarea>--}}
                            {{--                            </div>--}}
                            {{--                            <div class="form-group mt-2">--}}
                            {{--                                <label class="control-label" for="samandehi_logo">کد ساماندهی</label>--}}
                            {{--                                <textarea class="form-control ltr"--}}
                            {{--                                          placeholder="میتواند کد HTML باشد"--}}
                            {{--                                          id="samandehi_logo" name="samandehi_logo">--}}
                            {{--                                                    {{ setting('samandehi_logo') }}--}}
                            {{--                                                </textarea>--}}
                            {{--                            </div>--}}
                        </div>
                    </div>
                    <div id="images" class="tab-pane" role="tabpanel" aria-labelledby="images-tab" style="">
                        <div class="box p-5 mt-5">
                            <div class="form-group col-6">
                                <label class="control-label">لوگوی سایت</label>
                                <input class="form-control" type="file" name="site_logo"
                                       wire:model.defer="keys.site_logo"
                                       onchange="loadFile(event,'site_logo')"/>

                                <img src="/uploads/{{ setting('site_logo') }}"
                                     id="site_logo" class="img-fluid"
                                     style="width: 80px; height: 80px; margin-right: 20px;">
                            </div>
                            <div class="form-group col-6">
                                <label class="control-label">Favicon 16x16</label>
                                <input class="form-control" type="file" name="favicon-16"
                                       wire:model.defer="keys.favicon-16"
                                       onchange="loadFile(event,'favicon-16')"/>

                                <img src="/uploads/{{ setting('favicon-16') }}"
                                     id="favicon-16" class="img-fluid"
                                     style="width: 80px; height: 80px; margin-right: 20px;">
                            </div>
                            <div class="form-group col-6">
                                <label class="control-label">Favicon 32x32</label>
                                <input class="form-control" type="file" name="favicon-32"
                                       wire:model.defer="keys.favicon-32"
                                       onchange="loadFile(event,'favicon-32')"/>

                                <img src="/uploads/{{ setting('favicon-32') }}"
                                     id="favicon-32" class="img-fluid"
                                     style="width: 80px; height: 80px; margin-right: 20px;">
                            </div>
                        </div>
                    </div>
                    <div id="security" class="tab-pane" role="tabpanel" aria-labelledby="security-tab" style="">
                        <div class="box p-5 mt-5">

                        </div>
                    </div>
                    <div id="seo" class="tab-pane" role="tabpanel" aria-labelledby="seo-tab" style="">
                        <div class="box p-5 mt-5">
                            <div class="form-group mt-2">
                                <label class="control-label" for="seo_meta_title">متاتگ عنوان
                                    سئو</label>
                                <input class="form-control" type="text" wire:model.defer="keys.seo_meta_title"
                                       placeholder="عنوان متای وب سایت را وارد کنید" id="seo_meta_title"
                                       name="seo_meta_title"
                                />
                            </div>
                            <div class="form-group mt-2">
                                <label class="control-label" for="seo_meta_description">متاتگ توضیحات
                                    سئو</label>
                                <textarea class="form-control" rows="4"
                                          placeholder="توضیحات متای وب سایت را وارد کنید"
                                          wire:model.defer="keys.seo_meta_description"
                                          id="seo_meta_description"
                                          name="seo_meta_description">
                                </textarea>
                            </div>
                            <div class="form-group mt-2">
                                <label class="control-label" for="seo_meta_keywords">متاتگ کلیدواژه
                                    سئو</label>
                                <textarea class="form-control" rows="4" wire:model.defer="keys.seo_meta_keywords"
                                          placeholder=" کلیدواژه های وب سایت را وارد کنید.با , از یکدیگر جدا کنید"
                                          id="seo_meta_keywords"
                                          name="seo_meta_keywords">
                                </textarea>
                            </div>
                        </div>
                    </div>
                    <div id="social" class="tab-pane" role="tabpanel" aria-labelledby="social-tab" style="">
                        <div class="box p-5 mt-5">
                            <div class="form-group mt-2">
                                <label class="control-label" for="social_facebook">فیسبوک</label>
                                <input class="form-control" type="text"
                                       placeholder="لینک پروفایل فیسبوک"
                                       id="social_facebook" name="social_facebook"
                                       wire:model.defer="keys.social_facebook"/>
                            </div>
                            <div class="form-group mt-2">
                                <label class="control-label" for="social_twitter">یوزرنیم توییتر بدون
                                    @</label>
                                <input class="form-control" type="text" placeholder="username"
                                       id="social_twitter" name="social_twitter"
                                       wire:model.defer="keys.social_twitter"/>
                            </div>
                            <div class="form-group mt-2">
                                <label class="control-label" for="social_instagram">یوزرنیم اینستاگرام
                                    بدون
                                    @</label>
                                <input class="form-control" type="text"
                                       placeholder="username" id="social_instagram"
                                       name="social_instagram"
                                       wire:model.defer="keys.social_instagram"/>
                            </div>
                            <div class="form-group mt-2">
                                <label class="control-label" for="social_linkedin">لینکدین</label>
                                <input class="form-control" type="text"
                                       placeholder="لینک پروفایل لینکدین"
                                       id="social_linkedin" name="social_linkedin"
                                       wire:model.defer="keys.social_linkedin"/>
                            </div>
                            <div class="form-group mt-2">
                                <label class="control-label" for="social_telegram">یوزرنیم تلگرام بدون
                                    @</label>
                                <input class="form-control" type="text" placeholder="username"
                                       id="social_telegram" name="social_telegram"
                                       wire:model.defer="keys.social_telegram"/>
                            </div>
                            <div class="form-group mt-2">
                                <label class="control-label" for="social_aparat">آپارات</label>
                                <input class="form-control" type="text" placeholder="لینک کانال آپارات"
                                       id="social_aparat" name="social_aparat"
                                       wire:model.defer="keys.social_aparat"/>
                            </div>
                            <div class="form-group mt-2">
                                <label class="control-label" for="social_whatsapp">شماره واتساپ بدون
                                    0</label>
                                <input class="form-control" type="text" placeholder="9120000000"
                                       id="social_whatsapp" name="social_whatsapp"
                                       wire:model.defer="keys.social_whatsapp"/>
                            </div>
                        </div>
                    </div>
                    <div id="analyse" class="tab-pane" role="tabpanel" aria-labelledby="analyse-tab" style="">
                        <div class="box p-5 mt-5">
                            <div class="container">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group mt-2">
                                            <label class="control-label" for="google_analytics">Google
                                                Analytics</label>
                                            <input class="form-control" wire:model.defer="keys.google_analytics"
                                                   placeholder="کد Google Analytics خود را وارد کنید"
                                                   id="google_analytics" name="google_analytics">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group mt-2">
                                            <label class="control-label" for="google_tag_manager">Google
                                                Tag
                                                Manager</label>
                                            <input class="form-control"
                                                   wire:model.defer="keys.google_tag_manager"
                                                   placeholder="کد Google Tag Manager خود را وارد کنید"
                                                   id="google_tag_manager" name="google_tag_manager">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group mt-2">
                                            <label class="control-label" for="yandex_metrika">Yandex
                                                Metrika
                                            </label>
                                            <input class="form-control"
                                                   wire:model.defer="keys.yandex_metrika"
                                                   placeholder="کد Yandex Metrika خود را وارد کنید"
                                                   id="yandex_metrika" name="yandex_metrika">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group mt-2">
                                            <label class="control-label" for="bing_analytics">Bing
                                                Analytics</label>
                                            <input class="form-control"
                                                   wire:model.defer="keys.bing_analytics"
                                                   placeholder="کد Bing Analytics خود را وارد کنید"
                                                   id="bing_analytics" name="bing_analytics">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group mt-2">
                                            <label class="control-label" for="alexa_analytics">Alexa
                                                Analytics</label>
                                            <input class="form-control"
                                                   wire:model.defer="keys.alexa_analytics"
                                                   placeholder="کد Alexa Analytics خود را وارد کنید"
                                                   id="alexa_analytics" name="alexa_analytics">
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>

                    <div id="pwa" class="tab-pane" role="tabpanel" aria-labelledby="pwa-tab" style="">
                        <div class="box p-5 mt-5">

                            <div class="form-group col-6">

                                <label class="control-label" for="pwa_name">نام</label>
                                <input class="form-control" type="text" id="pwa_name" name="pwa_name"
                                       value="{{ setting('pwa_name') }}"/>
                            </div>
                            <div class="form-group col-6">

                                <label class="control-label" for="pwa_short_name">نام کوتاه</label>
                                <input class="form-control" type="text" id="pwa_short_name"
                                       name="pwa_short_name"
                                       wire:model.defer="keys.pwa_short_name"
                                />
                            </div>
                            <div class="form-group col-6">

                                <label class="control-label" for="theme_color">کد رنگ تم</label>
                                <input class="form-control" type="text" id="theme_color"
                                       wire:model.defer="keys.theme_color"
                                       name="theme_color"/>
                            </div>
                            <div class="form-group col-6">

                                <label class="control-label" for="background_color">کد پس زمینه
                                    تم</label>
                                <input class="form-control" type="text" id="background_color"
                                       name="background_color"
                                       wire:model.defer="keys.background_color"
                                />
                            </div>

                            <div class="form-group col-6">
                                <label class="control-label">App Icon 48x48</label>
                                <input class="form-control" type="file" name="appicon-48"
                                       onchange="loadFile(event,'appicon-48')"/>

                                <img src="/uploads/{{ setting('appicon-48') }}"
                                     id="appicon-48" class="img-fluid"
                                     style="width: 80px; height: 80px; margin-right: 20px;">
                            </div>
                            <div class="form-group col-6">
                                <label class="control-label">App Icon 96x96</label>
                                <input class="form-control" type="file" name="appicon-96"
                                       onchange="loadFile(event,'appicon-96')"/>

                                <img src="/uploads/{{ setting('appicon-96') }}"
                                     id="appicon-96" class="img-fluid"
                                     style="width: 80px; height: 80px; margin-right: 20px;">
                            </div>
                            <div class="form-group col-6">
                                <label class="control-label">App Icon 144x144</label>
                                <input class="form-control" type="file" name="appicon-144"
                                       onchange="loadFile(event,'appicon-144')"/>

                                <img src="/uploads/{{ setting('appicon-144') }}"
                                     id="appicon-144" class="img-fluid"
                                     style="width: 80px; height: 80px; margin-right: 20px;">
                            </div>
                            <div class="form-group col-6">
                                <label class="control-label">App Icon 180x180</label>
                                <input class="form-control" type="file" name="appicon-180"
                                       onchange="loadFile(event,'appicon-180')"/>

                                <img src="/uploads/{{ setting('appicon-180') }}"
                                     id="appicon-180" class="img-fluid"
                                     style="width: 80px; height: 80px; margin-right: 20px;">
                            </div>
                            <div class="form-group col-6">
                                <label class="control-label">App Icon 192x192</label>
                                <input class="form-control" type="file" name="appicon-192"
                                       onchange="loadFile(event,'appicon-192')"/>

                                <img src="/uploads/{{ setting('appicon-192') }}"
                                     id="appicon-192" class="img-fluid"
                                     style="width: 80px; height: 80px; margin-right: 20px;">
                            </div>
                            <div class="form-group col-6">
                                <label class="control-label">App Icon 196x196</label>
                                <input class="form-control" type="file" name="appicon-196"
                                       onchange="loadFile(event,'appicon-196')"/>

                                <img src="/uploads/{{ setting('appicon-196') }}"
                                     id="appicon-196" class="img-fluid"
                                     style="width: 80px; height: 80px; margin-right: 20px;">
                            </div>
                            <div class="form-group col-6">
                                <label class="control-label">App Icon 384x384</label>
                                <input class="form-control" type="file" name="appicon-384"
                                       onchange="loadFile(event,'appicon-384')"/>

                                <img src="/uploads/{{ setting('appicon-384') }}"
                                     id="appicon-384" class="img-fluid"
                                     style="width: 80px; height: 80px; margin-right: 20px;">
                            </div>

                            <div class="form-group col-6">
                                <label class="control-label">App Icon 512x512</label>
                                <input class="form-control" type="file" name="appicon-512"
                                       onchange="loadFile(event,'appicon-512')"/>

                                <img src="/uploads/{{ setting('appicon-512') }}"
                                     id="appicon-512" class="img-fluid"
                                     style="width: 80px; height: 80px; margin-right: 20px;">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex mt-5">
                    <button type="submit" class="btn btn-primary w-32 shadow-md ml-auto">
                        ذخیره
                    </button>
                </div>
            </div>

        </form>
    </div>
</div>
@push('scripts')
    <script>
        loadFile = function (event, id) {
            var output = document.getElementById(id);
            output.src = URL.createObjectURL(event.target.files[0]);
        };

    </script>
@endpush
