@extends('admin.layouts.master')
@section('pageTitle','برترین سایت ها در Alexa')

@section('content')
    @include('admin.layouts.errors')
    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title text-center">50 وبسایت برتر جهان در Alexa</h3>
                </div>

                <div class="card-body  table-responsive" style="padding: 0.60rem;">


                    <table class="table table-hover">
                        <tr>
                            <th>رنک</th>
                            <th>سایت</th>
                        </tr>

                        @foreach($global as $rank => $site)

                            <tr>
                                <td>
                                    {{ $rank + 1 }}
                                </td>
                                <td>
                                    <a href="http://{{ $site }}" target="_blank">{{ $site }}</a>
                                </td>

                            </tr>

                        @endforeach


                    </table>


                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title text-center">50 وبسایت برتر ایران در Alexa</h3>
                </div>

                <div class="card-body  table-responsive" style="padding: 0.60rem;">


                    <table class="table table-hover">
                        <tr>
                            <th>رنک</th>
                            <th>سایت</th>
                        </tr>

                        @foreach($global as $rank => $site)

                            <tr>
                                <td>
                                    {{ $rank + 1 }}
                                </td>
                                <td>
                                    <a href="http://{{ $site }}" target="_blank">{{ $site }}</a>
                                </td>

                            </tr>

                        @endforeach


                    </table>


                </div>
            </div>
        </div>
    </div>
@endsection
