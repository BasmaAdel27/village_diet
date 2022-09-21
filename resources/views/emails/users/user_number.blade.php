@extends('emails.master')

@section('content')

Dear {{ $user->first_name .' '. $user->last_name }} <br>
<p>
  Welcome to Village Diet .
  You Can Find Your User Number To Start Using Village Diet App
<h1>
  {{ $user->user_number }}
</h1>
<p>
  Best Regards.
</p>
@endsection
