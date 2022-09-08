<form method="get" action="{{route('admin.contactUs.show',$query->id)}}" class="role">
  <input type="submit" value="@lang('show')" class="btn btn-info">
</form>

{{--delete--}}
<button type="submit" class="btn btn-danger" form="DeleteForm"
         onclick="DeleteElement()">@lang('delete')</button>
<form action="{{ route('admin.contactUs.destroy',$query->id) }}" id="DeleteForm" method="POST">@method('delete')
  @csrf
</form>
