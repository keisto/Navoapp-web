@extends('account.layouts.default')
@section('account.content')
    <div class="ui segment">
        <form class="ui form" method="POST" action="{{ route('account.subscription.resume.store') }}">
            @csrf
            <p>Confirm to resume your subscription</p>
            <button type="submit" class="ui green submit button">Resume Subscription</button>
        </form>
    </div>
@endsection