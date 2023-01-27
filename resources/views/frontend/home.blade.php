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