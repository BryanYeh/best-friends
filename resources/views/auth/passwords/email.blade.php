@extends('layouts.master')

@section('title')
    Forgot Password
@endsection

<!-- Main Content -->
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-2">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
                    {{ csrf_field() }}
                    <div class="thumbnail thumbnail-post">
                        <div class="caption">
                            <div class="media">
                                <div class="media-body">
                                    <a class="media-heading title-post"
                                       href="#">Reset Password</a>
                                    <h5>
                                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                            <label for="email" class="col-md-4 control-label"><i class="glyphicon glyphicon-envelope"></i></label>

                                            <div class="col-md-6">
                                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="E-mail Address">

                                                @if ($errors->has('email'))
                                                    <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                                @endif
                                            </div>
                                        </div>
                                    </h5>
                                </div>
                            </div>
                        </div>

                        <div class="links-post">
                            <button type="submit" class="btn-primary">
                                Send
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection