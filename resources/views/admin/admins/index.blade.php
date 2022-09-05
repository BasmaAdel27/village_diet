@extends('admin.app')
@section('content')
<div class="container mt-5">
  <h2 class="mb-4 user">Admins</h2>
  <a href="/en/admin/users/create" class="edit btn btn-success btn-sm ">Add User</a>
  {!! $dataTable->table([
  'class' => 'table table-striped table-hover Main-List'
  ],true) !!}
</div>
@endsection

@section('scripts')
{!! $dataTable->scripts() !!}
@endsection
