@extends('frontend.layouts.app')
@section('title','Transfer')
@section('home-active','active')
@section('content')
<div class="transfer auth-form">
        <div class="row">
                <div class="col-12">
                        <div class="card">
                                <div class="card-body">
                                        <div class="transfer-icon-container text-center">
                                                <img src="{{ asset('/frontend/images/dollar.png') }}" alt="">
                                                <h6 class="mb-5">Send Money</h6>
                                        </div>
                                        <form action="{{ route('transfer.confirm') }}" method="POST">
                                                @csrf
                                                <x-input-wrapper>
                                                        <x-label name="receiver" />
                                                        <div class="input-group">
                                                                <input type="number" name="receiver"
                                                                        value="{{ old('receiver') }}" id="receiver"
                                                                        placeholder="receiver"
                                                                        class="@error('receiver') is-invalid @enderror form-control"
                                                                        required autocomplete="receiver"
                                                                        aria-describedby="basic-addon2" autofocus>
                                                                <div class="input-group-append">
                                                                        <span class="btn btn-light" id="basic-addon2"><i
                                                                                        class="uil uil-check-circle"></i></span>
                                                                </div>
                                                        </div>
                                                        <x-error name="receiver" />
                                                </x-input-wrapper>
                                                <x-input name="amount" type="number" />
                                                <x-input-wrapper>
                                                        <x-label name="description" />
                                                        <textarea name="description" id="description" cols="30" rows="2"
                                                                class="form-control"
                                                                placeholder="description"></textarea>
                                                </x-input-wrapper>
                                                <button class="btn btn-theme btn-block">Continue</button>
                                        </form>
                                </div>
                        </div>
                </div>
        </div>
</div>
@endsection