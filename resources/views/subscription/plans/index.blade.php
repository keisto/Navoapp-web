@extends('layouts.app')
@section('content')
    @include('layouts.partials._home-header')
    <div class="ui padder container">
        <div class="ui secondary menu">
            <a class="item active" data-tab="solo"><i class="user icon"></i> Individual</a>
            <a class="item" data-tab="team"><i class="group icon"></i> Teams <span class="ui green label"><i class="thumbs up icon"></i> Businesses!</span></a>
        </div>

        <div class="ui active tab" data-tab="solo">
            <div class="ui stackable grid">
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
                                <a href="{{ route('subscription.index') }}?plan=basic-monthly" class="ui blue button">$3.99 - Monthly</a>
                                <div class="or"></div>
                                <a href="{{ route('subscription.index') }}?plan=basic-yearly" class="ui green button">$39.90 - Yearly</a>
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
                                        <a onclick="$('.ui.modal').modal('show');" style="text-decoration: underline; color: #838383">Additional Notes</a>
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
                                <a href="{{ route('subscription.index') }}?plan=super-monthly" class="ui blue button">$4.99 - Monthly</a>
                                <div class="or"></div>
                                <a href="{{ route('subscription.index') }}?plan=super-yearly" class="ui green button">$49.90 - Yearly</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="ui small modal">
            <i class="close icon"></i>
            <div class="header">
                One Call Information:
            </div>
            <div class="image content">
                @if ((new Jenssegers\Agent\Agent)->isDesktop() || (new Jenssegers\Agent\Agent)->isTablet())
                    <div class="ui medium image">
                        <img src="{{ asset('images/dig.svg') }}">
                    </div>
                @endif
                <div class="description">
                    <h4 class="ui header">
                        <i class="hashtag blue mini icon"></i>
                        Section, Range, Township:
                    </h4>
                    <p>Section, range, and township may not always be provided.</p>
                    <h4 class="ui header">
                        <i class="map signs brown mini icon"></i>
                        Nearest Intersection:
                    </h4>
                    <p>We first try to provide the nearest intersection, but if that cannot be found we will give you a list of nearby streets.</p>
                    <h4 class="ui header">
                        <i class="road mini icon"></i>
                        Driving Direction:
                    </h4>
                    <p>Driving are based from off of Google's mapping and should be looked over as some lease roads may not be recognized.</p>
                    <p style="color:#838383;">If this becomes a problem, please contact our <a href="mailto:tony@navoapp.io">support</a>.</p>
                </div>
            </div>
            <div class="actions">
                <div class="ui positive center labeled icon button">
                    Okay
                    <i class="checkmark icon"></i>
                </div>
            </div>
        </div>
        <div class="ui tab" data-tab="team">
            <div class="ui stackable grid">
                <div class="ui sixteen wide wide column">
                    <div class="ui segment">
                        <h2 class="ui header">
                            <img src="{{ asset('images/level3.svg') }}">
                            <div class="content">
                                Team Locator - 10 Members
                                <div class="sub header">You can add more later ($4.99/user/month)</div>
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
                            <div class="item" style="display: flex;">
                                <img class="ui avatar image" style="border-radius: 0" src="{{ asset('images/shovel.svg') }}">
                                <div class="content">
                                    <span class="header">One Call Information</span>
                                    <div class="description">View section, range, township, closest city, nearest intersection and driving directions form closest city.
                                        <a onclick="$('.ui.modal').modal('show');" style="text-decoration: underline; color: #838383">Additional Notes</a>
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
                            <div class="item">
                                <div class="right floated content">
                                    <div class="ui red label">Team Bonus</div>
                                </div>
                                <img class="ui avatar image" style="border-radius: 0" src="{{ asset('images/group.svg') }}">
                                <div class="content">
                                    <span class="header">Group Effort</span>
                                    <div class="description">See all team member's location favorites and notes.</div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="right floated content">
                                    <div class="ui red label">Team Bonus</div>
                                </div>
                                <img class="ui avatar image" style="border-radius: 0" src="{{ asset('images/text-message.svg') }}">
                                <div class="content">
                                    <span class="header">Improved Share Experience</span>
                                    <div class="description">Rapidly select multiple team members to share a location (via text message).</div>
                                </div>
                            </div>
                        </div>
                        <div style="text-align: center">
                            <div class="ui buttons">
                                <a href="{{ route('subscription.index') }}?plan=team-monthly" class="ui blue button">$49.90 - Monthly</a>
                                <div class="or"></div>
                                <a href="{{ route('subscription.index') }}?plan=team-yearly" class="ui green button">$499.00 - Yearly</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection