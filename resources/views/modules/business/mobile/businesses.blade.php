<div>

    @include('mobile.layouts.sidebar')

    @push ('scripts')
        <script type="text/javascript">
            window.onscroll = function (ev) {
                if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight) {
                    window.livewire.emit('load-more');
                }
            };
        </script>
    @endpush

    <div class="top-businesses-area py-3">
        <div class="container">
            <div class="section-heading d-flex align-items-center justify-content-between">
                <h6 class="ml-1">
                    @isset($pageTitle)
                        {{ setting('site_name') . ' - ' . $pageTitle }}
                    @endisset
                </h6>
            </div>

            <div class="row g-3" wire:loading.class="blur" wire:init="loadBusinesses">
                <div
                    class="fixed top-0 left-0 right-0 bottom-0 w-full h-screen z-50 overflow-hidden bg-gray-200 opacity-75 flex flex-col items-center justify-center d-none"
                    wire:loading.class.remove="d-none"
                    style="position: absolute; left: 50%; top: 50%; transform: translateX(-50%);">
                    <svg width="20" viewBox="0 0 135 140" xmlns="http://www.w3.org/2000/svg"
                         fill="rgb(45, 55, 72)"
                         class="w-8 h-8">
                        <rect y="10" width="15" height="120" rx="6">
                            <animate attributeName="height" begin="0.5s" dur="1s"
                                     values="120;110;100;90;80;70;60;50;40;140;120"
                                     calcMode="linear" repeatCount="indefinite"></animate>
                            <animate attributeName="y" begin="0.5s" dur="1s"
                                     values="10;15;20;25;30;35;40;45;50;0;10"
                                     calcMode="linear"
                                     repeatCount="indefinite"></animate>
                        </rect>
                        <rect x="30" y="10" width="15" height="120" rx="6">
                            <animate attributeName="height" begin="0.25s" dur="1s"
                                     values="120;110;100;90;80;70;60;50;40;140;120"
                                     calcMode="linear" repeatCount="indefinite"></animate>
                            <animate attributeName="y" begin="0.25s" dur="1s"
                                     values="10;15;20;25;30;35;40;45;50;0;10"
                                     calcMode="linear"
                                     repeatCount="indefinite"></animate>
                        </rect>
                        <rect x="60" width="15" height="140" rx="6">
                            <animate attributeName="height" begin="0s" dur="1s"
                                     values="120;110;100;90;80;70;60;50;40;140;120"
                                     calcMode="linear" repeatCount="indefinite"></animate>
                            <animate attributeName="y" begin="0s" dur="1s"
                                     values="10;15;20;25;30;35;40;45;50;0;10"
                                     calcMode="linear"
                                     repeatCount="indefinite"></animate>
                        </rect>
                        <rect x="90" y="10" width="15" height="120" rx="6">
                            <animate attributeName="height" begin="0.25s" dur="1s"
                                     values="120;110;100;90;80;70;60;50;40;140;120"
                                     calcMode="linear" repeatCount="indefinite"></animate>
                            <animate attributeName="y" begin="0.25s" dur="1s"
                                     values="10;15;20;25;30;35;40;45;50;0;10"
                                     calcMode="linear"
                                     repeatCount="indefinite"></animate>
                        </rect>
                        <rect x="120" y="10" width="15" height="120" rx="6">
                            <animate attributeName="height" begin="0.5s" dur="1s"
                                     values="120;110;100;90;80;70;60;50;40;140;120"
                                     calcMode="linear" repeatCount="indefinite"></animate>
                            <animate attributeName="y" begin="0.5s" dur="1s"
                                     values="10;15;20;25;30;35;40;45;50;0;10"
                                     calcMode="linear"
                                     repeatCount="indefinite"></animate>
                        </rect>
                    </svg>
                </div>

                @if ($businesses and $businesses->count() > 0)
                    @foreach($businesses as $business)
                        <div class="col-6 col-md-4 col-lg-3">
                            <a style="font-size: 9px;" class="product-title d-block text-decoration-none"
                               href="{{route('site.businesses.single',$business->slug)}}">
                                <div class="card blog-card text-center justify-content-center">
                                    <div class="post-img"><img style="width:80px;"
                                                               src="/uploads/logos/{{$business->logo}}" alt=""></div>

                                    <div class="post-content" style="position:unset !important;">
                                        <p class="post-catagory d-block color-black"
                                           style="font-size:13px; color:#000;">{{\Illuminate\Support\Str::limit($business->name,70)}}</p>
                                        <p class="post-meta d-block color-black mt-3" style="font-size:11px;">
                                            {{ $business->business_type->title }}
                                            {{ isset($business->category_parent->title) ? '/' .$business->category_parent->title : null}}
                                        </p>
                                        {{--                                        <a class="post-title d-block" href="blog-details.html">5 نظر درباره سوها</a>--}}
                                        {{--                                        <div class="post-meta d-flex align-items-center justify-content-between flex-wrap mb-3"><a href="#"><i class="lni lni-user"></i>یاسین</a><span><i class="lni lni-timer"></i>2 دقیقه</span></div>--}}
                                        <a
                                            class="btn btn-sm read-more-btn w-100 custom-button"
                                            href="{{route('site.businesses.single',$business->slug)}}">مشاهده</a>
                                    </div>

                                </div>
                            </a>
                        </div>
                        {{--
                                                <div class="col-6 col-md-4 col-lg-3">
                                                    <div class="card top-product-card">
                                                        <div class="card-body">
                                                            --}}
                        {{--                                    <span class="badge badge-success">فروش</span>--}}{{--

                                                            --}}
                        {{--                                    <a class="wishlist-btn" href="#"><i class="lni lni-heart"></i></a--}}{{--

                                                            <a class="product-thumbnail d-block"
                                                               href="{{route('site.businesses.single',$business->slug)}}">
                                                                <img loading="lazy" class="mb-2" style="width: 80px"
                                                                     src="/uploads/logos/{{ $business->logo  }}"
                                                                     alt="{{$business->name}}"></a>
                                                            <a style="font-size: 9px;" class="product-title d-block text-decoration-none"
                                                               href="{{route('site.businesses.single',$business->slug)}}">{{\Illuminate\Support\Str::limit($business->title,70)}}</a>
                                                            <p class="text-center justify-content-center mt-2"
                                                               style="font-size: 11px; color: #000;">
                                                            {{$business->name}}

                                                                </p>
                                                            <a class="btn w-100"  href="#">مشاهده</a>

                                                        </div>
                                                    </div>
                                                </div>
                        --}}
                    @endforeach
                @else
                    @if ($this->readyToLoad)
                        <div class="text-center justify-content-center">
                            <p>موردی برای نمایش یافت نشد</p>
                        </div>
                    @else
                        <div class="text-center justify-content-center">
                            <p>در حال بارگذاری...</p>
                        </div>
                    @endif
                @endif

                @if($businesses->count() > 0 and $businesses->count() >= $perPage)
                    <div class="col-12">
                        <div wire:click="loadMore" class="select-all-products-btn btn btn-danger w-100">مشاهده بیشتر
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>

</div>
