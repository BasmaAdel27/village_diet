@can('admin.opinions.update')
<a href="{{ route('admin.opinions.edit',$query->id) }}" class="btn btn-outline-success mr-2 p-2">@lang('edit')</a>
@endcan
@can('admin.opinions.destroy')
<button type="submit" class="btn btn-outline-danger mr-2 p-2 " form="DeleteForm"
  onclick="DeleteElement(this)">@lang('delete')</button>
@endcan
<form action="{{ route('admin.opinions.destroy',$query->id) }}" id="DeleteForm" method="POST">@method('delete')
  @csrf
</form>
