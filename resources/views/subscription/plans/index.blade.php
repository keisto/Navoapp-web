@extends('layouts.app')
@section('content')
    @include('layouts.partials._home-header')
    <div class="ui padder container">
        <div class="ui secondary menu">
            <a class="item active" data-tab="solo">Individual</a>
            <a class="item" data-tab="team">Teams <span class="ui green label">Great for Businesses!</span></a>
        </div>
        <div class="ui tab segment active" data-tab="solo">
            <ul>
                <div class="ui relaxed divided list">
                    @foreach($soloPlans as $plan)
                        <div class="item">
                            <div class="right floated content">
                                <a href="{{ route('subscription.index') }}?plan={{ $plan->slug }}"
                                   class="ui green button">
                                    Pay: $ {{ $plan->price }} - {{ $plan->recurring }}</a>
                            </div>

                            @if ($plan->name == "Basic Locator")
                                <i class="large chess pawn middle aligned icon"></i>
                            @endif
                            @if ($plan->name == "Superior Locator")
                                <i class="large chess knight middle aligned icon"></i>
                            @endif
                            @if (explode(' ',$plan->name)[0] == "Team")
                                <i class="large chess chess middle aligned icon"></i>
                            @endif

                            <div class="content">
                                <a class="header">{{ $plan->name }}</a>
                                @if($plan->recurring == 'yearly')
                                    <div class="description">{{ $plan->description }} - <span class="ui blue mini label">Get 2 Months FREE!</span></div>
                                @else
                                    <div class="description">{{ $plan->description }}</div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </ul>
        </div>

        <div class="ui tab segment" data-tab="team">
            <ul>
                <div class="ui relaxed divided list">
                    @foreach($teamPlans as $plan)
                        <div class="item">
                            <div class="right floated content">
                                <a href="{{ route('subscription.index') }}?plan={{ $plan->slug }}"
                                   class="ui green button">
                                    Pay: $ {{ $plan->price }} - {{ $plan->recurring }}</a>
                            </div>

                            @if ($plan->name == "Basic Locator")
                                <i class="large chess pawn middle aligned icon"></i>
                            @endif
                            @if ($plan->name == "Superior Locator")
                                <i class="large chess knight middle aligned icon"></i>
                            @endif
                            @if (explode(' ',$plan->name)[0] == "Team")
                                <i class="large chess chess middle aligned icon"></i>
                            @endif

                            <div class="content">
                                <a class="header">{{ $plan->name }}</a>
                                @if($plan->recurring == 'yearly')
                                    <div class="description">{{ $plan->description }} - <span class="ui blue mini label">Get 2 Months FREE!</span></div>
                                @else
                                    <div class="description">{{ $plan->description }}</div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </ul>
        </div>

        {{--@if (explode(' ',$plan->name)[0] == "Team")--}}
            {{--<div class="description">Unlimited searches, view one call information--}}
                {{--(Section, Range, Township, Nearest City/County). Append/Override location info.--}}
                {{--Teams allows all users to see changes.</div>--}}
        {{--@else--}}

        {{--<div class="ui grid">--}}
            {{--<div class="four wide column">--}}
                {{--<div class="ui fluid secondary vertical menu">--}}

                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="twelve wide stretched column">--}}
                {{--<div class="ui segment">--}}
                    {{--@foreach($plans as $plan)--}}
                       {{--<h2>{{ $plan->name }}</h2>--}}
                    {{--@endforeach--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    </div>
@endsection
