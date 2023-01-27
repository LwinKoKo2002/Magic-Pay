@extends('frontend.layouts.app')
@section('title','Change Pin')
@section('account-active','active')
@section('content')
<div class="change-password auth-form">
        <div class="row">
                <div class="col-12">
                        <div class="card">
                                <div class="card-body">
                                        <div class="row align-items-center">
                                                <div class="col-lg-6 mb-lg-0 col-md-5 mb-sm-5 mb-5">
                                                        <h6>Password must contain :</h6>
                                                        <ul>
                                                                <li>Require at least 8 characters.</li>
                                                                <li>Require at least one uppercase and one lowercase.
                                                                </li>
                                                                <li>Require at least one number.</li>
                                                                <li>Require at least one symbol.</li>
                                                        </ul>
                                                </div>
                                                <div class="col-lg-6">
                                                        <h4>Change your password</h4>
                                                        <form action="{{ route('update-password') }}" method="POST">
                                                                @csrf
                                                                <x-input-wrapper>
                                                                        <x-label name="old password" />
                                                                        <input type="password" name="old_password"
                                                                                class="@error('old_password') is-invalid @enderror form-control"
                                                                                placeholder="Old Password" required
                                                                                autofocus>
                                                                        <x-error name="old_password" />
                                                                </x-input-wrapper>
                                                                <x-input-wrapper>
                                                                        <x-label name="new password" />
                                                                        <input type="password" name="new_password"
                                                                                placeholder="New Password"
                                                                                class="@error('new_password') is-invalid @enderror form-control"
                                                                                required>
                                                                        <x-error name="new_password" />
                                                                </x-input-wrapper>
                                                                <button class="btn btn-theme btn-block mb-3"
                                                                        type="submit">Change my
                                                                        password</button>
                                                        </form>
                                                </div>
                                        </div>
                                </div>
                        </div>
                </div>
        </div>
</div>
@endsection