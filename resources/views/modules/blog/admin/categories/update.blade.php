@extends('admin.layouts.master')
@section('pageTitle','ویرایش دسته بندی')

@section('content')
    <blog-categories inline-template>

        <div class="row">
            <div class="col-12">

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">ویرایش دسته بندی: {{$category->title}}</h3>

                    </div>
                    <!-- /.card-header -->
                    <div class="card-body col-md-6">
                        {{ Form::model($category, array('route' => array('admin.blog.categories.update', $category->id), 'method' => 'PUT', 'enctype' => 'multipart/form-data'))}}
                        @include('admin.layouts.errors')

                        <div class="tile-body">
                            <div class="form-group">
                                <label class="control-label" for="title">عنوان دسته بندی <span
                                        class="m-l-5 text-danger"> *</span></label>
                                <input class="form-control @error('title') is-invalid @enderror" type="text"
                                       name="title"
                                       id="title"
                                       value="{{ old('title', $category->title) }}"/>
                                <input type="hidden" name="id" value="{{ $category->id }}">
                                @error('title') {{ $message }} @enderror
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="slug">نام نمایشی دسته بندی <span
                                        class="m-l-5 text-danger"> *</span></label>
                                <input class="form-control @error('slug') is-invalid @enderror" type="text" name="slug"
                                       id="slug"
                                       value="{{ old('slug', $category->slug) }}"/>
                                <input type="hidden" name="id" value="{{ $category->id }}">
                                @error('slug') {{ $message }} @enderror
                            </div>

                            <div class="form-group">
                                <label class="control-label" for="description">توضیحات</label>
                                <textarea class="form-control" rows="4" name="description"
                                          id="description">{{ old('description', $category->description) }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="parent_id">دسته بندی مادر <span class="m-l-5 text-danger"> *</span></label>
                                <select id=parent_id
                                        class="form-control custom-select mt-15 @error('parent_id') is-invalid @enderror"
                                        name="parent_id">
                                    <option value="0">اگر این دسته مادر دارد انتخاب کنید</option>
                                    @foreach($categories as $key => $value)
                                        @if ($category->parent_id == $key)
                                            <option value="{{ $key }}" selected> {{ $value }} </option>
                                        @else
                                            <option value="{{ $key }}"> {{ $value }} </option>
                                        @endif
                                    @endforeach

                                </select>
                                @error('parent_id') {{ $message }} @enderror
                            </div>
                            <div class="form-group">
                                {{ Form::label('status', 'وضعیت') }}
                                <br>
                                <div class="form-check form-check-inline">

                                    <input type="radio" class="form-check-input" id="active" value='1' name='status'
                                           @if($category->status == 1)
                                           checked
                                        @endif>
                                    <label class="form-check-label" for="active">فعال</label>
                                </div>
                                <div class="form-check form-check-inline">

                                    <input type="radio" class="form-check-input" id="deactive" value='0' name='status'
                                           @if($category->status == 0)
                                           checked
                                        @endif>
                                    <label class="form-check-label" for="deactive">غیر
                                        فعال</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <label class="control-label">تصویر دسته بندی:</label>

                                    <div class="col-md-2">
                                        @if ($category->image != null)
                                            <figure class="mt-2" style="width: 80px; height: auto;">
                                                <img src="/uploads/{{$category->image}}" id="categoryImage"
                                                     class="img-fluid"
                                                     alt="">
                                            </figure>
                                        @endif
                                    </div>
                                    <div class="col-md-10">
                                        <input class="form-control @error('image') is-invalid @enderror" type="file"
                                               id="image"
                                               name="image"/>
                                        @error('image') {{ $message }} @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tile-footer">
                            <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>ذخیره
                            </button>
                            &nbsp;&nbsp;&nbsp;
                            <a class="btn btn-secondary" href="{{ route('admin.blog.categories.index') }}"><i
                                    class="fa fa-fw fa-lg fa-times-circle"></i>لغو</a>
                        </div>

                        {{ Form::close() }}
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>

    </blog-categories>

@endsection
