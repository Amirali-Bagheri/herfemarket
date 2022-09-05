@extends('admin.layouts.master')

@section('pageTitle','ثبت محصول جدید')

@section('content')
    <div class="col-span-12 container mx-auto sm:px-4 max-w-full mx-auto sm:px-4 xxl:col-span-12">
        @livewire('product::create')

    </div>

    {{--
        @include('admin.layouts.errors')
        @include('admin.layouts.tinymce')
        <products inline-template>
            {{ Form::open(array('url' => route('admin.products.create'), 'method' => 'POST', 'enctype' => 'multipart/form-data','files'=>true))}}
            @csrf
            <h3 class="card-title float-right">ثبت محصول جدید</h3>
            <br>
            <br>
            <div class="row">
                <div class="col-md-6">

                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">عمومی</h3>
                        </div>
                        <div class="card-body">

                            <div class="form-group has-feedback">
                                {{ Form::label('title', 'عنوان') }}
                                <input class="form-control @error('title') is-invalid @enderror" type="text"
                                       placeholder="عنوان محصول" id="title"
                                       title="استفاده کمتر از 60 کاراکتر برای عنوان محصول برای سئو" name="title"
                                       value="{{ old('title') }}"/>
                                <div class="invalid-feedback active">
                                    <i class="fa fa-exclamation-circle fa-fw"></i> @error('title')
                                    <span>{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group has-feedback">
                                {{ Form::label('en_title', 'عنوان انگلیسی') }}
                                <input class="form-control @error('en_title') is-invalid @enderror" type="text"
                                       placeholder="عنوان انگلیسی محصول" id="en_title" name="en_title"
                                       value="{{ old('en_title') }}"/>
                                <div class="invalid-feedback active">
                                    <i class="fa fa-exclamation-circle fa-fw"></i> @error('en_title')
                                    <span>{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="form-group has-feedback">
                                {{ Form::label('slug', 'نام نمایشی (اختیاری)') }}
                                <input class="form-control @error('slug') is-invalid @enderror" type="text"
                                       placeholder="نام نمایشی" id="slug"
                                       title="اگر میخواهید نام نمایشی دلخواه انتخاب کنید این فیلد را پر کنید" name="slug"
                                       value="{{ old('slug') }}"/>
                                <div class="invalid-feedback active">
                                    <i class="fa fa-exclamation-circle fa-fw"></i> @error('slug')
                                    <span>{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group has-feedback">
                                {{ Form::label('code', 'کد:') }}
                                <input class="form-control @error('code') is-invalid @enderror" type="text"
                                       placeholder="کد" id="code" name="code"
                                       value="{{ old('code') }}"/>
                                <div class="invalid-feedback active">
                                    <i class="fa fa-exclamation-circle fa-fw"></i> @error('code')
                                    <span>{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group has-feedback">

                                {{ Form::label('status', 'وضعیت') }}
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

                <div class="col-md-6">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">تصویر و گالری</h3>
                        </div>
                        <div class="card-body">

                            <div class="form-group has-feedback">
                                <label class="control-label" for="images[]">تصویر</label>
                                <vue-cloneya>
                                    <div class="input-group">
                                        <input type="file" name="images[]" class="form-control">
                                        <span class="input-group-btn"><button type="button" class="btn btn-success"
                                                                              tabindex="-1" v-cloneya-add><i
                                                    class="fa fa-plus"></i></button>
                                        <button type="button" class="btn btn-danger" tabindex="-1" v-cloneya-remove><i
                                                class="fa fa-minus"></i></button></span>
                                    </div>
                                </vue-cloneya>
                            </div>


                        </div>
                    </div>
                    <!-- /.card -->
                </div>

            </div>
            <div class="row">
                <div class="col-md-12">

                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title">دسته بندی و برچسب ها</h3>
                        </div>
                        <div class="card-body">

                            <div class="row">
                                <div class="col-md-6">

                                    <div class="form-group has-feedback">
                                        {{ Form::label('brand_id', 'برند') }}
                                        <select name="brand_id" id="tags" class="form-control ">
                                            <option value="0">برند را انتخاب کنید</option>
                                            @foreach($brands as $brand)
                                                <option value="{{ $brand->id }}"> {{ $brand->title }} </option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>


                                <div class="col-md-6">


                                    <div class="form-group has-feedback">
                                        {{ Form::label('categories[]', ' دسته بندی ها') }}
                                        <select name="categories[]" id="categories" class="form-control " multiple>
                                            <option value="0">دسته بندی را انتخاب کنید</option>
                                            @foreach($categories as $key => $category)
                                                <option value="{{ $key }}"> {{ $category }} </option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>


                </div>
            </div>

            <div class="row">
                <div class="col-md-12">

                    <div class="card card-danger">
                        <div class="card-header">
                            <h3 class="card-title float-right ">توضیحات محصول</h3>
                        </div>
                        <div class="card-body">

                            <div class="form-group has-feedback">
                            <textarea placeholder="توضیحات محصول" name="description" id="description" rows="8"
                                      class="form-control tinymce rtl @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                                <div class="invalid-feedback active">
                                    <i class="fa fa-exclamation-circle fa-fw"></i> @error('description')
                                    <span>{{ $message }}</span> @enderror
                                </div>

                            </div>


                        </div>

                    </div>

                </div>
            </div>

            <div class="tile-footer">
                <div class="row d-print-none mt-2">
                    <div class="col-12 text-center">
                        <button class="btn btn-success" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>ثبت
                            محصول
                        </button>
                        <a class="btn btn-danger" href="{{ route('admin.products.index') }}"><i
                                class="fa fa-fw fa-lg fa-arrow-left"></i>بازگشت</a>
                    </div>
                </div>
            </div>
            <br>

            {{ Form::close() }}
        </products>

    --}}

@endsection
