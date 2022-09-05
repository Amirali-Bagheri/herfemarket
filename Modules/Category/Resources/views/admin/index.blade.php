@extends('admin.layouts.master')

@section('pageTitle','مدیریت دسته بندی ها')

@section('content')
    <div class="col-span-12 container mx-auto sm:px-4 max-w-full mx-auto sm:px-4 xxl:col-span-12">
        @livewire('category::datatable')

    </div>
@endsection
