@extends('layouts.app')
@section('content')
    @include('layouts.partials._home-header')
    <div class="ui padder container">
        <div class="ui grid">
            <div class="four wide column">
                <div class="ui fluid secondary vertical menu">
                    @include('account.layouts.partials._navigation')
                </div>
            </div>
            <div class="twelve wide column">
                <div class="ui segment">
                    @yield('account.content')
                </div>
            </div>
        </div>
    </div>
@endsection