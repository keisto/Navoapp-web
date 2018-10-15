@extends('account.layouts.default')
@section('account.content')
    <div class="ui segment">
        <div class="ui grid">
            <div class="row">
                <div class="four wide column">
                    <img class="ui small image" style="border-radius: 4px" src="https://api.adorable.io/avatars/285/{{ Auth::user()->name }}.png">
                </div>
                <div class="twelve wide column">
                    @if (optional(auth()->user()->subscription('main'))->onTrial())
                        <div class="ui green mini label" style="float: right">On Trial</div>
                    @endif
                    <p><strong>Account Overview</strong></p>
                    <p><span style="color: #838383;">Name:</span> {{ $user->name  }}</p>
                    <p><span style="color: #838383;">Email:</span> {{ $user->email  }}</p>
                    @if ($user->phone)
                        <p><span style="color: #838383;">Phone:</span> {{ $user->phone_number  }}</p>
                    @else
                        @if ($user->hasPiggybackSubscription() && count($teams))
                                <p><span style="color: #838383;">Add a phone number for your team members sake.<a href="{{ route('account.profile.index') }}"><i class="plus square green icon"></i></a></span></p>
                        @endif
                    @endif
                    <p><span style="color: #838383;">Plan:</span>
                        @if ($user->hasPiggybackSubscription() && count($teams))
                            @foreach($teams as $k => $v)
                                <span class="ui blue label" style="position: relative; top: -2px; margin-bottom: 6px"
                                      data-tooltip="Owner: {{ $v->owner }}" data-inverted="">
                                    Team: {{ $v->name }} <a style="padding-left: 5px; padding-right: 2px" href="mailto:{{ $v->email }}"><i class="mail icon"></i></a>
                                </span>
                            @endforeach
                        @else
                            <span class="ui violet label" style="position: relative; top: -2px; margin-bottom: 6px">{{ $user->plan() ? $user->plan()->name : "" }}</span>
                        @endif
                    </p>
                    {{--<p>--}}
                        {{--<span style="color: #838383;">Registered:</span>--}}
                        {{--{{ Carbon\Carbon::parse($user->created_at)->diffForHumans()  }}--}}
                        {{--<span data-tooltip="{{ Carbon\Carbon::parse($user->created_at)->format('l - M/d/y @ h:m:s A') }}" data-inverted="">--}}
                            {{--<i class="icons">--}}
                                {{--<i class="calendar outline orange icon"></i>--}}
                                {{--<i class="corner question orange icon"></i>--}}
                            {{--</i>--}}
                        {{--</span>--}}
                    {{--</p>--}}
                </div>
            </div>
        </div>
    </div>
@endsection
