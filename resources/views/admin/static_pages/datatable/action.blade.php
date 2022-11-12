@can('admin.static_pages.update')
<a href="{{ route('admin.static_pages.edit',$query->id) }}" class="btn btn-outline-success mr-2 p-2">@lang('edit')</a>
@endcan
@if(!in_array($query->slug,['Food-Recipes' , 'Our-Vision' ,'About-Village-Diet']))
@can('admin.static_pages.destroy')
<button type="submit" class="btn btn-outline-danger mr-2 p-2 " form="DeleteForm"
  onclick="DeleteElement(this)">@lang('delete')</button>
@endcan

<form action="{{ route('admin.static_pages.destroy',$query->id) }}" id="DeleteForm" method="POST">@method('delete')
  @csrf
</form>
@endif
