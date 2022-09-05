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

                        <div class="mt-3">
                            <label for="body">متن</label>
                            <textarea
                                class="w-full px-3 py-2 text-gray-700 border rounded-lg focus:outline-none  @error('body') border-theme-6 @enderror"
                                rows="4"
                                id="body" placeholder="متن"
                                wire:model.defer="body"
                            ></textarea>

                            @error('body')
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
                                    <input type="radio" class="form-check-input mr-1 ml-1" id="status_true" name="status"
                                           wire:model.defer="status" value="1">
                                    <label class="cursor-pointer select-none mr-1 ml-1" for="status_true">تایید</label>
                                </div>
                                <div class="flex items-center text-gray-700 mr-2">
                                    <input type="radio" class="form-check-input mr-1 ml-1" id="status_false" name="status"
                                           wire:model.defer="status" value="0">
                                    <label class="cursor-pointer select-none mr-1 ml-1" for="status_false">رد</label>
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
            <a href="{{ route('admin.comments.index') }}" class="btn btn-danger w-24 border text-white-700 mr-1 ml-2">خروج</a>
            <button class="btn btn-primary w-24 text-white">ذخیره</button>
        </div>

    </form>
</div>
