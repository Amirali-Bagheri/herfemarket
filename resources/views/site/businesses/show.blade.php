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
                                        <img id="zoom1" src="/uploads/{{$product->images}}"
                                             data-zoom-image="/uploads/{{$product->images}}" alt="{{$product->title}}">
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7 col-md-6">
                            <div class="product_d_right">
                                <form action="#">

                                    <h3><a href="#">{{$product->title}}</a></h3>
                                    <div class="product_rating">
                                        <ul>
                                            <li><a href="#"><i class="ion-android-star"></i></a></li>
                                            <li><a href="#"><i class="ion-android-star"></i></a></li>
                                            <li><a href="#"><i class="ion-android-star"></i></a></li>
                                            <li><a href="#"><i class="ion-android-star"></i></a></li>
                                            <li><a href="#"><i class="ion-android-star"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="price_box">
                                        {{--                                        <span class="old_price">80,000 تومان</span>--}}
                                        <span class="current_price">{{number_format($product->main_price)}} تومان</span>
                                    </div>

                                    <div class="product_variant quantity">
                                        <button wire:click="addToCart('{{$product->id}}')" class="button" type="button">افزودن به
                                            سبد
                                        </button>
                                    </div>

                                </form>
                                <div class="product_d_meta">
                                    <span>دسته بندی: <a
                                            href="{{route('site.products.category',$product->categories()->first()->slug)}}">{{$product->categories()->first()->title}}</a></span>
                                </div>
                                <div class="priduct_social">
                                    <ul>
                                        <li><a class="facebook" href="#" title="facebook"><i class="fab fa-facebook"></i> لایک</a>
                                        </li>
                                        <li><a class="twitter" href="#" title="twitter"><i class="fab fa-twitter"></i> توییت</a>
                                        </li>
                                        <li><a class="pinterest" href="#" title="pinterest"><i class="fab fa-pinterest"></i> ذخیره</a>
                                        </li>
                                        <li><a class="linkedin" href="#" title="linkedin"><i class="fab fa-linkedin"></i> لینکدین</a>
                                        </li>
                                    </ul>
                                </div>
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
                                            <a class="active" data-toggle="tab" href="#info" role="tab" aria-controls="info"
                                               aria-selected="false">توضیحات</a>
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

        </div>
    </div>

</div>
