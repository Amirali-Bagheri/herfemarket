<div>

    <form wire:submit.prevent="submit">
        @include('admin.layouts.livewire_loading',['target'=>'submit'])
        {{--        @include('admin.layouts.tinymce')--}}

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
                            <label for="name">عنوان</label>
                            <input type="text"
                                   class="form-control w-full border mt-2 @error('name') border-theme-6 @enderror"
                                   id="name" placeholder="عنوان"
                                   wire:model.defer="name">
                            @error('name')
                            <div class="text-theme-6 mt-2">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="p-5">
                        <div class="mt-3">
                            <label for="link">لینک</label>
                            <input type="text"
                                   class="form-control w-full border mt-2 @error('link') border-theme-6 @enderror"
                                   id="link" placeholder="لینک"
                                   wire:model.defer="link">
                            @error('link')
                            <div class="text-theme-6 mt-2">{{ $message }}</div> @enderror
                        </div>

                    </div>
                    <div class="p-5">
                        <div class="mt-3">
                            <label for="sort_id">ترتیب نمایش</label>
                            <input class="form-control w-full border mt-2 @error('sort_id') border-theme-6 @enderror"
                                   type="number"
                                   name="sort_id" wire:model.defer="sort_id"
                                   value="{{ old('sort_id',$sub_menu->sort_id ?? null) }}">

                            @error('sort_id')
                            <div class="text-theme-6 mt-2">{{ $message }}</div> @enderror
                        </div>

                    </div>
                    <div class="p-5">
                        <div class="mt-3">
                            <label>مادر:</label>
                            <select wire:model.defer="parent_id"
                                    class="form-control w-full border mt-2 @error('parent_id') border-theme-6 @enderror">
                                <option
                                    {{ isset($sub_menu) and $sub_menu->parent_id == 0 ? 'selected' : '' }} value="0">
                                    انتخاب
                                    کنید
                                </option>

                                @foreach($sub_menus as $sub_menu_item)
                                    <option
                                        {{ isset($sub_menu) and old('parent_id',$sub_menu_item->id ?? null) == $sub_menu->id ? 'selected' : '' }} value="{{$sub_menu_item->id}}">{{$sub_menu_item->name}}</option>

                                @endforeach
                            </select>
                            @error('parent_id')
                            <div class="text-theme-6 mt-2">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="mt-3 p-5">
                        <div class="mt-3">
                            <label>نقش کاربری:</label>
                            <select wire:model.defer="role"
                                    class="form-control w-full border mt-2 @error('role') border-theme-6 @enderror">
                                <option
                                    value="">
                                    انتخاب
                                    کنید
                                </option>

                                @foreach(\Modules\Acl\Entities\Role::all() as $role)
                                    <option value="{{$role->name}}">{{$role->title}}</option>
                                @endforeach
                            </select>
                            @error('role')
                            <div class="text-theme-6 mt-2">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>

            </div>
            <div class="intro-y col-span-12 lg:col-span-6">
                <div class="intro-y box">
                    <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200">
                        <h2 class="font-medium text-base ml-auto">
                            جزئیات
                        </h2>
                    </div>
                    <div class="p-5">
                        <div class="mt-3">
                            <label>وضعیت</label>
                            <div class="flex flex-col sm:flex-row mt-2">
                                <div class="flex items-center text-gray-700 mr-2">
                                    <input type="radio" class="form-check-input mr-1 ml-1" id="status_true"
                                           name="status"
                                           wire:model.defer="status" value="1">
                                    <label class="cursor-pointer select-none mr-1 ml-1" for="status_true">فعال</label>
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

                    <div class="p-5">
                        <div class="mt-3">
                            <label>زبان</label>
                            <select wire:model.defer="language"
                                    class="form-control w-full border mt-2 @error('language') border-theme-6 @enderror">
                                <option value="fa">فارسی</option>
                                <option value="en">انگلیسی</option>
                                <option value="ar">عربی</option>
                                <option value="tr">ترکی</option>
                            </select>
                            @error('language')
                            <div class="text-theme-6 mt-2">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="p-5">
                        <div class="mt-3">
                            <label for="icon">آیکون</label>
                            <input type="text"
                                   class="form-control w-full border mt-2 @error('icon') border-theme-6 @enderror"
                                   id="icon" placeholder="آیکون"
                                   wire:model.defer="icon">
                            @error('icon')
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
                        <div class="mt-3" wire:ignore>
                            <label for="description">توضیحات</label>
                            <textarea
                                data-feature="all"
                                class="w-full px-3 py-2 text-gray-700 border rounded-lg focus:outline-none @error('description') border-theme-6 @enderror"
                                rows="4"
                                id="description"
                                placeholder="توضیحات"
                                wire:model.defer="description"
                            ></textarea>

                            @error('description')
                            <div class="text-theme-6 mt-2">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="text-center mt-5">
            <a href="{{ route('admin.menus.index') }}"
               class="btn btn-danger w-24 border text-white-700 mr-1 ml-2">خروج</a>
            <button class="btn btn-primary w-24 text-white">ذخیره</button>
        </div>

    </form>
</div>

