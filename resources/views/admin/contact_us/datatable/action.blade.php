@can('admin.contactUs.show')
<a href="{{ route('admin.contactUs.show',$query->id) }}" class="btn btn-outline-primary mr-2 p-2">@lang('details')</a>
@endcan
@can('admin.contactUs.destroy')
<button type="submit" class="btn btn-danger" form="DeleteForm" onclick="DeleteElement(this)">@lang('delete')</button>
@endcan
<form action="{{ route('admin.contactUs.destroy',$query->id) }}" id="DeleteForm" method="POST">@method('delete')
  @csrf
</form>
