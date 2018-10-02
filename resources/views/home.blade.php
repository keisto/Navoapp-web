@extends('layouts.app')
@section('content')
    @include("layouts.partials._home-header")
    <div class="ui container" style="margin-bottom: 44px">
        <div class="ui three statistics padder">
            <div class="statistic">
                <div class="value">
                    <img src="{{ asset('images/badge.svg') }}" style="width: 50px" class="ui inline image">
                    {{ number_format($operators,0) }}
                </div>
                <div class="label">
                    Operators
                </div>
            </div>
            <div class="statistic">
                <div class="value">
                    <img src="{{ asset('images/oil.svg') }}" style="width: 50px" class="ui inline image">
                    {{ number_format($wells,0) }}
                </div>
                <div class="label">
                    Oil well locations
                </div>
            </div>
            <div class="statistic">
                <div class="value">
                    <img src="{{ asset('images/map.svg') }}" style="width: 50px" class="ui inline image">
                    {{ number_format($states,0) }}
                </div>
                <div class="label">
                    States (including Canada)
                </div>
            </div>
        </div>

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
            <div class="ui card">
                <div class="content">
                    <img src="{{ asset('images/pin-share.svg') }}" style="width: 32px" class="ui floated left image">
                    <div class="header">Share</div>
                    <div class="meta">By text or email</div>
                    <div class="description">
                        Send well info containing a link to begin navigation.
                    </div>
                </div>
            </div>
            <div class="ui card">
                <div class="content">
                    <div class="ui right floated yellow mini label">Update On the Way</div>
                    <img src="{{ asset('images/apple.svg') }}" style="width: 32px" class="ui floated left image">
                    <div class="header">Mobile App</div>
                    <div class="meta">Version 1.0</div>
                    <div class="description">
                        Mobile app on <strong>ALL</strong> <u>iOS</u> Devices.
                    </div>
                </div>
            </div>
            <div class="ui card">
                <div class="content">
                    <img src="{{ asset('images/export.svg') }}" style="width: 32px" class="ui floated left image">
                    <div class="header">Export Data</div>
                    <div class="meta">By each State</div>
                    <div class="description">
                        Choose between JSON, XML, and CSV formats.
                    </div>
                </div>
            </div>
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
                    <div class="meta">Free for limited time</div>
                    <div class="description">
                        View nearest city, section, range, and township of the well.
                    </div>
                </div>
            </div>
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
            <div class="ui card">
                <div class="content">
                    <div class="ui right floated green mini label">Various Plans</div>
                    <img src="{{ asset('images/bill.svg') }}" style="width: 32px" class="ui floated left image">
                    <div class="header">Subscriptions</div>
                    <div class="meta">Individual & business</div>
                    <div class="description">
                        Add favorites, store history, unlock features, and access developer API's.
                    </div>
                </div>
            </div>
            <div class="ui card">
                <div class="content">
                    <img src="{{ asset('images/analytics.svg') }}" style="width: 32px" class="ui floated left image">
                    <div class="header">Well Analytics</div>
                    <div class="meta">Stats & graphs</div>
                    <div class="description">
                        View well production information in the best ways possible!
                    </div>
                </div>
            </div>
            <div class="ui card">
                <div class="content">
                    <img src="{{ asset('images/timeline.svg') }}" style="width: 32px" class="ui floated left image">
                    <div class="header">Well History</div>
                    <div class="meta">Timeline events</div>
                    <div class="description">
                        View when well status changes.
                    </div>
                </div>
            </div>
            <div class="ui card">
                <div class="content">
                    <img src="{{ asset('images/more.svg') }}" style="width: 32px" class="ui floated left image">
                    <div class="header">And More!</div>
                    <div class="meta">Looking for more info?</div>
                    <div class="description">
                        <a mailto="keisertony@gmail.com">Email any requests or suggestions!</a>
                    </div>
                </div>
            </div>
        </div>
        @include("layouts.partials._pricing")
    </div>
@endsection
