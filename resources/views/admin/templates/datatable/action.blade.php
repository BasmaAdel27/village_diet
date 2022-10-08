@can('admin.templates.update')
<a href="{{ route('admin.templates.edit',$query->id) }}" class="btn btn-outline-success mr-2 p-2">@lang('edit')</a>
@endcan
@can('admin.templates.destroy')
<button type="submit" class="btn btn-outline-danger mr-2 p-2 " form="DeleteForm"
  onclick="DeleteElement(this)">@lang('delete')</button>
@endcan
<form action="{{ route('admin.templates.destroy',$query->id) }}" id="DeleteForm" method="POST">@method('delete')
  @csrf
</form>
