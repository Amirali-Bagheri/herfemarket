<div>

    <div class="shop_area shop_fullwidth">
        <div class="container">
            <div class="row">
                <div class="col-12">

                    <!--shop banner area start-->
                    <div class="shop_banner_area mb-30">
                        <div class="row">
                            <div class="col-12">
                                <div class="shop_banner_thumb">
                                    <img src="assets/img/bg/banner16.jpg" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--shop banner area end-->


                    <!--shop wrapper start-->
                    <div class="row no-gutters shop_wrapper grid_4">
                        @forelse($businesses as $business)
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <article class="single_product">
                                <figure>
                                    <div class="product_thumb text-center justify-items-center">
                                        <a class="primary_img text-center justify-items-center" href="{{ route('site.businesses.single',$business->slug) }}">
                                            <img width="150" src="/uploads/logos/{{ $business->logo }}" alt="">
                                        </a>
                                    </div>

                                    <div class="product_content grid_content">
                                        <div class="product_content_inner">
                                            <h4 class="product_name">
                                                <a href="{{ route('site.businesses.single',$business->slug) }}">
                                                    {{ $business->name }}
                                                </a>
                                            </h4>
                                        </div>
                                    </div>

                                </figure>
                            </article>
                        </div>

                        @empty
                        کسب و کاری برای نمایش وجود ندارد
                        @endforelse

                    </div>

                </div>
            </div>
        </div>
    </div>

</div>
