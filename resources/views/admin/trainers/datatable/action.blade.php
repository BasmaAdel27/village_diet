@can('admin.trainers.update')
<a href="{{ route('admin.trainers.edit',$query->id) }}" class="btn btn-outline-success mr-2 p-2">@lang('edit')</a>
@endcan
@can('admin.trainers.destroy')
<button type="submit" class="btn btn-outline-danger mr-2 p-2 " form="DeleteForm"
  onclick="DeleteElement(this)">@lang('delete')</button>
@endcan
<form action="{{ route('admin.trainers.destroy',$query->id) }}" id="DeleteForm" method="POST">@method('delete')
  @csrf
</form>
