@extends('account.layouts.default')
@section('account.content')
    <p>Current Plan: {{ auth()->user()->plan->name }} (${{ auth()->user()->plan()->price }} - {{ auth()->user()->plan()->recurring }})</p>

    <form class="ui form" method="POST" action="{{ route('account.subscription.plan.store') }}">
        @csrf
        <div class="field {{ $errors->has('plan') ? 'error' : '' }}">
            <label>Plan</label>
            <select class="ui fluid dropdown" id="plan" name="plan">
                @foreach($plans as $plan)
                    <option value="{{ $plan->gateway_id }}">
                        {{ $plan->name }} - ({{ $plan->price }} - {{ $plan->recurring }})
                    </option>
                @endforeach
            </select>
        </div>

        @if ($errors->has('plan'))
            <div class="ui error message">
                <i class="exclamation triangle icon"></i>
                <strong>{{ $errors->first('plan') }}</strong>
            </div>
        @endif
        <button type="submit" class="ui blue submit button">Change Plan</button>
    </form>

@endsection