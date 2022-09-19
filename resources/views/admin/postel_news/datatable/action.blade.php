<button type="submit" class="btn btn-outline-danger mr-2 p-2 " form="DeleteForm"
  onclick="DeleteElement(this)">@lang('delete')</button>
<form action="{{ route('admin.postel_news.destroy',$query->id) }}" id="DeleteForm" method="POST">@method('delete')
  @csrf
</form>
