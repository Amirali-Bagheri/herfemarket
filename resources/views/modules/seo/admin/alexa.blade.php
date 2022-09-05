@extends('admin.layouts.master')
@section('pageTitle','رتبه بندی الکسا')

@section('content')
    @include('admin.layouts.errors')
    <div class="row">
        <div class="col-12">


            <div class="row">
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title float-right">بررسی وبسایت دیگر</h5>
                        </div>
                        <div class="card-body">
                            <form method="post" action="{{route('admin.seo.alexa')}}"
                                  class="text-center ltr" style="margin: 5px">
                                @csrf
                                <div class="input-group flex-nowrap ltr">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text ltr" id="addon-wrapping">www.</span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="domain" aria-label="domain"
                                           name="domain" value="{{  old('domain',$domain )}}"
                                           aria-describedby="addon-wrapping">
                                </div>
                                <button type="submit" class="btn btn-primary">بررسی</button>
                            </form>
                        </div>

                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title float-right">فهرست برترین وبسایت ها</h5>
                        </div>
                        <div class="card-body">
                            <a href="{{route('admin.seo.topSites')}}" target="_blank">
                                <button class="btn btn-primary">کلیک کنید</button>
                            </a>
                        </div>

                    </div>


                </div>
                <!-- /.col-md-6 -->
                <div class="col-lg-8">

                    <div class="card">
                        <div class="card-header border-0">
                            <h3 class="card-title">اطلاعات و آمار سایت:</h3>
                        </div>
                        <div class="card-body  table-responsive" style="padding: 0.60rem;">
                            <table class="table table-hover">
                                <tr>
                                    <th>دامنه</th>
                                    <th>رنک در ایران</th>
                                    <th>رنک در جهان</th>
                                    <th>تغییر</th>
                                    <th>بک لینک</th>
                                </tr>

                                <tr>
                                    <td>
                                        {{ $alexa['domain'] }}
                                    </td>
                                    <td>
                                        {{ number_format($alexa['countryRank']) }}
                                    </td>
                                    <td>
                                        {{ number_format($alexa['global']) }}
                                    </td>
                                    <td>
                                        {{ number_format($alexa['reach']) }}
                                    </td>
                                    <td>
                                        {{ number_format($alexa['backlinks']) }}
                                    </td>
                                </tr>

                            </table>


                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="card">
                                <div class="card-header border-0">
                                    <div class="d-flex justify-content-between">
                                        <h3 class="card-title">نمودار تغییرات رتبه سایت</h3>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <img src="{{ $alexa['rankGraph'] }}" class="img-fluid">
                                </div>
                            </div>

                        </div>
                        <div class="col-6">

                            <div class="card">
                                <div class="card-header border-0">
                                    <div class="d-flex justify-content-between">
                                        <h3 class="card-title">نمودار درصد جستجوی سایت</h3>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <img src="{{ $alexa['searchPercentGraph'] }}" class="img-fluid">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.col-md-6 -->
            </div>

        </div>
    </div>
@endsection
