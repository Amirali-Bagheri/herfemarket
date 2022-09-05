@extends('admin.layouts.master')
@section('pageTitle','مدیریت پیام ها')


@section('content')
    @include('admin.layouts.errors')

    <contacts inline-template>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title float-right">فهرست پیام ها </h3>
                    </div>
                    <div class="card-tools" style="margin: 10px">
                        <form action="{{route('admin.contacts.search')}}" id="search_form" method="get" role="search"
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
                                    <a class="dropdown-item" href="{{route('admin.contacts.export')}}">خروجی</a>
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
                                <th>متن پیام</th>
                                <th>@sortablelink('created_at', 'زمان ارسال', ['filter' => 'active, visible'])</th>
                                <th>@sortablelink('status', 'وضعیت', ['filter' => 'active, visible'])</th>
                                <th>گزینه ها</th>

                            </tr>
                            @if($contacts && count($contacts) > 0)
                                @foreach($contacts as $contact)

                                    <tr @if($contact->parent_id != 0) style="margin-right: 30px; width: 97.5%;" @endif>
                                        <td>
                                            <input type="checkbox" class="form-check-input check"
                                                   id="check-{{$contact->id}}"
                                                   data-id="{{$contact->id}}">
                                            <label class=" form-check-label" for="check-{{$contact->id}}"></label>

                                        </td>
                                        <td>{{$contact->id}}</td>
                                        <td>
                                            @if(!empty($contact->user_id))
                                                <a class=" text-decoration-none" style="color: #000" href="{{route('admin.users.show',$contact->user->id)}}">
                                                    {{$contact->user->full_name}}
                                                </a>
                                            @else
                                                -
                                            @endif
                                        </td>

                                        <td>{{\Illuminate\Support\Str::limit($contact->body,50)}}</td>

                                        <td>
                                            @if($contact->status == 0)
                                                <a style="margin: 5px;" href="javascript:void(0)"
                                                   @click="updateStatus({{$contact->id}})"><span
                                                        class="badge bg-warning">در حال
                                        بررسی</span></a>
                                            @elseif(($contact->status == 1))
                                                <a style="margin: 5px;" href="javascript:void(0)"
                                                   @click="updateStatus({{$contact->id}})"><span
                                                        class="badge bg-success">تایید
                                        شده</span></a>
                                            @elseif(($contact->status == 2))
                                                <a style="margin: 5px;" href="javascript:void(0)"
                                                   @click="updateStatus({{$contact->id}})"><span
                                                        class="badge bg-danger">رد
                                        شده</span></a>
                                            @endif
                                        </td>
                                        <td>{{verta($contact->created_at)->timezone('Asia/Tehran')->format('H:i %B %d، %Y')}}</td>

                                        <td>
                                            <a style="margin: 5px;" title="پاسخ دادن"
                                               @click="replycontact({{ $contact->contactable_id }},{{ $contact->id }})"
                                               href="javascript:void(0)">
                                                <i class="fa fa-reply"></i></a>
                                            <a style="margin: 5px;"
                                               href="{{route('admin.contacts.delete',['id'=>$contact->id])}}">
                                                <i class="fa fa-trash-alt"></i></a>
                                        </td>
                                    </tr>

                                    {{--            @include('site.products.contact_replies', ['contacts' => $contact->replies])--}}


                                @endforeach
                                {{--                                                @include('site.products.contact_replies', ['contacts' => $contacts, 'product_id' => $product->id])--}}
                            @else

                                <tr>
                                    <td colspan="8" align="center">پیامی برای این محصول ثبت نشده</td>
                                </tr>


                            @endif


                        </table>
                        <div class="row" style="margin-top: 20px; margin-right: -40;">
                            {!! $contacts->appends(Request::except('page'))->render() !!}

                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{--
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title float-right">فهرست پیام های مقالات </h3>
                                </div>
                                <div class="card-tools" style="margin: 10px">
                                    <form action="{{route('admin.contacts.search')}}" class="form-inline ml-4 float-right"
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
                    <a class="dropdown-item" href="{{route('admin.contacts.export')}}">خروجی</a>
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
                    <th>متن پیام</th>
                    <th>@sortablelink('created_at', 'زمان ارسال', ['filter' => 'active, visible'])</th>
                    <th>گزینه ها</th>
                </tr>
                @if($contactsArticle && count($contactsArticle) > 0)
                @foreach($contactsArticle as $contact)

                <tr @if($contact->parent_id != 0) style="margin-right: 30px; width: 97.5%;" @endif>

                    <td>{{$contact->id}}</td>
                    <td><a class="text-decoration-none" style="color: #000"
                            href="{{route('admin.users.show',$contact->user->id)}}">{{$contact->user->full_name}}</a></td>
                    <td>{{\Illuminate\Support\Str::limit($contact->body,50)}}</td>
                    <td>{{verta($contact->created_at)->timezone('Asia/Tehran')->format('H:i %B %d، %Y')}}</td>
                    <td><a style="margin: 5px;" title="پاسخ دادن" @click="replycontact()" href="javascript:void(0)">
                            <i class="fa fa-reply"></i></a></td>
                </tr>

                --}}
        {{--            @include('site.products.contact_replies', ['contacts' => $contact->replies])--}}{{--



                                    @endforeach
                                    --}}
        {{--                                                @include('site.products.contact_replies', ['contacts' => $contactsArticle, 'product_id' => $product->id])--}}{{--

                                @else

                                    <tr>
                                        <td colspan="5" align="center">پیامی برای این محصول ثبت نشده</td>
                                    </tr>


                                @endif



                                @if($contactsArticle && count($contactsArticle) > 0)
                                    @foreach($contactsArticle as $contact)

                                        @if($contact->parent_id == 0)
                                            <tr> @else
                                            <tr style="text-align: end;"> @endif
                                                <td><input type="checkbox" class="check" data-id="{{$contact->id}}">
        </td>
        <td>{{$contact->id}}</td>
        <td>{{$contact->name}}</td>
        --}}
        {{--<td><a href="#">{{$contact->article->title}}</a></td>--}}{{--

                                                <td>{{\Illuminate\Support\Str::limit($contact->body,50)}}</td>

        <td>
            @if($contact->status == 0)
            <a style="margin: 5px;" href="#" data-toggle="modal"
                data-target="#updateStatusModal-{{ $contact->id }}"><span class="badge bg-warning">در حال
                    بررسی</span></a>
            @elseif(($contact->status == 1))
            <a style="margin: 5px;" href="#" data-toggle="modal"
                data-target="#updateStatusModal-{{ $contact->id }}"><span class="badge bg-success">تایید
                    شده</span></a>
            @elseif(($contact->status == 2))
            <a style="margin: 5px;" href="#" data-toggle="modal"
                data-target="#updateStatusModal-{{ $contact->id }}"><span class="badge bg-danger">رد شده</span></a>
            @endif
        </td>
        <td>{{$date = verta($contact->created_at)}}</td>


        <td>
            <a href="#" class="text-decoration-none" data-toggle="modal"
                data-target="#quickShowModal-{{ $contact->id }}">
                <i class="fa-regular fa-eye"></i>
            </a>
            <a style="margin: 5px;" href="{{route('admin.contacts.delete',$contact->id)}}">
                <i class="fa fa-trash-alt"></i></a>
        </td>
        </tr>


        <div class="modal fade" id="updateStatusModal-{{ $contact->id }}" data-backdrop="static" tabindex="-1"
            role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content text-center">
                    <div class="modal-header" style="display: -webkit-box;">
                        <h5 class="modal-title" id="staticBackdropLabel">تعیین وضعیت
                            پیام شماره {{$contact->id}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p style="font-size: medium">وضعیت این پیام را تعیین کنید</p>
                    </div>
                    <form action="{{route('admin.contacts.update',$contact->id)}}" method="POST">
                        @csrf
                        <div class="modal-footer" style="display: initial;">
                            <button type="submit" id="deny" name="status" value="2" class="btn btn-success">رد
                            </button>
                            <button type="submit" id="verify" name="status" value="1" class="btn btn-danger">تایید
                            </button>
                            <input type="hidden" name="article_id" value="{{$contact->article_id}}">
                            <input type="hidden" name="contact_id" value="{{$contact->id}}">

                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="quickShowModal-{{ $contact->id }}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style="direction: rtl;">
                        <h4 class="modal-title">مشاهده سریع پیام
                            شماره {{ $contact->id }}</h4>
                    </div>
                    <div class="modal-body">
                        <p><b>فرستنده: </b>{{ $contact->name }}</p>
                        <p><b>پست الکترونیکی: </b><a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a>
                        </p>
                        <p><b>متن پیام: </b></p>
                        <p>{{ $contact->body }}</p>

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
            <td colspan="8" align="center">پیامی برای نمایش وجود ندارد</td>
        </tr>

        @endif

    </table>
    <div class="row" style="margin-top: 20px; margin-right: -40;">
        {!! $contactsArticle->appends(Request::except('page'))->render() !!}

    </div>
</div>
</div>
</div>
</div>
--}}


    </contacts>

@endsection
