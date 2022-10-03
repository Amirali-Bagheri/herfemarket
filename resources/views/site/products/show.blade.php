<div>
    <div class="product_page_bg">
        <div class="container">
            <div class="product_details_wrapper mb-55">
                <!--product details start-->
                <div class="product_details">
                    <div class="row">
                        <div class="col-lg-5 col-md-6">
                            <div class="product-details-tab">
                                <div id="img-1" class="zoomWrapper single-zoom">
                                    <a href="#">
                                        <img id="zoom1" src="/uploads/{{$product->images}}" data-zoom-image="/uploads/{{$product->images}}" alt="{{$product->title}}">
                                    </a>
                                </div>
                                <div class="single-zoom-thumb">
                                    <ul class="s-tab-zoom owl-carousel single-product-active" id="gallery_01">
                                        <li>
                                            <a href="#" class="elevatezoom-gallery active" data-update="" data-image="assets/img/product/productbig4.jpg" data-zoom-image="assets/img/product/productbig4.jpg">
                                                <img src="assets/img/product/productbig4.jpg" alt="zo-th-1">
                                            </a>

                                        </li>
                                        <li>
                                            <a href="#" class="elevatezoom-gallery active" data-update="" data-image="assets/img/product/productbig1.jpg" data-zoom-image="assets/img/product/productbig1.jpg">
                                                <img src="assets/img/product/productbig1.jpg" alt="zo-th-1">
                                            </a>

                                        </li>
                                        <li>
                                            <a href="#" class="elevatezoom-gallery active" data-update="" data-image="assets/img/product/productbig2.jpg" data-zoom-image="assets/img/product/productbig2.jpg">
                                                <img src="assets/img/product/productbig2.jpg" alt="zo-th-1">
                                            </a>

                                        </li>
                                        <li>
                                            <a href="#" class="elevatezoom-gallery active" data-update="" data-image="assets/img/product/productbig3.jpg" data-zoom-image="assets/img/product/productbig3.jpg">
                                                <img src="assets/img/product/productbig3.jpg" alt="zo-th-1">
                                            </a>

                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7 col-md-6">
                            <div class="product_d_right">
                                <form action="#">

                                    <h3><a href="#">{{$product->title}}</a></h3>
{{--                                    <div class="product_rating">--}}
{{--                                        <ul>--}}
{{--                                            <li><a href="#"><i class="ion-android-star-outline"></i></a></li>--}}
{{--                                            <li><a href="#"><i class="ion-android-star-outline"></i></a></li>--}}
{{--                                            <li><a href="#"><i class="ion-android-star-outline"></i></a></li>--}}
{{--                                            <li><a href="#"><i class="ion-android-star-outline"></i></a></li>--}}
{{--                                            <li><a href="#"><i class="ion-android-star-outline"></i></a></li>--}}
{{--                                            <li class="review"><a href="#">( 1 نقد و بررسی )</a></li>--}}
{{--                                        </ul>--}}
{{--                                    </div>--}}
                                    <div class="price_box">
{{--                                        <span class="old_price">80,000 تومان</span>--}}
                                        <span class="current_price">{{number_format($product->main_price)}} تومان</span>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!--product details end-->

                <!--product info start-->
                <div class="product_d_info">
                    <div class="row">
                        <div class="col-12">
                            <div class="product_d_inner">
                                <div class="product_info_button">
                                    <ul class="nav" role="tablist">
                                        <li>
                                            <a class="active" data-toggle="tab" href="#info" role="tab" aria-controls="info" aria-selected="false">توضیحات</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="info" role="tabpanel">
                                        <div class="product_info_content">
                                            <p>
                                                {!! html_entity_decode($product->description) !!}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--product info end-->
            </div>

            <!--product area start-->
            <section class="product_area related_products">
                <div class="row">
                    <div class="col-12">
                        <div class="section_title">
                            <h2>محصولات مرتبط </h2>
                        </div>
                    </div>
                </div>
                <div class="product_carousel product_style product_column5 owl-carousel">
                    @forelse($related_products as $related_product)

                    <article class="single_product">
                        <figure>

                            <div class="product_thumb">
                                <a class="primary_img" href="product-details.html"><img src="assets/img/product/product14.jpg" alt=""></a>
                                <a class="secondary_img" href="product-details.html"><img src="assets/img/product/product13.jpg" alt=""></a>
                                <div class="label_product">
                                    <span class="label_sale">فروش</span>
                                </div>
                                <div class="action_links">
                                    <ul>
                                        <li class="wishlist"><a href="wishlist.html" title="افزودن به علاقه‌مندی‌ها"><i class="ion-android-favorite-outline"></i></a></li>
                                        <li class="compare"><a href="#" title="افزودن به مقایسه"><i class="ion-ios-settings-strong"></i></a></li>
                                        <li class="quick_button"><a href="#" data-toggle="modal" data-target="#modal_box" title="مشاهده سریع"><i class="ion-ios-search-strong"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="product_content">
                                <div class="product_content_inner">
                                    <h4 class="product_name"><a href="product-details.html">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت</a></h4>
                                    <div class="price_box">
                                        <span class="old_price">80,000 تومان</span>
                                        <span class="current_price">70,000 تومان</span>
                                    </div>
                                </div>
                                <div class="add_to_cart">
                                    <a href="cart.html" title="افزودن به سبد">افزودن به سبد</a>
                                </div>

                            </div>
                        </figure>
                    </article>

                    @empty

                    @endforelse
                </div>

            </section>
            <!--product area end-->
        </div>
    </div>

</div>
