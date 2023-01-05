<div class=" d-flex justify-content-end">
    @if(request()->query('type')=='Store')
    @if($setting->show_store== 1)
      @can('admin.services.disable')

      <button type="submit" class="btn btn-danger ml-3 p-2 mt-4 " form="showForm"
            onclick="disableElement(this)">@lang('disable_in_website')</button>
      @endcan

      <form action="{{route('admin.services.disable',['type'=>'Store']) }}" id="showForm" method="POST">
        @csrf
    </form>
    @else
      @can('admin.services.show')
      <button type="submit" class="btn btn-success ml-3 p-2 mt-4 " form="disableForm"
            onclick="showElement(this)">@lang('show_in_website')</button>
      @endcan
      <form action="{{route('admin.services.show',['type'=>'Store'])}}" id="disableForm" method="POST">
        @csrf
    </form>
    @endif
    @else
    @if($setting->show_workWay== 1)
      @can('admin.services.disable')
      <button type="submit" class="btn btn-danger ml-3 p-2 mt-4 " form="showForm"
            onclick="disableElement(this)">@lang('disable_in_website')</button>
      @endcan
      <form action="{{route('admin.services.disable',['type'=>'WorkWay']) }}" id="showForm" method="POST">
        @csrf
    </form>
    @else
      @can('admin.services.show')
      <button type="submit" class="btn btn-success ml-3 p-2 mt-4 " form="disableForm"
            onclick="showElement(this)">@lang('show_in_website')</button>
      @endcan
      <form action="{{route('admin.services.show',['type'=>'WorkWay'])}}" id="disableForm" method="POST">
        @csrf
    </form>
    @endif
    @endif



</div>
