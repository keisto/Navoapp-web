@extends('account.layouts.default')
@section('account.content')
    <form class="ui form" method="POST" action="{{ route('account.subscription.cancel.store') }}">
        @csrf
        <p>Confirm Subscription Cancellation</p>
        <button type="submit" class="ui yellow submit button">Cancel Subscription</button>
    </form>
@endsection