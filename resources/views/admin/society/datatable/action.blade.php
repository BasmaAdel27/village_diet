@can('admin.societies.messages')
<a href="{{ route('admin.societies.messages') }}" class="btn btn-outline-dark mr-2 p-2">@lang('messages')</a>
@endcan
@can('admin.societies.update')
<a href="{{ route('admin.societies.edit',$query->id) }}" class="btn btn-outline-success mr-2 p-2">@lang('edit')</a>
@endcan
@can('admin.societies.destroy')
<button type="submit" class="btn btn-outline-danger mr-2 p-2 " form="DeleteForm"
  onclick="DeleteElement(this)">@lang('delete')</button>
@endcan
<form action="{{ route('admin.societies.destroy',$query->id) }}" id="DeleteForm" method="POST">@method('delete')
  @csrf
</form>
