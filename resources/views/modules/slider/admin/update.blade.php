@extends('admin.layouts.master')
@section('pageTitle','ویرایش اسلایدر')

@section('content')
    <sliders inline-template>

        <div class="row">
            <div class="col-12">

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">ویرایش اسلایدر: {{$slider->title}}</h3>

                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        @include('admin.layouts.errors')

                        {{ Form::model($slider, array('route' => array('sliders.update', $slider->id), 'method' => 'PUT', 'enctype' => 'multipart/form-data'))}}


                        <div class="tile-body">
                            <div class="row">
                                <div class="col-md-4">

                                    <div class="form-group">
                                        <label class="control-label" for="title">عنوان اسلایدر <span
                                                class="m-l-5 text-danger"></span></label>
                                        <input class="form-control @error('title') is-invalid @enderror" type="text"
                                               name="title" id="title" value="{{ old('title', $slider->title) }}"/>
                                        @error('title') {{ $message }} @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" for="slug">نام نمایشی اسلایدر <span
                                                class="m-l-5 text-danger"> *</span></label>
                                        <input class="form-control @error('slug') is-invalid @enderror" type="text"
                                               name="slug" id="slug" value="{{ old('slug', $slider->slug) }}"/>
                                        @error('slug') {{ $message }} @enderror
                                    </div>
                                    <div class="form-group">
                                        {{ Form::label('status', 'وضعیت') }}
                                        <br>
                                        <div class="form-check form-check-inline">

                                            <input type="radio" class="form-check-input" id="active" value='1'
                                                   name='status'
                                                   @if($slider->status == 1)
                                                   checked
                                                @endif>
                                            <label class="form-check-label" for="active">فعال</label>
                                        </div>
                                        <div class="form-check form-check-inline">

                                            <input type="radio" class="form-check-input" id="deactive" value='0'
                                                   name='status' @if($slider->status == 0)
                                                   checked
                                                @endif>
                                            <label class="form-check-label" for="deactive">غیر
                                                فعال</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8">


                                    <table class="table table-bordered">
                                        <tr>
                                            <th style="width: 10px">#</th>
                                            <th>نشانی</th>
                                            <th>متن جایگزین</th>
                                            <th>لینک</th>
                                            <th>ترتیب</th>
                                            <th>گزینه ها</th>
                                        </tr>
                                        @foreach($slider->slides as $slide)

                                            <tr id="{{$slide->id}}">
                                                <td>{{$slide->id}}</td>
                                                <td>{{$slide->image_url}}</td>
                                                <td>{{$slide->alt}}</td>
                                                <td>{{$slide->url}}</td>
                                                <td>{{$slide->order}}</td>
                                                <td>
                                                    <a style="margin: 5px;" href="javascript:void(0)"><i
                                                            class="fa fa-edit"></i></a>
                                                    <a style="margin: 5px;"
                                                       @click="deleteSlide({{$slider->id}},{{$slide->id}})"
                                                       href="javascript:void(0)">
                                                        <i class="fa fa-trash-alt"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>

                                </div>
                            </div>

                            <hr>
                            <div class="form-group">
                                <label class="control-label" for="images[]">اسلاید ها:</label>

                                <div class="row">

                                    <vue-cloneya>
                                        <div class="row input-group" style="margin: 10px">
                                            {{--                                                <input type="file" name="images[]" class="form-control">--}}
                                            <label style="margin-right: 10px;" class="control-label"
                                                   for="slide_image_urls[]">نشانی تصویر:</label>
                                            <input name="slide_image_urls[]" type="text"
                                                   style="width: 100px; margin-right: 10px;" placeholder="نشانی تصویر"
                                                   class="form-control"/>

                                            <label style="margin-right: 10px;" class="control-label" for="slide_alts[]">متن
                                                جایگزین:</label>
                                            <input name="slide_alts[]" type="text"
                                                   style="width: 100px; margin-right: 10px;"
                                                   placeholder="متن جایگزین" class="form-control"/>

                                            <label style="margin-right: 10px;" class="control-label" for="slide_urls[]">لینک
                                                اسلاید:</label>
                                            <input name="slide_urls[]" type="text"
                                                   style="width: 100px; margin-right: 10px;"
                                                   placeholder="لینک اسلاید" class="form-control"/>

                                            <label style="margin-right: 10px;" class="control-label"
                                                   for="slide_orders[]">ترتیب قرارگیری:</label>
                                            <input name="slide_orders[]" type="text"
                                                   style="width: 100px; margin-right: 10px;"
                                                   placeholder="ترتیب قرارگیری"
                                                   class="form-control"/>


                                            <span class="input-group-btn" style="margin-right: 20px">
                                            <button type="button" class="btn btn-success" tabindex="-1" v-cloneya-add><i
                                                    class="fa fa-plus"></i>
                                            </button>
                                            <button type="button" class="btn btn-danger" tabindex="-1"
                                                    v-cloneya-remove><i class="fa fa-minus"></i></button>
                                        </span>
                                        </div>
                                    </vue-cloneya>

                                </div>
                            </div>
                        </div>
                        <div class="tile-footer">
                            <button class="btn btn-primary" type="submit"><i
                                    class="fa fa-fw fa-lg fa-check-circle"></i>ذخیره
                            </button>
                            &nbsp;&nbsp;&nbsp;
                            <a class="btn btn-secondary" href="{{ route('admin.sliders.index') }}"><i
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

    </sliders>

@endsection
