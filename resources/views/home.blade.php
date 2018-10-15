@extends('layouts.app')
@section('content')
    @include("layouts.partials._home-header")
    <div class="ui container">
        <div class="ui three statistics padder">
            <div class="statistic">
                <div class="value">
                    <img src="{{ asset('images/badge.svg') }}" style="width: 50px" class="ui inline image">
                    {{ number_format($operators,0) }}
                </div>
                <div class="label">
                    Operators
                </div>
            </div>
            <div class="statistic">
                <div class="value">
                    <img src="{{ asset('images/punit.svg') }}" style="width: 50px" class="ui inline image">
                    {{ number_format($wells,0) }}
                </div>
                <div class="label">
                    Oil well locations
                </div>
            </div>
            <div class="statistic">
                <div class="value">
                    <img src="{{ asset('images/map.svg') }}" style="width: 50px" class="ui inline image">
                    {{ number_format($states,0) }}
                </div>
                <div class="label">
                    States (including Canada)
                </div>
            </div>
        </div>
    </div>

    <div id="simple-search" class="ui raised very padded segment container" style="@if ((new Jenssegers\Agent\Agent)->isDesktop() || (new Jenssegers\Agent\Agent)->isTablet()) @else background-image:none !important; @endif ">
        <h2 class="ui header">Fast & Simple Search</h2>
        <div class="ui relaxed divided list">
            <div class="item">
                <i class="large pencil alternate middle aligned icon"></i>
                <div class="content">
                    <a class="header">Spelling forgiveness</a>
                    <div class="description">Some locations are confusing to spell, just give us the gist</div>
                </div>
            </div>
            <div class="item">
                <i class="large search middle aligned icon"></i>
                <div class="content">
                    <a class="header">Search by many</a>
                    <div class="description">Well name, Operator, API Number, Field</div>
                </div>
            </div>
            <div class="item">
                <i class="large filter middle aligned icon"></i>
                <div class="content">
                    <a class="header">Filter down results</a>
                    <div class="description">State, Field, Type, Operator</div>
                </div>
            </div>

        </div>
    </div>

    <div class="ui container" style="margin-bottom: 44px">
        @include('layouts.partials._features')
    </div>
@endsection
