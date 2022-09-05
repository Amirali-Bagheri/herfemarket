@extends('admin.layouts.master')
@section('pageTitle','جایگاه کلمات کلیدی')

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


                <div class="card-body">
                    <form method="post" action="{{route('admin.seo.google_serp')}}"
                          class="text-center ltr" style="margin: 5px">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <div class="input-group flex-nowrap ltr">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text ltr" id="addon-wrapping">www.</span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="domain" aria-label="domain"
                                           name="domain" value="{{ old('domain',$domain) }}"
                                           aria-describedby="addon-wrapping">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="input-group flex-nowrap text-center">
                                    <input type="text" class="form-control" placeholder="keyword"
                                           aria-label="keyword" value="{{ old('keyword',$keyword) }}"
                                           name="keyword"
                                           aria-describedby="addon-wrapping">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">بررسی</button>
                    </form>
                </div>


            </div>
            @isset($serp)
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title float-right">جایگاه کلمات کلیدی (SERP)</h3>
                    </div>
                    <div class="card-tools" style="margin: 10px">

                    </div>

                    <div class="card-body  table-responsive" style="padding: 0.60rem;">


                        <table class="table table-hover">
                            <tr>
                                <th>کلیدواژه</th>
                                <th>وبسایت</th>
                                <th>تعداد نتایج</th>
                                <th>محل قرارگیری</th>
                            </tr>

                            <tr>
                                <td>
                                    {{ Str::after($serp['query'], 'q=') }}
                                </td>
                                <td>
                                    {{ $serp['website'] }}
                                </td>
                                <td>
                                    {{ $serp['searched_results'] }}
                                </td>
                                <td>
                                    {{ $serp['position'] }}
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            @endisset
        </div>
    </div>
@endsection
