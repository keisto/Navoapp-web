@extends('layouts.app')
@section('content')
    @include('layouts.partials._account-header')
    <div class="ui padder container">
        <div class="ui grid">
            <div class="four wide column computer only tablet only">
                <div class="ui fluid secondary vertical menu">
                    @include('account.layouts.partials._navigation')
                </div>
            </div>
            <div class="sixteen wide wide column mobile only">
                <div class="ui blue dropdown fluid button">
                    <i class="bars icon"></i>
                    Navigation
                    <i class="dropdown icon"></i>
                    <div class="menu">
                        @include('account.layouts.partials._navigation')
                    </div>
                </div>
            </div>
            <div class="twelve wide computer only twelve wide tablet only sixteen wide mobile only column">
                <div class="ui segment">
                    @yield('account.content')
                </div>
            </div>
        </div>
    </div>
@endsection