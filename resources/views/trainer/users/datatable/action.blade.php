{{--@can('trainer.users.messages')--}}
<a href="{{ route('trainer.users.messages',$query->id) }}" class="btn btn-outline-dark mr-2 p-2">@lang('messages')</a>
{{--@endcan--}}
@can('trainer.users.statistics')
<a href="{{ route('trainer.users.statistics',$query->id) }}"
  class="btn btn-outline-warning mr-2 p-2">@lang('statistics')</a>
@endcan
@can('trainer.users.show')
<a href="{{ route('trainer.users.show',$query->id) }}" class="btn btn-outline-primary mr-2 p-2">@lang('details')</a>
@endcan
