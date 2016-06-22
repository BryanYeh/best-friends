@extends('layouts.master')

@section('title')
   Welcome!
@endsection

@section('content')
  <div class="row">
     <div class="col-xs-12">
         <ul>
            @foreach($errors->all() as $error)
               <li>{{ $error }}</li>
            @endforeach
         </ul>
     </div>
    <div class="col-md-6">
      <h3>Register</h3>
      <hr />
      <form action="{{ route('signup') }}" method="post">
        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
          <label for="email">Email</label>
          <input type="email" name="email" class="form-control" id="email" value="{{ Request::old('email') }}">
        </div>
        <div class="form-group {{ $errors->has('first_name') ? 'has-error' : '' }}">
          <label for="first_name">First Name</label>
          <input type="text" name="first_name" class="form-control" id="first_name" value="{{ Request::old('first_name') }}">
        </div>
        <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
          <label for="password">Password</label>
          <input type="password" name="password" class="form-control" id="password">
        </div>
        <input type="hidden" name="_token" value="{{ Session::token() }}">
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
    <div class="col-md-6">
      <h3>Sign In</h3>
      <hr />
      <form action="{{ route('signin') }}" method="post">
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" name="email" class="form-control" id="email" placeholder="Email">
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" name="password" class="form-control" id="password" placeholder="Password">
        </div>
        <input type="hidden" name="_token" value="{{ Session::token() }}">
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
  </div>
@endsection
