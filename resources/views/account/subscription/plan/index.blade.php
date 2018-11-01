@extends('account.layouts.default')
@section('account.content')
    @if (optional(auth()->user()->subscription('main'))->onTrial())
        <div class="ui inverted green segment">
            <i class="exclamation triangle icon"></i>
            <strong>On Trial Period: </strong> Changing your plan will <u>cancel</u> your trial period.</span>
        </div>
    @endif
    <div class="ui segment">
        @if (auth()->user()->plan->isForTeams())
            <p>Current Plan: {{ auth()->user()->plan->name }} (${{ auth()->user()->plan()->price }} per member- {{ auth()->user()->plan()->recurring }})</p>
        @else
            <p>Current Plan: {{ auth()->user()->plan->name }} (${{ auth()->user()->plan()->price }} - {{ auth()->user()->plan()->recurring }})</p>
        @endif
        <form class="ui form" method="POST" action="{{ route('account.subscription.plan.store') }}">
            @csrf
            <div class="field {{ $errors->has('plan') ? 'error' : '' }}">
                <label>Plan</label>
                <select class="ui fluid dropdown" id="plan" name="plan">
                    @foreach($plans as $plan)
                        @if ($plan->isForTeams())
                            <option value="{{ $plan->gateway_id }}">
                                {{ $plan->name }} - ({{ $plan->price }} per member - {{ $plan->recurring }})
                            </option>
                        @else
                            <option value="{{ $plan->gateway_id }}">
                                {{ $plan->name }} - ({{ $plan->price }} - {{ $plan->recurring }})
                            </option>
                        @endif
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
                    <input type="number" name="team_size" id="units" placeholder="Number of users" min="5" step="1"
                           value="{{ auth()->user()->subscription('main')->quantity }}">
                    <div class="ui yellow label">
                       @ $ 7.99 / User
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
            <span>Your <span id="recurring">{{ auth()->user()->plan->recurring }}</span> bill will be: $
                @if (auth()->user()->plan->recurring == "monthly")
                    <span id="current_pay" style="font-weight: bold">{{ number_format(auth()->user()->subscription('main')->quantity * 7.99, 2) }}</span>
                @else
                    <span id="current_pay" style="font-weight: bold">{{ number_format(auth()->user()->subscription('main')->quantity * 79.90, 2) }}</span>
                @endif
                <span data-tooltip="This is a base price. Read note below." data-inverted="">
                    <i class="icons">
                        <i class="info circle orange icon"></i>
                        <i class="corner question orange icon"></i>
                    </i>
                </span>
                </span>
            <div class="ui red message">
                <div class="content">
                    <p><strong>Please Note:</strong> Accounts are prorated. Your next month bill maybe different than what is estimated above.</p>
                </div>
            </div>
            <p><strong>Increasing Team:</strong> If you paid for 5 users $39.95 and want to increase to 10 users in the middle of the month.
                Your next month bill will be for 10 users @ $7.99 ($79.90) <u><strong>plus</strong> 19.97 </u> =
                $99.87. The following month will be back at the price shown above.</p>
            <p><strong>Decreasing Team:</strong> If you paid for 10 users ($79.90) and want to decrease to 5 users in the middle of the month.
                Your next month bill will be for 5 users @ $7.99 ($39.95) <u><strong>minus</strong> $19.97 (credit)</u> =
                $19.97. The following month will be back at the price shown above.</p>
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

            var recurring = $("#recurring").text();
            function newPayment(units) {
                if (units >= 5) {
                    if (recurring== "monthly") {
                        $('#current_pay').text((units * 7.99).toFixed(2));
                    } else {
                        $('#current_pay').text((units * 79.90).toFixed(2));
                    }
                } else {
                    if (recurring == "monthly") {
                        $('#current_pay').text(({{ auth()->user()->subscription('main')->quantity * 7.99 }}).toFixed(2));
                    } else {
                        $('#current_pay').text(({{ auth()->user()->subscription('main')->quantity * 79.90 }}).toFixed(2));
                    }
                }
            }
        });
    </script>
@endsection