<div id="search-header" class="page-header">
    <div class="ui center aligned container">
        <div class="ui secondary inverted menu" style="padding-top: 1em; text-shadow: black 0 1px 10px">
            @include("layouts.partials._navigation")
        </div>
        <h2 class="navo-1">Search by <span style="font-weight: normal">well name, operator, etc. automatically. Just start typing</span></h2>
        <h2 class="navo-2" style="font-weight: normal">Search: </h2>
        <div class="ui left icon action input" id="search-input">
            <ais-input type="text" placeholder="Search..." id="wellsearch"></ais-input>
            <i class="search icon"></i>
            <ais-clear class="ui icon yellow button" style="border: 1px solid rgba(34, 36, 38, 0.15)">
                <i class="close icon"></i>
            </ais-clear>
        </div>
    </div>
    <div id="mobile-alert" class="ui floating red icon message">
        <i class="warning icon"></i>
        <i class="close icon"></i>
        <div class="content">
            <div class="header">
                Alert!
            </div>
            <p>This webpage is not optimized for mobile use.</p>
        </div>
    </div>
    <div style="height: 50px; overflow: hidden;" >
        <svg viewBox="0 0 500 150" preserveAspectRatio="none" style="margin-bottom: -1px; position: absolute; bottom: 0; width: 100%; height: 12%;">
            <path d="M0.00,49.98 C149.99,150.00 350.85,-49.98 500.00,49.98 L500.00,150.00 L0.00,150.00 Z" style="stroke: none; fill: #f1f7fa;"></path>
        </svg>
    </div>
</div>