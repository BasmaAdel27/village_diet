<div class="row">
  @foreach ($locales as $locale)
  <div class="form-group col-6">
    <label>@lang("name_$locale")</label>
    <input type="text" class="form-control" placeholder='@lang("name_$locale")' name={{ $locale }}[title]
      value='{{ isset($video) ? $video->translate($locale)?->title : old("$locale.title")}}'>
  </div>
  @endforeach
  <div class="form-group col-6">
    <label>@lang('select_video')</label>
    <div class="custom-file">
      <input type="file" class="custom-file-input" name="video">
      <label class="custom-file-label">Choose file</label>
    </div>
  </div>
  <div class="form-group col-6">
    <label>@lang('status')</label>
    <select name="is_active" class="form-control">
      <option value="">@lang('select')</option>
      <option value="1" {{ isset($video) && $video->is_active == '1' ? 'selected' : '' }}>@lang('active')
      </option>
      <option value="0" {{ isset($video) && $video->is_active == '0' ? 'selected' : '' }}>@lang('inactive')
      </option>
    </select>
  </div>

  <div class="form-group col-6">
    <label>@lang('show_day')</label>
    <select name="day_id" class="form-control">
      <option value="">@lang('select')</option>
      @foreach ($days as $id => $name)
      <option value="{{ $id }}" {{ isset($video) && ($id==$video->day?->id) ?
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
