<div>
    <!--shopping cart area start -->
    <div class="cart_page_bg">
        <div class="container">
            <div class="shopping_cart_area">
                <form action="#">
                    <div class="row">
                        <div class="col-12">
                            <div class="table_desc">
                                <div class="cart_page table-responsive">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th class="product_remove">ردیف</th>
                                                <th class="product_name">عنوان</th>
                                                <th class="product-price">قیمت</th>
                                                <th class="product_remove">حذف</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($items as $hash => $item)
                                                <tr>
                                                    <td class="product_total">
                                                        {{ $loop->index + 1 }}
                                                    </td>
                                                    <td class="product_name"><a href="#">
                                                        {{ $item->getTitle() }}
                                                        </a></td>
                                                    <td class="product-price">{{number_format($item->getPrice())}} تومان</td>
                                                    <td class="product_remove"><a wire:click="removeCart('{{$hash}}')" href="#"><i class="fa fa-trash-o"></i></a></td>

                                                </tr>

                                            @empty
                                                <tr>
                                                    <td colspan="4">
                                                        محصول یا خدماتی به سبد خرید اضافه نشده است!
                                                    </td>
                                                </tr>

                                            @endforelse

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--coupon code area start-->
                    <div class="coupon_area">
                        <div class="row text-center justify-content-center">
                            <div class="col-lg-6 col-md-6 text-center justify-content-center">
                                <div class="coupon_code text-center justify-content-center">
                                    <h3>مجموع سبد</h3>
                                    <div class="coupon_inner">
                                        <div class="cart_subtotal has-border">
                                            <p>جمع</p>
                                            <p class="cart_amount">{{number_format($cart->getSubtotal())}} تومان</p>
                                        </div>
                                        <div class="checkout_btn">
                                            <a href="{{route('site.checkout')}}">پرداخت</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--coupon code area end-->
                </form>
            </div>
        </div>
    </div>
    <!--shopping cart area end -->
</div>
