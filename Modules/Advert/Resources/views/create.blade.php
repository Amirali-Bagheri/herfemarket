@extends('admin.layouts.master')

@section('pageTitle','ثبت تبلیغ جدید')

@section('content')

    {{ Form::open(array('url' => route('admin.ads.create'), 'method' => 'POST', 'enctype' => 'multipart/form-data'))}}
    @include('admin.layouts.errors')
    <div class="grid grid-cols-12 gap-6 mt-5">

        <div class="intro-y col-span-12 lg:col-span-6">
            <div class="intro-y box">
                <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200">
                    <h2 class="font-medium text-base ml-auto">
                        عمومی
                    </h2>
                </div>
                <div class="p-5">

                    <div class="form-group">
                        <label class="control-label" for="title">عنوان تبلیغ:<span class="m-l-5 text-danger">
                                    *</span></label>
                        <input class="form-control w-full border mt-2 @error('title') border-theme-6 @enderror"
                               type="text"
                               name="title"
                               id="title" value="{{ old('title') }}"/>
                        @error('title')
                        <div class="text-theme-6 mt-2">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label class="control-label" for="slug">نام شناسه:<span class="m-l-5 text-danger">
                                    *</span></label>
                        <input class="form-control w-full border mt-2 @error('slug') border-theme-6 @enderror"
                               type="text"
                               name="slug"
                               id="slug" value="{{ old('slug') }}"/>
                        @error('slug')
                        <div class="text-theme-6 mt-2">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="alt">نوشته جایگزین (alt):</label>
                        <input class="form-control w-full border mt-2 @error('alt') border-theme-6 @enderror"
                               type="text"
                               name="alt"
                               id="alt" value="{{ old('alt') }}"/>
                        @error('alt')
                        <div class="text-theme-6 mt-2">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="url">لینک تبلیغ:</label>
                        <input class="form-control w-full border mt-2 @error('url') border-theme-6 @enderror"
                               type="text"
                               name="url"
                               id="url" value="{{ old('url') }}"/>
                        @error('url')
                        <div class="text-theme-6 mt-2">{{ $message }}</div> @enderror
                    </div>

                </div>
            </div>

        </div>
        <div class="intro-y col-span-12 lg:col-span-6">
            <div class="intro-y box">
                <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200">
                    <h2 class="font-medium text-base ml-auto">
                        مشخصات و ویژگی ها
                    </h2>
                </div>
                <div class="p-5">
                    <div class="form-group">
                        <label class="control-label">تصویر:<span class="m-l-5 text-danger">
                                    *</span></label>
                        <br>
                        <div class="form-check form-check-inline">
                            <input type="radio" class="form-check-input" v-model="type" id="upload" value="upload"
                                   name='type' checked>
                            <label class="form-check-label" for="upload">آپلود تصویر</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input type="radio" v-model="type" class="form-check-input" id="link" value="link"
                                   name='type'>
                            <label class="form-check-label" for="link">لینک</label>
                        </div>

                    </div>


                    <div class="form-group" v-show="type === 'upload'">

                        <input class="form-control w-full border mt-2 @error('image') border-theme-6 @enderror"
                               type="file"
                               id="image"
                               name="image"/>
                        @error('image')
                        <div class="text-theme-6 mt-2">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group" v-show="type === 'link'">
                        <input class="form-control w-full border mt-2 @error('image') border-theme-6 @enderror"
                               type="text"
                               name="image"
                               id="image" value="{{ old('image') }}"/>
                        @error('image')
                        <div class="text-theme-6 mt-2">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        {{ Form::label('status', 'وضعیت:') }}
                        <br>
                        <div class="form-check form-check-inline">
                            <input type="radio" class="form-check-input" id="active" value='1' name='status'
                                   checked>
                            <label class="form-check-label" for="active">فعال</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input type="radio" class="form-check-input" id="deactive" value='0' name='status'>
                            <label class="form-check-label" for="deactive">غیر فعال</label>
                        </div>
                    </div>

                </div>
            </div>

        </div>

        <div class="intro-y col-span-12 lg:col-span-12">


        </div>

    </div>
    <div class="text-center mt-5">
        <a href="{{ route('admin.ads.index') }}" class="btn btn-danger w-24 border text-white-700 mr-1 ml-2">لغو</a>
        <button type="submit" class="btn btn-primary w-24 text-white">ذخیره</button>
    </div>

    {{ Form::close() }}


@endsection
