@extends('frontend.layouts.app')
@section('title','Wallet')
@section('wallet-active','active')
@section('content')
<div class="wallet">
        <div class="row">
                <div class="col-12">
                        <div class="row justify-content-center">
                                <div class="col-md-8">
                                        <div class="card">
                                                <div class="card-body">
                                                        <h6>{{ number_format($user->wallet->amount,2)}}
                                                                @if ($user->wallet->amount > 0)
                                                                <small>Kyats</small>
                                                                @else
                                                                <small>Kyat</small>
                                                                @endif
                                                        </h6>
                                                        <div
                                                                class="d-flex justify-content-between align-items-center account-container">
                                                                <h6>{{ $user->wallet->account_number }}</h6>
                                                                <h6>{{ $user->name }}</h6>
                                                        </div>
                                                </div>
                                        </div>
                                </div>
                        </div>
                </div>
        </div>
</div>
@endsection