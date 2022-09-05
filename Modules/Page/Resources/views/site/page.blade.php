@extends('site.layouts.master')

@section('content')

    <div>
        <div class="section-full p-t80 p-b50 bg-orange-light">
            <div class="container">
                <div class="section-content">
                    <div class="section-head text-center">
                        <h2>{{ $page->title }}</h2>
                        <div class="wt-separator sep-gradient-light"></div>
                    </div>
                    <p>

                        {!! html_entity_decode($page->content) !!}

                    </p>
                </div>
            </div>
        </div>
    </div>

@endsection
