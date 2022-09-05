<div class="card">
    <div class="card-header">
        <h3 class="card-title">قیمت گذاری ها ({{$business->products()->count()}})</h3>
    </div>
    <form action="{{ route('admin.businesses.deleteAllPrices') }}" method="post">
        @csrf
        <div class="card-tools" style="margin: 10px">
            {{--                        <form action="{{route('admin.categories.search')}}" id="search_form" method="get" role="search"--}}
            {{--                              class="form-inline typeahead error-form float-right">--}}

            {{--                            <div class="input-group md-form form-sm form-2 pl-0">--}}
            {{--                                <input type="search" name="s" class="form-control mr-sm-2 search-input rtl"--}}
            {{--                                       placeholder="جستجو ..." style="direction: rtl;">--}}


            {{--                                <a href="javascript:void(0)" onclick="document.getElementById('search_form').submit();">--}}
            {{--                                    <i class="fas fa-search" style="color: black" aria-hidden="true"></i>--}}
            {{--                                </a>--}}
            {{--                            </div>--}}


            {{--                        </form>--}}


            <div class="form-inline mr-4 float-left">
                <button class="btn btn-danger dropdown-toggle" type="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">عملیات
                </button>
                <div class="modal fade" id="delete-selected-prices">
                    <div class="modal-dialog">
                        <div class="modal-content bg-danger">
                            <div class="modal-header">
                                <h4 class="modal-title">تایید حذف موارد انتخاب شده</h4>
                                <button type="button" class="close" data-dismiss="modal"
                                        aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>موارد انتخاب شده قابل بازگردانی نیستند!</p>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-outline-light"
                                        data-dismiss="modal">
                                    خروج
                                </button>
                                <button type="submit" class="btn btn-outline-light">تایید</button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>

                <div class="dropdown-menu dropdown-danger text-center">
                    <a class="dropdown-item"
                       href="javascript:void(0)" data-toggle="modal"
                       data-target="#delete-selected-prices"
                    >
                        حذف موارد انتخاب شده
                    </a>


                    {{--                                <a class="dropdown-item" href="{{ route('admin.categories.export') }}">--}}
                    {{--                                    خروجی اکسل</a>--}}
                </div>


            </div>

        </div>
        <div class="card-body table-responsive">
            <table class="table table-hover">
                <tr>
                    <th>
                        <input type="checkbox" class="form-check-input" id="selectAll"
                            {{--                                               @click="selectAll"--}}
                        >
                        <label class="form-check-label" for="selectAll"></label>
                    </th>

                    {{--                                <th>ردیف</th>--}}
                    <th>نام محصول</th>
                    <th>قیمت پیشنهادی</th>
                    <th>@sortablelink('created_at', 'زمان ارسال')</th>
                    <th>@sortablelink('updated_at', 'به روز رسانی')</th>
                    <th>گزینه ها</th>
                </tr>
                @forelse($business->prices as $price)
                    <tr>
                        <td>
                            <input type="checkbox" class="form-check-input check"
                                   id="check-{{$price->id}}"
                                   value="{{$price->id}}"
                                   name="delete_prices[]"
                                   data-id="{{$price->id}}">
                            <label class="form-check-label" for="check-{{$price->id}}"></label>

                        </td>
                        {{--                                    <td>{{ (collect($business->prices)->currentpage()-1) * collect($business->prices)->perpage() + $loop->index + 1 }}</td>--}}

                        <td>

                            {{--                                        <a style="margin: 5px;"--}}
                            {{--                                           href="{{route('admin.businesses.update',$business->id)}}">--}}
                            {{--                                            <i class="fa-regular fa-pen-to-square"></i>--}}

                            {{--                                        </a>--}}
                            <a style="margin: 5px;"
                               href="{{route('admin.businesses.delete_price',$price->id)}}">
                                <i class="far fa-trash-alt"></i>
                            </a>
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="5" align="center">کسب و کار قیمتی ثبت نکرده است</td>
                    </tr>
                @endforelse


            </table>
        </div>
    </form>

</div>


<div class="card">
    <div class="card-header">
        <h3 class="card-title">گردش حساب</h3>
    </div>
    <div class="card-body table-responsive">
        <table class="table table-hover">
            <tr>
                <th>ردیف</th>
                <th>شرح</th>
                <th>واریز</th>
                <th>برداشت</th>
                <th>@sortablelink('updated_at','زمان')</th>
            </tr>
            @forelse($transactions as $transaction)
                <tr>

                    <th scope="row">
                        {{ ($transactions ->currentpage()-1) * $transactions ->perpage() + $loop->index + 1 }}
                    </th>
                    <td>
                        @if (isset($transaction->meta['description']))
                            {{$transaction->meta['description']}}
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        @if ($transaction->type == 'deposit')
                            {{ number_format($transaction->amount) }}
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        @if ($transaction->type == 'withdraw')
                            {{ number_format($transaction->amount) }}
                        @else
                            -
                        @endif
                    </td>

                    <td>{{verta($transaction->updated_at)->formatDifference()}}</td>

                </tr>

            @empty
                <tr>
                    <td colspan="5" align="center">برای این کسب و کار تراکنشی ثبت نشده است</td>
                </tr>
            @endforelse


        </table>

    </div>
    <div class="text-center justify-content-center float-right">
        <div class="pagination-bx clearfix">
            <ul class="pagination">
                {{$transactions->appends(Request::all())->links('site.layouts.pagination')}}
            </ul>
        </div>
    </div>
</div>
