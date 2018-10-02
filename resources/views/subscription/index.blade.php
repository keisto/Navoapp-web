@extends('layouts.app')
@section('content')
    @include('layouts.partials._home-header')
    <div class="ui padder container">
        <div class="ui secondary menu">
            <a class="item active" data-tab="solo">Individual</a>
            <a class="item" data-tab="team">Teams <span class="ui green label">Great for Businesses!</span></a>
        </div>
        <form id="payment-form" action="{{ route('subscription.store') }}" method="POST">
            @csrf
            <div class="ui tab segment active" data-tab="solo">
                <div class="ui form">
                    <div class="field {{ $errors->has('plan') ? 'error' : '' }}">
                        <select class="ui fluid dropdown" id="plan" name="plan">
                            @foreach($soloPlans as $plan)
                                <option value="{{ $plan->gateway_id }}"
                                        {{ request('plan') == $plan->slug || old('plan') == $plan->gateway_id ? 'selected="selected"' : '' }}
                                >{{ $plan->name }} - ({{ $plan->price }} - {{ $plan->slug }})</option>
                            @endforeach
                            @foreach($teamPlans as $plan)
                                <option value="{{ $plan->gateway_id }}"
                                        {{ request('plan') == $plan->slug || old('plan') == $plan->gateway_id ? 'selected="selected"' : '' }}
                                >{{ $plan->name }} - ({{ $plan->price }} - {{ $plan->slug }})</option>
                            @endforeach
                        </select>
                    </div>

                    @if ($errors->has('plan'))
                        <div class="ui error message">
                            <i class="exclamation triangle icon"></i>
                            <strong>{{ $errors->first('plan') }}</strong>
                        </div>
                    @endif

                    <div class="field {{ $errors->has('coupon') ? 'error' : '' }}">
                        <div class="ui input">
                            <input id="coupon" type="text" placeholder="Coupon" name="coupon" value="{{old('coupon')}}">
                        </div>
                    </div>

                    @if ($errors->has('coupon'))
                        <div class="ui error message">
                            {{ $errors->first('coupon') }}
                        </div>
                    @endif

                    <button id="pay" type="submit" class="ui blue submit button">Pay</button>
                </div>
            </div>



            <div class="ui tab segment" data-tab="team">
                <ul>
                    @foreach($teamPlans as $plan)
                        <li>{{ $plan->name }} - {{ $plan->price }}</li>
                    @endforeach
                </ul>

            </div>
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
                let form = $('#payment-form');

                $('#pay').prop('disabled', true);

                $('<input>').attr({
                    type: 'hidden',
                    name: 'token',
                    value: token.id
                }).appendTo(form);

                form.submit();
            }
        });

        $('#pay').click(function (e) {
           handler.open({
               name: 'Navo - Oil Well Finder',
               description: 'Membership',
               currency: 'usd',
               key: '{{ config('services.stripe.key') }}',
               email: '{{ auth()->user()->email }}'
           });

            e.preventDefault();
        });



    </script>
@endsection