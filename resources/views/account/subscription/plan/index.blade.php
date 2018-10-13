@extends('account.layouts.default')
@section('account.content')
    <div class="ui segment">
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
            <span><strong>Changing Plans:</strong> Credit <u>will</u> be applied from your previous plan.</span>
        </form>
    </div>
    @teamsubscription
    <div class="ui segment">
        <p>Current Team Plan Size: {{ auth()->user()->subscription('main')->quantity }}</p>

        <form class="ui form" method="POST" action="{{ route('account.subscription.plan.increase') }}">
            @csrf
            <div class="field {{ $errors->has('team_size') ? 'error' : '' }}">
                <div class="ui left icon right labeled input">
                    <i class="group icon"></i>
                    <input type="number" name="team_size" id="units" placeholder="Number of users" min="10" step="1"
                           value="{{ auth()->user()->subscription('main')->quantity }}">
                    <div class="ui yellow label">
                       @ $ 6.99 / User
                    </div>
                </div>
            </div>

            @if ($errors->has('team_size'))
                <div class="ui error message">
                    <i class="exclamation triangle icon"></i>
                    <strong>{{ $errors->first('team_size') }}</strong>
                </div>
            @endif
            <button type="submit" class="ui green submit button">Update Team Limit</button>
            <span>Your {{ auth()->user()->plan->recurring }} bill will be: $
                <span id="current_pay" style="font-weight: bold">{{ number_format(auth()->user()->subscription('main')->quantity * 6.99, 2) }}</span>
                <span data-tooltip="This is a base price. Read note below." data-inverted="">
                    <i class="icons">
                        <i class="info circle orange icon"></i>
                        <i class="corner question orange icon"></i>
                    </i>
                </span>
                </span>
            <div class="ui red message">
                <div class="content">
                    <p><strong>Please Note:</strong> Accounts are prorated. Your next month bill maybe different than what is estimated above</p>
                </div>
            </div>
            <p><strong>Increasing Team:</strong> If you paid for 10 users $29.90 and want to increase to 20 users in the middle of the month.
                Your next month bill will be for 20 users @ $6.99 ($139.80) <u><strong>plus</strong> $34.95 </u> =
                $174.75. The following month will be back at the price shown above.</p>
            <p><strong>Decreasing Team:</strong> If you paid for 20 users ($139.80) and want to decrease to 10 users in the middle of the month.
                Your next month bill will be for 10 users @ $6.99 ($69.90) <u><strong>minus</strong> $34.95 (credit)</u> =
                $34.95. The following month will be back at the price shown above.</p>
            <p><strong>Questions:</strong> <a href="mailto:tony@navoapp.io">Email us</a> if you have any questions or need clarification.</p>
        </form>
    </div>
    @endteamsubscription

@endsection
@section('scripts')
    <script>
        $( document ).ready(function() {
            $('#units').keyup(function () {
                newPayment($('#units').val())
            });
            $('#units').change(function () {
                newPayment($('#units').val())
            });

            function newPayment(units) {
                if (units >= 10) {
                    {{--var x = ((units * 2.99)-{{ auth()->user()->subscription('main')->quantity * 2.99 }}).toFixed(2);--}}
                    {{--$('#payment_due').text(x);--}}
                    // if (x < 0.00) {
                    //     $('#current_pay').text(((units * 2.99).toFixed(2)) + " " +  x " ");
                    // } else {
                    //     $('#current_pay').text((units * 2.99).toFixed(2));
                    // }
                    $('#current_pay').text((units * 6.99).toFixed(2));
                } else {
                    // $('#payment_due').text("0.00");
                    $('#current_pay').text(({{ auth()->user()->subscription('main')->quantity * 6.99 }}).toFixed(2));
                }
            }
        });
    </script>
@endsection