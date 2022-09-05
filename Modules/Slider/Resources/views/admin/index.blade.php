@extends('admin.layouts.master')
@section('pageTitle','مدیریت اسلایدر ها')

@section('content')

    @include('admin.layouts.errors')
    <sliders inline-template>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title float-right">فهرست اسلایدر ها </h3>
                    </div>
                    <div class="card-tools" style="margin: 10px">
                        <form action="{{route('admin.sliders.search')}}" id="search_form" method="get" role="search"
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
                            <a class="float-left text-decoration-none" href="{{route('admin.sliders.create')}}">
                                <button type="button" class="btn btn-block btn-success">اسلایدر جدید</button>
                            </a>


                        </div>

                    </div>
                    <div class="card-body  table-responsive">

                        <table class="table table-hover">
                            <tr>
                                <th><input class="icheck" type="checkbox" id="check_all"></th>
                                <th>@sortablelink('id', 'شناسه', ['filter' => 'active, visible'])</th>
                                <th>@sortablelink('title', 'عنوان', ['filter' => 'active, visible'])</th>
                                <th>@sortablelink('slug', 'نام نمایشی', ['filter' => 'active, visible'])</th>
                                <th>@sortablelink('status', 'وضعیت', ['filter' => 'active, visible'])</th>
                                <th>@sortablelink('updated_at', 'زمان ارسال/ویرایش', ['filter' => 'active, visible'])
                                </th>
                                <th>گزینه ها</th>
                            </tr>
                            @if($sliders && count($sliders) > 0)
                                @foreach($sliders as $slider)
                                    <tr>
                                        <td><input type="checkbox" class="check" data-id="{{$slider->id}}"></td>
                                        <td>{{$slider->id}}</td>
                                        <td>{{$slider->title}}</td>
                                        <td>{{$slider->slug}}</td>
                                        <td class="text-center">
                                            @if ($slider->status == 1)
                                                <span class="badge badge-success">فعال</span>
                                            @else
                                                <span class="badge badge-danger">غیر فعال</span>
                                            @endif
                                        </td>
                                        <td>{{verta($slider->updated_at)->timezone('Asia/Tehran')->format('H:i %B %d، %Y')}}</td>
                                        <td>

                                            <a style="margin: 5px;" title="ویرایش"
                                               href="{{route('admin.sliders.update',$slider->id)}}">
                                                <i class="fa fa-edit"></i></a>
                                            <a title="حذف" style="margin: 5px;"
                                               href="{{route('admin.sliders.destroy',$slider->id)}}">
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
                            {!! $sliders->withQueryString()->links('admin.layouts.pagination') !!}
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </sliders>

@endsection
