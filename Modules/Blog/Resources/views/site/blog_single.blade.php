<div>
    <div class="section-full small-device p-tb50 bg-white">
        <div class="container-fluid">
            <div class="row">

                <div class="col-lg-9 col-md-7 col-sm-12 blog-post-outer">

                    <div class="container-fluid">

                        <div class="row" style="direction: ltr;">
                            <div class="col-lg-8 col-md-7 col-sm-12" style="direction: rtl;">
                                <div
                                    class="blog-post blog-md date-style-1 blog-list-1 clearfix m-b60 clearfix bg-white shadow">
                                    <div class="wt-post-media wt-img-effect zoom-slow">
                                        <img class="img-responsive" src="/uploads/{{ $post->image }}"
                                             alt="{{ $post->title }}">
                                    </div>
                                    <div class="wt-post-info  bg-white p-a30">
                                        <div class="wt-post-meta ">
                                            <ul>
                                                <li class="post-date"><i
                                                        class="fas fa-calendar site-text-secondry"></i><span>
                                                    {{verta($post->updated_at)->timezone('Asia/Tehran')->format('%d %B %Y')}}
                                                </span></li>
                                                <li class="post-comment"><i
                                                        class="fas fa-comments site-text-secondry"></i><a
                                                        href="javascript:void(0);">{{ $post->comments->count() }}
                                                        نظر</a>
                                                </li>
                                                <li class="post-view-user"><i
                                                        class="fa-regular fa-eye site-text-secondry"></i>{{ $post->view_count }}
                                                    بازدید
                                                </li>
                                                <li class="post-view-user">
                                                    <i class="fas fa-tag site-text-secondry">
                                                    </i>


                                                    دسته بندی: {{ $post->categories->implode('title', ', ') }}</li>

                                            </ul>
                                        </div>
                                        <div class="wt-post-title ">
                                            <h3 class="post-title">{{ $post->title }}</h3>
                                        </div>

                                        <div class="wt-post-text">
                                            {!! html_entity_decode($post->content) !!}
                                        </div>

                                        <div class="bg-white  widget_tag_cloud m-t30">
                                            <div class="tagcloud">
                                                @foreach (explode(',', $post->tags) as $tag)
                                                    <a href="javascript:void(0);" style="margin: 5px;">{{ $tag }}</a>
                                                @endforeach
                                            </div>
                                        </div>

                                    </div>

                                </div>

                                {{-- <div class="clearfix bg-white shadow p-a30" id="comment-list">
                        <div class="comments-area" id="comments">
                            <h2 class="comments-title m-t0">۴ نظرات</h2>
                            <div>
                                <!-- COMMENT LIST START -->
                                <ol class="comment-list">
                                    <li class="comment">
                                        <!-- COMMENT BLOCK -->
                                        <div class="comment-body bg-orange-light">
                                            <div class="comment-author vcard">
                                                <img class="avatar photo" src="images/testimonials/pic1.jpg" alt="">
                                                <cite class="fn">محمد جعفری</cite>
                                                <span class="says">says:</span>
                                            </div>
                                            <div class="comment-meta">
                                                <a href="javascript:void(0);">۱۵ اسفند ۱۳۹۸</a>
                                            </div>


                                            <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از
                                                طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان
                                                که لازم است.</p>
                                            <div class="reply">
                                                <a href="javscript:;" class="comment-reply-link">بیشتر</a>
                                            </div>
                                        </div>
                                        <!-- SUB COMMENT BLOCK -->
                                        <ol class="children">
                                            <li class="comment odd parent">

                                                <div class="comment-body bg-orange-light">
                                                    <div class="comment-author vcard">
                                                        <img class="avatar photo" src="images/testimonials/pic3.jpg" alt="">
                                                        <cite class="fn">سعید فرهمند </cite>
                                                        <span class="says">says:</span>
                                                    </div>
                                                    <div class="comment-meta">
                                                        <a href="javascript:void(0);">۱۵ اسفند ۱۳۹۸</a>
                                                    </div>
                                                    <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با
                                                        استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در
                                                        ستون و سطرآنچنان که لازم است.</p>
                                                    <div class="reply">
                                                        <a href="javscript:;" class="comment-reply-link">بیشتر</a>
                                                    </div>

                                                </div>

                                                <ol class="children">
                                                    <li class="comment odd parent">
                                                        <div class="comment-body bg-orange-light">
                                                            <div class="comment-author vcard">
                                                                <img class="avatar photo" src="images/testimonials/pic2.jpg"
                                                                    alt="">
                                                                <cite class="fn">جواد شمس </cite>
                                                                <span class="says">says:</span>
                                                            </div>
                                                            <div class="comment-meta">
                                                                <a href="javascript:void(0);">۱۵ اسفند ۱۳۹۸</a>
                                                            </div>
                                                            <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و
                                                                با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه
                                                                روزنامه و مجله در ستون و سطرآنچنان که لازم است</p>
                                                            <div class="reply">
                                                                <a href="javscript:;" class="comment-reply-link">بیشتر</a>
                                                            </div>

                                                        </div>
                                                    </li>
                                                </ol>

                                            </li>
                                        </ol>
                                    </li>
                                    <li class="comment">
                                        <!-- COMMENT BLOCK -->
                                        <div class="comment-body bg-orange-light">
                                            <div class="comment-author vcard">
                                                <img class="avatar photo" src="images/testimonials/pic1.jpg" alt="">
                                                <cite class="fn">سام محبی</cite>
                                                <span class="says">says:</span>
                                            </div>
                                            <div class="comment-meta">
                                                <a href="javascript:void(0);">۱۵ اسفند ۱۳۹۸</a>
                                            </div>
                                            <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از
                                                طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان
                                                که لازم است</p>
                                            <div class="reply">
                                                <a href="javscript:;" class="comment-reply-link">بیشتر</a>
                                            </div>
                                        </div>
                                    </li>
                                </ol>
                                <!-- COMMENT LIST END -->

                                <!-- LEAVE A REPLY START -->
                                <div class="comment-respond m-t30 p-a20 bg-orange-light" id="respond">

                                    <h2 class="comment-reply-title" id="reply-title">ارسال نظر
                                        <small>
                                            <a style="display:none;" href="#" id="cancel-comment-reply-link"
                                                rel="nofollow">لغو پاسخ</a>
                                        </small>
                                    </h2>

                                    <form class="comment-form" id="commentform" method="post">

                                        <p class="comment-form-author">
                                            <label for="author">نام <span class="required">*</span></label>
                                            <input class="form-control" type="text" value="" name="user-comment"
                                                placeholder="نام" id="author">
                                        </p>

                                        <p class="comment-form-email">
                                            <label for="email">ایمیل <span class="required">*</span></label>
                                            <input class="form-control" type="text" value="" name="email"
                                                placeholder="ایمیل" id="email">
                                        </p>

                                        <p class="comment-form-url">
                                            <label for="url">سایت</label>
                                            <input class="form-control" type="text" value="" name="url" placeholder="سایت"
                                                id="url">
                                        </p>

                                        <p class="comment-form-comment">
                                            <label for="comment">نظر</label>
                                            <textarea class="form-control" rows="8" name="comment" placeholder="نظر"
                                                id="comment"></textarea>
                                        </p>

                                        <p class="form-submit">
                                            <button class="site-button-secondry "
                                                type="button">ارسال</button>
                                        </p>

                                    </form>

                                </div>
                                <!-- LEAVE A REPLY END -->
                            </div>
                        </div>
                    </div> --}}
                            </div>

                            <div class="col-lg-4 col-md-5 col-sm-12">

                                @include('site.layouts.sidebar.blog_sidebar_right')

                            </div>
                        </div>

                    </div>


                </div>

                <div class="col-lg-3 col-md-5 col-sm-12">
                    @include('site.layouts.sidebar.main_sidebar')

                </div>

            </div>

        </div>
    </div>
</div>


