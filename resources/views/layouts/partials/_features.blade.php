<h4 id="features" class="ui horizontal divider header padder">
    <i class="list icon"></i> Features
</h4>
<div class="ui centered cards">
    <div class="ui card">
        <div class="content">
            <img src="{{ asset('images/friendly.svg') }}" style="width: 32px" class="ui floated left image">
            <div class="header">User Friendly</div>
            <div class="meta">All around</div>
            <div class="description">
                Beautiful user interface and experience for mobile and web.
            </div>
        </div>
    </div>
    <div class="ui card nav">
        <div class="content">
            <img src="{{ asset('images/pin-near.svg') }}" style="width: 32px" class="ui floated left image">
            <div class="header">Share</div>
            <div class="meta">By text or email</div>
            <div class="description">
                Send well info containing a link to begin navigation.
            </div>
        </div>
    </div>
    {{-- <div class="ui card">
        <div class="content">
            <img src="{{ asset('images/apple.svg') }}" style="width: 32px" class="ui floated left image">
            <div class="header">Mobile App</div>
            <div class="meta">Version 1.0</div>
            <div class="description">
                Mobile app on <strong>ALL</strong> <u>iOS</u> Devices. <span style="color: indianred;">Version 1 only contains North Dakota.</span>
            </div>
        </div>
    </div> --}}
    <div class="ui card">
        <div class="content">
            <img src="{{ asset('images/update.svg') }}" style="width: 32px" class="ui floated left image">
            <div class="header">Well Updates</div>
            <div class="meta">Every month</div>
            <div class="description">
                Stay up to date on status changes and new wells added.
            </div>
        </div>
    </div>
    <div class="ui card">
        <div class="content">
            <img src="{{ asset('images/shovel.svg') }}" style="width: 32px" class="ui floated left image">
            <div class="header">One Call Information</div>
            <div class="meta"><a onclick="$('#modal_onecall').modal('show');" style="text-decoration: underline; color: #838383">View example</a></div>
            <div class="description">
                View nearest city, section, range, and township of the well.
            </div>
        </div>
    </div>
    {{-- <div class="ui card">
        <div class="content">
            <div class="ui right floated green mini label">Various Plans</div>
            <img src="{{ asset('images/bill.svg') }}" style="width: 32px" class="ui floated left image">
            <div class="header">Subscriptions</div>
            <div class="meta">Individual & Teams</div>
            <div class="description">
                Select favorites, store history, add notes, send via text or copy for email.
            </div>
        </div>
    </div> --}}
</div>

<h4 class="ui horizontal divider header padder">
    <i class="bullhorn icon"></i> Coming Soon
</h4>

<div class="ui centered cards">
    <div class="ui card">
        <div class="content">
            <div class="ui right floated red mini label">High Priority</div>
            <img src="{{ asset('images/android.svg') }}" style="width: 32px" class="ui floated left image">
            <div class="header">Mobile App</div>
            <div class="meta">Version 1.0</div>
            <div class="description">
                Mobile app on <strong>ALL</strong> <u>Android</u> Devices.
            </div>
        </div>
    </div>
    {{-- <div class="ui card">
        <div class="content">
            <div class="ui right floated red mini label">High Priority</div>
            <img src="{{ asset('images/apple.svg') }}" style="width: 32px" class="ui floated left image">
            <div class="header">Mobile App</div>
            <div class="meta">Version 2.0</div>
            <div class="description">
                Mobile app on <strong>ALL</strong> <u>iOS</u> Devices.
            </div>
        </div>
    </div>
    <div class="ui card">
        <div class="content">
            <div class="ui right floated yellow mini label">Medium Priority</div>
            <img src="{{ asset('images/export.svg') }}" style="width: 32px" class="ui floated left image">
            <div class="header">Export Data</div>
            <div class="meta">By each State</div>
            <div class="description">
                Choose between JSON, XML, and CSV formats.
            </div>
        </div>
    </div> --}}
    <div class="ui card">
        <div class="content">
            <img src="{{ asset('images/navigation.svg') }}" style="width: 32px" class="ui floated left image">
            <div class="ui right floated yellow mini label">Medium Priority</div>
            <div class="header">Navigation</div>
            <div class="meta">Turn by Turn</div>
            <div class="description">
                Currently this defaults to whatever GPS navigator you have installed with your phone.
            </div>
        </div>
    </div>
    {{-- <div class="ui card">
        <div class="content">
            <img src="{{ asset('images/analytics.svg') }}" style="width: 32px" class="ui floated left image">
            <div class="header">Well Analytics</div>
            <div class="meta">Stats & graphs</div>
            <div class="description">
                View well production information in the best ways possible!
            </div>
        </div>
    </div> --}}
    <div class="ui card">
        <div class="content">
            <img src="{{ asset('images/more.svg') }}" style="width: 32px" class="ui floated left image">
            <div class="header">And More!</div>
            <div class="meta">Looking for more info?</div>
            <div class="description">
                <a href="mailto:feedback@navoapp.io">Email any requests or suggestions!</a>
            </div>
        </div>
    </div>
</div>
<div class="ui small modal" id="modal_onecall">
    <i class="close icon"></i>
    <div class="header">
        One Call Information:
    </div>
    <div class="image content">
        @if ((new Jenssegers\Agent\Agent)->isDesktop() || (new Jenssegers\Agent\Agent)->isTablet())
            <div class="ui medium image">
                <img src="{{ asset('images/dig.svg') }}">
            </div>
        @endif
        <div class="description">
            <h4 class="ui header">
                <i class="hashtag blue mini icon"></i>
                Section, Range, Township:
            </h4>
            <p>Section, Quarter, Range, and Township common details when submitting a dig request to your state.</p>
            <h4 class="ui header">
                <i class="map outline violet mini icon"></i>
                Location County Name
            </h4>
            <p>Show county name with City, State.</p>
            <h4 class="ui header">
                <i class="map signs brown mini icon"></i>
                <span class="ui green mini label" style="float: right">Coming Soon</span>
                Nearest Intersection:
            </h4>
            <p>We first try to provide the nearest intersection, but if that cannot be found we will give you a list of nearby streets.</p>
            <h4 class="ui header">
                <i class="road mini icon"></i>
                <span class="ui green mini label" style="float: right">Coming Soon</span>
                Driving Direction:
            </h4>
            <p>Driving are based from off of Google's mapping and should be looked over as some lease roads may not be recognized.</p>
            <p style="color:#838383;">Please contact our <a href="mailto:support@navoapp.io">support</a> for any questions.</p>
        </div>
    </div>
    <div class="actions">
        <div class="ui positive center labeled icon button">
            Okay
            <i class="checkmark icon"></i>
        </div>
    </div>
</div>
