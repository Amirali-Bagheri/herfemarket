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
                                        ثبت محصول جدید
                                    </h3>
                                    <br>
                                    <br>
                                    <br>
                                    <div class="login">
                                        <div class="login_form_container">
                                            <div class="account_login_form">
                                                <form wire:submit.prevent="submit">
                                                    @csrf
                                                    <div class="row" style="text-align: right">
                                                        <div class="col-md-6 col-sm-12">
                                                            <div class="form-group pt-2">
                                                                <label>عنوان:</label>
                                                                <div class="ls-inputicon-box">
                                                                    <input type="text" id="title" name="title" wire:model.defer="title" placeholder="عنوان" class="form-control wt-form-control  @error('title') is-invalid @enderror">
                                                                    @error('title') <span class="text-danger error">{{ $message }}</span>@enderror
                                                                </div>
                                                            </div>

                                                            <div class="form-group pt-2">
                                                                <label>توضیحات:</label>
                                                                <textarea id="description" rows="5" class="form-control wt-form-control  @error('description') is-invalid @enderror" wire:model.defer="description" name="description">

                                                    </textarea>
                                                                @error('description') <span class="text-danger error">{{ $message }}</span>@enderror
                                                            </div>

                                                        </div>
                                                        <div class="col-md-6 col-sm-12">
                                                            @push ('scripts')
                                                            <script src="https://cdnjs.cloudflare.com/ajax/libs/tom-select/2.2.0/js/tom-select.complete.min.js" integrity="sha512-VGLFiLQssGs/+DPPemqCV5/nauqzFpR2c+zOShSBbgBRYSYkiM+LmjZQ1ErjKIgfYvlfVWhHL7BCOKmIvtuT7A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
                                                            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tom-select/2.2.0/css/tom-select.min.css" integrity="sha512-BrNXB6PRnf32ZqstFiYQT/L7aVZ45FGojXbBx8nybK/NBhxFQPHsr36jH11I2YoUaA5UFqTRF14xt3VVMWfCOg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
                                                            <script>
                                                                new TomSelect('.tom-select', {
                                                                    // create: true,
                                                                    // sortField: {
                                                                    //     field: "text",
                                                                    //     direction: "asc"
                                                                    // }
                                                                });

                                                            </script>
                                                            @endpush

                                                            <div class="form-group pt-2">
                                                                <div class="select_form_select">
                                                                    <label for="category_id">دسته بندی: <span>*</span></label>
                                                                    <select class="form-control" id="category_id" wire:model.defer="category_id">
                                                                        <option value="">انتخاب کنید</option>

                                                                        @foreach ($categories as $category)
                                                                        <option value="{{$category->id}}">{{$category->title}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    @error('category_id') <span class="text-danger error">{{ $message }}</span>@enderror

                                                                </div>

                                                            </div>

                                                            <div class="form-group pt-2">
                                                                <div class="select_form_select">
                                                                    <label for="main_price">قیمت <span>*</span></label>
                                                                    <input type="text" wire:model.defer="main_price">
                                                                    @error('main_price') <span class="text-danger error">{{ $message }}</span>@enderror

                                                                </div>

                                                            </div>

                                                            <div class="form-group pt-2">
                                                                <label>تصویر:</label>
                                                                <div class="ls-inputicon-box">
                                                                    <input type="file" id="images" name="images" wire:model="images" class="form-control wt-form-control  @error('images') is-invalid @enderror">
                                                                    @error('images') <span class="text-danger error">{{ $message }}</span>@enderror
                                                                </div>

                                                                @if ($images)
                                                                پیشنمایش:
                                                                <img width="100" src="{{ $images->temporaryUrl() }}">
                                                                @elseif(!empty($image_url))
                                                                پیشنمایش:
                                                                <img width="100" src="{{ $image_url }}">
                                                                @endif
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
