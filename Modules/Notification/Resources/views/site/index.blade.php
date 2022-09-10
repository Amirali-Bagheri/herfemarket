@extends('dashboard.layouts.master')

@section('content')
    @forelse($unreadNotifications as $notification)
        <a target="_blank" href="{{ $notification->data['link'] }}">{{ $notification->data['message'] }}</a>
    @empty
        <p>پیامی موجود نیست!</p>
    @endforelse
@endsection
