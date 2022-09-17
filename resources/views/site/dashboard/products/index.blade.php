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
                                        محصولات
                                    </h3>
                                    <a href="{{route('dashboard.products.create')}}">
                                        <button class="float-right btn m-0">ثبت محصول</button>
                                    </a>

                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>شناسه</th>
                                                    <th>عنوان</th>
                                                    <th>قیمت</th>
                                                    <th>زمان</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($products as $product)


                                                    <tr>|
                                                        <td>{{$product->id}}</td>
                                                        <td>
                                                            {{$product->title}}
                                                        </td>
                                                        <td>
                                                            {{$product->price}}
                                                        </td>
                                                        <td>
                                                            {{ verta($product->updated_at)->formatDifference() }}
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="4">
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
