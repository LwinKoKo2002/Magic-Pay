@extends('frontend.layouts.app')
@section('title','Transfer Confirm')
@section('home-active','active')
@section('content')
<div class="transfer-confirm">
        <div class="row">
                <div class="col-12">
                        <div class="card">
                                <div class="card-body">
                                        <form action="{{ route('transfer.complete') }}" method="POST" id="myForm">
                                                @csrf
                                                <input type="hidden" name="amount" value="{{ $amount }}">
                                                <input type="hidden" name="sender" value="{{ $authUser->phone }}">
                                                <input type="hidden" name="receiver" value="{{ $receiver->phone }}">
                                                <input type="hidden" name="description" value="{{ $description }}">
                                                <div class="mb-4">
                                                        <h6>Sender</h6>
                                                        <p>{{ $authUser->phone }}</p>
                                                </div>
                                                <div class="mb-4">
                                                        <h6>Receiver</h6>
                                                        <p>{{ $receiver->phone }}</p>
                                                </div>
                                                <div class="mb-4">
                                                        <h6>Amount</h6>
                                                        <p>{{number_format( $amount) }} Kyats</p>
                                                </div>
                                                <div>
                                                        <h6>Description</h6>
                                                        <p>{{ $description }}</p>
                                                </div>
                                                <button class="btn btn-theme btn-block" id="confirm_btn"
                                                        type="submit"><i class="uil uil-message"></i>
                                                        Confirm</button>
                                        </form>
                                </div>
                        </div>
                </div>
        </div>
</div>
@endsection
@section('scripts')
<script>
        $(document).ready(function(){
                $("#confirm_btn").on('click',function (e) { 
                        e.preventDefault();
                        Swal.fire({
                        icon: 'info',
                        html:'<input type="password" class="form-control text-center password" name="password" autofocus placeholder="Please enter your pasword"/>', 
                        showCloseButton: true,
                        focusConfirm: false,
                        confirmButtonText:'confirm',
                        }).then((result) => {
                        if (result.isConfirmed) {
                                var password = $(".password").val();
                                $.ajax({
                                        type:"GET",
                                        url: `/password-check?password=${password}`,
                                        success: function (res) {
                                                if(res.status == 'success'){
                                                        $('#myForm').submit();
                                                }else{
                                                        Swal.fire({
                                                        icon: 'error',
                                                        title: 'Oops...',
                                                        text: res.message,
                                                        })
                                                }
                                        }
                                });
                        } 
                        })
                 })
        })
</script>
@endsection