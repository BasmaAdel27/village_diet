<div class="row">
  @foreach ($locales as $locale)
  <div class="form-group col-6">
    <label>@lang("name_$locale")</label>
    <input type="text" class="form-control" placeholder='@lang("name_$locale")' name={{ $locale }}[title]
      value='{{ isset($slider) ? $slider->translate($locale)?->title : old("$locale.title")}}'>
  </div>
  @endforeach
  @foreach ($locales as $locale)
  <div class="form-group col-6">
    <label>@lang("description_$locale")</label>
    <textarea class="form-control" name={{ $locale }}[description]
      rows="10">{{ isset($slider) ? $slider->translate($locale)?->description : old("$locale.description")}}</textarea>
  </div>
  @endforeach
  <div class="form-group col-6">
    <label>@lang("link")</label>
    <input type="text" class="form-control" placeholder='@lang("link")' name="link"
      value="{{ isset($slider) ? $slider->link : old(" link")}}">
  </div>
  <div class="form-group col-6">
    <label>@lang('status')</label>
    <select name="is_active" class="form-control">
      <option value="">@lang('select')</option>
      <option value="1" {{ isset($slider) && $slider->is_active == '1' ? 'selected' : '' }}>@lang('active')</option>
      <option value="0" {{ isset($slider) && $slider->is_active == '0' ? 'selected' : '' }}>@lang('inactive')</option>
    </select>
  </div>
  <div class="form-group col-6">
    <label>@lang('is_show_in_app')</label>
    <select name="is_show_in_app" class="form-control">
      <option value="">@lang('select')</option>
      <option value="1" {{ isset($slider) && $slider->is_show_in_app == '1' ? 'selected' : '' }}>@lang('active')
      </option>
      <option value="0" {{ isset($slider) && $slider->is_show_in_app == '0' ? 'selected' : '' }}>@lang('inactive')
      </option>
    </select>
  </div>

</div>
<div class="row">
  <div class="form-group col-6">
    <input type="submit" class="btn btn-dark" value="@lang('submit')">
  </div>
</div>
