@if ($query->email !== config('permission.admin_user_name'))
@can('admin.admins.update')
<a href="{{ route('admin.admins.edit',$query->id) }}" class="btn btn-outline-success mr-2 p-2">@lang('edit')</a>
@endcan
@can('admin.admins.destroy')
<button type="submit" class="btn btn-outline-danger mr-2 p-2 " form="DeleteForm"
  onclick="DeleteElement(this)">@lang('delete')</button>
@endcan
<form action="{{ route('admin.admins.destroy',$query->id) }}" id="DeleteForm" method="POST">@method('delete')
  @csrf
</form>
@endif
