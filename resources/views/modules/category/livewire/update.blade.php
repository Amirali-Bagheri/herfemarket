<div>
    @include('admin.layouts.livewire_loading')

    <form>

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

                        <div class="mt-3">
                            <label for="description">توضیحات</label>
                            <textarea
                                class="w-full px-3 py-2 text-gray-700 border rounded-lg focus:outline-none  @error('description') border-theme-6 @enderror"
                                rows="4"
                                id="description" placeholder="توضیحات"
                                wire:model.defer="description"
                            ></textarea>

                            @error('description')
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
                        <div wire:ignore>
                            <label for="parent_id">دسته بندی مادر</label>
                            <select id="parent_id"
                                    class="form-control w-full border  mt-15 @error('parent_id') border-theme-6 @enderror"
                                    wire:model.defer="parent_id"
                                    name="parent_id">
                                <option value="0">اگر این دسته مادر دارد انتخاب کنید</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}"> {{ $category->title }} </option>
                                @endforeach
                            </select>

                            @error('parent_id')
                            <div class="text-theme-6 mt-2">{{ $message }}</div> @enderror

                        </div>

                        <div class="mt-3">
                            <label for="image">تصویر</label>

                            <div class="border border-gray-200 rounded-md p-5 mt-4">
{{--                                <div class="w-20 h-20 relative image-fit cursor-pointer zoom-in mx-auto">--}}
{{--                                                                        @if ($image)--}}
{{--                                                                            <img class="rounded-md" src="{{ $image->temporaryUrl() }}">--}}
{{--                                                                        @else--}}
{{--                                    <img class="rounded-md" src="{{ $image_url }}">--}}
{{--                                                                        @endif--}}
{{--                                </div>--}}
                                <div class="w-40 mx-auto cursor-pointer relative mt-5">
{{--                                    <button type="button" class="button w-full bg-theme-1 text-white">انتخاب</button>--}}
                                    <input wire:model.defer="image" type="file" class="w-full"
{{--                                           class="w-full h-full top-0 left-0 absolute opacity-0"--}}
                                    >
                                </div>
                            </div>

                            @error('image')
                            <div class="text-theme-6 mt-2">{{ $message }}</div> @enderror
                        </div>

                        <div class="mt-3">
                            <label>وضعیت</label>
                            <div class="flex flex-col sm:flex-row mt-2">
                                <div class="flex items-center text-gray-700 mr-2">
                                    <input type="radio" class="form-check-input mr-1 ml-1" id="status_true" name="status"
                                           wire:model.defer="status" value="1">
                                    <label class="cursor-pointer select-none mr-1 ml-1" for="status_true">فعال</label>
                                </div>
                                <div class="flex items-center text-gray-700 mr-2">
                                    <input type="radio" class="form-check-input mr-1 ml-1" id="status_false" name="status"
                                           wire:model.defer="status" value="0">
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
            <a href="{{ route('admin.categories.index') }}" class="btn btn-danger w-24 border text-white-700 mr-1 ml-2">خروج</a>
            <button type="button" wire:click.prevent="submit" class="btn btn-primary w-24 text-white">ذخیره</button>
        </div>

    </form>
</div>
