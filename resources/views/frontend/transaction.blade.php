@extends('frontend.layouts.app')
@section('title','Transaction')
@section('transaction-active','active')
@section('content')
<div class="transaction">
        <div class="row">
                <div class="col-12">
                        <div class="row justify-content-center">
                                <div class="col-md-8" style="padding: 0px 10px;">
                                        <div class="infinite-scroll">
                                                @foreach ($transactions as $transaction)
                                                <a href="/transaction/{{ $transaction->trx_id }}" class="card mb-3">
                                                        <div class="card-body" style="padding: 20px 13px;">
                                                                <div
                                                                        class="d-flex justify-content-between align-items-center">
                                                                        <div class="d-flex align-items-center">
                                                                                <div class="icon-container mr-3">
                                                                                        @if ($transaction->type == 1)
                                                                                        <i
                                                                                                class="uil uil-arrow-up up-arrow"></i>
                                                                                        @else
                                                                                        <i
                                                                                                class="uil uil-arrow-down down-arrow"></i>
                                                                                        @endif
                                                                                </div>
                                                                                <div>
                                                                                        <p
                                                                                                class="mb-0 font-weight-bold">
                                                                                                @if ($transaction->type
                                                                                                == 1)
                                                                                                From -
                                                                                                @else
                                                                                                To -
                                                                                                @endif
                                                                                                {{
                                                                                                $transaction->source->phone
                                                                                                }}
                                                                                        </p>
                                                                                        <p class="mb-0 date">
                                                                                                {{
                                                                                                $transaction->created_at->format('d
                                                                                                M
                                                                                                Y')
                                                                                                }}
                                                                                        </p>
                                                                                </div>
                                                                        </div>
                                                                        @if ($transaction->type == 1)
                                                                        <p class="mb-0"> <span class="text-success">+
                                                                                        {{number_format(
                                                                                        $transaction->amount) }}</span>
                                                                                Kyats</p>
                                                                        @else
                                                                        <p class="mb-0"><span class="text-danger">- {{
                                                                                        number_format($transaction->amount)
                                                                                        }}
                                                                                </span> Kyats
                                                                        </p>
                                                                        @endif
                                                                </div>
                                                        </div>
                                                </a>
                                                @endforeach
                                                {{ $transactions->links() }}
                                        </div>
                                </div>
                        </div>
                </div>
        </div>
</div>
@endsection
@section('scripts')
<script>
        $('ul.pagination').hide();
    $(function() {
        $('.infinite-scroll').jscroll({
            autoTrigger: true,
            loadingHtml: '<img class="center-block" src="/images/loading.gif" alt="Loading..." />',
            padding: 0,
            nextSelector: '.pagination li.active + li a',
            contentSelector: 'div.infinite-scroll',
            callback: function() {
                $('ul.pagination').remove();
            }
        });
    });
</script>
</script>
@endsection