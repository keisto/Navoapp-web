@if(!$agent->isDesktop())
@include("layouts.partials.search._mobile")
@else
<div class="filter-results">
    <ais-stats></ais-stats>
    <ais-refinement-list attribute-name="state">
        <h3 slot="header">
            <i class="map outline blue icon"></i>
            State
        </h3>
    </ais-refinement-list>

    <ais-refinement-list attribute-name="operator" :sort-by="['count:desc']">
        <template slot="header">
            <h3>
                <i class="address card outline violet icon"></i>
                Operator
            </h3>
        </template>
    </ais-refinement-list>

    <ais-refinement-list attribute-name="field">
        <h3 slot="header">
            <i class="flag outline green icon"></i>
            Field
        </h3>
    </ais-refinement-list>

    <ais-refinement-list attribute-name="type">
        <h3 slot="header">
            <i class="info yellow icon"></i>
            Type
        </h3>
    </ais-refinement-list>
    <ais-refinement-list attribute-name="status">
        <h3 slot="header">
            <i class="question grey icon"></i>
            Status
        </h3>
    </ais-refinement-list>
</div>
@endif