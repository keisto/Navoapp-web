<div class="row">
    <div class="column">
        <h1 class="ui header">
            <i class="open folder outline blue icon"></i>
            <div class="content">
                <div class="sub grey header">Well Name:</div>
                {{ $location->well_name == "" ? "Not found" : title_case($location->well_name) }}
            </div>
        </h1>
    </div>
    <div class="column">
        <h1 class="ui header">
            <i class="hashtag teal icon"></i>
            <div class="content">
                <div class="sub grey header">API Number:</div>
                {{ $location->api_number == "" ? "Not found" : $location->api_number  }}
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
                {{ $location->current_operator  == "" ? "Not found" : title_case($location->current_operator) }}
            </div>
        </h1>
    </div>
    <div class="column">
        <h1 class="ui header">
            <i class="info yellow icon"></i>
            <div class="content">
                <div class="sub grey header">Well Type:</div>
                {{ $location->well_type == "" ? "not found" : title_case($location->well_type) }}
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
                    {{ $location->closest_city  == "" ? "" : "City, " }}
                    State -
                    @hasonecall
                    {{ $location->county_name  == "" ? "" : "County, " }}
                    @endhasonecall
                    Country:</div>
                {{ $location->closest_city  == "" ? "" : $location->closest_city . ", " }}
                {{ $location->state  == "" ? "" : $location->state }}
                @hasonecall
                {{ $location->county_name  == "" ? "" : "- " . title_case($location->county_name) . " County "}}
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