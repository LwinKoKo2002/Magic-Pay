@extends('frontend.layouts.app')
@section('title','Notification')
@section('home-active','active')
@section('content')
<div class="notification">
        <div class="row">
                <div class="col-12">
                        <div class="row justify-content-center">
                                <div class="col-md-8 p-2">
                                        @if ($unread_noti_count)
                                        <h6 class="mt-3 mb-3 text-muted font-weight-bold">You have <span
                                                        class="text-danger ">
                                                        {{ $unread_noti_count }}
                                                        @if ($unread_noti_count > 1)
                                                        notifications
                                                        @else
                                                        notification
                                                        @endif
                                                </span>
                                                to read.
                                        </h6>
                                        @endif
                                        <div class="infinite-scroll">
                                                @forelse ($notifications as $notification)
                                                <a href="{{ route('notification-detail',$notification->id) }}"
                                                        class="card mt-3 noti_card">
                                                        <div class="card-body p-3">
                                                                <div
                                                                        class="d-flex justify-content-between align-items-center">
                                                                        <h6 class="font-weight-bold">
                                                                                @if (!$notification->read_at)
                                                                                <img src="{{ asset('/frontend/images/dry-clean.png') }}"
                                                                                        alt="dry-clean"
                                                                                        class="mb-1 ml-0 mr-1 read_noti">
                                                                                @endif
                                                                                {{Str::limit($notification->data["title"]
                                                                                ,40,
                                                                                '....')}}
                                                                        </h6>
                                                                        <div>
                                                                                <i class="uil uil-trash-alt text-danger delete_noti"
                                                                                        data-value="{{ $notification->id }}"></i>
                                                                                @if ($notification->read_at)
                                                                                <img src="{{ asset('/frontend/images/open-mail.png') }}"
                                                                                        alt="open-mail"
                                                                                        class="read_noti mb-2"
                                                                                        data-value="{{ $notification->id }}">
                                                                                @else
                                                                                <img src="{{ asset('/frontend/images/envelope.png') }}"
                                                                                        alt="envelope"
                                                                                        class="unread_noti mb-1"
                                                                                        data-value="{{ $notification->id }}">
                                                                                @endif
                                                                        </div>
                                                                </div>
                                                                <p class="mb-1">{{
                                                                        Str::limit($notification->data["message"],
                                                                        40, '....')
                                                                        }}</p>
                                                                <p class="text-muted mb-0">{{
                                                                        $notification->created_at->format('Y-m-d H:i:s
                                                                        A') }}
                                                                </p>
                                                        </div>
                                                </a>
                                                @empty
                                                <h6 class="font-weight-bold text-center mt-4 text-muted">There isn't any
                                                        notifications to show.</h6>
                                                @endforelse
                                                {{ $notifications->links() }}
                                        </div>
                                </div>
                        </div>
                </div>
        </div>
        @endsection
        @section('scripts')
        <script>
                $('ul.pagination').hide();
                $(function() {
                $('.infinite-scroll').jscroll({
                autoTrigger: true,
                loadingHtml: '<img class="center-block" src="/images/loading.gif" alt="Loading..." />',
                padding: 0,
                nextSelector: '.pagination li.active + li a',
                contentSelector: 'div.infinite-scroll',
                callback: function() {
                        $('ul.pagination').remove();
                }
                });
        });

        $(document).ready(function(){
                $(".delete_noti").on('click',function(e){
                        e.preventDefault();
                        let noti_id = $(this).data("value");
                        $.ajax({
                                type: "POST",
                                url: "/notifications/"+noti_id+"/delete",
                                success: function (response) {
                                        window.location.reload();
                                }
                        });
                })

                $(".unread_noti").on('click',function(e){
                        e.preventDefault();
                        let noti_id = $(this).data("value");
                        $.ajax({
                                type: "POST",
                                url: "/notifications/"+noti_id+"/unreadnotification/update",
                                success: function (response) {
                                        window.location.reload();
                                }
                        });
                })

                $(".read_noti").on('click',function(e){
                        e.preventDefault();
                        let noti_id = $(this).data("value");
                        $.ajax({
                                type: "POST",
                                url: "/notifications/"+noti_id+"/readnotification/update",
                                success: function (response) {
                                        window.location.reload();
                                }
                        });
                })
        })
        </script>
        @endsection