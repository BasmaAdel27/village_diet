<div class="row">
  @foreach ($locales as $locale)
  <div class="form-group col-6">
    <label>@lang("name_$locale")</label>
    <input type="text" class="form-control" placeholder='@lang("name_$locale")' name={{ $locale }}[title]
      value='{{ isset($staticPage) ? $staticPage->translate($locale)?->title : old("$locale.title")}}'>
  </div>
  @endforeach
  @foreach ($locales as $locale)
  <div class="form-group col-12">
    <label>@lang("description_$locale")</label>
    <textarea class="form-control" name={{ $locale }}[content] id="summernote-{{ $locale }}"
      rows="25">{{ isset($staticPage) ? $staticPage->translate($locale)?->content : old("$locale.content")}}</textarea>
  </div>
  @endforeach
  <div class="form-group col-6">
    <label>@lang('select_image')</label>
    <div class="custom-file">
      <input type="file" class="custom-file-input" name="image">
      <label class="custom-file-label">Choose file</label>
    </div>
  </div>
  <div class="form-group col-6">
    <label>@lang('status')</label>
    <select name="is_active" class="form-control">
      <option value="">@lang('select')</option>
      <option value="1" {{ isset($staticPage) && $staticPage->is_active == '1' ? 'selected' : '' }}>@lang('active')
      </option>
      <option value="0" {{ isset($staticPage) && $staticPage->is_active == '0' ? 'selected' : '' }}>@lang('inactive')
      </option>
    </select>
  </div>
  <div class="form-group col-6">
    <label>@lang('is_show_in_app')</label>
    <select name="is_show_in_app" class="form-control">
      <option value="">@lang('select')</option>
      <option value="1" {{ isset($staticPage) && $staticPage->is_show_in_app == '1' ? 'selected' : '' }}>@lang('active')
      </option>
      <option value="0" {{ isset($staticPage) && $staticPage->is_show_in_app == '0' ? 'selected' : ''
        }}>@lang('inactive')
      </option>
    </select>
  </div>

</div>
<input type="hidden" name="slug">
<div class="row">
  <div class="form-group col-6">
    <input type="submit" class="btn btn-dark" value="@lang('submit')">
  </div>
</div>
