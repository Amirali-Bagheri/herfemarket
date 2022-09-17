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
                                        پروفایل کسب و کار
                                    </h3>
                                    <br>
                                    <br>
                                    <br>
                                    <div class="login">
                                        <div class="login_form_container">
                                            <div class="account_login_form">
                                                <form wire:submit.prevent="editProfile">
                                                    <div class="row" style="text-align: right">
                                                        <div class="col-md-6 col-sm-12">
                                                            <div class="form-group pt-2">
                                                                <label>نام کسب و کار:</label>
                                                                <div class="ls-inputicon-box">
                                                                    <input type="text" id="business_name" name="business_name"
                                                                           wire:model.defer="business_name"
                                                                           placeholder="نام کسب و کار"
                                                                           class="form-control wt-form-control  @error('business_name') is-invalid @enderror">
                                                                    @error('business_name') <span
                                                                        class="text-danger error">{{ $message }}</span>@enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-sm-12">
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

                                                        <div class="col-md-6 col-sm-12">
                                                            <div class="row">
                                                                <div class="col-md-6 col-sm-12">
                                                                    <div class="form-group pt-2">
                                                                        <label>استان شما:</label>
                                                                        <select
                                                                            class="form-control @error('state') is-invalid @enderror"
                                                                            id="state"
                                                                            name="state" wire:model="state">
                                                                            <option value="0">استان خود را انتخاب کنید</option>
                                                                            @foreach(\App\Models\State::orderBy('name','asc')->get() as $state)
                                                                                <option
                                                                                    {{ old('state') == $state->id ? "selected" : "" }}
                                                                                    value="{{$state->id}}">
                                                                                    {{$state->name}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                        @error('state') <span
                                                                            class="text-danger error">{{ $message }}</span>@enderror
                                                                    </div>

                                                                </div>
                                                                <div class="col-md-6 col-sm-12">
                                                                    <div class="form-group pt-2">
                                                                        <label>شهر شما:</label>

                                                                        <select wire:model="city"
                                                                                class="form-control @error('city') is-invalid @enderror"
                                                                                id="city"
                                                                                name="city">
                                                                            <option value="">شهر خود را انتخاب کنید</option>
                                                                            @isset($cities)
                                                                                @foreach($cities as $city)
                                                                                    <option
                                                                                        value={{ $city->id }}>{{ $city->name }}</option>
                                                                                @endforeach
                                                                            @endisset

                                                                        </select>
                                                                        @error('city') <span
                                                                            class="text-danger error">{{ $message }}</span>@enderror
                                                                    </div>

                                                                </div>
                                                            </div>

                                                        </div>
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
                                                                @error('business_address') <span
                                                                    class="text-danger error">{{ $message }}</span>@enderror
                                                            </div>
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
