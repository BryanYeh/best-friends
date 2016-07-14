@extends('layouts.master')

@section('title')
   Find Friends
@endsection

@section('content')
   @foreach($users as $email => $value)
      <p data-friendemail="{{ $email }}">{{ $value['first_name'] }} {{ $value['last_name'] }}<br>
         @if( $value['status'] == 'already')
            <a href="#" class="destroyFriendship">Destroy Friendship</a>
         @elseif($value['status'] == 'pending')
            <a href="#" class="cancelRequest">Cancel Friend Request</a>
         @elseif($value['status'] == 'accept')
            <a href="#" class="acceptRequest">Accept Friend Request</a> | <a href="#" class="status">Decline Friend Request</a>
         @else
            <a href="#" class="request">Request Friend</a>
         @endif
      </p>
   @endforeach

   <script>
      var token = '{{ csrf_token() }}';
      var urlUnfriend = '{{ route('friend-destroy') }}';
      var urlCancelRequest = '{{ route('friend-cancel') }}';
      var urlAccept = '{{ route('friend-accept') }}';
      var urlDecline = '{{ route('friend-decline') }}';
      var urlRequest = '{{ route('friend-request') }}';
   </script>
@endsection
