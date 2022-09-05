@extends('admin.layouts.master')
@section('pageTitle','مدیریت پست ها')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title float-right">فهرست پست ها</h3>
        </div>
        <div class="card-tools" style="margin: 10px">
            <form action="{{route('admin.posts.search')}}" id="search_form" method="get" role="search"
                  class="form-inline typeahead error-form float-right">

                <div class="input-group md-form form-sm form-2 pl-0">
                    <input type="search" name="s" class="form-control mr-sm-2 search-input rtl"
                           placeholder="جستجو ..."
                           style="direction: rtl;">

                    <a href="javascript:void(0)" onclick="document.getElementById('search_form').submit();">
                        <i class="fas fa-search" style="color: black" aria-hidden="true"></i>
                    </a>
                </div>

            </form>

            <div class="form-inline mr-4 float-left">
                <button class="btn btn-danger dropdown-toggle" type="button" data-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false">عملیات
                </button>

                <div class="dropdown-menu dropdown-danger text-center">
                    <a class="dropdown-item delete-all" @click="deleteAll()" href="javascript:void(0)">حذف
                        انتخاب شده ها</a>
                </div>
                <a class="float-left text-decoration-none" href="{{route('admin.posts.create')}}">
                    <button type="button" class="btn btn-block btn-success">پست جدید</button>
                </a>

            </div>

        </div>

        <div class="card-body  table-responsive" style="padding: 0.60rem;">

            <table class="table table-hover">
                <tr>
                    <th>
                        <input type="checkbox" class="form-check-input" id="check_all">
                        <label class="form-check-label" for="check_all"></label>
                    </th>
                    <th>@sortablelink('id', 'شناسه', ['filter' => 'active, visible'])</th>
                    <th>@sortablelink('title', 'عنوان', ['filter' => 'active, visible'])</th>
                    <th>@sortablelink('view_count', 'تعداد بازدید', ['filter' => 'active, visible'])</th>
                    <th>@sortablelink('updated_at', 'زمان ارسال/ویرایش', ['filter' => 'active, visible'])</th>
                    <th>@sortablelink('status', 'وضعیت', ['filter' => 'active, visible'])</th>
                    <th>گزینه ها</th>
                </tr>

                @if($posts && count($posts) > 0)
                    @foreach($posts as $post)

                        <tr id="tr_{{$post->id}}">
                            <td>
                                <input type="checkbox" class="form-check-input check" id="check-{{$post->id}}"
                                       data-id="{{$post->id}}">
                                <label class=" form-check-label" for="check-{{$post->id}}"></label>

                            </td>
                            <td>{{$post->id}}</td>
                            <td><a target="_blank"
                                   href="{{ route('site.blog.single',$post->slug)}}">{{$post->title}}</a></td>
                            <td>{{views($post)->unique()->count()}}</td>
                            <td>{{verta($post->updated_at)->timezone('Asia/Tehran')->format('H:i %B %d، %Y')}}</td>
                            <td class="text-center">
                                @if ($post->status == 1)
                                    <span class="badge badge-success">فعال</span>
                                @else
                                    <span class="badge badge-danger">غیر فعال</span>
                                @endif
                            </td>

                            <td class="text-center">
                                <a style="margin: 5px;" href="{{route('admin.posts.show',$post->id)}}">
                                    <i class="fa-regular fa-eye"></i></a>

                                {{--                                        <a style="margin: 5px;" href="{{route('admin.posts.share',['id'=>$post->id])}}">--}}
                                {{--                                            <i class="fa fa-share"></i></a>--}}
                                <a style="margin: 5px;" href="{{route('admin.posts.update',$post->id)}}">
                                    <i class="fa fa-edit"></i></a>
                                <a style="margin: 5px;" href="{{route('admin.posts.delete',$post->id)}}">
                                    <i class="fa fa-trash-alt"></i></a>
                            </td>
                        </tr>

                    @endforeach
                @else
                    <tr>
                        <td colspan="8" align="center">پستی برای نمایش وجود ندارد</td>
                    </tr>

                @endif

            </table>
            <div class="row" style="margin-top: 20px; margin-right: -40;">
                {!! $posts->appends(Request::except('page'))->render() !!}

            </div>

        </div>
    </div>

@endsection
