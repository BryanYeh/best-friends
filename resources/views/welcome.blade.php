@extends('layouts.master')

@section('title')
    Welcome!
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6">
            <h3>See a beginning of a fail copy of facebook</h3>
            <h3>
                <small>Things that work</small>
            </h3>
            <ul class="list-group">
                <li class="list-group-item">Auth
                    <ul class="list-group">
                        <li class="list-group-item">Create Account</li>
                        <li class="list-group-item">Login</li>
                    </ul>
                </li>
                <li class="list-group-item">Update Account</li>
                <li class="list-group-item">Friends
                    <ul class="list-group">
                        <li class="list-group-item">Send Request</li>
                        <li class="list-group-item">Cancel Request</li>
                    </ul>
                </li>
                <li class="list-group-item">Facebook Theme
                    <ul class="list-group">
                        <li class="list-group-item">Home</li>
                    </ul>
                </li>
            </ul>
        </div>
        <div class="col-md-6">
            <h2>Sign Up</h2>
            <h3>
                <small>It's a copy and always will be.</small>
            </h3>
            <hr/>
            <form action="{{ route('signup') }}" method="post">
                <div class="row">
                    <div class="col-md-6 form-group {{ $errors->has('first_name') ? 'has-error' : '' }}">
                        <label class="sr-only" for="first_name">First Name</label>
                        <input type="text" name="first_name" class="form-control" id="first_name"
                               value="{{ Request::old('first_name') }}" placeholder="First Name">
                    </div>
                    <div class="col-md-6 form-group {{ $errors->has('last_name') ? 'has-error' : '' }}">
                        <label class="sr-only" for="last_name">Last Name</label>
                        <input type="text" name="last_name" class="form-control" id="last_name"
                               value="{{ Request::old('last_name') }}" placeholder="Last Name">
                    </div>
                </div>
                <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                    <label class="sr-only" for="email">Email</label>
                    <input type="email" name="email" class="form-control" id="email"
                           value="{{ Request::old('email') }}" placeholder="Email">
                </div>

                <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                    <label class="sr-only" for="password">Password</label>
                    <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                </div>
                {{ csrf_field() }}
                <button type="submit" class="btn btn-success">Sign Up</button>
            </form>
        </div>
    </div>
@endsection
