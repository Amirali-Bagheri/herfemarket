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
                                        خدمات
                                    </h3>
                                    <a href="{{route('dashboard.services.create')}}">
                                        <button class="float-right btn m-0">ثبت خدمت جدید</button>
                                    </a>

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
                                                @forelse ($invoices as $invoice)
                                                    <tr>
                                                        <td>{{$product->id}}</td>
                                                        <td>
                                                            {{$product->title}}
                                                        </td>
                                                        <td>
                                                            {{$product->main_price}}
                                                        </td>
                                                        <td>
                                                            {{$product->categories()->first()->title ?? '-'}}
                                                        </td>
                                                        <td>
                                                            {{ verta($product->updated_at)->formatDifference() }}
                                                        </td>
                                                        <td>
                                                            <a  class="pr-1 pl-1" href="{{route('dashboard.products.update',$product->id)}}">
                                                                <i class="far fa-edit"></i>
                                                            </a>
                                                            <a class="pr-1 pl-1" href="javascript:void(0)" wire:click="deleteProduct('{{$product->id}}')">
                                                                <i class="far fa-trash"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="6">
                                                            محصولی برای نمایش وجود ندارد
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
