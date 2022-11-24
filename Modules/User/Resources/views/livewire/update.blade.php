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
                        <div class="">
                            <label for="first_name">نام</label>

                            <input type="text"
                                   class="form-control w-full border mt-2 @error('first_name') border-theme-6 @enderror"
                                   id="first_name" placeholder="نام"
                                   wire:model.defer="first_name">

                            @error('first_name')
                            <div class="text-theme-6 mt-2">{{ $message }}</div> @enderror
                        </div>

                        <div class="mt-3">
                            <label for="last_name">نام خانوادگی</label>
                            <input type="text"
                                   class="form-control w-full border mt-2 @error('last_name') border-theme-6 @enderror"
                                   id="last_name" placeholder="نام خانوادگی"
                                   wire:model.defer="last_name">
                            @error('last_name')
                            <div class="text-theme-6 mt-2">{{ $message }}</div> @enderror
                        </div>
                        {{--                        <div class="mt-3">--}}
                        {{--                            <label for="last_name">نام و نام خانوادگی</label>--}}
                        {{--                            <input type="text"--}}
                        {{--                                   class="form-control w-full border mt-2 @error('name') border-theme-6 @enderror"--}}
                        {{--                                   id="name" placeholder="نام"--}}
                        {{--                                   wire:model.defer="name">--}}
                        {{--                            @error('name')--}}
                        {{--                            <div class="text-theme-6 mt-2">{{ $message }}</div> @enderror--}}
                        {{--                        </div>--}}
                        {{--                    </div>--}}
                    </div>

                    <div class="intro-y box">
                        <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200">
                            <h2 class="font-medium text-base ml-auto">
                                اطلاعات اختیاری
                            </h2>
                        </div>
                        <div class="p-5">
                            <div>
                                <label for="avatar">آواتار</label>

                                <div class="border border-gray-200 rounded-md p-5 mt-4">
                                    <div class="w-20 h-20 relative image-fit cursor-pointer zoom-in mx-auto">
                                        <img class="rounded-md" alt=""
                                             src="{{ $avatar && $avatar->temporaryUrl() ? $avatar->temporaryUrl() : (isset($user) ? $user->avatar_url : '/uploads/avatars/avatar.png') }}">
                                    </div>
                                    <div class="w-40 mx-auto cursor-pointer relative mt-5">
                                        <button type="button" class="button w-full bg-theme-1 text-white">انتخاب
                                        </button>
                                        <input wire:model.defer="avatar" type="file"
                                               class="w-full h-full top-0 left-0 absolute opacity-0">
                                    </div>
                                </div>

                                @error('avatar')
                                <div class="text-theme-6 mt-2">{{ $message }}</div> @enderror
                            </div>

                        </div>
                    </div>

                    {{--                <div class="intro-y box">--}}
                    {{--                    <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200">--}}
                    {{--                        <h2 class="font-medium text-base ml-auto">--}}
                    {{--                            تعرفه و پلن--}}
                    {{--                        </h2>--}}
                    {{--                    </div>--}}
                    {{--                    <div class="p-5">--}}
                    {{--                        <div wire:ignore>--}}
                    {{--                            <label for="morph_items">--}}
                    {{--                                پلن--}}
                    {{--                            </label>--}}

                    {{--                            <select  wire:ignore.self--}}
                    {{--                                    class="tom-select w-full" wire:model.defer="plan_id">--}}
                    {{--                                <option value="0" disabled>پلن ها</option>--}}
                    {{--                                @foreach (\Modules\Plan\Entities\Plan::all() as $plan)--}}
                    {{--                                    <option value="{{$plan->id}}">{{$plan->name}}</option>--}}
                    {{--                                @endforeach--}}
                    {{--                            </select>--}}

                    {{--                            @error('plan_id')--}}
                    {{--                            <div class="text-theme-6 mt-2">{{ $message }}</div>--}}
                    {{--                            @enderror--}}
                    {{--                        </div>--}}
                    {{--                    </div>--}}
                    {{--                </div>--}}

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
                                   wire:model.defer="mobile">
                            @error('mobile')
                            <div class="text-theme-6 mt-2">{{ $message }}</div> @enderror
                        </div>
                        <div class="mt-3">
                            <input wire:model.defer="mobile_approve" type="checkbox"
                                   {{--                                   class="form-control border ml-2"--}}
                                   id="mobile_approve">
                            <label class="cursor-pointer select-none mr-1 ml-1" for="mobile_approve">تایید تلفن</label>
                            @error('mobile_approve')
                            <div class="text-theme-6 mt-2">{{ $message }}</div> @enderror
                        </div>

                        <div class="mt-5">
                            <label for="email">پست الکترونیکی</label>
                            <input type="text"
                                   class="form-control w-full border mt-2 @error('email') border-theme-6 @enderror"
                                   {{--                                   id="email" --}}
                                   placeholder="پست الکترونیکی"
                                   wire:model.defer="email">
                            @error('email')
                            <div class="text-theme-6 mt-2">{{ $message }}</div> @enderror
                        </div>
                        <div class="mt-3">
                            <input wire:model.defer="newsletter_subscribe" type="checkbox"
                                   {{--                                   class="form-check-input mr-2"--}}
                                   id="newsletter_subscribe">

                            <label for="newsletter_subscribe">عضویت در
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
                        <div class="mt" wire:ignore>
                            <label>نقش کاربری</label>
                            <select name="roles[]" wire:model.defer="roles"
                                    class="tom-select w-full" multiple>

                                @foreach (\Modules\Acl\Entities\Role::all() as $role)
                                    <option @if (isset($user) and $user->hasRole($role->name))
                                            selected
                                            @endif value="{{$role->name}}">{{$role->title}}</option>
                                @endforeach
                            </select>

                            @error('roles')
                            <div class="text-theme-6 mt-2">{{ $message }}</div> @enderror
                        </div>

                        <div class="mt-5">
                            <label for="password">رمز عبور</label>
                            <input type="password"
                                   class="form-control w-full border mt-2 @error('password') border-theme-6 @enderror"
                                   {{--                                   id="password" --}}
                                   placeholder="رمز عبور"
                                   wire:model.defer="password">

                            @error('password')
                            <div class="text-theme-6 mt-2">{{ $message }}</div> @enderror
                        </div>

                        <div class="mt-3">
                            <label for="password_confirmation">تایید رمز عبور</label>
                            <input type="password"
                                   class="form-control w-full border mt-2 @error('password_confirmation') border-theme-6 @enderror"
                                   id="password_confirmation" placeholder="تکرار رمز عبور"
                                   wire:model.defer="password_confirmation">

                            @error('password_confirmation')
                            <div class="text-theme-6 mt-2">{{ $message }}</div> @enderror
                        </div>
                        <div class="mt-3">
                            <label>وضعیت</label>
                            <div class="flex flex-col sm:flex-row mt-2">
                                <div class="flex items-center text-gray-700 mr-2">
                                    <input type="radio" class="form-check-input mr-1 ml-1" id="status_true"
                                           name="status"
                                           wire:model.defer="status" value="1">
                                    <label class="cursor-pointer select-none mr-1 ml-1"
                                           for="status_true">فعال</label>
                                </div>
                                <div class="flex items-center text-gray-700 mr-2">
                                    <input type="radio" class="form-check-input mr-1 ml-1" id="status_false"
                                           name="status"
                                           wire:model.defer="status" value="0">
                                    <label class="cursor-pointer select-none mr-1 ml-1"
                                           for="status_false">غیرفعال</label>
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
            <a href="{{ route('admin.users.index') }}"
               class="btn btn-danger w-24 border text-white-700 mr-1 ml-2">خروج</a>
            <button type="submit" class="btn btn-primary w-24 text-white">ذخیره</button>
        </div>
    </form>

</div>
