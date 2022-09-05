<div>
    <div class="review-wrapper">
        <div class="review-wrapper-header">
            <h4>{{$model->comments()->count()}} دیدگاه</h4>
        </div>
        <div class="review-wrapper-body">
            <ul class="review-list">

                @forelse($model->comments()->where('parent_id',0)->get() as $comment)

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
                                            {{--                                            <div class="review-comment-stars">--}}
                                            {{--                                                <i class="fa fa-star"></i>--}}
                                            {{--                                                <i class="fa fa-star"></i>--}}
                                            {{--                                                <i class="fa fa-star"></i>--}}
                                            {{--                                                <i class="fa fa-star"></i>--}}
                                            {{--                                                <i class="fa fa-star empty"></i>--}}
                                            {{--                                            </div>--}}
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

                @empty


                    <li class="comment">
                        <div class="comment-body bg-orange-light text-center">
                            <h6>دیدگاهی ثبت نشده است</h6>
                        </div>
                    </li>


                @endforelse

            </ul>
        </div>
    </div>

    <div class="comment-respond" id="respond">
        <h4 class="comment-reply-title text-primary mb-3" id="reply-title">دیدگاه و امتیاز خود را ثبت کنید</h4>
        <form class="comment-form" id="commentform" wire:submit.prevent="comment">
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <div class="review-comment-stars rating-opt">
                            <i wire:click="setRating(1)" class="fa fa-star"></i>
                            <i wire:click="setRating(2)" class="fa fa-star"></i>
                            <i wire:click="setRating(3)" class="fa fa-star"></i>
                            <i wire:click="setRating(4)" class="fa fa-star"></i>
                            <i wire:click="setRating(5)" class="fa fa-star"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="comment" class="text-black font-w600">Comment</label>
                        <textarea class="form-control height-110" wire:model.defer="body" rows="8" id="comment"
                                  data-max-length="200" placeholder="نظرخود را بنویسید ..."></textarea>

                        @error('body')
                        <span style="font-size:11px;" class="error font-small">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <button type="submit" class="submit btn btn-primary" id="submit" name="submit">
                            ارسال
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>

</div>
