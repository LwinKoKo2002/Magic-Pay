@extends('frontend.layouts.app')
@section('title','Scan And Pay')
@section('home-active','active')
@section('content')
<div class="scan-and-pay">
        <div class="row">
                <div class="col-12">
                        <div class="row justify-content-center">
                                <div class="col-md-8">
                                        <p class="text-center mt-2">Hold the code inside the frame.It will be scanned
                                                automatically.</p>
                                        <div class="card">
                                                <div class="card-body">
                                                        <div class="scanner-image-container text-center">
                                                                @error('error')
                                                                <div class="alert alert-danger  fade show" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                        </button>
                                                                </div>
                                                                @enderror
                                                                <img src="{{ asset('/frontend/images/scanAndPay.png') }}"
                                                                        alt="scanAndPay">
                                                        </div>
                                                        <!-- Button trigger modal -->
                                                        <button class="btn btn-theme btn-block" type="button"
                                                                data-toggle="modal"
                                                                data-target="#scanModal">Scan</button>
                                                        <!-- Modal -->
                                                        <div class="modal fade" id="scanModal" tabindex="-1"
                                                                aria-labelledby="scanModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                        <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                        <h5 class="modal-title font-weight-bold"
                                                                                                id="scanModalLabel">
                                                                                                Scan And Pay</h5>
                                                                                        <button type="button"
                                                                                                class="close"
                                                                                                data-dismiss="modal"
                                                                                                aria-label="Close">
                                                                                                <span
                                                                                                        aria-hidden="true">&times;</span>
                                                                                        </button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                        <video id="scanner"></video>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                        <button type="button"
                                                                                                class="btn btn-secondary"
                                                                                                data-dismiss="modal">Close</button>
                                                                                </div>
                                                                        </div>
                                                                </div>
                                                        </div>
                                                </div>
                                        </div>
                                </div>
                        </div>
                </div>
        </div>
</div>
@endsection
@section('scripts')
<script src="{{ asset('/frontend/js/qr-scanner.umd.min.js') }}"></script>
<script>
        let videoElem = document.getElementById('scanner');
        const qrScanner = new QrScanner(videoElem,result => {
                if(result){
                        let phone = result;
                        qrScanner.stop();
                        $('#scanModal').modal('hide');
                        window.location.replace(`/scan-and-pay-form?phone=${phone}`);
                }
               
        });

        $('#scanModal').on('shown.bs.modal', function (event) {
                qrScanner.start();
        })

        $('#scanModal').on('hidden.bs.modal', function (event) {
                qrScanner.stop();
                $('#scanModal').modal('hide');
        })
</script>
@endsection