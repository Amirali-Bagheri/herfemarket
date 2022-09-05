<div>
    @include('admin.layouts.tinymce',['value'=>'body'])

    <form wire:submit.prevent="submit">
        @include('admin.layouts.livewire_loading',['target'=>'submit'])

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
                            <input type="text"
                                   class="form-control w-full border mt-2 @error('title') border-theme-6 @enderror"
                                   id="title" placeholder="عنوان"
                                   wire:model.defer="title">
                            @error('title')
                            <div class="text-theme-6 mt-2">{{ $message }}</div> @enderror
                        </div>

                        <div class="mt-3">
                            <label for="slug">نام نمایشی</label>
                            <input type="text"
                                   class="form-control w-full border mt-2 @error('slug') border-theme-6 @enderror"
                                   id="slug" placeholder="نام نمایشی"
                                   wire:model.defer="slug">
                            @error('slug')
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
                                           wire:model.defer="status" value="1">
                                    <label class="cursor-pointer select-none mr-1 ml-1" for="status_true">فعال</label>
                                </div>
                                <div class="flex items-center text-gray-700 mr-2">
                                    <input type="radio" class="form-check-input mr-1 ml-1" id="status_false"
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
                            <label>کلیدواژه ها</label>
                            <textarea wire:model.defer="keywords"
                                      class="w-full px-3 py-2 text-gray-700 border rounded-lg focus:outline-none">

                            </textarea>
                            @error('keywords')
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

                <div class="intro-y box">
                    <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200">
                        <h2 class="font-medium text-base ml-auto">
                            متن
                        </h2>
                    </div>
                    <div class="p-5">
                        <div class="mt-3" wire:ignore>
                            <label for="body">توضیحات</label>
                            <textarea
                                data-feature="all"
                                class="w-full px-3 py-2 text-gray-700 border rounded-lg focus:outline-none tinymce @error('body') border-theme-6 @enderror"
                                rows="4"
                                id="body"
                                placeholder="توضیحات"
                                wire:model.defer="body"
                            ></textarea>
                            @error('body')
                            <div class="text-theme-6 mt-2">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="text-center mt-5">
            <a href="{{ route('admin.pages.index') }}"
               class="btn btn-danger w-24 border text-white-700 mr-1 ml-2">خروج</a>
            <button type="submit" class="btn btn-primary w-24 text-white">ذخیره</button>
        </div>

    </form>
</div>
