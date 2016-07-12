@extends('layouts.master')

@section('title')
   Find Friends
@endsection

@section('content')
   @foreach($users as $email => $value)
      <p>
         {{ $email }}
         {{ $value['first_name'] }}
         {{ $value['last_name'] }}
         {{ $value['status'] }}
      </p>
   @endforeach
@endsection
