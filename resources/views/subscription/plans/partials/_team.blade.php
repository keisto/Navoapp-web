<div class="ui tab" data-tab="team">
    <div class="ui green segment" style="display: flex; justify-content: center">
        <h4 class="ui header">
            <i class="money bill alternate outline icon"></i>
            <div class="content">
                Yearly plans get <u>2 MONTHS FREE!</u>
            </div>
        </h4>
    </div>
    <div class="ui stackable grid">
        <div class="ui sixteen wide wide column">
            <div class="ui segment">
                <h2 class="ui header">
                    <img src="{{ asset('images/level3.svg') }}">
                    <div class="content">
                        Team Locator - 5 Members
                        <div class="sub header">You can add more members later ($7.99/member/month)</div>
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
                                <a onclick="$('#modal_onecall').modal('show');" style="text-decoration: underline; color: #838383">Additional Notes</a>
                            </div>
                        </div>
                    </div>
                    <div class="item" style="display: flex;">
                        <img class="ui avatar image" style="border-radius: 0" src="{{ asset('images/notes.svg') }}">
                        <div class="content">
                            <span class="header">Add location notes</span>
                            <div class="description">Leave notes on location profiles. Each team member's notes will be visible to the team.</div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="right floated content">
                            <div class="ui red label">Team Bonus</div>
                        </div>
                        <img class="ui avatar image" style="border-radius: 0" src="{{ asset('images/group.svg') }}">
                        <div class="content">
                            <span class="header">Group Effort</span>
                            <div class="description">See all team member's location notes.</div>
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
                        <a href="{{ route('subscription.index') }}?plan=team-monthly" class="ui blue button">$39.95 - Monthly</a>
                        <div class="or"></div>
                        <a href="{{ route('subscription.index') }}?plan=team-yearly" class="ui green button">$399.50 - Yearly</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>