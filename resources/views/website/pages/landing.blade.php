@extends('website.layout')

@section('content')

@include('website.landing.slider')
{{-- @include('website.landing.about_us') --}}
@include('website.landing.advantages')
@include('website.landing.society')
@include('website.landing.register')
@include('website.landing.work')
{{-- @include('website.landing.products') --}}
@include('website.landing.download')

@endsection
