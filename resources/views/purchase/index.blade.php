@extends('layouts.main')
@section('content')
    @include('layouts.map')
    {{--<h1>--}}
    {{--{{ \Carbon\Carbon::parse($location->date_modified)->diffForHumans() }}--}}
    {{--{{ $location->date_modified }}--}}
    {{--</h1>--}}
    </div>
    <div class="ui container" style="margin-top: -120px; margin-bottom: 44px">

            @csrf
        <script src="https://checkout.stripe.com/checkout.js" class="stripe-button"></script>
        <script>
            let stripe = StripeCheckout.configure({
                key: "{{ config('services.stripe.key') }}",
                image: "https://stripe.com/img/documentation/checkout/marketplace.png",
                locale: "auto",
                // token:
            });
        </script>
    </div>
@endsection