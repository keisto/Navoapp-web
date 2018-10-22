<div class="row">
    <div class="column">
        <h1 class="ui header">
            <i class="open folder outline blue icon"></i>
            <div class="content">
                <div class="sub grey header">Well Name:</div>
                {{ $location->name == "" ? "Not found" : title_case($location->name) }}
            </div>
        </h1>
    </div>
    <div class="column">
        <h1 class="ui header">
            <i class="hashtag teal icon"></i>
            <div class="content">
                <div class="sub grey header">API Number:</div>
                {{ $location->api == "" ? "Not found" : $location->api  }}
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
                {{ $location->operator  == "" ? "Not found" : title_case($location->operator) }}
            </div>
        </h1>
    </div>
    <div class="column">
        <h1 class="ui header">
            <i class="info yellow icon"></i>
            <div class="content">
                <div class="sub grey header">Well Type:</div>
                {{ $location->type == "" ? "not found" : title_case($location->type) }}
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
                    {{ $location->city  == "" ? "" : "City, " }}
                    State -
                    @hasonecall
                    {{ $location->county  == "" ? "" : "County, " }}
                    @endhasonecall
                    Country:</div>
                {{ $location->city  == "" ? "" : $location->city . ", " }}
                {{ $location->state  == "" ? "" : $location->state }}
                @hasonecall
                {{ $location->county  == "" ? "" : "- " . title_case($location->county) . " County "}}
                @endhasonecall
                <i style="position: relative; top: -4px" class="{{ $location->country  == "" ? "united states" : strtolower($location->country) }} flag"></i>
            </div>
        </h1>
    </div>
    <div class="four wide computer six wide tablet center aligned column">
        <a class="ui blue labeled icon button" target="_blank" href="https://www.google.com/maps/search/?api=1&query={{ $location->latitude }},{{ $location->longitude }}">
            <i class="google icon"></i>
            Open in Google Maps
        </a>
    </div>
</div>