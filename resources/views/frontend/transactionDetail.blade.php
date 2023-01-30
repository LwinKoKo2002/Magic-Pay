@extends('frontend.layouts.app')
@section('title','Transaction Detail')
@section('transaction-active','active')
@section('content')
<div class="transaction-detail">
        <div class="row">
                <div class="col-12">
                        <div class="row justify-content-center">
                                <div class="col-md-8">
                                        <div class="transaction-detail-container">
                                                <i class="uil uil-check"></i>
                                        </div>
                                        @if (session('success'))
                                        <p class="text-success text-center mt-2 mb-0">{{ session('success') }}</p>
                                        @endif

                                        @if ($transaction->type == 1)
                                        <p class="text-center">
                                                <span class="text-center text-success large-text">{{
                                                        number_format($transaction->amount)}}</span> Kyats
                                        </p>
                                        @else
                                        <p class="text-center">
                                                <span class="text-center  text-danger large-text">{{
                                                        number_format($transaction->amount)}}</span>
                                                <small>Kyats</small>
                                        </p>
                                        @endif
                                        <div class="card mt-2">
                                                <div class="card-body">
                                                        <div
                                                                class="d-flex justify-content-between align-items-center mb-4">
                                                                <span>Date And Time</span>
                                                                <span>{{ $transaction->created_at->format('Y-m-d
                                                                        h:i:s')
                                                                        }}</span>
                                                        </div>
                                                        <div
                                                                class="d-flex justify-content-between align-items-center mb-4">
                                                                <span>Transaction ID</span>
                                                                <span>{{ $transaction->trx_id }}</span>
                                                        </div>
                                                        <div
                                                                class="d-flex justify-content-between align-items-center mb-4">
                                                                <span>Reference Number</span>
                                                                <span>{{ $transaction->ref_no }}</span>
                                                        </div>
                                                        <div
                                                                class="d-flex justify-content-between align-items-center mb-4">
                                                                <span>
                                                                        @if ($transaction->type == 1)
                                                                        From
                                                                        @else
                                                                        To
                                                                        @endif
                                                                </span>
                                                                <span>{{ $transaction->source->phone
                                                                        }}</span>
                                                        </div>
                                                        <div <div
                                                                class="d-flex justify-content-between align-items-center mb-4">
                                                                <span>Before Amount</span>
                                                                <span>{{ number_format($transaction->user->wallet->amount
                                                                        +
                                                                        $transaction->amount) }}
                                                                        MMK</span>
                                                        </div>
                                                        <div
                                                                class="d-flex justify-content-between align-items-center mb-2">
                                                                <span>After Amount</span>
                                                                <span>{{ number_format($transaction->user->wallet->amount)
                                                                        }} MMK</span>
                                                        </div>
                                                </div>
                                        </div>
                                        <h6 class="my-3 font-weight-bold" style="font-size: 15px;">Informations Detail
                                        </h6>
                                        <div class="card">
                                                <div class="card-body">
                                                        <div
                                                                class="d-flex justify-content-between align-items-center mb-4">
                                                                <span>Type</span>

                                                                @if ($transaction->type == 1)
                                                                <span class="text-success font-weight-bold">
                                                                        Income</span>
                                                                @else
                                                                <div class="text-danger font-weight-bold">
                                                                        Expense
                                                                </div>
                                                                @endif

                                                        </div>
                                                        <div
                                                                class="d-flex justify-content-between align-items-center mb-4">
                                                                <span>Amount</span>
                                                                <span>{{ number_format($transaction->amount) }}
                                                                        <small> Kyats</small></span>
                                                        </div>
                                                        <div
                                                                class="d-flex justify-content-between align-items-center mb-2">
                                                                <span>Total Amount</span>
                                                                <span>{{ number_format($transaction->amount) }}
                                                                        <small>Kyats</small></span>
                                                        </div>
                                                </div>
                                        </div>
                                        <a href="/" class="btn btn-theme btn-block">Back</a>
                                </div>
                        </div>
                </div>
        </div>
</div>
@endsection