@extends('backend.layouts.app')
@section('title','Wallet')
@section('wallet-active','mm-active')
@section('content')
<div class="app-page-title">
        <div class="page-title-wrapper">
                <div class="page-title-heading">
                        <div class="page-title-icon">
                                <i class="pe-7s-wallet icon-gradient bg-mean-fruit">
                                </i>
                        </div>
                        <div>Wallets</div>
                </div>
        </div>
</div>
<div class="content mt-4">
        <x-card-wrapper>
                <table id="datatable" class="table table-bordered w-100">
                        <thead class="bg-dark text-white">
                                <tr>
                                        <th>id</th>
                                        <th class="restrict">User</th>
                                        <th class="restrict">Account Number</th>
                                        <th>Amount (MMK)</th>
                                </tr>
                        </thead>
                        <tbody></tbody>
                </table>
        </x-card-wrapper>
</div>
@endsection
@section('scripts')
<script>
        $(document).ready(function () {
               let datatable =  $('#datatable').DataTable({
                        processing: true,
                        serverSide: true,
                        ajax: "/admin/user/wallet/datatable/ssd",
                        responsive: true,
                        columns: [
                                {data: 'id', name: 'id'},
                                {data: 'user', name: 'user'},
                                {data: 'account_number', name: 'account_number'},
                                {data: 'amount', name: 'amount'}
                        ],
                        columnDefs: [ 
                                {
                                        targets: "restrict",
                                        searchable: false,
                                        sortable : false
                                },
                                {
                                        target : 0,
                                        visible :false
                                }
                        ],
                        order: [
                                [ 0, 'desc' ]
                        ]
                });
                $(document).on('click','#delete_btn',function(e){
                        e.preventDefault();
                        let id = $(this).data("id");
                        Swal.fire({
                        title: 'Are you sure , you want to logout?',
                        reverseButtons : true,
                        showCancelButton: true,
                        confirmButtonText: 'Yes, Delete',
                        cancelButtonText: 'No, Keep on',
                        focusConfirm:false
                        }).then((result) => {
                                if (result.isConfirmed) {
                                        $.ajax({
                                        type: "DELETE",
                                        url: `/admin/user/${id}`,
                                        success: function (res) {
                                                datatable.ajax.reload();
                                        }
                                });
                        } 
                        })
                })
        });
</script>
@endsection