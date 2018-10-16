@extends('layouts.app')
@section('content')
    @include('layouts.partials.details._header')
        <div class="ui secondary menu">
            <a class="item active" data-tab="detail"><i class="map marker alternate icon"></i> Location</a>
            <a class="item" data-tab="nearby"><i class="compass outline icon"></i> Nearby <span class="ui label">#</span></a>
        </div>
        <div class="ui raised padded segment">
            <div class="ui equal width stackable grid">
                @include('layouts.partials.details._details')
                <div class="row">
                    <div class="{{ auth()->user()->hasOneCall() ? "ten" : "sixteen" }} wide column">
                        <h1 class="ui header">
                            <i class="map pin red icon"></i>
                            <div class="content">
                                <div class="sub grey header">Latitude, Longitude:</div>
                                {{ $location->latitude  == "0" ? "Not found" : $location->latitude.", " }}
                                {{ $location->longitude  == "0" ? "" : $location->longitude }}
                            </div>
                        </h1>
                    </div>
                    @hasonecall
                        @include('layouts.partials.details._onecall')
                    @endhasonecall
                </div>
                @hasonecall
                    @include('layouts.partials.details._directions')
                    <div class="row">
                        <div class="sixteen wide column">
                            <h1 class="ui header" style="display: flex">
                                <i class="clipboard outline orange icon"></i>
                                <div class="content" style="width: 100%;">
                                    <form id="note-form" action="{{ route('location.note.store', $location->id) }}" method="POST">
                                        @csrf
                                        <textarea id="note_text" name="text" hidden></textarea>
                                    <div style="display: flex; width: 100%; display: flex; align-items: center;">
                                        <div class="sub header" style="display: flex; flex-grow: 1">Notes:</div>
                                        <button type="submit" id="note_button" data-inverted=""
                                                class="ui green small labeled icon disabled button">
                                            <i class="ui save icon"></i>
                                            Save Note
                                        </button>
                                    </div>
                                    </form>
                                </div>
                            </h1>
                            @if(count($notes))
                                <div class="ui styled fluid accordion">
                                    @if(!$location->noteByUser()->get()->first())
                                        <div class="title" id="user_note_title">
                                                <span style="float: right; color: #b0b0b0; font-weight: normal" id="note_updated">
                                                    No Note Created</span>
                                            <i class="dropdown icon"></i>
                                            {{ auth()->user()->name }} (You):
                                        </div>
                                        <div class="content active" id="user_note_content">
                                            <div class="ui form">
                                                <div class="field">
                                                    <textarea id="user_note" rows="4" placeholder="Notes"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    @foreach($notes as $note)
                                        @if($note->user()->id == auth()->id())
                                            <div class="title" id="user_note_title">
                                                <span style="float: right; color: #b0b0b0; font-weight: normal" id="note_updated">
                                                    Updated: {{ Carbon\Carbon::parse($note->updated_at)->diffForHumans() }}</span>
                                                <i class="dropdown icon"></i>
                                                {{ auth()->user()->name }} (You):
                                            </div>
                                            <div class="content active" id="user_note_content">
                                                <div class="ui form">
                                                    <div class="field">
                                                        <textarea id="user_note" rows="4" placeholder="Notes">{{ $note->text }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <div class="title">
                                                <span style="float: right; color: #b0b0b0; font-weight: normal">
                                                    Updated: {{ Carbon\Carbon::parse($note->updated_at)->diffForHumans() }}</span>
                                                <i class="dropdown icon"></i>
                                                {{ $note->user()->name }} <a style="margin-left: 6px" href="mailto:{{ $note->user()->email }}"><i class="mail outline orange icon"></i></a>
                                            </div>
                                            <div class="content">
                                                <div class="ui form">
                                                    <div class="field">
                                                        <p>@php echo(nl2br($note->text)); @endphp</p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            @else
                                <div class="ui styled fluid accordion">
                                    <div class="title" id="user_note_title">
                                            <span style="float: right; color: #b0b0b0; font-weight: normal" id="note_updated">
                                                No Note Created</span>
                                        <i class="dropdown icon"></i>
                                        {{ auth()->user()->name }} (You):
                                    </div>
                                    <div class="content active" id="user_note_content">
                                        <div class="ui form">
                                            <div class="field">
                                                <textarea id="user_note" rows="4" placeholder="Notes"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                @endhasonecall
            </div>
        </div>
        @include('layouts.partials.details._footer')
    @include('layouts.partials.details._modal')
    @include('layouts.partials.details._progress')
@endsection
@include('layouts.partials.details._scripts')