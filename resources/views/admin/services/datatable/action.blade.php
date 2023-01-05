@can('admin.services.update')
<a href="{{request()->query('type')=='Store'? route('admin.services.edit',[$query->id,'type'=>'Store']): route('admin.services.edit',$query->id,['type'=>'WorkWay'])}}" class="btn btn-outline-success mr-2 p-2">@lang('edit')</a>
@endcan
@can('admin.services.destroy')
<button type="submit" class="btn btn-outline-danger mr-2 p-2 " form="DeleteForm"
  onclick="DeleteElement(this)">@lang('delete')</button>
@endcan
<form action="{{request()->query('type')=='Store'? route('admin.services.destroy',[$query->id,'type'=>'Store']): route('admin.services.destroy',$query->id,['type'=>'WorkWay'])}}" id="DeleteForm" method="POST">@method('delete')
  @csrf
</form>
