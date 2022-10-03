<div>
{{--    <div class="intro-y col-span-12 flex flex-wrap sm:flex-no-wrap items-center mt-2 ltr">--}}
{{--        <div class="dropdown relative">--}}
{{--            <button class="dropdown-toggle button px-2 box text-gray-700">--}}
{{--                <span class="w-5 h-5 flex items-center justify-center"> <i class="w-4 h-4 fas fa-plus"></i>--}}
{{--                </span>--}}
{{--            </button>--}}
{{--            <div class="dropdown-box mt-10 absolute w-40 top-0 left-0 z-20">--}}
{{--                <div class="dropdown-box__content box p-2">--}}
{{--                    <a href="javascript:void(0)"--}}
{{--                       class="flex items-center block p-2 transition duration-300 ease-in-out bg-white hover:bg-gray-200 rounded-md">--}}
{{--                        <i class="w-4 h-4 ml-2 fal fa-print"></i> چاپ </a>--}}

{{--                    <a href="javascript:void(0)" wire:click='export'--}}
{{--                       class="flex items-center block p-2 transition duration-300 ease-in-out bg-white hover:bg-gray-200 rounded-md">--}}
{{--                        <i class="w-4 h-4 ml-2 fal fa-file-excel"></i> خروجی پی دی اف </a>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

    <div class="intro-y box overflow-hidden mt-5">
        <div class="border-b border-gray-200 text-center sm:text-left">
            <div class="flex flex-col lg:flex-row px-5 sm:px-20 pt-10 pb-10 sm:pb-20">
                <div class="lg:text-right mt-10 lg:mt-0 lg:ml-auto">
                    <div id="logo"><img width="200" src="/uploads/logo.png" alt=""></div>

                </div>
                <div class="lg:text-right mt-10 lg:mt-0 center text-center justify-content-center">
                  <h2 class="text-lg font-medium mt-2">
                      فاکتور فروش کالا و خدمات
                  </h2>
                </div>
                <div class="lg:text-right mt-10 lg:mt-0 lg:mr-auto">

                    <p>شماره فاکتور: {{$invoice->invoice_number}}</p>
                    <br>
                    <p>تاریخ: {{ verta($invoice->created_at)->format('%d %B %Y') }}</p>

                </div>


            </div>

            <div class="grid grid-cols-12 gap-6 mt-5 p-10">

                <div class="intro-y col-span-12 lg:col-span-6">
                    <div class="lg:text-right mt-10 lg:mt-0 lg:ml-auto">
                        <div class="text-base text-gray-600">اطلاعات فروشنده</div>

                        <div class="mt-2 text-right">نام شخص حقیقی/حقوقی:&nbsp;&nbsp;

                            شرکت کارآفرینان ماهان سپهر
                            <span style="font-size:11px;">(سهامی خاص)</span>
                        </div>
                        <div class="mt-2 text-right">شناسه ملی: 14008277177&nbsp;&nbsp;</div>


                        <di class="mt-2 text-right">نشانی پستی:&nbsp;&nbsp;تهران -
                            بلوار ارتش - نبش خیابان ابوذر - مرکز نوآوری بین المللی یاس - پلاک 35
                        </di>
                        <div class="mt-2 text-right">کد پستی:&nbsp;&nbsp; 1955882000</div>
                        <div class="mt-2 text-right">تلفن:&nbsp;&nbsp; 02122470924</div>
                        <div class="mt-2 text-right">تلفن همراه:&nbsp;&nbsp; 09388866996</div>
                    </div>
                </div>
                <div class="intro-y col-span-12 lg:col-span-6">
                    <div class="lg:text-right mt-10 lg:mt-0 lg:mr-auto mr-4">
                        <div class="text-base text-gray-600">
                            اطلاعات خریدار
                        </div>
                        <div class="mt-2 text-right">نام شخص حقیقی/حقوقی:&nbsp;&nbsp;

                            {{ $business->name ?? 'مصرف کننده نهایی' }}
                        </div>
                        <div class="mt-2 text-right">شناسه ملی:

                            @if ($legal_person)
                                {{ $business->company_id  ?? '-'}}
                            @else
                                {{ $user->national_code  ?? '-'}}
                            @endif
                            &nbsp;&nbsp;</div>


                        <di class="mt-2 text-right">نشانی پستی:&nbsp;
                            {{ $business->address  ?? '-'}}
                        </di>
                        <div class="mt-2 text-right">تلفن:&nbsp;&nbsp; {{$business->phone ?? '-'}}</div>
                        <div class="mt-2 text-right">تلفن همراه:&nbsp;&nbsp; {{$user->mobile ?? '-'}}</div>
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
