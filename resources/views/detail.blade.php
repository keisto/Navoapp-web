@extends('layouts.app')
@section('content')
    @if ($location->latitude != "0")
    <div class="page-header" id="map" style="border-bottom: 1px solid #c0c1c2" class="computer only">
        <div class="mobile only">
            <div class="ui center aligned container">
                <div class="ui secondary inverted menu" style="padding-top: 1em; text-shadow: black 0 1px 10px">
                    @include("layouts.partials._navigation")
                </div>
            </div>
            <div style="height: 50px; overflow: hidden;" >
                <svg viewBox="0 0 500 150" preserveAspectRatio="none" style="height: 12%; width: 100%; margin-bottom: -1px">
                    <path d="M0.00,49.98 C149.99,150.00 350.85,-49.98 500.00,49.98 L500.00,150.00 L0.00,150.00 Z" style="stroke: none; fill: #f1f7fa;"></path>
                </svg>
            </div>
        </div>
    </div>
    <div class="ui container" style="margin-top: -44px; margin-bottom: 44px;">
    @else
    <div class="page-header">
        <div class="ui center aligned container">
            <div class="ui secondary inverted menu" style="padding-top: 1em; text-shadow: black 0 1px 10px">
                @include("layouts.partials._navigation")
            </div>
            <h2 class="ui centered orange message">Latitude & Longitude not found. Cannot display map</h2>
        </div>

        <div style="height: 50px; overflow: hidden;" >
            <svg viewBox="0 0 500 150" preserveAspectRatio="none" style="height: 12%; width: 100%; margin-bottom: -1px">
                <path d="M0.00,49.98 C149.99,150.00 350.85,-49.98 500.00,49.98 L500.00,150.00 L0.00,150.00 Z" style="stroke: none; fill: #f1f7fa;"></path>
            </svg>
        </div>
    </div>
    <div class="ui container" id="no-latlon-mobile" style="margin-top: 0; margin-bottom: 44px;">
    @endif

        <div class="ui floating padded segment">
            <div class="ui equal width stackable grid">
                <div class="row">
                    <div class="column">
                        <h1 class="ui header">
                            <i class="open folder outline blue icon"></i>
                            <div class="content">
                                <div class="sub grey header">Well Name:</div>
                                {{ $location->well_name == "" ? "Not found" : title_case($location->well_name) }}
                            </div>
                        </h1>
                    </div>
                    <div class="column">
                        <h1 class="ui header">
                            <i class="hashtag teal icon"></i>
                            <div class="content">
                                <div class="sub grey header">API Number:</div>
                                {{ $location->api_number == "" ? "Not found" : $location->api_number  }}
                            </div>
                        </h1>
                    </div>
                </div>


                <div class="row">
                    <div class="column">
                        <h1 class="ui header">
                            <i class="address card outline purple icon"></i>
                            <div class="content">
                                <div class="sub grey header">Operator:</div>
                                {{ $location->current_operator  == "" ? "Not found" : title_case($location->current_operator) }}
                            </div>
                        </h1>
                    </div>
                    <div class="column">
                        <h1 class="ui header">
                            <i class="info yellow icon"></i>
                            <div class="content">
                                <div class="sub grey header">Well Type:</div>
                                {{ $location->well_type == "" ? "not found" : title_case($location->well_type) }}
                            </div>
                        </h1>
                    </div>
                </div>
                <div class="row" style="align-items: center">
                    <div class="twelve wide computer ten wide tablet column">
                        <h1 class="ui header">
                            <i class="map outline green icon"></i>
                            <div class="content">
                                <div class="sub grey header">
                                    {{ $location->cloest_city  == "" ? "" : "Closest City, " }}
                                    State, {{ $location->county_name  == "" ? "" : "County," }} Country:</div>
                                {{ $location->cloest_city  == "" ? "" : $location->cloest_city . ", " }}
                                {{ $location->state  == "" ? "" : $location->state . ", " }}
                                {{ $location->county_name  == "" ? "" : title_case($location->county_name) . " County, "}}
                                {{ $location->country  == "" ? "United States" : $location->country }}
                            </div>
                        </h1>
                    </div>
                    <div class="four wide computer six wide tablet center aligned column">
                        <a class="ui blue button" target="_blank" href="#">
                            <i class="google icon"></i>
                            Open in Google Maps
                        </a>
                    </div>
                </div>
                <div class="row">
                    <div class="ten wide column">
                        <h1 class="ui header">
                            <i class="map pin red icon"></i>
                            <div class="content">
                                <div class="sub grey header">Latitude, Longitude:</div>
                                {{ $location->latitude  == "0" ? "Not found" : $location->latitude.", " }}
                                {{ $location->longitude  == "0" ? "" : $location->longitude }}
                            </div>
                        </h1>
                    </div>
                    <div class="six wide column">
                        <div class="ui grid">
                            <div class="three column row">
                                <div class="column">
                                    <h1 class="ui header">
                                        <div class="content">
                                            <div class="sub grey header">Township:</div>
                                            {{ $location->township  == "" ? "--" : $location->township }}
                                        </div>
                                    </h1>
                                </div>
                                <div class="column">
                                    <h1 class="ui header">
                                        <div class="content">
                                            <div class="sub grey header">Range:</div>
                                            {{ $location->range  == "" ? "--" : $location->range }}
                                        </div>
                                    </h1>
                                </div>
                                <div class="column">
                                    <h1 class="ui header">
                                        <div class="content">
                                            <div class="sub grey header">Section:</div>
                                            {{ $location->section  == "" ? "--" : $location->section }}
                                        </div>
                                    </h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <p style="text-align: center">
                <span class="grey-text">
                    <i class="icon history"></i>
                    Last Modification:
                </span>
            {{ \Carbon\Carbon::parse($location->date_modified)->diffForHumans() }}
        </p>
        <div style="display: flex; justify-content: space-between;">
            <a class="ui black button" href="{{ url()->previous() }}">
                <i class="icon left arrow"></i>
                Back
            </a>

            <div style="display: flex">
                <form action="{{ route('location.favorite.store', $location->id) }}" method="POST">
                    <button type="submit" id="favorite_button" data-tooltip="{{ $location->isFavoredByUser(auth()->id()) ?
                            "Favored on: " . $location->favoredOn(auth()->id()) : "Add to Favorites?" }}"
                            class="ui {{ $location->isFavoredByUser(auth()->id()) ? "yellow" : "basic" }} icon button" data-inverted="">
                        <i class="icon star"></i>
                    </button>
                </form>

                <a class="ui blue button" onclick="$('.ui.modal').modal('show');">
                    <i class="icon share"></i>
                    Share
                </a>
            </div>
        </div>
    </div>

    @include('layouts.partials._share-modal')
@endsection
@include('layouts.partials._map')