@extends('account.layouts.default')
@section('account.content')
    <div class="ui segment">
        <form class="ui form" method="POST" action="{{ route('account.profile.store') }}">
            @csrf
                <div class="field {{ $errors->has('name') ? 'error' : '' }}">
                    <label>Full Name</label>
                    <div class="ui left icon input">
                        <i class="grey user circle outline icon"></i>
                        <input id="name" type="text" placeholder="Full Name"
                               name="name" value="{{ old('name', auth()->user()->name) }}">
                    </div>
                </div>
                @if ($errors->has('name'))
                    <div class="ui error message">
                        <strong>{{ $errors->first('name') }}</strong>
                    </div>
                @endif

                <div class="field {{ $errors->has('email') ? 'error' : '' }}">
                    <label>Email Address</label>
                    <div class="ui left icon input">
                        <i class="grey mail outline icon"></i>
                        <input id="email" type="email" placeholder="E-mail Address"
                               name="email" value="{{ old('email', auth()->user()->email) }}">
                    </div>
                    @if ($errors->has('email'))
                        <div class="ui error message">
                            <strong>{{ $errors->first('email') }}</strong>
                        </div>
                    @endif
                </div>

                <div class="field {{ $errors->has('phone') ? 'error' : '' }}">
                    <label>Phone Number</label>
                    <div class="ui labeled input">
                        <div class="ui label">+1</div>
                        <input id="phone" type="text" placeholder="10 Digit - Phone Number"
                               name="phone" value="{{ old('phone', auth()->user()->phone) }}">
                    </div>
                </div>
                @if ($errors->has('phone'))
                    <div class="ui error message">
                        <strong>{{ $errors->first('phone') }}</strong>
                    </div>
                @endif

                <button type="submit" class="ui blue submit button">Update</button>
        </form>
    </div>
@endsection