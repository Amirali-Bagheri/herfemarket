@extends('admin.layouts.master')
@section('pageTitle','مشاهده پست '.$post->title)

@section('content')

    <posts inline-template>

        <div class="row">
            <div class="col-12">

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">اطلاعات پست: {{$post->title}}</h3>

                    </div>
                </div>

                <comments inline-template>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">دیدگاه ها</h3>
                        </div>
                        <div class="card-body  table-responsive">

                            <table class="table table-hover">
                                <tr>
                                    <th>@sortablelink('id', 'شناسه')</th>
                                    <th>نام کاربر</th>
                                    <th>متن دیدگاه</th>
                                    <th>@sortablelink('status', 'وضعیت')</th>
                                    <th>@sortablelink('created_at', 'زمان ارسال')</th>
                                    <th>گزینه ها</th>
                                </tr>

                                @forelse ($comments as $comment)
                                    <tr>

                                        <td>{{$comment->id}}</td>
                                        <td><a class="text-decoration-none" style="color: #000"
                                               href="{{route('admin.users.show',$comment->user->id)}}">{{$comment->user->full_name}}</a>
                                        </td>
                                        <td>{{\Illuminate\Support\Str::limit($comment->body,50)}}</td>
                                        <td>
                                            @if($comment->status == 0)
                                                <a style="margin: 5px;" href="javascript:void(0)"
                                                   @click="updateStatus({{$comment->id}})"><span
                                                        class="badge bg-warning">در حال
                                            بررسی</span></a>
                                            @elseif(($comment->status == 1))
                                                <a style="margin: 5px;" href="javascript:void(0)"
                                                   @click="updateStatus({{$comment->id}})"><span
                                                        class="badge bg-success">تایید
                                            شده</span></a>
                                            @elseif(($comment->status == 2))
                                                <a style="margin: 5px;" href="javascript:void(0)"
                                                   @click="updateStatus({{$comment->id}})"><span
                                                        class="badge bg-danger">رد
                                            شده</span></a>
                                            @endif
                                        </td>
                                        <td>{{verta($comment->created_at)->timezone('Asia/Tehran')->format('H:i %B %d، %Y')}}
                                        </td>
                                        <td><a style="margin: 5px;" title="پاسخ دادن"
                                               @click="replyComment({{ $post->id }},{{ $comment->id }})"
                                               href="javascript:void(0)">
                                                <i class="fa fa-reply"></i></a></td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" align="center">دیدگاهی برای این پست ثبت نشده</td>
                                    </tr>
                                @endforelse

                            </table>

                        </div>
                    </div>

                </comments>

            </div>
            <!-- /.col -->
        </div>

    </posts>


@endsection
