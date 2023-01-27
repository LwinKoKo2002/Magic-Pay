@extends('frontend.layouts.app')
@section('account-active','active')
@section('title','Profile')
@section('content')
<div class="profile">
        <div class="row">
                <div class="col-12">
                        <div class="profile-image-container text-center mt-2">
                                <img src="https://ui-avatars.com/api/?background=231a72&color=ffffff&name={{ auth()->guard('web')->user()->name }}"
                                        alt="profile-image">
                                <p class="mt-2">{{ (auth()->guard('web')->user()->name) }}</p>
                        </div>

                        <div class="card mt-4" style="border-radius: 12px">
                                <div class="card-body">
                                        <div
                                                class="d-flex justify-content-lg-between justify-content-center align-items-center">
                                                <span class="mr-3">My Balance</span>
                                                <span>{{
                                                        number_format(auth()->guard('web')->user()->wallet->amount,2) }}
                                                        @if (auth()->guard('web')->user()->wallet->amount > 0)
                                                        Kyats
                                                        @else
                                                        Kyat
                                                        @endif
                                                </span>
                                        </div>
                                        <div class="divider"></div>
                                        <div
                                                class="d-flex justify-content-lg-between justify-content-center align-items-center">
                                                <span class="mr-3">My Number</span>
                                                <span>{{ auth()->guard('web')->user()->phone }}</span>
                                        </div>
                                        <div class="divider"></div>
                                        <div
                                                class="d-flex justify-content-lg-between justify-content-center align-items-center">
                                                <span class="mr-3">Name</span>
                                                <span>{{ auth()->guard('web')->user()->name }}</span>
                                        </div>
                                </div>
                        </div>

                        <div class="card my-4" style="border-radius: 12px">
                                <div class="card-body">
                                        <a href="#" class="d-flex justify-content-between align-items-center"
                                                id="logout-btn">
                                                <span><i class="uil uil-signout mr-2"></i>Logout</span>
                                                <i class="uil uil-angle-right-b"></i>
                                        </a>
                                        <div class="divider"></div>
                                        <a href="{{ route('changePassword') }}"
                                                class="d-flex justify-content-between align-items-center">
                                                <span><i class="uil uil-key-skeleton-alt mr-2"></i>Change Pin</span>
                                                <i class="uil uil-angle-right-b"></i>
                                        </a>
                                </div>
                        </div>
                </div>
        </div>
</div>
@endsection
@section('scripts')
<script>
        $(document).ready(function () {
                $('#logout-btn').on('click',function(e){
                        e.preventDefault();
                        Swal.fire({
                        title: 'Are you sure , you want to logout?',
                        reverseButtons: true,
                        focusConfirm :false,
                        showCancelButton: true,
                        cancelButtonText: 'No',
                        confirmButtonText: 'Yes',
                        }).then((result) => {
                        if (result.isConfirmed) {
                                $.ajax({
                                        type: "POST",
                                        url: "/logout",
                                        success: function (res) {
                                                window.location.replace("{{ route('login') }}");
                                        }
                                });
                        }
                        })
                })
        });
</script>
@endsection