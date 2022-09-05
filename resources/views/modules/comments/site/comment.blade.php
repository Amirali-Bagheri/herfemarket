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

    <div class="review-wrapper">
        <div class="review-wrapper-header">
            <h4>دیدگاه و امتیاز خود را ثبت کنید</h4>
        </div>
        <div class="review-wrapper-body">
            <form wire:submit.prevent="comment">

                <div class="row mb-3">
                    <div class="col-md-12">
                        {{--                    <label style="font-size:12px; " class="m-3 float-right container-fluid">--}}
                        {{--                        امتیاز شما (اختیاری) :--}}
                        {{--                    </label>--}}
                        {{--   <select class="form-control float-right" style="width:120px; font-size:12px;" name="rating"
                                   id="rating"
                                   wire:model.defer="rating">
                               <option>انتخاب کنید</option>
                               <option value="1">خیلی بد</option>
                               <option value="2">بد</option>
                               <option value="3">متوسط</option>
                               <option value="4">خوب</option>
                               <option value="5">خیلی خوب</option>
                           </select>--}}
                        <div class="review-comment-stars rating-opt">
                            <i wire:click="setRating(1)" class="fa fa-star"></i>
                            <i wire:click="setRating(2)" class="fa fa-star"></i>
                            <i wire:click="setRating(3)" class="fa fa-star"></i>
                            <i wire:click="setRating(4)" class="fa fa-star"></i>
                            <i wire:click="setRating(5)" class="fa fa-star"></i>
                        </div>

                        {{--                        <div class="rating-opt">--}}
                        {{--                            <div class="jr-ratenode jr-nomal"></div>--}}
                        {{--                            <div class="jr-ratenode jr-nomal "></div>--}}
                        {{--                            <div class="jr-ratenode jr-nomal "></div>--}}
                        {{--                            <div class="jr-ratenode jr-nomal "></div>--}}
                        {{--                            <div class="jr-ratenode jr-nomal "></div>--}}
                        {{--                        </div>--}}
                    </div>
                </div>

                <div class="row">

                    <div class="col-sm-12 form-group">
                    <textarea class="form-control height-110" wire:model.defer="body"
                              data-max-length="200" placeholder="نظرخود را بنویسید ..."></textarea>

                        @error('body') <span style="font-size:11px;"
                                             class="error font-small">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-primary">ارسال</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
