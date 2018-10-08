@extends('account.layouts.default')
@section('account.content')
    <div class="ui segment">
        <form class="ui form" method="POST" action="{{ route('account.subscription.cancel.store') }}">
            @csrf
            <button type="submit" class="ui yellow submit button">Cancel Subscription</button>
            <span>Click to confirm subscription cancellation.</span>
        </form>
    </div>
@endsection