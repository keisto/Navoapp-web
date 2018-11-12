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
                    States
                </div>
            </div>
        </div>
    </div>
    <div class="ui segment container">
        <div class="ui header" style="font-weight: normal; color: #838383">
            Currently we provide service to these states:
        </div>
        <div class="ui divided animated list">
            @foreach($eachStateCount as $state)
                <div class="item">
                    <div class="right floated  content">
                        <div class="ui teal label"><span style="font-weight: normal">Well Count:</span> {{ number_format($state->total,0) }}</div>
                    </div>
                    <div class="middle aligned content">
                        <h3>{{ $state->name }}</h3>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="ui center aligned container" style="padding-top: 20px">
            <h4>Let us know about your state and we will get it added ASAP.
                <a class="ui blue icon button" style="position: relative; top: -5px" href="mailto:support@navoapp.io"><i class="mail large icon"></i></a>
            </h4>
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
