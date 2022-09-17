@can('admin.notifications.destroy')
<button type="submit" class="btn btn-outline-danger mr-2 p-2 " form="DeleteForm"
  onclick="DeleteElement(this)">@lang('delete')</button>
@endcan
<form action="{{ route('admin.notifications.destroy',$query->id) }}" id="DeleteForm" method="POST">@method('delete')
  @csrf
</form>
