@extends('site.layouts.master')

@section('content')
    <div>

        <!--Offcanvas menu area start-->
        <div class="off_canvars_overlay"></div>
        <div class="Offcanvas_menu">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="canvas_open">
                            <a href="javascript:void(0)"><i class="ion-navicon"></i></a>
                        </div>
                        <div class="Offcanvas_menu_wrapper">
                            <div class="canvas_close">
                                <a href="javascript:void(0)"><i class="ion-android-close"></i></a>
                            </div>
                            <div class="antomi_message">
                                <p>ارسال رایگان - ضمانت بازگشت وجه 30 روزه</p>
                            </div>
                            <div class="header_top_settings text-right">
                                <ul>
                                    <li><a href="#">آدرس‌های فروشگاه</a></li>
                                    <li><a href="#">پیگیری سفارش</a></li>
                                    <li>تلفن تماس: <a class="ltr-text" href="tel:+(+98)800456789">(+98) 800 456 789 </a></li>
                                    <li>ضمانت کیفیت محصولات</li>
                                </ul>
                            </div>
                            <div class="header_configure_area">
                                <div class="header_wishlist">
                                    <a href="wishlist.html"><i class="ion-android-favorite-outline"></i>
                                        <span class="wishlist_count">3</span>
                                    </a>
                                </div>
                                <div class="mini_cart_wrapper">
                                    <a href="javascript:void(0)">
                                        <i class="fa fa-shopping-bag"></i>
                                        <span class="cart_price"><i class="ion-ios-arrow-down"></i></span>
                                        <span class="cart_count">2</span>

                                    </a>
                                    <!--mini cart-->
                                    <div class="mini_cart">
                                        <div class="mini_cart_inner">
                                            <div class="cart_item">
                                                <div class="cart_img">
                                                    <a href="#"><img src="assets/img/s-product/product.jpg" alt=""></a>
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
                                                    <a href="#"><img src="assets/img/s-product/product2.jpg" alt=""></a>
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
                            <div class="search_container">
                                <form action="#">
                                    <div class="hover_category">
                                        <select class="select_option" name="select" id="categori1">
                                            <option selected value="1">همه دسته ها</option>
                                            <option value="2">لوازم جانبی</option>
                                            <option value="3">سایر لوازم جانبی</option>
                                            <option value="4">لوازم کامپیوتر</option>
                                            <option value="5">دوربین و ویدیو </option>
                                            <option value="6">صفحه نمایش</option>
                                            <option value="7">تبلت ها</option>
                                            <option value="8">لپ تاپ ها</option>
                                            <option value="9">کیف دستی</option>
                                            <option value="10">هدفون و اسپیکر</option>
                                            <option value="11">گیاهان دارویی</option>
                                            <option value="12">سبزیجات</option>
                                            <option value="13">فروشگاه</option>
                                            <option value="14">لپ تاپ و کامپیوتر</option>
                                            <option value="15">ساعت ها</option>
                                            <option value="16">لوازم الکترونیکی</option>
                                        </select>
                                    </div>
                                    <div class="search_box">
                                        <input placeholder="جستجوی محصول ..." type="text">
                                        <button type="submit">جستجو</button>
                                    </div>
                                </form>
                            </div>
                            <div id="menu" class="text-left ">
                                <ul class="offcanvas_main_menu">
                                    <li class="menu-item-has-children active">
                                        <a href="#">خانه</a>
                                        <ul class="sub-menu">
                                            <li><a href="index.html">خانه 1</a></li>
                                            <li><a href="index-2.html">خانه 2</a></li>
                                            <li><a href="index-3.html">خانه 3</a></li>
                                            <li><a href="index-4.html">خانه 4</a></li>
                                            <li><a href="index-5.html">خانه 5</a></li>
                                            <li><a href="index-6.html">خانه 6</a></li>
                                        </ul>
                                    </li>
                                    <li class="menu-item-has-children">
                                        <a href="#">فروشگاه</a>
                                        <ul class="sub-menu">
                                            <li class="menu-item-has-children">
                                                <a href="#">طرح های فروشگاه</a>
                                                <ul class="sub-menu">
                                                    <li><a href="shop.html">فروشگاه</a></li>
                                                    <li><a href="shop-fullwidth.html">تمام عرض</a></li>
                                                    <li><a href="shop-fullwidth-list.html">تمام عرض لیست</a></li>
                                                    <li><a href="shop-left-sidebar.html">نوار کناری چپ </a></li>
                                                    <li><a href="shop-left-sidebar-list.html"> نوار کناری چپ لیست</a></li>
                                                    <li><a href="shop-list.html">نمایش لیست</a></li>
                                                </ul>
                                            </li>
                                            <li class="menu-item-has-children">
                                                <a href="#">سایر صفحات</a>
                                                <ul class="sub-menu">
                                                    <li><a href="cart.html">سبد خرید</a></li>
                                                    <li><a href="wishlist.html">لیست علاقه‌مندی‌ها</a></li>
                                                    <li><a href="checkout.html">پرداخت</a></li>
                                                    <li><a href="my-account.html">حساب کاربری</a></li>
                                                    <li><a href="404.html">خطای 404</a></li>
                                                </ul>
                                            </li>
                                            <li class="menu-item-has-children">
                                                <a href="#">انواع محصول</a>
                                                <ul class="sub-menu">
                                                    <li><a href="product-details.html">جزئیات محصول</a></li>
                                                    <li><a href="product-sidebar.html">محصول با نوار کناری</a></li>
                                                    <li><a href="product-grouped.html">محصول گروهبندی شده</a></li>
                                                    <li><a href="variable-product.html">محصول متغیر</a></li>
                                                    <li><a href="product-countdown.html">محصول شمارنده</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="menu-item-has-children">
                                        <a href="#">بلاگ</a>
                                        <ul class="sub-menu">
                                            <li><a href="blog.html">بلاگ</a></li>
                                            <li><a href="blog-details.html">جزئیات مطلب بلاگ</a></li>
                                            <li><a href="blog-fullwidth.html">بلاگ تمام عرض</a></li>
                                            <li><a href="blog-right-sidebar.html">نوار کناری راست</a></li>
                                            <li><a href="blog-no-sidebar.html">بلاگ بدون نوار کناری</a></li>
                                        </ul>

                                    </li>
                                    <li class="menu-item-has-children">
                                        <a href="#">صفحات </a>
                                        <ul class="sub-menu">
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
                                    <li class="menu-item-has-children">
                                        <a href="my-account.html">حساب کاربری</a>
                                    </li>
                                    <li class="menu-item-has-children">
                                        <a href="about.html">درباره ما</a>
                                    </li>
                                    <li class="menu-item-has-children">
                                        <a href="contact.html"> تماس با ما</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="Offcanvas_footer">
                                <span><a href="#"><i class="fa fa-envelope-o"></i> info@yourdomain.com</a></span>
                                <ul>
                                    <li class="facebook"><a href="#"><i class="fa fa-facebook"></i></a></li>
                                    <li class="twitter"><a href="#"><i class="fa fa-twitter"></i></a></li>
                                    <li class="pinterest"><a href="#"><i class="fa fa-pinterest-p"></i></a></li>
                                    <li class="google-plus"><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                    <li class="linkedin"><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Offcanvas menu area end-->
        <!--header area start-->
        <header>
            <div class="main_header">
                <div class="container">
                    <!--header top start-->
                    <div class="header_top">
                        <div class="row align-items-center">
                            <div class="col-lg-4 col-md-5">
                                <div class="antomi_message">
                                    <p>ارسال رایگان - ضمانت بازگشت وجه 30 روزه</p>
                                </div>
                            </div>
                            <div class="col-lg-8 col-md-7">
                                <div class="header_top_settings text-right">
                                    <ul>
                                        <li><a href="#">آدرس‌های فروشگاه</a></li>
                                        <li><a href="#">پیگیری سفارش</a></li>
                                        <li>تلفن تماس: <a class="ltr-text" href="tel:+(+98)800456789">(+98) 800 456 789 </a></li>
                                        <li>ضمانت کیفیت محصولات</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--header top start-->

                    <!--header middel start-->
                    <div class="header_middle sticky-header">
                        <div class="row align-items-center">
                            <div class="col-lg-2 col-md-6">
                                <div class="logo">
                                    <a href="index.html"><img src="assets/img/logo/logo.png" alt=""></a>
                                </div>
                            </div>
                            <div class="col-lg-7 col-md-12">
                                <div class="main_menu menu_position text-center">
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
                                            <span class="cart_price"><span>152,000 تومان</span> <i class="ion-ios-arrow-down"></i></span>
                                            <span class="cart_count">2</span>

                                        </a>
                                        <!--mini cart-->
                                        <div class="mini_cart">
                                            <div class="mini_cart_inner">
                                                <div class="cart_item">
                                                    <div class="cart_img">
                                                        <a href="#"><img src="assets/img/s-product/product.jpg" alt=""></a>
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
                                                        <a href="#"><img src="assets/img/s-product/product2.jpg" alt=""></a>
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

                    <!--header bottom satrt-->
                    <div class="header_bottom">
                        <div class="row align-items-center">
                            <div class="column1 col-lg-3 col-md-6">
                                <div class="categories_menu">
                                    <div class="categories_title">
                                        <h2 class="categori_toggle">دسته بندی ها</h2>
                                    </div>
                                    <div class="categories_menu_toggle">
                                        <ul>
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
                                            <li class="menu_item_children"><a href="#"> دکور و مبلمان <i class="fa fa-angle-left"></i></a>
                                                <ul class="categories_mega_menu column_3">
                                                    <li class="menu_item_children"><a href="#">صندلی</a>
                                                        <ul class="categorie_sub_menu">
                                                            <li><a href="#">ناهارخوری</a></li>
                                                            <li><a href="#">اتاق خواب</a></li>
                                                            <li><a href="#"> خانه و اداره</a></li>
                                                            <li><a href="#">اتاق نشیمن</a></li>
                                                        </ul>
                                                    </li>
                                                    <li class="menu_item_children"><a href="#">نورپردازی</a>
                                                        <ul class="categorie_sub_menu">
                                                            <li><a href="#">نورپردازی سقفی</a></li>
                                                            <li><a href="#">نورپردازی دیواری</a></li>
                                                            <li><a href="#">نورپردازی بیرون خانه</a></li>
                                                            <li><a href="#">نورپردازی هوشمند</a></li>
                                                        </ul>
                                                    </li>
                                                    <li class="menu_item_children"><a href="#">مبل</a>
                                                        <ul class="categorie_sub_menu">
                                                            <li><a href="#">مبل های پارچه ای</a></li>
                                                            <li><a href="#">مبل های چرمی</a></li>
                                                            <li><a href="#">مبل های گوشه ای</a></li>
                                                            <li><a href="#">مبل های تخت خوابی</a></li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="menu_item_children"><a href="#"> قطعات خودرو <i class="fa fa-angle-left"></i></a>
                                                <ul class="categories_mega_menu column_2">
                                                    <li class="menu_item_children"><a href="#">ابزار ترمز</a>
                                                        <ul class="categorie_sub_menu">
                                                            <li><a href="#">میل لنگ</a></li>
                                                            <li><a href="#">قرقره</a></li>
                                                            <li><a href="#">دیزل </a></li>
                                                            <li><a href="#">بنزین</a></li>
                                                        </ul>
                                                    </li>
                                                    <li class="menu_item_children"><a href="#">ترمز اضطراری</a>
                                                        <ul class="categorie_sub_menu">
                                                            <li><a href="#">عروسک های دخترانه</a></li>
                                                            <li><a href="#">ابزار آموزشی دخترانه</a></li>
                                                            <li><a href="#">هنر های کودکان</a></li>
                                                            <li><a href="#">بازی های ویدئویی بچگانه</a></li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="menu_item_children"><a href="#"> کامپیوتر و لپ تاپ <i class="fa fa-angle-left"></i></a>
                                                <ul class="categories_mega_menu column_2">
                                                    <li class="menu_item_children"><a href="#">شلوار جین</a>
                                                        <ul class="categorie_sub_menu">
                                                            <li><a href="#">ساختمان</a></li>
                                                            <li><a href="#">لوازم الکترونیکی</a></li>
                                                            <li><a href="#">اکشن فیگور </a></li>
                                                            <li><a href="#">اسباب بازی های مخصوص</a></li>
                                                        </ul>
                                                    </li>
                                                    <li class="menu_item_children"><a href="#">ماسین حساب ها</a>
                                                        <ul class="categorie_sub_menu">
                                                            <li><a href="#">عروسک های دخترانه</a></li>
                                                            <li><a href="#">ابزار آموزشی دخترانه</a></li>
                                                            <li><a href="#">هنر های کودکان</a></li>
                                                            <li><a href="#">بازی های ویدئویی بچگانه</a></li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li><a href="#"> نورپردازی</a></li>
                                            <li><a href="#"> لوازم جانبی</a></li>
                                            <li><a href="#">قطعات بدنه</a></li>
                                            <li><a href="#">ابزار شبکه</a></li>
                                            <li><a href="#">فیلتر های کارایی</a></li>
                                            <li><a href="#"> قطعات موتور</a></li>
                                            <li id="cat_toggle" class="has-sub"><a href="#"> دسته های بیشتر</a>
                                                <ul class="categorie_sub">
                                                    <li><a href="#">دسته های پنهان</a></li>
                                                </ul>

                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="column2 col-lg-6 ">
                                <div class="search_container">
                                    <form action="#">
                                        <div class="hover_category">
                                            <select class="select_option" name="select" id="categori2">
                                                <option selected value="1">همه دسته ها</option>
                                                <option value="2">لوازم جانبی</option>
                                                <option value="3">سایر لوازم جانبی</option>
                                                <option value="4">لوازم کامپیوتر</option>
                                                <option value="5">دوربین و ویدیو </option>
                                                <option value="6">صفحه نمایش</option>
                                                <option value="7">تبلت ها</option>
                                                <option value="8">لپ تاپ ها</option>
                                                <option value="9">کیف دستی</option>
                                                <option value="10">هدفون و اسپیکر</option>
                                                <option value="11">گیاهان دارویی</option>
                                                <option value="12">سبزیجات</option>
                                                <option value="13">فروشگاه</option>
                                                <option value="14">لپ تاپ و کامپیوتر</option>
                                                <option value="15">ساعت ها</option>
                                                <option value="16">لوازم الکترونیکی</option>
                                            </select>
                                        </div>
                                        <div class="search_box">
                                            <input placeholder="جستجوی محصول ..." type="text">
                                            <button type="submit">جستجو</button>
                                        </div>
                                    </form>
                                </div>

                            </div>
                            <div class="column3 col-lg-3 col-md-6">
                                <div class="header_bigsale">
                                    <a href="#">فروش بزرگ جمعه سیاه</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--header bottom end-->
                </div>
            </div>
        </header>
        <!--header area end-->

        <!--slider area start-->
        <section class="slider_section slider_s_two mb-60 mt-20">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9 offset-lg-3 col-md-12">
                        <div class="swiper-container gallery-top">
                            <div class="slider_area swiper-wrapper">
                                <div class="single_slider swiper-slide d-flex align-items-center" data-bgimg="assets/img/slider/slider5.jpg">
                                    <div class="slider_content">
                                        <h3>کلکسیون جدید</h3>
                                        <h1>کلکسیون جدید <br> لباس های ورزشی مردانه</h1>
                                        <p>تخفیف <span> 30 درصد</span> این هفته</p>
                                        <a class="button" href="shop.html">بررسی محصول</a>
                                    </div>
                                </div>
                                <div class="single_slider swiper-slide d-flex align-items-center" data-bgimg="assets/img/slider/slider6.jpg">
                                    <div class="slider_content">
                                        <h3>محصولات فروش ویژه</h3>
                                        <h1>تمیز و مدرن <br> صندلی مینیمال 2019</h1>
                                        <p>تخفیف <span> 30 درصد</span> این هفته</p>
                                        <a class="button" href="shop.html">بررسی محصول</a>
                                    </div>
                                </div>
                                <div class="single_slider swiper-slide d-flex align-items-center" data-bgimg="assets/img/slider/slider7.jpg">
                                    <div class="slider_content color_white">
                                        <h3>محصولات جدید</h3>
                                        <h1>محصولات جدید <br> برنامه های موبایل</h1>
                                        <p>تخفیف <span> 30 درصد</span> این هفته</p>
                                        <a class="button" href="shop.html">بررسی محصول</a>
                                    </div>
                                </div>
                                <div class="single_slider swiper-slide d-flex align-items-center" data-bgimg="assets/img/slider/slider8.jpg">
                                    <div class="slider_content">
                                        <h3>محصولات فروش ویژه</h3>
                                        <h1>لوازم چوبی <br> صندلی مینیمال 2019</h1>
                                        <p>تخفیف <span> 30 درصد</span> این هفته</p>
                                        <a class="button" href="shop.html">بررسی محصول</a>
                                    </div>
                                </div>
                            </div>
                            <!-- Add Arrows -->

                            <div class="swiper-pagination"></div>
                        </div>
                        <div class="swiper-container gallery-thumbs">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    لبای های ورزشی جدید برای مردان
                                </div>
                                <div class="swiper-slide">
                                    <a href="#"></a>
                                    صندلی تمیز و مدرن مینیمال 2019
                                </div>
                                <div class="swiper-slide">
                                    برترین برنامه های موبایل
                                </div>
                                <div class="swiper-slide">
                                    صندلی چوبی مینیمال 2019
                                </div>
                            </div>
                        </div>

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
                            <img src="assets/img/about/shipping1.png" alt="">
                        </div>
                        <div class="shipping_content">
                            <h4>ارسال رایگان</h4>
                            <p>ارسال رایگان به تمام نقاط کشور</p>
                        </div>
                    </div>
                    <div class="single_shipping">
                        <div class="shipping_icone">
                            <img src="assets/img/about/shipping2.png" alt="">
                        </div>
                        <div class="shipping_content">
                            <h4>ارسال رایگان</h4>
                            <p>ارسال رایگان به تمام نقاط کشور</p>
                        </div>
                    </div>
                    <div class="single_shipping">
                        <div class="shipping_icone">
                            <img src="assets/img/about/shipping3.png" alt="">
                        </div>
                        <div class="shipping_content">
                            <h4>ارسال رایگان</h4>
                            <p>ارسال رایگان به تمام نقاط کشور</p>
                        </div>
                    </div>
                    <div class="single_shipping">
                        <div class="shipping_icone">
                            <img src="assets/img/about/shipping4.png" alt="">
                        </div>
                        <div class="shipping_content">
                            <h4>ارسال رایگان</h4>
                            <p>ارسال رایگان به تمام نقاط کشور</p>
                        </div>
                    </div>
                    <div class="single_shipping">
                        <div class="shipping_icone">
                            <img src="assets/img/about/shipping5.png" alt="">
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

        <!--home section bg area start-->
        <div class="home_section_bg">
            <!--Categories product area start-->
            <div class="categories_product_area mb-55">
                <div class="container">
                    <div class="categories_product_inner">
                        <div class="single_categories_product">
                            <div class="categories_product_content">
                                <h4><a href="shop.html"> موبایل و تبلت</a></h4>
                                <p>12 محصول</p>
                            </div>
                            <div class="categories_product_thumb">
                                <a href="shop.html"><img src="assets/img/s-product/category1.jpg" alt=""></a>
                            </div>
                        </div>
                        <div class="single_categories_product">
                            <div class="categories_product_content">
                                <h4><a href="shop.html"> کامپیوتر</a></h4>
                                <p>24 محصول</p>
                            </div>
                            <div class="categories_product_thumb">
                                <a href="shop.html"><img src="assets/img/s-product/category2.jpg" alt=""></a>
                            </div>
                        </div>
                        <div class="single_categories_product">
                            <div class="categories_product_content">
                                <h4><a href="shop.html"> مد و زیبایی</a></h4>
                                <p>22 محصول</p>
                            </div>
                            <div class="categories_product_thumb">
                                <a href="shop.html"><img src="assets/img/s-product/category3.jpg" alt=""></a>
                            </div>
                        </div>
                        <div class="single_categories_product">
                            <div class="categories_product_content">
                                <h4><a href="shop.html"> عینک آفتابی</a></h4>
                                <p>6 محصول</p>
                            </div>
                            <div class="categories_product_thumb">
                                <a href="shop.html"><img src="assets/img/s-product/category4.jpg" alt=""></a>
                            </div>
                        </div>
                        <div class="single_categories_product">
                            <div class="categories_product_content">
                                <h4><a href="shop.html"> کودک و نوزاد</a></h4>
                                <p>20 محصول</p>
                            </div>
                            <div class="categories_product_thumb">
                                <a href="shop.html"><img src="assets/img/s-product/category5.jpg" alt=""></a>
                            </div>
                        </div>
                        <div class="single_categories_product">
                            <div class="categories_product_content">
                                <h4><a href="shop.html"> لوازم جانبی</a></h4>
                                <p>4 محصول</p>
                            </div>
                            <div class="categories_product_thumb">
                                <a href="shop.html"><img src="assets/img/s-product/category6.jpg" alt=""></a>
                            </div>
                        </div>
                        <div class="single_categories_product">
                            <div class="categories_product_content">
                                <h4><a href="shop.html"> موبایل و تبلت</a></h4>
                                <p>12 محصول</p>
                            </div>
                            <div class="categories_product_thumb">
                                <a href="shop.html"><img src="assets/img/s-product/category7.jpg" alt=""></a>
                            </div>
                        </div>
                        <div class="single_categories_product">
                            <div class="categories_product_content">
                                <h4><a href="shop.html"> لوازم جانبی</a></h4>
                                <p>12 محصول</p>
                            </div>
                            <div class="categories_product_thumb">
                                <a href="shop.html"><img src="assets/img/s-product/category8.jpg" alt=""></a>
                            </div>
                        </div>
                        <div class="single_categories_product">
                            <div class="categories_product_content">
                                <h4><a href="shop.html"> موبایل و تبلت</a></h4>
                                <p>12 محصول</p>
                            </div>
                            <div class="categories_product_thumb">
                                <a href="shop.html"><img src="assets/img/s-product/category9.jpg" alt=""></a>
                            </div>
                        </div>
                        <div class="single_categories_product">
                            <div class="categories_product_content">
                                <h4><a href="shop.html"> کودک و نوزاد</a></h4>
                                <p>12 محصول</p>
                            </div>
                            <div class="categories_product_thumb">
                                <a href="shop.html"><img src="assets/img/s-product/category10.jpg" alt=""></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--Categories product area end-->

            <!--product area start-->
            <div class="product_area deals_product_style2">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="product_header">
                                <div class="section_title">
                                    <h2>پیشنهادهای برتر ماه</h2>

                                </div>
                                <div class="product_tab_btn">
                                    <ul class="nav" role="tablist">
                                        <li>
                                            <a class="active" data-toggle="tab" href="#Fashion" role="tab" aria-controls="Fashion" aria-selected="true">
                                                مد و پوشاک
                                            </a>
                                        </li>
                                        <li>
                                            <a data-toggle="tab" href="#Games" role="tab" aria-controls="Games" aria-selected="false">
                                                بازی و کنسول
                                            </a>
                                        </li>
                                        <li>
                                            <a data-toggle="tab" href="#Speaker" role="tab" aria-controls="Speaker" aria-selected="false">
                                                هدفون و اسپیکر
                                            </a>
                                        </li>
                                        <li>
                                            <a data-toggle="tab" href="#Mobile" role="tab" aria-controls="Mobile" aria-selected="false">
                                                موبایل و تبلت
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="Fashion" role="tabpanel">
                            <div class="product_carousel product_style product_column2 owl-carousel">
                                <article class="single_product">
                                    <figure>
                                        <div class="product_thumb">
                                            <a class="primary_img" href="product-countdown.html"><img src="assets/img/product/product1.jpg" alt=""></a>
                                            <a class="secondary_img" href="product-countdown.html"><img src="assets/img/product/product2.jpg" alt=""></a>
                                        </div>
                                        <div class="product_content">
                                            <div class="product_content_inner">
                                                <h4 class="product_name"><a href="product-countdown.html">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت</a></h4>
                                                <div class="product_rating">
                                                    <ul>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    </ul>
                                                </div>
                                                <div class="price_box">
                                                    <span class="old_price">86,000 تومان</span>
                                                    <span class="current_price">79,000 تومان</span>
                                                </div>
                                                <div class="countdown_text">
                                                    <p><span>عجله کنید!</span> اتمام پیشنهاد در: </p>
                                                </div>
                                                <div class="product_timing">
                                                    <div data-countdown="2045/12/15"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </figure>
                                </article>
                                <article class="single_product">
                                    <figure>
                                        <div class="product_thumb">
                                            <a class="primary_img" href="product-countdown.html"><img src="assets/img/product/product3.jpg" alt=""></a>
                                            <a class="secondary_img" href="product-countdown.html"><img src="assets/img/product/product4.jpg" alt=""></a>
                                        </div>
                                        <div class="product_content">
                                            <div class="product_content_inner">
                                                <h4 class="product_name"><a href="product-countdown.html">ساعت هوشمند سامسونگ مدل Gear Watch</a></h4>
                                                <div class="product_rating">
                                                    <ul>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    </ul>
                                                </div>
                                                <div class="price_box">
                                                    <span class="old_price">82,000 تومان</span>
                                                    <span class="current_price">75,000 تومان</span>
                                                </div>
                                                <div class="countdown_text">
                                                    <p><span>عجله کنید!</span> اتمام پیشنهاد در:</p>
                                                </div>
                                                <div class="product_timing">
                                                    <div data-countdown="2045/08/15"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </figure>
                                </article>
                                <article class="single_product">
                                    <figure>
                                        <div class="product_thumb">
                                            <a class="primary_img" href="product-countdown.html"><img src="assets/img/product/product5.jpg" alt=""></a>
                                            <a class="secondary_img" href="product-countdown.html"><img src="assets/img/product/product6.jpg" alt=""></a>
                                        </div>
                                        <div class="product_content">
                                            <div class="product_content_inner">
                                                <h4 class="product_name"><a href="product-countdown.html">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم</a></h4>
                                                <div class="product_rating">
                                                    <ul>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    </ul>
                                                </div>
                                                <div class="price_box">
                                                    <span class="old_price">80,000 تومان</span>
                                                    <span class="current_price">70,000 تومان</span>
                                                </div>
                                                <div class="countdown_text">
                                                    <p><span>عجله کنید!</span> اتمام پیشنهاد در:</p>
                                                </div>
                                                <div class="product_timing">
                                                    <div data-countdown="2045/02/15"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </figure>
                                </article>
                                <article class="single_product">
                                    <figure>
                                        <div class="product_thumb">
                                            <a class="primary_img" href="product-countdown.html"><img src="assets/img/product/product7.jpg" alt=""></a>
                                            <a class="secondary_img" href="product-countdown.html"><img src="assets/img/product/product8.jpg" alt=""></a>
                                        </div>
                                        <div class="product_content">
                                            <div class="product_content_inner">
                                                <h4 class="product_name"><a href="product-countdown.html">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از</a></h4>
                                                <div class="product_rating">
                                                    <ul>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    </ul>
                                                </div>
                                                <div class="price_box">
                                                    <span class="old_price">76,000 تومان</span>
                                                    <span class="current_price">75,000 تومان</span>
                                                </div>
                                                <div class="countdown_text">
                                                    <p><span>عجله کنید!</span> اتمام پیشنهاد در:</p>
                                                </div>
                                                <div class="product_timing">
                                                    <div data-countdown="2045/11/15"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </figure>
                                </article>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="Games" role="tabpanel">
                            <div class="product_carousel product_style product_column2 owl-carousel">
                                <article class="single_product">
                                    <figure>
                                        <div class="product_thumb">
                                            <a class="primary_img" href="product-countdown.html"><img src="assets/img/product/product5.jpg" alt=""></a>
                                            <a class="secondary_img" href="product-countdown.html"><img src="assets/img/product/product6.jpg" alt=""></a>
                                        </div>
                                        <div class="product_content">
                                            <div class="product_content_inner">
                                                <h4 class="product_name"><a href="product-countdown.html">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم</a></h4>
                                                <div class="product_rating">
                                                    <ul>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    </ul>
                                                </div>
                                                <div class="price_box">
                                                    <span class="old_price">80,000 تومان</span>
                                                    <span class="current_price">70,000 تومان</span>
                                                </div>
                                                <div class="countdown_text">
                                                    <p><span>عجله کنید!</span> اتمام پیشنهاد در:</p>
                                                </div>
                                                <div class="product_timing">
                                                    <div data-countdown="2045/02/15"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </figure>
                                </article>
                                <article class="single_product">
                                    <figure>
                                        <div class="product_thumb">
                                            <a class="primary_img" href="product-countdown.html"><img src="assets/img/product/product7.jpg" alt=""></a>
                                            <a class="secondary_img" href="product-countdown.html"><img src="assets/img/product/product8.jpg" alt=""></a>
                                        </div>
                                        <div class="product_content">
                                            <div class="product_content_inner">
                                                <h4 class="product_name"><a href="product-countdown.html">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از</a></h4>
                                                <div class="product_rating">
                                                    <ul>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    </ul>
                                                </div>
                                                <div class="price_box">
                                                    <span class="old_price">76,000 تومان</span>
                                                    <span class="current_price">75,000 تومان</span>
                                                </div>
                                                <div class="countdown_text">
                                                    <p><span>عجله کنید!</span> اتمام پیشنهاد در:</p>
                                                </div>
                                                <div class="product_timing">
                                                    <div data-countdown="2045/11/15"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </figure>
                                </article>
                                <article class="single_product">
                                    <figure>
                                        <div class="product_thumb">
                                            <a class="primary_img" href="product-countdown.html"><img src="assets/img/product/product1.jpg" alt=""></a>
                                            <a class="secondary_img" href="product-countdown.html"><img src="assets/img/product/product2.jpg" alt=""></a>
                                        </div>
                                        <div class="product_content">
                                            <div class="product_content_inner">
                                                <h4 class="product_name"><a href="product-countdown.html">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت</a></h4>
                                                <div class="product_rating">
                                                    <ul>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    </ul>
                                                </div>
                                                <div class="price_box">
                                                    <span class="old_price">86,000 تومان</span>
                                                    <span class="current_price">79,000 تومان</span>
                                                </div>
                                                <div class="countdown_text">
                                                    <p><span>عجله کنید!</span> اتمام پیشنهاد در: </p>
                                                </div>
                                                <div class="product_timing">
                                                    <div data-countdown="2045/12/15"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </figure>
                                </article>
                                <article class="single_product">
                                    <figure>
                                        <div class="product_thumb">
                                            <a class="primary_img" href="product-countdown.html"><img src="assets/img/product/product3.jpg" alt=""></a>
                                            <a class="secondary_img" href="product-countdown.html"><img src="assets/img/product/product4.jpg" alt=""></a>
                                        </div>
                                        <div class="product_content">
                                            <div class="product_content_inner">
                                                <h4 class="product_name"><a href="product-countdown.html">ساعت هوشمند سامسونگ مدل Gear Watch</a></h4>
                                                <div class="product_rating">
                                                    <ul>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    </ul>
                                                </div>
                                                <div class="price_box">
                                                    <span class="old_price">82,000 تومان</span>
                                                    <span class="current_price">75,000 تومان</span>
                                                </div>
                                                <div class="countdown_text">
                                                    <p><span>عجله کنید!</span> اتمام پیشنهاد در:</p>
                                                </div>
                                                <div class="product_timing">
                                                    <div data-countdown="2045/08/15"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </figure>
                                </article>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="Speaker" role="tabpanel">
                            <div class="product_carousel product_style product_column2 owl-carousel">
                                <article class="single_product">
                                    <figure>
                                        <div class="product_thumb">
                                            <a class="primary_img" href="product-countdown.html"><img src="assets/img/product/product7.jpg" alt=""></a>
                                            <a class="secondary_img" href="product-countdown.html"><img src="assets/img/product/product8.jpg" alt=""></a>
                                        </div>
                                        <div class="product_content">
                                            <div class="product_content_inner">
                                                <h4 class="product_name"><a href="product-countdown.html">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از</a></h4>
                                                <div class="product_rating">
                                                    <ul>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    </ul>
                                                </div>
                                                <div class="price_box">
                                                    <span class="old_price">76,000 تومان</span>
                                                    <span class="current_price">75,000 تومان</span>
                                                </div>
                                                <div class="countdown_text">
                                                    <p><span>عجله کنید!</span> اتمام پیشنهاد در:</p>
                                                </div>
                                                <div class="product_timing">
                                                    <div data-countdown="2045/11/15"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </figure>
                                </article>
                                <article class="single_product">
                                    <figure>
                                        <div class="product_thumb">
                                            <a class="primary_img" href="product-countdown.html"><img src="assets/img/product/product1.jpg" alt=""></a>
                                            <a class="secondary_img" href="product-countdown.html"><img src="assets/img/product/product2.jpg" alt=""></a>
                                        </div>
                                        <div class="product_content">
                                            <div class="product_content_inner">
                                                <h4 class="product_name"><a href="product-countdown.html">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت</a></h4>
                                                <div class="product_rating">
                                                    <ul>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    </ul>
                                                </div>
                                                <div class="price_box">
                                                    <span class="old_price">86,000 تومان</span>
                                                    <span class="current_price">79,000 تومان</span>
                                                </div>
                                                <div class="countdown_text">
                                                    <p><span>عجله کنید!</span> اتمام پیشنهاد در: </p>
                                                </div>
                                                <div class="product_timing">
                                                    <div data-countdown="2045/12/15"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </figure>
                                </article>
                                <article class="single_product">
                                    <figure>
                                        <div class="product_thumb">
                                            <a class="primary_img" href="product-countdown.html"><img src="assets/img/product/product3.jpg" alt=""></a>
                                            <a class="secondary_img" href="product-countdown.html"><img src="assets/img/product/product4.jpg" alt=""></a>
                                        </div>
                                        <div class="product_content">
                                            <div class="product_content_inner">
                                                <h4 class="product_name"><a href="product-countdown.html">ساعت هوشمند سامسونگ مدل Gear Watch</a></h4>
                                                <div class="product_rating">
                                                    <ul>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    </ul>
                                                </div>
                                                <div class="price_box">
                                                    <span class="old_price">82,000 تومان</span>
                                                    <span class="current_price">75,000 تومان</span>
                                                </div>
                                                <div class="countdown_text">
                                                    <p><span>عجله کنید!</span> اتمام پیشنهاد در:</p>
                                                </div>
                                                <div class="product_timing">
                                                    <div data-countdown="2045/08/15"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </figure>
                                </article>
                                <article class="single_product">
                                    <figure>
                                        <div class="product_thumb">
                                            <a class="primary_img" href="product-countdown.html"><img src="assets/img/product/product5.jpg" alt=""></a>
                                            <a class="secondary_img" href="product-countdown.html"><img src="assets/img/product/product6.jpg" alt=""></a>
                                        </div>
                                        <div class="product_content">
                                            <div class="product_content_inner">
                                                <h4 class="product_name"><a href="product-countdown.html">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم</a></h4>
                                                <div class="product_rating">
                                                    <ul>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    </ul>
                                                </div>
                                                <div class="price_box">
                                                    <span class="old_price">80,000 تومان</span>
                                                    <span class="current_price">70,000 تومان</span>
                                                </div>
                                                <div class="countdown_text">
                                                    <p><span>عجله کنید!</span> اتمام پیشنهاد در:</p>
                                                </div>
                                                <div class="product_timing">
                                                    <div data-countdown="2045/02/15"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </figure>
                                </article>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="Mobile" role="tabpanel">
                            <div class="product_carousel product_style product_column2 owl-carousel">
                                <article class="single_product">
                                    <figure>
                                        <div class="product_thumb">
                                            <a class="primary_img" href="product-countdown.html"><img src="assets/img/product/product3.jpg" alt=""></a>
                                            <a class="secondary_img" href="product-countdown.html"><img src="assets/img/product/product4.jpg" alt=""></a>
                                        </div>
                                        <div class="product_content">
                                            <div class="product_content_inner">
                                                <h4 class="product_name"><a href="product-countdown.html">ساعت هوشمند سامسونگ مدل Gear Watch</a></h4>
                                                <div class="product_rating">
                                                    <ul>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    </ul>
                                                </div>
                                                <div class="price_box">
                                                    <span class="old_price">82,000 تومان</span>
                                                    <span class="current_price">75,000 تومان</span>
                                                </div>
                                                <div class="countdown_text">
                                                    <p><span>عجله کنید!</span> اتمام پیشنهاد در:</p>
                                                </div>
                                                <div class="product_timing">
                                                    <div data-countdown="2045/08/15"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </figure>
                                </article>
                                <article class="single_product">
                                    <figure>
                                        <div class="product_thumb">
                                            <a class="primary_img" href="product-countdown.html"><img src="assets/img/product/product7.jpg" alt=""></a>
                                            <a class="secondary_img" href="product-countdown.html"><img src="assets/img/product/product8.jpg" alt=""></a>
                                        </div>
                                        <div class="product_content">
                                            <div class="product_content_inner">
                                                <h4 class="product_name"><a href="product-countdown.html">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از</a></h4>
                                                <div class="product_rating">
                                                    <ul>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    </ul>
                                                </div>
                                                <div class="price_box">
                                                    <span class="old_price">76,000 تومان</span>
                                                    <span class="current_price">75,000 تومان</span>
                                                </div>
                                                <div class="countdown_text">
                                                    <p><span>عجله کنید!</span> اتمام پیشنهاد در:</p>
                                                </div>
                                                <div class="product_timing">
                                                    <div data-countdown="2045/11/15"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </figure>
                                </article>
                                <article class="single_product">
                                    <figure>
                                        <div class="product_thumb">
                                            <a class="primary_img" href="product-countdown.html"><img src="assets/img/product/product1.jpg" alt=""></a>
                                            <a class="secondary_img" href="product-countdown.html"><img src="assets/img/product/product2.jpg" alt=""></a>
                                        </div>
                                        <div class="product_content">
                                            <div class="product_content_inner">
                                                <h4 class="product_name"><a href="product-countdown.html">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت</a></h4>
                                                <div class="product_rating">
                                                    <ul>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    </ul>
                                                </div>
                                                <div class="price_box">
                                                    <span class="old_price">86,000 تومان</span>
                                                    <span class="current_price">79,000 تومان</span>
                                                </div>
                                                <div class="countdown_text">
                                                    <p><span>عجله کنید!</span> اتمام پیشنهاد در: </p>
                                                </div>
                                                <div class="product_timing">
                                                    <div data-countdown="2045/12/15"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </figure>
                                </article>
                                <article class="single_product">
                                    <figure>
                                        <div class="product_thumb">
                                            <a class="primary_img" href="product-countdown.html"><img src="assets/img/product/product5.jpg" alt=""></a>
                                            <a class="secondary_img" href="product-countdown.html"><img src="assets/img/product/product6.jpg" alt=""></a>
                                        </div>
                                        <div class="product_content">
                                            <div class="product_content_inner">
                                                <h4 class="product_name"><a href="product-countdown.html">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم</a></h4>
                                                <div class="product_rating">
                                                    <ul>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    </ul>
                                                </div>
                                                <div class="price_box">
                                                    <span class="old_price">80,000 تومان</span>
                                                    <span class="current_price">70,000 تومان</span>
                                                </div>
                                                <div class="countdown_text">
                                                    <p><span>عجله کنید!</span> اتمام پیشنهاد در:</p>
                                                </div>
                                                <div class="product_timing">
                                                    <div data-countdown="2045/02/15"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </figure>
                                </article>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!--product area end-->

            <!--banner area start-->
            <div class="banner_area mb-55">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <figure class="single_banner">
                                <div class="banner_thumb">
                                    <a href="shop.html"><img src="assets/img/bg/banner4.jpg" alt=""></a>
                                </div>
                            </figure>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <figure class="single_banner">
                                <div class="banner_thumb">
                                    <a href="shop.html"><img src="assets/img/bg/banner5.jpg" alt=""></a>
                                </div>
                            </figure>
                        </div>
                    </div>
                </div>
            </div>
            <!--banner area end-->

            <!--product area start-->
            <div class="product_area">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="product_header">
                                <div class="section_title">
                                    <h2>محصولات ویژه</h2>

                                </div>
                                <div class="product_tab_btn">
                                    <ul class="nav" role="tablist">
                                        <li>
                                            <a class="active" data-toggle="tab" href="#Computer" role="tab" aria-controls="Computer" aria-selected="true">
                                                کامپیوتر
                                            </a>
                                        </li>
                                        <li>
                                            <a data-toggle="tab" href="#Networking" role="tab" aria-controls="Networking" aria-selected="false">
                                                ابزار شبکه
                                            </a>
                                        </li>
                                        <li>
                                            <a data-toggle="tab" href="#Computer2" role="tab" aria-controls="Computer2" aria-selected="false">
                                                کامپیوتر و شبکه
                                            </a>
                                        </li>
                                        <li>
                                            <a data-toggle="tab" href="#Audio" role="tab" aria-controls="Audio" aria-selected="false">
                                                صوتی و تصویری
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="Computer" role="tabpanel">
                            <div class="product_carousel product_style product_column5 owl-carousel">
                                <article class="single_product">
                                    <figure>
                                        <div class="product_thumb">
                                            <a class="primary_img" href="product-details.html"><img src="assets/img/product/product1.jpg" alt=""></a>
                                            <a class="secondary_img" href="product-details.html"><img src="assets/img/product/product2.jpg" alt=""></a>
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
                                                <h4 class="product_name"><a href="product-details.html">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با</a></h4>
                                                <div class="price_box">
                                                    <span class="old_price">86,000 تومان</span>
                                                    <span class="current_price">79,000 تومان</span>
                                                </div>
                                            </div>
                                            <div class="add_to_cart">
                                                <a href="cart.html" title="افزودن به سبد">افزودن به سبد</a>
                                            </div>
                                        </div>
                                    </figure>
                                </article>
                                <article class="single_product">
                                    <figure>
                                        <div class="product_thumb">
                                            <a class="primary_img" href="product-details.html"><img src="assets/img/product/product3.jpg" alt=""></a>
                                            <a class="secondary_img" href="product-details.html"><img src="assets/img/product/product4.jpg" alt=""></a>
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
                                                <h4 class="product_name"><a href="product-details.html">ساعت هوشمند سامسونگ مدل Gear Watch</a></h4>
                                                <div class="price_box">
                                                    <span class="old_price">82,000 تومان</span>
                                                    <span class="current_price">75,000 تومان</span>
                                                </div>
                                            </div>
                                            <div class="add_to_cart">
                                                <a href="cart.html" title="افزودن به سبد">افزودن به سبد</a>
                                            </div>
                                        </div>
                                    </figure>
                                </article>
                                <article class="single_product">
                                    <figure>
                                        <div class="product_thumb">
                                            <a class="primary_img" href="product-details.html"><img src="assets/img/product/product5.jpg" alt=""></a>
                                            <a class="secondary_img" href="product-details.html"><img src="assets/img/product/product6.jpg" alt=""></a>
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
                                <article class="single_product">
                                    <figure>
                                        <div class="product_thumb">
                                            <a class="primary_img" href="product-details.html"><img src="assets/img/product/product7.jpg" alt=""></a>
                                            <a class="secondary_img" href="product-details.html"><img src="assets/img/product/product8.jpg" alt=""></a>
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
                                                <h4 class="product_name"><a href="product-details.html">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ</a></h4>
                                                <div class="price_box">
                                                    <span class="old_price">76,000 تومان</span>
                                                    <span class="current_price">75,000 تومان</span>
                                                </div>
                                            </div>
                                            <div class="add_to_cart">
                                                <a href="cart.html" title="افزودن به سبد">افزودن به سبد</a>
                                            </div>
                                        </div>
                                    </figure>
                                </article>
                                <article class="single_product">
                                    <figure>
                                        <div class="product_thumb">
                                            <a class="primary_img" href="product-details.html"><img src="assets/img/product/product9.jpg" alt=""></a>
                                            <a class="secondary_img" href="product-details.html"><img src="assets/img/product/product10.jpg" alt=""></a>
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
                                                <h4 class="product_name"><a href="product-details.html">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از</a></h4>
                                                <div class="price_box">
                                                    <span class="old_price">72,000 تومان</span>
                                                    <span class="current_price">70,000 تومان</span>
                                                </div>
                                            </div>
                                            <div class="add_to_cart">
                                                <a href="cart.html" title="افزودن به سبد">افزودن به سبد</a>
                                            </div>

                                        </div>
                                    </figure>
                                </article>
                                <article class="single_product">
                                    <figure>
                                        <div class="product_thumb">
                                            <a class="primary_img" href="product-details.html"><img src="assets/img/product/product11.jpg" alt=""></a>
                                            <a class="secondary_img" href="product-details.html"><img src="assets/img/product/product12.jpg" alt=""></a>
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
                                                <h4 class="product_name"><a href="product-details.html">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از</a></h4>
                                                <div class="price_box">
                                                    <span class="old_price">65,000 تومان</span>
                                                    <span class="current_price">60,000 تومان</span>
                                                </div>
                                            </div>
                                            <div class="add_to_cart">
                                                <a href="cart.html" title="افزودن به سبد">افزودن به سبد</a>
                                            </div>

                                        </div>
                                    </figure>
                                </article>
                                <article class="single_product">
                                    <figure>
                                        <div class="product_thumb">
                                            <a class="primary_img" href="product-details.html"><img src="assets/img/product/product13.jpg" alt=""></a>
                                            <a class="secondary_img" href="product-details.html"><img src="assets/img/product/product14.jpg" alt=""></a>
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
                                                <h4 class="product_name"><a href="product-details.html">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ</a></h4>
                                                <div class="price_box">
                                                    <span class="old_price">70,000 تومان</span>
                                                    <span class="current_price">68,000 تومان</span>
                                                </div>
                                            </div>
                                            <div class="add_to_cart">
                                                <a href="cart.html" title="افزودن به سبد">افزودن به سبد</a>
                                            </div>

                                        </div>
                                    </figure>
                                </article>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="Networking" role="tabpanel">
                            <div class="product_carousel product_style product_column5 owl-carousel">
                                <article class="single_product">
                                    <figure>
                                        <div class="product_thumb">
                                            <a class="primary_img" href="product-details.html"><img src="assets/img/product/product9.jpg" alt=""></a>
                                            <a class="secondary_img" href="product-details.html"><img src="assets/img/product/product10.jpg" alt=""></a>
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
                                                <h4 class="product_name"><a href="product-details.html">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از</a></h4>
                                                <div class="price_box">
                                                    <span class="old_price">72,000 تومان</span>
                                                    <span class="current_price">70,000 تومان</span>
                                                </div>
                                            </div>
                                            <div class="add_to_cart">
                                                <a href="cart.html" title="افزودن به سبد">افزودن به سبد</a>
                                            </div>

                                        </div>
                                    </figure>
                                </article>
                                <article class="single_product">
                                    <figure>
                                        <div class="product_thumb">
                                            <a class="primary_img" href="product-details.html"><img src="assets/img/product/product11.jpg" alt=""></a>
                                            <a class="secondary_img" href="product-details.html"><img src="assets/img/product/product12.jpg" alt=""></a>
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
                                                <h4 class="product_name"><a href="product-details.html">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از</a></h4>
                                                <div class="price_box">
                                                    <span class="old_price">65,000 تومان</span>
                                                    <span class="current_price">60,000 تومان</span>
                                                </div>
                                            </div>
                                            <div class="add_to_cart">
                                                <a href="cart.html" title="افزودن به سبد">افزودن به سبد</a>
                                            </div>

                                        </div>
                                    </figure>
                                </article>
                                <article class="single_product">
                                    <figure>
                                        <div class="product_thumb">
                                            <a class="primary_img" href="product-details.html"><img src="assets/img/product/product13.jpg" alt=""></a>
                                            <a class="secondary_img" href="product-details.html"><img src="assets/img/product/product14.jpg" alt=""></a>
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
                                                <h4 class="product_name"><a href="product-details.html">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ</a></h4>
                                                <div class="price_box">
                                                    <span class="old_price">70,000 تومان</span>
                                                    <span class="current_price">68,000 تومان</span>
                                                </div>
                                            </div>
                                            <div class="add_to_cart">
                                                <a href="cart.html" title="افزودن به سبد">افزودن به سبد</a>
                                            </div>

                                        </div>
                                    </figure>
                                </article>
                                <article class="single_product">
                                    <figure>
                                        <div class="product_thumb">
                                            <a class="primary_img" href="product-details.html"><img src="assets/img/product/product15.jpg" alt=""></a>
                                            <a class="secondary_img" href="product-details.html"><img src="assets/img/product/product16.jpg" alt=""></a>
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
                                                    <span class="old_price">65,000 تومان</span>
                                                    <span class="current_price">60,000 تومان</span>
                                                </div>
                                            </div>
                                            <div class="add_to_cart">
                                                <a href="cart.html" title="افزودن به سبد">افزودن به سبد</a>
                                            </div>

                                        </div>
                                    </figure>
                                </article>
                                <article class="single_product">
                                    <figure>
                                        <div class="product_thumb">
                                            <a class="primary_img" href="product-details.html"><img src="assets/img/product/product17.jpg" alt=""></a>
                                            <a class="secondary_img" href="product-details.html"><img src="assets/img/product/product18.jpg" alt=""></a>
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
                                                <h4 class="product_name"><a href="product-details.html">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم</a></h4>
                                                <div class="price_box">
                                                    <span class="old_price">65,000 تومان</span>
                                                    <span class="current_price">60,000 تومان</span>
                                                </div>
                                            </div>
                                            <div class="add_to_cart">
                                                <a href="cart.html" title="افزودن به سبد">افزودن به سبد</a>
                                            </div>

                                        </div>
                                    </figure>
                                </article>
                                <article class="single_product">
                                    <figure>
                                        <div class="product_thumb">
                                            <a class="primary_img" href="product-details.html"><img src="assets/img/product/product19.jpg" alt=""></a>
                                            <a class="secondary_img" href="product-details.html"><img src="assets/img/product/product20.jpg" alt=""></a>
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
                                                    <span class="old_price">65,000 تومان</span>
                                                    <span class="current_price">60,000 تومان</span>
                                                </div>
                                            </div>
                                            <div class="add_to_cart">
                                                <a href="cart.html" title="افزودن به سبد">افزودن به سبد</a>
                                            </div>

                                        </div>
                                    </figure>
                                </article>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="Computer2" role="tabpanel">
                            <div class="product_carousel product_style product_column5 owl-carousel">
                                <article class="single_product">
                                    <figure>
                                        <div class="product_thumb">
                                            <a class="primary_img" href="product-details.html"><img src="assets/img/product/product17.jpg" alt=""></a>
                                            <a class="secondary_img" href="product-details.html"><img src="assets/img/product/product18.jpg" alt=""></a>
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
                                                <h4 class="product_name"><a href="product-details.html">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم</a></h4>
                                                <div class="price_box">
                                                    <span class="old_price">65,000 تومان</span>
                                                    <span class="current_price">60,000 تومان</span>
                                                </div>
                                            </div>
                                            <div class="add_to_cart">
                                                <a href="cart.html" title="افزودن به سبد">افزودن به سبد</a>
                                            </div>

                                        </div>
                                    </figure>
                                </article>
                                <article class="single_product">
                                    <figure>
                                        <div class="product_thumb">
                                            <a class="primary_img" href="product-details.html"><img src="assets/img/product/product19.jpg" alt=""></a>
                                            <a class="secondary_img" href="product-details.html"><img src="assets/img/product/product20.jpg" alt=""></a>
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
                                                    <span class="old_price">65,000 تومان</span>
                                                    <span class="current_price">60,000 تومان</span>
                                                </div>
                                            </div>
                                            <div class="add_to_cart">
                                                <a href="cart.html" title="افزودن به سبد">افزودن به سبد</a>
                                            </div>

                                        </div>
                                    </figure>
                                </article>
                                <article class="single_product">
                                    <figure>
                                        <div class="product_thumb">
                                            <a class="primary_img" href="product-details.html"><img src="assets/img/product/product1.jpg" alt=""></a>
                                            <a class="secondary_img" href="product-details.html"><img src="assets/img/product/product2.jpg" alt=""></a>
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
                                                <h4 class="product_name"><a href="product-details.html">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با</a></h4>
                                                <div class="price_box">
                                                    <span class="old_price">86,000 تومان</span>
                                                    <span class="current_price">79,000 تومان</span>
                                                </div>
                                            </div>
                                            <div class="add_to_cart">
                                                <a href="cart.html" title="افزودن به سبد">افزودن به سبد</a>
                                            </div>
                                        </div>
                                    </figure>
                                </article>
                                <article class="single_product">
                                    <figure>
                                        <div class="product_thumb">
                                            <a class="primary_img" href="product-details.html"><img src="assets/img/product/product3.jpg" alt=""></a>
                                            <a class="secondary_img" href="product-details.html"><img src="assets/img/product/product4.jpg" alt=""></a>
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
                                                <h4 class="product_name"><a href="product-details.html">ساعت هوشمند سامسونگ مدل Gear Watch</a></h4>
                                                <div class="price_box">
                                                    <span class="old_price">82,000 تومان</span>
                                                    <span class="current_price">75,000 تومان</span>
                                                </div>
                                            </div>
                                            <div class="add_to_cart">
                                                <a href="cart.html" title="افزودن به سبد">افزودن به سبد</a>
                                            </div>
                                        </div>
                                    </figure>
                                </article>
                                <article class="single_product">
                                    <figure>
                                        <div class="product_thumb">
                                            <a class="primary_img" href="product-details.html"><img src="assets/img/product/product9.jpg" alt=""></a>
                                            <a class="secondary_img" href="product-details.html"><img src="assets/img/product/product10.jpg" alt=""></a>
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
                                                <h4 class="product_name"><a href="product-details.html">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از</a></h4>
                                                <div class="price_box">
                                                    <span class="old_price">72,000 تومان</span>
                                                    <span class="current_price">70,000 تومان</span>
                                                </div>
                                            </div>
                                            <div class="add_to_cart">
                                                <a href="cart.html" title="افزودن به سبد">افزودن به سبد</a>
                                            </div>

                                        </div>
                                    </figure>
                                </article>
                                <article class="single_product">
                                    <figure>
                                        <div class="product_thumb">
                                            <a class="primary_img" href="product-details.html"><img src="assets/img/product/product11.jpg" alt=""></a>
                                            <a class="secondary_img" href="product-details.html"><img src="assets/img/product/product12.jpg" alt=""></a>
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
                                                <h4 class="product_name"><a href="product-details.html">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از</a></h4>
                                                <div class="price_box">
                                                    <span class="old_price">65,000 تومان</span>
                                                    <span class="current_price">60,000 تومان</span>
                                                </div>
                                            </div>
                                            <div class="add_to_cart">
                                                <a href="cart.html" title="افزودن به سبد">افزودن به سبد</a>
                                            </div>

                                        </div>
                                    </figure>
                                </article>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="Audio" role="tabpanel">
                            <div class="product_carousel product_style product_column5 owl-carousel">
                                <article class="single_product">
                                    <figure>
                                        <div class="product_thumb">
                                            <a class="primary_img" href="product-details.html"><img src="assets/img/product/product9.jpg" alt=""></a>
                                            <a class="secondary_img" href="product-details.html"><img src="assets/img/product/product10.jpg" alt=""></a>
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
                                                <h4 class="product_name"><a href="product-details.html">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از</a></h4>
                                                <div class="price_box">
                                                    <span class="old_price">72,000 تومان</span>
                                                    <span class="current_price">70,000 تومان</span>
                                                </div>
                                            </div>
                                            <div class="add_to_cart">
                                                <a href="cart.html" title="افزودن به سبد">افزودن به سبد</a>
                                            </div>

                                        </div>
                                    </figure>
                                </article>
                                <article class="single_product">
                                    <figure>
                                        <div class="product_thumb">
                                            <a class="primary_img" href="product-details.html"><img src="assets/img/product/product11.jpg" alt=""></a>
                                            <a class="secondary_img" href="product-details.html"><img src="assets/img/product/product12.jpg" alt=""></a>
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
                                                <h4 class="product_name"><a href="product-details.html">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از</a></h4>
                                                <div class="price_box">
                                                    <span class="old_price">65,000 تومان</span>
                                                    <span class="current_price">60,000 تومان</span>
                                                </div>
                                            </div>
                                            <div class="add_to_cart">
                                                <a href="cart.html" title="افزودن به سبد">افزودن به سبد</a>
                                            </div>

                                        </div>
                                    </figure>
                                </article>
                                <article class="single_product">
                                    <figure>
                                        <div class="product_thumb">
                                            <a class="primary_img" href="product-details.html"><img src="assets/img/product/product13.jpg" alt=""></a>
                                            <a class="secondary_img" href="product-details.html"><img src="assets/img/product/product14.jpg" alt=""></a>
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
                                                <h4 class="product_name"><a href="product-details.html">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ</a></h4>
                                                <div class="price_box">
                                                    <span class="old_price">70,000 تومان</span>
                                                    <span class="current_price">68,000 تومان</span>
                                                </div>
                                            </div>
                                            <div class="add_to_cart">
                                                <a href="cart.html" title="افزودن به سبد">افزودن به سبد</a>
                                            </div>

                                        </div>
                                    </figure>
                                </article>
                                <article class="single_product">
                                    <figure>
                                        <div class="product_thumb">
                                            <a class="primary_img" href="product-details.html"><img src="assets/img/product/product15.jpg" alt=""></a>
                                            <a class="secondary_img" href="product-details.html"><img src="assets/img/product/product16.jpg" alt=""></a>
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
                                                    <span class="old_price">65,000 تومان</span>
                                                    <span class="current_price">60,000 تومان</span>
                                                </div>
                                            </div>
                                            <div class="add_to_cart">
                                                <a href="cart.html" title="افزودن به سبد">افزودن به سبد</a>
                                            </div>

                                        </div>
                                    </figure>
                                </article>
                                <article class="single_product">
                                    <figure>
                                        <div class="product_thumb">
                                            <a class="primary_img" href="product-details.html"><img src="assets/img/product/product17.jpg" alt=""></a>
                                            <a class="secondary_img" href="product-details.html"><img src="assets/img/product/product18.jpg" alt=""></a>
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
                                                <h4 class="product_name"><a href="product-details.html">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم</a></h4>
                                                <div class="price_box">
                                                    <span class="old_price">65,000 تومان</span>
                                                    <span class="current_price">60,000 تومان</span>
                                                </div>
                                            </div>
                                            <div class="add_to_cart">
                                                <a href="cart.html" title="افزودن به سبد">افزودن به سبد</a>
                                            </div>

                                        </div>
                                    </figure>
                                </article>
                                <article class="single_product">
                                    <figure>
                                        <div class="product_thumb">
                                            <a class="primary_img" href="product-details.html"><img src="assets/img/product/product19.jpg" alt=""></a>
                                            <a class="secondary_img" href="product-details.html"><img src="assets/img/product/product20.jpg" alt=""></a>
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
                                                    <span class="old_price">65,000 تومان</span>
                                                    <span class="current_price">60,000 تومان</span>
                                                </div>
                                            </div>
                                            <div class="add_to_cart">
                                                <a href="cart.html" title="افزودن به سبد">افزودن به سبد</a>
                                            </div>

                                        </div>
                                    </figure>
                                </article>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!--product area end-->


            <!--product area start-->
            <div class="small_product_area mb-55">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="product_header">
                                <div class="section_title">
                                    <h2>محصولات پرفروش</h2>

                                </div>
                                <div class="product_tab_btn">
                                    <ul class="nav" role="tablist">
                                        <li>
                                            <a class="active" data-toggle="tab" href="#Fashion2" role="tab" aria-controls="Fashion2" aria-selected="true">
                                                مد و پوشاک
                                            </a>
                                        </li>
                                        <li>
                                            <a data-toggle="tab" href="#Games2" role="tab" aria-controls="Games2" aria-selected="false">
                                                بازی و کنسول
                                            </a>
                                        </li>
                                        <li>
                                            <a data-toggle="tab" href="#Headphone2" role="tab" aria-controls="Headphone2" aria-selected="false">
                                                هدفون و اسپیکر
                                            </a>
                                        </li>
                                        <li>
                                            <a data-toggle="tab" href="#Mobile2" role="tab" aria-controls="Mobile2" aria-selected="false">
                                                موبایل و تبلت
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="Fashion2" role="tabpanel">
                            <div class="product_carousel small_p_container  small_product_column3 owl-carousel">
                                <div class="product_items">
                                    <figure class="single_product">
                                        <div class="product_thumb">
                                            <a class="primary_img" href="product-details.html"><img src="assets/img/product/product1.jpg" alt=""></a>
                                            <a class="secondary_img" href="product-details.html"><img src="assets/img/product/product2.jpg" alt=""></a>
                                        </div>
                                        <div class="product_content">
                                            <h4 class="product_name"><a href="product-details.html">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت</a></h4>
                                            <div class="product_rating">
                                                <ul>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                </ul>
                                            </div>
                                            <div class="price_box">
                                                <span class="old_price">86,000 تومان</span>
                                                <span class="current_price">79,000 تومان</span>
                                            </div>
                                            <div class="product_cart_button">
                                                <a href="cart.html" title="افزودن به سبد"><i class="fa fa-shopping-bag"></i></a>
                                            </div>

                                        </div>
                                    </figure>
                                    <figure class="single_product">
                                        <div class="product_thumb">
                                            <a class="primary_img" href="product-details.html"><img src="assets/img/product/product3.jpg" alt=""></a>
                                            <a class="secondary_img" href="product-details.html"><img src="assets/img/product/product4.jpg" alt=""></a>
                                        </div>
                                        <div class="product_content">
                                            <h4 class="product_name"><a href="product-details.html">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ</a></h4>
                                            <div class="product_rating">
                                                <ul>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                </ul>
                                            </div>
                                            <div class="price_box">
                                                <span class="old_price">80,000 تومان</span>
                                                <span class="current_price">70,000 تومان</span>
                                            </div>
                                            <div class="product_cart_button">
                                                <a href="cart.html" title="افزودن به سبد"><i class="fa fa-shopping-bag"></i></a>
                                            </div>

                                        </div>
                                    </figure>
                                </div>
                                <div class="product_items">
                                    <figure class="single_product">
                                        <div class="product_thumb">
                                            <a class="primary_img" href="product-details.html"><img src="assets/img/product/product5.jpg" alt=""></a>
                                            <a class="secondary_img" href="product-details.html"><img src="assets/img/product/product6.jpg" alt=""></a>
                                        </div>
                                        <div class="product_content">
                                            <h4 class="product_name"><a href="product-details.html">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با</a></h4>
                                            <div class="product_rating">
                                                <ul>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                </ul>
                                            </div>
                                            <div class="price_box">
                                                <span class="old_price">76,000 تومان</span>
                                                <span class="current_price">72,000 تومان</span>
                                            </div>
                                            <div class="product_cart_button">
                                                <a href="cart.html" title="افزودن به سبد"><i class="fa fa-shopping-bag"></i></a>
                                            </div>

                                        </div>
                                    </figure>
                                    <figure class="single_product">
                                        <div class="product_thumb">
                                            <a class="primary_img" href="product-details.html"><img src="assets/img/product/product7.jpg" alt=""></a>
                                            <a class="secondary_img" href="product-details.html"><img src="assets/img/product/product8.jpg" alt=""></a>
                                        </div>
                                        <div class="product_content">
                                            <h4 class="product_name"><a href="product-details.html">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت</a></h4>
                                            <div class="product_rating">
                                                <ul>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                </ul>
                                            </div>
                                            <div class="price_box">
                                                <span class="old_price">65,000 تومان</span>
                                                <span class="current_price">60,000 تومان</span>
                                            </div>
                                            <div class="product_cart_button">
                                                <a href="cart.html" title="افزودن به سبد"><i class="fa fa-shopping-bag"></i></a>
                                            </div>

                                        </div>
                                    </figure>
                                </div>
                                <div class="product_items">
                                    <figure class="single_product">
                                        <div class="product_thumb">
                                            <a class="primary_img" href="product-details.html"><img src="assets/img/product/product9.jpg" alt=""></a>
                                            <a class="secondary_img" href="product-details.html"><img src="assets/img/product/product10.jpg" alt=""></a>
                                        </div>
                                        <div class="product_content">
                                            <h4 class="product_name"><a href="product-details.html">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت</a></h4>
                                            <div class="product_rating">
                                                <ul>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                </ul>
                                            </div>
                                            <div class="price_box">
                                                <span class="old_price">82,000 تومان</span>
                                                <span class="current_price">78,000 تومان</span>
                                            </div>
                                            <div class="product_cart_button">
                                                <a href="cart.html" title="افزودن به سبد"><i class="fa fa-shopping-bag"></i></a>
                                            </div>

                                        </div>
                                    </figure>
                                    <figure class="single_product">
                                        <div class="product_thumb">
                                            <a class="primary_img" href="product-details.html"><img src="assets/img/product/product11.jpg" alt=""></a>
                                            <a class="secondary_img" href="product-details.html"><img src="assets/img/product/product12.jpg" alt=""></a>
                                        </div>
                                        <div class="product_content">
                                            <h4 class="product_name"><a href="product-details.html">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ</a></h4>
                                            <div class="product_rating">
                                                <ul>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                </ul>
                                            </div>
                                            <div class="price_box">
                                                <span class="old_price">72,000 تومان</span>
                                                <span class="current_price">68,000 تومان</span>
                                            </div>
                                            <div class="product_cart_button">
                                                <a href="cart.html" title="افزودن به سبد"><i class="fa fa-shopping-bag"></i></a>
                                            </div>

                                        </div>
                                    </figure>
                                </div>
                                <div class="product_items">
                                    <figure class="single_product">
                                        <div class="product_thumb">
                                            <a class="primary_img" href="product-details.html"><img src="assets/img/product/product13.jpg" alt=""></a>
                                            <a class="secondary_img" href="product-details.html"><img src="assets/img/product/product14.jpg" alt=""></a>
                                        </div>
                                        <div class="product_content">
                                            <h4 class="product_name"><a href="product-details.html">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت</a></h4>
                                            <div class="product_rating">
                                                <ul>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                </ul>
                                            </div>
                                            <div class="price_box">
                                                <span class="old_price">86,000 تومان</span>
                                                <span class="current_price">79,000 تومان</span>
                                            </div>
                                            <div class="product_cart_button">
                                                <a href="cart.html" title="افزودن به سبد"><i class="fa fa-shopping-bag"></i></a>
                                            </div>

                                        </div>
                                    </figure>
                                    <figure class="single_product">
                                        <div class="product_thumb">
                                            <a class="primary_img" href="product-details.html"><img src="assets/img/product/product17.jpg" alt=""></a>
                                            <a class="secondary_img" href="product-details.html"><img src="assets/img/product/product18.jpg" alt=""></a>
                                        </div>
                                        <div class="product_content">
                                            <h4 class="product_name"><a href="product-details.html">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت</a></h4>
                                            <div class="product_rating">
                                                <ul>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                </ul>
                                            </div>
                                            <div class="price_box">
                                                <span class="old_price">75,000 تومان</span>
                                                <span class="current_price">70,000 تومان</span>
                                            </div>
                                            <div class="product_cart_button">
                                                <a href="cart.html" title="افزودن به سبد"><i class="fa fa-shopping-bag"></i></a>
                                            </div>

                                        </div>
                                    </figure>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="Games2" role="tabpanel">
                            <div class="product_carousel small_p_container  small_product_column3 owl-carousel">
                                <div class="product_items">
                                    <figure class="single_product">
                                        <div class="product_thumb">
                                            <a class="primary_img" href="product-details.html"><img src="assets/img/product/product9.jpg" alt=""></a>
                                            <a class="secondary_img" href="product-details.html"><img src="assets/img/product/product10.jpg" alt=""></a>
                                        </div>
                                        <div class="product_content">
                                            <h4 class="product_name"><a href="product-details.html">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت</a></h4>
                                            <div class="product_rating">
                                                <ul>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                </ul>
                                            </div>
                                            <div class="price_box">
                                                <span class="old_price">82,000 تومان</span>
                                                <span class="current_price">78,000 تومان</span>
                                            </div>
                                            <div class="product_cart_button">
                                                <a href="cart.html" title="افزودن به سبد"><i class="fa fa-shopping-bag"></i></a>
                                            </div>

                                        </div>
                                    </figure>
                                    <figure class="single_product">
                                        <div class="product_thumb">
                                            <a class="primary_img" href="product-details.html"><img src="assets/img/product/product11.jpg" alt=""></a>
                                            <a class="secondary_img" href="product-details.html"><img src="assets/img/product/product12.jpg" alt=""></a>
                                        </div>
                                        <div class="product_content">
                                            <h4 class="product_name"><a href="product-details.html">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ</a></h4>
                                            <div class="product_rating">
                                                <ul>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                </ul>
                                            </div>
                                            <div class="price_box">
                                                <span class="old_price">72,000 تومان</span>
                                                <span class="current_price">68,000 تومان</span>
                                            </div>
                                            <div class="product_cart_button">
                                                <a href="cart.html" title="افزودن به سبد"><i class="fa fa-shopping-bag"></i></a>
                                            </div>

                                        </div>
                                    </figure>
                                </div>
                                <div class="product_items">
                                    <figure class="single_product">
                                        <div class="product_thumb">
                                            <a class="primary_img" href="product-details.html"><img src="assets/img/product/product13.jpg" alt=""></a>
                                            <a class="secondary_img" href="product-details.html"><img src="assets/img/product/product14.jpg" alt=""></a>
                                        </div>
                                        <div class="product_content">
                                            <h4 class="product_name"><a href="product-details.html">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت</a></h4>
                                            <div class="product_rating">
                                                <ul>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                </ul>
                                            </div>
                                            <div class="price_box">
                                                <span class="old_price">86,000 تومان</span>
                                                <span class="current_price">79,000 تومان</span>
                                            </div>
                                            <div class="product_cart_button">
                                                <a href="cart.html" title="افزودن به سبد"><i class="fa fa-shopping-bag"></i></a>
                                            </div>

                                        </div>
                                    </figure>
                                    <figure class="single_product">
                                        <div class="product_thumb">
                                            <a class="primary_img" href="product-details.html"><img src="assets/img/product/product17.jpg" alt=""></a>
                                            <a class="secondary_img" href="product-details.html"><img src="assets/img/product/product18.jpg" alt=""></a>
                                        </div>
                                        <div class="product_content">
                                            <h4 class="product_name"><a href="product-details.html">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت</a></h4>
                                            <div class="product_rating">
                                                <ul>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                </ul>
                                            </div>
                                            <div class="price_box">
                                                <span class="old_price">75,000 تومان</span>
                                                <span class="current_price">70,000 تومان</span>
                                            </div>
                                            <div class="product_cart_button">
                                                <a href="cart.html" title="افزودن به سبد"><i class="fa fa-shopping-bag"></i></a>
                                            </div>

                                        </div>
                                    </figure>
                                </div>
                                <div class="product_items">
                                    <figure class="single_product">
                                        <div class="product_thumb">
                                            <a class="primary_img" href="product-details.html"><img src="assets/img/product/product1.jpg" alt=""></a>
                                            <a class="secondary_img" href="product-details.html"><img src="assets/img/product/product2.jpg" alt=""></a>
                                        </div>
                                        <div class="product_content">
                                            <h4 class="product_name"><a href="product-details.html">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت</a></h4>
                                            <div class="product_rating">
                                                <ul>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                </ul>
                                            </div>
                                            <div class="price_box">
                                                <span class="old_price">86,000 تومان</span>
                                                <span class="current_price">79,000 تومان</span>
                                            </div>
                                            <div class="product_cart_button">
                                                <a href="cart.html" title="افزودن به سبد"><i class="fa fa-shopping-bag"></i></a>
                                            </div>

                                        </div>
                                    </figure>
                                    <figure class="single_product">
                                        <div class="product_thumb">
                                            <a class="primary_img" href="product-details.html"><img src="assets/img/product/product3.jpg" alt=""></a>
                                            <a class="secondary_img" href="product-details.html"><img src="assets/img/product/product4.jpg" alt=""></a>
                                        </div>
                                        <div class="product_content">
                                            <h4 class="product_name"><a href="product-details.html">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ</a></h4>
                                            <div class="product_rating">
                                                <ul>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                </ul>
                                            </div>
                                            <div class="price_box">
                                                <span class="old_price">80,000 تومان</span>
                                                <span class="current_price">70,000 تومان</span>
                                            </div>
                                            <div class="product_cart_button">
                                                <a href="cart.html" title="افزودن به سبد"><i class="fa fa-shopping-bag"></i></a>
                                            </div>

                                        </div>
                                    </figure>
                                </div>
                                <div class="product_items">
                                    <figure class="single_product">
                                        <div class="product_thumb">
                                            <a class="primary_img" href="product-details.html"><img src="assets/img/product/product5.jpg" alt=""></a>
                                            <a class="secondary_img" href="product-details.html"><img src="assets/img/product/product6.jpg" alt=""></a>
                                        </div>
                                        <div class="product_content">
                                            <h4 class="product_name"><a href="product-details.html">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با</a></h4>
                                            <div class="product_rating">
                                                <ul>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                </ul>
                                            </div>
                                            <div class="price_box">
                                                <span class="old_price">76,000 تومان</span>
                                                <span class="current_price">72,000 تومان</span>
                                            </div>
                                            <div class="product_cart_button">
                                                <a href="cart.html" title="افزودن به سبد"><i class="fa fa-shopping-bag"></i></a>
                                            </div>

                                        </div>
                                    </figure>
                                    <figure class="single_product">
                                        <div class="product_thumb">
                                            <a class="primary_img" href="product-details.html"><img src="assets/img/product/product7.jpg" alt=""></a>
                                            <a class="secondary_img" href="product-details.html"><img src="assets/img/product/product8.jpg" alt=""></a>
                                        </div>
                                        <div class="product_content">
                                            <h4 class="product_name"><a href="product-details.html">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت</a></h4>
                                            <div class="product_rating">
                                                <ul>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                </ul>
                                            </div>
                                            <div class="price_box">
                                                <span class="old_price">65,000 تومان</span>
                                                <span class="current_price">60,000 تومان</span>
                                            </div>
                                            <div class="product_cart_button">
                                                <a href="cart.html" title="افزودن به سبد"><i class="fa fa-shopping-bag"></i></a>
                                            </div>

                                        </div>
                                    </figure>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="Headphone2" role="tabpanel">
                            <div class="product_carousel small_p_container  small_product_column3 owl-carousel">
                                <div class="product_items">
                                    <figure class="single_product">
                                        <div class="product_thumb">
                                            <a class="primary_img" href="product-details.html"><img src="assets/img/product/product5.jpg" alt=""></a>
                                            <a class="secondary_img" href="product-details.html"><img src="assets/img/product/product6.jpg" alt=""></a>
                                        </div>
                                        <div class="product_content">
                                            <h4 class="product_name"><a href="product-details.html">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با</a></h4>
                                            <div class="product_rating">
                                                <ul>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                </ul>
                                            </div>
                                            <div class="price_box">
                                                <span class="old_price">76,000 تومان</span>
                                                <span class="current_price">72,000 تومان</span>
                                            </div>
                                            <div class="product_cart_button">
                                                <a href="cart.html" title="افزودن به سبد"><i class="fa fa-shopping-bag"></i></a>
                                            </div>

                                        </div>
                                    </figure>
                                    <figure class="single_product">
                                        <div class="product_thumb">
                                            <a class="primary_img" href="product-details.html"><img src="assets/img/product/product7.jpg" alt=""></a>
                                            <a class="secondary_img" href="product-details.html"><img src="assets/img/product/product8.jpg" alt=""></a>
                                        </div>
                                        <div class="product_content">
                                            <h4 class="product_name"><a href="product-details.html">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت</a></h4>
                                            <div class="product_rating">
                                                <ul>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                </ul>
                                            </div>
                                            <div class="price_box">
                                                <span class="old_price">65,000 تومان</span>
                                                <span class="current_price">60,000 تومان</span>
                                            </div>
                                            <div class="product_cart_button">
                                                <a href="cart.html" title="افزودن به سبد"><i class="fa fa-shopping-bag"></i></a>
                                            </div>

                                        </div>
                                    </figure>
                                </div>
                                <div class="product_items">
                                    <figure class="single_product">
                                        <div class="product_thumb">
                                            <a class="primary_img" href="product-details.html"><img src="assets/img/product/product9.jpg" alt=""></a>
                                            <a class="secondary_img" href="product-details.html"><img src="assets/img/product/product10.jpg" alt=""></a>
                                        </div>
                                        <div class="product_content">
                                            <h4 class="product_name"><a href="product-details.html">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت</a></h4>
                                            <div class="product_rating">
                                                <ul>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                </ul>
                                            </div>
                                            <div class="price_box">
                                                <span class="old_price">82,000 تومان</span>
                                                <span class="current_price">78,000 تومان</span>
                                            </div>
                                            <div class="product_cart_button">
                                                <a href="cart.html" title="افزودن به سبد"><i class="fa fa-shopping-bag"></i></a>
                                            </div>

                                        </div>
                                    </figure>
                                    <figure class="single_product">
                                        <div class="product_thumb">
                                            <a class="primary_img" href="product-details.html"><img src="assets/img/product/product11.jpg" alt=""></a>
                                            <a class="secondary_img" href="product-details.html"><img src="assets/img/product/product12.jpg" alt=""></a>
                                        </div>
                                        <div class="product_content">
                                            <h4 class="product_name"><a href="product-details.html">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ</a></h4>
                                            <div class="product_rating">
                                                <ul>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                </ul>
                                            </div>
                                            <div class="price_box">
                                                <span class="old_price">72,000 تومان</span>
                                                <span class="current_price">68,000 تومان</span>
                                            </div>
                                            <div class="product_cart_button">
                                                <a href="cart.html" title="افزودن به سبد"><i class="fa fa-shopping-bag"></i></a>
                                            </div>

                                        </div>
                                    </figure>
                                </div>
                                <div class="product_items">
                                    <figure class="single_product">
                                        <div class="product_thumb">
                                            <a class="primary_img" href="product-details.html"><img src="assets/img/product/product1.jpg" alt=""></a>
                                            <a class="secondary_img" href="product-details.html"><img src="assets/img/product/product2.jpg" alt=""></a>
                                        </div>
                                        <div class="product_content">
                                            <h4 class="product_name"><a href="product-details.html">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت</a></h4>
                                            <div class="product_rating">
                                                <ul>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                </ul>
                                            </div>
                                            <div class="price_box">
                                                <span class="old_price">86,000 تومان</span>
                                                <span class="current_price">79,000 تومان</span>
                                            </div>
                                            <div class="product_cart_button">
                                                <a href="cart.html" title="افزودن به سبد"><i class="fa fa-shopping-bag"></i></a>
                                            </div>

                                        </div>
                                    </figure>
                                    <figure class="single_product">
                                        <div class="product_thumb">
                                            <a class="primary_img" href="product-details.html"><img src="assets/img/product/product3.jpg" alt=""></a>
                                            <a class="secondary_img" href="product-details.html"><img src="assets/img/product/product4.jpg" alt=""></a>
                                        </div>
                                        <div class="product_content">
                                            <h4 class="product_name"><a href="product-details.html">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ</a></h4>
                                            <div class="product_rating">
                                                <ul>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                </ul>
                                            </div>
                                            <div class="price_box">
                                                <span class="old_price">80,000 تومان</span>
                                                <span class="current_price">70,000 تومان</span>
                                            </div>
                                            <div class="product_cart_button">
                                                <a href="cart.html" title="افزودن به سبد"><i class="fa fa-shopping-bag"></i></a>
                                            </div>

                                        </div>
                                    </figure>
                                </div>
                                <div class="product_items">
                                    <figure class="single_product">
                                        <div class="product_thumb">
                                            <a class="primary_img" href="product-details.html"><img src="assets/img/product/product13.jpg" alt=""></a>
                                            <a class="secondary_img" href="product-details.html"><img src="assets/img/product/product14.jpg" alt=""></a>
                                        </div>
                                        <div class="product_content">
                                            <h4 class="product_name"><a href="product-details.html">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت</a></h4>
                                            <div class="product_rating">
                                                <ul>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                </ul>
                                            </div>
                                            <div class="price_box">
                                                <span class="old_price">86,000 تومان</span>
                                                <span class="current_price">79,000 تومان</span>
                                            </div>
                                            <div class="product_cart_button">
                                                <a href="cart.html" title="افزودن به سبد"><i class="fa fa-shopping-bag"></i></a>
                                            </div>

                                        </div>
                                    </figure>
                                    <figure class="single_product">
                                        <div class="product_thumb">
                                            <a class="primary_img" href="product-details.html"><img src="assets/img/product/product17.jpg" alt=""></a>
                                            <a class="secondary_img" href="product-details.html"><img src="assets/img/product/product18.jpg" alt=""></a>
                                        </div>
                                        <div class="product_content">
                                            <h4 class="product_name"><a href="product-details.html">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت</a></h4>
                                            <div class="product_rating">
                                                <ul>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                </ul>
                                            </div>
                                            <div class="price_box">
                                                <span class="old_price">75,000 تومان</span>
                                                <span class="current_price">70,000 تومان</span>
                                            </div>
                                            <div class="product_cart_button">
                                                <a href="cart.html" title="افزودن به سبد"><i class="fa fa-shopping-bag"></i></a>
                                            </div>

                                        </div>
                                    </figure>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="Mobile2" role="tabpanel">
                            <div class="product_carousel small_p_container  small_product_column3 owl-carousel">
                                <div class="product_items">
                                    <figure class="single_product">
                                        <div class="product_thumb">
                                            <a class="primary_img" href="product-details.html"><img src="assets/img/product/product13.jpg" alt=""></a>
                                            <a class="secondary_img" href="product-details.html"><img src="assets/img/product/product14.jpg" alt=""></a>
                                        </div>
                                        <div class="product_content">
                                            <h4 class="product_name"><a href="product-details.html">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت</a></h4>
                                            <div class="product_rating">
                                                <ul>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                </ul>
                                            </div>
                                            <div class="price_box">
                                                <span class="old_price">86,000 تومان</span>
                                                <span class="current_price">79,000 تومان</span>
                                            </div>
                                            <div class="product_cart_button">
                                                <a href="cart.html" title="افزودن به سبد"><i class="fa fa-shopping-bag"></i></a>
                                            </div>

                                        </div>
                                    </figure>
                                    <figure class="single_product">
                                        <div class="product_thumb">
                                            <a class="primary_img" href="product-details.html"><img src="assets/img/product/product17.jpg" alt=""></a>
                                            <a class="secondary_img" href="product-details.html"><img src="assets/img/product/product18.jpg" alt=""></a>
                                        </div>
                                        <div class="product_content">
                                            <h4 class="product_name"><a href="product-details.html">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت</a></h4>
                                            <div class="product_rating">
                                                <ul>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                </ul>
                                            </div>
                                            <div class="price_box">
                                                <span class="old_price">75,000 تومان</span>
                                                <span class="current_price">70,000 تومان</span>
                                            </div>
                                            <div class="product_cart_button">
                                                <a href="cart.html" title="افزودن به سبد"><i class="fa fa-shopping-bag"></i></a>
                                            </div>

                                        </div>
                                    </figure>
                                </div>
                                <div class="product_items">
                                    <figure class="single_product">
                                        <div class="product_thumb">
                                            <a class="primary_img" href="product-details.html"><img src="assets/img/product/product1.jpg" alt=""></a>
                                            <a class="secondary_img" href="product-details.html"><img src="assets/img/product/product2.jpg" alt=""></a>
                                        </div>
                                        <div class="product_content">
                                            <h4 class="product_name"><a href="product-details.html">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت</a></h4>
                                            <div class="product_rating">
                                                <ul>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                </ul>
                                            </div>
                                            <div class="price_box">
                                                <span class="old_price">86,000 تومان</span>
                                                <span class="current_price">79,000 تومان</span>
                                            </div>
                                            <div class="product_cart_button">
                                                <a href="cart.html" title="افزودن به سبد"><i class="fa fa-shopping-bag"></i></a>
                                            </div>

                                        </div>
                                    </figure>
                                    <figure class="single_product">
                                        <div class="product_thumb">
                                            <a class="primary_img" href="product-details.html"><img src="assets/img/product/product3.jpg" alt=""></a>
                                            <a class="secondary_img" href="product-details.html"><img src="assets/img/product/product4.jpg" alt=""></a>
                                        </div>
                                        <div class="product_content">
                                            <h4 class="product_name"><a href="product-details.html">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ</a></h4>
                                            <div class="product_rating">
                                                <ul>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                </ul>
                                            </div>
                                            <div class="price_box">
                                                <span class="old_price">80,000 تومان</span>
                                                <span class="current_price">70,000 تومان</span>
                                            </div>
                                            <div class="product_cart_button">
                                                <a href="cart.html" title="افزودن به سبد"><i class="fa fa-shopping-bag"></i></a>
                                            </div>

                                        </div>
                                    </figure>
                                </div>

                                <div class="product_items">
                                    <figure class="single_product">
                                        <div class="product_thumb">
                                            <a class="primary_img" href="product-details.html"><img src="assets/img/product/product9.jpg" alt=""></a>
                                            <a class="secondary_img" href="product-details.html"><img src="assets/img/product/product10.jpg" alt=""></a>
                                        </div>
                                        <div class="product_content">
                                            <h4 class="product_name"><a href="product-details.html">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت</a></h4>
                                            <div class="product_rating">
                                                <ul>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                </ul>
                                            </div>
                                            <div class="price_box">
                                                <span class="old_price">82,000 تومان</span>
                                                <span class="current_price">78,000 تومان</span>
                                            </div>
                                            <div class="product_cart_button">
                                                <a href="cart.html" title="افزودن به سبد"><i class="fa fa-shopping-bag"></i></a>
                                            </div>

                                        </div>
                                    </figure>
                                    <figure class="single_product">
                                        <div class="product_thumb">
                                            <a class="primary_img" href="product-details.html"><img src="assets/img/product/product11.jpg" alt=""></a>
                                            <a class="secondary_img" href="product-details.html"><img src="assets/img/product/product12.jpg" alt=""></a>
                                        </div>
                                        <div class="product_content">
                                            <h4 class="product_name"><a href="product-details.html">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ</a></h4>
                                            <div class="product_rating">
                                                <ul>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                </ul>
                                            </div>
                                            <div class="price_box">
                                                <span class="old_price">72,000 تومان</span>
                                                <span class="current_price">68,000 تومان</span>
                                            </div>
                                            <div class="product_cart_button">
                                                <a href="cart.html" title="افزودن به سبد"><i class="fa fa-shopping-bag"></i></a>
                                            </div>

                                        </div>
                                    </figure>
                                </div>
                                <div class="product_items">
                                    <figure class="single_product">
                                        <div class="product_thumb">
                                            <a class="primary_img" href="product-details.html"><img src="assets/img/product/product5.jpg" alt=""></a>
                                            <a class="secondary_img" href="product-details.html"><img src="assets/img/product/product6.jpg" alt=""></a>
                                        </div>
                                        <div class="product_content">
                                            <h4 class="product_name"><a href="product-details.html">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با</a></h4>
                                            <div class="product_rating">
                                                <ul>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                </ul>
                                            </div>
                                            <div class="price_box">
                                                <span class="old_price">76,000 تومان</span>
                                                <span class="current_price">72,000 تومان</span>
                                            </div>
                                            <div class="product_cart_button">
                                                <a href="cart.html" title="افزودن به سبد"><i class="fa fa-shopping-bag"></i></a>
                                            </div>

                                        </div>
                                    </figure>
                                    <figure class="single_product">
                                        <div class="product_thumb">
                                            <a class="primary_img" href="product-details.html"><img src="assets/img/product/product7.jpg" alt=""></a>
                                            <a class="secondary_img" href="product-details.html"><img src="assets/img/product/product8.jpg" alt=""></a>
                                        </div>
                                        <div class="product_content">
                                            <h4 class="product_name"><a href="product-details.html">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت</a></h4>
                                            <div class="product_rating">
                                                <ul>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                </ul>
                                            </div>
                                            <div class="price_box">
                                                <span class="old_price">65,000 تومان</span>
                                                <span class="current_price">60,000 تومان</span>
                                            </div>
                                            <div class="product_cart_button">
                                                <a href="cart.html" title="افزودن به سبد"><i class="fa fa-shopping-bag"></i></a>
                                            </div>

                                        </div>
                                    </figure>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!--product area end-->

            <!--product area start-->
            <div class="product_area">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="product_header">
                                <div class="section_title">
                                    <h2>محصولات جدید</h2>

                                </div>
                                <div class="product_tab_btn">
                                    <ul class="nav" role="tablist">
                                        <li>
                                            <a class="active" data-toggle="tab" href="#Computer3" role="tab" aria-controls="Computer3" aria-selected="true">
                                                کامپیوتر
                                            </a>
                                        </li>
                                        <li>
                                            <a data-toggle="tab" href="#Networking2" role="tab" aria-controls="Networking2" aria-selected="false">
                                                ابزار شبکه
                                            </a>
                                        </li>
                                        <li>
                                            <a data-toggle="tab" href="#Networking3" role="tab" aria-controls="Networking3" aria-selected="false">
                                                کامپیوتر و شبکه
                                            </a>
                                        </li>
                                        <li>
                                            <a data-toggle="tab" href="#Audio2" role="tab" aria-controls="Audio2" aria-selected="false">
                                                صوتی و تصویری
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="Computer3" role="tabpanel">
                            <div class="product_carousel product_style product_column5 owl-carousel">
                                <article class="single_product">
                                    <figure>

                                        <div class="product_thumb">
                                            <a class="primary_img" href="product-details.html"><img src="assets/img/product/product5.jpg" alt=""></a>
                                            <a class="secondary_img" href="product-details.html"><img src="assets/img/product/product6.jpg" alt=""></a>
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
                                <article class="single_product">
                                    <figure>

                                        <div class="product_thumb">
                                            <a class="primary_img" href="product-details.html"><img src="assets/img/product/product7.jpg" alt=""></a>
                                            <a class="secondary_img" href="product-details.html"><img src="assets/img/product/product8.jpg" alt=""></a>
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
                                                <h4 class="product_name"><a href="product-details.html">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ</a></h4>
                                                <div class="price_box">
                                                    <span class="old_price">76,000 تومان</span>
                                                    <span class="current_price">75,000 تومان</span>
                                                </div>
                                            </div>
                                            <div class="add_to_cart">
                                                <a href="cart.html" title="افزودن به سبد">افزودن به سبد</a>
                                            </div>

                                        </div>
                                    </figure>
                                </article>
                                <article class="single_product">
                                    <figure>

                                        <div class="product_thumb">
                                            <a class="primary_img" href="product-details.html"><img src="assets/img/product/product1.jpg" alt=""></a>
                                            <a class="secondary_img" href="product-details.html"><img src="assets/img/product/product2.jpg" alt=""></a>
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
                                                <h4 class="product_name"><a href="product-details.html">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با</a></h4>
                                                <div class="price_box">
                                                    <span class="old_price">86,000 تومان</span>
                                                    <span class="current_price">79,000 تومان</span>
                                                </div>
                                            </div>
                                            <div class="add_to_cart">
                                                <a href="cart.html" title="افزودن به سبد">افزودن به سبد</a>
                                            </div>

                                        </div>
                                    </figure>
                                </article>
                                <article class="single_product">
                                    <figure>

                                        <div class="product_thumb">
                                            <a class="primary_img" href="product-details.html"><img src="assets/img/product/product3.jpg" alt=""></a>
                                            <a class="secondary_img" href="product-details.html"><img src="assets/img/product/product4.jpg" alt=""></a>
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
                                                <h4 class="product_name"><a href="product-details.html">ساعت هوشمند سامسونگ مدل Gear Watch</a></h4>
                                                <div class="price_box">
                                                    <span class="old_price">82,000 تومان</span>
                                                    <span class="current_price">75,000 تومان</span>
                                                </div>
                                            </div>
                                            <div class="add_to_cart">
                                                <a href="cart.html" title="افزودن به سبد">افزودن به سبد</a>
                                            </div>

                                        </div>
                                    </figure>
                                </article>
                                <article class="single_product">
                                    <figure>

                                        <div class="product_thumb">
                                            <a class="primary_img" href="product-details.html"><img src="assets/img/product/product9.jpg" alt=""></a>
                                            <a class="secondary_img" href="product-details.html"><img src="assets/img/product/product10.jpg" alt=""></a>
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
                                                <h4 class="product_name"><a href="product-details.html">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از</a></h4>
                                                <div class="price_box">
                                                    <span class="old_price">72,000 تومان</span>
                                                    <span class="current_price">70,000 تومان</span>
                                                </div>
                                            </div>
                                            <div class="add_to_cart">
                                                <a href="cart.html" title="افزودن به سبد">افزودن به سبد</a>
                                            </div>

                                        </div>
                                    </figure>
                                </article>
                                <article class="single_product">
                                    <figure>

                                        <div class="product_thumb">
                                            <a class="primary_img" href="product-details.html"><img src="assets/img/product/product11.jpg" alt=""></a>
                                            <a class="secondary_img" href="product-details.html"><img src="assets/img/product/product12.jpg" alt=""></a>
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
                                                <h4 class="product_name"><a href="product-details.html">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از</a></h4>
                                                <div class="price_box">
                                                    <span class="old_price">65,000 تومان</span>
                                                    <span class="current_price">60,000 تومان</span>
                                                </div>
                                            </div>
                                            <div class="add_to_cart">
                                                <a href="cart.html" title="افزودن به سبد">افزودن به سبد</a>
                                            </div>

                                        </div>
                                    </figure>
                                </article>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="Networking2" role="tabpanel">
                            <div class="product_carousel product_style product_column5 owl-carousel">
                                <article class="single_product">
                                    <figure>

                                        <div class="product_thumb">
                                            <a class="primary_img" href="product-details.html"><img src="assets/img/product/product5.jpg" alt=""></a>
                                            <a class="secondary_img" href="product-details.html"><img src="assets/img/product/product6.jpg" alt=""></a>
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
                                <article class="single_product">
                                    <figure>

                                        <div class="product_thumb">
                                            <a class="primary_img" href="product-details.html"><img src="assets/img/product/product7.jpg" alt=""></a>
                                            <a class="secondary_img" href="product-details.html"><img src="assets/img/product/product8.jpg" alt=""></a>
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
                                                <h4 class="product_name"><a href="product-details.html">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ</a></h4>
                                                <div class="price_box">
                                                    <span class="old_price">76,000 تومان</span>
                                                    <span class="current_price">75,000 تومان</span>
                                                </div>
                                            </div>
                                            <div class="add_to_cart">
                                                <a href="cart.html" title="افزودن به سبد">افزودن به سبد</a>
                                            </div>

                                        </div>
                                    </figure>
                                </article>
                                <article class="single_product">
                                    <figure>

                                        <div class="product_thumb">
                                            <a class="primary_img" href="product-details.html"><img src="assets/img/product/product9.jpg" alt=""></a>
                                            <a class="secondary_img" href="product-details.html"><img src="assets/img/product/product10.jpg" alt=""></a>
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
                                                <h4 class="product_name"><a href="product-details.html">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از</a></h4>
                                                <div class="price_box">
                                                    <span class="old_price">72,000 تومان</span>
                                                    <span class="current_price">70,000 تومان</span>
                                                </div>
                                            </div>
                                            <div class="add_to_cart">
                                                <a href="cart.html" title="افزودن به سبد">افزودن به سبد</a>
                                            </div>

                                        </div>
                                    </figure>
                                </article>
                                <article class="single_product">
                                    <figure>

                                        <div class="product_thumb">
                                            <a class="primary_img" href="product-details.html"><img src="assets/img/product/product11.jpg" alt=""></a>
                                            <a class="secondary_img" href="product-details.html"><img src="assets/img/product/product12.jpg" alt=""></a>
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
                                                <h4 class="product_name"><a href="product-details.html">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از</a></h4>
                                                <div class="price_box">
                                                    <span class="old_price">65,000 تومان</span>
                                                    <span class="current_price">60,000 تومان</span>
                                                </div>
                                            </div>
                                            <div class="add_to_cart">
                                                <a href="cart.html" title="افزودن به سبد">افزودن به سبد</a>
                                            </div>

                                        </div>
                                    </figure>
                                </article>
                                <article class="single_product">
                                    <figure>

                                        <div class="product_thumb">
                                            <a class="primary_img" href="product-details.html"><img src="assets/img/product/product1.jpg" alt=""></a>
                                            <a class="secondary_img" href="product-details.html"><img src="assets/img/product/product2.jpg" alt=""></a>
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
                                                <h4 class="product_name"><a href="product-details.html">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با</a></h4>
                                                <div class="price_box">
                                                    <span class="old_price">86,000 تومان</span>
                                                    <span class="current_price">79,000 تومان</span>
                                                </div>
                                            </div>
                                            <div class="add_to_cart">
                                                <a href="cart.html" title="افزودن به سبد">افزودن به سبد</a>
                                            </div>

                                        </div>
                                    </figure>
                                </article>
                                <article class="single_product">
                                    <figure>

                                        <div class="product_thumb">
                                            <a class="primary_img" href="product-details.html"><img src="assets/img/product/product3.jpg" alt=""></a>
                                            <a class="secondary_img" href="product-details.html"><img src="assets/img/product/product4.jpg" alt=""></a>
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
                                                <h4 class="product_name"><a href="product-details.html">ساعت هوشمند سامسونگ مدل Gear Watch</a></h4>
                                                <div class="price_box">
                                                    <span class="old_price">82,000 تومان</span>
                                                    <span class="current_price">75,000 تومان</span>
                                                </div>
                                            </div>
                                            <div class="add_to_cart">
                                                <a href="cart.html" title="افزودن به سبد">افزودن به سبد</a>
                                            </div>

                                        </div>
                                    </figure>
                                </article>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="Networking3" role="tabpanel">
                            <div class="product_carousel product_style product_column5 owl-carousel">
                                <article class="single_product">
                                    <figure>

                                        <div class="product_thumb">
                                            <a class="primary_img" href="product-details.html"><img src="assets/img/product/product7.jpg" alt=""></a>
                                            <a class="secondary_img" href="product-details.html"><img src="assets/img/product/product8.jpg" alt=""></a>
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
                                                <h4 class="product_name"><a href="product-details.html">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ</a></h4>
                                                <div class="price_box">
                                                    <span class="old_price">76,000 تومان</span>
                                                    <span class="current_price">75,000 تومان</span>
                                                </div>
                                            </div>
                                            <div class="add_to_cart">
                                                <a href="cart.html" title="افزودن به سبد">افزودن به سبد</a>
                                            </div>

                                        </div>
                                    </figure>
                                </article>
                                <article class="single_product">
                                    <figure>
                                        <div class="product_thumb">
                                            <a class="primary_img" href="product-details.html"><img src="assets/img/product/product1.jpg" alt=""></a>
                                            <a class="secondary_img" href="product-details.html"><img src="assets/img/product/product2.jpg" alt=""></a>
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
                                                <h4 class="product_name"><a href="product-details.html">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با</a></h4>
                                                <div class="price_box">
                                                    <span class="old_price">86,000 تومان</span>
                                                    <span class="current_price">79,000 تومان</span>
                                                </div>
                                            </div>
                                            <div class="add_to_cart">
                                                <a href="cart.html" title="افزودن به سبد">افزودن به سبد</a>
                                            </div>

                                        </div>
                                    </figure>
                                </article>
                                <article class="single_product">
                                    <figure>

                                        <div class="product_thumb">
                                            <a class="primary_img" href="product-details.html"><img src="assets/img/product/product3.jpg" alt=""></a>
                                            <a class="secondary_img" href="product-details.html"><img src="assets/img/product/product4.jpg" alt=""></a>
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
                                                <h4 class="product_name"><a href="product-details.html">ساعت هوشمند سامسونگ مدل Gear Watch</a></h4>
                                                <div class="price_box">
                                                    <span class="old_price">82,000 تومان</span>
                                                    <span class="current_price">75,000 تومان</span>
                                                </div>
                                            </div>
                                            <div class="add_to_cart">
                                                <a href="cart.html" title="افزودن به سبد">افزودن به سبد</a>
                                            </div>

                                        </div>
                                    </figure>
                                </article>
                                <article class="single_product">
                                    <figure>

                                        <div class="product_thumb">
                                            <a class="primary_img" href="product-details.html"><img src="assets/img/product/product5.jpg" alt=""></a>
                                            <a class="secondary_img" href="product-details.html"><img src="assets/img/product/product6.jpg" alt=""></a>
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
                                <article class="single_product">
                                    <figure>

                                        <div class="product_thumb">
                                            <a class="primary_img" href="product-details.html"><img src="assets/img/product/product9.jpg" alt=""></a>
                                            <a class="secondary_img" href="product-details.html"><img src="assets/img/product/product10.jpg" alt=""></a>
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
                                                <h4 class="product_name"><a href="product-details.html">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از</a></h4>
                                                <div class="price_box">
                                                    <span class="old_price">72,000 تومان</span>
                                                    <span class="current_price">70,000 تومان</span>
                                                </div>
                                            </div>
                                            <div class="add_to_cart">
                                                <a href="cart.html" title="افزودن به سبد">افزودن به سبد</a>
                                            </div>

                                        </div>
                                    </figure>
                                </article>
                                <article class="single_product">
                                    <figure>

                                        <div class="product_thumb">
                                            <a class="primary_img" href="product-details.html"><img src="assets/img/product/product11.jpg" alt=""></a>
                                            <a class="secondary_img" href="product-details.html"><img src="assets/img/product/product12.jpg" alt=""></a>
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
                                                <h4 class="product_name"><a href="product-details.html">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از</a></h4>
                                                <div class="price_box">
                                                    <span class="old_price">65,000 تومان</span>
                                                    <span class="current_price">60,000 تومان</span>
                                                </div>
                                            </div>
                                            <div class="add_to_cart">
                                                <a href="cart.html" title="افزودن به سبد">افزودن به سبد</a>
                                            </div>

                                        </div>
                                    </figure>
                                </article>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="Audio2" role="tabpanel">
                            <div class="product_carousel product_style product_column5 owl-carousel">
                                <article class="single_product">
                                    <figure>

                                        <div class="product_thumb">
                                            <a class="primary_img" href="product-details.html"><img src="assets/img/product/product9.jpg" alt=""></a>
                                            <a class="secondary_img" href="product-details.html"><img src="assets/img/product/product10.jpg" alt=""></a>
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
                                                <h4 class="product_name"><a href="product-details.html">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از</a></h4>
                                                <div class="price_box">
                                                    <span class="old_price">72,000 تومان</span>
                                                    <span class="current_price">70,000 تومان</span>
                                                </div>
                                            </div>
                                            <div class="add_to_cart">
                                                <a href="cart.html" title="افزودن به سبد">افزودن به سبد</a>
                                            </div>

                                        </div>
                                    </figure>
                                </article>
                                <article class="single_product">
                                    <figure>

                                        <div class="product_thumb">
                                            <a class="primary_img" href="product-details.html"><img src="assets/img/product/product1.jpg" alt=""></a>
                                            <a class="secondary_img" href="product-details.html"><img src="assets/img/product/product2.jpg" alt=""></a>
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
                                                <h4 class="product_name"><a href="product-details.html">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با</a></h4>
                                                <div class="price_box">
                                                    <span class="old_price">86,000 تومان</span>
                                                    <span class="current_price">79,000 تومان</span>
                                                </div>
                                            </div>
                                            <div class="add_to_cart">
                                                <a href="cart.html" title="افزودن به سبد">افزودن به سبد</a>
                                            </div>

                                        </div>
                                    </figure>
                                </article>
                                <article class="single_product">
                                    <figure>

                                        <div class="product_thumb">
                                            <a class="primary_img" href="product-details.html"><img src="assets/img/product/product5.jpg" alt=""></a>
                                            <a class="secondary_img" href="product-details.html"><img src="assets/img/product/product6.jpg" alt=""></a>
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
                                <article class="single_product">
                                    <figure>

                                        <div class="product_thumb">
                                            <a class="primary_img" href="product-details.html"><img src="assets/img/product/product7.jpg" alt=""></a>
                                            <a class="secondary_img" href="product-details.html"><img src="assets/img/product/product8.jpg" alt=""></a>
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
                                                <h4 class="product_name"><a href="product-details.html">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ</a></h4>
                                                <div class="price_box">
                                                    <span class="old_price">76,000 تومان</span>
                                                    <span class="current_price">75,000 تومان</span>
                                                </div>
                                            </div>
                                            <div class="add_to_cart">
                                                <a href="cart.html" title="افزودن به سبد">افزودن به سبد</a>
                                            </div>

                                        </div>
                                    </figure>
                                </article>
                                <article class="single_product">
                                    <figure>
                                        <div class="product_thumb">
                                            <a class="primary_img" href="product-details.html"><img src="assets/img/product/product3.jpg" alt=""></a>
                                            <a class="secondary_img" href="product-details.html"><img src="assets/img/product/product4.jpg" alt=""></a>
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
                                                <h4 class="product_name"><a href="product-details.html">ساعت هوشمند سامسونگ مدل Gear Watch</a></h4>
                                                <div class="price_box">
                                                    <span class="old_price">82,000 تومان</span>
                                                    <span class="current_price">75,000 تومان</span>
                                                </div>
                                            </div>
                                            <div class="add_to_cart">
                                                <a href="cart.html" title="افزودن به سبد">افزودن به سبد</a>
                                            </div>

                                        </div>
                                    </figure>
                                </article>
                                <article class="single_product">
                                    <figure>

                                        <div class="product_thumb">
                                            <a class="primary_img" href="product-details.html"><img src="assets/img/product/product11.jpg" alt=""></a>
                                            <a class="secondary_img" href="product-details.html"><img src="assets/img/product/product12.jpg" alt=""></a>
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
                                                <h4 class="product_name"><a href="product-details.html">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از</a></h4>
                                                <div class="price_box">
                                                    <span class="old_price">65,000 تومان</span>
                                                    <span class="current_price">60,000 تومان</span>
                                                </div>
                                            </div>
                                            <div class="add_to_cart">
                                                <a href="cart.html" title="افزودن به سبد">افزودن به سبد</a>
                                            </div>

                                        </div>
                                    </figure>
                                </article>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!--product area end-->

            <!--banner area start-->
            <div class="banner_area banner_style2 mb-55">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3 col-md-3">
                            <figure class="single_banner">
                                <div class="banner_thumb">
                                    <a href="shop.html"><img src="assets/img/bg/banner6.jpg" alt=""></a>
                                </div>
                            </figure>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <figure class="single_banner">
                                <div class="banner_thumb">
                                    <a href="shop.html"><img src="assets/img/bg/banner7.jpg" alt=""></a>
                                </div>
                            </figure>
                        </div>
                        <div class="col-lg-3 col-md-3">
                            <figure class="single_banner">
                                <div class="banner_thumb">
                                    <a href="shop.html"><img src="assets/img/bg/banner8.jpg" alt=""></a>
                                </div>
                            </figure>
                        </div>
                    </div>
                </div>
            </div>
            <!--banner area end-->

            <!--product area start-->
            <div class="small_product_area small_product_style2">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="small_product_list">
                                <div class="section_title">
                                    <h2>کامپیوتر و شبکه</h2>
                                </div>
                                <div class="product_carousel small_p_container  product_column1 owl-carousel">
                                    <div class="product_items">
                                        <figure class="single_product">
                                            <div class="product_thumb">
                                                <a class="primary_img" href="product-details.html"><img src="assets/img/product/product9.jpg" alt=""></a>
                                                <a class="secondary_img" href="product-details.html"><img src="assets/img/product/product10.jpg" alt=""></a>
                                            </div>
                                            <div class="product_content">
                                                <h4 class="product_name"><a href="product-details.html">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت</a></h4>
                                                <div class="product_rating">
                                                    <ul>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    </ul>
                                                </div>
                                                <div class="price_box">
                                                    <span class="old_price">82,000 تومان</span>
                                                    <span class="current_price">78,000 تومان</span>
                                                </div>
                                                <div class="product_cart_button">
                                                    <a href="cart.html" title="افزودن به سبد"><i class="fa fa-shopping-bag"></i></a>
                                                </div>

                                            </div>
                                        </figure>
                                        <figure class="single_product">
                                            <div class="product_thumb">
                                                <a class="primary_img" href="product-details.html"><img src="assets/img/product/product11.jpg" alt=""></a>
                                                <a class="secondary_img" href="product-details.html"><img src="assets/img/product/product12.jpg" alt=""></a>
                                            </div>
                                            <div class="product_content">
                                                <h4 class="product_name"><a href="product-details.html">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ</a></h4>
                                                <div class="product_rating">
                                                    <ul>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    </ul>
                                                </div>
                                                <div class="price_box">
                                                    <span class="old_price">72,000 تومان</span>
                                                    <span class="current_price">68,000 تومان</span>
                                                </div>
                                                <div class="product_cart_button">
                                                    <a href="cart.html" title="افزودن به سبد"><i class="fa fa-shopping-bag"></i></a>
                                                </div>

                                            </div>
                                        </figure>
                                        <figure class="single_product">
                                            <div class="product_thumb">
                                                <a class="primary_img" href="product-details.html"><img src="assets/img/product/product13.jpg" alt=""></a>
                                                <a class="secondary_img" href="product-details.html"><img src="assets/img/product/product14.jpg" alt=""></a>
                                            </div>
                                            <div class="product_content">
                                                <h4 class="product_name"><a href="product-details.html">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت</a></h4>
                                                <div class="product_rating">
                                                    <ul>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    </ul>
                                                </div>
                                                <div class="price_box">
                                                    <span class="old_price">86,000 تومان</span>
                                                    <span class="current_price">79,000 تومان</span>
                                                </div>
                                                <div class="product_cart_button">
                                                    <a href="cart.html" title="افزودن به سبد"><i class="fa fa-shopping-bag"></i></a>
                                                </div>

                                            </div>
                                        </figure>
                                    </div>
                                    <div class="product_items">
                                        <figure class="single_product">
                                            <div class="product_thumb">
                                                <a class="primary_img" href="product-details.html"><img src="assets/img/product/product9.jpg" alt=""></a>
                                                <a class="secondary_img" href="product-details.html"><img src="assets/img/product/product10.jpg" alt=""></a>
                                            </div>
                                            <div class="product_content">
                                                <h4 class="product_name"><a href="product-details.html">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت</a></h4>
                                                <div class="product_rating">
                                                    <ul>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    </ul>
                                                </div>
                                                <div class="price_box">
                                                    <span class="old_price">82,000 تومان</span>
                                                    <span class="current_price">78,000 تومان</span>
                                                </div>
                                                <div class="product_cart_button">
                                                    <a href="cart.html" title="افزودن به سبد"><i class="fa fa-shopping-bag"></i></a>
                                                </div>

                                            </div>
                                        </figure>
                                        <figure class="single_product">
                                            <div class="product_thumb">
                                                <a class="primary_img" href="product-details.html"><img src="assets/img/product/product11.jpg" alt=""></a>
                                                <a class="secondary_img" href="product-details.html"><img src="assets/img/product/product12.jpg" alt=""></a>
                                            </div>
                                            <div class="product_content">
                                                <h4 class="product_name"><a href="product-details.html">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ</a></h4>
                                                <div class="product_rating">
                                                    <ul>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    </ul>
                                                </div>
                                                <div class="price_box">
                                                    <span class="old_price">72,000 تومان</span>
                                                    <span class="current_price">68,000 تومان</span>
                                                </div>
                                                <div class="product_cart_button">
                                                    <a href="cart.html" title="افزودن به سبد"><i class="fa fa-shopping-bag"></i></a>
                                                </div>

                                            </div>
                                        </figure>
                                        <figure class="single_product">
                                            <div class="product_thumb">
                                                <a class="primary_img" href="product-details.html"><img src="assets/img/product/product13.jpg" alt=""></a>
                                                <a class="secondary_img" href="product-details.html"><img src="assets/img/product/product14.jpg" alt=""></a>
                                            </div>
                                            <div class="product_content">
                                                <h4 class="product_name"><a href="product-details.html">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت</a></h4>
                                                <div class="product_rating">
                                                    <ul>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    </ul>
                                                </div>
                                                <div class="price_box">
                                                    <span class="old_price">86,000 تومان</span>
                                                    <span class="current_price">79,000 تومان</span>
                                                </div>
                                                <div class="product_cart_button">
                                                    <a href="cart.html" title="افزودن به سبد"><i class="fa fa-shopping-bag"></i></a>
                                                </div>

                                            </div>
                                        </figure>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="small_product_list">
                                <div class="section_title">
                                    <h2>بازی و کنسول</h2>
                                </div>
                                <div class="product_carousel small_p_container  product_column1 owl-carousel">
                                    <div class="product_items">
                                        <figure class="single_product">
                                            <div class="product_thumb">
                                                <a class="primary_img" href="product-details.html"><img src="assets/img/product/product1.jpg" alt=""></a>
                                                <a class="secondary_img" href="product-details.html"><img src="assets/img/product/product2.jpg" alt=""></a>
                                            </div>
                                            <div class="product_content">
                                                <h4 class="product_name"><a href="product-details.html">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با</a></h4>
                                                <div class="product_rating">
                                                    <ul>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    </ul>
                                                </div>
                                                <div class="price_box">
                                                    <span class="old_price">82,000 تومان</span>
                                                    <span class="current_price">78,000 تومان</span>
                                                </div>
                                                <div class="product_cart_button">
                                                    <a href="cart.html" title="افزودن به سبد"><i class="fa fa-shopping-bag"></i></a>
                                                </div>

                                            </div>
                                        </figure>
                                        <figure class="single_product">
                                            <div class="product_thumb">
                                                <a class="primary_img" href="product-details.html"><img src="assets/img/product/product3.jpg" alt=""></a>
                                                <a class="secondary_img" href="product-details.html"><img src="assets/img/product/product4.jpg" alt=""></a>
                                            </div>
                                            <div class="product_content">
                                                <h4 class="product_name"><a href="product-details.html">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ</a></h4>
                                                <div class="product_rating">
                                                    <ul>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    </ul>
                                                </div>
                                                <div class="price_box">
                                                    <span class="old_price">72,000 تومان</span>
                                                    <span class="current_price">68,000 تومان</span>
                                                </div>
                                                <div class="product_cart_button">
                                                    <a href="cart.html" title="افزودن به سبد"><i class="fa fa-shopping-bag"></i></a>
                                                </div>
                                            </div>
                                        </figure>
                                        <figure class="single_product">
                                            <div class="product_thumb">
                                                <a class="primary_img" href="product-details.html"><img src="assets/img/product/product5.jpg" alt=""></a>
                                                <a class="secondary_img" href="product-details.html"><img src="assets/img/product/product6.jpg" alt=""></a>
                                            </div>
                                            <div class="product_content">
                                                <h4 class="product_name"><a href="product-details.html">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت</a></h4>
                                                <div class="product_rating">
                                                    <ul>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    </ul>
                                                </div>
                                                <div class="price_box">
                                                    <span class="old_price">86,000 تومان</span>
                                                    <span class="current_price">79,000 تومان</span>
                                                </div>
                                                <div class="product_cart_button">
                                                    <a href="cart.html" title="افزودن به سبد"><i class="fa fa-shopping-bag"></i></a>
                                                </div>

                                            </div>
                                        </figure>
                                    </div>
                                    <div class="product_items">
                                        <figure class="single_product">
                                            <div class="product_thumb">
                                                <a class="primary_img" href="product-details.html"><img src="assets/img/product/product9.jpg" alt=""></a>
                                                <a class="secondary_img" href="product-details.html"><img src="assets/img/product/product10.jpg" alt=""></a>
                                            </div>
                                            <div class="product_content">
                                                <h4 class="product_name"><a href="product-details.html">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت</a></h4>
                                                <div class="product_rating">
                                                    <ul>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    </ul>
                                                </div>
                                                <div class="price_box">
                                                    <span class="old_price">82,000 تومان</span>
                                                    <span class="current_price">78,000 تومان</span>
                                                </div>
                                                <div class="product_cart_button">
                                                    <a href="cart.html" title="افزودن به سبد"><i class="fa fa-shopping-bag"></i></a>
                                                </div>

                                            </div>
                                        </figure>
                                        <figure class="single_product">
                                            <div class="product_thumb">
                                                <a class="primary_img" href="product-details.html"><img src="assets/img/product/product11.jpg" alt=""></a>
                                                <a class="secondary_img" href="product-details.html"><img src="assets/img/product/product12.jpg" alt=""></a>
                                            </div>
                                            <div class="product_content">
                                                <h4 class="product_name"><a href="product-details.html">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ</a></h4>
                                                <div class="product_rating">
                                                    <ul>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    </ul>
                                                </div>
                                                <div class="price_box">
                                                    <span class="old_price">72,000 تومان</span>
                                                    <span class="current_price">68,000 تومان</span>
                                                </div>
                                                <div class="product_cart_button">
                                                    <a href="cart.html" title="افزودن به سبد"><i class="fa fa-shopping-bag"></i></a>
                                                </div>

                                            </div>
                                        </figure>
                                        <figure class="single_product">
                                            <div class="product_thumb">
                                                <a class="primary_img" href="product-details.html"><img src="assets/img/product/product13.jpg" alt=""></a>
                                                <a class="secondary_img" href="product-details.html"><img src="assets/img/product/product14.jpg" alt=""></a>
                                            </div>
                                            <div class="product_content">
                                                <h4 class="product_name"><a href="product-details.html">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت</a></h4>
                                                <div class="product_rating">
                                                    <ul>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    </ul>
                                                </div>
                                                <div class="price_box">
                                                    <span class="old_price">86,000 تومان</span>
                                                    <span class="current_price">79,000 تومان</span>
                                                </div>
                                                <div class="product_cart_button">
                                                    <a href="cart.html" title="افزودن به سبد"><i class="fa fa-shopping-bag"></i></a>
                                                </div>

                                            </div>
                                        </figure>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="small_product_list">
                                <div class="section_title">
                                    <h2>موبایل و تبلت</h2>
                                </div>
                                <div class="product_carousel small_p_container  product_column1 owl-carousel">
                                    <div class="product_items">
                                        <figure class="single_product">
                                            <div class="product_thumb">
                                                <a class="primary_img" href="product-details.html"><img src="assets/img/product/product13.jpg" alt=""></a>
                                                <a class="secondary_img" href="product-details.html"><img src="assets/img/product/product14.jpg" alt=""></a>
                                            </div>
                                            <div class="product_content">
                                                <h4 class="product_name"><a href="product-details.html">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت</a></h4>
                                                <div class="product_rating">
                                                    <ul>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    </ul>
                                                </div>
                                                <div class="price_box">
                                                    <span class="old_price">82,000 تومان</span>
                                                    <span class="current_price">78,000 تومان</span>
                                                </div>
                                                <div class="product_cart_button">
                                                    <a href="cart.html" title="افزودن به سبد"><i class="fa fa-shopping-bag"></i></a>
                                                </div>

                                            </div>
                                        </figure>
                                        <figure class="single_product">
                                            <div class="product_thumb">
                                                <a class="primary_img" href="product-details.html"><img src="assets/img/product/product15.jpg" alt=""></a>
                                                <a class="secondary_img" href="product-details.html"><img src="assets/img/product/product16.jpg" alt=""></a>
                                            </div>
                                            <div class="product_content">
                                                <h4 class="product_name"><a href="product-details.html">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ</a></h4>
                                                <div class="product_rating">
                                                    <ul>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    </ul>
                                                </div>
                                                <div class="price_box">
                                                    <span class="old_price">72,000 تومان</span>
                                                    <span class="current_price">68,000 تومان</span>
                                                </div>
                                                <div class="product_cart_button">
                                                    <a href="cart.html" title="افزودن به سبد"><i class="fa fa-shopping-bag"></i></a>
                                                </div>

                                            </div>
                                        </figure>
                                        <figure class="single_product">
                                            <div class="product_thumb">
                                                <a class="primary_img" href="product-details.html"><img src="assets/img/product/product17.jpg" alt=""></a>
                                                <a class="secondary_img" href="product-details.html"><img src="assets/img/product/product18.jpg" alt=""></a>
                                            </div>
                                            <div class="product_content">
                                                <h4 class="product_name"><a href="product-details.html">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت</a></h4>
                                                <div class="product_rating">
                                                    <ul>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    </ul>
                                                </div>
                                                <div class="price_box">
                                                    <span class="old_price">86,000 تومان</span>
                                                    <span class="current_price">79,000 تومان</span>
                                                </div>
                                                <div class="product_cart_button">
                                                    <a href="cart.html" title="افزودن به سبد"><i class="fa fa-shopping-bag"></i></a>
                                                </div>

                                            </div>
                                        </figure>
                                    </div>
                                    <div class="product_items">
                                        <figure class="single_product">
                                            <div class="product_thumb">
                                                <a class="primary_img" href="product-details.html"><img src="assets/img/product/product19.jpg" alt=""></a>
                                                <a class="secondary_img" href="product-details.html"><img src="assets/img/product/product20.jpg" alt=""></a>
                                            </div>
                                            <div class="product_content">
                                                <h4 class="product_name"><a href="product-details.html">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت</a></h4>
                                                <div class="product_rating">
                                                    <ul>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    </ul>
                                                </div>
                                                <div class="price_box">
                                                    <span class="old_price">82,000 تومان</span>
                                                    <span class="current_price">78,000 تومان</span>
                                                </div>
                                                <div class="product_cart_button">
                                                    <a href="cart.html" title="افزودن به سبد"><i class="fa fa-shopping-bag"></i></a>
                                                </div>

                                            </div>
                                        </figure>
                                        <figure class="single_product">
                                            <div class="product_thumb">
                                                <a class="primary_img" href="product-details.html"><img src="assets/img/product/product1.jpg" alt=""></a>
                                                <a class="secondary_img" href="product-details.html"><img src="assets/img/product/product2.jpg" alt=""></a>
                                            </div>
                                            <div class="product_content">
                                                <h4 class="product_name"><a href="product-details.html">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ</a></h4>
                                                <div class="product_rating">
                                                    <ul>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    </ul>
                                                </div>
                                                <div class="price_box">
                                                    <span class="old_price">72,000 تومان</span>
                                                    <span class="current_price">68,000 تومان</span>
                                                </div>
                                                <div class="product_cart_button">
                                                    <a href="cart.html" title="افزودن به سبد"><i class="fa fa-shopping-bag"></i></a>
                                                </div>

                                            </div>
                                        </figure>
                                        <figure class="single_product">
                                            <div class="product_thumb">
                                                <a class="primary_img" href="product-details.html"><img src="assets/img/product/product3.jpg" alt=""></a>
                                                <a class="secondary_img" href="product-details.html"><img src="assets/img/product/product4.jpg" alt=""></a>
                                            </div>
                                            <div class="product_content">
                                                <h4 class="product_name"><a href="product-details.html">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت</a></h4>
                                                <div class="product_rating">
                                                    <ul>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                    </ul>
                                                </div>
                                                <div class="price_box">
                                                    <span class="old_price">86,000 تومان</span>
                                                    <span class="current_price">79,000 تومان</span>
                                                </div>
                                                <div class="product_cart_button">
                                                    <a href="cart.html" title="افزودن به سبد"><i class="fa fa-shopping-bag"></i></a>
                                                </div>

                                            </div>
                                        </figure>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--product area end-->
        </div>
        <!--home section bg area end-->

        <!-- modal area start-->
        <div class="modal fade" id="modal_box" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <div class="modal_body">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-5 col-md-5 col-sm-12">
                                    <div class="modal_tab">
                                        <div class="tab-content product-details-large">
                                            <div class="tab-pane fade show active" id="tab1" role="tabpanel">
                                                <div class="modal_tab_img">
                                                    <a href="#"><img src="assets/img/product/productbig2.jpg" alt=""></a>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="tab2" role="tabpanel">
                                                <div class="modal_tab_img">
                                                    <a href="#"><img src="assets/img/product/productbig3.jpg" alt=""></a>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="tab3" role="tabpanel">
                                                <div class="modal_tab_img">
                                                    <a href="#"><img src="assets/img/product/productbig4.jpg" alt=""></a>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="tab4" role="tabpanel">
                                                <div class="modal_tab_img">
                                                    <a href="#"><img src="assets/img/product/productbig5.jpg" alt=""></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal_tab_button">
                                            <ul class="nav product_navactive owl-carousel" role="tablist">
                                                <li>
                                                    <a class="nav-link active" data-toggle="tab" href="#tab1" role="tab" aria-controls="tab1" aria-selected="false"><img src="assets/img/product/product1.jpg" alt=""></a>
                                                </li>
                                                <li>
                                                    <a class="nav-link" data-toggle="tab" href="#tab2" role="tab" aria-controls="tab2" aria-selected="false"><img src="assets/img/product/product6.jpg" alt=""></a>
                                                </li>
                                                <li>
                                                    <a class="nav-link button_three" data-toggle="tab" href="#tab3" role="tab" aria-controls="tab3" aria-selected="false"><img src="assets/img/product/product9.jpg" alt=""></a>
                                                </li>
                                                <li>
                                                    <a class="nav-link" data-toggle="tab" href="#tab4" role="tab" aria-controls="tab4" aria-selected="false"><img src="assets/img/product/product14.jpg" alt=""></a>
                                                </li>

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-7 col-md-7 col-sm-12">
                                    <div class="modal_right">
                                        <div class="modal_title mb-10">
                                            <h2>گوشی هوشمند سامسونگ A50</h2>
                                        </div>
                                        <div class="modal_price mb-10">
                                            <span class="new_price">64,000 تومان</span>
                                            <span class="old_price">78,000 تومان</span>
                                        </div>
                                        <div class="modal_description mb-15">
                                            <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای </p>
                                        </div>
                                        <div class="variants_selects">
                                            <div class="variants_size">
                                                <h2>اندازه</h2>
                                                <select class="select_option">
                                                    <option selected value="1">کوچک</option>
                                                    <option value="1">متوسط</option>
                                                    <option value="1">بزرگ</option>
                                                    <option value="1">XL</option>
                                                    <option value="1">XXL</option>
                                                </select>
                                            </div>
                                            <div class="variants_color">
                                                <h2>رنگ</h2>
                                                <select class="select_option">
                                                    <option selected value="1">بنفش</option>
                                                    <option value="1">اطلسی</option>
                                                    <option value="1">مشکی</option>
                                                    <option value="1">صورتی</option>
                                                    <option value="1">نارنجی</option>
                                                </select>
                                            </div>
                                            <div class="modal_add_to_cart">
                                                <form action="#">
                                                    <input min="1" max="100" step="2" value="1" type="number">
                                                    <button type="submit">افزودن به سبد</button>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="modal_social">
                                            <h2>اشتراک گذاری این محصول</h2>
                                            <ul>
                                                <li class="facebook"><a href="#"><i class="fa fa-facebook"></i></a></li>
                                                <li class="twitter"><a href="#"><i class="fa fa-twitter"></i></a></li>
                                                <li class="pinterest"><a href="#"><i class="fa fa-pinterest"></i></a></li>
                                                <li class="google-plus"><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                                <li class="linkedin"><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- modal area end-->


    </div>

@endsection
