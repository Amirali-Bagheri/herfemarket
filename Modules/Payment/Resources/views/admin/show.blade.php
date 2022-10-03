<div>
    <div class="intro-y col-span-12 flex flex-wrap sm:flex-no-wrap items-center mt-2 ltr">
        <div class="dropdown">
            <button class="dropdown-toggle btn px-2 box text-gray-700">
                <span class="w-5 h-5 flex items-center justify-center"> <i class="w-4 h-4 fas fa-plus"></i>
                </span>
            </button>
            <div class="dropdown-menu w-40">
                <div class="dropdown-menu__content box p-2">
                    <a href="javascript:void(0)"
                       class="flex items-center block p-2 transition duration-300 ease-in-out bg-white hover:bg-gray-200 rounded-md">
                        <i class="w-4 h-4 ml-2 fal fa-print"></i> چاپ </a>

                    <a href="javascript:void(0)" wire:click='export'
                       class="flex items-center block p-2 transition duration-300 ease-in-out bg-white hover:bg-gray-200 rounded-md">
                        <i class="w-4 h-4 ml-2 fal fa-file-excel"></i> خروجی پی دی اف </a>
                </div>
            </div>
        </div>
    </div>

    <div class="intro-y box overflow-hidden mt-5">
        <div class="border-b border-gray-200 text-center sm:text-left">
            <div class="px-5 py-10 sm:px-20 sm:py-20">
                <div class="mt-2"> شماره سفارش <span class="">{{$payment->order_id}}</span></div>
                <div class="mt-3">{{ $payment->created_at_human }}</div>
            </div>
            <div class="flex flex-col lg:flex-row px-5 sm:px-20 pt-10 pb-10 sm:pb-20">
                <div class="text-right">
                    <div class="text-base text-gray-600">اطلاعات فروشنده</div>
                    <div class="text-lg font-medium text-theme-1 mt-2">نام شخص حقیقی/حقوقی:&nbsp;&nbsp;
                        شاگو
                    </div>
                    <div class="mt-1">شماره ملی/اقتصادی:&nbsp;&nbsp;</div>
                    <div class="mt-1">
                        نشانی پستی:&nbsp;&nbsp
                        تهران، خیابان فردوسی ، خیابان منوچهری ، پاساژ درفشان(خوانساری) ، طبقه سوم ، واحد 4.14
                    </div>
                    <div class="mt-1">
                        کد پستی:&nbsp;&nbsp; 1145843375
                    </div>
                    <div class="mt-1">
                        تلفن:&nbsp;&nbsp; 02191690522
                    </div
                    >
                    {{--                    <div class="mt-1">--}}
                    {{--                        تلفن همراه:&nbsp;&nbsp; 09129286632--}}
                    {{--                    </div>--}}
                </div>
                <div class="lg:text-right mt-10 lg:mt-0 lg:mr-auto">
                    <div class="text-base text-gray-600">
                        اطلاعات خریدار
                    </div>
                    <div class="text-lg font-medium text-theme-1 mt-2">
                        نام شخص حقیقی/حقوقی:&nbsp;&nbsp; {{ $user->full_name }}
                        @isset($user->business)
                            / {{ $user->business->name }}
                        @endisset
                    </div>
                    <div class="mt-1">شماره ملی/اقتصادی:&nbsp;&nbsp; {{$user->national_code ?? '-'}}</div>
                    <div class="mt-1">
                        نشانی پستی:&nbsp;&nbsp;
                        @isset($user->business)
                            {{ $user->business->address }}
                        @endisset
                    </div>
                    <div class="mt-1">
                        کد پستی:&nbsp;&nbsp;
                        @isset($user->business)
                            {{ $user->business->postal_code ?? '-' }}
                        @endisset
                    </div>
                    <div class="mt-1">
                        تلفن:&nbsp;&nbsp;
                        @isset($user->business)
                            {{ $user->business->phone }}
                        @endisset
                    </div
                    >
                    <div class="mt-1">
                        تلفن همراه:&nbsp;&nbsp; {{$user->mobile}}
                    </div>
                </div>
            </div>
        </div>
        <div class="px-5 sm:px-16 py-10 sm:py-20">
            <div class="overflow-x-auto">
                <table class="table">
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
                        <tr>
                            <td>1</td>
                            <td>
                                @if ($payment->paymentable_type == 'Modules\Business\Entities\Business')
                                    شارژ کیف پول
                                @endif
                            </td>
                            <td>1</td>
                            <td>{{ number_format(price_t2r($payment->price)) }} ریال</td>
                            <td>{{ number_format(price_t2r($payment->price)) }} ریال</td>
                            <td>9%</td>
                            <td>{{ number_format(price_t2r($payment->price) + ((9 * price_t2r($payment->price)) / 100)) }}
                                ریال
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
