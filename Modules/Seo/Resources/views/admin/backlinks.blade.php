@extends('admin.layouts.master')
@section('pageTitle','بک لینک ها')

@section('content')
    @include('admin.layouts.errors')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title float-right">بررسی وبسایت دیگر</h5>

                    <div class="card-tools float-left">
                        <a href="javascript:void(0)" class="text-decoration-none color-black" style="margin: 10px"
                           data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </a>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form method="post" action="{{route('admin.seo.backlinks')}}"
                          class="text-center ltr" style="margin: 5px">
                        @csrf
                        <div class="input-group flex-nowrap ltr">
                            <div class="input-group-prepend">
                                <span class="input-group-text ltr" id="addon-wrapping">www.</span>
                            </div>
                            <input type="text" class="form-control" placeholder="domain" aria-label="domain"
                                   name="domain"
                                   aria-describedby="addon-wrapping">
                        </div>
                        <button type="submit" class="btn btn-primary">بررسی</button>
                    </form>
                </div>

            </div>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title float-right">صفحات ایندکس شده در گوگل ({{$backlinks->count()}})</h3>
                </div>
                <div class="card-tools" style="margin: 10px">

                </div>

                <div class="card-body  table-responsive" style="padding: 0.60rem;">


                    <table class="table table-hover">
                        <tr>
                            <th>شناسه</th>
                            <th>عنوان</th>
                            <th>لینک</th>
                            <th>توضیحات</th>
                        </tr>

                        @if($backlinks && count($backlinks) > 0)
                            @foreach($backlinks as $page)

                                <tr>
                                    <td>
                                        {{ ($backlinks ->currentpage()-1) * $backlinks ->perpage() + $loop->index + 1 }}
                                    </td>
                                    <td>
                                        {{ $page['title'] }}
                                    </td>
                                    <td><a target="_blank"
                                           href="{{ $page['link'] }}">{{$page['link']}}</a>
                                    </td>
                                    <td>
                                        {{ $page['snippet'] }}
                                    </td>
                                </tr>

                            @endforeach
                        @else
                            <tr>
                                <td colspan="8" align="center">برای وبسایت بک لینکی در گوگل یافت نشد</td>
                            </tr>

                        @endif


                    </table>
                    <div class="row" style="margin-top: 20px; margin-right: -40;">
                        {!! $backlinks->appends(Request::except('page'))->render() !!}

                    </div>


                </div>
            </div>

        </div>
    </div>
@endsection
