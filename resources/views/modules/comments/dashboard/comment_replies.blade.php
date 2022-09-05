<ul class="review-list">
    @foreach($comments as $comment)

        <li>
            <div class="reviews-box">
                <div class="review-body">
                    <div class="review-avatar">
                        <img alt="" src="{{$comment->user->avatar_url}}"
                             class="avatar avatar-140 photo">
                    </div>
                    <div class="review-content">
                        <div class="review-info">
                            <div class="review-comment">
                                <div class="review-author">
                                    {{$comment->user->full_name}}
                                </div>
                                {{--                                <div class="review-comment-stars">--}}
                                {{--                                    <i class="fa fa-star"></i>--}}
                                {{--                                    <i class="fa fa-star"></i>--}}
                                {{--                                    <i class="fa fa-star"></i>--}}
                                {{--                                    <i class="fa fa-star"></i>--}}
                                {{--                                    <i class="fa fa-star empty"></i>--}}
                                {{--                                </div>--}}
                            </div>
                            <div class="review-comment-date">
                                <div class="review-date">
                                    <span>{{verta($comment->updated_at)->timezone('Asia/Tehran')->format('H:i %B %d، %Y')}}</span>
                                </div>
                            </div>
                        </div>
                        <p>
                            {{$comment->body}}
                        </p>
                        <div class="reply">
                            <a href="javascript:void(0)" data-target="#reply-{{$comment->id}}"
                               data-toggle="modal"
                               class="comment-reply-link">پاسخ</a>
                        </div>
                        <div wire:ignore.self class="modal fade" id="reply-{{ $comment->id }}" tabindex="-1"
                             role="dialog" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">پاسخ دیدگاه
                                        </h5>
                                        <button type="button" class="close ml-0"
                                                data-dismiss="modal"
                                                aria-label="Close">
                                                    <span
                                                        aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                    <form wire:submit.prevent="comment({{$comment->id}})">
                                        <div class="modal-body">
                                                    <textarea aria-required="true" rows="5" cols="30"
                                                              name="body" id="comment_message"
                                                              class="form-control"
                                                              wire:model.defer="body"
                                                              placeholder="متن *">
                                                    </textarea>

                                            @error('body') <span
                                                class="error font-small">{{ $message }}</span> @enderror

                                        </div>
                                        <div class="modal-footer" style="display: flow-root;">
                                            <button type="button"
                                                    class="btn btn-secondary float-left"
                                                    data-dismiss="modal">
                                                خروج
                                            </button>
                                            <button type="submit" data-dismiss="modal"
                                                    class="btn btn-primary float-right">
                                                ارسال
                                            </button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            @include('comments::site.comment_replies', ['comments' => $comment->replies, 'model' => $model])

        </li>

    @endforeach

</ul>

