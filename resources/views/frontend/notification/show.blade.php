@extends('frontend.layouts.app')
@section('title','Notification Detail')
@section('home-active','active')
@section('content')
<div class="notification-detail">
        <div class="row">
                <div class="col-12">
                        <div class="row justify-content-center">
                                <div class="col-md-8 p-2">
                                        <div class="card">
                                                <div class="card-body">
                                                        <div class="notification-detail text-center">
                                                                <img src="{{ asset('/frontend/images/notification.png') }}"
                                                                        alt="notification">
                                                                <h6 class="font-weight-bold ">{{
                                                                        $notification->data["title"] }}</h6>
                                                                <p class="text-muted mt-3 mb-2">{{
                                                                        $notification->data["message"]
                                                                        }}</p>
                                                                <p class="text-muted">{{
                                                                        $notification->created_at->format('Y-m-d H:i:s
                                                                        A') }}
                                                                </p>
                                                                <a href="{{ $notification->data['web_link'] }}"
                                                                        class="btn btn-theme btn-block">Continue</a>
                                                        </div>
                                                </div>
                                        </div>
                                </div>
                        </div>
                </div>
        </div>
        @endsection