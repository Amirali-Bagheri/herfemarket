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

                            <div class="tab-content dashboard_content">
                                <div class="tab-pane fade show active">
                                    <h3 class="float-left">
                                        سفارشات
                                    </h3>
                    
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>شناسه</th>
                                                    <th>مبلغ</th>
                                                    <th>وضعیت</th>
                                                    <th>زمان</th>
                                                    <th>گزینه ها</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($orders as $order)
                                                    <tr>
                                                        <td>{{$order->invoice_number}}</td>
                                                        <td>
                                                            {{ number_format($order->total) }}
                                                        </td>
                                                        <td>
                                                            {{$order->status_title}}
                                                        </td>

                                                        <td>
                                                            {{ verta($order->updated_at)->formatDifference() }}
                                                        </td>
                                                        <td>
                                                            <a  class="pr-1 pl-1" href="{{route('dashboard.orders.show',$order->invoice_number)}}">
                                                                <i class="far fa-eye"></i>
                                                            </a>

                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="6">
                                                            سفارشی برای نمایش وجود ندارد
                                                        </td>
                                                    </tr>

                                                @endforelse
                                            </tbody>
                                        </table>
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
