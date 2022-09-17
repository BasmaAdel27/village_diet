@can('admin.videos.update')
<a href="{{ route('admin.videos.edit',$query->id) }}" class="btn btn-outline-success mr-2 p-2">@lang('edit')</a>
@endcan
@can('admin.videos.destroy')
<button type="submit" class="btn btn-outline-danger mr-2 p-2 " form="DeleteForm"
  onclick="DeleteElement(this)">@lang('delete')</button>
@endcan
<form action="{{ route('admin.videos.destroy',$query->id) }}" id="DeleteForm" method="POST">@method('delete')
  @csrf
</form>
