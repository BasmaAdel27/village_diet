<a href="" class="btn btn-outline-dark mr-2 p-2">@lang('messages')</a>
@can('admin.users.statistics')
<a href="{{ route('admin.users.statistics',$query->id) }}"
  class="btn btn-outline-warning mr-2 p-2">@lang('statistics')</a>
@endcan
@can('admin.users.update')
<a href="{{ route('admin.users.edit',$query->id) }}" class="btn btn-outline-success mr-2 p-2">@lang('edit')</a>
@endcan
@can('admin.users.destroy')
<button type="submit" class="btn btn-outline-danger mr-2 p-2 " form="DeleteForm"
  onclick="DeleteElement(this)">@lang('delete')</button>
@endcan
<form action="{{ route('admin.users.destroy',$query->id) }}" id="DeleteForm" method="POST">@method('delete')
  @csrf
</form>
