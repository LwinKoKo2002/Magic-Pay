@extends('backend.layouts.app')
@section('title','Edit Admin Users')
@section('admin-active','mm-active')
@section('content')
<div class="app-page-title">
        <div class="page-title-wrapper">
                <div class="page-title-heading">
                        <div class="page-title-icon">
                                <i class="pe-7s-user icon-gradient bg-mean-fruit">
                                </i>
                        </div>
                        <div>Edit Admin User</div>
                </div>
        </div>
</div>
<div class="content mt-4">
        <x-card-wrapper>
                <form action="{{ route('admin.admin-user.update',$admin_user->id) }}" method="POST">
                        @method('PATCH')
                        @csrf
                        <x-input name="name" value="{{ $admin_user->name }}" />
                        <x-input name="email" type="email" value="{{ $admin_user->email }}" />
                        <x-input name="phone" type="number" value="{{ $admin_user->phone }}" />
                        <x-input name="password" type="password" />
                        <div class="text-center">
                                <button class="btn btn-secondary mr-2" id="back-btn">Cancel</button>
                                <button class="btn btn-primary" type="submit">Update</button>
                        </div>
                </form>
        </x-card-wrapper>
</div>
@endsection