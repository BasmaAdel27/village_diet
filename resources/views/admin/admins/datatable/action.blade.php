@extends('admin.layout.styles')
  {{--show--}}
  <form method="get" action="#" class="role">
    <input type="submit" value="Show" class="btn btn-info">
  </form>

  {{--edit--}}
  <form method="post" action="#" class="role">
    @csrf
    @method('PUT')
    <input type="submit" value="Edit" class="btn btn-success">
  </form>

  {{--delete--}}
  <form method="post" action="{{route('admin.roles.destroy',$id)}}" class="role">
      @csrf
      @method('DELETE')
    <input type="submit" value="Delete" class="btn btn-danger">
  </form>
@extends('admin.layout.scripts')
