@extends('frontend.layouts.app')
@section('title','Magic Pay')
@section('home-active','active')
@section('content')
<div class="home">
    <div class="row">
        <div class="col-12">
            <div class="profile-container">
                <div class="profile-image-container mt-2  text-center">
                    <img src="https://ui-avatars.com/api/?background=231a72&color=ffffff&name={{ $user->name }}"
                        alt="profile-image">
                    <h5 class="my-2">{{ $user->name }}</h5>
                    <h6 data="{{ number_format($user->wallet->amount) }}" id="amount-container"><span
                            id="changing-content">{{ number_format($user->wallet->amount) }}</span>
                        @if ($user->wallet->amount > 0)
                        <span>Kyats</span>
                        @else
                        <span>Kyat</span>
                        @endif
                        <i class="uil uil-eye-slash ml-1" id="closeButton"></i>
                        <i class="uil uil-eye ml-1" id="openButton"></i>
                    </h6>
                </div>
            </div>
        </div>
    </div>
    <div class="row home-icon-container mb-1">
        <a href="{{ route('scanAndPay') }}" class="col-6 p-2">
            <div class="card mt-3">
                <div class="card-body" style="padding: 13px 8px;">
                    <img src="{{ asset('/frontend/images/scanner.png') }}" alt="scanner" class="mx-1">
                    <span>Scan & Pay</span>
                </div>
            </div>
        </a>
        <a href="{{ route('myQr') }}" class="col-6 p-2">
            <div class="card mt-3">
                <div class="card-body" style="padding: 13px 8px;">
                    <img src="{{ asset('/frontend/images/qr-code.png') }}" alt="qr-code" class="mx-1">
                    <span>Receive Qr</span>
                </div>
            </div>
        </a>
    </div>
    <div class="row home-container">
        <div class="col-12 p-2">
            <p class="mt-1 mb-4" style="letter-spacing: 0.1px">Top Services</p>
            <div class="card mb-2">
                <div class="card-body">
                    <a href="{{ route('transfer') }}" class="d-flex justify-content-between align-items-center">
                        <span>
                            <img src="{{ asset('/frontend/images/money-transfer.png') }}" alt="money-transfer">
                            Transfer</span>
                        <i class="uil uil-angle-right-b"></i>
                    </a>
                </div>
            </div>
            <div class="card mb-2">
                <div class="card-body">
                    <a href="{{ route('wallet') }}" class="d-flex justify-content-between align-items-center">
                        <span>
                            <img src="{{ asset('/frontend/images/wallet.png') }}" alt="wallet">
                            Wallet</span>
                        <i class="uil uil-angle-right-b"></i>
                    </a>
                </div>
            </div>
            <div class="card mb-2">
                <div class="card-body">
                    <a href="{{ route('transaction') }}" class="d-flex justify-content-between align-items-center">
                        <span>
                            <img src="{{ asset('/frontend/images/transaction.png') }}" alt="">
                            Transaction</span>
                        <i class="uil uil-angle-right-b"></i>
                    </a>
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-body">
                    <a href="{{ route('profile') }}" class="d-flex justify-content-between align-items-center">
                        <span>
                            <img src="{{ asset('/frontend/images/user.png') }}" alt="account">
                            Account</span>
                        <i class="uil uil-angle-right-b"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
@section('scripts')
<script>
    let data = document.querySelector("#amount-container");
    let changing_content = document.querySelector("#changing-content");
    let closeButton = document.querySelector("#closeButton");
    let openButton = document.querySelector("#openButton");
    let amount =  data.getAttribute('data');

    closeButton.addEventListener('click',function(e){
       changing_content.innerHTML = amount;
       this.style.display = "none";
       openButton.style.display = "inline-block";
    })

    openButton.addEventListener('click',function(e){
       changing_content.innerHTML = "****";
       this.style.display = "none";
       closeButton.style.display = "inline-block";
    })

</script>
@endsection