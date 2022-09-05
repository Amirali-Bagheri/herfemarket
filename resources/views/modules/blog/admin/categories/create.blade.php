@extends('admin.layouts.master')

@section('pageTitle','ثبت دسته بندی جدید')

@section('content')

    <blog-categories inline-template>
        <div class="row">
            <div class="col-12">

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">ثبت دسته بندی جدید</h3>

                    </div>

                    <div class="card-body col-md-6">
                        {{ Form::open(array('url' => route('admin.blog.categories.create'), 'method' => 'POST', 'enctype' => 'multipart/form-data'))}}
                        @include('admin.layouts.errors')

                        <div class="tile-body">
                            <div class="form-group">
                                <label class="control-label" for="title">عنوان دسته بندی <span
                                        class="m-l-5 text-danger">
                                    *</span></label>
                                <input class="form-control @error('title') is-invalid @enderror" type="text"
                                       name="title"
                                       id="title" value="{{ old('title') }}"/>
                                @error('title') {{ $message }} @enderror
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="slug">نام نمایشی دسته بندی <span
                                        class="m-l-5 text-danger"></span></label>
                                <input class="form-control @error('slug') is-invalid @enderror" type="text" name="slug"
                                       id="slug" value="{{ old('slug') }}"/>
                                @error('slug') {{ $message }} @enderror
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="description">توضیحات</label>
                                <textarea class="form-control" rows="4" name="description"
                                          id="description">{{ old('description') }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="parent_id">دسته بندی مادر <span class="m-l-5 text-danger"> *</span></label>
                                <select id=parent_id"
                                        class="form-control custom-select mt-15 @error('parent_id') is-invalid @enderror"
                                        name="parent_id">
                                    <option value="0">اگر این دسته مادر دارد انتخاب کنید</option>
                                    @foreach($categories as $key => $category)
                                        <option value="{{ $key }}"> {{ $category }} </option>
                                    @endforeach
                                </select>
                                @error('parent_id') {{ $message }} @enderror
                            </div>
                            <div class="form-group">
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

                            <div class="form-group">
                                <label class="control-label">تصویر دسته</label>
                                <input class="form-control @error('image') is-invalid @enderror" type="file" id="image"
                                       name="image"/>
                                @error('image') {{ $message }} @enderror
                            </div>
                        </div>
                        <div class="tile-footer">
                            <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>ثبت
                                دسته بندی
                            </button>
                            &nbsp;&nbsp;&nbsp;
                            <a class="btn btn-secondary" href="{{ route('admin.blog.categories.index') }}"><i
                                    class="fa fa-fw fa-lg fa-times-circle"></i>بازگشت</a>
                        </div>

                        {{ Form::close() }}
                    </div>

                </div>

            </div>

        </div>
    </blog-categories>

@endsection
