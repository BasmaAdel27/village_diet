{{--{{dd($query)}}--}}

@if($query->is_active == 1)
    <a href="{{ route('trainer.societies.messages',$query->id) }}" class="btn btn-outline-dark mr-2 p-2">@lang('messages')</a>
  @endif
@can('trainer.societies.show')
<a href="{{ route('trainer.societies.show',$query->id) }}" class="btn btn-outline-primary mr-2 p-2">@lang('details')</a>
@endcan
