@extends('admin.layouts.master')
@section('pageTitle','مدیریت دسته بندی مطالب')

@section('content')

    @include('admin.layouts.errors')
    <blog-categories inline-template>

        <div class="row">
            <div class="col-12">

                <div class="card collapsed-card">
                    <div class="card-header">
                        <h5 class="card-title float-right">ثبت جمعی دسته بندی با اکسل</h5>

                        <div class="card-tools float-left">
                            <a href="javascript:void(0)" class="text-decoration-none color-black" style="margin: 10px"
                               data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form method="post" enctype="multipart/form-data"
                              action="{{route('admin.blog.categories.import')}}"
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
                        <h3 class="card-title float-right">فهرست دسته بندی ها </h3>
                    </div>
                    <div class="card-tools" style="margin: 10px">
                        <form action="{{route('admin.blog.categories.search')}}" id="search_form" method="get"
                              role="search"
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
                            <a class="float-left text-decoration-none" href="{{route('admin.blog.categories.create')}}">
                                <button type="button" class="btn btn-block btn-success">دسته بندی جدید</button>
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
                                <th>@sortablelink('title', 'عنوان دسته بندی')</th>
                                <th>@sortablelink('slug', 'نام نمایشی')</th>
                                <th>@sortablelink('parent_id', 'مادر')</th>
                                <th>@sortablelink('status', 'وضعیت')</th>
                                <th>@sortablelink('updated_at', 'زمان ارسال/ویرایش')</th>
                                <th>گزینه ها</th>
                            </tr>
                            @if($categories && count($categories) > 0)
                                @foreach($categories as $category)
                                    <tr>
                                        <td>
                                            <input type="checkbox" class="form-check-input check"
                                                   id="check-{{$category->id}}"
                                                   data-id="{{$category->id}}">
                                            <label class=" form-check-label" for="check-{{$category->id}}"></label>

                                        </td>
                                        <td>{{$category->id}}</td>
                                        <td>{{$category->title}}</td>
                                        <td>{{$category->slug}}</td>
                                        <td>@if($category->parent_id != 0) {{ $category->parent->title }} @else
                                                - @endif</td>
                                        <td class="text-center">
                                            @if ($category->status == 1)
                                                <span class="badge badge-success">فعال</span>
                                            @else
                                                <span class="badge badge-danger">غیر فعال</span>
                                            @endif
                                        </td>
                                        <td>{{verta($category->updated_at)->timezone('Asia/Tehran')->format('H:i %B %d، %Y')}}</td>
                                        <td>
                                            <a title="جزئیات" style="margin: 5px;"
                                               href="{{route('admin.blog.categories.show',$category->slug)}}"
                                               target="_blank">
                                                <i class="fa-regular fa-eye"></i></a>
                                            <a style="margin: 5px;" title="ویرایش"
                                               href="{{route('admin.blog.categories.update',$category->id)}}">
                                                <i class="fa fa-edit"></i></a>
                                            <a title="حذف" style="margin: 5px;"
                                               href="{{route('admin.blog.categories.delete',$category->id)}}">
                                                <i class="fa fa-trash-alt"></i></a>
                                        </td>
                                    </tr>

                                @endforeach
                            @else
                                <tr>
                                    <td colspan="8" align="center">دسته بندی ای برای نمایش وجود ندارد</td>
                                </tr>

                            @endif

                        </table>
                        <div class="row" style="margin-top: 20px; margin-right: -40;">
                            {!! $categories->appends(Request::except('page'))->render() !!}

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </blog-categories>

@endsection
