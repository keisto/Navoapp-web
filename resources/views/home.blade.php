@extends('layouts.app')
@section('content')
    @include("layouts.partials._home-header")
    <div class="ui container">
        <div class="ui inverted blue very padded raised segment">
            <div class="ui header">
                <i class="info circle icon"></i> Currently we only have these states loaded:
            </div>
            <div class="ui ordered horizontal list" style="display: flex; justify-content: center">
                <div class="item">
                    <img class="ui rounded image" src="https://ui-avatars.com/api/?name=MT&background=1a1f3d&color=FFFFFF" width="32px">
                    <div class="content">
                        <div class="header">Montana</div>
                    </div>
                </div>
                <div class="item">
                    <img class="ui rounded image" src="https://ui-avatars.com/api/?name=ND&background=1a1f3d&color=FFFFFF" width="32px">
                    <div class="content">
                        <div class="header">North Dakota</div>
                    </div>
                </div>
                <div class="item">
                    <img class="ui rounded image" src="https://ui-avatars.com/api/?name=SD&background=1a1f3d&color=FFFFFF" width="32px">
                    <div class="content">
                        <div class="header">South Dakota</div>
                    </div>
                </div>
            </div>
            <div class="ui center aligned container">
            <h4>Let us know about your state and we will get it added ASAP.
                <a class="ui blue icon button" style="position: relative; top: -5px" href="mailto:tony@navoapp.io"><i class="mail large icon"></i></a>
            </h4>
            </div>
        </div>

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
                    States
                </div>
            </div>
        </div>
    </div>

    <div id="simple-search" class="ui container" style="@if ((new Jenssegers\Agent\Agent)->isDesktop() || (new Jenssegers\Agent\Agent)->isTablet()) padding-top: 52px; padding-bottom: 32px; @else background-image:none; !important; @endif ">
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
