<div class="ui secondary inverted my-account menu" style="margin-bottom: 0">
    <div class="ui container">
        @include('layouts.partials._navigation')
    </div>
</div>
@if ($location->latitude != "0")
    <div class="page-header" id="map" style="border-bottom: 1px solid #c0c1c2" class="computer only">
        <div style="height: 50px; overflow: hidden;" >
            <svg viewBox="0 0 500 150" preserveAspectRatio="none" style="height: 12%; width: 100%; margin-bottom: -1px">
                <path d="M0.00,49.98 C149.99,150.00 350.85,-49.98 500.00,49.98 L500.00,150.00 L0.00,150.00 Z" style="stroke: none; fill: #f1f7fa;"></path>
            </svg>
        </div>
    </div>
    <div class="ui container" style="margin-top: 12px; margin-bottom: 44px;">
        @else
            <div class="page-header">
                <div class="ui center aligned container">
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