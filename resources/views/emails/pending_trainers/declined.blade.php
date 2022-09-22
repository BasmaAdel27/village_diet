@extends('emails.master')

@section('content')

  Dear {{ $trainer->user->first_name .' '. $trainer->user->last_name }} <br>
  <p>
    Welcome to Village Diet .
    Your request declined because of  <h2>{{$reason}}</h2>
  <p>
    Best Regards.
  </p>
@endsection
