{{--edit--}}
<form method="get" action="{{route('admin.roles.edit',$id)}}" class="role">
  <input type="submit" value="@lang('edit')" class="btn btn-success">
</form>

{{--delete--}}
<form method="post" action="{{route('admin.roles.destroy',$id)}}" class="role">
  @csrf
  @method('DELETE')
  <input type="submit" value="@lang('delete')" class="btn btn-danger">
</form>
