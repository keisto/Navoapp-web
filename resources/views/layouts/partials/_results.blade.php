<div class="ui fluid container padder fluid-results" style="{{ $agent->isDesktop() ? "display:none;" : "padding-left:12px; padding-right:12px" }}">
    <ais-no-results style="text-align: center"></ais-no-results>
    <div style="display: flex">
        @include("layouts.partials._filter")
        <div style="flex-grow: 1; {{ $agent->isDesktop() ? "margin-top:36px" : "margin-top:0" }}">
            <ais-results>
                <template slot-scope="{ result }">
                    <a :href="result.id" style="color: #333">
                    <div class="result-row {{ !$agent->isDesktop() ? "ui segment" : "" }}" style="{{ !$agent->isDesktop() ? "margin-bottom:6px" : "" }}">
                        <div class="ui stackable grid" style="width: 100%">
                            <div class="seven wide column">
                                <h3 class="ui header">
                                    <i class="folder outline grey-text icon"></i>
                                    <div class="content" style="">
                                        <ais-highlight :result="result" attribute-name="well_name"></ais-highlight>
                                        <div class="sub header">API Number: <ais-highlight :result="result" attribute-name="api_number"></ais-highlight></div>
                                    </div>
                                </h3>
                            </div>
                            <div class="nine wide column">
                                <div class="ui fluid grid">
                                    <div class="nine wide mobile only nine wide tablet only six wide computer only column">
                                        <i class="address card outline purple icon"></i>
                                        <ais-highlight :result="result" attribute-name="current_operator"></ais-highlight>
                                    </div>

                                    <div class="seven wide mobile only seven wide tablet only five wide computer only column">
                                        <i class="flag outline green icon"></i>
                                        <ais-highlight :result="result" attribute-name="field_name"></ais-highlight>
                                    </div>
                                    <div class="five wide computer only center aligned column">
                                        <div class="ui yellow image mini label">
                                            <i class="info icon" style="padding-left: 10px"></i>
                                            <div class="detail" style="font-weight: normal;padding-top: 6px;">@{{ result.well_type }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </a>
                </template>
            </ais-results>


            <ais-pagination></ais-pagination>
        </div>
    </div>
</div>