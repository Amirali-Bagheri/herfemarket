<div class="col-lg-4 col-md-3 col-sm-12">
    <div class="sidebar">

        <div class="side-widget">
            <div class="side-widget-header border-0">
                <h4><i class="ti-search"></i>جستجو در مطالب</h4>
            </div>

            <div class="side-widget-body p-t-10">
                <div class="input-group">
                    <input wire:model.defer="search" type="text" class="form-control" placeholder="جستجو...">
                    <span class="input-group-btn">
                            <button wire:click="submitSearch" type="button" class="btn btn-primary btn-lg">برو</button>
                        </span>
                </div>
            </div>
        </div>

        <div class="side-widget">
            <div class="side-widget-header">
                <h4><i class="ti-check-box"></i>آخرین مطالب</h4>
            </div>
            <div class="side-widget-body p-t-10">
                <div class="side-list">
                    <ul class="side-blog-list">
                        @forelse ($latestPosts as $latestPost)
                            <li>
                                <a href="#">
                                    <div class="blog-list-img">
                                        <img src="{{$latestPost->thumbnail_url}}" class="img-responsive"
                                             alt="{{$latestPost->title}}">
                                    </div>
                                </a>
                                <div class="blog-list-info">
                                    <h6><a href="{{$latestPost->link}}" title="blog">{{$latestPost->title}}</a></h6>
                                    <div class="blog-post-meta">
                                        <span
                                            class="updated">{{verta($latestPost->created_at)->format('%d %B %Y')}}</span>
                                        | <a
                                            href="#" rel="tag">{{$latestPost->categories->first()->title ?? null}}</a>
                                    </div>
                                </div>
                            </li>
                        @empty

                        @endforelse
                    </ul>
                </div>
            </div>
        </div>

        <div class="side-widget">
            <div class="side-widget-header">
                <h4><i class="ti-briefcase"></i>دسته بندی مطالب</h4>
            </div>
            <div class="side-widget-body p-t-10 p-b-0">
                <div class="side-list">
                    <ul class="category-list">
                        @foreach ($postsCategories as $postsCategory)
                            <li><a href="{{route('site.blog.category',$postsCategory->slug)}}">{{$postsCategory->title}}
                                    <span>{{$postsCategory->posts_count}}</span></a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

    </div>
</div>
