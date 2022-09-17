<div>
    @include('admin.layouts.livewire_loading')
    <div class="grid grid-cols-12 gap-6">
        <div class="md:col-span-9 col-span-12 2xl:col-span-9">
            <div class="grid grid-cols-12 gap-6">

                <div class="col-span-12 mt-3" wire:ignore>
                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                            <a href="{{ route('admin.routers.index') }}">
                                <div class="report-box zoom-in">
                                    <div class="box p-5">
                                        <div class="flex">
                                            <i class="report-box__icon text-theme-10" data-feather="file-text"></i>
                                        </div>
                                        <div
                                            class="text-3xl font-bold leading-8 mt-6">{{ $trigger_routers_count }}</div>
                                        <div class="text-base text-gray-600 mt-1">سناریو ها</div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                            <a href="{{ route('admin.comments.index') }}">
                                <div class="report-box zoom-in">
                                    <div class="box p-5">
                                        <div class="flex">
                                            <i class="report-box__icon text-theme-11" data-feather="message-circle"></i>
                                        </div>
                                        <div
                                            class="text-3xl font-bold leading-8 mt-6">{{$comments_pending_count}}</div>
                                        <div class="text-base text-gray-600 mt-1">دیدگاه های بررسی نشده</div>
                                    </div>
                                </div>
                            </a>

                        </div>
                        <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                            <a href="{{route('admin.users.index')}}">
                                <div class="report-box zoom-in">
                                    <div class="box p-5">
                                        <div class="flex">
                                            <i class="report-box__icon text-theme-12" data-feather="users"></i>
                                        </div>
                                        <div
                                            class="text-3xl font-bold leading-8 mt-6">{{ $users_count }}</div>
                                        <div class="text-base text-gray-600 mt-1">کاربران</div>
                                    </div>
                                </div>
                            </a>

                        </div>
                        <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                            <div class="report-box zoom-in">
                                <div class="box p-5">
                                    <div class="flex">
                                        <i class="report-box__icon text-theme-9" data-feather="pie-chart"></i>
                                    </div>
                                    <div
                                        class="text-3xl font-bold leading-8 mt-6">
                                        {{cache('daily_visits')}}
                                        <?php try{ ?>

                                        {{Analytics::fetchVisitorsAndPageViews(\Spatie\Analytics\Period::days(0))->count()}}

                                        <?php }catch (Throwable $e) { ?>

                                        -

                                        <?php } ?>

                                    </div>
                                    <div class="text-base text-gray-600 mt-1">بازدید سایت امروز</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-2 text-center justify-content-center" wire:ignore>
                        <button class="btn btn-primary mr-2 mb-2" wire:click.prevent="toolboxAction('octane_reload')">
                            <i data-feather="activity" class="w-4 h-4 ml-2"></i> Octane Reload
                        </button>
                        <button class="btn btn-success mr-2 mb-2" wire:click.prevent="toolboxAction('queue_clear')">
                            <i data-feather="calendar" class="w-4 h-4 ml-2"></i> Queue Clear
                        </button>
                        <button class="btn btn-danger mr-2 mb-2" wire:click.prevent="toolboxAction('cache_clear')">
                            <i data-feather="trash" class="w-4 h-4 ml-2"></i> Cache Clear
                        </button>
                        <button class="btn btn-warning mr-2 mb-2" wire:click.prevent="toolboxAction('maintenance')">
                            <i data-feather="alert-triangle" class="w-4 h-4 ml-2"></i> Maintenance
                        </button>
{{--                        <button class="btn btn-dark mr-2 mb-2" wire:click.prevent="toolboxAction('service_fresh')">--}}
{{--                            <i data-feather="alert-triangle" class="w-4 h-4 ml-2"></i> Service Seed Refresh--}}
{{--                        </button>--}}

                    </div>
                </div>

                <div class="col-span-12 ">
                    <div class="intro-x flex items-center h-10">
                        <h1 class="text-lg font-medium truncate mr-5">
                            آخرین سناریو ها
                        </h1>
                    </div>
                    <div class="col-span-12 grid grid-cols-12 gap-6 mt-3">
                        @forelse($routers as $router)
                            <div class="col-span-12 sm:col-span-6 2xl:col-span-3 intro-y">
                                <div class="box px-5 py-3 mb-3 items-center zoom-in">
                                    <a href="{{route('admin.routers.show',$router->id)}}"
                                       class="flex items-center justify-content-center justify-center">
                                        @foreach ($router->routerables as $routerable)
                                            <div class="w-8 h-8 image-fit object-none object-center">
                                                <img alt="" class="img-fluid"
                                                     style=" margin: 5px;"
                                                     src="/uploads/logo/{{$routerable->action->service->logo ?? '#'}}">
                                            </div>
                                            <i class="fa-solid fa-angles-left"
                                               style="margin-left: 10px; margin-right: 20px; margin-top: 20px; margin-bottom: auto; align-self: center;"></i>
                                        @endforeach
                                        <div class="w-8 h-8 image-fit object-none object-center">
                                            <img alt="" class="img-fluid"
                                                 style=" margin: 5px;"
                                                 src="/uploads/logo/{{$router->trigger->service->logo}}">
                                        </div>
                                    </a>
                                    <br>
                                    <div class="items-center justify-content-center justify-center">
                                        <a href="{{route('admin.routers.show',$router->id)}}" class="font-medium">
                                            {{$router->user->full_name ?? '-'}}
                                        </a>
                                    </div>
                                    <div class="items-center justify-content-center justify-center">
                                        <a href="{{route('admin.routers.show',$router->id)}}"
                                           class="text-gray-600 text-xs mr-auto text-left">
                                            {{ verta($router->created_at)->formatDifference() }}
                                        </a>
                                    </div>
                                </div>
                            </div>

                        @empty
                            <p class="text-center">
                                موردی برای نمایش وجود ندارد
                            </p>
                        @endforelse
                        <a href="{{route('admin.routers.index')}}"
                           class="intro-y col-span-12 w-full block text-center rounded-md py-3 border border-dotted border-theme-15 dark:border-dark-5 text-theme-16 dark:text-gray-600">مشاهده
                            بیشتر</a>
                    </div>
                </div>

                <div class="col-span-12 md:col-span-6 xl:col-span-4 xxl:col-span-12 mt-1">
                    <div class="intro-x flex items-center h-10">
                        <h2 class="text-lg font-medium truncate mr-5">
                            کاربران جدید
                        </h2>
                    </div>
                    <div class="mt-5">
                        @forelse($last_users as $user)
                            <a href="{{route('admin.users.show',$user->id)}}" target="_blank">
                                <div class="intro-x">
                                    <div class="box px-5 py-3 mb-3 flex items-center zoom-in">
                                        <div class="w-10 h-10 flex-none image-fit rounded-full overflow-hidden">
                                            <img
                                                src="/uploads/avatars/{{$user->avatar}}">
                                        </div>
                                        <div class="mr-4 ml-auto">
                                            <div class="font-medium">{{$user->full_name ?? '-'}}</div>
                                            <div class="text-gray-600 text-xs">
                                                {{ verta($user->created_at)->formatDifference() }}
                                            </div>
                                        </div>
                                        <div class="text-theme-1">
                                            {{ $user->status_name }}
                                        </div>
                                    </div>
                                </div>
                            </a>

                        @empty
                            <p class="text-center">
                                موردی برای نمایش وجود ندارد
                            </p>
                        @endforelse
                        <a href="{{route('admin.users.index')}}"
                           class="intro-x w-full block text-center rounded-md py-3 border border-dotted border-theme-15 dark:border-dark-5 text-theme-16 dark:text-gray-600">مشاهده
                            بیشتر</a>
                    </div>
                </div>

                <div class="col-span-12 md:col-span-6 xl:col-span-4 xxl:col-span-12 mt-1">
                    <div class="intro-x flex items-center h-10">
                        <h2 class="text-lg font-medium truncate mr-5">
                            آخرین ورود کاربران
                        </h2>
                    </div>
                    <div class="mt-5">
                        @forelse($last_login_users as $user)
                            <a href="{{route('admin.users.show',$user->id)}}" target="_blank">
                                <div class="intro-x">
                                    <div class="box px-5 py-3 mb-3 flex items-center zoom-in">
                                        <div class="w-10 h-10 flex-none image-fit rounded-full overflow-hidden">
                                            <img
                                                src="/uploads/avatars/{{$user->avatar}}">
                                        </div>
                                        <div class="mr-4 ml-auto">
                                            <div class="font-medium">{{$user->full_name ?? '-'}}</div>
                                            <div class="text-gray-600 text-xs">
                                                {{ isset($user->last_login_at) ? verta($user->last_login_at)->formatDifference() : '-' }}
                                            </div>
                                        </div>
                                        <div class="text-theme-1">
                                            {{ $user->status_name }}
                                        </div>
                                    </div>
                                </div>
                            </a>

                        @empty
                            <p class="text-center">
                                موردی برای نمایش وجود ندارد
                            </p>
                        @endforelse

                        <a href="{{route('admin.users.index')}}"
                           class="intro-x w-full block text-center rounded-md py-3 border border-dotted border-theme-15 dark:border-dark-5 text-theme-16 dark:text-gray-600">مشاهده
                            بیشتر</a>
                    </div>
                </div>

                <div class="col-span-12 md:col-span-6 xl:col-span-4 xxl:col-span-12 mt-1">
                    <div class="intro-y flex items-center h-10">
                        <h2 class="text-lg font-medium truncate mr-5">
                            فعال ترین کاربران
                        </h2>
                    </div>
                    <div class="mt-5">
                        @foreach($active_users as $user)
                            <div class="intro-y">
                                <div class="box px-4 py-4 mb-3 flex items-center zoom-in">
                                    <div class="w-10 h-10 flex-none image-fit rounded-md overflow-hidden">
                                        <img alt="" src="{{$user->avatar_url}}">
                                    </div>
                                    <div class="ml-4 mr-auto">
                                        <div class="font-medium">{{$user->full_name ?? '-'}}</div>
                                    </div>
                                    <div class="py-1 px-2 rounded-full text-xs bg-theme-9 text-white cursor-pointer font-medium">
                                        {{$user->routers->count()}} سناریو
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <a href="{{route('admin.users.index')}}"
                           class="intro-y w-full block text-center rounded-md py-4 border border-dotted border-theme-15 dark:border-dark-5 text-theme-16 dark:text-gray-600">
                            بیشتر
                        </a>
                    </div>
                </div>

                <div class="col-span-12 mt-8">
                    <div class="intro-y flex items-center h-10">
                        <h5 class="text-lg font-medium truncate mr-5">
                            پیام های دریافت شده
                        </h5>
                    </div>
                    <div class="mt-5">
                        <div class="intro-y">
                            <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
                                <table class="table table-report -mt-2">
                                    <thead>
                                        <tr>
                                            <th class="text-center whitespace-no-wrap">نام</th>
                                            <th class="text-center whitespace-no-wrap">موبایل</th>
                                            <th class="text-center whitespace-no-wrap">ایمیل</th>
                                            <th class="text-center whitespace-no-wrap">موضوع</th>
                                            <th class="text-center whitespace-no-wrap">پیام</th>
                                            <th class="text-center whitespace-no-wrap">زمان</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($contacts as $contact)
                                            <tr class="intro-x">
                                                <td>{{$contact->name}}</td>
                                                <td>{{$contact->mobile}}</td>
                                                <td>{{$contact->email}}</td>
                                                <td>{{$contact->subject}}</td>
                                                <td>
                                                    <a href="javascript:vodi(0)" data-toggle="modal"
                                                       data-target="#contact-{{ $contact->id }}">
                                                        >
                                                        {{Str::limit($contact->message,60)}}
                                                    </a>
                                                    <div class="modal fade" id="contact-{{ $contact->id }}">
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title">{{ $contact->showType() }} -
                                                                        {{ $contact->subject }}</h4>
                                                                    <button type="button" class="close" data-dismiss="modal"
                                                                            aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    {!! $contact->message !!}
                                                                </div>
                                                                <div class="modal-footer justify-content-between">
                                                                    <button type="button" class="btn btn-default"
                                                                            data-dismiss="modal">بستن
                                                                    </button>
                                                                    <a href="{{ route('admin.contacts.delete',$contact->id) }}"
                                                                       class="btn btn-primary">حذف</a>
                                                                </div>
                                                            </div>
                                                            <!-- /.modal-content -->
                                                        </div>
                                                        <!-- /.modal-dialog -->
                                                    </div>
                                                </td>
                                                <td>{{verta($contact->updated_at)->timezone('Asia/Tehran')->format('H:i %B %d، %Y')}}
                                                </td>
                                            </tr>

                                        @empty
                                            <tr>
                                                <td colspan="7" align="center">موردی برای نمایش وجود ندارد</td>
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
        <div class="md:col-span-3 col-span-12 2xl:col-span-3">
            <div class="2xl:border-l border-theme-5 -mb-10 pb-10">
                <div class="2xl:pl-6 grid grid-cols-12 gap-6">

                    <div class="col-span-12 2xl:col-span-12 mt-3 2xl:mt-8">
                        <div class="flex flex-col">
                            <div class="box p-5 mt-6 bg-theme-3 intro-x">
                                <div class="flex flex-wrap gap-3">
                                    <a href="{{route('admin.payments.index')}}">
                                        <div class="mr-auto">
                                            <div class="text-white text-opacity-70 flex items-center leading-3">مبلغ پرداختی
                                            </div>
                                            <div
                                                class="text-white relative text-2xl font-medium leading-5 pl-4 mt-3.5">
                                                <span class="absolute text-xl top-0 left-0 -mt-1.5"></span>
                                                {{ $total_success_payments }}
                                            </div>
                                        </div>
                                        <a class="flex items-center justify-center w-12 h-12 rounded-full bg-white dark:bg-dark-1 bg-opacity-20 hover:bg-opacity-30 text-white mr-auto"
                                           href="{{route('admin.payments.index')}}">
                                            <i class="far fa-wallet"></i>
                                        </a>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="intro-x flex items-center mt-3 h-10">
                            <h2 class="text-lg font-medium truncate mr-5">
                                تراکنش ها
                            </h2>
                        </div>
                        <div class="mt-5">
                            @foreach ($payments as $payment)
                                <div class="intro-x">
                                    <div class="box px-5 py-3 mb-3 flex items-center zoom-in">

                                        <div class="ml-4 ml-auto">
                                            <div class="font-medium">{{$payment->user->full_name ?? '-'}}</div>
                                            <div class="text-gray-600 text-xs mt-0.5">{{ $payment->created_at_human_ago}}</div>
                                        </div>

                                        <div class="items-center justify-content-center justify-center mr-auto">
                                            @if($payment->status == 1)
                                                <div class="text-theme-6" style="font-size: 12px;">
                                                    {{ $payment->status_name }}
                                                </div>
                                            @else
                                                <div class="text-theme-9" style="font-size: 12px;">
                                                    {{ $payment->status_name }}
                                                </div>
                                            @endif
                                            <div class="font-medium text-center justify-content-center">
                                                {{number_format(price_r2t($payment->price))}} تومان
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <a href="{{route('admin.payments.index')}}"
                               class="intro-x w-full block text-center rounded-md py-3 border border-dotted border-theme-15 dark:border-dark-5 text-theme-16 dark:text-gray-600">
                                مشاهده بیشتر
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

