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
                            <label for="title">عنوان</label>
                            <input type="text"
                                   class="form-control w-full border mt-2 @error('title') border-theme-6 @enderror"
                                   id="title" placeholder="عنوان"
                                   wire:model.debounce.500ms="title">
                            @error('title')
                            <div class="text-theme-6 mt-2">{{ $message }}</div> @enderror
                        </div>

                        <div class="mt-3">
                            <label for="slug">نام نمایشی</label>
                            <input type="text"
                                   class="form-control w-full border mt-2 @error('slug') border-theme-6 @enderror"
                                   id="slug" placeholder="نام نمایشی"
                                   wire:model="slug">
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
            </div>
            <div class="intro-y col-span-12 lg:col-span-6">
                <div class="intro-y box">
                    <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200">
                        <h2 class="font-medium text-base ml-auto">
                            جزئیات
                        </h2>
                    </div>
                    <div class="p-5">
                        <div>
                            <label for="parent_id">دسته بندی مادر</label>
                            @if (!empty($category->parent_id) && isset($category->parant->title))
                                <p class="text-center items-center">انتخاب شده: {{$category->parant->title}}</p>

                            @endif
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

                                @if (count($categories) > 0)
                                    @foreach($categories as $key => $category)
                                        <div class="flex col-span-6 items-center text-gray-700 mt-2">
                                            <input type="radio" class="form-check-input mr-1 ml-1" id="{{$key}}"

                                                   wire:model="parent_id"
                                                   @if ($parent_id == $key)
                                                   checked
                                                   @endif
                                                   name="parent_id" value="{{$key}}">
                                            <label class="cursor-pointer select-none"
                                                   for="{{$key}}"> {{$category}}</label>
                                        </div>

                                    @endforeach

                                @endif
                            </div>

                            @error('parent_id')
                            <div class="text-theme-6 mt-2">{{ $message }}</div> @enderror

                        </div>

                        <div class="mt-3">
                            <label for="image">تصویر</label>

                            <div class="border border-gray-200 rounded-md p-5 mt-4">
{{--                                <div class="w-20 h-20 relative image-fit cursor-pointer zoom-in mx-auto">--}}
{{--                                    <img class="rounded-md" alt=""--}}
{{--                                         src="{{ $image ? $image->temporaryUrl() : '\uploads\category.png' }}">--}}
{{--                                </div>--}}
                                <div class="w-40 mx-auto cursor-pointer relative mt-5">
                                    <button type="button" class="button w-full bg-theme-1 text-white">انتخاب</button>
                                    <input wire:model.defer="image" type="file"
                                           class="w-full h-full top-0 left-0 absolute opacity-0">
                                </div>
                            </div>

                            @error('image')
                            <div class="text-theme-6 mt-2">{{ $message }}</div> @enderror
                        </div>

                        <div class="mt-3">
                            <label>وضعیت</label>
                            <div class="flex flex-col sm:flex-row mt-2">
                                <div class="flex items-center text-gray-700 mr-2">
                                    <input type="radio" class="form-check-input mr-1 ml-1" id="status_true"
                                           name="status"
                                           wire:model.debounce.500ms="status" value="1">
                                    <label class="cursor-pointer select-none mr-1 ml-1" for="status_true">فعال</label>
                                </div>
                                <div class="flex items-center text-gray-700 mr-2">
                                    <input type="radio" class="form-check-input mr-1 ml-1" id="status_false"
                                           name="status"
                                           wire:model.debounce.500ms="status" value="0">
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
            <a href="{{ route('admin.categories.index') }}" class="btn btn-danger w-24 border text-white-700 mr-1 ml-2">خروج</a>
            <button type="submit" class="btn btn-primary w-24 text-white">ذخیره</button>
        </div>
    </form>

</div>

@push('scripts')
    <script>
        $(document).ready(function (){
            const patientElement = document.querySelector(".tomselect");
            if (patientElement) {
                new TomSelect(patientElement,{
                    // plugins:['remove_button'],
                    // persist: false,
                    // create: true,
                    // maxOptions: 100,
                    // sortField: {
                    //     field: "text",
                    //     direction: "asc"
                    // }
                });
            }
        })

        document.addEventListener('livewire:load', () => {
            Livewire.hook('message.processed', (message, component) => {
                // $('.select2').select2();
                const patientElement = document.querySelector(".tomselect");
                if (patientElement) {
                    new TomSelect(patientElement,{
                        // plugins:['remove_button'],
                        // persist: false,
                        // create: true,
                        // maxOptions: 100,
                        // sortField: {
                        //     field: "text",
                        //     direction: "asc"
                        // }
                    });
                }
            });
        });

    </script>

@endpush
