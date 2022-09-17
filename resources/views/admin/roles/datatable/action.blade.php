@can('admin.roles.update')
<a href="{{ route('admin.roles.edit',$query->id) }}" class="btn btn-success">@lang('edit')</a>
@endcan
@can('admin.roles.destroy')
<button type="submit" class="btn btn-danger" form="DeleteForm" onclick="DeleteElement(this)">@lang('delete')</button>
@endcan
<form action="{{ route('admin.roles.destroy',$query->id) }}" id="DeleteForm" method="POST">@method('delete')
  @csrf
</form>
