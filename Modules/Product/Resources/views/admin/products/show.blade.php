@extends('admin.layouts.master')
@section('pageTitle','مشاهده محصول '.$product->title)

@section('content')

    {{--
        <products inline-template>

            <div class="row">
                <div class="col-12">

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">اطلاعات محصول: {{$product->title}}</h3>

                        </div>
                    </div>


                    @isset($comments)
                    <comments inline-template>
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">دیدگاه ها ({{$comments->count()}})</h3>
                            </div>
                            <div class="card-body  table-responsive">

                                <table class="table table-hover">
                                    <tr>
                                        <th>@sortablelink('id', 'شناسه', ['filter' => 'active, visible'])</th>
                                        <th>نام کاربر</th>
                                        <th>متن دیدگاه</th>
                                        <th>@sortablelink('status', 'وضعیت', ['filter' => 'active, visible'])</th>
                                        <th>@sortablelink('created_at', 'زمان ارسال', ['filter' => 'active, visible'])</th>
                                        <th>گزینه ها</th>
                                    </tr>
                                    @forelse($comments as $comment)

                                        <tr>

                                            <td>{{$comment->id}}</td>
                                            <td><a class="text-decoration-none" style="color: #000"
                                                   href="{{route('admin.users.show',$comment->user->id)}}">{{$comment->user->full_name}}</a>
                                            </td>
                                            <td>{{\Illuminate\Support\Str::limit($comment->body,50)}}</td>
                                            <td>
                                                @if($comment->status == 0)
                                                    <a style="margin: 5px;"
                                                       href="javascript:void(0)"
                                                       @click="updateStatus({{$comment->id}})"
                                                    ><span
                                                            class="badge bg-warning">در حال بررسی</span></a>
                                                @elseif(($comment->status == 1))
                                                    <a style="margin: 5px;" href="javascript:void(0)"
                                                       @click="updateStatus({{$comment->id}})"
                                                    ><span
                                                            class="badge bg-success">تایید شده</span></a>
                                                @elseif(($comment->status == 2))
                                                    <a style="margin: 5px;" href="javascript:void(0)"
                                                       @click="updateStatus({{$comment->id}})"><span
                                                            class="badge bg-danger">رد شده</span></a>
                                                @endif
                                            </td>
                                            <td>{{verta($comment->created_at)->timezone('Asia/Tehran')->format('H:i %B %d، %Y')}}</td>
                                            <td><a style="margin: 5px;"
                                                   title="پاسخ دادن"
                                                   @click="replyComment({{ $product->id }},{{ $comment->id }})"
                                                   href="javascript:void(0)">
                                                    <i class="fa fa-reply"></i></a></td>
                                        </tr>

                                        --}}
    {{--            @include('site.products.comment_replies', ['comments' => $comment->replies])--}}{{--


                                    @empty
                                        <tr>
                                            <td colspan="6" align="center">دیدگاهی برای این محصول ثبت نشده</td>
                                        </tr>
                                    @endforelse
                                    --}}
    {{--                                                @include('site.products.comment_replies', ['comments' => $comments, 'product_id' => $product->id])--}}{{--



                                </table>


                            </div>
                        </div>

                    </comments>
                    @endisset
                </div>
                <!-- /.col -->
            </div>

        </products>

    --}}

@endsection
