<a href="{{ route('admin.roles.edit',$query->id) }}" class="btn btn-success">@lang('edit')</a>
<button type="submit" class="btn btn-danger" form="DeleteForm" onclick="DeleteElement(this)">@lang('delete')</button>
<form action="{{ route('admin.roles.destroy',$query->id) }}" id="DeleteForm" method="POST">@method('delete')
  @csrf
</form>
