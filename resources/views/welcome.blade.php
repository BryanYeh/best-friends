@extends('layouts.master')

@section('title')
  Welcome!
@endsection

@section('content')
  <div class="row">
    <div class="col-md-6">
      <h3>Register</h3>
      <form action="{{ route('signup') }}" method="post">
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" name="email" class="form-control" id="email" placeholder="Email">
        </div>
        <div class="form-group">
          <label for="first_name">First Name</label>
          <input type="text" name="first_name" class="form-control" id="first_name" placeholder="First Name">
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" name="password" class="form-control" id="password" placeholder="Password">
        </div>
        <input type="hidden" name="_token" value="{{ Session::token() }}">
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
    <div class="col-md-6">
      <h3>Sign In</h3>
      <form action="#" method="post">
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" name="email" class="form-control" id="email" placeholder="Email">
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" name="password" class="form-control" id="password" placeholder="Password">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
  </div>
@endsection
