<div>
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
                            <label for="name">نام</label>
                            <input type="text"
                                   class="form-control w-full border mt-2 @error('name') border-theme-6 @enderror"
                                   id="name" placeholder="نام"
                                   wire:model.debounce.500ms="name">
                            @error('name')
                            <div class="text-theme-6 mt-2">{{ $message }}</div> @enderror
                        </div>

                        <div class="mt-3">
                            <label for="slug">نام نمایشی</label>
                            <input type="text"
                                   class="form-control w-full border mt-2 @error('slug') border-theme-6 @enderror"
                                   id="slug" placeholder="نام نمایشی"
                                   wire:model.debounce.500ms="slug">
                            @error('slug')
                            <div class="text-theme-6 mt-2">{{ $message }}</div> @enderror
                        </div>

                        <div class="mt-3">
                            <label for="description">توضیحات</label>
                            <textarea
                                class="w-full px-3 py-2 text-gray-700 border rounded-lg focus:outline-none  @error('description') border-theme-6 @enderror"
                                rows="4"
                                id="description" placeholder="توضیحات"
                                wire:model.debounce.500ms="description"
                            ></textarea>

                            @error('description')
                            <div class="text-theme-6 mt-2">{{ $message }}</div> @enderror
                        </div>


                    </div>
                </div>

                <div class="intro-y box">
                    <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200">
                        <h2 class="font-medium text-base ml-auto">
                            لوگو و شبکه های اجتماعی
                        </h2>
                    </div>
                    <div class="p-5">

                        <div class="mt">
                            <label for="logo">لوگو</label>

                            <div class="border border-gray-200 rounded-md p-5 mt-4">
                                <div class="w-20 h-20 relative image-fit cursor-pointer zoom-in mx-auto">
                                    <img class="rounded-md" alt=""
                                         src="{{ $logo ? $logo->temporaryUrl() : '\uploads\logos\logo-text.png' }}">
                                </div>
                                <div class="w-40 mx-auto cursor-pointer relative mt-5">
                                    <button type="button" class="button w-full bg-theme-1 text-white">انتخاب</button>
                                    <input wire:model.debounce.500ms="logo" type="file"
                                           class="w-full h-full top-0 left-0 absolute opacity-0">
                                </div>
                            </div>

                            @error('logo')
                            <div class="text-theme-6 mt-2">{{ $message }}</div> @enderror
                        </div>

                        <div class="mt-5">
                            <label for="social_telegram">نام کاربری تلگرام</label>
                            <input type="text"
                                   class="form-control w-full border mt-2 @error('social_telegram') border-theme-6 @enderror"
                                   id="social_telegram" placeholder="example"
                                   wire:model.debounce.500ms="social_telegram">
                            @error('social_telegram')
                            <div class="text-theme-6 mt-2">{{ $message }}</div> @enderror
                        </div>
                        <div class="mt-5">
                            <label for="social_instagram">نام کاربری اینستاگرام</label>
                            <input type="text"
                                   class="form-control w-full border mt-2 @error('social_instagram') border-theme-6 @enderror"
                                   id="social_instagram" placeholder="example"
                                   wire:model.debounce.500ms="social_instagram">
                            @error('social_instagram')
                            <div class="text-theme-6 mt-2">{{ $message }}</div> @enderror
                        </div>
                        <div class="mt-5">
                            <label for="social_whatsapp">شماره واتساپ بدون صفر</label>
                            <input type="text"
                                   class="form-control w-full border mt-2 @error('social_whatsapp') border-theme-6 @enderror"
                                   id="social_whatsapp" placeholder="9120000000"
                                   wire:model.debounce.500ms="social_whatsapp">
                            @error('social_whatsapp')
                            <div class="text-theme-6 mt-2">{{ $message }}</div> @enderror
                        </div>
                        <div class="mt-5">
                            <label for="social_twitter">نام کاربری توییتر</label>
                            <input type="text"
                                   class="form-control w-full border mt-2 @error('social_twitter') border-theme-6 @enderror"
                                   id="social_twitter" placeholder="example"
                                   wire:model.debounce.500ms="social_twitter">
                            @error('social_twitter')
                            <div class="text-theme-6 mt-2">{{ $message }}</div> @enderror
                        </div>

                        <div class="mt-5">
                            <label for="social_linkedin">نام کاربری لینکدین</label>
                            <input type="text"
                                   class="form-control w-full border mt-2 @error('social_linkedin') border-theme-6 @enderror"
                                   id="social_linkedin" placeholder="example"
                                   wire:model.debounce.500ms="social_linkedin">
                            @error('social_linkedin')
                            <div class="text-theme-6 mt-2">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>

                <div class="intro-y box">
                    <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200">
                        <h2 class="font-medium text-base ml-auto">
                            موقعیت مکانی

                        </h2>
                    </div>
                    <div class="p-5">
                        <div class="flex item-center">
                            <div>
                                <label for="latitude">عرض جغرافیایی</label>
                                <input type="text"
                                       class="form-control w-full ml-1 border mt-2 @error('latitude') border-theme-6 @enderror"
                                       id="latitude" placeholder="نام نمایشی"
                                       wire:model.debounce.500ms="latitude">
                                @error('latitude')
                                <div class="text-theme-6 mt-2">{{ $message }}</div> @enderror
                            </div>
                            <div>
                                <label for="longitude">طول جغرافیایی</label>
                                <input type="text"
                                       class="form-control w-full border mr-1 mt-2 @error('longitude') border-theme-6 @enderror"
                                       id="longitude" placeholder="نام نمایشی"
                                       wire:model.debounce.500ms="longitude">
                                @error('longitude')
                                <div class="text-theme-6 mt-2">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="mt-3">
                            <label for="address">نشانی</label>
                            <textarea
                                class="w-full px-3 py-2 text-gray-700 border rounded-lg focus:outline-none  @error('address') border-theme-6 @enderror"
                                rows="4"
                                id="address" placeholder="نشانی"
                                wire:model.debounce.500ms="address"
                            ></textarea>

                            @error('address')
                            <div class="text-theme-6 mt-2">{{ $message }}</div> @enderror
                        </div>

                        <div class="flex item-center">
                            <div class="mt-3">
                                <label class="inline-block w-32 font-bold">استان:</label>
                                <select name="state_id" wire:model="state_id"
                                        class="form-control w-full ml-1 border shadow p-2 bg-white  @error('address') border-theme-6 @enderror">
                                    <option value="0">انتخاب کنید</option>
                                    @foreach($states as $state)
                                        <option value={{ $state->id }}>{{ $state->name }}</option>
                                    @endforeach
                                </select>
                                @error('state_id')
                                <div class="text-theme-6 mt-2">{{ $message }}</div> @enderror
                            </div>

                            <div class="mt-3">
                                <label class="inline-block w-32 font-bold">شهر:</label>
                                <select name="city_id" wire:model="city_id"
                                        class="form-control w-full mr-1 border  @error('address') border-theme-6 @enderror">

                                    <option value="0">انتخاب کنید</option>
                                    @foreach($cities as $city)
                                        <option value={{ $city->id }}>{{ $city->name }}</option>
                                    @endforeach
                                </select>
                                @error('city_id')
                                <div class="text-theme-6 mt-2">{{ $message }}</div> @enderror
                            </div>

                        </div>

                    </div>
                </div>

            </div>

            <div class="intro-y col-span-12 lg:col-span-6">

                <div class="intro-y box">
                    <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200">
                        <h2 class="font-medium text-base ml-auto">
                            کسب و کار آنلاین
                        </h2>
                    </div>
                    <div class="p-5">

                        <div class="mt-3">
                            <label for="has_enamad">اینماد دارد؟</label>
                            <div class="flex flex-col sm:flex-row mt-2">
                                <div class="flex items-center text-gray-700 mr-2">
                                    <input type="radio" class="form-check-input mr-1 ml-1" id="enamad_true"
                                           name="has_enamad"
                                           wire:model.debounce.500ms="has_enamad" value="1">
                                    <label class="cursor-pointer select-none" for="enamad_true">دارد</label>
                                </div>
                                <div class="flex items-center text-gray-700 mr-2">
                                    <input type="radio" class="form-check-input mr-1 ml-1" id="enamad_false"
                                           name="has_enamad"
                                           wire:model.debounce.500ms="has_enamad" value="0">
                                    <label class="cursor-pointer select-none" for="enamad_false">ندارد</label>
                                </div>


                            </div>
                            @error('has_enamad')
                            <div class="text-theme-6 mt-2">{{ $message }}</div> @enderror
                        </div>
                        <div class="mt-3">
                            <label for="marketer_mobile">تلفن همراه بازاریاب</label>
                            <input type="text"
                                   class="form-control w-full border mt-2 @error('marketer_mobile') border-theme-6 @enderror"
                                   id="marketer_mobile" placeholder="شماره تلفن همراه بازایاب"
                                   wire:model="marketer_mobile">
                            @error('marketer_mobile')
                            <div class="text-theme-6 mt-2">{{ $message }}</div> @enderror
                        </div>
                        <div class="mt-3">
                            <label for="special_status">کسب و کار ویژه</label>
                            <div class="flex flex-col sm:flex-row mt-2">
                                <div class="flex items-center text-gray-700 mr-2">
                                    <input type="radio" class="form-check-input mr-1 ml-1" id="enamad_true"
                                           name="special_status"
                                           wire:model="special_status" value="1">
                                    <label class="cursor-pointer select-none" for="enamad_true">هست</label>
                                </div>
                                <div class="flex items-center text-gray-700 mr-2">
                                    <input type="radio" class="form-check-input mr-1 ml-1" id="enamad_false"
                                           name="special_status"
                                           wire:model="special_status" value="0">
                                    <label class="cursor-pointer select-none" for="enamad_false">نیست</label>
                                </div>


                            </div>
                            @error('special_status')
                            <div class="text-theme-6 mt-2">{{ $message }}</div> @enderror
                        </div>
                        @if ($this->special_status)
                            <div class="mt-3">
                                <label for="special_type">نوع ویژه</label>
                                <select name="special_type" wire:model="special_type"
                                        class="form-control border mr-2 w-full">
                                    <option value="0">انتخاب کنید</option>

                                    <option value="no_visit_withdraw">عدم دریافت کارمزد بازدید</option>
                                </select>
                                @error('special_type')
                                <div class="text-theme-6 mt-2">{{ $message }}</div> @enderror
                            </div>
                        @endif

                    </div>
                </div>

                <div class="intro-y box mt-5">
                    <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200">
                        <h2 class="font-medium text-base ml-auto">
                            اطلاعات تماس
                        </h2>
                    </div>
                    <div class="p-5">
                        <div class="">
                            <label for="phone">تلفن</label>
                            <input type="text"
                                   class="form-control w-full border mt-2 @error('phone') border-theme-6 @enderror"
                                   id="phone" placeholder="تلفن"
                                   wire:model.debounce.500ms="phone">
                            @error('phone')
                            <div class="text-theme-6 mt-2">{{ $message }}</div> @enderror
                        </div>
                        <div class="mt-5">
                            <label for="fax">فکس</label>
                            <input type="text"
                                   class="form-control w-full border mt-2 @error('fax') border-theme-6 @enderror"
                                   id="fax" placeholder="فکس"
                                   wire:model.debounce.500ms="fax">
                            @error('fax')
                            <div class="text-theme-6 mt-2">{{ $message }}</div> @enderror
                        </div>
                        <div class="mt-5">
                            <label for="email">پست الکترونیکی</label>
                            <input type="email"
                                   class="form-control w-full border mt-2 @error('email') border-theme-6 @enderror"
                                   id="email" placeholder="پست الکترونیکی"
                                   wire:model.debounce.500ms="email">
                            @error('email')
                            <div class="text-theme-6 mt-2">{{ $message }}</div> @enderror
                        </div>

                        <div class="mt-5">
                            <label for="website">وبسایت</label>
                            <input type="text"
                                   class="form-control w-full border mt-2 @error('website') border-theme-6 @enderror"
                                   id="website" placeholder="example.com"
                                   wire:model.debounce.500ms="website">
                            @error('website')
                            <div class="text-theme-6 mt-2">{{ $message }}</div> @enderror
                        </div>

                    </div>
                </div>

                <div class="intro-y box mt-5">
                    <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200">
                        <h2 class="font-medium text-base ml-auto">
                            نوع و دسته بندی
                        </h2>
                    </div>
                    <div class="p-5">
                        <div class="">
                            <label>نوع کسب و کار</label>
                            <select name="type_id" wire:model.debounce.500ms="type_id"
                                    class="form-control border mr-2 w-full">
                                <option value="0">انتخاب کنید</option>
                                @foreach (\Modules\Business\Entities\BusinessType::all() as $type)
                                    <option value="{{$type->id}}">{{$type->title}}</option>
                                @endforeach
                            </select>

                            @error('type_id')
                            <div class="text-theme-6 mt-2">{{ $message }}</div> @enderror
                        </div>


                        <div class="mt-3">
                            <label>دسته بندی کسب و کار</label>
                            <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
                                <div class="relative mt-2">
                                    <input type="text" class="form-control pr-12 w-full border col-span-4"
                                           placeholder=" جستجو..."
                                           wire:keydown.enter="searchCategories"
                                           wire:model="category_search"
                                    >
                                    <a wire:click="searchCategories" href="javascript:void(0)"
                                       class="absolute top-0 right-0 rounded-r w-10 h-full flex items-center justify-center bg-gray-100 border text-gray-600">
                                        <i class="far fa-search"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="text-center items-center" wire:loading wire:target="searchCategories">
                                <svg width="20" viewBox="0 0 38 38" xmlns="http://www.w3.org/2000/svg"
                                     class="w-8 h-8">
                                    <defs>
                                        <linearGradient x1="8.042%" y1="0%" x2="65.682%" y2="23.865%" id="a">
                                            <stop stop-color="rgb(45, 55, 72)" stop-opacity="0" offset="0%"></stop>
                                            <stop stop-color="rgb(45, 55, 72)" stop-opacity=".631"
                                                  offset="63.146%"></stop>
                                            <stop stop-color="rgb(45, 55, 72)" offset="100%"></stop>
                                        </linearGradient>
                                    </defs>
                                    <g fill="none" fill-rule="evenodd">
                                        <g transform="translate(1 1)">
                                            <path d="M36 18c0-9.94-8.06-18-18-18" id="Oval-2" stroke="url(#a)"
                                                  stroke-width="3">
                                                <animateTransform attributeName="transform" type="rotate"
                                                                  from="0 18 18"
                                                                  to="360 18 18" dur="0.9s"
                                                                  repeatCount="indefinite"></animateTransform>
                                            </path>
                                            <circle fill="rgb(45, 55, 72)" cx="36" cy="18" r="1">
                                                <animateTransform attributeName="transform" type="rotate"
                                                                  from="0 18 18"
                                                                  to="360 18 18" dur="0.9s"
                                                                  repeatCount="indefinite"></animateTransform>
                                            </circle>
                                        </g>
                                    </g>
                                </svg>
                            </div>

                            <div class="grid grid-cols-12 gap-6 mt-5">

                                @if (count($category_search_list) > 0)
                                    @foreach(\Modules\Category\Entities\Category::whereIn('id',$category_search_list )->get() as $category)
                                        <div class="flex col-span-6 items-center text-gray-700 mt-2">
                                            <input type="checkbox" class="form-control border mr-2"
                                                   id="{{$category->id}}"

                                                   wire:model="categories"

                                                   value="{{$category->id}}">
                                            <label class="cursor-pointer select-none"
                                                   for="{{$category->id}}"> {{$category->title}}</label>
                                        </div>

                                    @endforeach

                                @endif
                            </div>

                            @error('categories')
                            <div class="text-theme-6 mt-2">{{ $message }}</div> @enderror
                            {{--                            <select name="category_parent" wire:model.debounce.500ms="category_parent"--}}
                            {{--                                    class="form-control border mr-2 w-full">--}}
                            {{--                                <option value="0">انتخاب کنید</option>--}}
                            {{--                                @foreach (\Modules\Category\Entities\Category::active()->where('parent_id',0)->orderBy('title')->get() as $category)--}}
                            {{--                                    <option value="{{$category->id}}">{{$category->title}}</option>--}}
                            {{--                                @endforeach--}}
                            {{--                            </select>--}}

                            {{--                            @error('category_parent')--}}
                            {{--                            <div class="text-theme-6 mt-2">{{ $message }}</div> @enderror--}}
                        </div>

                    </div>
                </div>


                <div class="intro-y box mt-5">
                    <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200">
                        <h2 class="font-medium text-base ml-auto">
                            مدیر و وضعیت
                        </h2>
                    </div>
                    <div class="p-5">
                        <div class="">
                            <label>مدیر کسب و کار</label>
                            <select name="manager_id" wire:model.debounce.500ms="manager_id"
                                    class="form-control border mr-2 w-full">
                                <option value="0">انتخاب کنید</option>
                                @foreach (\Modules\User\Entities\User::all() as $user)
                                    <option value="{{$user->id}}">{{$user->full_name}}</option>
                                @endforeach
                            </select>

                            @error('manager_id')
                            <div class="text-theme-6 mt-2">{{ $message }}</div> @enderror
                        </div>


                        <div class="mt-3">
                            <label>وضعیت</label>
                            <div class="flex flex-col sm:flex-row mt-2">
                                <div class="flex items-center text-gray-700 mr-2">
                                    <input type="radio" class="form-check-input mr-1 ml-1" id="status_true"
                                           name="status"
                                           wire:model.debounce.500ms="status" value="1">
                                    <label class="cursor-pointer select-none" for="status_true">فعال</label>
                                </div>
                                <div class="flex items-center text-gray-700 mr-2">
                                    <input type="radio" class="form-check-input mr-1 ml-1" id="status_false"
                                           name="status"
                                           wire:model.debounce.500ms="status" value="0">
                                    <label class="cursor-pointer select-none" for="enamad_false">غیرفعال</label>
                                </div>
                            </div>
                            @error('status')
                            <div class="text-theme-6 mt-2">{{ $message }}</div> @enderror
                        </div>

                    </div>
                </div>

            </div>

        </div>
        <div class="text-center mt-5">
            <a href="{{ route('admin.businesses.index') }}" class="btn btn-danger w-24 border text-white-700 mr-1 ml-2">لغو</a>
            <button type="submit" class="btn btn-primary w-24 text-white">ذخیره</button>
        </div>
    </form>

</div>
