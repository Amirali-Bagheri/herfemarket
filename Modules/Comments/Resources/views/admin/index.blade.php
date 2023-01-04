<div>
    @include('admin.layouts.livewire_loading')

    <div class="intro-y col-span-12 flex flex-wrap sm:flex-no-wrap items-center mt-2 ltr">
        @if (count($selected) > 0)
        <a href="javascript:void(0)" class="mr-2 ml-2" data-toggle="modal" data-target="#delete-selected-modal">
            <i class="far fa-trash"></i>
        </a>
        @endif
        <a wire:click='export' href="javascript:void(0)">
            <i class="far fa-file-export"></i>
        </a>
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
                                    class="btn btn-danger w-24 border text-white-700 mr-1 ml-2 ml-2">لغو
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
            نمایش {{ $comments->firstItem() }} تا {{ $comments->lastItem() }} از {{ $comments->total() }} مورد
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
                               @if(count($selected)===$comments->total()) checked
                               @endif wire:click.lazy="toggleSelectAll">
                    </th>
                    <th class="text-center whitespace-no-wrap">
                        <a wire:click.prevent="sortBy('id')" role="button" href="javascript:void(0)">
                            شناسه
                            @include('admin.layouts.livewire_sort_icon', ['field' => 'id'])
                        </a>
                    </th>

                    <th class="text-center whitespace-no-wrap">
                        <a wire:click.prevent="sortBy('user_id')" role="button" href="javascript:void(0)">
                            نام کاربر
                            @include('admin.layouts.livewire_sort_icon', ['field' => 'user_id'])
                        </a>
                    </th>

                    <th class="text-center whitespace-no-wrap">
                        متن دیدگاه
                    </th>

                    <th class="text-center whitespace-no-wrap">
                        <a wire:click.prevent="sortBy('commentable_type')" role="button" href="javascript:void(0)">
                            دیدگاه برای
                            @include('admin.layouts.livewire_sort_icon', ['field' => 'commentable_type'])
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
                @forelse($comments as $comment)

                    <tr class="intro-x">
                        <td>
                            <input type="checkbox" class="form-check-input mr-2" wire:model="selected"
                                   value="{{ $comment->id }}">

                        </td>
                        <td class="text-center w-5">{{$comment->id}}</td>
                        <td class="text-center">
                            <a target="_blank" href="{{route('admin.users.show',$comment->user_id)}}">
                                {{$comment->user->name}}
                            </a>
                        </td>
                        <td class="text-center" title="{{$comment->body}}">
                            {{\Illuminate\Support\Str::limit($comment->body,100)}}
                        </td>
                        <td class="text-center">
                            {{\Illuminate\Support\Str::afterLast($comment->commentable_type,'\\')}}
                        </td>
                        <td class="text-center">
                            <a href="javascript:void(0)" wire:click="$emit('updateStatus',{{$comment->id}})">
                                {{ $comment->status_name }}
                            </a>
                        </td>
                        <td class="text-center">{{ $comment->created_at_human}}</td>

                        <td class="table-report__action w-50 text-center">
                            <a style="margin: 5px;"
                               href="{{$comment->commentable->getUrl() ?? '#'}}"
                               target="_blank">
                                <i class="fas fa-link"></i>
                            </a>

                            {{--                            <a href="{{route('admin.comments.show',$comment->id)}}" style="margin: 5px;">--}}
                            {{--                                <i class="far fa-eye"></i>--}}
                            {{--                            </a>--}}
                            <a style="margin: 5px;" href="{{route('admin.comments.update',$comment)}}">
                                <i class="far fa-pen-to-square"></i>

                            </a>
                            <a style="margin: 5px;"
                               href="javascript:void(0)"
                               wire:click="destroy({{$comment->id}})"
                                {{--                           href="{{route('admin.comments.delete',$comment->id)}}"--}}
                            >
                                <i class="far fa-trash-alt"></i>
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
            {{ $comments->links('admin.layouts.livewire_pagination') }}
        </div>

        @include('core::livewire.layouts.paginate_numbers')
    </div>

    {{--
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title float-right">فهرست دیدگاه ها </h3>
                    </div>
                    <div class="card-tools" style="margin: 10px">
                        <form action="{{route('comments.search')}}" id="search_form" method="get" role="search"
                              class="form-inline typeahead error-form float-right">

                            <div class="input-group md-form form-sm form-2 pl-0">
                                <input type="search" name="s" class="form-control mr-sm-2 search-input rtl"
                                       placeholder="جستجو ..." style="direction: rtl;">


                                <a href="javascript:void(0)" onclick="document.getElementById('search_form').submit();">
                                    <i class="fas fa-search" style="color: black" aria-hidden="true"></i>
                                </a>
                            </div>


                        </form>

                        <div class="float-left">
                            <div class="dropdown">

                                <button class="btn btn-danger dropdown-toggle" type="button" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">عملیات
                                </button>

                                <div class="dropdown-menu dropdown-danger text-center">
                                    <a class="dropdown-item" href="{{route('comments.export')}}">خروجی</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item delete-all" @click="deleteAll()" href="javascript:void(0)">حذف
                                        انتخاب شده ها</a>
                                </div>
                            </div>


                        </div>

                    </div>


                    <div class="card-body table-responsive" style="padding: 0.60rem;">

                        <table class="table table-hover">
                            <tr>
                                <th>
                                    <input type="checkbox" class="form-check-input" id="check_all">
                                    <label class="form-check-label" for="check_all"></label>
                                </th>
                                <th>@sortablelink('id', 'شناسه', ['filter' => 'active, visible'])</th>
                                <th>نام کاربر</th>
                                <th>متن دیدگاه</th>
                                <th>@sortablelink('created_at', 'زمان ارسال', ['filter' => 'active, visible'])</th>
                                <th>@sortablelink('status', 'وضعیت', ['filter' => 'active, visible'])</th>
                                <th>گزینه ها</th>

                            </tr>
                            @if($comments && count($comments) > 0)
                                @foreach($comments as $comment)

                                    <tr @if($comment->parent_id != 0) style="margin-right: 30px; width: 97.5%;" @endif>
                                        <td>
                                            <input type="checkbox" class="form-check-input check" id="check-{{$comment->id}}"
                                                   data-id="{{$comment->id}}">
                                            <label class=" form-check-label" for="check-{{$comment->id}}"></label>

                                        </td>
                                        <td>{{$comment->id}}</td>
                                        <td><a class=" text-decoration-none" style="color: #000"
                                               href="{{route('admin.users.show',$comment->user->id)}}">{{$comment->user->full_name}}</a>
                                        </td>

                                        <td>{{\Illuminate\Support\Str::limit($comment->body,50)}}</td>

                                        <td>
                                            @if($comment->status == 0)
                                                <a style="margin: 5px;" href="javascript:void(0)"
                                                   @click="updateStatus({{$comment->id}})"><span class="badge bg-warning">در حال
                                            بررسی</span></a>
                                            @elseif(($comment->status == 1))
                                                <a style="margin: 5px;" href="javascript:void(0)"
                                                   @click="updateStatus({{$comment->id}})"><span class="badge bg-success">تایید
                                            شده</span></a>
                                            @elseif(($comment->status == 2))
                                                <a style="margin: 5px;" href="javascript:void(0)"
                                                   @click="updateStatus({{$comment->id}})"><span class="badge bg-danger">رد
                                            شده</span></a>
                                            @endif
                                        </td>
                                        <td>{{verta($comment->created_at)->timezone('Asia/Tehran')->format('H:i %B %d، %Y')}}</td>

                                        <td>
                                            <a style="margin: 5px;" title="پاسخ دادن"
                                               @click="replyComment({{ $comment->commentable_id }},{{ $comment->id }})"
                                               href="javascript:void(0)">
                                                <i class="fa fa-reply"></i></a>
                                            <a style="margin: 5px;" href="{{route('comments.delete',['id'=>$comment->id])}}">
                                                <i class="fa fa-trash-alt"></i></a>
                                        </td>
                                    </tr>

                                    --}}
    {{--            @include('site.products.comment_replies', ['comments' => $comment->replies])--}}{{--



                                @endforeach
                                --}}
    {{--                                                @include('site.products.comment_replies', ['comments' => $comments, 'product_id' => $product->id])--}}{{--

                            @else

                                <tr>
                                    <td colspan="8" align="center">دیدگاهی برای این محصول ثبت نشده</td>
                                </tr>


                            @endif


                        </table>
                        <div class="row" style="margin-top: 20px; margin-right: -40;">
                            {!! $comments->appends(Request::except('page'))->render() !!}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    --}}

    {{--
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title float-right">فهرست دیدگاه های مقالات </h3>
                            </div>
                            <div class="card-tools" style="margin: 10px">
                                <form action="{{route('comments.search')}}" class="form-inline ml-4 float-right"
    style="margin: 5px">
    <div class="input-group-append">
        <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
    </div>
    <input class="form-control form-control-navbar float-right" name="s" style="width: 65%" placeholder="جست و جو"
        type="text" aria-label="جست و جو">
    </form>

    <div class="float-left">

        <div class="btn-group float-left text-decoration-none ltr" style="margin-left: 10px;">
            <button type="button" class="btn btn-danger">عملیات</button>
            <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown">
                <span class="caret"></span>
                <span class="sr-only">Toggle Dropdown</span>
            </button>
            <div class="dropdown-menu" role="menu">
                <a class="dropdown-item" href="{{route('comments.export')}}">خروجی</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item delete-all" data-url="" href="#">حذف انتخاب شده ها</a>
            </div>
        </div>
    </div>

    </div>

    <div class="card-body  table-responsive" style="padding: 0.60rem;">

        <table class="table table-hover">
            <tr>
                <th><input type="checkbox" id="check_all"></th>
                <th>@sortablelink('id', 'شناسه', ['filter' => 'active, visible'])</th>
                <th>نام کاربر</th>
                <th>@sortablelink('article_id', 'نام مقاله', ['filter' => 'active, visible'])</th>
                <th>متن دیدگاه</th>
                <th>@sortablelink('created_at', 'زمان ارسال', ['filter' => 'active, visible'])</th>
                <th>گزینه ها</th>
            </tr>
            @if($commentsArticle && count($commentsArticle) > 0)
            @foreach($commentsArticle as $comment)

            <tr @if($comment->parent_id != 0) style="margin-right: 30px; width: 97.5%;" @endif>

                <td>{{$comment->id}}</td>
                <td><a class="text-decoration-none" style="color: #000"
                        href="{{route('admin.users.show',$comment->user->id)}}">{{$comment->user->full_name}}</a></td>
                <td>{{\Illuminate\Support\Str::limit($comment->body,50)}}</td>
                <td>{{verta($comment->created_at)->timezone('Asia/Tehran')->format('H:i %B %d، %Y')}}</td>
                <td><a style="margin: 5px;" title="پاسخ دادن" @click="replyComment()" href="javascript:void(0)">
                        <i class="fa fa-reply"></i></a></td>
            </tr>

            --}}
    {{--            @include('site.products.comment_replies', ['comments' => $comment->replies])--}}{{--



                                @endforeach
                                --}}
    {{--                                                @include('site.products.comment_replies', ['comments' => $commentsArticle, 'product_id' => $product->id])--}}{{--

                            @else

                                <tr>
                                    <td colspan="5" align="center">دیدگاهی برای این محصول ثبت نشده</td>
                                </tr>


                            @endif



                            @if($commentsArticle && count($commentsArticle) > 0)
                                @foreach($commentsArticle as $comment)

                                    @if($comment->parent_id == 0)
                                        <tr> @else
                                        <tr style="text-align: end;"> @endif
                                            <td><input type="checkbox" class="check" data-id="{{$comment->id}}">
    </td>
    <td>{{$comment->id}}</td>
    <td>{{$comment->name}}</td>
    --}}
    {{--<td><a href="#">{{$comment->article->title}}</a></td>--}}{{--

                                            <td>{{\Illuminate\Support\Str::limit($comment->body,50)}}</td>

    <td>
        @if($comment->status == 0)
        <a style="margin: 5px;" href="#" data-toggle="modal"
            data-target="#updateStatusModal-{{ $comment->id }}"><span class="badge bg-warning">در حال
                بررسی</span></a>
        @elseif(($comment->status == 1))
        <a style="margin: 5px;" href="#" data-toggle="modal"
            data-target="#updateStatusModal-{{ $comment->id }}"><span class="badge bg-success">تایید
                شده</span></a>
        @elseif(($comment->status == 2))
        <a style="margin: 5px;" href="#" data-toggle="modal"
            data-target="#updateStatusModal-{{ $comment->id }}"><span class="badge bg-danger">رد شده</span></a>
        @endif
    </td>
    <td>{{$date = verta($comment->created_at)}}</td>


    <td>
        <a href="#" class="text-decoration-none" data-toggle="modal"
            data-target="#quickShowModal-{{ $comment->id }}">
            <i class="far fa-eye"></i>
        </a>
        <a style="margin: 5px;" href="{{route('comments.delete',$comment->id)}}">
            <i class="fa fa-trash-alt"></i></a>
    </td>
    </tr>


    <div class="modal fade" id="updateStatusModal-{{ $comment->id }}" data-backdrop="static" tabindex="-1"
        role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content text-center">
                <div class="modal-header" style="display: -webkit-box;">
                    <h5 class="modal-title" id="staticBackdropLabel">تعیین وضعیت
                        دیدگاه شماره {{$comment->id}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p style="font-size: medium">وضعیت این دیدگاه را تعیین کنید</p>
                </div>
                <form action="{{route('comments.update',$comment->id)}}" method="POST">
                    @csrf
                    <div class="modal-footer" style="display: initial;">
                        <button type="submit" id="deny" name="status" value="2" class="btn btn-success">رد
                        </button>
                        <button type="submit" id="verify" name="status" value="1" class="btn btn-danger">تایید
                        </button>
                        <input type="hidden" name="article_id" value="{{$comment->article_id}}">
                        <input type="hidden" name="comment_id" value="{{$comment->id}}">

                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="quickShowModal-{{ $comment->id }}">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="direction: rtl;">
                    <h4 class="modal-title">مشاهده سریع دیدگاه
                        شماره {{ $comment->id }}</h4>
                </div>
                <div class="modal-body">
                    <p><b>فرستنده: </b>{{ $comment->name }}</p>
                    <p><b>پست الکترونیکی: </b><a href="mailto:{{ $comment->email }}">{{ $comment->email }}</a>
                    </p>
                    <p><b>متن دیدگاه: </b></p>
                    <p>{{ $comment->body }}</p>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        خروج
                    </button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    @endforeach


    @else
    <tr>
        <td colspan="8" align="center">دیدگاهی برای نمایش وجود ندارد</td>
    </tr>

    @endif

</table>
<div class="row" style="margin-top: 20px; margin-right: -40;">
    {!! $commentsArticle->appends(Request::except('page'))->render() !!}

</div>
</div>
</div>
</div>
</div>
--}}

</div>

