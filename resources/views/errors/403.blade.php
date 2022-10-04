@extends('errors::minimal')

@section('pageTitle', __('دسترسی محدود شده است'))
@section('code', '403')
@section('message', __($exception->getMessage() ?: 'دسترسی محدود شده است'))
