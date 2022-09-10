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
                            <label for="first_name">نام</label>
                            <input type="text"
                                   class="form-control w-full border mt-2 @error('first_name') border-theme-6 @enderror"
                                   id="first_name" placeholder="نام"
                                   wire:model.debounce.500ms="first_name">
                            @error('first_name')
                            <div class="text-theme-6 mt-2">{{ $message }}</div> @enderror
                        </div>

                        <div class="mt-3">
                            <label for="last_name">نام خانوادگی</label>
                            <input type="text"
                                   class="form-control w-full border mt-2 @error('last_name') border-theme-6 @enderror"
                                   id="last_name" placeholder="نام خانوادگی"
                                   wire:model.debounce.500ms="last_name">
                            @error('last_name')
                            <div class="text-theme-6 mt-2">{{ $message }}</div> @enderror
                        </div>

                    </div>
                </div>

                <div class="intro-y box">
                    <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200">
                        <h2 class="font-medium text-base ml-auto">
                            اطلاعات اختیاری
                        </h2>
                    </div>
                    <div class="p-5">
                        {{--                    <div>--}}
                        {{--                        <label for="first_name">تاریخ تولد</label>--}}
                        {{--                        <select style="width: 100px;" name="birth-day" class="form-control ">--}}
                        {{--                            <option value="{{old('birth-day')}}">{{old('birth-day','روز')}}</option>--}}
                        {{--                            @for($i = 1; $i <= 31; $i++) <option value="{{$i}}">{{$i}}</option>--}}
                        {{--                            @endfor--}}
                        {{--                        </select>--}}
                        {{--                        <select style="width: 100px;" name="birth-month" class="form-control ">--}}
                        {{--                            <option value="{{old('birth-month')}}">{{old('birth-month','ماه')}}</option>--}}
                        {{--                            @for($i = 1; $i <= 12; $i++) <option value="{{$i}}">{{verta()->month($i)->format('F')}}--}}
                        {{--                            </option>--}}
                        {{--                            @endfor--}}
                        {{--                        </select>--}}
                        {{--                        <select style="width: 100px;" name="birth-year" class="form-control ">--}}
                        {{--                            <option value="{{old('birth-year')}}">{{old('birth-year','سال')}}</option>--}}
                        {{--                            @for($i = verta()->year; $i >= verta()->subYears(100)->year; $i--)--}}
                        {{--                                <option value="{{$i}}">{{$i}}</option>--}}
                        {{--                            @endfor--}}
                        {{--                        </select>--}}
                        {{--                        @error('first_name')--}}
                        {{--                        <div class="text-theme-6 mt-2">{{ $message }}</div> @enderror--}}
                        {{--                    </div>--}}

                        <div class="mt-3">
                            <label for="avatar">آواتار</label>

                            <div class="border border-gray-200 rounded-md p-5 mt-4">
                                <div class="w-20 h-20 relative image-fit cursor-pointer zoom-in mx-auto">
                                    <img class="rounded-md" alt=""
                                         src="{{ $avatar ? $avatar->temporaryUrl() : '\uploads\avatars\avatar.png' }}">
                                </div>
                                <div class="w-40 mx-auto cursor-pointer relative mt-5">
                                    <button type="button" class="button w-full bg-theme-1 text-white">انتخاب</button>
                                    <input wire:model.debounce.500ms="avatar" type="file"
                                           class="w-full h-full top-0 left-0 absolute opacity-0">
                                </div>
                            </div>

                            @error('avatar')
                            <div class="text-theme-6 mt-2">{{ $message }}</div> @enderror
                        </div>

                    </div>
                </div>

            </div>

            <div class="intro-y col-span-12 lg:col-span-6">

                <div class="intro-y box">
                    <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200">
                        <h2 class="font-medium text-base ml-auto">
                            اطلاعات تماس
                        </h2>
                    </div>
                    <div class="p-5">
                        <div class="mt">
                            <label for="mobile">تلفن همراه</label>
                            <input type="text"
                                   class="form-control w-full border mt-2 @error('mobile') border-theme-6 @enderror"
                                   id="mobile" placeholder="تلفن همراه"
                                   wire:model.debounce.500ms="mobile">
                            @error('mobile')
                            <div class="text-theme-6 mt-2">{{ $message }}</div> @enderror
                        </div>
                        <div class="mt-3">
                            <input wire:model.debounce.500ms="mobile_approve" type="checkbox" class="form-control border ml-2"
                                   id="mobile_approve">
                            <label class="cursor-pointer select-none mr-1 ml-1" for="mobile_approve">تایید تلفن</label>
                            @error('mobile_approve')
                            <div class="text-theme-6 mt-2">{{ $message }}</div> @enderror
                        </div>

                        <div class="mt-5">
                            <label for="email">پست الکترونیکی</label>
                            <input type="text"
                                   class="form-control w-full border mt-2 @error('email') border-theme-6 @enderror"
                                   id="email" placeholder="پست الکترونیکی"
                                   wire:model.debounce.500ms="email">
                            @error('email')
                            <div class="text-theme-6 mt-2">{{ $message }}</div> @enderror
                        </div>
                        <div class="mt-3">
                            <input wire:model.debounce.500ms="newsletter_subscribe" type="checkbox"
                                   class="form-control border ml-2"
                                   id="newsletter_subscribe">
                            <label class="cursor-pointer select-none mr-1 ml-1" for="newsletter_subscribe">عضویت در
                                خبرنامه</label>
                            @error('newsletter_subscribe')
                            <div class="text-theme-6 mt-2">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>

                <div class="intro-y box mt-5">
                    <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200">
                        <h2 class="font-medium text-base ml-auto">
                            اطلاعات امنیتی
                        </h2>
                    </div>
                    <div class="p-5">
                        <div class="mt">
                            <label>نقش کاربری</label>
                            <select name="roles[]" wire:model.debounce.500ms="roles"
                                    class="form-control border mr-2 w-full" multiple>

                                @foreach (\Modules\Acl\Entities\Role::all() as $role)
                                    <option value="{{$role->name}}">{{$role->title}}</option>
                                @endforeach
                            </select>

                            @error('roles')
                            <div class="text-theme-6 mt-2">{{ $message }}</div> @enderror
                        </div>

                        <div class="mt-5">
                            <label for="password">{{ __("Password") }}</label>
                            <input type="password"
                                   class="form-control w-full border mt-2 @error('password') border-theme-6 @enderror"
                                   id="password" placeholder="{{ __("Password") }}"
                                   wire:model.debounce.500ms="password">

                            @error('password')
                            <div class="text-theme-6 mt-2">{{ $message }}</div> @enderror
                        </div>

                        <div class="mt-3">
                            <label for="password_confirmation">تایید {{ __("Password") }}</label>
                            <input type="password"
                                   class="form-control w-full border mt-2 @error('password_confirmation') border-theme-6 @enderror"
                                   id="password_confirmation" placeholder="تکرار {{ __("Password") }}"
                                   wire:model.debounce.500ms="password_confirmation">

                            @error('password_confirmation')
                            <div class="text-theme-6 mt-2">{{ $message }}</div> @enderror
                        </div>
                        <div class="mt-3">
                            <label>وضعیت</label>
                            <div class="flex flex-col sm:flex-row mt-2">
                                <div class="flex items-center text-gray-700 mr-2">
                                    <input type="radio" class="form-check-input mr-1 ml-1" id="status_true" name="status"
                                           wire:model.debounce.500ms="status" value="1">
                                    <label class="cursor-pointer select-none mr-1 ml-1" for="status_true">فعال</label>
                                </div>
                                <div class="flex items-center text-gray-700 mr-2">
                                    <input type="radio" class="form-check-input mr-1 ml-1" id="status_false" name="status"
                                           wire:model.debounce.500ms="status" value="0">
                                    <label class="cursor-pointer select-none mr-1 ml-1" for="status_false">غیرفعال</label>
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
            <a href="{{ route('admin.users.index') }}" class="btn btn-danger w-24 border text-white-700 mr-1 ml-2">خروج</a>
            <button type="submit" class="btn btn-primary w-24 text-white">ذخیره</button>
        </div>
    </form>

</div>
