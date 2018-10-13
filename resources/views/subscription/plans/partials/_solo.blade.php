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
                            <div class="description">Leave notes on location profiles.</div>
                        </div>
                    </div>
                </div>
                <div style="text-align: center">
                    <div class="ui buttons">
                        <a href="{{ route('subscription.index') }}?plan=super-monthly" class="ui blue button">$5.99 - Monthly</a>
                        <div class="or"></div>
                        <a href="{{ route('subscription.index') }}?plan=super-yearly" class="ui green button">$59.90 - Yearly</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>