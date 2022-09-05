<div>
    @include('admin.layouts.livewire_loading')
    <div class="col-span-12 xxl:col-span-12 grid grid-cols-12 gap-6">

        <div class="col-span-12 xxl:col-span-9 grid grid-cols-12 gap-6 mt-2">

            <div class="col-span-12">
                <div class="grid grid-cols-12 gap-6">
                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <a href="{{ route('admin.inquiries.index') }}">
                            <div class="report-box zoom-in">
                                <div class="box p-5">
                                    <div class="flex">
                                        <i class="report-box__icon text-theme-10" data-feather="file-text"></i>
                                    </div>
                                    <div
                                        class="text-3xl font-bold leading-8 mt-6">{{ \Modules\Inquiry\Entities\Inquiry::pending()->count() ?? 0}}</div>
                                    <div class="text-base text-gray-600 mt-1">استعلام های بررسی نشده</div>
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
                                        class="text-3xl font-bold leading-8 mt-6">{{\Modules\Comments\Entities\Comment::pending()->count() ?? 0}}</div>
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
                                        class="text-3xl font-bold leading-8 mt-6">{{\Modules\User\Entities\User::count() ?? 0}}</div>
                                    <div class="text-base text-gray-600 mt-1">کاربران</div>
                                </div>
                            </div>
                        </a>

                    </div>
                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            <a href="{{route('admin.tickets.index') }}">
                                <div class="box p-5">
                                    <div class="flex">
                                        <i class="report-box__icon text-theme-9" data-feather="pie-chart"></i>
                                    </div>
                                    <div
                                        class="text-3xl font-bold leading-8 mt-6">
                                        {{ \Modules\Ticket\Entities\Ticket::where('status',0)->count() }}
                                        {{--                                    <?php try{ ?>--}}
                                        {{--                                        {{Analytics::fetchVisitorsAndPageViews(\Spatie\Analytics\Period::days(0))->count()}}--}}
                                        {{--                                    <?php }catch (Throwable $e) { ?>--}}
                                        {{--                                    ---}}
                                        {{--                                   <?php } ?>--}}

                                    </div>
                                    {{--                                <div class="text-base text-gray-600 mt-1">بازدید سایت امروز</div>--}}
                                    <div class="text-base text-gray-600 mt-1">
                                        تیکت های باز
                                    </div>
                                </div>
                            </a>
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
                    <button class="btn btn-dark mr-2 mb-2" wire:click.prevent="toolboxAction('maintenance')">
                        <i data-feather="alert-triangle" class="w-4 h-4 ml-2"></i> Maintenance
                    </button>

                </div>

            </div>

            <div class="col-span-12 xl:col-span-4">
                <div class="intro-x flex items-center h-10">
                    <h1 class="text-lg font-medium truncate mr-5">
                        جدید ترین کسب و کار ها
                    </h1>
                </div>
                <div class="mt-2">
                    @if (\Modules\Business\Entities\Business::count() > 0)
                        @foreach(\Modules\Business\Entities\Business::latest()->get()->take(20) as $business)
                            <div class="intro-x">
                                <a href="{{route('admin.businesses.update',$business->id)}}">
                                    <div class="box px-5 py-3 mb-3 flex items-center zoom-in">
                                        <div class="w-10 h-10 flex-none image-fit rounded-full overflow-hidden">
                                            <img
                                                src="/uploads/logos/{{$business->logo}}">
                                        </div>
                                        <div class="mr-4 ml-auto ">
                                            <div class="font-medium">{{$business->name}}</div>
                                            <div class="text-gray-600 text-xs">
                                                {{ verta($business->created_at)->formatDifference() }}
                                            </div>
                                        </div>
                                        <div class="text-theme-1">
                                            {{ $business->status_name }}

                                            {{--                                            @if ($business->latest_crawled_products_count > 0)--}}
                                            {{--                                                <span class="badge badge-danger">--}}
                                            {{--                                                    ( {{$business->latest_crawled_products_count }}  محصول جدید )--}}
                                            {{--                                            </span>--}}
                                            {{--                                            @endif--}}
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                        <a href="{{route('admin.businesses.index')}}"
                           class="intro-x w-full block text-center rounded-md py-3 border border-dotted border-theme-15 dark:border-dark-5 text-theme-16 dark:text-gray-600">مشاهده
                            بیشتر</a>
                    @else
                        <p class="text-center">
                            موردی برای نمایش وجود ندارد
                        </p>
                    @endif

                </div>
            </div>

            <div class="col-span-12 xl:col-span-4">
                <div class="intro-x flex items-center h-10">
                    <h2 class="text-lg font-medium truncate mr-5">
                        کاربران جدید
                    </h2>
                </div>
                <div class="mt-5">
                    @if (\Modules\User\Entities\User::count() > 0)
                        @foreach(\Modules\User\Entities\User::latest()->get()->take(5) as $user)
                            <a href="{{route('admin.users.update',$user->id)}}" target="_blank">
                                <div class="intro-x">
                                    <div class="box px-5 py-3 mb-3 flex items-center zoom-in">
                                        <div class="w-10 h-10 flex-none image-fit rounded-full overflow-hidden">
                                            <img
                                                src="/uploads/avatars/{{$user->avatar}}">
                                        </div>
                                        <div class="mr-4 ml-auto">
                                            <div class="font-medium">{{$user->full_name}}</div>
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
                        @endforeach
                        <a href="{{route('admin.users.index')}}"
                           class="intro-x w-full block text-center rounded-md py-3 border border-dotted border-theme-15 dark:border-dark-5 text-theme-16 dark:text-gray-600">مشاهده
                            بیشتر</a>
                    @else
                        <p class="text-center">
                            موردی برای نمایش وجود ندارد
                        </p>
                    @endif

                </div>

                <div class="intro-x flex items-center h-10">
                    <h2 class="text-lg font-medium truncate mr-5">
                        آخرین ورود کاربران
                    </h2>
                </div>
                <div class="mt-5">
                    @if (\Modules\User\Entities\User::count() > 0)
                        @foreach(\Modules\User\Entities\User::orderBy('last_login_at','desc')->get()->take(5) as $user)
                            <a href="{{route('admin.users.update',$user->id)}}" target="_blank">
                                <div class="intro-x">
                                    <div class="box px-5 py-3 mb-3 flex items-center zoom-in">
                                        <div class="w-10 h-10 flex-none image-fit rounded-full overflow-hidden">
                                            <img
                                                src="/uploads/avatars/{{$user->avatar}}">
                                        </div>
                                        <div class="mr-4 ml-auto">
                                            <div class="font-medium">{{$user->full_name}}</div>
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
                        @endforeach
                        <a href="{{route('admin.users.index')}}"
                           class="intro-x w-full block text-center rounded-md py-3 border border-dotted border-theme-15 dark:border-dark-5 text-theme-16 dark:text-gray-600">مشاهده
                            بیشتر</a>
                    @else
                        <p class="text-center">
                            موردی برای نمایش وجود ندارد
                        </p>
                    @endif

                </div>
            </div>

            <div class="col-span-12 xl:col-span-4">
                <div class="intro-x flex items-center h-10">
                    <h1 class="text-lg font-medium truncate mr-5">
                        فهرست لینک ها
                    </h1>
                </div>
                <div class="mt-2">
                    @if (count($links) > 0)
                        @foreach($links as $link)
                            <div class="intro-x">
                                <a href="{{route('admin.links.show',$link->id)}}">
                                    <div class="box px-5 py-3 mb-3 flex items-center zoom-in">
                                        <div class="w-10 h-10 flex-none image-fit rounded-full overflow-hidden">
                                            <img
                                                src="/uploads/logos/{{$link->business->logo}}">
                                        </div>
                                        <div class="mr-4 ml-auto ">
                                            <div class="font-medium">{{$link->business->name}}</div>
                                            <div class="text-gray-600 text-xs">
                                                {{ verta($link->business->created_at)->formatDifference() }}
                                            </div>
                                        </div>
                                        <div class="text-theme-1">
                                            {{ $link->crawled_products_count }}
                                        </div>

                                        @if ($link->latest_crawled_products_count > 0)
                                            <div
                                                class="py-1 px-2 mr-2 rounded-full text-xs bg-theme-9 text-white cursor-pointer font-medium text-center"> {{$link->latest_crawled_products_count }}
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                     viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                     stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                                                     class="feather feather-chevron-up w-4 h-4 ml-0.5">
                                                    <polyline points="18 15 12 9 6 15"></polyline>
                                                </svg>
                                            </div>
                                        @endif
                                    </div>
                                </a>
                            </div>
                        @endforeach
                        <a href="{{route('admin.links.index')}}"
                           class="intro-x w-full block text-center rounded-md py-3 border border-dotted border-theme-15 dark:border-dark-5 text-theme-16 dark:text-gray-600">مشاهده
                            بیشتر</a>
                    @else
                        <p class="text-center">
                            موردی برای نمایش وجود ندارد
                        </p>
                    @endif

                </div>


            </div>

            <div class="col-span-12 xl:col-span-4">
                <div class="intro-y flex items-center h-10">
                    <h2 class="text-lg font-medium truncate mr-5">
                        کسب و کار های فعال
                    </h2>
                </div>
                <div class="mt-5">

                    @forelse($businesses as $business)
                        <div class="intro-y">
                            <a href="{{route('admin.businesses.update',$business->id)}}">
                                <div class="box px-4 py-4 mb-3 flex items-center zoom-in">
                                    <div class="w-10 h-10 flex-none image-fit rounded-full overflow-hidden">
                                        <img
                                            src="/uploads/logos/{{$business->logo}}">
                                    </div>
                                    <div class="mr-4 ml-auto">
                                        <div class="font-medium">
                                            {{ $business->name }}
                                        </div>
                                        <div class="text-gray-600 text-xs"></div>
                                    </div>
                                    <div
                                        class="py-1 px-2 rounded-full text-xs bg-theme-9 text-white cursor-pointer font-medium">
                                        {{$business->prices_count}} قیمت
                                    </div>
                                </div>
                            </a>
                        </div>

                    @empty

                    @endforelse

                    <a href="#"

                       class="intro-y w-full block text-center rounded-md py-4 border border-dotted border-theme-15 dark:border-dark-5 text-theme-16 dark:text-gray-600">مشاهده

                        بیشتر</a>

                </div>
            </div>

            <div class="col-span-12 sm:col-span-8 mt-8">
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
                                            <a href="#" data-toggle="modal" title="{{$contact->message}}"
                                               data-target="#contact-{{ $contact->id }}">
                                                {{str($contact->message)->limit(60)}}
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

</div>
