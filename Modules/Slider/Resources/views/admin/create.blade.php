@extends('admin.layouts.master')

@section('pageTitle','ثبت اسلایدر جدید')

@section('content')

    <sliders inline-template>
        <div class="row">
            <div class="col-12">

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">ثبت اسلایدر جدید</h3>

                    </div>

                    <div class="card-body col-md-6">
                        {{ Form::open(array('url' => route('admin.sliders.create'), 'method' => 'POST', 'enctype' => 'multipart/form-data'))}}
                        @include('admin.layouts.errors')

                        <div class="tile-body">
                            <div class="form-group">
                                <label class="control-label" for="title">عنوان اسلایدر <span class="m-l-5 text-danger">
                                    *</span></label>
                                <input class="form-control @error('title') is-invalid @enderror" type="text"
                                       name="title"
                                       id="title" value="{{ old('title') }}"/>
                                @error('title') {{ $message }} @enderror
                            </div>

                            <div class="form-group">
                                <label class="control-label" for="slug">نام اسلایدر (انگلیسی)<span
                                        class="m-l-5 text-danger"> *</span></label>
                                <input class="form-control @error('slug') is-invalid @enderror" type="text" name="slug"
                                       id="slug" value="{{ old('slug') }}"/>
                                @error('title') {{ $message }} @enderror
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

                        </div>
                        <div class="tile-footer">
                            <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>ثبت
                                اسلایدر
                            </button>
                            &nbsp;&nbsp;&nbsp;
                            <a class="btn btn-secondary" href="{{ route('admin.sliders.index') }}"><i
                                    class="fa fa-fw fa-lg fa-times-circle"></i>بازگشت</a>
                        </div>

                        {{ Form::close() }}
                    </div>

                </div>

            </div>

        </div>
    </sliders>

@endsection
