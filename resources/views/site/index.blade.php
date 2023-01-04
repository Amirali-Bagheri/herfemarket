@extends('site.layouts.master')

@section('content')
<div>

    <!--slider area start-->
    <section class="slider_section slider_s_four has_banner mb-60 mt-20">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="slider_area slider3_carousel owl-carousel">
                        <div class="slide_container">
                            <div class="single_slider d-flex align-items-center" data-bgimg="/img/slider/slider12.jpg">
                                <div class="slider_content slider_c_four color_white">
                                    <h3>محصولات جدید</h3>
                                    <h1>تابستان <br> محصولات 2019</h1>
                                    <p>تخفیف <span> 30 درصد</span> این هفته</p>
                                    <a class="button" href="shop.html">هم اکنون بخرید</a>
                                </div>
                            </div>
                        </div>
                        <div class="slide_container">
                            <div class="single_slider d-flex align-items-center" data-bgimg="/img/slider/slider13.jpg">
                                <div class="slider_content slider_c_four color_white">
                                    <h3>محصولات محبوب</h3>
                                    <h1>جدیدترین مدل <br> گوشی های 2019</h1>
                                    <p>تخفیف <span> 30 درصد</span> این هفته</p>
                                    <a class="button" href="shop.html">هم اکنون بخرید</a>
                                </div>
                            </div>
                        </div>
                        <div class="slide_container">
                            <div class="single_slider d-flex align-items-center" data-bgimg="/img/slider/slider14.jpg">
                                <div class="slider_content slider_c_four">
                                    <h3>محصولات فروش ویژه</h3>
                                    <h1>صندلی چوبی <br> مینیمال 2019</h1>
                                    <p>تخفیف <span> 30 درصد</span> این هفته</p>
                                    <a class="button" href="shop.html">هم اکنون بخرید</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <figure class="single_banner">
                        <div class="banner_thumb">
                            <a href="shop.html"><img src="/img/bg/banner9.jpg" alt=""></a>
                        </div>
                    </figure>
                </div>
                <div class="col-lg-3">
                    <figure class="single_banner">
                        <div class="banner_thumb">
                            <a href="shop.html"><img src="/img/bg/banner10.jpg" alt=""></a>
                        </div>
                    </figure>
                    <figure class="single_banner">
                        <div class="banner_thumb">
                            <a href="shop.html"><img src="/img/bg/banner11.jpg" alt=""></a>
                        </div>
                    </figure>
                </div>
            </div>
        </div>
    </section>
    <!--slider area end-->


    <!--shipping area start-->
    <div class="shipping_area mb-60">
        <div class="container">
            <div class="shipping_inner">
                <div class="single_shipping">
                    <div class="shipping_icone">
                        <img src="/img/about/shipping1.png" alt="">
                    </div>
                    <div class="shipping_content">
                        <h4>ارسال رایگان</h4>
                        <p>ارسال رایگان به تمام نقاط کشور</p>
                    </div>
                </div>
                <div class="single_shipping">
                    <div class="shipping_icone">
                        <img src="/img/about/shipping2.png" alt="">
                    </div>
                    <div class="shipping_content">
                        <h4>ارسال رایگان</h4>
                        <p>ارسال رایگان به تمام نقاط کشور</p>
                    </div>
                </div>
                <div class="single_shipping">
                    <div class="shipping_icone">
                        <img src="/img/about/shipping3.png" alt="">
                    </div>
                    <div class="shipping_content">
                        <h4>ارسال رایگان</h4>
                        <p>ارسال رایگان به تمام نقاط کشور</p>
                    </div>
                </div>
                <div class="single_shipping">
                    <div class="shipping_icone">
                        <img src="/img/about/shipping4.png" alt="">
                    </div>
                    <div class="shipping_content">
                        <h4>ارسال رایگان</h4>
                        <p>ارسال رایگان به تمام نقاط کشور</p>
                    </div>
                </div>
                <div class="single_shipping">
                    <div class="shipping_icone">
                        <img src="/img/about/shipping5.png" alt="">
                    </div>
                    <div class="shipping_content">
                        <h4>ارسال رایگان</h4>
                        <p>ارسال رایگان به تمام نقاط کشور</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--shipping area end-->

    <!--banner area start-->
    <div class="banner_area banner_style2 banner_style4 mb-60">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3">
                    <figure class="single_banner">
                        <div class="banner_thumb">
                            <a href="shop.html"><img src="/img/bg/banner6.jpg" alt=""></a>
                        </div>
                    </figure>
                </div>
                <div class="col-lg-6 col-md-6">
                    <figure class="single_banner">
                        <div class="banner_thumb">
                            <a href="shop.html"><img src="/img/bg/banner7.jpg" alt=""></a>
                        </div>
                    </figure>
                </div>
                <div class="col-lg-3 col-md-3">
                    <figure class="single_banner">
                        <div class="banner_thumb">
                            <a href="shop.html"><img src="/img/bg/banner8.jpg" alt=""></a>
                        </div>
                    </figure>
                </div>
            </div>
        </div>
    </div>
    <!--banner area end-->


    <!--home section bg area start-->
    <div class="home_section_bg">

        <!--product area start-->
        <div class="product_area deals_product_style2">
            <div class="container">

                <div class="tab-content">
                    <div class="tab-pane fade show active" id="Fashion" role="tabpanel">
                        <div class="product_carousel product_style product_column2 owl-carousel">
                            <div class="product_items">
                                @foreach (\Modules\Product\Entities\Product::latest()->take(10)->get()->unique() as $product)
                                <article class="single_product">
                                    <figure>
                                        <div class="product_thumb text-center justify-content-center">
                                            <a class="primary_img" href="{{ route('site.products.single',$product->slug) }}">
                                                <img width="150" src="/uploads/{{ $product->images }}" alt=""></a>
                                        </div>
                                        <div class="product_content">
                                            <div class="product_content_inner">
                                                <h4 class="product_name">
                                                    <a href="{{ route('site.products.single',$product->slug) }}">
                                                        {{ $product->title }}
                                                    </a>
                                                </h4>
                                                <div class="price_box">
                                                    @if(!empty($product->final_price))
                                                    <span class="old_price">{{ number_format($product->final_price) }} تومان</span>
                                                    @endif
                                                    @if(!empty($product->main_price))
                                                    <span class="current_price">{{ number_format($product->main_price) }} تومان</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </figure>
                                </article>
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!--product area end-->
    </div>
    <!--home section bg area end-->

</div>

@endsection
