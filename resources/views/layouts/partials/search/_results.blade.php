<div class="ui fluid container padder fluid-results" style="{{ $agent->isDesktop() ? "" : "padding-left:12px; padding-right:12px" }}">
    <ais-no-results style="text-align: center"></ais-no-results>
    <div style="display: flex; {{ !$agent->isDesktop() ? "flex-direction: column" : "" }}" >
        @include("layouts.partials.search._filter")
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
                                        <ais-highlight :result="result" attribute-name="name"></ais-highlight>
                                        <div class="sub header">API Number: <ais-highlight :result="result" attribute-name="api"></ais-highlight></div>
                                    </div>
                                </h3>
                            </div>
                            <div class="nine wide column">
                                <div class="ui fluid grid">
                                    <div class="nine wide mobile only nine wide tablet only six wide computer only column">
                                        <i class="address card outline violet icon"></i>
                                        <ais-highlight :result="result" attribute-name="operator"></ais-highlight>
                                    </div>

                                    <div class="seven wide mobile only seven wide tablet only five wide computer only column">
                                        <i class="flag outline green icon"></i>
                                        <ais-highlight :result="result" attribute-name="field"></ais-highlight>
                                    </div>
                                    <div class="five wide computer only center aligned column">
                                        <div class="ui yellow mini label">
                                            <span style="font-weight: normal;padding-top: 6px;">@{{ result.type }}</span>
                                        </div>
                                        <div class="ui mini label">
                                            <span style="font-weight: normal;padding-top: 6px;">@{{ result.status }}</span>
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
            <ais-stats></ais-stats>
        </div>
    </div>
</div>