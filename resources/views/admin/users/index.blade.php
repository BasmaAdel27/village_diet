@extends('admin.app')
@section('content')
  <div class="container mt-5">
    <h2 class="mb-4 user">Users</h2>
    <a href="/en/admin/users/create" class="edit btn btn-success btn-sm ">Add User</a>
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
