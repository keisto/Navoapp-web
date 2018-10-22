@extends('layouts.app')
@section('content')
    <div class="ui secondary inverted my-account menu">
        <div class="ui container">
            @include('layouts.partials._navigation')
        </div>
    </div>
    <div class="ui container padder">
        <h2 class="ui header">
            <img class="ui image" src="{{ asset('images/history-location.svg') }}" style="height: 44px;">
            <div class="content">
                History
            </div>
        </h2>
        <table class="ui sortable celled selectable table">
            <thead>
            <tr>
                <th>Well Name:</th>
                <th>Operator:</th>
                <th>City:</th>
                <th>State:</th>
                <th>Added:</th>
                <th class="no-sort"></th>
            </tr>
            </thead>
            <tbody>
            @foreach($history as $location)
                <tr>
                    <td>
                        {{ strtoupper($location->name) }}
                    </td>
                    <td>
                        {{ strtoupper($location->operator) }}
                    </td>
                    <td>
                        {{ $location->city }}
                    </td>
                    <td>
                        {{ $location->state }}
                    </td>
                    <td data-tooltip="{{ Carbon\Carbon::parse($location->pivot->created_at)->format('D - M/d/y') }}">
                        <i class="calendar alternate outline grey-text icon"></i> {{ Carbon\Carbon::parse($location->pivot->created_at)->diffForHumans() }}
                    </td>
                    <td class="collapsing">
                        <a class="ui blue button" href="/{{$location->id}}" data-inverted=""
                           data-tooltip="View Location">
                            <i class="eye icon"></i> View
                        </a>
                        <a class="ui black icon button" href="/{{$location->id}}" target="_blank" data-inverted=""
                           data-tooltip="Open in a new tab">
                            <i class="external square alternate icon"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
@section('scripts')
    <script>
        $( document ).ready(function() {
            setTimeout(function () {
                $('table').tablesort();
            }, 1000);
        });
    </script>
@endsection