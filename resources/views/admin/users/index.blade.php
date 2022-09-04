@extends('admin.app')
@section('content')
  <div class="container mt-5">
    <h2 class="mb-4">Laravel 7|8 Yajra Datatables Example</h2>
    <table class="table table-bordered yajra-datatable">
      <thead>
      <tr>
        <th>No</th>
        <th>first name</th>
        <th>last name</th>
        <th>email</th>
        <th>Phone</th>
        <th>date_of_birth</th>
        <th>Action</th>
      </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
  </div>
@endsection
