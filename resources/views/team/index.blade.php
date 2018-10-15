@extends('layouts.app')
@section('content')
    <div class="ui secondary inverted my-account menu">
        <div class="ui container">
            @include('layouts.partials._navigation')
        </div>
    </div>
    <div class="ui container padder">
        <h2 class="ui header">
            <img class="ui image" src="{{ asset('images/group.svg') }}" style="height: 44px;">
            <div class="content">
                Team Members
            </div>
        </h2>
        <table class="ui sortable celled selectable table">
            <thead>
            <tr>
                <th>Name:</th>
                <th>Email:</th>
                <th>Phone:</th>
            </tr>
            </thead>
            <tbody>
            @foreach($teamMembers as $member)
                <tr>
                    <td>
                        {{ $member->name }}
                    </td>
                    <td>
                        {{ $member->email }}
                    </td>
                    <td>
                        @if ($member->phone != null)
                            {{ $member->phone_number }}
                        @else
                            <span style="color:#c1c1c1;">No Number Found</span>
                        @endif
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