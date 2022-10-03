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
                        <div class="column3 col-lg-3">
                            <div class="header_configure_area header_configure_four">
                                <div class="mini_cart_wrapper">
                                    <a href="javascript:void(0)">
                                        <i class="fa fa-shopping-bag"></i>
                                        <span class="cart_price"><span>
                                                {{number_format($cart->getSubtotal())}} تومان
                                            </span> <i
                                                class="ion-ios-arrow-down"></i></span>
                                        <span class="cart_count">
                                            {{$cart->countItems()}}
                                        </span>

                                    </a>
                                    <!--mini cart-->
                                    <div class="mini_cart">
                                        <div class="mini_cart_inner">
                                            @forelse ($items as $hash => $item)
                                                <div class="cart_item">
                                                    <div class="cart_info">
                                                        <a href="#">
                                                            {{ $item->getTitle() }}
                                                        </a>
                                                        <p>تعداد: {{ $item->getQuantity() }} × <span>
                                                            {{number_format($item->getPrice())}} تومان
                                                            </span></p>
                                                    </div>
                                                    <div class="cart_remove">
                                                        <a wire:click="removeCart('{{$hash}}')" href="#"><i
                                                                class="ion-android-close"></i></a>
                                                    </div>
                                                </div>
                                            @empty
                                                <div class="cart_item text-center justify-content-center">
                                                    <p>
                                                        سبد خرید خالی است!
                                                    </p>
                                                </div>

                                            @endforelse

                                        </div>
                                        <div class="mini_cart_table">
                                            <div class="cart_total mt-10">
                                                <span>جمع کل:</span>
                                                <span class="price">
                                                    {{number_format($cart->getSubtotal())}} تومان
                                                </span>
                                            </div>
                                        </div>
                                        <div class="mini_cart_footer">
                                            <div class="cart_button">
                                                <a href="{{route('site.cart')}}">مشاهده سبد</a>
                                            </div>

                                        </div>
                                    </div>
                                    <!--mini cart end-->
                                </div>
                            </div>
                        </div>
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
                                        <li><a href="/products">محصولات</a></li>
                                        <li><a href="/services">خدمات</a></li>
                                        <li><a href="/businesses">کسب و کار ها</a></li>
                                        <li><a href="/dashboard">داشبورد</a></li>
                                        <li><a href="/cart">سبد خرید</a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="header_configure_area">
                                {{--                                <div class="header_wishlist">--}}
                                {{--                                    <a href="wishlist.html"><i class="ion-android-favorite-outline"></i>--}}
                                {{--                                        <span class="wishlist_count">3</span>--}}
                                {{--                                    </a>--}}
                                {{--                                </div>--}}
                                <div class="mini_cart_wrapper">
                                    <a href="javascript:void(0)">
                                        <i class="fa fa-shopping-bag"></i>
                                        <span class="cart_price"><span>
                                                {{number_format($cart->getSubtotal())}} تومان
                                            </span> <i
                                                class="ion-ios-arrow-down"></i></span>
                                        <span class="cart_count">
                                            {{$cart->countItems()}}
                                        </span>

                                    </a>
                                    <!--mini cart-->
                                    <div class="mini_cart">
                                        <div class="mini_cart_inner">
                                            @forelse ($items as $hash => $item)
                                                <div class="cart_item">
                                                    <div class="cart_info">
                                                        <a href="#">
                                                            {{ $item->getTitle() }}
                                                        </a>
                                                        <p>تعداد: {{ $item->getQuantity() }} × <span>
                                                            {{number_format($item->getPrice())}} تومان
                                                            </span></p>
                                                    </div>
                                                    <div class="cart_remove">
                                                        <a wire:click="removeCart('{{$hash}}')" href="#"><i
                                                                class="ion-android-close"></i></a>
                                                    </div>
                                                </div>
                                            @empty
                                                <div class="cart_item text-center justify-content-center">
                                                    <p>
                                                        سبد خرید خالی است!
                                                    </p>
                                                </div>

                                            @endforelse

                                        </div>
                                        <div class="mini_cart_table">
                                            <div class="cart_total mt-10">
                                                <span>جمع کل:</span>
                                                <span class="price">
                                                    {{number_format($cart->getSubtotal())}} تومان
                                                </span>
                                            </div>
                                        </div>
                                        <div class="mini_cart_footer">
                                            <div class="cart_button">
                                                <a href="{{route('site.cart')}}">مشاهده سبد</a>
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
                                                                <a href="{{route('site.products.category',$category->slug)}}">
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
                                        <li><a href="/products">محصولات</a></li>
                                        <li><a href="/services">خدمات</a></li>
                                        <li><a href="/businesses">کسب و کار ها</a></li>
                                        <li><a href="/dashboard">داشبورد</a></li>
                                        <li><a href="/cart">سبد خرید</a></li>
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
