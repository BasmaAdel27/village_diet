@can('admin.common_questions.show')
  <a href="{{ route('admin.common_questions.show',$query->id) }}" class="btn btn-outline-success mr-2 p-2">@lang('show')</a>
@endcan
@can('admin.common_questions.update')
  <a href="{{ route('admin.common_questions.edit',$query->id) }}" class="btn btn-outline-success mr-2 p-2">@lang('edit')</a>
@endcan
@can('admin.common_questions.destroy')
  <button type="submit" class="btn btn-outline-danger mr-2 p-2 " form="DeleteForm"
          onclick="DeleteElement(this)">@lang('delete')</button>
@endcan
<form action="{{ route('admin.common_questions.destroy',$query->id) }}" id="DeleteForm" method="POST">@method('delete')
  @csrf
</form>
