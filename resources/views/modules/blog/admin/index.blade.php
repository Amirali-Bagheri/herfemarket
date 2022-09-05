<div>
    <div>
        @include('admin.layouts.livewire_loading')

        <div class="intro-y col-span-12 flex flex-wrap sm:flex-no-wrap items-center mt-2 ltr">
            <a href="{{ route('admin.posts.create') }}" class="btn btn-primary shadow-md mr-2">پست
                جدید</a>
            <div class="dropdown">
                <button class="dropdown-toggle btn px-2 box text-gray-700">
                <span class="w-5 h-5 flex items-center justify-center"> <i class="w-4 h-4 fas fa-plus"></i>
                </span>
                </button>
                <div class="dropdown-menu w-40">
                    <div class="dropdown-menu__content box p-2">

                        @if (count($selected) > 0) <a href="javascript:void(0)" data-toggle="modal"
                                                      data-target="#delete-selected-modal"
                                                      class="flex items-center block p-2 transition duration-300 ease-in-out bg-white hover:bg-gray-200 rounded-md">
                            <i class="w-4 h-4 ml-2 fal fa-trash"></i> حذف موارد انتخاب شده </a>
                        @endif

                        <a href="javascript:void(0)"
                           class="flex items-center block p-2 transition duration-300 ease-in-out bg-white hover:bg-gray-200 rounded-md">
                            <i class="w-4 h-4 ml-2 fal fa-print"></i> چاپ </a>

                        <a href="javascript:void(0)" wire:click='export'
                           class="flex items-center block p-2 transition duration-300 ease-in-out bg-white hover:bg-gray-200 rounded-md">
                            <i class="w-4 h-4 ml-2 fal fa-file-excel"></i> خروجی اکسل </a>

                    </div>
                </div>
            </div>
            <div class="modal" id="delete-selected-modal" wire:ignore>
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body p-0">
                            <div class="p-5 text-center">
                                <i data-feather="x-circle" class="w-16 h-16 text-theme-6 mx-auto mt-3"></i>
                                <div class="text-3xl mt-5">آیا مطمئن هستید؟</div>
                                <div class="text-gray-600 mt-2">پس از حذف این اطلاعات قابل بازیابی نیست</div>
                            </div>
                            <div class="px-5 pb-8 text-center">
                                <button type="button" data-dismiss="modal"
                                        class="btn btn-danger w-24 border text-white-700 mr-1 ml-2">لغو
                                </button>
                                <button type="button" wire:click="deleteAll" data-dismiss="modal"
                                        class="btn w-24 bg-theme-6 text-white">حذف
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="hidden md:block mx-auto text-gray-600">
                نمایش {{ $posts->firstItem() }} تا {{ $posts->lastItem() }} از {{ $posts->total() }} مورد
            </div>
            <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">

                <div class="w-56 relative text-gray-700">
                    <input type="text" wire:model.debounce.500ms="search"
                           class="form-control w-56 box pr-10 placeholder-theme-13 rtl" placeholder=" جستجو...">
                    <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-feather="search"></i>
                </div>
            </div>

        </div>

        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible" style="overflow: auto;">
            <table class="table table-report -mt-2">
                <thead>
                <tr>
                    <th class="text-center whitespace-no-wrap">
                        <input type="checkbox" class="form-check-input mr-2"
                               @if(count($selected)===$posts->total()) checked
                               @endif wire:click.lazy="toggleSelectAll">
                    </th>
                    <th class="text-center whitespace-no-wrap">
                        <a wire:click.prevent="sortBy('id')" role="button" href="javascript:void(0)">
                            شناسه
                            @include('admin.layouts.livewire_sort_icon', ['field' => 'id'])
                        </a>
                    </th>

                    <th class="text-center whitespace-no-wrap">
                        <a wire:click.prevent="sortBy('title')" role="button" href="javascript:void(0)">
                            عنوان
                            @include('admin.layouts.livewire_sort_icon', ['field' => 'title'])
                        </a>
                    </th>

                    <th class="text-center whitespace-no-wrap">
                        <a wire:click.prevent="sortBy('slug')" role="button" href="javascript:void(0)">
                            نام نمایشی
                            @include('admin.layouts.livewire_sort_icon', ['field' => 'slug'])
                        </a>
                    </th>

                    <th class="text-center whitespace-no-wrap">
                        <a wire:click.prevent="sortBy('status')" role="button" href="javascript:void(0)">
                            وضعیت
                            @include('admin.layouts.livewire_sort_icon', ['field' => 'status'])
                        </a>
                    </th>

                    <th class="text-center whitespace-no-wrap">
                        <a wire:click.prevent="sortBy('created_at')" role="button" href="javascript:void(0)">
                            زمان
                            @include('admin.layouts.livewire_sort_icon', ['field' => 'created_at'])
                        </a>
                    </th>

                    <th class="text-center whitespace-no-wrap">
                        گزینه ها
                    </th>
                </tr>
                </thead>
                <tbody>
                @forelse($posts as $post)

                    <tr class="intro-x">
                        <td>
                            <input type="checkbox" class="form-check-input mr-2" wire:model="selected"
                                   value="{{ $post->id }}">

                        </td>
                        <td class="text-center w-5">{{$post->id}}</td>
                        <td class="text-center">{{$post->title}}</td>
                        <td class="text-center">{{$post->slug}}</td>
                        <td class="text-center">
                            {{ $post->status_name }}
                        </td>
                        <td class="text-center">{{ $post->created_at_human}}</td>

                        {{-- <td class="text-center">{{ verta($post->last_login_at)->formatDifference()  }}</td> --}}
                        <td class="table-report__action w-50 text-center">
                            <a style="margin: 5px;"
                               href="{{route('site.blog.single',$post->slug)}}"
                               target="_blank">
                                <i class="fas fa-link"></i>
                            </a>

                            <a style="margin: 5px;" href="{{route('admin.posts.update',$post->id)}}">
                                <i class="fa-regular fa-pen-to-square"></i>

                            </a>
                            <a style="margin: 5px;"
                               href="javascript:void(0)"
                               wire:click="destroy({{$post->id}})"
                                {{--                           href="{{route('admin.posts.delete',$post->id)}}"--}}
                            >
                                <i class="fa-regular fa-trash-alt"></i>
                            </a>
                        </td>

                    </tr>

                @empty
                    <tr class="intro-x">
                        <td colspan="8" class="text-center">
                            موردی برای نمایش یافت نشد
                        </td>
                    </tr>

                @endforelse
                </tbody>
            </table>

        </div>

        <div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center">

            <div class="form-inline ml-auto">
                {{ $posts->links('admin.layouts.livewire_pagination') }}
            </div>

            @include('core::livewire.layouts.paginate_numbers')
        </div>

    </div>

    {{--
        <div class="card">
            <div class="card-header">
                <h3 class="card-title float-right">فهرست پست ها</h3>
            </div>
            <div class="card-tools" style="margin: 10px">
                <form action="{{route('admin.posts.search')}}" id="search_form" method="get" role="search"
                      class="form-inline typeahead error-form float-right">

                    <div class="input-group md-form form-sm form-2 pl-0">
                        <input type="search" name="s" class="form-control mr-sm-2 search-input rtl"
                               placeholder="جستجو ..."
                               style="direction: rtl;">


                        <a href="javascript:void(0)" onclick="document.getElementById('search_form').submit();">
                            <i class="fas fa-search" style="color: black" aria-hidden="true"></i>
                        </a>
                    </div>


                </form>

                <div class="form-inline mr-4 float-left">
                    <button class="btn btn-danger dropdown-toggle" type="button" data-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="false">عملیات
                    </button>

                    <div class="dropdown-menu dropdown-danger text-center">
                        <a class="dropdown-item delete-all" @click="deleteAll()" href="javascript:void(0)">حذف
                            انتخاب شده ها</a>
                    </div>
                    <a class="float-left text-decoration-none" href="{{route('admin.posts.create')}}">
                        <button type="button" class="btn btn-block btn-success">پست جدید</button>
                    </a>


                </div>

            </div>

            <div class="card-body  table-responsive" style="padding: 0.60rem;">


                <table class="table table-hover">
                    <tr>
                        <th>
                            <input type="checkbox" class="form-check-input" id="check_all">
                            <label class="form-check-label" for="check_all"></label>
                        </th>
                        <th>@sortablelink('id', 'شناسه', ['filter' => 'active, visible'])</th>
                        <th>@sortablelink('title', 'عنوان', ['filter' => 'active, visible'])</th>
                        <th>@sortablelink('view_count', 'تعداد بازدید', ['filter' => 'active, visible'])</th>
                        <th>@sortablelink('updated_at', 'زمان ارسال/ویرایش', ['filter' => 'active, visible'])</th>
                        <th>@sortablelink('status', 'وضعیت', ['filter' => 'active, visible'])</th>
                        <th>گزینه ها</th>
                    </tr>

                    @if($posts && count($posts) > 0)
                        @foreach($posts as $post)

                            <tr id="tr_{{$post->id}}">
                                <td>
                                    <input type="checkbox" class="form-check-input check" id="check-{{$post->id}}"
                                           data-id="{{$post->id}}">
                                    <label class=" form-check-label" for="check-{{$post->id}}"></label>

                                </td>
                                <td>{{$post->id}}</td>
                                <td><a target="_blank"
                                       href="{{ route('site.blog.single',$post->slug)}}">{{$post->title}}</a></td>
                                <td>{{views($post)->unique()->count()}}</td>
                                <td>{{verta($post->updated_at)->timezone('Asia/Tehran')->format('H:i %B %d، %Y')}}</td>
                                <td class="text-center">
                                    @if ($post->status == 1)
                                        <span class="badge badge-success">فعال</span>
                                    @else
                                        <span class="badge badge-danger">غیر فعال</span>
                                    @endif
                                </td>

                                <td class="text-center">
                                    <a style="margin: 5px;" href="{{route('admin.posts.show',$post->id)}}">
                                        <i class="fa-regular fa-eye"></i></a>

                                    --}}
    {{--                                        <a style="margin: 5px;" href="{{route('admin.posts.share',['id'=>$post->id])}}">--}}{{--

                                    --}}
    {{--                                            <i class="fa fa-share"></i></a>--}}{{--

                                    <a style="margin: 5px;" href="{{route('admin.posts.update',$post->id)}}">
                                        <i class="fa fa-edit"></i></a>
                                    <a style="margin: 5px;" href="{{route('admin.posts.delete',$post->id)}}">
                                        <i class="fa fa-trash-alt"></i></a>
                                </td>
                            </tr>

                        @endforeach
                    @else
                        <tr>
                            <td colspan="8" align="center">پستی برای نمایش وجود ندارد</td>
                        </tr>

                    @endif


                </table>
                <div class="row" style="margin-top: 20px; margin-right: -40;">
                    {!! $posts->appends(Request::except('post'))->render() !!}

                </div>


            </div>
        </div>
    --}}

</div>
