@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <!-- 404 Error Text -->
        <div class="text-center">
            <div class="error mx-auto" data-text="@yield('code')">@yield('code')</div>
            <p class="lead text-gray-800 mb-5">@yield('message')</p>
            <p class="text-gray-500 mb-0"><!--It looks like you found a glitch in the matrix...--></p>
            <a href="{{ route('home') }}">&larr; Back to Dashboard</a>
        </div>

    </div>
@endsection
