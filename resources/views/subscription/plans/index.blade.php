@extends('layouts.app')
@section('content')
    @include('layouts.partials._home-header')
    <div class="ui padder container">
        <div class="ui secondary menu">
            <a class="item active" data-tab="solo"><i class="user icon"></i> Individual</a>
            <a class="item" data-tab="team"><i class="group icon"></i> Teams <span class="ui green label"><i class="thumbs up icon"></i> Businesses!</span></a>
        </div>
        <div class="ui pink segment" style="display: flex; justify-content: center">
            <h4 class="ui header">
                <i class="tag icon"></i>
                <div class="content">
                    Use coupon code: <u>EARLYBIRD</u> at check out and save 50% for <strong>12 months</strong> or <strong>1 year</strong>!
                </div>
            </h4>
        </div>
        @include('subscription.plans.partials._solo')
        @include('subscription.plans.partials._team')

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
                    <p>Section, Quarter, Range, and Township common details when submitting a one call.</p>
                    <h4 class="ui header">
                        <i class="map outline violet mini icon"></i>
                        Location County Name
                    </h4>
                    <p>Show county name with City, State.</p>
                    <h4 class="ui header">
                        <i class="map signs brown mini icon"></i>
                        <span class="ui green mini label" style="float: right">BETA</span>
                        Nearest Intersection:
                    </h4>
                    <p>We first try to provide the nearest intersection, but if that cannot be found we will give you a list of nearby streets.</p>
                    <h4 class="ui header">
                        <i class="road mini icon"></i>
                        <span class="ui green mini label" style="float: right">BETA</span>
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
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
        window._chatlio = window._chatlio||[];
        !function(){ var t=document.getElementById("chatlio-widget-embed");if(t&&window.ChatlioReact&&_chatlio.init)return void _chatlio.init(t,ChatlioReact);for(var e=function(t){return function(){_chatlio.push([t].concat(arguments)) }},i=["configure","identify","track","show","hide","isShown","isOnline", "page", "open", "showOrHide"],a=0;a<i.length;a++)_chatlio[i[a]]||(_chatlio[i[a]]=e(i[a]));var n=document.createElement("script"),c=document.getElementsByTagName("script")[0];n.id="chatlio-widget-embed",n.src="https://w.chatlio.com/w.chatlio-widget.js",n.async=!0,n.setAttribute("data-embed-version","2.3");
            n.setAttribute('data-widget-id','abf30194-8ea0-42a0-4e17-d23009527a0d');
            c.parentNode.insertBefore(n,c);
        }();
    </script>
@endsection