@extends('layouts.master')

@section('title')
   Account
@endsection

@section('content')
   <section class="row new-post">
      <div class="col-md-6 col-md-offset-3">
         <header>
            <h3>Your Account</h3>
         </header>
         <form class="" action="{{ route('account.save') }}" method="post" enctype="multipart/form-data">
            <div class="form-group">
              <label for="first_name">First Name</label>
              <input type="text" class="form-control" name="first_name" id="first_name" value="{{ $user->first_name }}">
            </div>
            <div class="form-group">
              <label for="last_name">Last Name</label>
              <input type="text" class="form-control" name="last_name" id="last_name" value="{{ $user->last_name }}">
            </div>
            <div class="form-group">
              <label for="image">Profile Picture</label>
              <input type="file" name="image" id="image" class="form-control">
            </div>
            <input type="hidden" name="_token" value="{{ Session::token() }}">
            <button type="submit" class="btn btn-primary">Save Account</button>
         </form>
      </div>
   </section>
   @if (Storage::disk('local')->has($user->first_name . '_' . $user->id  . '.jpg'))
      <section class="row new-post">
         <div class="col-md-6 col-md-offset-3">
            <img src="{{ route('account.image',['filename' => $user->first_name . '_' . $user->id  . '.jpg']) }}" alt="" class="img-responsive"/>
         </div>
      </section>
   @endif
@endsection
