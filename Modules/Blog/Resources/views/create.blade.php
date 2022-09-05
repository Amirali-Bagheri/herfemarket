@extends('admin.layouts.master')

@section('pageTitle','ثبت پست جدید')

@section('content')

    @include('admin.layouts.errors')
    @include('admin.layouts.tinymce')

    <posts inline-template>
        {{ Form::open(array('url' => route('admin.posts.create'), 'method' => 'POST', 'enctype' => 'multipart/form-data','files'=>true))}}
        @csrf
        <h3 class="card-title float-right">ثبت پست جدید</h3>

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
                                   placeholder="عنوان پست" id="title"
                                   title="استفاده کمتر از 60 کاراکتر برای عنوان پست برای سئو" name="title"
                                   value="{{ old('title') }}"/>
                            <div class="invalid-feedback active">
                                <i class="fa fa-exclamation-circle fa-fw"></i> @error('title')
                                <span>{{ $message }}</span>
                                @enderror
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

                            {{ Form::label('status', 'وضعیت') }}
                            <br>
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" id="active_status" value='1' name='status'
                                       checked>
                                <label class="form-check-label" for="active_status">فعال</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" id="deactive_status" value='0'
                                       name='status'>
                                <label class="form-check-label" for="deactive_status">غیر فعال</label>
                            </div>
                        </div>
                        <div class="form-group has-feedback">

                            {{ Form::label('status', 'دیدگاه') }}
                            <br>
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" id="active_comment_status" value='1'
                                       name='comment_status' checked>
                                <label class="form-check-label" for="active_comment_status">فعال</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" id="deactive_comment_status" value='0'
                                       name='comment_status'>
                                <label class="form-check-label" for="deactive_comment_status">غیر فعال</label>
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
                            <label class="control-label" for="image">تصویر</label>
                            <input type="file" name="image" class="form-control">
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
                                    {{ Form::label('tags[]', 'برچسب ها') }}

                                    <select name="tags[]" id="tags" class="form-control " multiple="multiple">
                                        <option value="0">برچسب را بنویسید و اینتر بزنید</option>

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
                        <h3 class="card-title float-right ">توضیحات و متن پست</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group has-feedback">
                            <label for="description">توضیحات کوتاه پست</label>
                            <textarea placeholder="متن پست" name="description" id="description" rows="8"
                                      class="form-control tinymce rtl @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                            <div class="invalid-feedback active">
                                <i class="fa fa-exclamation-circle fa-fw"></i> @error('description')
                                <span>{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="form-group has-feedback">
                            {{ Form::label('content', 'متن') }}
                            <textarea placeholder="متن پست" name="content" id="content" rows="8"
                                      class="form-control tinymce rtl @error('content') is-invalid @enderror">{{ old('content') }}</textarea>
                            <div class="invalid-feedback active">
                                <i class="fa fa-exclamation-circle fa-fw"></i> @error('content')
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
                        پست
                    </button>
                    <a class="btn btn-danger" href="{{ route('admin.posts.index') }}"><i
                            class="fa fa-fw fa-lg fa-arrow-left"></i>بازگشت</a>
                </div>
            </div>
        </div>
        <br>

        {{ Form::close() }}
    </posts>


@endsection
