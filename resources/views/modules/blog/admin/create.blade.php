<div>
    @include('admin.layouts.tinymce',['value'=>'body'])

    <script>
        document.addEventListener('livewire:load', function () {

            $('#tags').select2({
                tags: true,
                tokenSeparators: [',', ' '],
            });
        });
    </script>
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

                        <div class="mt-3">
                            <label>وضعیت دیدگاه</label>
                            <div class="flex flex-col sm:flex-row mt-2">
                                <div class="flex items-center text-gray-700 mr-2">
                                    <input type="radio" class="form-check-input mr-1 ml-1" id="comment_status_true"
                                           name="comment_status"
                                           wire:model.defer="comment_status" value="1">
                                    <label class="cursor-pointer select-none mr-1 ml-1"
                                           for="comment_status_true">فعال</label>
                                </div>
                                <div class="flex items-center text-gray-700 mr-2">
                                    <input type="radio" class="form-check-input mr-1 ml-1" id="comment_status_false"
                                           name="comment_status"
                                           wire:model.defer="comment_status" value="0">
                                    <label class="cursor-pointer select-none mr-1 ml-1" for="comment_status_false">غیرفعال</label>
                                </div>
                            </div>
                            @error('comment_status')
                            <div class="text-theme-6 mt-2">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="p-5">
                        <div class="mt-3" wire:ignore.self>
                            <label>تصویر</label>
                            <input wire:model.defer="image" type="file">

                            @if ($image)
                                پیشنمایش:
                                <img src="{{ $image->temporaryUrl() }}">
                            @endif


                            @error('image')
                            <div class="text-theme-6 mt-2">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="p-5">
                        <div class="mt-3">
                            <label>کلیدواژه ها</label>
                            <textarea
                                data-feature="all"
                                class="w-full px-3 py-2 text-gray-700 border rounded-lg focus:outline-none @error('keywords') border-theme-6 @enderror"
                                rows="4"
                                placeholder="توضیحات"
                                wire:model.defer="keywords"
                            ></textarea>

                            @error('keywords')
                            <div class="text-theme-6 mt-2">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="p-5">
                        <div class="mt-3">

                            <label>برچسب ها (با , جدا کنید)</label>
                            <textarea
                                data-feature="all"
                                class="w-full px-3 py-2 text-gray-700 border rounded-lg focus:outline-none @error('tags') border-theme-6 @enderror"
                                rows="4"
                                placeholder="برچسب ها"
                                wire:model.defer="tags"
                            ></textarea>

                            {{--                            <select name="tags[]" id="tags" class="form-control select2 w-full" wire:model="tags"--}}
                            {{--                                    multiple="multiple">--}}
                            {{--                                <option value="0">برچسب را بنویسید و اینتر بزنید</option>--}}

                            {{--                            </select>--}}
                            @error('tags')
                            <div class="text-theme-6 mt-2">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="p-5">
                        <div class="mt-3" wire:ignore>

                            <label>دسته بندی ها</label>

                            <select name="categories[]" id="categories" class="form-control select2 w-full"
                                    wire:model="categories" multiple="multiple">
                                <option value="0">دسته بندی را انتخاب کنید</option>
                                @foreach($categories_list as $key => $category)
                                    <option value="{{ $key }}"> {{ $category }} </option>
                                @endforeach
                            </select>

                            @error('categories')
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
            <a href="{{ route('admin.categories.index') }}" class="btn btn-danger w-24 border text-white-700 mr-1 ml-2">خروج</a>
            <button type="submit" class="btn btn-primary w-24 text-white">ذخیره</button>
        </div>

    </form>
</div>


