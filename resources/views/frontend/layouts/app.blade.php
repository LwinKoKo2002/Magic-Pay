<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- bootstrap Cdn -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <!-- Custom Css -->
    <link rel="stylesheet" href="{{ asset('/frontend/css/app.css') }}">

    <!-- Fonts -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

</head>

<body>
    <section class="header-menu">
        <div class="d-flex justify-content-center">
            <div class="col-md-8">
                <div class="row">
                    <a href="" class="col-2 text-center">
                        <i class="uil uil-angle-left-b"></i>
                    </a>
                    <div href="" class="col-8 text-center">
                        <p>Magic Pay</p>
                    </div>
                    <a href="" class="col-2 text-center">
                        <i class="uil uil-bell"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <section class="bottom-menu">
        <a href="" class="scanner">
            <div class="inner">
                <i class="uil uil-qrcode-scan"></i>
            </div>
        </a>
        <div class="d-flex justify-content-center">
            <div class="col-md-8">
                <div class="row">
                    <a href="{{ route('home') }}" class="col-3 text-center">
                        <i class="uil uil-estate"></i>
                        <p>Home</p>
                    </a>
                    <a href="" class="col-3 text-center">
                        <i class="uil uil-wallet"></i>
                        <p>Wallet</p>
                    </a>
                    <a href="" class="col-3 text-center">
                        <i class="uil uil-exchange-alt"></i>
                        <p>Transaction</p>
                    </a>
                    <a href="" class="col-3 text-center">
                        <i class="uil uil-user"></i>
                        <p>Account</p>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!-- Bootstrap Script -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>
</body>

</html>