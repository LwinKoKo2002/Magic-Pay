@extends('frontend.layouts.app_plain')
@section('title','Registration Form')
@section('content')
<div class="d-flex justify-content-center align-items-center  auth-form" style="min-height: 100vh">
    <div class="col-lg-5">
        <div class="card">
            <div class="card-body">
                <h3>Create Your Account</h3>
                <form action="{{ route('register') }}" method="POST">
                    @csrf
                    <x-input name="name" />
                    <x-input name="phone" type="number" />
                    <x-input name="password" type="password" />
                    <x-input-wrapper>
                        <x-label name="password confirm" />
                        <input id="password confirm" type="password" class="form-control" name="password_confirmation"
                            required autocomplete="new-password" placeholder="Confirm Password">
                    </x-input-wrapper>
                    <button class="btn btn-theme btn-block">Signup</button>
                    <p class="text-center">Already member? please <a href="{{ route('login') }}">Login</a> </p>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection