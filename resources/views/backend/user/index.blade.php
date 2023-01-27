@extends('backend.layouts.app')
@section('title','Users')
@section('user-active','mm-active')
@section('content')
<div class="app-page-title">
        <div class="page-title-wrapper">
                <div class="page-title-heading">
                        <div class="page-title-icon">
                                <i class="pe-7s-users icon-gradient bg-mean-fruit">
                                </i>
                        </div>
                        <div>Users</div>
                </div>
        </div>
</div>
<div class="add-button mt-4">
        <a href="{{ route('admin.user.create') }}" class="btn btn-dark btn-lg">
                <i class="fas fa-plus-circle mr-1"></i>
                Add New User
        </a>
</div>
<div class="content mt-4">
        <x-card-wrapper>
                <table id="datatable" class="table table-bordered w-100">
                        <thead class="bg-dark text-white">
                                <tr>
                                        <th>id</th>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th class="restrit">Ip</th>
                                        <th class="restrit">User Agent</th>
                                        <th>Login Time</th>
                                        <th>Action</th>
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
                        ajax: "/admin/user/datatable/ssd",
                        responsive: true,
                        columns: [
                                {data: 'id', name: 'id'},
                                {data: 'name', name: 'name'},
                                {data: 'phone', name: 'phone'},
                                {data: 'ip', name: 'ip'},
                                {data: 'user_agent', name: 'user_agent'},
                                {data: 'login_time', name: 'login_time'},
                                {data: 'action', name: 'action'}
                        ],
                        columnDefs: [ 
                                {
                                        targets: "restrit",
                                        searchable: false,
                                        sortable : false
                                } ,
                                {
                                        targets : 0,
                                        visible : false
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
                        title: 'Are you sure , you want to delete?',
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