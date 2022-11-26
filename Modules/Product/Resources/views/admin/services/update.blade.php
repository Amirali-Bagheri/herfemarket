<div>
    <div class="intro-y col-span-12 flex flex-wrap sm:flex-no-wrap items-center mt-2 ltr">
        @if($product)
        <a target="_blank" href="{{route('site.products.single',$product->slug)}}" class="btn btn-outline-primary shadow-md mr-3">
            مشاهده در سایت
        </a>
        @endif
        <a href="#" wire:click.prevent="destroy" class="btn btn-danger shadow-md mr-3">
            حذف
        </a>
        <button class="mr-auto ml-3 text-theme-1 dark:text-theme-10" wire:click="$refresh">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-refresh-ccw w-4 h-4 mr-3">
                <polyline points="1 4 1 10 7 10"></polyline>
                <polyline points="23 20 23 14 17 14"></polyline>
                <path d="M20.49 9A9 9 0 0 0 5.64 5.64L1 10m22 4l-4.64 4.36A9 9 0 0 1 3.51 15"></path>
            </svg>
        </button>
        @if($product)
        <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">

            <h2 class="text-lg font-medium truncate ml-auto">
                ویرایش محصول {{$product->title}}
            </h2>
        </div>
        @endif
    </div>


    <form wire:submit.prevent="submit">
        @include('admin.layouts.livewire_loading', ['target' => 'submit'])

        <div class="grid grid-cols-12 gap-6 mt-5">

            <div class="intro-y col-span-12 lg:col-span-6">
                <div class="intro-y box">
                    <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200">
                        <h2 class="font-medium text-base ml-auto">
                            عمومی
                        </h2>
                    </div>
                    <div class="p-5">
                        <div>
                            <label for="title">عنوان</label>
                            <input type="text" class="form-control w-full border mt-2 @error('title') border-theme-6 @enderror" id="title" placeholder="عنوان" wire:model="title">
                            @error('title')
                            <div class="text-theme-6 mt-2">{{ $message }}</div> @enderror
                        </div>

                        <div class="mt-3">
                            <label for="en_title">نام انگلیسی</label>
                            <input type="text" class="form-control w-full border mt-2 @error('en_title') border-theme-6 @enderror" id="en_title" placeholder="نام انگلیسی" wire:model="en_title">
                            @error('en_title')
                            <div class="text-theme-6 mt-2">{{ $message }}</div> @enderror
                        </div>
                        <div class="mt-3">
                            <label for="slug">نام نمایشی</label>
                            <input type="text" class="form-control w-full border mt-2 @error('slug') border-theme-6 @enderror" id="slug" placeholder="نام نمایشی" wire:model="slug">
                            @error('slug')
                            <div class="text-theme-6 mt-2">{{ $message }}</div> @enderror
                        </div>
                        <div class="mt-3">
                            <label for="excerpt">توضیحات کوتاه</label>
                            <textarea class="w-full px-3 py-2 text-gray-700 border rounded-lg focus:outline-none  @error('excerpt') border-theme-6 @enderror" rows="4" id="excerpt" placeholder="توضیحات کوتاه" wire:model="excerpt"></textarea>

                            @error('excerpt')
                            <div class="text-theme-6 mt-2">{{ $message }}</div> @enderror
                        </div>

                    </div>
                </div>

                <div class="intro-y box mt-4">
                    <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200">
                        <h2 class="font-medium text-base ml-auto">
                            جزئیات
                        </h2>
                    </div>
                    <div class="p-5">
                        <div>
                            <label>دسته بندی</label>
                            <br>
                            <br>
                            <a href="javascript:void(0)" class="red" wire:click="removeProductCategories">
                                (حذف دسته بندی های انتخاب شده)
                            </a>
                            <br>
                            <br>

                            @forelse($this->categories as $key => $value)
                            <div class="flex">
                                <a href="javascript:void(0)" wire:click.prevent="removeCategory('{{$key}}')"><i class="far fa-times ml-2"></i></a>
                                {{$value}}
                            </div>
                            @empty
                            <p class="text-center items-center">
                                دسته بندی ای انتخاب نشده است
                            </p>
                            @endforelse
                            <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
                                <div class="relative mt-2">
                                    <input type="text" class="form-control pr-12 w-full border col-span-4" placeholder=" جستجو..." wire:keydown.enter="searchCategories" wire:model.defer="category_search">
                                    <a wire:click="searchCategories" href="javascript:void(0)" class="absolute top-0 right-0 rounded-r w-10 h-full flex items-center justify-center bg-gray-100 border text-gray-600">
                                        <i class="far fa-search"></i>
                                    </a>
                                </div>
                            </div>
                            @include('admin.layouts.livewire_loading',['target'=>'searchCategories'])


                            <div class="grid grid-cols-12 gap-6 mt-5">

                                @if (isset($category_search_list) and count($category_search_list) > 0)
                                @foreach($category_search_list as $key_category_search => $value_category_search)
                                <div class="flex col-span-6 items-center text-gray-700 mt-2">
                                    <input type="checkbox" class="form-control border mr-2" wire:key="{{$key_category_search}}" value="{{$key_category_search}}" id="{{$key_category_search}}" wire:model.defer="new_categories" {{--                                                   @if (isset($categories[$key_category_search]))--}} {{--                                                       {{ dd(isset($categories[$key_category_search]),$categories,$key_category_search,$value_category_search) }}--}} {{--                                                   checked--}} {{--                                                   @endif--}}>
                                    <label class="cursor-pointer select-none" for="{{$key_category_search}}"> {{$value_category_search}}</label>
                                </div>

                                @endforeach

                                @endif
                            </div>

                            @error('categories')
                            <div class="text-theme-6 mt-2">{{ $message }}</div>
                            @enderror

                            <div class="mt-3">
                                <div class="flex flex-col sm:flex-row mt-2">
                                    <div class="flex items-center text-gray-700 mr-2">
                                        <input type="checkbox" class="form-check-input mr-1 ml-1" id="connect_parent_categories" name="connect_parent_categories" wire:model="connect_parent_categories" value="1">
                                        <p>اتصال دسته بندی های بالاتر</p>

                                    </div>
                                </div>
                                @error('connect_parent_categories')
                                <div class="text-theme-6 mt-2">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="mt-3">
                            <label>وضعیت</label>
                            <div class="flex flex-col sm:flex-row mt-2">
                                <div class="flex items-center text-gray-700 mr-2">
                                    <input type="radio" class="form-check-input mr-1 ml-1" id="status_true" name="status" wire:model="status" value="1">
                                    <label class="cursor-pointer select-none" for="status_true">فعال</label>
                                </div>
                                <div class="flex items-center text-gray-700 mr-2">
                                    <input type="radio" class="form-check-input mr-1 ml-1" id="status_false" name="status" wire:model="status" value="0">
                                    <label class="cursor-pointer select-none" for="enamad_false">غیرفعال</label>
                                </div>
                            </div>
                            @error('status')
                            <div class="text-theme-6 mt-2">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>

            </div>
            <div class="intro-y col-span-12 lg:col-span-6">
                <div class="intro-y box">
                    <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200">
                        <h2 class="font-medium text-base ml-auto">
                            تصویر
                        </h2>
                    </div>
                    <div class="p-5">

                        <div class="mt-3">
                            <label for="image">تصویر</label>

                            <div class="border border-gray-200 rounded-md p-5 mt-4">
                                <div class="w-20 h-20 relative image-fit cursor-pointer zoom-in mx-auto">
                                    <img class="rounded-md" alt="" src="{!! $image && $image->temporaryUrl() ? $image->temporaryUrl() : $this->image_url !!}">
                                </div>
                                <div class="w-40 mx-auto cursor-pointer relative mt-5">
                                    <button type="button" class="button w-full bg-theme-1 text-white">انتخاب</button>
                                    <input wire:model="image" type="file" class="w-full h-full top-0 left-0 absolute opacity-0">
                                </div>

                                <div class="mt-3">
                                    <label for="slug">لینک تصویر (برای تغییر تصویر لینک آن را جایگذاری کنید)</label>
                                    <input type="text" class="form-control w-full border mt-2" id="slug" wire:model="image_url">
                                </div>
                            </div>

                            @error('image')
                            <div class="text-theme-6 mt-2">{{ $message }}</div> @enderror
                        </div>

                    </div>
                </div>

            </div>

            <div class="intro-y col-span-12 lg:col-span-12">
                <div class="intro-y box">
                    <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200">
                        <h2 class="font-medium text-base ml-auto">
                            توضیحات
                        </h2>
                    </div>
                    <div class="p-5">
                        <div class="mt-3">
                            <label for="description">توضیحات</label>
                            <textarea class="summernote w-full px-3 py-2 text-gray-700 border rounded-lg focus:outline-none  @error('description') border-theme-6 @enderror" rows="4" id="description" placeholder="توضیحات" wire:model="description"></textarea>

                            @error('description')
                            <div class="text-theme-6 mt-2">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>

            </div>

        </div>
        <div class="text-center mt-5">
            <a href="{{ route('admin.products.index') }}" class="btn btn-danger w-24 border text-white-700 mr-1 ml-2">لغو</a>
            <button type="submit" class="btn btn-success w-24 text-white">ذخیره</button>
        </div>


    </form>
</div>
