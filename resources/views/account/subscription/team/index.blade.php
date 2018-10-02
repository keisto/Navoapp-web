@extends('account.layouts.default')
@section('account.content')
    <form class="ui form" method="POST" action="{{ route('account.subscription.team.update') }}">
        @csrf
        @method('PATCH')
        <div class="field {{ $errors->has('name') ? 'error' : '' }}">
            <label>Team Name</label>
            <div class="ui left icon input">
                <i class="grey users icon"></i>
                <input id="name" type="text" placeholder="Team Name"
                       name="name" value="{{ old('name', $team->name) }}">
            </div>
        </div>
        @if ($errors->has('name'))
            <div class="ui error message">
                <strong>{{ $errors->first('name') }}</strong>
            </div>
        @endif

        <button type="submit" class="ui blue submit button">Update</button>
    </form>

    @if ($team->users->count())
        <table class="ui celled selectable table">
            <thead>
                <tr>
                    <th>Employee</th>
                    <th>Email</th>
                    <th>Added</th>
                    <th>Remove</th>
                </tr>
            </thead>
            <tbody>
            @foreach($team->users as $user)
                <tr>
                    <td>
                        <h4 class="ui image header">
                            <img src="https://api.adorable.io/avatars/285/{{ $user->name }}.png"
                                 class="ui mini rounded image">
                            <div class="content">
                                {{ $user->name }}
                            </div>
                        </h4>
                    </td>
                    <td>
                        <i class="mail outline grey-text icon"></i> {{ $user->email }}
                    </td>
                    <td data-tooltip="{{ Carbon\Carbon::parse($user->pivot->created_at)->format('D - M/d/y') }}">
                        <i class="calendar alternate outline grey-text icon"></i> {{ Carbon\Carbon::parse($user->pivot->created_at)->diffForHumans() }}
                    </td>
                    <td class="collapsing">
                        <a class="ui icon red button" href="#"
                           onclick="event.preventDefault();
                            $('#remove-{{ $user->id }}').submit();">
                            <i class="user times icon"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <br/>
        <p class="grey-text">You haven't added any team members yet.</p>
    @endif

    @foreach ($team->users as $user)
        <form action="{{ route('account.subscription.team.member.destroy', $user) }}" method="POST"
            id="remove-{{ $user->id }}" class="hidden">
            @csrf
            @method('DELETE')
        </form>
    @endforeach

    <form class="ui form" method="POST" action="{{ route('account.subscription.team.member.store') }}">
        @csrf
        <div class="field {{ $errors->has('email') ? 'error' : '' }}">
            <label>Add a member by email</label>
            <div class="ui left icon input">
                <i class="grey mail outline icon"></i>
                <input id="email" type="text" placeholder="Email Address"
                       name="email" value="{{ old('email') }}">
            </div>
        </div>
        @if ($errors->has('email'))
            <div class="ui error message">
                <strong>{{ $errors->first('email') }}</strong>
            </div>
        @endif

        <button type="submit" class="ui blue submit button">Add Member</button>
    </form>
@endsection