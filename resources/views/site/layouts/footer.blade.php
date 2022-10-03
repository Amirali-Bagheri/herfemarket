<footer class="footer_widgets">
    <!--newsletter area start-->
{{--    <div class="newsletter_area">
        <div class="container">
            <div class="newsletter_inner">
                <div class="row align-items-center">
                    <div class="col-lg-3 col-md-5">
                        <div class="newsletter_sing_up">
                            <h3>عضویت در خبرنامه</h3>
                            <p>با عضویت از <span>30% تخفیف</span> بهره مند شوید</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-7">
                        <div class="subscribe_content">
                            <p><strong>به 226,000+ مشترک ما</strong> بپیوندید و از تخفیف های ویژه هفتگی مخصوص مشترکین خبرنامه بهره مند شوید.</p>
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-12">
                        <div class="subscribe_form">
                            <form id="mc-form" class="mc-form footer-newsletter">
                                <input id="mc-email" type="email" autocomplete="off" placeholder="... آدرس ایمیل شما" dir="ltr">
                                <button id="mc-submit">اشتراک</button>
                            </form>
                            <!-- mailchimp-alerts Start -->
                            <div class="mailchimp-alerts text-centre">
                                <div class="mailchimp-submitting"></div><!-- mailchimp-submitting end -->
                                <div class="mailchimp-success"></div><!-- mailchimp-success end -->
                                <div class="mailchimp-error"></div><!-- mailchimp-error end -->
                            </div><!-- mailchimp-alerts end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>--}}
    <!--newsletter area end-->
    <div class="footer_top">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-sm-12">
                    <div class="widgets_container contact_us">
                        <h3>دریافت اپلیکیشن</h3>
{{--                        <div class="aff_content">--}}
{{--                            <p>برنامه <strong>آنتومی</strong> هم اکنون در گوگل پلی و اپل استور آماده دریافت است.</p>--}}
{{--                        </div>--}}
                        <div class="app_img text-center">
                            <figure class="app_img">
                                <a href="#"><img src="/img/icon/icon-appstore.png" alt=""></a>
                            </figure>
                            <figure class="app_img">
                                <a href="#"><img src="/img/icon/icon-googleplay.png" alt=""></a>
                            </figure>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="widgets_container widget_menu">
                        <h3>دسته بندی ها</h3>
                        <div class="footer_menu">
                            <ul>
                                @foreach(\Modules\Category\Entities\Category::latest()->take(5)->get() as  $category)
                                    <li><a href="{{ route('site.products.category',$category->slug) }}">
                                            {{$category->title}}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="widgets_container widget_menu">
                        <h3>حساب کاربری</h3>
                        <div class="footer_menu">
                            <ul>
                                <li><a href="/register">ثبت نام</a></li>
                                <li><a href="/register/business">ثبت نام کسب و کار</a></li>
                                <li><a href="/login">ورود به حساب</a></li>
                                <li><a href="/dashboard">داشبورد</a></li>
                                <li><a href="/cart">سبد خرید</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-12">
                    <div class="widgets_container">
                        <h3>اطلاعات تماس</h3>
                        <div class="footer_contact">
                            <div class="footer_contact_inner">
                                <div class="contact_icone">
                                    <img src="/img/icon/icon-phone.png" alt="">
                                </div>
                                <div class="contact_text">
                                    <p>تلفن تماس 24 ساعته: <br> <strong class="ltr-text">09129286632</strong></p>
                                </div>
                            </div>
                            <p>
                                تهران - میدان دانشگاه - خیابان زیتون - کوچه میخک
                            </p>
                        </div>

                        <div class="footer_social">
                            <ul>
                                <li><a class="facebook" href="#"><i class="fab fa-facebook"></i></a></li>
                                <li><a class="twitter" href="#"><i class="fab fa-twitter"></i></a></li>
                                <li><a class="instagram" href="#"><i class="fab fa-instagram"></i></a></li>
                                <li><a class="linkedin" href="#"><i class="fab fa-linkedin"></i></a></li>
                                <li><a class="rss" href="#"><i class="fa fa-rss"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer_bottom">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-6 col-md-6">
                    <div class="copyright_area text-center justify-content-center">
                        <p>
                            تمامی حقوق برای حرفه مارکت محفوظ است
                        </p>
                    </div>
                </div>
{{--                <div class="col-lg-6 col-md-6">--}}
{{--                    <div class="footer_payment text-right">--}}
{{--                        <img src="/img/icon/payment.png" alt="">--}}
{{--                    </div>--}}
{{--                </div>--}}
            </div>
        </div>
    </div>
</footer>
