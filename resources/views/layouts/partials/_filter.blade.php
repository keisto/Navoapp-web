<div class="filter-results">
    <ais-stats></ais-stats>
    {{--<ais-no-results>--}}
        {{--<template slot-scope="{ result }">--}}
            {{--<h1>No locations found for <i>@{{ result.query }}</i>.</h1>--}}
        {{--</template>--}}
    {{--</ais-no-results>--}}
    {{--:sort-by="['count:desc']">--}}
    <ais-refinement-list attribute-name="state">
        <h3 slot="header">
            <i class="map outline blue icon"></i>
            State
        </h3>
    </ais-refinement-list>

    <ais-refinement-list attribute-name="current_operator" :sort-by="['count:desc']">
        <template slot="header">
            <h3>
                <i class="address card outline purple icon"></i>
                Operator
            </h3>
        </template>
    </ais-refinement-list>

    <ais-refinement-list attribute-name="field_name">
        <h3 slot="header">
            <i class="flag outline green icon"></i>
            Field
        </h3>
    </ais-refinement-list>

    <ais-refinement-list attribute-name="well_type">
        <h3 slot="header">
            <i class="info yellow icon"></i>
            Type
        </h3>
    </ais-refinement-list>
</div>