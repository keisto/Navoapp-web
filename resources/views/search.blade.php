@extends('layouts.app')
@section('content')
<ais-index app-id="{{ config('scout.algolia.id') }}" api-key="{{ env('ALGOLIA_SEARCH') }}" index-name="locations">
    @include("layouts.partials.search._header")
    @include("layouts.partials.search._results")
</ais-index>
@endsection
@section('scripts')
    <script>
        $('#mobile-filter').slideToggle();
        $('#filter-toggle').css({'margin-bottom': 0});
        function filtersMenu() {
            $('#mobile-filter').slideToggle(function() {
                if ($('#filter-toggle').css('margin-bottom') == '0px') {
                    $('#filter-toggle').css('margin-bottom', '1rem');
                } else {
                    $('#filter-toggle').css({'margin-bottom': 0});
                }
            });
        }
    </script>
@endsection
