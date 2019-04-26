@extends('layouts.app')
@section('content')
    {{-- https://itunes.apple.com/us/app/navo/id1372593466?ls=1&mt=8 --}}
    @include("layouts.partials._home-header")

    <div class="ui container" style="margin-bottom: 44px; margin-top: 44px">
        @include('layouts.partials._features')
    </div>
@endsection
@section('scripts')

@endsection
