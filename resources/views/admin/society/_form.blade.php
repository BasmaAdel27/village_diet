
<div class="row">
  @foreach ($locales as $locale)
  <div class="form-group col-6">
    <label>@lang("name_$locale")</label>
    <input type="text" class="form-control" placeholder='@lang("name_$locale")' name={{ $locale }}[title]
      value="{{ isset($society) ? $society->translate($locale)?->title : old(" $locale.name")}}">
  </div>
  @endforeach
  <div class="form-group col-6">
    <label>@lang('trainer')</label>
    <select name="trainer_id" class="form-control">
      <option value="">@lang('select')</option>
      @foreach ($trainers as $id => $name)
      <option value="{{ $id }}" {{ isset($society) && ($id==$society->trainer?->id) ?
        'selected': '' }}>
        {{ trans($name) }}</option>
      @endforeach
    </select>
  </div>
  <div class="form-group col-6">
    <label>@lang('status')</label>
    <select name="status" class="form-control">
      <option value="">@lang('select')</option>
      <option value="1" {{ isset($society) && $society->is_active == '1' ? 'selected' : '' }}>@lang('active')</option>
      <option value="0" {{ isset($society) && $society->is_active == '0' ? 'selected' : '' }}>@lang('inactive')</option>
    </select>
  </div>
  <div class="form-group col-12">
    <label>@lang('users')</label>
    <select name="user_id[]" class="form-control js-example-basic-multiple" multiple>
      <option value="">@lang('select')</option>
      @foreach ($users as $id => $name)
      <option value="{{ $id }}" {{ isset($society) && in_array($id,$society->users->pluck('id')->toArray()) ?
        'selected': '' }}>
        {{ trans($name) }}</option>
      @endforeach
    </select>
  </div>
</div>
<div class="row">
  <div class="form-group col-6">
    <input type="submit" class="btn btn-dark" value="@lang('submit')">
  </div>
</div>
