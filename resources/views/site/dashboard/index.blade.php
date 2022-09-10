<div>
    <!--breadcrumbs area start-->
    <div class="breadcrumbs_area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb_content">
                        <ul>
                            <li><a href="{{ route('site.index') }}">خانه</a></li>
                            <li>داشبورد</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--breadcrumbs area end-->

    <!-- my account start  -->
    <div class="account_page_bg">
        <div class="container">
            <section class="main_content_area">
                <div class="account_dashboard">
                    <div class="row">
                        <div class="col-sm-12 col-md-3 col-lg-3">
                            <!-- Nav tabs -->
                            <div class="dashboard_tab_button">
                                <ul role="tablist" class="nav flex-column dashboard-list">
                                    <li><a href="#dashboard" data-toggle="tab" class="nav-link active">داشبورد</a></li>
                                    <li> <a href="#orders" data-toggle="tab" class="nav-link">سفارشات</a></li>
                                    <li><a href="#downloads" data-toggle="tab" class="nav-link">دریافت ها</a></li>
                                    <li><a href="#address" data-toggle="tab" class="nav-link">آدرس ها</a></li>
                                    <li><a href="#account-details" data-toggle="tab" class="nav-link">جزئیات حساب</a></li>
                                    <li><a wire:click="logout" href="#" class="nav-link">خروج</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-9 col-lg-9">
                            <!-- Tab panes -->
                            <div class="tab-content dashboard_content">
                                <div class="tab-pane fade show active" id="dashboard">
                                    <h3>داشبورد </h3>
                                    <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با <a href="#">سفارشات اخیر</a>لورم ایپسوم متن <a href="#">لورم ایپسوم متن ساختگی با تولید</a> لورم <a href="#">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم</a></p>
                                </div>
                                <div class="tab-pane fade" id="orders">
                                    <h3>سفارشات</h3>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>ترتیب</th>
                                                    <th>تاریخ</th>
                                                    <th>وضعیت</th>
                                                    <th>جمع</th>
                                                    <th>اقدامات</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>10 تیر 1397</td>
                                                    <td><span class="success">اتمام یافته</span></td>
                                                    <td>50,000 تومان برای یک محصول </td>
                                                    <td><a href="cart.html" class="view">مشاهده</a></td>
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td>10 تیر 1397</td>
                                                    <td>در حال پردازش</td>
                                                    <td>180,000 تومان برای یک محصول </td>
                                                    <td><a href="cart.html" class="view">مشاهده</a></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="downloads">
                                    <h3>دریافت ها</h3>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>محصول</th>
                                                    <th>دریافت ها</th>
                                                    <th>انقضا</th>
                                                    <th>دریافت</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم</td>
                                                    <td>10 تیر 1397</td>
                                                    <td><span class="danger">منقضی شده</span></td>
                                                    <td><a href="#" class="view">برای دریافت فایل خود کلیک کنید</a></td>
                                                </tr>
                                                <tr>
                                                    <td>لورم ایپسوم متن ساختگی با تولید سادگی</td>
                                                    <td>11 مرداد 1397</td>
                                                    <td>هرگز</td>
                                                    <td><a href="#" class="view">برای دریافت فایل خود کلیک کنید</a></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane" id="address">
                                    <p>آدرس های زیر به صورت پیش فرض در صفحه سفارش شما استفاده خواهند شد.</p>
                                    <h4 class="billing-address">آدرس صورت حساب</h4>
                                    <a href="#" class="view">ویرایش</a>
                                    <p><strong>جان اسنو</strong></p>
                                    <address>
                                        ایران<br>
                                        آذربایجان شرقی<br>
                                        تبریز<br>
                                        چهارراه آبرسان، فلکه دانشگاه، برج بلور، طبقه 456، واحد 89
                                    </address>
                                </div>
                                <div class="tab-pane fade" id="account-details">
                                    <h3>جزئیات حساب </h3>
                                    <div class="login">
                                        <div class="login_form_container">
                                            <div class="account_login_form">
                                                <form action="#">
                                                    <p>حساب کاربری دارید؟ <a href="#">وارد شوید!</a></p>
                                                    <div class="input-radio">
                                                        <span class="custom-radio"><label><input type="radio" value="1" name="id_gender"> آقا</label></span>
                                                        <span class="custom-radio"><label><input type="radio" value="1" name="id_gender"> خانم</label></span>
                                                    </div>
                                                    <br>
                                                    <label>نام</label>
                                                    <input type="text" name="first-name">
                                                    <label>نام خانوادگی</label>
                                                    <input type="text" name="last-name">
                                                    <label>ایمیل</label>
                                                    <input type="text" name="email-name">
                                                    <label>رمز عبور</label>
                                                    <input type="password" name="user-password">
                                                    <label>تاریخ تولد</label>
                                                    <input type="text" placeholder="YYYY/MM/DD" value="" name="birthday">
                                                    <span class="example">
                                                      (مثال: 1397/05/26)
                                                    </span>
                                                    <br>
                                                    <span class="custom_checkbox">
														<label><input type="checkbox" value="1" name="optin"> دریافت پیشنهادات ویژه</label>
													</span>
                                                    <br>
                                                    <span class="custom_checkbox">
														<label><input type="checkbox" value="1" name="newsletter"> عضویت در خبرنامه ما<br><em>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و</em></label>
													</span>
                                                    <div class="save_button primary_btn default_button">
                                                        <button type="submit">ذخیره</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <!-- my account end   -->
</div>
