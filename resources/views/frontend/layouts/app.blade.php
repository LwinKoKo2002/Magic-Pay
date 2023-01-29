<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- bootstrap Css Cdn -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <!-- Custom Css -->
    <link rel="stylesheet" href="{{ asset('/frontend/css/app.css') }}">
    <!-- Fonts -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

</head>

<body>
    <!-- Header Menu -->
    <section class="header-menu">
        <div class="d-flex justify-content-center">
            <div class="col-md-8">
                <div class="row">
                    <a href="#" class="col-2 text-center" id="back-btn">
                        @if (!request()->is('/'))
                        <i class="uil uil-angle-left-b font-weight-bold"></i>
                        @endif
                    </a>
                    <div href="" class="col-8 text-center">
                        <p>@yield('title')</p>
                    </div>
                    <a href="" class="col-2 text-center">
                        <i class="uil uil-bell"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!-- Main Section -->
    <section class="main-content">
        <div class="d-flex justify-content-center">
            <div class="col-md-8">
                @yield('content')
            </div>
        </div>
    </section>
    <!-- Bottom Menu -->
    <section class="bottom-menu">
        <a href="{{ route('scanAndPay') }}" class="scanner">
            <div class="inner">
                <i class="uil uil-qrcode-scan"></i>
            </div>
        </a>
        <div class="d-flex justify-content-center">
            <div class="col-md-8">
                <div class="row">
                    <a href="{{ route('home') }}" class="col-3 text-center @yield('home-active')">
                        <i class=" uil uil-estate"></i>
                        <p class="@yield('home-active')">Home</p>
                    </a>
                    <a href="{{ route('wallet') }}" class="col-3 text-center @yield('wallet-active')">
                        <i class="uil uil-wallet"></i>
                        <p class="@yield('wallet-active')">Wallet</p>
                    </a>
                    <a href="{{ route('transaction') }}" class="col-3 text-center @yield('transaction-active')">
                        <i class="uil uil-exchange-alt"></i>
                        <p class="@yield('transaction-active')">Transaction</p>
                    </a>
                    <a href="{{ route('profile') }}" class="col-3 text-center @yield('account-active')">
                        <i class="uil uil-user"></i>
                        <p class="@yield('account-active')">Account</p>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!-- Bootstrap Scripts Cdn -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>
    <!-- Sweetalert 2  -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Jscroll -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jscroll/2.4.1/jquery.jscroll.min.js"></script>
    <!-- Extra Script -->
    @yield('scripts')
    <script>
        $(document).ready(function () {
            //Ajax Setup
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'Content-Type':'application/json',
                    'Accept':'application/json'
                }
            });

            //Sweetalert 2
            const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
            })

            @if(session('success'))
            Toast.fire({
            icon: 'success',
            title: "{{ session('success') }}"
            })
            @endif

            // Back Btn
            $('#back-btn').on('click',function(e){
                e.preventDefault();
                window.history.go(-1);
                return false;
            })
        });
    </script>
</body>

</html>