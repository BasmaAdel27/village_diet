@extends('emails.master')

@section('content')

  Dear {{ $trainer->user->first_name .' '. $trainer->user->last_name }} <br>
  <p>
    Welcome to Village Diet .
    Your email is <h2>{{$email}}</h2> and your password is <h2>{{$password}}</h2>
  <p>
    Best Regards.
  </p>
@endsection
