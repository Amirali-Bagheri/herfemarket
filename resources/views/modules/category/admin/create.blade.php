@extends('admin.layouts.master')

@section('pageTitle','دسته بندی جدید')

@section('content')
    <div class="col-span-12 container mx-auto sm:px-4 max-w-full mx-auto sm:px-4 xxl:col-span-12">

        <div class="intro-y flex items-center mt-8">
            <h2 class="text-lg font-medium ml-auto">
                دسته بندی جدید
            </h2>
        </div>

        @livewire('category::create')

    </div>
@endsection
