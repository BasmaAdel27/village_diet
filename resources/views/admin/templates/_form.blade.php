<div class="row">
  <div class="form-group col-12">
    <label>@lang("template")</label>
    <input type="text" class="form-control" placeholder='@lang("template_name")' name="template_name"
      value='{{ isset($template) ? $template->template_name : old("template_name")}}'>
  </div>
  @foreach ($locales as $locale)
  <div class="form-group col-6">
    <label>@lang("name_$locale")</label>
    <input type="text" class="form-control" placeholder='@lang("name_$locale")' name={{ $locale }}[subject]
      value='{{ isset($template) ? $template->translate($locale)?->subject : old("$locale.subject")}}'>
  </div>
  @endforeach
  @foreach ($locales as $locale)
  <div class="form-group col-12">
    <label>@lang("description_$locale")</label>
    <textarea class="form-control" name={{ $locale }}[content] id="summernote-{{ $locale }}"
      rows="25">{{ isset($template) ? $template->translate($locale)?->content : old("$locale.content")}}</textarea>
  </div>
  @endforeach
  <div class="form-group col-6">
    <label>@lang('status')</label>
    <select name="is_active" class="form-control">
      <option value="">@lang('select')</option>
      <option value="1" {{ isset($template) && $template->is_active == '1' ? 'selected' : '' }}>@lang('active')
      </option>
      <option value="0" {{ isset($template) && $template->is_active == '0' ? 'selected' : '' }}>@lang('inactive')
      </option>
    </select>
  </div>
</div>
<div class="row">
  <div class="form-group col-6">
    <input type="submit" class="btn btn-dark" value="@lang('submit')">
  </div>
</div>
