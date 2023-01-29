@extends('frontend.layouts.app')
@section('title','Receiver Qr')
@section('home-active','active')
@section('content')
<div class="receive-qr">
        <div class="row">
                <div class="col-12">
                        <div class="row justify-content-center">
                                <div class="col-md-8">
                                        <p class="text-center mb-3 mt-4">Let your sender scan this QR code to
                                                send money to you.</p>
                                        <div class="card">
                                                <div class="card-body">
                                                        <div class="myQr-container text-center">
                                                                <img
                                                                        src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(250)->generate($authUser->phone)) !!} ">
                                                        </div>
                                                </div>
                                        </div>
                                        <p class="text-center mt-2 mb-1">My Number</p>
                                        <h6 class="text-center">{{ $authUser->phone }}</h6>
                                </div>
                        </div>
                </div>
        </div>
</div>
@endsection