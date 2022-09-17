<div>
    @include('site.layouts.errors')
    @include('site.layouts.livewire_loading',['target'=>'submit'])
    <div class="container">
        <div class="form">
            <form style="padding-bottom:100px;">
                <div class="content-admin-main text-right pt-3" style="padding-bottom:100px;" wire:loading.class="blur">

                    <div class="container" style="text-align: right">
                        <h4>اطلاعات کسب و کار</h4>

                        <div class="row" style="text-align: right">
                            <div class="col-lg-4 col-md-6">
                                <div class="form-group pt-2">
                                    <label>نام کسب و کار:</label>
                                    <div class="ls-inputicon-box">
                                        <input type="text" id="business_name" name="business_name"
                                               wire:model.defer="business_name" placeholder="نام کسب و کار"
                                               class="form-control wt-form-control  @error('business_name') is-invalid @enderror">
                                        @error('business_name') <span
                                            class="text-danger error">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">

                                <div class="form-group pt-2">
                                    <label>موضوع کلی فعالیت:</label>
                                    <div class="ls-inputicon-box">
                                        <select
                                            class="form-control  @error('category_parent') is-invalid @enderror"
                                            data-live-search="true"
                                            title="موضوع کلی فعالیت خود را انتخاب کنید"
                                            id="category_parent"
                                            name="category_parent"
                                            wire:model="category_parent">
                                            <option value="">انتخاب کنید</option>
                                            @foreach(\Modules\Category\Entities\Category::active()->where('parent_id',0)->whereHas('children')->get() as $category)
                                                <option
                                                    value="{{$category->id}}">{{$category->title}}</option>
                                            @endforeach
                                        </select>
                                        @error('category_parent') <span
                                            class="text-danger error">{{ $message }}</span>@enderror
                                    </div>

                                </div>


                            </div>

                            <div class="col-lg-2 col-md-6">
                                <div class="form-group pt-2">
                                    <label>استان شما:</label>
                                    <select class="form-control @error('state') is-invalid @enderror"
                                            id="state"
                                            name="state" wire:model="state">
                                        <option value="0">استان خود را انتخاب کنید</option>
                                        @foreach(\App\Models\State::orderBy('name','asc')->get() as $state)
                                            <option {{ old('state') == $state->id ? "selected" : "" }}
                                                    value="{{$state->id}}">
                                                {{$state->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('state') <span
                                        class="text-danger error">{{ $message }}</span>@enderror
                                </div>

                            </div>
                            <div class="col-lg-2 col-md-6">
                                <div class="form-group pt-2">
                                    <label>شهر شما:</label>

                                    <select wire:model="city"
                                            class="form-control @error('city') is-invalid @enderror"
                                            id="city"
                                            name="city">
                                        <option value="">شهر خود را انتخاب کنید</option>
                                        @isset($cities)
                                            @foreach($cities as $city)
                                                <option value={{ $city->id }}>{{ $city->name }}</option>
                                            @endforeach
                                        @endisset

                                    </select>
                                    @error('city') <span
                                        class="text-danger error">{{ $message }}</span>@enderror
                                </div>
                            </div>

                        </div>
                        <div class="row" style="text-align: right">


                            <div class="col-md-6 col-sm-12">
                                <div class="form-group pt-2">
                                    <label>نشانی:</label>
                                                    <textarea
                                                        placeholder="آدرس دقیق به همراه پلاک و واحد"
                                                        id="address_preview"
                                                        rows="3"
                                                        class="form-control wt-form-control  @error('business_address') is-invalid @enderror"
                                                        wire:model.defer="business_address"
                                                        name="business_address"
                                                    >

                                                    </textarea>
                                        @error('business_address') <span class="text-danger error">{{ $message }}</span>@enderror
                                </div>
                            </div>
                        </div>

                        <div class="text-center container justify-content-center" style=" width:fit-content;">
                            <div class="form-check" style="margin-right: 50px">
                                <input type="checkbox" class="form-check-input @error('accept_rules') is-invalid @enderror"
                                       wire:model.defer="accept_rules"
                                       name="accept_rules"
                                       id="accept_rules">

                                <label class="form-check-label" for="accept_rules">
                                    <a target="_blank" href="#">
                                        قوانین و شرایط را خوانده و قبول دارم
                                    </a>
                                </label>

                            </div>
                            <p>
                                @error('accept_rules')
                                <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </p>

                            <button style="min-width: 150px;" type="submit" wire:click.prevent="submit"
                                    {{--                                data-bs-toggle="modal" data-bs-target="#register-marketing-modal"--}}
                                    class="site-button-secondry  btn btn-danger">
                                ثبت کسب و کار
                            </button>

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
                                            <img style="max-width: 450px;" src="/uploads/register-marketer.jpeg"
                                                 class="text-center justify-content-center">
                                            <br>
                                            <p class="text-right">
                                                شاگو برای کاربران خود امکان کسب درآمد را فراهم کرده است. شما می توانید علاوه بر
                                                استفاده از امکانات متنوع موتور جستجوی شاگو و تجربه کردن یک خرید ارزان و آسان از
                                                معتبرترین فروشگاه های کشور، کسب و کارهای اینترنتی و غیر اینترنتی را به ما معرفی
                                                نمایید و به ازای هر بار شارژ توسط کسب و کار درآمد کسب کنید.

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

                </div>
            </form>
        </div>
    </div>
</div>
