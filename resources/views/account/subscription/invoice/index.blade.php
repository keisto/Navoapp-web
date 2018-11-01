@extends('account.layouts.default')
@section('account.content')
    @if($invoices)
    <div class="ui styled fluid accordion">
        @foreach ($invoices as $invoice)
            <div class="@if ($loop->first) active @endif title">
                <i class="dropdown icon"></i>
                {{ Carbon\Carbon::parse($invoice->date()->toFormattedDateString())->format('F') }}
                @if ($invoice->total == 0 && optional(auth()->user()->subscription('main'))->onTrial())
                    <span class="ui green small label" style="float: right; margin-top: -2.5px;">Trial Period</span>
                @else
                    <span class="ui red small label" style="float: right; margin-top: -2.5px;">{{ $invoice->total() }}</span>
                @endif
            </div>
            <div class="@if ($loop->first) active @endif content">
                <p>Invoice #: {{ $invoice->number }}</p>
                <p>Date: {{ $invoice->date()->toFormattedDateString() }}</p>
                {{--<p>Amount Due: ${{ number_format($invoice->amount_due/100, 2) }}  &nbsp;--}}
                    {{--<i class="arrow right grey icon"></i>--}}
                    {{--Amount Paid: ${{ number_format($invoice->amount_paid/100, 2) }}</p>--}}
                {{--{{ $invoice->lines }}--}}
                <p>Total: {{ $invoice->total() }}</p>
                <a class="ui black button" href="{{ $invoice->hosted_invoice_url }}" target="_blank">
                    <i class="file pdf icon"></i>
                    View PDF
                </a>
                <a class="ui blue button" href="{{ $invoice->invoice_pdf }}">
                    <i class="file pdf outline icon"></i>
                    Download PDF
                </a>
            </div>
        @endforeach
    </div>
    @else
        <div class="ui segment">
            No invoices found. <span style="color: #838383">If you find this to be an error. Please contact us <a href="mailto:keisertony@gmail.com">now</a>. </span>
        </div>
    @endif
@endsection
