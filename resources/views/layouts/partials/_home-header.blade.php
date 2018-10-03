<div class="page-header">
    <div class="ui center aligned container">
        <div class="ui secondary inverted menu" style="padding-top: 1em; text-shadow: black 0 1px 10px">
        @include("layouts.partials._navigation")
        </div>
    </div>
    <div class="ui container" style="display: flex; flex-grow: 1; height: 80%; justify-content: center; flex-direction: column;">
        <div style="display: flex; justify-content: space-around; align-items: center;">
            <h1 class="ui jumbotron inline header">
                <img src="{{ asset('images/punit.svg') }}">
                <div class="content">
                    Oil & gas well locator made <u>simple</u>.
                    <div class="sub header" style="color:#f6e7ff !important;">Plans starting at $1.99 / month</div>
                </div>
            </h1>
            <button class="ui yellow inline large button">Sign me up!<i class="right arrow icon"></i></button>
        </div>
    </div>

    <div style="height: 50px; overflow: hidden;" >
        <svg viewBox="0 0 500 150" preserveAspectRatio="none" style="height: 12%; width: 100%; margin-bottom: -1px">
            <path d="M0.00,49.98 C149.99,150.00 350.85,-49.98 500.00,49.98 L500.00,150.00 L0.00,150.00 Z" style="stroke: none; fill: #f1f7fa;"></path>
        </svg>
    </div>
</div>