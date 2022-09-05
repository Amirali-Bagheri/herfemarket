@extends('admin.layouts.master')
@section('pageTitle','تبلیغات')

@section('content')
    @include('admin.layouts.errors')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title float-right">فهرست تبلیغات </h3>
                </div>
                <div class="card-tools" style="margin: 10px">
                    <form action="{{route('admin.ads.search')}}" id="search_form" method="get" role="search"
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
                        <a class="float-left text-decoration-none" href="{{route('admin.ads.create')}}">
                            <button type="button" class="btn btn-block btn-success">تبلیغ جدید</button>
                        </a>


                    </div>

                </div>
                <div class="card-body table-responsive">

                    <table class="table table-hover">
                        <tr>
                            {{--                            <th><input class="icheck" type="checkbox" id="check_all"></th>--}}
                            <th>شناسه</th>
                            <th>تصویر</th>
                            <th>عنوان</th>
                            <th>نام نمایشی</th>
                            <th>وضعیت</th>
                            <th>زمان</th>
                            <th>گزینه ها</th>
                        </tr>

                        {{--                            @if($ads && count($ads) > 0)--}}

                        @forelse($ads as $ad)

                            <tr>
                                {{--                            <td><input type="checkbox" class="check" data-id="{{$ad->id}}"></td>--}}
                                <td>{{$ad->id}}</td>
                                <td><img width="30" height="30" src="{{ $ad->image }}"></td>

                                <td>{{$ad->title}}</td>
                                <td>{{$ad->slug}}</td>
                                <td class="text-center">
                                    @if ($ad->status == 1)
                                        <span class="badge badge-success">فعال</span>
                                    @else
                                        <span class="badge badge-danger">غیر فعال</span>
                                    @endif
                                </td>
                                <td>{{verta($ad->updated_at)->timezone('Asia/Tehran')->format('H:i %B %d، %Y')}}</td>
                                <td>

                                    <a style="margin: 5px;" title="ویرایش"
                                       href="{{route('admin.ads.update',$ad->id)}}">
                                        <i class="fa fa-edit"></i></a>
                                    <a title="حذف" style="margin: 5px;"
                                       href="{{route('admin.ads.destroy',$ad->id)}}">
                                        <i class="fa fa-trash-alt"></i></a>
                                </td>
                            </tr>

                        @empty

                            {{--                            @else--}}

                            <tr>
                                <td colspan="8" align="center">تبلیغی برای نمایش وجود ندارد</td>
                            </tr>

                        @endforelse

                    </table>
                    <div class="row" style="margin-top: 20px; margin-right: -40;">
                        {!! $ads->links() !!}

                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
