<div class="ui accordion fluid secondary segment">
    <h4 id="filter-toggle" class="ui header" onclick="filtersMenu();" style="width: 100%">
        <i class="filter small icon"></i>
        <div class="content">
        Filters
        </div>
    </h4>
    <div id="mobile-filter">
    <div class="item" style="padding-top: 6px; padding-bottom: 6px">
        <a class="title" style="width: 100%; display: inline-block">
            <i class="dropdown icon"></i>
            <i class="map outline blue  icon"></i>
            State
        </a>
        <div class="content">
            <ais-refinement-list attribute-name="state"></ais-refinement-list>
        </div>
    </div>
    <div class="item" style="padding-top: 6px; padding-bottom: 6px">
        <a class="title" style="width: 100%; display: inline-block">
            <i class="dropdown icon"></i>
            <i class="address card outline violet icon"></i>
            Operator
        </a>
        <div class="content">
            <ais-refinement-list attribute-name="operator" :sort-by="['count:desc']"></ais-refinement-list>
        </div>
    </div>
    <div class="item" style="padding-top: 6px; padding-bottom: 6px">
        <a class="title" style="width: 100%; display: inline-block">
            <i class="dropdown icon"></i>
            <i class="flag outline green icon"></i>
            Field
        </a>
        <div class="content">
            <ais-refinement-list attribute-name="field"></ais-refinement-list>
        </div>
    </div>

    <div class="item" style="padding-top: 6px; padding-bottom: 6px">
        <a class="title" style="width: 100%; display: inline-block">
            <i class="dropdown icon"></i>
            <i class="info yellow icon"></i>
            Type
        </a>
        <div class="content">
            <ais-refinement-list attribute-name="type"></ais-refinement-list>
        </div>
    </div>

    <div class="item" style="padding-top: 6px; padding-bottom: 6px">
        <a class="title" style="width: 100%; display: inline-block">
            <i class="dropdown icon"></i>
            <i class="question grey icon"></i>
            Status
        </a>
        <div class="content">
            <ais-refinement-list attribute-name="status"></ais-refinement-list>
        </div>
    </div>
    </div>
</div>
