@extends('admin.layouts.master')
@section('pageTitle','صفحات گوگل')

@section('content')
    @include('admin.layouts.errors')
    <div class="row">
        <div class="col-12">

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title float-right">ابزار های سئو</h3>
                </div>
                <div class="card-tools" style="margin: 10px">

                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3> ‌ </h3>
                                    <p class="text-center"> صفحات ایندکس شده در گوگل</p>
                                </div>
                                <div class="icon">
                                    <i class="fab fa-google"></i>
                                </div>
                                <a href="{{ route('admin.seo.google_pages') }}" class="small-box-footer">کلیک کنید <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3> ‌ </h3>
                                    <p class="text-center">بررسی لینک ها</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-link"></i>
                                </div>
                                {{--                                <a href="{{ route('admin.seo.links') }}" class="small-box-footer">کلیک کنید <i--}}
                                {{--                                        class="fas fa-arrow-circle-right"></i></a>--}}
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <h3> ‌ </h3>
                                    <p class="text-center">رتبه بندی الکسا</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-chart-line"></i>
                                </div>
                                <a href="{{ route('admin.seo.alexa') }}" class="small-box-footer">کلیک کنید <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-danger">
                                <div class="inner">
                                    <h3> ‌ </h3>
                                    <p class="text-center">نقشه سایت</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-sitemap"></i>
                                </div>
                                <a href="#" class="small-box-footer">کلیک کنید <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                    </div>
                    <div class="row">
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3> ‌ </h3>
                                    <p class="text-center">بک لینک ها</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-link"></i>
                                </div>
                                <a href="{{ route('admin.seo.backlinks') }}" class="small-box-footer">کلیک کنید <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3> ‌ </h3>
                                    <p class="text-center">جایگاه کلمات کلیدی</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-key"></i>
                                </div>
                                <a href="{{ route('admin.seo.google_serp') }}" class="small-box-footer">کلیک کنید <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
@endsection


