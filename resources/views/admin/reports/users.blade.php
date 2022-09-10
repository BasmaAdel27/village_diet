@extends('admin.app')
@section('content')

<div class="card mt-5">
  <div class="card-header">
    @include('admin.reports._date_search')
  </div>
  <div class="card-body table-responsive">
    <table class="table table-striped table-hover Main-List">
      <thead>
        <th></th>
        <th></th>
      </thead>
      <tbody>
        <td></td>
        <td></td>
      </tbody>
    </table>
  </div>
</div>

@endsection
