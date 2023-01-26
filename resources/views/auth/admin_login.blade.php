@extends('frontend.layouts.app_plain')
@section('title','Login Form')
@section('content')
<div class="d-flex justify-content-center auth-form align-items-center" style="min-height: 100vh">
        <div class="col-lg-5">
                <div class="card">
                        <div class="card-body">
                                <h3>Login Your Account</h3>
                                <form action="{{ route('admin.login') }}" method="POST">
                                        @csrf
                                        <x-input name="email" type="email" />
                                        <x-input name="password" type="password" />
                                        <button class="btn btn-theme btn-block mb-3">Login</button>
                                </form>
                        </div>
                </div>
        </div>
</div>
@endsection