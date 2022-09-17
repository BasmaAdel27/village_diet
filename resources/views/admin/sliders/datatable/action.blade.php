@can('admin.sliders.update')
<a href="{{ route('admin.sliders.edit',$query->id) }}" class="btn btn-outline-success mr-2 p-2">@lang('edit')</a>
@endcan
@can('admin.sliders.destroy')
<button type="submit" class="btn btn-outline-danger mr-2 p-2 " form="DeleteForm"
  onclick="DeleteElement(this)">@lang('delete')</button>
@endcan
<form action="{{ route('admin.sliders.destroy',$query->id) }}" id="DeleteForm" method="POST">@method('delete')
  @csrf
</form>
