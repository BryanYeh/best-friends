@extends('layouts.master')

@section('title')
    Find Friends
@endsection

@section('content')
    <div class="col-sm-3">
        <div class="panel panel-default">
            <div class="panel-heading">Friends</div>
            <div class="panel-body">
                Links here maybe
            </div>
        </div>
    </div>

    <div class="col-sm-5">
        @foreach($users as $email => $value)
            <div class="thumbnail thumbnail-post" data-friendemail="{{ $email }}">
                <div class="caption">
                    <div class="media">
                        <div class="media-left">
                            <a href="#" class="image-post">
                                <img src="https://placeimg.com/50/50/any">
                            </a>
                        </div>
                        <div class="media-body">
                            <a class="media-heading title-post"
                               href="#">{{ $value['first_name'] }} {{ $value['last_name'] }}</a>
                            <h5>-Add something here-</h5>
                        </div>
                    </div>
                </div>

                <div class="links-post">
                    @if( $value['status'] == 'already')
                        <a href="#" class="link-post destroyFriendship" role="button">Destroy Friendship</a>
                    @elseif($value['status'] == 'pending')
                        <a href="#" class="link-post cancelRequest" role="button">Cancel Friend Request</a>
                    @elseif($value['status'] == 'accept')
                        <a href="#" class="link-post acceptRequest" role="button">Accept Friend Request</a>
                        <a href="#" class="link-post declineRequest" role="button">Decline Friend Request</a>
                    @else
                        <a href="#" class="link-post request" role="button">Request Friend</a>
                    @endif
                </div>
            </div>
        @endforeach
    </div>


    <script>
        var token = '{{ csrf_token() }}';
        var urlUnfriend = '{{ route('friend-destroy') }}';
        var urlCancelRequest = '{{ route('friend-cancel') }}';
        var urlAccept = '{{ route('friend-accept') }}';
        var urlDecline = '{{ route('friend-decline') }}';
        var urlRequest = '{{ route('friend-request') }}';
    </script>
@endsection
