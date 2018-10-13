<div class="six wide column">
    <div class="ui grid">
        <div class="three column row">
            <div class="column">
                <h1 class="ui header">
                    <div class="content">
                        <div class="sub grey header">Township:</div>
                        {{ $location->township  == "" ? "--" : $location->township }}
                    </div>
                </h1>
            </div>
            <div class="column">
                <h1 class="ui header">
                    <div class="content">
                        <div class="sub grey header">Range:</div>
                        {{ $location->range  == "" ? "--" : $location->range }}
                    </div>
                </h1>
            </div>
            <div class="column">
                <h1 class="ui header">
                    <div class="content">
                        <div class="sub grey header">Section:</div>
                        {{ $location->section  == "" ? "--" : $location->section }}
                    </div>
                </h1>
            </div>
        </div>
    </div>
</div>