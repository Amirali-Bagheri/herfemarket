<div>
    <div class="section-full small-device p-tb50 bg-white">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-9 col-md-7 col-sm-12 blog-post-outer">

                    <div class="container-fluid" style="direction: ltr;">

                        <div class="row">
                            <div class="col-lg-8 col-md-7 col-sm-12" style="direction: rtl;">
                                <div class="news-grid row">

                                    @forelse ($posts as $post)
                                        <div class="col-lg-6 col-md-6 col-sm-12 m-b30">
                                            <div
                                                class="blog-post blog-grid-1 overlay-wraper post-overlay large-date bg-cover bg-no-repeat bg-top-center"
                                                style="height: 240px; width: auto; margin: 0;">
                                                <img src="/uploads/thumbnails/tn_large_{{ $post->image }}"
                                                     class="img-fluid"
                                                     alt=" {{ $post->title }}"
                                                     style="height: 240px; width: auto; margin: 0; border-radius:10px;"
                                                     loading="lazy">
                                                <div class="overlay-main overlay-gradient"
                                                     style="border-radius:10px;"></div>
                                                <div class="wt-post-info text-white">
                                                    <div class="post-overlay-position">
                                                        <div class="post-content-outer p-a30">

                                                            <div class="wt-post-title ">
                                                                <h5 class="post-title">
                                                                    <a href="{{ route('site.blog.single',$post->slug) }}"
                                                                       class="text-white text-capitalize">
                                                                        {{ $post->title }}
                                                                    </a>
                                                                </h5>
                                                            </div>
                                                            <div
                                                                class="wt-post-meta justify-content-center text-center">
                                                                <p class="post-author text-center">
                                                                    {{verta($post->created_at)->timezone('Asia/Tehran')->format('%d %B %Y')}}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="text-center">پستی ثبت نشده است</div>
                                    @endforelse


                                </div>

                                <ul class="pagination m-b0 p-b0">
                                    {{ $posts->links('site.layouts.pagination') }}
                                </ul>
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
