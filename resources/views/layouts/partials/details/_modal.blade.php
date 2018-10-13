<div class="ui modal">
    <div class="header">
        <img class="ui floated left image" src="{{ asset('images/text-message.svg') }}" height="32px"/>
        Send Location: {{ $location->well_name }} to:
    </div>
    <div style="padding: 20px">
        <div class="ui placeholder segment" style="background-color: #f1f1f1">
            <div class="ui two column very relaxed stackable grid">
                <div class="column">
                    <div class="ui form">
                        <div class="field">
                            <label style="display: inline-block">Team members</label>
                            <a id="team_select" style="float: right; margin-right: 5px">Select All</a>
                            <select multiple="" class="ui fluid search dropdown">
                                <option value="">Select Country</option>
                                <option value="AF">Afghanistan</option>
                                <option value="AX">Åland Islands</option>
                                <option value="AL">Albania</option>
                                <option value="DZ">Algeria</option>
                                <option value="AS">American Samoa</option>
                                <option value="AD">Andorra</option>
                                <option value="AO">Angola</option>
                                <option value="AI">Anguilla</option>
                                <option value="AQ">Antarctica</option>
                                <option value="AG">Antigua and Barbuda</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="ui @if ((new Jenssegers\Agent\Agent)->isDesktop() || (new Jenssegers\Agent\Agent)->isTablet()) vertical @else horizontal @endif divider">
                    And
                </div>
                <div class="column">
                    <div class="ui form">
                        <div class="transparent field">
                            <label>Phone Number(s)</label>
                            <textarea type="text" name="first-name" placeholder="Use commas (Ex: 123-456-7890, 123-456-7890)" rows="1"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="ui stackable grid">
            <div class="six wide column">
                <div class="ui form">
                    <div class="inline field">
                        <div class="ui checkbox">
                            <input id="well_name" type="checkbox" tabindex="0" class="hidden" checked>
                            <label>Location/Well Name</label>
                        </div>
                    </div>
                    <div class="inline field">
                        <div class="ui checkbox">
                            <input id="well_api" type="checkbox" tabindex="0" class="hidden">
                            <label>API Number</label>
                        </div>
                    </div>
                    <div class="inline field">
                        <div class="ui checkbox">
                            <input id="well_operator" type="checkbox" tabindex="0" class="hidden">
                            <label>Current Operator</label>
                        </div>
                    </div>
                    <div class="inline field">
                        <div class="ui checkbox">
                            <input id="well_location" type="checkbox" tabindex="0" class="hidden">
                            <label>Nearest City, State</label>
                        </div>
                    </div>
                    <div class="inline field">
                        <div class="ui checkbox">
                            <input id="well_latlon" type="checkbox" tabindex="0" class="hidden" checked>
                            <label>Latitude, Longitude</label>
                        </div>
                    </div>
                    <div class="inline field">
                        <div class="ui checkbox">
                            <input id="apple_device" type="checkbox" tabindex="0" class="hidden" checked>
                            <label>iOS Device Map Link</label>
                        </div>
                    </div>
                    <div class="inline field">
                        <div class="ui checkbox">
                            <input id="android_device" type="checkbox" tabindex="0" class="hidden" checked>
                            <label>Android Device Map Link</label>
                        </div>
                    </div>
                    <div class="field">
                        <label>Additional Notes</label>
                        <textarea id="well_notes" rows="2" placeholder="Notes"></textarea>
                    </div>
                </div>
            </div>
            <div class="ten wide column">
                <form id="message-form" action="{{ route('location.share.message.store') }}" method="POST">
                    @csrf
                    <div class="ui form">
                        <div class="field">
                            <label>Text Message</label>
                            <textarea id="text-message" name="message" readonly="" style="margin: 0 auto; height: 297px;" placeholder="Use checkboxes to build message">
                                {{--Load message content by checkboxes--}}
                            </textarea>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="actions">
        <div class="ui deny left floated icon black button">
            <i class="times icon"></i>
            Cancel
        </div>
        <button id="copy_button" onclick="copyMessage();" class="ui yellow left labeled icon disabled button"
            data-tooltip="Copy Message" data-inverted="">
            <i class="copy outline icon"></i>
            Copy Text
        </button>
        <button id="send_button" type="submit" form="message-form" class="ui positive right labeled icon disabled button">
            Send Text Message
            <i class="send outline icon"></i>
        </button>
    </div>
</div>