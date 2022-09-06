@extends('admin.layout.styles')
  {{--edit--}}
  <form method="get" action="{{route('admin.roles.edit',$id)}}" class="role">
    <input type="submit" value="Edit" class="btn btn-success">
  </form>

  {{--delete--}}
  <form method="post" action="{{route('admin.roles.destroy',$id)}}" class="role">
      @csrf
      @method('DELETE')
    <input type="submit" value="Delete" class="btn btn-danger">
  </form>
@extends('admin.layout.scripts')
