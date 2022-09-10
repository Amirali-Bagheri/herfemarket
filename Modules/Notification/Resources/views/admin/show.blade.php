<div>
    <div class="row">
        <div class="col-12">

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">اطلاعات کاربر: {{$user->full_name}}</h3>

                </div>
            </div>

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
                            @if($comments && $comments->count() > 0)
                                @foreach($comments as $comment)

                                    <tr>

                                        <td>{{$comment->id}}</td>
                                        <td><a class="text-decoration-none" style="color: #000"
                                               href="{{route('admin.users.show',$comment->user->id)}}">{{$comment->user->full_name}}</a>
                                        </td>
                                        <td>{{\Illuminate\Support\Str::limit($comment->body,50)}}</td>
                                        <td>
                                            @if($comment->status == 0)
                                                <a style="margin: 5px;"
                                                   href="#"
                                                   @click="updateStatus({{$comment->id}})"
                                                ><span
                                                        class="badge bg-warning">در حال بررسی</span></a>
                                            @elseif(($comment->status == 1))
                                                <a style="margin: 5px;" href="#"
                                                   @click="updateStatus({{$comment->id}})"
                                                ><span
                                                        class="badge bg-success">تایید شده</span></a>
                                            @elseif(($comment->status == 2))
                                                <a style="margin: 5px;" href="#"
                                                   @click="updateStatus({{$comment->id}})"><span
                                                        class="badge bg-danger">رد شده</span></a>
                                            @endif
                                        </td>
                                        <td>{{verta($comment->created_at)->timezone('Asia/Tehran')->format('H:i %B %d، %Y')}}</td>

                                        <td><a style="margin: 5px;"
                                               title="پاسخ دادن"
                                               @click="replyComment({{ $user->id }},{{ $comment->id }})"
                                               href="#">
                                                <i class="fa fa-reply"></i></a></td>
                                    </tr>

                                    {{--            @include('site.users.comment_replies', ['comments' => $comment->replies])--}}


                                @endforeach
                                {{--                                                @include('site.users.comment_replies', ['comments' => $comments, 'user_id' => $user->id])--}}
                            @else

                                <tr>
                                    <td colspan="6" align="center">کاربر دیدگاهی ثبت نکرده است</td>
                                </tr>


                            @endif

                        </table>

                    </div>
                </div>
            </comments>

            {{--
                            <smspanel inline-template>
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">پیامک ها ({{$messages->count()}})</h3>
                                    </div>
                                    <div class="card-body  table-responsive">

                                        <table class="table table-hover">
                                            <tr>
                                                <th>موضوع پیام</th>
                                                <th>نام کاربر</th>
                                                <th>متن پیام</th>
                                                <th>زمان پیام</th>
                                            </tr>
                                            @if($messages && count($messages) > 0)
                                                @foreach($messages as $message)
                                                    <tr>
                                                        <td class="mailbox-subject">
                                                            {{$message->subject}}
                                                        </td>
                                                        <td class="mailbox-name"><a class="text-decoration-none"
                                                                                    href="{{route('admin.users.show',$message->user($message->mobile)->id)}}">{{$message->user($message->mobile)->full_name}}</a>
                                                        </td>
                                                        <td class="mailbox-subject">
                                                            {{\Illuminate\Support\Str::limit($message->text,100)}}
                                                        </td>
                                                        <td class="mailbox-date">{{verta($message->updated_at)->timezone('Asia/Tehran')->format('H:i %B %d، %Y')}}</td>
                                                    </tr>

                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="8" align="center">پیامی برای نمایش وجود ندارد</td>
                                                </tr>

                                            @endif

                                        </table>
                                        <div class="row" style="margin-top: 20px; margin-right: -40;">
                                            {!! $messages->appends(Request::except('page'))->render() !!}

                                        </div>
                                    </div>

                                </div>
                            </smspanel>
            --}}

        </div>
        <!-- /.col -->
    </div>

</div>
