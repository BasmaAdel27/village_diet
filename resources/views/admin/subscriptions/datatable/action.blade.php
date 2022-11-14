
@if($query->status == 'active')
  @can('admin.subscriptions.cancel')
    <button type="submit" class="btn btn-danger mr-2 p-2 " form="CancelForm"
            onclick="cancelElement(this)" >@lang('cancellation')</button>
  @endcan
  <form action="{{ route('admin.subscriptions.cancel',$query->id) }}" style="display:inline-block" id="CancelForm" method="POST">@method('PUT')
    @csrf
  </form>
  @can('admin.subscriptions.inactive')
    <button type="submit" class="btn btn-danger mr-2 p-2 " form="InActiveForm"
        onclick="deactiveElement(this)">@lang('deactivate')</button>
  @endcan
  <form action="{{ route('admin.subscriptions.inactive',$query->id) }}" id="InActiveForm" method="POST">@method('PUT')
    @csrf
  </form>
  @endif

  @if($query->status == 'request_cancel')
      @can('admin.subscriptions.active')
    <button type="submit" class="btn btn-success mr-2 p-2 " form="ActiveForm"
            onclick="ActiveElement(this)" >@lang('activate')</button>
      @endcan
    <form action="{{ route('admin.subscriptions.active',$query->id) }}" style="display:inline-block" id="ActiveForm" method="POST">@method('PUT')
      @csrf
    </form>

  @endif
