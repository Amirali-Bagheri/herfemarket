@extends('admin.layouts.master')

@section('pageTitle','ثبت کسب و کار جدید')


@section('content')
    <div class="col-span-12 container mx-auto sm:px-4 max-w-full mx-auto sm:px-4 xxl:col-span-12">

        @livewire('business::create')

    </div>

@endsection
