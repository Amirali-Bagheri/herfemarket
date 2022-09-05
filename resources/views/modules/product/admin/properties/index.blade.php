@extends('admin.layouts.master')
@section('pageTitle','مدیریت ویژگی ها')

@section('content')

    @include('admin.layouts.errors')
    <properties inline-template>

        <div class="row">
            <div class="col-12">

                <div class="card collapsed-card">
                    <div class="card-header">
                        <h5 class="card-title float-right">وارد کردن ویژگی ها با اکسل</h5>

                        <div class="card-tools float-left">
                            <a href="javascript:void(0)" class="text-decoration-none color-black" style="margin: 10px"
                               data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form method="post" enctype="multipart/form-data" action="{{route('admin.properties.import')}}"
                              class="float-right" style="margin: 5px">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputFile">انتخاب فایل اکسل</label>
                                <div class="input-group">

                                    <div class="input-group-append">
                                        <button type="submit" class="input-group-text">ارسال</button>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="excel">
                                        <label class="custom-file-label"></label>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title float-right">فهرست ویژگی ها </h3>
                    </div>
                    <div class="card-tools" style="margin: 10px">
                        <form action="{{route('admin.properties.search')}}" id="search_form" method="get" role="search"
                              class="form-inline typeahead error-form float-right">

                            <div class="input-group md-form form-sm form-2 pl-0">
                                <input type="search" name="s" class="form-control mr-sm-2 search-input rtl"
                                       placeholder="جستجو ..." style="direction: rtl;">


                                <a href="javascript:void(0)" onclick="document.getElementById('search_form').submit();">
                                    <i class="fas fa-search" style="color: black" aria-hidden="true"></i>
                                </a>
                            </div>


                        </form>

                        <div class="form-inline mr-4 float-left">
                            <button class="btn btn-danger dropdown-toggle" type="button" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">عملیات
                            </button>

                            <div class="dropdown-menu dropdown-danger text-center">
                                <a class="dropdown-item delete-all" @click="deleteAll()" href="javascript:void(0)">حذف
                                    انتخاب شده ها</a>
                            </div>
                            <a class="float-left text-decoration-none" href="{{route('admin.properties.create')}}">
                                <button type="button" class="btn btn-block btn-success">ویژگی جدید</button>
                            </a>


                        </div>

                    </div>

                    <div class="card-body  table-responsive">

                        <table class="table table-hover">
                            <tr>
                                <th>
                                    <input type="checkbox" class="form-check-input" id="check_all">
                                    <label class="form-check-label" for="check_all"></label>
                                </th>
                                <th>@sortablelink('id', 'شناسه', ['filter' => 'active, visible'])</th>
                                <th>@sortablelink('title', 'عنوان ویژگی', ['filter' => 'active, visible'])</th>
                                {{-- <th>دسته بندی</th> --}}
                                <th>@sortablelink('parent_id', 'مادر', ['filter' => 'active, visible'])</th>
                                <th>@sortablelink('updated_at', 'زمان ارسال/ویرایش', ['filter' => 'active, visible'])
                                </th>
                                <th>گزینه ها</th>
                            </tr>
                            @if($properties && count($properties) > 0)
                                @foreach($properties as $property)
                                    <tr>
                                        <td>
                                            <input type="checkbox" class="form-check-input check"
                                                   id="check-{{$property->id}}"
                                                   data-id="{{$property->id}}">
                                            <label class=" form-check-label" for="check-{{$property->id}}"></label>

                                        </td>

                                        <td>{{$property->id}}</td>
                                        <td>{{$property->title}}</td>
                                        {{-- <td>
                                            @if ($property->has('categories'))
                                            @foreach($property->categories as $category)
                                            <a class="text-decoration-none" href="{{route('admin.categories.show',$category->slug)}}"
                                                style="color: #000;">
                                                {{$category->title}}</a>,
                                            @endforeach
                                            @endif
                                        </td> --}}
                                        <td>@if($property->parent_id != 0) {{ $property->parent->title }} @else
                                                - @endif</td>
                                        <td>{{verta($property->updated_at)->timezone('Asia/Tehran')->format('H:i %B %d، %Y')}}</td>
                                        <td>
                                            <a style="margin: 5px;" title="ویرایش"
                                               href="{{route('admin.properties.update',$property->id)}}">
                                                <i class="fa fa-edit"></i></a>
                                            <a title="حذف" style="margin: 5px;"
                                               href="{{route('admin.properties.delete',$property->id)}}">
                                                <i class="fa fa-trash-alt"></i></a>
                                        </td>
                                    </tr>

                                @endforeach
                            @else
                                <tr>
                                    <td colspan="8" align="center">ویژگی ای برای نمایش وجود ندارد</td>
                                </tr>

                            @endif

                        </table>
                        <div class="row" style="margin-top: 20px; margin-right: -40;">
                            {!! $properties->withQueryString()->links('admin.layouts.pagination') !!}
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </properties>

@endsection
