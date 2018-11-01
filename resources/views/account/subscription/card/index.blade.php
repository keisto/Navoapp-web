@extends('account.layouts.default')
@section('account.content')
    <div class="ui segment">
        <form class="ui form" method="POST" action="{{ route('account.subscription.card.store') }}" id="card-form">
            @csrf
            <button type="submit" class="ui violet submit button" id="update">Update Card</button>
            <span>Your new card will be used for future payments.</span>
        </form>
    </div>
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
                name: 'Navoapp.io Locator',
                currency: 'usd',
                image: '{{ asset('images/navo-facebook.png') }}',
                key: '{{ config('services.stripe.key') }}',
                email: '{{ auth()->user()->email }}',
                panelLabel: 'Update Card'
            });

            e.preventDefault();
        });
    </script>
@endsection