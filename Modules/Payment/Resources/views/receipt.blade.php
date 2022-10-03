<div>
    @include('dashboard.layouts.livewire_loading')
    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-12">

                <div class="card mt-3">
                    <div class="card-header">

                        <span class="float-right">
                             <strong>جزئیات صورتحساب</strong>
                        </span>
                        <span class="float-left">
                             <strong>
                                 <i class="far fa-print"></i>
                             </strong>
                        </span>
                    </div>
                    <div class="card-body">
                        <div class="row mb-5">
                            <div class="mt-2 col-md-4 col-sm-12 col-12">
                                <div class="row align-items-center">
                                    <div class="col-sm-9">
                                        <div class="brand-logo mb-3">
                                            <img class="logo-compact" width="200" src="/uploads/logo-text.png" alt="">
                                        </div>
                                        <div class="mt-3">
                                            شماره صورتحساب:
                                            <strong>
                                                {{$invoice->reference}}
                                            </strong>
                                        </div>
                                        <div class="mt-3">
                                            تاریخ:
                                            <strong>
                                                {{verta($invoice->created_at)->format('d / m / Y - H:i')}}
                                            </strong>
                                        </div>
                                        <div class="mt-3">
                                            وضعیت:
                                            <strong>
                                                {{$invoice->status_name}}
                                            </strong>
                                        </div>
                                        <br>
                                        <small class="text-muted">

                                        </small>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-5 col-xl-4 col-lg-6 col-md-6 col-sm-12">
                                <h6>فروشنده:</h6>
                                <div class="mt-3">
                                    نام شخص حقیقی/حقوقی:
                                    <strong>پلتفرم هوشمند شاگو</strong>
                                </div>
                                <div class="mt-3">
                                    نشانی: تهران - چهارراه منوچهری پاساژ درافشان (خوانساری)
                                </div>
                                <div>
                                    - طبقه سوم - واحد 4.14
                                </div>
                                <div class="mt-3">
                                    ایمیل:
                                    info@yekilink.com
                                </div>
                                {{--                                <div>Phone: +48 444 666 3333</div>--}}
                            </div>
                            <div class="mt-5 col-xl-4 col-lg-6 col-md-6 col-sm-12">
                                <h6>
                                    خریدار:
                                </h6>
                                <div class="mt-3">
                                    نام شخص حقیقی/حقوقی:
                                    <strong>{{$invoice->user->full_name}}</strong>
                                </div>
                                {{--                                <div class="mt-3">--}}
                                {{--                                    نشانی: ---}}
                                {{--                                </div>--}}
                                <div class="mt-3">
                                    ایمیل: {{$invoice->user->email ?? '-'}}
                                </div>
                                <div class="mt-3">
                                    تلفن: {{$invoice->user->mobile}}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-8 col-sm-5">
                                <div class="table-responsive">
                                    <table class="table table-striped justify-content-center text-center">
                                        <thead>
                                            <tr>
                                                <th class="text-center">ردیف</th>
                                                <th class="text-center">شرح</th>
                                                <th class="text-center">فی (تومان)</th>
                                                <th class="text-center">تعداد</th>
                                                <th class="text-center">مبلغ (تومان)</th>
                                                {{--                                        <th class="text-center">مالیات بر ارزش افزوده</th>--}}
                                                {{--                                                <th class="text-center">جمع کل</th>--}}
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($invoice->lines as $line)
                                                @if (!$line->is_discount)
                                                    <tr>
                                                        <td class="text-center">{{$loop->index + 1}}</td>
                                                        <td class="text-center strong">{{ $line->description }}</td>
                                                        <td class="text-center">{{number_format($invoice->invoicable->paymentable->price ?? 0)}}</td>
                                                        <td class="text-center">1</td>
                                                        {{--                                                    <td class="text-center">{{number_format($invoice->invoicable->paymentable->price ?? 0)}}</td>--}}
                                                        {{--                                                    <td class="text-center">{{ $line->tax_percentage * 100 }}%</td>--}}
                                                        <td class="text-center">{{ number_format($line->amount) }}</td>
                                                    </tr>
                                                @endif
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>

                                <div class="col-12 text-center justify-content-center" style="position: absolute; bottom: 0;">
                                    <button wire:click="buy" type="button" class="btn btn-primary">پرداخت<span
                                            class="btn-icon-right"><i
                                                class="fa fa-shopping-cart"></i></span>
                                    </button>
                                    <button wire:click="cancelPayment" type="button" class="btn btn-danger">لغو <span
                                            class="btn-icon-right"><i
                                                class="fa fa-close"></i></span>
                                    </button>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-5 ml-auto">
                                <table class="table table-clear">
                                    <tbody>

                                        {{--                                        <tr>--}}
                                        {{--                                            <td class="left"><strong>جمع کل</strong></td>--}}
                                        {{--                                            <td class="right">--}}
                                        {{--                                                {{ number_format($line->amount) }} تومان--}}
                                        {{--                                            </td>--}}
                                        {{--                                        </tr>--}}
                                        {{--                                        <tr>--}}
                                        {{--                                            <td class="left">--}}
                                        {{--                                                <strong>تخفیف</strong>--}}
                                        {{--                                            </td>--}}
                                        {{--                                            <td class="right">--}}
                                        {{--                                                0 تومان--}}
                                        {{--                                            </td>--}}
                                        {{--                                        </tr>--}}
                                        <tr>
                                            <div class="text-center justify-content-center">
                                                <span class="float-left">
                                                    <strong>تخفیف</strong>
                                                </span>
                                                <span class="float-right">
                                                    {{number_format($discount_final_price ?? 0)}} تومان
                                                </span>
                                                <br>
                                                @if(empty($discount_final_price))
                                                    <div class="input-group mb-3 mt-2" style="display: inline-flex;">
                                                        <label style="font-size: 13px; margin: 10px 0px; padding-left: 19px; ">
                                                            کد تخفیف دارید؟
                                                        </label>
                                                        <input wire:model.defer="discountCode" type="text" class="form-control">

                                                        <div class="input-group-prepend">
                                                            <button wire:click="submitDiscount" class="btn btn-primary"
                                                                    type="button">
                                                                اعمال
                                                            </button>
                                                        </div>
                                                    </div>
                                                @else
                                                    <br>
                                                    <span class="text-center justify-content-center mt-4">
                                                        <div class="alert alert-success fade show">
									<svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2"
                                         fill="none" stroke-linecap="round" stroke-linejoin="round" class="mr-2"><polyline
                                            points="9 11 12 14 22 4"></polyline><path
                                            d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>
									 کد تخفیف اعمال شد

								</div>


                                                    </span>
                                                @endif
                                            </div>
                                        </tr>
                                        {{--                                        <tr>--}}
                                        {{--                                            <td class="left">--}}
                                        {{--                                                <strong>مالیات بر ارزش افزوده</strong>--}}
                                        {{--                                            </td>--}}
                                        {{--                                            <td class="right">{{ number_format($invoice->tax) }} تومان</td>--}}
                                        {{--                                        </tr>--}}
                                        <tr>
                                            <td class="left"><strong>قابل پرداخت</strong></td>
                                            <td class="right">
                                                <strong>
                                                    {{ number_format($invoice->total) }} تومان
                                                </strong>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
        </div>
    </div>
</div>

