<div class="page-header" style="background-color: #FDBB46;">
    <div class="ui center aligned container">
        <div class="ui secondary inverted menu" style="padding-top: 1em;">
        @include("layouts.partials._navigation")
        </div>
    </div>
    <div class="ui container" style="display: flex; flex-grow: 1; height: 80%; justify-content: center; flex-direction: column;">
        <div id="home-header" style="display: flex; justify-content: space-around; align-items: center;">
            <h1 class="ui jumbotron inline header" >
                {{-- <img src="{{ asset('images/navo-logo.svg') }}"> --}}
                <div class="content">
                    <h1 class="ui medium header">Oil & Gas Well locator made <u>simple</u>.</h1>
                    <div class="sub header" style="text-align: right; color:rgba(0,0,0,0.7) !important;">...and for free</div>
                    <a href="https://itunes.apple.com/us/app/navo/id1372593466?ls=1&mt=8" target="_blank"><img src="{{ asset('images/icon-ios.svg') }}" width="135px" /></a>
                </div>
            </h1>

        </div>
    </div>

    <div style="height: 50px; overflow: hidden;" >
        <svg viewBox="0 0 500 150" preserveAspectRatio="none"
             style="margin-bottom: -1px; position: absolute; bottom: 0; width: 100%; height: 12%;">
            <path d="M0.00,49.98 C149.99,150.00 350.85,-49.98 500.00,49.98 L500.00,150.00 L0.00,150.00 Z" style="stroke: none; fill: white;"></path>
        </svg>
    </div>
</div>
