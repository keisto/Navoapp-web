@extends('layouts.app')
@section('content')
    @include('layouts.partials._home-header')
    <div class="ui padder container">
        <div class="ui grid">
            <div class="ui eight wide column">
                <div class="ui segment">
                    <h2 class="ui header">
                        <img src="{{ asset('images/level1.svg') }}">
                        <div class="content">
                            Basic Locator
                            <div class="sub header">7 Day Free Trial</div>
                        </div>
                    </h2>
                    <div class="ui relaxed divided list" style="margin: 2em 0;">
                        <div class="item" style="display: flex;">
                            <img class="ui avatar image" style="border-radius: 0" src="{{ asset('images/search-location.svg') }}">
                            <div class="content">
                                <span class="header">Dynamic Searching</span>
                                <div class="description">Our search will allow mistakes. Search multiple values (well name, api #, operator, etc.) just by adding a space or use the filters.</div>
                            </div>
                        </div>
                        <div class="item" style="display: flex;">
                            <img class="ui avatar image" style="border-radius: 0" src="{{ asset('images/history-location.svg') }}">
                            <div class="content">
                                <span class="header">Location History</span>
                                <div class="description">This will store every location you visit.</div>
                            </div>
                        </div>
                        <div class="item" style="display: flex;">
                            <img class="ui avatar image" style="border-radius: 0" src="{{ asset('images/favorite-location.svg') }}">
                            <div class="content">
                                <span class="header">Add Locations to Favorites</span>
                                <div class="description">Quickly find locations you need to view or visit again.</div>
                            </div>
                        </div>
                    </div>
                    <div style="text-align: center">
                        <div class="ui buttons">
                            <button class="ui blue button">Monthly</button>
                            <div class="or"></div>
                            <button class="ui green button">Yearly</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ui eight wide column">
                <div class="ui segment">
                    <h2 class="ui header">
                        <img src="{{ asset('images/level2.svg') }}">
                        <div class="content">
                            Superior Locator
                            <div class="sub header"></div>
                        </div>
                    </h2>
                    <div class="ui relaxed divided list" style="margin: 2em 0;">
                        <div class="item" style="display: flex;">
                            <img class="ui avatar square image" style="border-radius: 0" src="{{ asset('images/level1.svg') }}">
                            <div class="content">
                                <span class="header">Everything from <u>Basic Locator</u></span>
                                <div class="description">Allows searching, view history, and save favorites.</div>
                            </div>
                        </div>
                        <div class="item" style="display: flex;">
                            <img class="ui avatar image" style="border-radius: 0" src="{{ asset('images/shovel.svg') }}">
                            <div class="content">
                                <span class="header">One Call Information</span>
                                <div class="description">View section, range, township, closest city, nearest intersection and driving directions form closest city.
                                    <span data-tooltip="One call information may not always be provided due to the locations status.
                                    Driving are based from off of Google's mapping and should be looked over as some lease roads may not be recognized."
                                          data-variation="wide" data-inverted="">
                                        <i class="icons">
                                            <i class="info circle orange icon"></i>
                                            <i class="corner question orange icon"></i>
                                        </i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="item" style="display: flex;">
                            <img class="ui avatar image" style="border-radius: 0" src="{{ asset('images/notes.svg') }}">
                            <div class="content">
                                <span class="header">Add location notes</span>
                                <div class="description">View section, range, township, closest city, nearest intersection and driving directions form closest city.</div>
                            </div>
                        </div>
                    </div>
                    <div style="text-align: center">
                        <div class="ui buttons">
                            <button class="ui blue button">Monthly</button>
                            <div class="or"></div>
                            <button class="ui green button">Yearly</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="ui secondary menu">
            <a class="item active" data-tab="solo">Individual</a>
            <a class="item" data-tab="team">Teams <span class="ui green label"><i class="thumbs up icon"></i> Businesses!</span></a>
        </div>
        <div class="ui tab segment active" data-tab="solo">
            <ul>
                <div class="ui relaxed divided list">
                    @foreach($soloPlans as $plan)
                        <div class="item">
                            <div class="right floated content">
                                <a href="{{ route('subscription.index') }}?plan={{ $plan->slug }}"
                                   class="ui green button">
                                    Pay: $ {{ $plan->price }} - {{ $plan->recurring }}</a>
                            </div>

                            @if ($plan->name == "Basic Locator")
                                <i class="large chess pawn middle aligned icon"></i>
                            @endif
                            @if ($plan->name == "Superior Locator")
                                <i class="large chess knight middle aligned icon"></i>
                            @endif
                            @if (explode(' ',$plan->name)[0] == "Team")
                                <i class="large chess chess middle aligned icon"></i>
                            @endif

                            <div class="content">
                                <a class="header">{{ $plan->name }}</a>
                                @if($plan->recurring == 'yearly')
                                    <div class="description">{{ $plan->description }} - <span class="ui blue mini label">Get 2 Months FREE!</span></div>
                                @else
                                    <div class="description">{{ $plan->description }}</div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </ul>
        </div>

        <div class="ui tab segment" data-tab="team">
            <ul>
                <div class="ui relaxed divided list">
                    @foreach($teamPlans as $plan)
                        <div class="item">
                            <div class="right floated content">
                                <a href="{{ route('subscription.index') }}?plan={{ $plan->slug }}"
                                   class="ui green button">
                                    Pay: $ {{ $plan->price }} - {{ $plan->recurring }}</a>
                            </div>

                            @if ($plan->name == "Basic Locator")
                                <i class="large chess pawn middle aligned icon"></i>
                            @endif
                            @if ($plan->name == "Superior Locator")
                                <i class="large chess knight middle aligned icon"></i>
                            @endif
                            @if (explode(' ',$plan->name)[0] == "Team")
                                <i class="large chess chess middle aligned icon"></i>
                            @endif

                            <div class="content">
                                <a class="header">{{ $plan->name }}</a>
                                @if($plan->recurring == 'yearly')
                                    <div class="description">{{ $plan->description }} - <span class="ui blue mini label">Get 2 Months FREE!</span></div>
                                @else
                                    <div class="description">{{ $plan->description }}</div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </ul>
        </div>

        <div class="ui modal">
            <i class="close icon"></i>
            <div class="header">
                Profile Picture
            </div>
            <div class="image content">
                <div class="ui medium image">
                    <img src="/images/avatar/large/chris.jpg">
                </div>
                <div class="description">
                    <div class="ui header">We've auto-chosen a profile image for you.</div>
                    <p>We've grabbed the following image from the <a href="https://www.gravatar.com" target="_blank">gravatar</a> image associated with your registered e-mail address.</p>
                    <p>Is it okay to use this photo?</p>
                </div>
            </div>
            <div class="actions">
                <div class="ui black deny button">
                    Nope
                </div>
                <div class="ui positive right labeled icon button">
                    Yep, that's me
                    <i class="checkmark icon"></i>
                </div>
            </div>
        </div>
    </div>
@endsection
