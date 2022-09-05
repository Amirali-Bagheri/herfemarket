@extends('admin.layouts.master')

@section('productTitle','ویرایش محصول '.$product->title)


@section('content')
    <div class="col-span-12 container mx-auto sm:px-4 max-w-full mx-auto sm:px-4 xxl:col-span-12">
        <livewire:product::update :product="$product"/>
    </div>

    {{--
        @include('admin.layouts.tinymce')
        @include('admin.layouts.errors')
        <products inline-template>


            <div class="row">
                <div class="col-12">

                    <div class="card">
                        <div class="card-header d-flex p-0">

                            <ul class="nav nav-pills ml-auto p-2">
                                <li class="nav-item"><a class="nav-link active" href="#general" data-toggle="tab">ویرایش
                                        اطلاعات</a></li>
                                <li class="nav-item"><a class="nav-link" href="#images" data-toggle="tab">تصاویر</a></li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="general">
                                    <div class="tile">
                                        {{ Form::model($product, array('route' => array('products.update', $product->id), 'method' => 'PUT', 'enctype' => 'multipart/form-data'))}}
                                        @csrf
                                        <h3 class="tile-title">ویرایش محصول: {{$product->title}}</h3>
                                        <hr>
                                        <div class="tile-body">
                                            <div class="row">
                                                <div class="col-md-6">

                                                    <div class="card card-primary">
                                                        <div class="card-header">
                                                            <h3 class="card-title">عمومی</h3>
                                                        </div>
                                                        <div class="card-body">

                                                            <div class="form-group has-feedback">
                                                                {{ Form::label('title', 'عنوان') }}
                                                                <input
                                                                    class="form-control @error('title') is-invalid @enderror"
                                                                    type="text" placeholder="عنوان محصول" id="title"
                                                                    title="استفاده کمتر از 60 کاراکتر برای عنوان محصول برای سئو"
                                                                    name="title"
                                                                    value="{{ old('title',$product->title) }}"/>
                                                                <div class="invalid-feedback active">
                                                                    <i class="fa fa-exclamation-circle fa-fw"></i>
                                                                    @error('title')
                                                                    <span>{{ $message }}</span> @enderror
                                                                </div>
                                                            </div>
                                                            <div class="form-group has-feedback">
                                                                {{ Form::label('en_title', 'عنوان انگلیسی') }}
                                                                <input
                                                                    class="form-control @error('en_title') is-invalid @enderror"
                                                                    type="text" placeholder="عنوان انگلیسی محصول"
                                                                    id="en_title"
                                                                    name="en_title"
                                                                    value="{{ old('en_title',$product->en_title) }}"/>
                                                                <div class="invalid-feedback active">
                                                                    <i class="fa fa-exclamation-circle fa-fw"></i>
                                                                    @error('en_title')
                                                                    <span>{{ $message }}</span> @enderror
                                                                </div>
                                                            </div>

                                                            <div class="form-group has-feedback">
                                                                {{ Form::label('slug', 'نام نمایشی (اختیاری)') }}
                                                                <input
                                                                    class="form-control @error('slug') is-invalid @enderror"
                                                                    type="text" placeholder="نام نمایشی" id="slug"
                                                                    title="اگر میخواهید نام نمایشی دلخواه انتخاب کنید این فیلد را پر کنید"
                                                                    name="slug" value="{{ old('slug',$product->slug) }}"/>
                                                                <div class="invalid-feedback active">
                                                                    <i class="fa fa-exclamation-circle fa-fw"></i>
                                                                    @error('slug')
                                                                    <span>{{ $message }}</span> @enderror
                                                                </div>
                                                            </div>
                                                            <div class="form-group has-feedback">
                                                                {{ Form::label('code', 'کد:') }}
                                                                <input
                                                                    class="form-control @error('code') is-invalid @enderror"
                                                                    type="text"
                                                                    placeholder="کد" id="code" name="code"
                                                                    value="{{ old('code',$product->code) }}"/>
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

                                                                    <input type="radio" class="form-check-input" id="active"
                                                                           value='1' name='status'
                                                                           @if($product->status == 1)
                                                                           checked
                                                                        @endif>
                                                                    <label class="form-check-label"
                                                                           for="active">فعال</label>
                                                                </div>
                                                                <div class="form-check form-check-inline">

                                                                    <input type="radio" class="form-check-input"
                                                                           id="deactive"
                                                                           value='0' name='status'
                                                                           @if($product->status == 0)
                                                                           checked
                                                                        @endif>
                                                                    <label class="form-check-label" for="deactive">غیر
                                                                        فعال</label>
                                                                </div>


                                                            </div>

                                                        </div>


                                                    </div>


                                                </div>
                                                <div class="col-md-6">

                                                    <div class="card card-default">
                                                        <div class="card-header">
                                                            <h3 class="card-title">دسته بندی و برچسب ها</h3>
                                                        </div>
                                                        <div class="card-body">

                                                            --}}
    {{--                                                    <div class="form-group has-feedback">--}}{{--

                                                            --}}
    {{--                                                        {{ Form::label('tags[]', 'برچسب ها') }}--}}{{--

                                                            --}}
    {{--                                                        <select name="tags[]" id="tags" class="form-control "--}}{{--

                                                            --}}
    {{--                                                            multiple>--}}{{--

                                                            --}}
    {{--                                                            @foreach($tags as $key => $tag)--}}{{--

                                                            --}}
    {{--                                                            @php $check = in_array($key,--}}{{--

                                                            --}}
    {{--                                                            $product->tags->pluck('id')->toArray()) ? 'selected' :--}}{{--

                                                            --}}
    {{--                                                            ''@endphp--}}{{--

                                                            --}}
    {{--                                                            <option value="{{ $key }}" {{ $check }}>{{ $tag }}</option>--}}{{--

                                                            --}}
    {{--                                                            @endforeach--}}{{--

                                                            --}}
    {{--                                                        </select>--}}{{--

                                                            --}}
    {{--                                                        @error('tags[]') {{ $message }} @enderror--}}{{--


                                                            --}}
    {{--                                                    </div>--}}{{--


                                                            <div class="form-group has-feedback">
                                                                {{ Form::label('brand_id', 'برند') }}
                                                                <select id="brand_id"
                                                                     data-live-search="true"
                                                                        class="selectpicker mt-15 @error('brand_id') is-invalid @enderror"
                                                                        name="brand_id">
                                                                    @foreach($brands as $brand)
                                                                        @if ($product->brand_id == $brand->id)
                                                                            <option value="{{ $brand->id }}" selected>
                                                                                {{ $brand->title }} </option>
                                                                        @else
                                                                            <option
                                                                                value="{{ $brand->id }}"> {{ $brand->title }}
                                                                            </option>
                                                                        @endif
                                                                    @endforeach

                                                                </select>
                                                                @error('brand_id') {{ $message }} @enderror
                                                            </div>

                                                            <div class="form-group has-feedback">
                                                                {{ Form::label('categories[]', 'دسته بندی') }}
                                                                <select name="categories[]" id="categories"
                                                                        class="selectpicker" data-live-search="true"
                                                                        multiple>
                                                                    @foreach($categories as $key => $category)
                                                                        @php $check = in_array($key,
                                                                $product->categories->pluck('id')->toArray()) ? 'selected' :
                                                                ''@endphp
                                                                        <option
                                                                            value="{{ $key }}" {{ $check }}>{{ $category }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                                @error('categories[]') {{ $message }} @enderror

                                                            </div>


                                                        </div>
                                                    </div>


                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">

                                                    <div class="card card-default">
                                                        <div class="card-header">
                                                            <h3 class="card-title">مشخصات فنی</h3>
                                                        </div>
                                                        <div class="card-body row">
                                                            <div class="col-md-8">
                                                                <vue-cloneya>
                                                                    <div class="row input-group" style="margin: 10px">
                                                                        <select name="property_id[]" id="property_id"
                                                                                class="form-control ">
                                                                            <option value="0">انتخاب کنید
                                                                            </option>
                                                                            @foreach($properties
                                                                            as $key => $property)
                                                                                <option value="{{ $key }}"> {{ $property }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>

                                                                        <label style="margin-right: 10px;"
                                                                               class="control-label"
                                                                               for="property_value[]">مقدار:</label>

                                                                        <input name="property_value[]" type="text"
                                                                               style="width: 100px; margin-right: 10px;"
                                                                               placeholder="مقدار" class="form-control"/>


                                                                        <span class="input-group-btn"
                                                                              style="margin-right: 20px">
                                                                        <button type="button" class="btn btn-success"
                                                                                tabindex="-1" v-cloneya-add><i
                                                                                class="fa fa-plus"></i>
                                                                        </button>
                                                                        <button type="button" class="btn btn-danger"
                                                                                tabindex="-1" v-cloneya-remove><i
                                                                                class="fa fa-minus"></i></button>
                                                                    </span>
                                                                    </div>
                                                                </vue-cloneya>

                                                            </div>
                                                            <div class="col-md-4">


                                                                <table class="table table-bordered">
                                                                    <tr>
                                                                        <th style="width: 10px">#</th>
                                                                        <th>ویژگی</th>
                                                                        <th>مقدار</th>
                                                                        <th>گزینه ها</th>
                                                                    </tr>
                                                                    @foreach($product->property_values as $property)

                                                                        <tr id="{{$property->id}}">
                                                                            <td>{{$property->id}}</td>
                                                                            <td>{{$property->property->title}}</td>
                                                                            <td>{{$property->value}}</td>
                                                                            <td>
                                                                                <a style="margin: 5px;"
                                                                                   href="javascript:void(0)"><i
                                                                                        class="fa fa-edit"></i></a>
                                                                                <a style="margin: 5px;"
                                                                                   @click="deletePropertyValue({{$product->id}},{{$property->id}})"
                                                                                   href="javascript:void(0)">
                                                                                    <i class="fa fa-trash-alt"></i></a>
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach
                                                                </table>

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
                                                            <textarea placeholder="توضیحات محصول" name="description"
                                                                      id="description" rows="8"
                                                                      class="form-control tinymce rtl @error('description') is-invalid @enderror">{{ old('description',$product->description) }}</textarea>
                                                                <div class="invalid-feedback active">
                                                                    <i class="fa fa-exclamation-circle fa-fw"></i>
                                                                    @error('description')
                                                                    <span>{{ $message }}</span> @enderror
                                                                </div>

                                                            </div>


                                                        </div>

                                                    </div>

                                                </div>
                                            </div>


                                        </div>
                                        <div class="tile-footer">
                                            <div class="row d-print-none mt-2">
                                                <div class="col-12 text-right">
                                                    <button class="btn btn-success" type="submit"><i
                                                            class="fa fa-fw fa-lg fa-check-circle"></i>ویرایش محصول
                                                    </button>
                                                    <a class="btn btn-danger" href="{{ route('admin.products.index') }}"><i
                                                            class="fa fa-fw fa-lg fa-arrow-left"></i>بازگشت</a>
                                                </div>
                                            </div>
                                        </div>
                                        {{ Form::close() }}
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="images">
                                    <div class="tile">
                                        <h3 class="tile-title">تصاویر</h3>
                                        <hr>
                                        <div class="tile-body">
                                            <div class="row">
                                                <div class="col-md-12">

                                                    <form action="{{route('admin.products.images.upload')}}" method="POST"
                                                          enctype="multipart/form-data">
                                                        @csrf
                                                        <input type="hidden" name="product_id" value="{{ $product->id }}">

                                                        <vue-cloneya>
                                                            <div class="input-group">
                                                                <input type="file" name="images[]" class="form-control">
                                                                <span class="input-group-btn"><button type="button"
                                                                                                      class="btn btn-success"
                                                                                                      tabindex="-1"
                                                                                                      v-cloneya-add><i
                                                                            class="fa fa-plus"></i></button>
                                                                <button type="button" class="btn btn-danger" tabindex="-1"
                                                                        v-cloneya-remove><i
                                                                        class="fa fa-minus"></i></button></span>
                                                            </div>
                                                        </vue-cloneya>

                                                        <div class="row d-print-none mt-2">
                                                            <div class="col-12 text-right">
                                                                <button class="btn btn-success" type="submit"
                                                                        id="uploadButton">
                                                                    <i class="fa fa-fw fa-lg fa-upload"></i>آپلود تصاویر
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </form>

                                                </div>
                                            </div>


                                            @if ($product->images != null)
                                                <hr>
                                                <div class="row">
                                                    @foreach($product->images as $image)
                                                        <div class="col-md-3">
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <img
                                                                        src="{{ asset('uploads/'.str_replace(' ', '%20',Str::of($image))) }}"
                                                                        id="chefLogo" class="img-fluid" alt="img">
                                                                    <a class="card-link float-right text-danger"
                                                                       href="{{ route('admin.products.images.delete',[$product->id, $image]) }}">
                                                                        <i class="fa fa-fw fa-lg fa-trash"></i>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!-- /.tab-content -->
                        </div>
                    </div>

                </div>

            </div>

        </products>
    --}}

@endsection
