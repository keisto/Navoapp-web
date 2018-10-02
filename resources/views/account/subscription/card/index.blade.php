@extends('account.layouts.default')
@section('account.content')
    <form class="ui form" method="POST" action="{{ route('account.subscription.card.store') }}" id="card-form">
        @csrf
        <p>Your new card will be used for future payments.</p>
        <button type="submit" class="ui violet submit button" id="update">Update Card</button>
    </form>
@endsection

@section('scripts')
    <script src="https://checkout.stripe.com/checkout.js"></script>
    <script>
        let handler = StripeCheckout.configure({
            key: '{{ config('services.stripe.key') }}',
            locale: 'auto',
            token: function(token) {
                let form = $('#card-form');

                $('#update').prop('disabled', true);

                $('<input>').attr({
                    type: 'hidden',
                    name: 'token',
                    value: token.id
                }).appendTo(form);

                form.submit();
            }
        });

        $('#update').click(function (e) {
            handler.open({
                name: 'Navo - Oil Well Finder',
                currency: 'usd',
                key: '{{ config('services.stripe.key') }}',
                email: '{{ auth()->user()->email }}',
                panelLabel: 'Update Card'
            });

            e.preventDefault();
        });



    </script>
@endsection