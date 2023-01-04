<div>
    <!-- my account start  -->
    <div class="account_page_bg">
        <div class="container">
            <section class="main_content_area">
                <div class="account_dashboard">
                    <div class="row">
                        <div class="col-sm-12 col-md-3 col-lg-3">
                            @include('site.dashboard.layouts.sidebar')
                        </div>
                        <div class="col-sm-12 col-md-9 col-lg-9">

                            <div class="checkout_form_right">
                                <h3>
                                    مشخصات سفارش
                                </h3>
                                <div class="order_table table-responsive">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th>ردیف</th>
                                                <th>شرح خدمات</th>
                                                <th>تعداد</th>
                                                <th>فی</th>
                                                <th>مبلغ</th>
                                                <th>مالیات بر ارزش افزوده</th>
                                                <th>جمع کل</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($invoice->lines as $invoice_line)
                                            <tr>
                                                <td> {{ $loop->index + 1}}</td>
                                                <td>
                                                    {{ $invoice_line->description ?? '-' }}
                                                </td>
                                                <td class="text-center">1</td>
                                                <td class="text-center">{{ number_format($invoice->total) }} ریال</td>
                                                <td class="text-center">{{ number_format($invoice->total) }} ریال</td>
                                                <td class="text-center">
                                                    {{ number_format(((9 * $invoice->total) / 100)) }} ریال
                                                </td>
                                                <td>{{ number_format($invoice->total + ((9 * $invoice->total) / 100)) }}
                                                    ریال
                                                </td>
                                            </tr>
                                            @empty

                                            @endforelse

                                        </tbody>

                                    </table>
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

