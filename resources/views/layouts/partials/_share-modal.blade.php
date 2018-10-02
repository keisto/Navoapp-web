<div class="ui modal">
    <div class="header">
        Share Location: {{ $location->well_name }}
    </div>
    <div class="ui stackable grid" style="padding: 20px">
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
            <div class="ui form">
                <div class="field">
                    <label>Text Message</label>
                    <textarea id="text-message" readonly="" style="margin: 0 auto; height: 297px;" placeholder="Use checkboxes to build message">
                            {{--Load message content by checkboxes--}}
                        </textarea>
                </div>
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
        <button id="send_button" type="submit" class="ui positive right labeled icon disabled button">
            Send Text Message
            <i class="send outline icon"></i>
        </button>
    </div>
</div>