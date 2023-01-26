@extends('frontend.layouts.app_plain')
@section('title','Login Form')
@section('content')
<div class="d-flex justify-content-center auth-form align-items-center" style="min-height: 100vh">
    <div class="col-lg-5">
        <div class="card">
            <div class="card-body">
                <h3>Login Your Account</h3>
                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <x-input name="phone" type="number" />
                    <x-input name="password" type="password" />
                    <button class="btn btn-theme btn-block">Login</button>
                    <p class="text-center">Don't have an account? please <a href="{{ route('register') }}">Signup</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection