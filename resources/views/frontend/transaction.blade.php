@extends('frontend.layouts.app')
@section('title','Transaction')
@section('transaction-active','active')
@section('content')
<div class="transaction">
        <div class="row">
                <div class="col-12" style="padding: 0px 5px;">
                        <div class="d-flex justify-content-center">
                                <div class="col-md-12" style="padding: 0px 10px;">
                                        <div class="row">
                                                <div class="col-12 " style="padding: 0px 10px;">
                                                        <h6 class="filter mb-3 font-weight-bold  "><i
                                                                        class="uil uil-filter ml-1"></i>
                                                                Filter
                                                        </h6>
                                                        <div class="card mb-4">
                                                                <div class="card-body">
                                                                        <div class="row">
                                                                                <div class="col-6"
                                                                                        style="padding: 0px 5px;">
                                                                                        <div class="input-group">
                                                                                                <div
                                                                                                        class="input-group-prepend">
                                                                                                        <label class="input-group-text"
                                                                                                                for="type">Date</label>
                                                                                                </div>
                                                                                                <input type="text"
                                                                                                        class="form-control date"
                                                                                                        value="{{ request()->date }}"
                                                                                                        autocomplete="false"
                                                                                                        placeholder="All">
                                                                                        </div>
                                                                                </div>
                                                                                <div class="col-6"
                                                                                        style="padding: 0px 5px;">
                                                                                        <div class="input-group">
                                                                                                <div
                                                                                                        class="input-group-prepend">
                                                                                                        <label class="input-group-text"
                                                                                                                for="type">Type</label>
                                                                                                </div>
                                                                                                <select class="custom-select"
                                                                                                        id="type">
                                                                                                        <option
                                                                                                                value="">
                                                                                                                All
                                                                                                        </option>
                                                                                                        <option value="1"
                                                                                                                @if (
                                                                                                                request()->
                                                                                                                type ==
                                                                                                                1)
                                                                                                                selected
                                                                                                                @endif>
                                                                                                                Income
                                                                                                        </option>
                                                                                                        <option value="2"
                                                                                                                @if (
                                                                                                                request()->
                                                                                                                type ==
                                                                                                                2)
                                                                                                                selected
                                                                                                                @endif>
                                                                                                                Expense
                                                                                                        </option>
                                                                                                </select>
                                                                                        </div>
                                                                                </div>
                                                                        </div>
                                                                </div>
                                                        </div>
                                                </div>
                                        </div>
                                        <h6 class=" mb-3 font-weight-bold">Transaction List</h6>
                                        <div class="infinite-scroll">
                                                @forelse ($transactions as $transaction)
                                                <a href="/transaction/{{ $transaction->trx_id }}" class="card mb-3 ">
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
                                                                                        <p class="mb-0 text-muted">
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
                                                @empty
                                                <p class="mb-0 mt-5 text-center text-muted">
                                                        Nothing To Show ....
                                                </p>
                                                @endforelse
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

        $(document).ready(function(){   
                $('.date').daterangepicker({
                        autoApply: false,
                        singleDatePicker: true,
                        autoUpdateInput : false,
                        locale: {
                        format: "YYYY-MM-DD",
                        }
                })
                
                $('.date').on('apply.daterangepicker', function(ev, picker) {
                        $(this).val(picker.startDate.format('YYYY-MM-DD'));
                        let date = $('.date').val();
                        let type = $('#type').val();
                        history.pushState(null,"",`?date=${date}&type=${type}`);
                        window.location.reload();
                });;

                $('.date').on('cancel.daterangepicker', function(ev, picker) {
                        $(this).val('');
                        let date = $('.date').val();
                        let type = $('#type').val();
                        history.pushState(null,"",`?date=${date}&type=${type}`);
                        window.location.reload();
                });;

                $('#type').on('change',function(){
                        let date = $('.date').val();
                        let type = $('#type').val();
                        history.pushState(null,"",`?date=${date}&type=${type}`);
                        window.location.reload();
                })
        })
</script>
@endsection