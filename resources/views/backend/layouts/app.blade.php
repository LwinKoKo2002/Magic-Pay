<!doctype html>
<html lang="en">

<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta http-equiv="Content-Language" content="en">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title')</title>
        <meta name="viewport"
                content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
        <!-- bootstrap Cdn -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
        <!-- Custom Css -->
        <link href="{{ asset('/backend/css/style.css') }}" rel="stylesheet">
        <!-- Architect Ui Css -->
        <link href="{{ asset('/backend/css/main.css') }}" rel="stylesheet">
        <!-- Datatable Css -->
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
        <!-- Fontawesome Cdn -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
</head>

<body>
        <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
                @include('backend.layouts.header')
                <div class="app-main">
                        @include('backend.layouts.sidebar')
                        <div class="app-main__outer">
                                <div class="app-main__inner">
                                        @yield('content')
                                </div>
                                @include('backend.layouts.footer')
                        </div>
                </div>
        </div>
        <!-- Architect Ui Js -->
        <script type="text/javascript" src="{{asset('/backend/scripts/main.js')}}"></script>
        {{-- <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script> --}}
        <!-- Datatable Js -->
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
        <!-- Sweetalert -->
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <!-- Extra Js -->
        @yield('scripts')
        <script>
                $(document).ready(function(){
                        // Csrf token
                        $.ajaxSetup({
                                headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                        });
                        //Back btn
                        $('#back-btn').on("click",function(){
                                window.history.go(-1);
                                return false;
                        })
                        //Sweet alert
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
                })
        </script>
</body>

</html>