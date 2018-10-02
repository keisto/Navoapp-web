<div class="ui fluid container padder fluid-results" style="display: none">
    <ais-no-results style="text-align: center"></ais-no-results>
    <div style="display: flex">
        @include("layouts.partials._filter")
        <div style="flex-grow: 1; margin-top: 36px;">
            <ais-results>
                <template slot-scope="{ result }">
                    <a :href="result.id" style="color: #333">
                    <div class="result-row">

                        <div style="width: 32%;">
                            <h3 class="ui header">
                                <i class="folder outline grey-text icon"></i>
                                <div class="content" style="">
                                    <ais-highlight :result="result" attribute-name="well_name"></ais-highlight>
                                    <div class="sub header">API Number: <ais-highlight :result="result" attribute-name="api_number"></ais-highlight></div>
                                </div>
                            </h3>
                        </div>

                        <div style="width: 32%; padding-right: 12px; padding-left: 12px">
                            <i class="address card outline purple icon"></i>
                            <ais-highlight :result="result" attribute-name="current_operator"></ais-highlight>
                        </div>

                        <div style="width: 18%">
                            <i class="flag outline green icon"></i>
                            <ais-highlight :result="result" attribute-name="field_name"></ais-highlight>
                        </div>
                        <div style="width: 18%; text-align: right">
                            <div class="ui yellow image mini label">
                                <i class="info icon" style="padding-left: 10px"></i>
                                <div class="detail" style="font-weight: normal;padding-top: 6px;">@{{ result.well_type }}</div>
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