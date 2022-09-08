{{--edit--}}
<form method="get" action="{{route('admin.roles.edit',$id)}}" class="role">
  <input type="submit" value="@lang('edit')" class="btn btn-success">
</form>

{{--delete--}}
<button type="submit" class="btn btn-danger" form="DeleteForm"
        onclick="DeleteElement()">@lang('delete')</button>
<form action="{{ route('admin.roles.destroy',$id) }}" id="DeleteForm" method="POST">@method('delete')
  @csrf
</form>
</form>
