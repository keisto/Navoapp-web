@extends('layouts.app')
@section('content')
<ais-index app-id="{{ config('scout.algolia.id') }}" api-key="{{ env('ALGOLIA_SEARCH') }}" index-name="well_locations">
    @include("layouts.partials.search._header")
    @include("layouts.partials.search._results")
</ais-index>
@endsection

