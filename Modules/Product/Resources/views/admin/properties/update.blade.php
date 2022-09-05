@extends('admin.layouts.master')
@section('pageTitle','ویرایش ویژگی')

@section('content')
    <properties inline-template>

        <div class="row">
            <div class="col-12">

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">ویرایش ویژگی: {{$property->title}}</h3>

                    </div>
                    <!-- /.card-header -->
                    <div class="card-body col-md-6">
                        {{ Form::open(array('url' => route('admin.properties.create'), 'method' => 'POST', 'enctype' => 'multipart/form-data'))}}
                        @include('admin.layouts.errors')

                        <div class="tile-body">
                            <div class="form-group">
                                <label class="control-label" for="title">عنوان ویژگی <span
                                        class="m-l-5 text-danger"> *</span></label>
                                <input class="form-control @error('title') is-invalid @enderror" type="text"
                                       name="title" id="title"
                                       value="{{ old('title',$property->title) }}"/>
                                @error('title') {{ $message }} @enderror
                            </div>
                            <div class="form-group">
                                {{ Form::label('categories[]', 'دسته بندی') }}
                                <select name="categories[]" id="categories" class="form-control " multiple>
                                    @foreach($categories as $key => $category)
                                        @php $check = in_array($key, $property->categories->pluck('id')->toArray()) ? 'selected' : ''@endphp
                                        <option value="{{ $key }}" {{ $check }}>{{ $category }}</option>
                                    @endforeach
                                </select>
                                @error('categories[]') {{ $message }} @enderror
                            </div>
                            <div class="form-group">
                                <label for="parent_id">مادر<span class="m-l-5 text-danger"></span></label>
                                <select id=parent_id"
                                        class="form-control custom-select mt-15 @error('parent_id') is-invalid @enderror"
                                        name="parent_id">
                                    <option value="0">اگر این ویژگی مادر دارد انتخاب کنید</option>
                                    @foreach($properties as $key => $property)
                                        <option value="{{ $key }}"> {{ $property }} </option>
                                    @endforeach
                                </select>
                                @error('parent_id') {{ $message }} @enderror
                            </div>

                        </div>
                        <div class="tile-footer">
                            <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>ثبت
                                ویژگی
                            </button>
                            &nbsp;&nbsp;&nbsp;
                            <a class="btn btn-secondary" href="{{ route('admin.properties.index') }}"><i
                                    class="fa fa-fw fa-lg fa-times-circle"></i>بازگشت</a>
                        </div>

                        {{ Form::close() }}
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>

    </properties>

@endsection
