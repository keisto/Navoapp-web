@if(optional($intersection)->street1)
    <div class="row">
        <div class="eight wide column">
            <h1 class="ui header">
                <i class="map signs brown icon"></i>
                <div class="content">
                    <div class="sub grey header">Nearest Intersection:</div>
                    <span style="color: #838383">A:</span> {{ optional($intersection)->street1 }}
                </div>
            </h1>
        </div>
        <div class="eight wide column">
            <h1 class="ui header">
                <i class="spacer icon"></i>
                <div class="content">
                    <div class="sub grey header"><span style="color: white">.</span></div>
                    <span style="color: #838383">B:</span> {{ optional($intersection)->street2 }}
                </div>
            </h1>
        </div>
    </div>
@elseif ($nearbyStreets != null)
    <div class="row">
        <div class="sixteen wide column">
            <h1 class="ui header">
                <i class="map signs brown icon"></i>
                <div class="content">
                    <div class="sub grey header">Nearby Streets:
                        <span data-tooltip="Intersection not found" data-inverted="">
                                            <i class="icons">
                                                <i class="info circle orange icon"></i>
                                                <i class="corner question orange icon"></i>
                                            </i>
                                        </span>
                    </div>
                    @foreach($nearbyStreets as $i => $v)
                        {{ $v }}
                        @if($loop->iteration != count($nearbyStreets))
                            <span style="color: #838383">,</span>
                        @endif
                    @endforeach
                </div>
            </h1>
        </div>
    </div>
@else
    <div class="row">
        <div class="sixteen wide column">
            <h1 class="ui header">
                <i class="map signs brown icon"></i>
                <div class="content">
                    <div class="sub grey header">
                        Intersection / Nearby Streets:
                    </div>
                    Sorry we where unable to find any streets near this location.
                </div>
            </h1>
        </div>
    </div>
@endif
<div class="row">
    <div class="sixteen wide column">
        <h1 class="ui header">
            <i class="road icon"></i>
            <div class="content">
                <div class="sub grey header">Driving Directions:</div>
                @if($directions == null) No driving directions found. @else From {{ $location->closest_city }}, {{ $location->state }} @endif
            </div>
        </h1>
        @if($directions != null)
            <div class="ui styled fluid accordion">
                @foreach($directions as $route => $k)
                    <div class="title">
                        <i class="dropdown icon"></i>
                        Route {{ $loop->iteration }}
                    </div>
                    <div class="content">
                        @foreach ($k->legs[0]->steps as $step => $v)
                            {{--{{$v->html_instructions}}--}}
                            <p>@php echo(str_replace("<div>", " ", $v->html_instructions)) @endphp - {{ $v->duration->text }} - {{ $v->distance->text }}</p>
                        @endforeach
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>