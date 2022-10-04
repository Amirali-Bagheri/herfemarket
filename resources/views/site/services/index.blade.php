<div>
    <div class="shop_area shop_fullwidth">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!--shop wrapper start-->
                    <div class="row no-gutters shop_wrapper">
                        @forelse ($products as $product)
                            <div class="col-lg-3 col-md-4 col-12 ">
                                <article class="single_product">
                                    <figure>
                                        <div class="product_thumb">
                                            <a class="primary_img" href="{{route('site.services.show',$product->slug)}}"><img src="/uploads/{{$product->images}}" alt=""></a>
{{--                                            <div class="label_product">--}}
{{--                                                <span class="label_sale">فروش</span>--}}
{{--                                            </div>--}}
{{--                                            <div class="action_links">--}}
{{--                                                <ul>--}}
{{--                                                    <li class="wishlist"><a href="wishlist.html" title="افزودن به علاقه‌مندی‌ها"><i class="ion-android-favorite-outline"></i></a></li>--}}
{{--                                                    <li class="compare"><a href="#" title="افزودن به مقایسه"><i class="ion-ios-settings-strong"></i></a></li>--}}
{{--                                                    <li class="quick_button"><a href="#" data-toggle="modal" data-target="#modal_box" title="مشاهده سریع"><i class="ion-ios-search-strong"></i></a></li>--}}
{{--                                                </ul>--}}
{{--                                            </div>--}}
                                        </div>

                                        <div class="product_content grid_content">
                                            <div class="product_content_inner">
                                                <h4 class="product_name"><a href="{{ route('site.services.show',$product->slug) }}">
                                                        {{$product->title}}
                                                    </a></h4>
{{--                                                <div class="product_rating">--}}
{{--                                                    <ul>--}}
{{--                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>--}}
{{--                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>--}}
{{--                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>--}}
{{--                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>--}}
{{--                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>--}}
{{--                                                    </ul>--}}
{{--                                                </div>--}}
                                                <div class="price_box">
{{--                                                    <span class="old_price">80,000 تومان</span>--}}
                                                    <span class="current_price">{{number_format($product->main_price)}} تومان</span>
                                                </div>
                                            </div>
                                            <div class="add_to_cart">
                                                <a wire:click="addToCart('{{$product->id}}')" title="افزودن به سبد">افزودن به سبد</a>
                                            </div>
                                        </div>
                                    </figure>
                                </article>
                            </div>
                            @empty

                            @endforelse
                    </div>

                    <div class="shop_toolbar t_bottom">
                       {{ $products->links() }}
                    </div>
                    <!--shop toolbar end-->
                    <!--shop wrapper end-->
                </div>
            </div>
        </div>
    </div>

</div>
