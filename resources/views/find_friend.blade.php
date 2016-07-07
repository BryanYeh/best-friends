@extends('layouts.master')

@section('title')
   Find Friends
@endsection

@section('content')
   @foreach($users as $user)
      <p>
         {{ $user->first_name }} {{ $user->last_name }} - {{ $user->id }}
      </p>
   @endforeach
@endsection
