<div class="row">
  @foreach ($locales as $locale)
  <div class="form-group col-6">
    <label>@lang("name_$locale")</label>
    <input type="text" class="form-control" placeholder='@lang("name_$locale")' name={{ $locale }}[title]
      value='{{ $service->translate($locale)?->title ?? old("$locale.title")}}'>
  </div>
  @endforeach
  @foreach ($locales as $locale)
  <div class="form-group col-6">
    <label>@lang("description_$locale")</label>
    <textarea class="form-control" name={{ $locale }}[description]
      rows="10">{{ $service->translate($locale)?->description ?? old("$locale.description")}}</textarea>
  </div>
  @endforeach
  <div class="form-group col-6">
    <label>@lang('status')</label>
    <select name="is_active" class="form-control">
      <option value="">@lang('select')</option>
      <option value="1" {{ $service?->is_active == '1' ? 'selected' : '' }}>@lang('active')</option>
      <option value="0" {{ $service?->is_active == '0' ? 'selected' : '' }}>@lang('inactive')</option>
    </select>
  </div>
  <div class="form-group col-6">
    <label>@lang('type')</label>
    <select name="type" class="form-control">
      <option value="">@lang('select')</option>
      <option value="WorkWay" {{ $service?->type == 'WorkWay' ? 'selected' : '' }}>@lang('WorkWay')</option>
      <option value="Store" {{ $service?->type == 'Store' ? 'selected' : '' }}>@lang('Store')</option>
    </select>
  </div>
  <div class="form-group col-6">
    <label>@lang('select_image')</label>
    <div class="custom-file">
      <input type="file" class="custom-file-input" name="image">
      <label class="custom-file-label">Choose file</label>
    </div>
  </div>
  <div class="form-group col-6">
    <label>@lang('ordering')</label>
    <input type="text" name="ordering" class="form-control" value="{{ $service?->ordering ?? old('ordering') }}">
  </div>
</div>
<div class="row">
  <div class="form-group col-6">
    <input type="submit" class="btn btn-dark" value="@lang('submit')">
  </div>
</div>
