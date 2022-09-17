<div>

    <header>
        <div class="main_header header_four">
            <div class="container">
                <div class="header_middle header_middle_style4">
                    <div class="row align-items-center">
                        <div class="column1 col-lg-3 col-md-6">
                            <div class="logo">
                                <a href="index.html"><img src="/img/logo/logo.png" alt=""></a>
                            </div>
                        </div>
                        <div class="column2 col-lg-6 col-md-12">
                            <div class="search_container">
                                <form wire:submit.prevent="search">
                                    <div class="search_box">
                                        <input placeholder="جستجوی محصول ..." type="text" wire:model.defer="q">
                                        <button type="submit">جستجو</button>
                                    </div>
                                </form>
                            </div>
                        </div>
{{--                        <div class="column3 col-lg-3">--}}
{{--                            <div class="header_configure_area header_configure_four">--}}
{{--                                <div class="header_wishlist">--}}
{{--                                    <a href="wishlist.html"><i class="ion-android-favorite-outline"></i>--}}
{{--                                        <span class="wishlist_count">3</span>--}}
{{--                                    </a>--}}
{{--                                </div>--}}
{{--                                <div class="mini_cart_wrapper">--}}
{{--                                    <a href="javascript:void(0)">--}}
{{--                                        <i class="fa fa-shopping-bag"></i>--}}
{{--                                        <span class="cart_price"><span>152,000 تومان</span> <i--}}
{{--                                                class="ion-ios-arrow-down"></i></span>--}}
{{--                                        <span class="cart_count">2</span>--}}

{{--                                    </a>--}}
{{--                                    <!--mini cart-->--}}
{{--                                    <div class="mini_cart">--}}
{{--                                        <div class="mini_cart_inner">--}}
{{--                                            <div class="cart_item">--}}
{{--                                                <div class="cart_img">--}}
{{--                                                    <a href="#"><img src="/img/s-product/product.jpg" alt=""></a>--}}
{{--                                                </div>--}}
{{--                                                <div class="cart_info">--}}
{{--                                                    <a href="#">گوشی هوشمند سامسونگ A50</a>--}}
{{--                                                    <p>تعداد: 1 × <span> 60,000 تومان </span></p>--}}
{{--                                                </div>--}}
{{--                                                <div class="cart_remove">--}}
{{--                                                    <a href="#"><i class="ion-android-close"></i></a>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="cart_item">--}}
{{--                                                <div class="cart_img">--}}
{{--                                                    <a href="#"><img src="/img/s-product/product2.jpg" alt=""></a>--}}
{{--                                                </div>--}}
{{--                                                <div class="cart_info">--}}
{{--                                                    <a href="#">صندلی آشپزخانه پلاستیکی Nilper</a>--}}
{{--                                                    <p>تعداد: 1 × <span> 60,000 تومان </span></p>--}}
{{--                                                </div>--}}
{{--                                                <div class="cart_remove">--}}
{{--                                                    <a href="#"><i class="ion-android-close"></i></a>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="mini_cart_table">--}}
{{--                                            <div class="cart_total">--}}
{{--                                                <span>جمع اجزا:</span>--}}
{{--                                                <span class="price">138,000 تومان</span>--}}
{{--                                            </div>--}}
{{--                                            <div class="cart_total mt-10">--}}
{{--                                                <span>جمع کل:</span>--}}
{{--                                                <span class="price">138,000 تومان</span>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="mini_cart_footer">--}}
{{--                                            <div class="cart_button">--}}
{{--                                                <a href="cart.html">مشاهده سبد</a>--}}
{{--                                            </div>--}}
{{--                                            <div class="cart_button">--}}
{{--                                                <a href="checkout.html">پرداخت</a>--}}
{{--                                            </div>--}}

{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <!--mini cart end-->--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                    </div>
                </div>

                <!--header middel start-->
                <div class="header_middle sticky_header_four sticky-header">
                    <div class="row align-items-center">
                        <div class="col-lg-2 col-md-6">
                            <div class="logo">
                                <a href="index.html"><img src="/img/logo/logo.png" alt=""></a>
                            </div>
                        </div>
                        <div class="col-lg-7 col-md-12">
                            <div class="main_menu menu_position text-center">
                                <nav>
                                    <ul>
                                        <li>
                                            <a class="active" href="index.html">خانه<i class="fa fa-angle-down"></i></a>
                                            <ul class="sub_menu">
                                                <li><a href="index.html">خانه فروشگاه 1</a></li>
                                                <li><a href="index-2.html">خانه فروشگاه 2</a></li>
                                                <li><a href="index-3.html">خانه فروشگاه 3</a></li>
                                                <li><a href="index-4.html">خانه فروشگاه 4</a></li>
                                                <li><a href="index-5.html">خانه فروشگاه 5</a></li>
                                                <li><a href="index-6.html">خانه فروشگاه 6</a></li>
                                            </ul>
                                        </li>
                                        <li class="mega_items"><a href="shop.html">فروشگاه<i class="fa fa-angle-down"></i></a>
                                            <div class="mega_menu">
                                                <ul class="mega_menu_inner">
                                                    <li><a href="#">طرح های فروشگاه</a>
                                                        <ul>
                                                            <li><a href="shop-fullwidth.html">تمام عرض</a></li>
                                                            <li><a href="shop-fullwidth-list.html">تمام عرض لیست</a></li>
                                                            <li><a href="shop-left-sidebar.html">نوار کناری چپ </a></li>
                                                            <li><a href="shop-left-sidebar-list.html"> نوار کناری چپ لیست</a></li>
                                                            <li><a href="shop-list.html">نمایش لیست</a></li>
                                                        </ul>
                                                    </li>
                                                    <li><a href="#">سایر صفحات</a>
                                                        <ul>
                                                            <li><a href="cart.html">سبد خرید</a></li>
                                                            <li><a href="wishlist.html">لیست علاقه‌مندی‌ها</a></li>
                                                            <li><a href="checkout.html">پرداخت</a></li>
                                                            <li><a href="my-account.html">حساب کاربری</a></li>
                                                            <li><a href="404.html">خطای 404</a></li>
                                                        </ul>
                                                    </li>
                                                    <li><a href="#">انواع محصول</a>
                                                        <ul>
                                                            <li><a href="product-details.html">جزئیات محصول</a></li>
                                                            <li><a href="product-sidebar.html">محصول با نوار کناری</a></li>
                                                            <li><a href="product-grouped.html">محصول گروهبندی شده</a></li>
                                                            <li><a href="variable-product.html">محصول متغیر</a></li>
                                                            <li><a href="product-countdown.html">محصول شمارنده</a></li>

                                                        </ul>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li><a href="blog.html">بلاگ<i class="fa fa-angle-down"></i></a>
                                            <ul class="sub_menu pages">
                                                <li><a href="blog-details.html">جزئیات مطلب بلاگ</a></li>
                                                <li><a href="blog-fullwidth.html">بلاگ تمام عرض</a></li>
                                                <li><a href="blog-right-sidebar.html">نوار کناری راست</a></li>
                                                <li><a href="blog-no-sidebar.html">بلاگ بدون نوار کناری</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="#">صفحات <i class="fa fa-angle-down"></i></a>
                                            <ul class="sub_menu pages">
                                                <li><a href="about.html">درباره ما</a></li>
                                                <li><a href="faq.html">سوالات متداول</a></li>
                                                <li><a href="privacy-policy.html">سیاست حریم خصوصی</a></li>
                                                <li><a href="contact.html">تماس</a></li>
                                                <li><a href="login.html">ورود</a></li>
                                                <li><a href="404.html">خطای 404</a></li>
                                                <li><a href="compare.html">مقایسه</a></li>
                                                <li><a href="coming-soon.html">به زودی</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="about.html">درباره ما</a></li>
                                        <li><a href="contact.html"> تماس با ما</a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="header_configure_area">
                                <div class="header_wishlist">
                                    <a href="wishlist.html"><i class="ion-android-favorite-outline"></i>
                                        <span class="wishlist_count">3</span>
                                    </a>
                                </div>
                                <div class="mini_cart_wrapper">
                                    <a href="javascript:void(0)">
                                        <i class="fa fa-shopping-bag"></i>
                                        <span class="cart_price"><span>152,000 تومان</span> <i
                                                class="ion-ios-arrow-down"></i></span>
                                        <span class="cart_count">2</span>

                                    </a>
                                    <!--mini cart-->
                                    <div class="mini_cart">
                                        <div class="mini_cart_inner">
                                            <div class="cart_item">
                                                <div class="cart_img">
                                                    <a href="#"><img src="/img/s-product/product.jpg" alt=""></a>
                                                </div>
                                                <div class="cart_info">
                                                    <a href="#">گوشی هوشمند سامسونگ A50</a>
                                                    <p>تعداد: 1 × <span> 60,000 تومان </span></p>
                                                </div>
                                                <div class="cart_remove">
                                                    <a href="#"><i class="ion-android-close"></i></a>
                                                </div>
                                            </div>
                                            <div class="cart_item">
                                                <div class="cart_img">
                                                    <a href="#"><img src="/img/s-product/product2.jpg" alt=""></a>
                                                </div>
                                                <div class="cart_info">
                                                    <a href="#">صندلی آشپزخانه پلاستیکی Nilper</a>
                                                    <p>تعداد: 1 × <span> 60,000 تومان </span></p>
                                                </div>
                                                <div class="cart_remove">
                                                    <a href="#"><i class="ion-android-close"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mini_cart_table">
                                            <div class="cart_total">
                                                <span>جمع اجزا:</span>
                                                <span class="price">138,000 تومان</span>
                                            </div>
                                            <div class="cart_total mt-10">
                                                <span>جمع کل:</span>
                                                <span class="price">138,000 تومان</span>
                                            </div>
                                        </div>
                                        <div class="mini_cart_footer">
                                            <div class="cart_button">
                                                <a href="cart.html">مشاهده سبد</a>
                                            </div>
                                            <div class="cart_button">
                                                <a href="checkout.html">پرداخت</a>
                                            </div>

                                        </div>
                                    </div>
                                    <!--mini cart end-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--header middel end-->
                <!--header middel end-->

                <!--header bottom satrt-->
                <div class="header_bottom">
                    <div class="row align-items-center">
                        <div class="column1 col-lg-3 col-md-6">
                            <div class="categories_menu categories_four">
                                <div class="categories_title">
                                    <h2 class="categori_toggle">دسته بندی ها</h2>
                                </div>
                                <div class="categories_menu_toggle">
                                    <ul>

                                        @foreach(\Modules\Category\Entities\Category::where('parent_id',0)->get() as $category)
                                            @if ($category->has('children'))
                                                <li class="menu_item_children">
                                                    <a href="#">
                                                        {{ $category->title }}
                                                        <i class="fa fa-angle-left"></i>
                                                    </a>
                                                    <ul class="categories_mega_menu">
                                                        @foreach($category->children as  $category_child)


                                                            <li class="menu_item_children">
                                                                <a href="#">
                                                                    {{ $category_child->title }}
                                                                </a>
                                                                <ul class="categorie_sub_menu">
                                                                    @foreach($category_child->children->take(6) as $category_child_child)
                                                                        <li>
                                                                            <a href="#">
                                                                                {{ $category_child_child->title }}
                                                                            </a>
                                                                        </li>
                                                                    @endforeach

                                                                </ul>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </li>
                                            @else
                                                <li>
                                                    <a href="#">
                                                        {{$category->title}}
                                                    </a>
                                                </li>
                                            @endif
                                        @endforeach




                                        {{--
                                                                                <li class="menu_item_children"><a href="#">لباس و پوشاک <i class="fa fa-angle-left"></i></a>
                                                                                    <ul class="categories_mega_menu">
                                                                                        <li class="menu_item_children"><a href="#">لباس ها</a>
                                                                                            <ul class="categorie_sub_menu">
                                                                                                <li><a href="#">زیر پیراهن</a></li>
                                                                                                <li><a href="#">عصرانه</a></li>
                                                                                                <li><a href="#">روزانه</a></li>
                                                                                                <li><a href="#">ورزشی</a></li>
                                                                                            </ul>
                                                                                        </li>
                                                                                        <li class="menu_item_children"><a href="#">کیف دستی</a>
                                                                                            <ul class="categorie_sub_menu">
                                                                                                <li><a href="#">رودوشی</a></li>
                                                                                                <li><a href="#">کیف مدرسه</a></li>
                                                                                                <li><a href="#">کودکانه</a></li>
                                                                                                <li><a href="#">کت ها</a></li>
                                                                                            </ul>
                                                                                        </li>
                                                                                        <li class="menu_item_children"><a href="#">کفش ها</a>
                                                                                            <ul class="categorie_sub_menu">
                                                                                                <li><a href="#">چکمه های مچ پا</a></li>
                                                                                                <li><a href="#">صندل ها قفل دار </a></li>
                                                                                                <li><a href="#">مخصوص دویدن</a></li>
                                                                                                <li><a href="#">کتاب ها</a></li>
                                                                                            </ul>
                                                                                        </li>
                                                                                        <li class="menu_item_children"><a href="#">پوشاک</a>
                                                                                            <ul class="categorie_sub_menu">
                                                                                                <li><a href="#">ژاکت و کت </a></li>
                                                                                                <li><a href="#">بارانی ها</a></li>
                                                                                                <li><a href="#">ژاکت ها</a></li>
                                                                                                <li><a href="#">تیشرت ها</a></li>
                                                                                            </ul>
                                                                                        </li>
                                                                                    </ul>
                                                                                </li>
                                        --}}
                                        {{--                                        <li><a href="#"> قطعات موتور</a></li>--}}
                                        {{--        <li id="cat_toggle" class="has-sub"><a href="#"> دسته های بیشتر</a>
                                                    <ul class="categorie_sub">
                                                        <li><a href="#">دسته های پنهان</a></li>
                                                    </ul>

                                                </li>--}}
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="column2 col-lg-6 ">
                            <div class="main_menu menu_four menu_position text-center">
                                <nav>
                                    <ul>
                                        <li><a class="active" href="index.html">خانه<i class="fa fa-angle-down"></i></a>
                                            <ul class="sub_menu">
                                                <li><a href="index.html">خانه فروشگاه 1</a></li>
                                                <li><a href="index-2.html">خانه فروشگاه 2</a></li>
                                                <li><a href="index-3.html">خانه فروشگاه 3</a></li>
                                                <li><a href="index-4.html">خانه فروشگاه 4</a></li>
                                                <li><a href="index-5.html">خانه فروشگاه 5</a></li>
                                                <li><a href="index-6.html">خانه فروشگاه 6</a></li>
                                            </ul>
                                        </li>
                                        <li class="mega_items"><a href="shop.html">فروشگاه<i class="fa fa-angle-down"></i></a>
                                            <div class="mega_menu">
                                                <ul class="mega_menu_inner">
                                                    <li><a href="#">طرح های فروشگاه</a>
                                                        <ul>
                                                            <li><a href="shop-fullwidth.html">تمام عرض</a></li>
                                                            <li><a href="shop-fullwidth-list.html">تمام عرض لیست</a></li>
                                                            <li><a href="shop-left-sidebar.html">نوار کناری چپ </a></li>
                                                            <li><a href="shop-left-sidebar-list.html"> نوار کناری چپ لیست</a></li>
                                                            <li><a href="shop-list.html">نمایش لیست</a></li>
                                                        </ul>
                                                    </li>
                                                    <li><a href="#">سایر صفحات</a>
                                                        <ul>
                                                            <li><a href="cart.html">سبد خرید</a></li>
                                                            <li><a href="wishlist.html">لیست علاقه‌مندی‌ها</a></li>
                                                            <li><a href="checkout.html">پرداخت</a></li>
                                                            <li><a href="my-account.html">حساب کاربری</a></li>
                                                            <li><a href="404.html">خطای 404</a></li>
                                                        </ul>
                                                    </li>
                                                    <li><a href="#">انواع محصول</a>
                                                        <ul>
                                                            <li><a href="product-details.html">جزئیات محصول</a></li>
                                                            <li><a href="product-sidebar.html">محصول با نوار کناری</a></li>
                                                            <li><a href="product-grouped.html">محصول گروهبندی شده</a></li>
                                                            <li><a href="variable-product.html">محصول متغیر</a></li>
                                                            <li><a href="product-countdown.html">محصول شمارنده</a></li>

                                                        </ul>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li><a href="blog.html">بلاگ<i class="fa fa-angle-down"></i></a>
                                            <ul class="sub_menu pages">
                                                <li><a href="blog-details.html">جزئیات مطلب بلاگ</a></li>
                                                <li><a href="blog-fullwidth.html">بلاگ تمام عرض</a></li>
                                                <li><a href="blog-right-sidebar.html">نوار کناری راست</a></li>
                                                <li><a href="blog-no-sidebar.html">بلاگ بدون نوار کناری</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="#">صفحات <i class="fa fa-angle-down"></i></a>
                                            <ul class="sub_menu pages">
                                                <li><a href="about.html">درباره ما</a></li>
                                                <li><a href="faq.html">سوالات متداول</a></li>
                                                <li><a href="privacy-policy.html">سیاست حریم خصوصی</a></li>
                                                <li><a href="contact.html">تماس</a></li>
                                                <li><a href="login.html">ورود</a></li>
                                                <li><a href="404.html">خطای 404</a></li>
                                                <li><a href="compare.html">مقایسه</a></li>
                                                <li><a href="coming-soon.html">به زودی</a></li>
                                            </ul>
                                        </li>

                                        <li><a href="about.html">درباره ما</a></li>
                                        <li><a href="contact.html"> تماس با ما</a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <!--header bottom end-->
            </div>
        </div>
    </header>
    <!--header area end-->

</div>
