
<a href="{{ route('admin.admins.edit',$query->id) }}" class="btn btn-outline-success mr-2 p-2">@lang('edit')</a>
<button type="submit" class="btn btn-outline-danger mr-2 p-2 " form="DeleteForm">@lang('delete')</button>
<form action="{{ route('admin.admins.destroy',$query->id) }}" id="DeleteForm" method="POST">@method('delete')
  @csrf
</form>
