@extends('layouts.app')

@section('content')
    <div class="lg:flex">
        <div class="lg:w-1/4">
            @include('_sidebar-links')
        </div>

        <div class="lg:flex-1">
            2
        </div>

        <div class="lg:w-1/4">
            @include('_friends-list')
        </div>
    </div>
@endsection
